import os
import sqlite3
from pathlib import Path
import pytest
from src.file_detector import InputFile, classify_files, discover_csv_files, processing_targets
from src.history_repository import HistoryRepository


@pytest.mark.parametrize("previous,current,reason,process", [
    (100, 100, "UNCHANGED", False),
    (100, 101, "UPDATED", True),
    (None, 100, "NEW", True),
    (101, 100, "OLDER", False),
    (None, 0, "NEW", True),
    (0, 1, "UPDATED", True),
])
def test_decision_boundaries(previous, current, reason, process):
    file = InputFile(Path("AAA.csv"), current, 10)
    history = {} if previous is None else {"AAA.csv": previous}
    decisions = classify_files([file], history)
    assert decisions[0].reason == reason
    assert processing_targets(decisions) == ([file] if process else [])


def test_empty_input(tmp_path):
    assert discover_csv_files(tmp_path) == []
    assert processing_targets(classify_files([], {})) == []


def test_missing_folder(tmp_path):
    with pytest.raises(NotADirectoryError):
        discover_csv_files(tmp_path / "missing")


def test_discovery_order_filters_and_timezone(tmp_path):
    for name in ["z.CSV", "a.csv", "note.txt"]:
        (tmp_path / name).write_text("item_code,amount\nA,1\n")
    (tmp_path / "folder.csv").mkdir()
    (tmp_path / "linked.csv").symlink_to(tmp_path / "a.csv")
    os.utime(tmp_path / "a.csv", ns=(1_760_000_000_000_000_001,) * 2)
    files = discover_csv_files(tmp_path)
    assert [file.name for file in files] == ["a.csv", "z.CSV"]
    assert files[0].mtime_ns == (tmp_path / "a.csv").stat().st_mtime_ns
    assert files[0].modified_at.utcoffset().total_seconds() == 0


def test_parameterized_history_and_batching():
    connection = sqlite3.connect(":memory:")
    try:
        repository = HistoryRepository(connection)
        repository.initialize()
        names = [f"{index}.csv" for index in range(1100)] + ["a'); DROP TABLE ingestion_history;--.csv"]
        with connection:
            for name in names:
                repository.record_success(name, 123, 0)
        assert repository.fetch(names) == dict.fromkeys(names, 123)
        assert repository.fetch([]) == {}
    finally:
        connection.close()
