"""Run from repository root: python -m src.main [--dry-run]."""
import argparse
import sqlite3
from pathlib import Path
from .etl import process_file
from .file_detector import classify_files, discover_csv_files, processing_targets
from .history_repository import HistoryRepository


def run(input_dir: Path, db: Path, dry_run: bool = False) -> int:
    files = discover_csv_files(input_dir)
    db.parent.mkdir(parents=True, exist_ok=True)
    connection = sqlite3.connect(db)
    try:
        repository = HistoryRepository(connection)
        repository.initialize()
        decisions = classify_files(files, repository.fetch(file.name for file in files))
        for decision in decisions:
            action = "PROCESS" if decision.should_process else "SKIP"
            print(f"{decision.file.name} -> {action} ({decision.reason}) {decision.file.modified_at.isoformat()}")
        targets = processing_targets(decisions)
        failures = 0
        if not dry_run:
            for file in targets:
                try:
                    count = process_file(file, repository)
                    print(f"SUCCESS {file.name}: {count} rows")
                except (ValueError, OSError, RuntimeError, sqlite3.Error) as error:
                    failures += 1
                    print(f"FAILED {file.name}: {error}")
        print(f"Scanned={len(files)} Targets={len(targets)} Failed={failures}")
        return 1 if failures else 0
    finally:
        connection.close()


def main() -> int:
    parser = argparse.ArgumentParser(description="Select only new/updated CSVs using SQLite history")
    parser.add_argument("--input", type=Path, default=Path("input"))
    parser.add_argument("--db", type=Path, default=Path("var/etl.sqlite3"))
    parser.add_argument("--dry-run", action="store_true", help="Skip CSV loading (initializes DB schema if absent)")
    args = parser.parse_args()
    try:
        return run(args.input, args.db, args.dry_run)
    except (OSError, sqlite3.Error) as error:
        parser.exit(1, f"ERROR: {error}\n")


if __name__ == "__main__":
    raise SystemExit(main())
