# Yomogi web fonts

Source: https://github.com/google/fonts/tree/main/ofl/yomogi
Author: The Yomogi Project Authors (https://github.com/satsuyako/YomogiFont)
License: SIL Open Font License 1.1; see OFL.txt.

Yomogi-Regular.ttf was converted with fontTools to WOFF subsets, preserving
its regular weight and glyph shapes:

- yomogi-latin.woff: supported code points U+0000–024F.
- yomogi-japanese.woff: all remaining supported code points.

The matching CSS unicode-range declarations load the Japanese subset only
when the title contains characters outside the Latin subset. Serve both files
from this theme; no external font service or locally installed font is needed.
