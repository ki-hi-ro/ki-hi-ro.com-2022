import copy
import json
from pathlib import Path
import subprocess
import sys
import tempfile
import unittest
from types import SimpleNamespace
from unittest.mock import patch

SCRIPTS = Path(__file__).resolve().parents[1] / 'scripts/sync'
sys.path.insert(0, str(SCRIPTS))
import production_pull as sync
import schedule


class SyncTests(unittest.TestCase):
    def setUp(self):
        self.config = json.loads((SCRIPTS / 'config.example.json').read_text())
        self.config['media_mode'] = 'download'

    def test_rejects_nonlocal_destination_and_injection(self):
        for key, value in [('local_home', 'https://ki-hi-ro.com'),
                           ('local_siteurl', 'http://localhost.evil.com'),
                           ('ssh_host', '-oProxyCommand=bad'),
                           ('remote_uploads_path', '/home/user/$(bad)'),
                           ('local_uploads_path', '/Applications/MAMP/htdocs'),
                           ('interval_hours', 0)]:
            c = copy.deepcopy(self.config)
            c[key] = value
            with self.subTest(key=key), self.assertRaises(ValueError):
                sync.validate(c)

    def test_preflight_rejects_remote_database_before_connecting_production(self):
        values = iter(['local', 'mysql.production.example'])
        with patch.object(sync, 'output', side_effect=lambda args: next(values)) as read:
            with self.assertRaises(ValueError):
                sync.preflight(self.config)
            self.assertEqual(read.call_count, 2)

    def test_preflight_accepts_expected_single_site(self):
        values = iter(['local', 'localhost:8889', '1', 'no',
                       'http://localhost:8888', 'http://localhost:8888', 'no',
                       'wp_', 'wp_', 'https://ki-hi-ro.com/',
                       'https://ki-hi-ro.com/ki-hi-ro.com-2022'])
        with patch.object(sync, 'output', side_effect=lambda args: next(values)):
            sync.preflight(self.config)

    def test_dry_run_never_exports_or_imports(self):
        with patch.object(sync, 'preflight'), patch.object(sync, 'check_capacity'), patch.object(sync, 'run') as execute:
            sync.pull(self.config)
            args = execute.call_args.args[0]
            self.assertIn('--dry-run', args)
            self.assertNotIn('--delete', args)
            self.assertEqual(execute.call_count, 1)

    def exercise_apply(self, failure=None, media_mode="download"):
        with tempfile.TemporaryDirectory() as folder:
            root = Path(folder)
            c = copy.deepcopy(self.config)
            c['media_mode'] = media_mode
            c['local_wp_path'] = str(root / 'wordpress')
            c['local_uploads_path'] = str(root / 'wordpress/wp-content/uploads')
            commands = []

            def execute(args, **kwargs):
                commands.append(args)
                if 'stdout' in kwargs:
                    kwargs['stdout'].write(b'-- SQL dump\n' * 100)
                if failure == 'uploads' and args[0] == 'rsync' and '-az' in args:
                    raise subprocess.CalledProcessError(1, args)
                if failure == 'replace' and 'search-replace' in args:
                    raise subprocess.CalledProcessError(1, args)

            def read(args):
                return c['production_uploads_url'] if 'eval' in args else c['local_' + args[-1]]

            with patch.object(sync, 'ROOT', root), patch.object(sync, 'preflight'), patch.object(sync, 'check_capacity'), \
                    patch.object(sync, 'run', side_effect=execute), \
                    patch.object(sync, 'output', side_effect=read):
                if failure:
                    with self.assertRaises(subprocess.CalledProcessError):
                        sync.pull(c, apply=True)
                else:
                    sync.pull(c, apply=True)
            status_file = next((root / '.local-backups').glob('sync-*/status.json'))
            return commands, json.loads(status_file.read_text())

    def test_success_backs_up_before_mutation_and_replaces_long_url_first(self):
        commands, status = self.exercise_apply()
        backup = next(i for i, args in enumerate(commands) if 'db' in args and 'export' in args and any('local-before.sql' in a for a in args))
        uploads = next(i for i, args in enumerate(commands) if '-az' in args)
        imported = next(i for i, args in enumerate(commands) if 'import' in args)
        self.assertLess(backup, uploads)
        self.assertLess(uploads, imported)
        replacements = [args for args in commands if 'search-replace' in args]
        first = replacements[0]
        self.assertEqual(first[first.index('search-replace') + 1], self.config['production_siteurl'])
        self.assertTrue(all('--skip-columns=guid' in args for args in replacements))
        self.assertEqual(status['status'], 'complete')
        self.assertTrue(all('import' not in args for args in commands if args[0] == 'ssh'))

    def test_upload_failure_leaves_database_untouched(self):
        commands, status = self.exercise_apply('uploads')
        self.assertFalse(any('import' in args for args in commands))
        self.assertEqual(status['status'], 'failed')

    def test_conversion_failure_restores_database(self):
        commands, status = self.exercise_apply('replace')
        imports = [args for args in commands if 'import' in args]
        self.assertEqual(len(imports), 2)
        self.assertTrue(imports[-1][-1].endswith('local-before.sql'))
        self.assertEqual(status['status'], 'failed_database_restored')

    def test_schedule_is_daily_and_does_not_run_on_install(self):
        value = schedule.job(self.config)
        self.assertEqual(value['StartInterval'], 86400)
        self.assertFalse(value['RunAtLoad'])
        self.assertIn('--apply', value['ProgramArguments'])

    def test_insufficient_space_stops_before_backup_or_transfer(self):
        with patch.object(sync, 'preflight'), patch.object(sync, 'run') as execute, \
                patch.object(sync, 'check_capacity', side_effect=ValueError('Insufficient storage')):
            with self.assertRaises(ValueError):
                sync.pull(self.config, apply=True)
            execute.assert_not_called()

    def test_capacity_guard_reserves_space_for_backups_and_sql(self):
        with patch.object(sync, 'output', return_value='30408704\tuploads'), \
                patch.object(sync.shutil, 'disk_usage', return_value=SimpleNamespace(free=27 * 1024 ** 3)):
            with self.assertRaisesRegex(ValueError, 'Insufficient storage'):
                sync.check_capacity(self.config)

    def test_remote_mode_skips_all_image_transfer_and_sets_upload_base(self):
        commands, status = self.exercise_apply(media_mode='remote')
        self.assertFalse(any(args[0] == 'rsync' for args in commands))
        self.assertTrue(any('upload_url_path' in args and self.config['production_uploads_url'] in args for args in commands))
        self.assertEqual(status['media_mode'], 'remote')

    def test_remote_mode_preserves_embedded_and_json_image_urls(self):
        c = dict(self.config, media_mode='remote')
        image = c['production_uploads_url'] + '/2026/10/photo.jpg'
        content = image + ' ' + image.replace('/', '\\/') + ' ' + c['production_home'] + '/about/'
        def execute(args):
            nonlocal content
            pos = args.index('search-replace')
            content = content.replace(args[pos + 1], args[pos + 2])
        with patch.object(sync, 'run', side_effect=execute):
            sync.replace_urls(c)
        self.assertIn(image, content)
        self.assertIn(image.replace('/', '\\/'), content)
        self.assertIn(c['local_home'] + '/about/', content)
        self.assertNotIn('KIHIRO_REMOTE_UPLOADS_', content)

    def test_backup_retention_keeps_failed_backups(self):
        with tempfile.TemporaryDirectory() as temp:
            root = Path(temp)
            for name, status in [('sync-01', 'complete'), ('sync-02', 'complete'), ('sync-03', 'failed')]:
                folder = root / name
                folder.mkdir()
                (folder / 'status.json').write_text(json.dumps({'status': status}))
            sync.prune_backups(dict(self.config, keep_backups=1), root)
            self.assertFalse((root / 'sync-01').exists())
            self.assertTrue((root / 'sync-02').exists())
            self.assertTrue((root / 'sync-03').exists())


if __name__ == '__main__':
    unittest.main()
