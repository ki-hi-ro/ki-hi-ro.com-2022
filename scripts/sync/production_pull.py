#!/usr/bin/env python3
"""Pull production WordPress data to a guarded local WordPress installation."""
import argparse
import datetime
import fcntl
import json
import os
from pathlib import Path
import re
import shlex
import shutil
import subprocess
import sys
import uuid
from urllib.parse import urlparse

ROOT = Path(__file__).resolve().parents[2]
CONFIG = ROOT / '.local-sync/config.json'


def run(args, **kwargs):
    return subprocess.run(args, check=True, timeout=3600, **kwargs)


def output(args):
    return run(args, stdout=subprocess.PIPE, text=True).stdout.strip()


def is_local_url(value):
    url = urlparse(value)
    host = url.hostname or ''
    return url.scheme in ('http', 'https') and (
        host in ('localhost', '127.0.0.1', '::1') or host.endswith(('.test', '.local'))
    )


def validate(c):
    required = ('ssh_host', 'remote_wp_path', 'remote_wp_command',
                'remote_uploads_path', 'local_wp_path', 'local_wp_command',
                'local_uploads_path', 'local_home', 'local_siteurl',
                'production_home', 'production_siteurl', 'interval_hours')
    for key in required:
        if key not in c:
            raise ValueError(f'Missing configuration: {key}')
    if not re.fullmatch(r'[A-Za-z0-9][A-Za-z0-9_.@-]*', c['ssh_host']):
        raise ValueError('ssh_host must be an SSH alias or user@hostname')
    for key in ('local_home', 'local_siteurl'):
        if not is_local_url(c[key]):
            raise ValueError(f'{key} must use localhost, .test, or .local')
    for key in ('production_home', 'production_siteurl'):
        if is_local_url(c[key]) or urlparse(c[key]).scheme not in ('http', 'https'):
            raise ValueError(f'{key} must be a production HTTP(S) URL')
    for key in ('local_wp_path', 'local_uploads_path', 'remote_wp_path', 'remote_uploads_path'):
        if not c[key].startswith('/') or '\n' in c[key] or '..' in Path(c[key]).parts:
            raise ValueError(f'{key} must be an absolute path without parent traversal')
    for key in ('remote_wp_path', 'remote_uploads_path'):
        if not re.fullmatch(r'/[A-Za-z0-9_./-]+', c[key]):
            raise ValueError(f'{key} must not contain spaces or shell characters')
    wp_root = Path(c['local_wp_path']).resolve()
    uploads = Path(c['local_uploads_path']).resolve()
    if uploads != wp_root / 'wp-content/uploads':
        raise ValueError('Local uploads must be local_wp_path/wp-content/uploads')
    for key in ('local_wp_command', 'remote_wp_command'):
        if not isinstance(c[key], list) or not c[key] or not all(isinstance(v, str) and v for v in c[key]):
            raise ValueError(f'{key} must be a nonempty command argument array')
    if type(c['interval_hours']) is not int or c['interval_hours'] < 1:
        raise ValueError('interval_hours must be a positive integer')
    if c.get('media_mode', 'download') not in ('download', 'remote'):
        raise ValueError('media_mode must be download or remote')
    if c.get('media_mode') == 'remote':
        url = c.get('production_uploads_url', '')
        if urlparse(url).scheme != 'https' or urlparse(url).hostname != urlparse(c['production_home']).hostname:
            raise ValueError('production_uploads_url must be an HTTPS URL on the production host')
    if type(c.get('keep_backups', 3)) is not int or c.get('keep_backups', 3) < 1:
        raise ValueError('keep_backups must be a positive integer')


def wp(c, *args):
    return c['local_wp_command'] + [f"--path={c['local_wp_path']}", '--skip-plugins', '--skip-themes'] + list(args)


def ssh_options():
    config = ROOT / '.local-sync/ssh-config'
    return (['-F', str(config)] if config.exists() else []) + [
        '-o', 'BatchMode=yes', '-o', 'StrictHostKeyChecking=yes', '-o', 'ConnectTimeout=15']


def ssh(c, *args):
    return ['ssh'] + ssh_options() + [c['ssh_host'], shlex.join(list(args))]


def remote_wp(c, *args):
    return ssh(c, *c['remote_wp_command'], f"--path={c['remote_wp_path']}", '--skip-plugins', '--skip-themes', *args)


def preflight(c):
    # config get does not load WordPress plugins or themes.
    if output(wp(c, 'config', 'get', 'WP_ENVIRONMENT_TYPE')) != 'local':
        raise ValueError('Local wp-config.php must define WP_ENVIRONMENT_TYPE as local')
    db_host = output(wp(c, 'config', 'get', 'DB_HOST'))
    if not re.match(r'^(localhost|127\.0\.0\.1)(:|$)', db_host):
        raise ValueError('Local DB_HOST must be localhost or 127.0.0.1')
    if output(wp(c, 'config', 'get', 'DISABLE_WP_CRON')).lower() not in ('1', 'true'):
        raise ValueError('Local wp-config.php must disable WP cron')
    if output(wp(c, 'eval', 'echo is_multisite() ? "yes" : "no";')) != 'no':
        raise ValueError('Multisite synchronization is not supported')
    for key in ('home', 'siteurl'):
        if not is_local_url(output(wp(c, 'option', 'get', key))):
            raise ValueError(f'Current local {key} must use a local hostname')
    if output(remote_wp(c, 'eval', 'echo is_multisite() ? "yes" : "no";')) != 'no':
        raise ValueError('Production multisite is not supported')
    if output(wp(c, 'config', 'get', 'table_prefix', '--type=variable')) != output(
            remote_wp(c, 'config', 'get', 'table_prefix', '--type=variable')):
        raise ValueError('Production and local table prefixes must match')
    for key in ('home', 'siteurl'):
        if output(remote_wp(c, 'option', 'get', key)).rstrip('/') != c['production_' + key].rstrip('/'):
            raise ValueError(f'Production {key} does not match configuration')


def rsync(c, dry_run=False):
    args = ['rsync', '-az', '--timeout=120',
            '-e', shlex.join(['ssh'] + ssh_options())]
    if dry_run:
        args += ['--dry-run', '--itemize-changes']
    # Pull only; keep local-only files. No delete, no theme/config transfer.
    return args + [f"{c['ssh_host']}:{c['remote_uploads_path'].rstrip('/')}/",
                   c['local_uploads_path'].rstrip('/') + '/']


def check_capacity(c):
    if c.get('media_mode') == 'remote':
        if shutil.disk_usage(Path(c['local_wp_path'])).free < 2 * 1024 ** 3:
            raise ValueError('DB sync needs at least 2 GiB free for SQL backups')
        return
    remote_bytes = int(output(ssh(c, 'du', '-sk', c['remote_uploads_path'])).split()[0]) * 1024
    uploads = Path(c['local_uploads_path'])
    local_bytes = int(output(['du', '-sk', str(uploads)]).split()[0]) * 1024 if uploads.exists() else 0
    # Existing files need a separate backup; reserve space for SQL and changes.
    required = max(0, remote_bytes - local_bytes) + local_bytes + 5 * 1024 ** 3
    free = shutil.disk_usage(Path(c['local_wp_path'])).free
    if free < required:
        raise ValueError(f'Insufficient storage: need approximately {required / 1024 ** 3:.1f} GiB free; '
                         f'available {free / 1024 ** 3:.1f} GiB. No database import performed.')


def replace_urls(c):
    def replace(source, destination):
        run(wp(c, 'search-replace', source, destination, '--all-tables-with-prefix', '--skip-columns=guid', '--precise'))

    protected = []
    if c.get('media_mode') == 'remote':
        bases = {c['production_uploads_url'].rstrip('/'),
                 c['production_siteurl'].rstrip('/') + '/wp-content/uploads',
                 c['production_home'].rstrip('/') + '/wp-content/uploads'}
        for base in sorted(bases, key=len, reverse=True):
            for source in (base, base.replace('/', '\\/')):
                token = 'KIHIRO_REMOTE_UPLOADS_' + uuid.uuid4().hex
                replace(source, token)
                protected.append((token, source))
    mappings = {c['production_siteurl'].rstrip('/'): c['local_siteurl'].rstrip('/'),
                c['production_home'].rstrip('/'): c['local_home'].rstrip('/')}
    for source in sorted(mappings, key=len, reverse=True):
        replace(source, mappings[source])
        replace(source.replace('/', '\\/'), mappings[source].replace('/', '\\/'))
    for token, original in protected:
        replace(token, original)


def prune_backups(c, backup_root):
    successful = []
    for folder in backup_root.glob('sync-*'):
        if folder.is_symlink() or not folder.is_dir():
            continue
        try:
            if json.loads((folder / 'status.json').read_text()).get('status') == 'complete':
                successful.append(folder)
        except (OSError, ValueError):
            continue
    for folder in sorted(successful, reverse=True)[c.get('keep_backups', 3):]:
        shutil.rmtree(folder)


def pull(c, apply=False):
    validate(c)
    preflight(c)
    check_capacity(c)
    if not apply:
        if c.get('media_mode') != 'remote':
            run(rsync(c, dry_run=True))
        print('Checks passed. --apply will back up and replace the local database. Media mode: ' + c.get('media_mode', 'download'))
        return
    stamp = datetime.datetime.now(datetime.timezone.utc).strftime('%Y%m%dT%H%M%S%fZ')
    backup_root = ROOT / '.local-backups'
    backup_root.mkdir(mode=0o700, exist_ok=True)
    (backup_root / '.htaccess').write_text('Require all denied\n')
    backup = backup_root / ('sync-' + stamp)
    backup.mkdir(parents=True, mode=0o700)
    state = {'status': 'fetching', 'backup': str(backup), 'started_at': stamp}

    def save():
        (backup / 'status.json').write_text(json.dumps(state, indent=2) + '\n')

    save()
    with (backup / 'production.sql').open('wb') as sql:
        run(remote_wp(c, 'db', 'export', '-', '--single-transaction', '--quick'), stdout=sql)
    if (backup / 'production.sql').stat().st_size < 100:
        raise ValueError('Production SQL export is empty or incomplete')
    run(wp(c, 'db', 'export', str(backup / 'local-before.sql'), '--single-transaction', '--quick'))
    uploads = Path(c['local_uploads_path'])
    if c.get('media_mode') != 'remote':
        (backup / 'uploads-before').mkdir()
        if uploads.exists():
            run(['rsync', '-a', str(uploads) + '/', str(backup / 'uploads-before') + '/'])
    state['status'] = 'backed_up'
    save()
    database_started = False
    try:
        if c.get('media_mode') != 'remote':
            run(rsync(c))
        database_started = True
        run(wp(c, 'db', 'import', str(backup / 'production.sql')))
        # Replace the longer installation URL first. WP-CLI preserves serialized data.
        replace_urls(c)
        run(wp(c, 'option', 'update', 'home', c['local_home']))
        run(wp(c, 'option', 'update', 'siteurl', c['local_siteurl']))
        # Keep the local copy out of search engine indexes.
        run(wp(c, 'option', 'update', 'blog_public', '0'))
        if c.get('media_mode') == 'remote':
            run(wp(c, 'option', 'update', 'upload_url_path', c['production_uploads_url'].rstrip('/')))
            if output(wp(c, 'eval', '$u = wp_upload_dir(); echo $u["baseurl"];')).rstrip('/') != c['production_uploads_url'].rstrip('/'):
                raise ValueError('Remote uploads URL verification failed')
        for key in ('home', 'siteurl'):
            if output(wp(c, 'option', 'get', key)).rstrip('/') != c['local_' + key].rstrip('/'):
                raise ValueError(f'URL verification failed: {key}')
        state['status'] = 'complete'
        state['media_mode'] = c.get('media_mode', 'download')
        save()
        try:
            prune_backups(c, backup_root)
        except OSError as error:
            print(f'Backup cleanup skipped: {error}', file=sys.stderr)
        print(f'Sync complete. Backup: {backup}')
    except BaseException:
        state['status'] = 'failed'
        save()
        if database_started:
            try:
                run(wp(c, 'db', 'import', str(backup / 'local-before.sql')))
                state['status'] = 'failed_database_restored'
                save()
            except Exception:
                state['status'] = 'failed_manual_restore_required'
                save()
        print(f'Sync failed. Database backup and previous uploads: {backup}', file=sys.stderr)
        raise


def main():
    os.umask(0o077)
    os.environ['PATH'] = '/Applications/MAMP/Library/bin/mysql80/bin:' + os.environ.get('PATH', '/usr/bin:/bin')
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument('--config', type=Path, default=CONFIG)
    parser.add_argument('--apply', action='store_true', help='replace local DB after backup')
    args = parser.parse_args()
    lock_dir = ROOT / '.local-sync'
    lock_dir.mkdir(mode=0o700, exist_ok=True)
    (lock_dir / '.htaccess').write_text('Require all denied\n')
    with (lock_dir / 'sync.lock').open('w') as lock:
        try:
            fcntl.flock(lock, fcntl.LOCK_EX | fcntl.LOCK_NB)
        except BlockingIOError:
            print('Another sync is running; skipping.')
            return
        try:
            c = json.loads(args.config.read_text())
            pull(c, args.apply)
        except (Exception, KeyboardInterrupt) as error:
            print(f'Sync stopped: {error}', file=sys.stderr)
            sys.exit(1)


if __name__ == '__main__':
    main()
