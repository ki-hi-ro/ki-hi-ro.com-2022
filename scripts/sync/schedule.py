#!/usr/bin/env python3
"""Generate/install/remove the local macOS launchd sync job."""
import argparse
import json
import os
from pathlib import Path
import plistlib
import subprocess
import sys

from production_pull import ROOT, CONFIG, validate

LABEL = 'com.ki-hi-ro.production-pull'


def job(config):
    validate(config)
    return {
        'Label': LABEL,
        'ProgramArguments': [sys.executable, str(ROOT / 'scripts/sync/production_pull.py'),
                             '--config', str(CONFIG), '--apply'],
        'WorkingDirectory': str(ROOT),
        'StartInterval': config['interval_hours'] * 3600,
        'RunAtLoad': False,
        'ProcessType': 'Background',
        'EnvironmentVariables': {
            'PATH': '/Applications/MAMP/Library/bin:/Applications/MAMP/Library/bin/mysql80/bin:/usr/local/bin:/usr/bin:/bin:/usr/sbin:/sbin',
        },
        'StandardOutPath': str(ROOT / '.local-sync/sync.log'),
        'StandardErrorPath': str(ROOT / '.local-sync/sync-error.log'),
    }


def main():
    os.umask(0o077)
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument('action', choices=('generate', 'install', 'remove'))
    args = parser.parse_args()
    destination = Path.home() / 'Library/LaunchAgents' / (LABEL + '.plist')
    domain = f'gui/{os.getuid()}'
    if args.action == 'remove':
        if destination.exists():
            subprocess.run(['launchctl', 'bootout', domain, str(destination)], check=False)
            destination.unlink()
        print('Scheduled sync removed.')
        return
    config = json.loads(CONFIG.read_text())
    value = job(config)
    target = ROOT / '.local-sync' / (LABEL + '.plist')
    target.parent.mkdir(mode=0o700, exist_ok=True)
    (target.parent / '.htaccess').write_text('Require all denied\n')
    target.write_bytes(plistlib.dumps(value))
    if args.action == 'install':
        # Run connection checks before allowing an unattended DB replacement.
        subprocess.run([sys.executable, str(ROOT / 'scripts/sync/production_pull.py')], check=True, env={**os.environ, **value['EnvironmentVariables']})
        destination.parent.mkdir(parents=True, exist_ok=True)
        if destination.exists():
            subprocess.run(['launchctl', 'bootout', domain, str(destination)], check=False)
        destination.write_bytes(target.read_bytes())
        subprocess.run(['launchctl', 'bootstrap', domain, str(destination)], check=True)
        print(f'Scheduled every {config["interval_hours"]} hours: {destination}')
    else:
        print(f'Generated (not activated): {target}')


if __name__ == '__main__':
    main()
