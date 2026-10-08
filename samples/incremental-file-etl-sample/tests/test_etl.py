import os
import sqlite3
import pytest
from scripts.setup_db import setup_demo
from src.etl import process_file
from src.file_detector import discover_csv_files
from src.history_repository import HistoryRepository
from src.main import run
from pathlib import Path


@pytest.fixture
def repository(tmp_path):
    connection = sqlite3.connect(tmp_path / "test.sqlite3")
    repository = HistoryRepository(connection)
    repository.initialize()
    yield repository
    connection.close()


def test_success_and_replacement(tmp_path, repository):
    path = tmp_path / "data.csv"
    path.write_text("item_code,amount\n001,100\n002,200\n")
    file = discover_csv_files(tmp_path)[0]
    assert process_file(file, repository) == 2
    assert repository.fetch([file.name]) == {file.name: file.mtime_ns}
    path.write_text("item_code,amount\n003,500\n")
    os.utime(path, ns=(file.mtime_ns + 1_000_000_000,) * 2)
    assert process_file(discover_csv_files(tmp_path)[0], repository) == 1
    assert repository.connection.execute("SELECT item_code, amount FROM sales_records").fetchall() == [("003", 500)]


@pytest.mark.parametrize("csv", [
    "wrong,amount\nA,1\n", "item_code,amount\n,1\n",
    "item_code,amount\nA,invalid\n", "item_code,amount\nA,-1\n",
    "item_code,amount\nA,9223372036854775808\n",
])
def test_invalid_csv_not_marked_success(tmp_path, repository, csv):
    (tmp_path / "bad.csv").write_text(csv)
    with pytest.raises(ValueError):
        process_file(discover_csv_files(tmp_path)[0], repository)
    assert repository.fetch(["bad.csv"]) == {}
    assert repository.connection.execute("SELECT COUNT(*) FROM sales_records").fetchone()[0] == 0


def test_db_failure_rolls_back_data_and_history(tmp_path, repository):
    path = tmp_path / "data.csv"
    path.write_text("item_code,amount\nOLD,1\n")
    file = discover_csv_files(tmp_path)[0]
    process_file(file, repository)
    repository.connection.execute("""CREATE TRIGGER reject_history BEFORE UPDATE ON ingestion_history
        BEGIN SELECT RAISE(ABORT, 'simulated persistence failure'); END""")
    path.write_text("item_code,amount\nNEW,2\n")
    os.utime(path, ns=(file.mtime_ns + 1_000_000_000,) * 2)
    with pytest.raises(sqlite3.IntegrityError):
        process_file(discover_csv_files(tmp_path)[0], repository)
    assert repository.fetch([file.name]) == {file.name: file.mtime_ns}
    assert repository.connection.execute("SELECT item_code FROM sales_records").fetchall() == [("OLD",)]


def test_changed_after_discovery_is_rejected(tmp_path, repository):
    path = tmp_path / "data.csv"
    path.write_text("item_code,amount\nA,1\n")
    file = discover_csv_files(tmp_path)[0]
    os.utime(path, ns=(file.mtime_ns + 1_000_000_000,) * 2)
    with pytest.raises(RuntimeError, match="after discovery"):
        process_file(file, repository)
    assert repository.fetch([file.name]) == {}


def test_changed_during_read_is_rejected(tmp_path, repository, monkeypatch):
    import src.etl as etl
    path = tmp_path / "data.csv"
    path.write_text("item_code,amount\nA,1\n")
    file = discover_csv_files(tmp_path)[0]
    original_read = etl.pd.read_csv
    def changing_read(*args, **kwargs):
        result = original_read(*args, **kwargs)
        os.utime(path, ns=(file.mtime_ns + 1_000_000_000,) * 2)
        return result
    monkeypatch.setattr(etl.pd, "read_csv", changing_read)
    with pytest.raises(RuntimeError, match="while reading"):
        process_file(file, repository)
    assert repository.fetch([file.name]) == {}


def test_demo_dry_run_and_second_run(tmp_path, capsys):
    demo = tmp_path / "demo"
    setup_demo(demo, Path(__file__).resolve().parents[1] / "input")
    assert run(demo / "input", demo / "etl.sqlite3", dry_run=True) == 0
    output = capsys.readouterr().out
    assert "AAA.csv -> SKIP (UNCHANGED)" in output
    assert "BBB.csv -> PROCESS (UPDATED)" in output
    assert "CCC.csv -> PROCESS (NEW)" in output
    assert run(demo / "input", demo / "etl.sqlite3") == 0
    assert "Targets=2" in capsys.readouterr().out
    assert run(demo / "input", demo / "etl.sqlite3") == 0
    assert "Targets=0" in capsys.readouterr().out
    with pytest.raises(FileExistsError):
        setup_demo(demo, Path(__file__).resolve().parents[1] / "input")


def test_empty_run(tmp_path, capsys):
    input_dir = tmp_path / "input"
    input_dir.mkdir()
    assert run(input_dir, tmp_path / "db.sqlite3") == 0
    assert "Scanned=0 Targets=0 Failed=0" in capsys.readouterr().out


def test_failed_file_retried_and_other_file_continues(tmp_path, capsys):
    input_dir = tmp_path / "input"
    input_dir.mkdir()
    (input_dir / "bad.csv").write_text("item_code,amount\nA,no\n")
    (input_dir / "good.csv").write_text("item_code,amount\nA,1\n")
    db = tmp_path / "db.sqlite3"
    assert run(input_dir, db) == 1
    assert "SUCCESS good.csv" in capsys.readouterr().out
    assert run(input_dir, db) == 1
    output = capsys.readouterr().out
    assert "bad.csv -> PROCESS (NEW)" in output
    assert "good.csv -> SKIP (UNCHANGED)" in output
