"""Create isolated demo copies; never reset a database with successful history."""
import os
import shutil
import sqlite3
from pathlib import Path
from src.etl import process_file
from src.file_detector import discover_csv_files
from src.history_repository import HistoryRepository


def setup_demo(demo: Path, fixtures: Path) -> None:
    if demo.exists():
        raise FileExistsError(f"Demo directory already exists: {demo}. Choose a new directory.")
    input_dir = demo / "input"
    input_dir.mkdir(parents=True)
    base_ns = 1_760_000_000_000_000_000
    for name in ("AAA.csv", "BBB.csv", "CCC.csv"):
        target = input_dir / name
        shutil.copyfile(fixtures / name, target)
        os.utime(target, ns=(base_ns, base_ns))
    connection = sqlite3.connect(demo / "etl.sqlite3")
    try:
        repository = HistoryRepository(connection)
        repository.initialize()
        files = {file.name: file for file in discover_csv_files(input_dir)}
        process_file(files["AAA.csv"], repository)
        # BBB has already been imported at an older mtime, then updated in input.
        os.utime(files["BBB.csv"].path, ns=(base_ns - 1_000_000_000, base_ns - 1_000_000_000))
        old_bbb = next(file for file in discover_csv_files(input_dir) if file.name == "BBB.csv")
        process_file(old_bbb, repository)
        os.utime(old_bbb.path, ns=(base_ns, base_ns))
    finally:
        connection.close()


if __name__ == "__main__":
    import argparse
    parser = argparse.ArgumentParser()
    parser.add_argument("--demo", type=Path, default=Path("var/demo"))
    args = parser.parse_args()
    setup_demo(args.demo, Path(__file__).resolve().parents[1] / "input")
    print(f"Demo ready: {args.demo}")
