"""SQLite history persistence; the caller owns transaction boundaries."""
import sqlite3
from datetime import datetime, timezone
from typing import Iterable

SCHEMA = """
CREATE TABLE IF NOT EXISTS ingestion_history (
    file_name TEXT PRIMARY KEY,
    mtime_ns INTEGER NOT NULL,
    processed_at_utc TEXT NOT NULL,
    row_count INTEGER NOT NULL CHECK (row_count >= 0)
);
CREATE TABLE IF NOT EXISTS sales_records (
    source_file TEXT NOT NULL,
    row_number INTEGER NOT NULL,
    item_code TEXT NOT NULL,
    amount INTEGER NOT NULL CHECK (amount >= 0),
    PRIMARY KEY (source_file, row_number)
);
"""


class HistoryRepository:
    def __init__(self, connection: sqlite3.Connection):
        self.connection = connection

    def initialize(self) -> None:
        self.connection.executescript(SCHEMA)

    def fetch(self, names: Iterable[str]) -> dict[str, int]:
        """Batch queries avoid one query per file and SQLite parameter limits."""
        names = list(names)
        result = {}
        for start in range(0, len(names), 500):
            batch = names[start:start + 500]
            placeholders = ",".join("?" for _ in batch)
            rows = self.connection.execute(
                f"SELECT file_name, mtime_ns FROM ingestion_history WHERE file_name IN ({placeholders})",
                batch,
            )
            result.update(rows)
        return result

    def record_success(self, name: str, mtime_ns: int, row_count: int) -> None:
        self.connection.execute(
            """INSERT INTO ingestion_history VALUES (?, ?, ?, ?)
            ON CONFLICT(file_name) DO UPDATE SET
                mtime_ns=excluded.mtime_ns,
                processed_at_utc=excluded.processed_at_utc,
                row_count=excluded.row_count""",
            (name, mtime_ns, datetime.now(timezone.utc).isoformat(), row_count),
        )
