"""Validate selected CSVs and atomically replace their rows + success history."""
import sqlite3
import pandas as pd
from .file_detector import InputFile
from .history_repository import HistoryRepository


def process_file(file: InputFile, repository: HistoryRepository) -> int:
    connection = repository.connection
    # Lock before reading; this sample assumes one worker and an immutable input during a run.
    connection.execute("BEGIN IMMEDIATE")
    try:
        before = file.path.stat()
        if (before.st_mtime_ns, before.st_size) != (file.mtime_ns, file.size):
            raise RuntimeError(f"File changed after discovery: {file.name}")
        frame = pd.read_csv(file.path, dtype=str, keep_default_na=False)
        if list(frame.columns) != ["item_code", "amount"]:
            raise ValueError("Expected columns: item_code,amount")
        codes = frame["item_code"].str.strip()
        amounts = frame["amount"].str.strip()
        if codes.eq("").any() or not amounts.str.fullmatch(r"[0-9]+").all():
            raise ValueError("item_code is required; amount must be a nonnegative integer")
        values = [int(value) for value in amounts]
        if any(value > 2**63 - 1 for value in values):
            raise ValueError("amount exceeds SQLite integer range")
        after = file.path.stat()
        if (after.st_mtime_ns, after.st_size) != (file.mtime_ns, file.size):
            raise RuntimeError(f"File changed while reading: {file.name}")
        connection.execute("DELETE FROM sales_records WHERE source_file = ?", (file.name,))
        connection.executemany(
            "INSERT INTO sales_records VALUES (?, ?, ?, ?)",
            [(file.name, index, code, value) for index, (code, value) in enumerate(zip(codes, values), 1)],
        )
        repository.record_success(file.name, file.mtime_ns, len(frame))
        connection.commit()
        return len(frame)
    except Exception:
        connection.rollback()
        raise
