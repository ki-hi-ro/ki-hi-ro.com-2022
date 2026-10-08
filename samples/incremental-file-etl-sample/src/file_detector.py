"""Discover metadata and classify files without reading CSV contents."""
from dataclasses import dataclass
from datetime import datetime, timezone
from pathlib import Path
from typing import Mapping


@dataclass(frozen=True)
class InputFile:
    path: Path
    mtime_ns: int
    size: int

    @property
    def name(self) -> str:
        return self.path.name

    @property
    def modified_at(self) -> datetime:
        return datetime.fromtimestamp(self.mtime_ns / 1_000_000_000, timezone.utc)


@dataclass(frozen=True)
class Decision:
    file: InputFile
    reason: str

    @property
    def should_process(self) -> bool:
        return self.reason in {"NEW", "UPDATED"}


def discover_csv_files(input_dir: Path) -> list[InputFile]:
    """Only direct, regular CSV files; skip symlinks and nested directories."""
    if not input_dir.is_dir():
        raise NotADirectoryError(f"Input directory does not exist: {input_dir}")
    files = []
    for path in sorted(input_dir.iterdir()):
        if path.is_symlink() or not path.is_file() or path.suffix.lower() != ".csv":
            continue
        stat = path.stat()
        files.append(InputFile(path, stat.st_mtime_ns, stat.st_size))
    return files


def classify_files(files: list[InputFile], history: Mapping[str, int]) -> list[Decision]:
    decisions = []
    for file in files:
        previous = history.get(file.name)
        if previous is None:
            reason = "NEW"
        elif file.mtime_ns > previous:
            reason = "UPDATED"
        elif file.mtime_ns == previous:
            reason = "UNCHANGED"
        else:
            reason = "OLDER"
        decisions.append(Decision(file, reason))
    return decisions


def processing_targets(decisions: list[Decision]) -> list[InputFile]:
    return [decision.file for decision in decisions if decision.should_process]
