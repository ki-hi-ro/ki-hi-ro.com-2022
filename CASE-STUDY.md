# CASE STUDY

## 初期ページの作成

1. WordPress管理画面の「ツール → CASE STUDYのセットアップ」を開く。
2. 「初期ページを作成」で一覧と3件の詳細を下書きとして作成。
3. 本文・抜粋を確認し、一覧と詳細ページを公開する。

一覧は `/case-study/`。詳細はその子ページです。一覧公開時にヘッダーへCASE STUDYとARTICLESを追加し、公開済みのabout/contact-usページがあればリンクも表示します。

再実行しても既存本文は上書きしません。別テンプレートのページが同じパスにある場合は作成を止めます。本文はブロックエディターで編集でき、テーマ更新時に上書きされません。

## 事例の追加

固定ページの親をCASE STUDY、テンプレートを「CASE STUDY — 詳細」に設定し、紹介文を抜粋へ入力します。公開した子ページが一覧へ表示されます。順序は固定ページの順序とIDで決まります。

## 原稿の根拠

- https://github.com/ki-hi-ro/welfare-wage-report-sample
- https://github.com/ki-hi-ro/excel-csv-data-cleaner

2026-10-06時点の公開READMEと提供された構成案を参照。受託・導入済み実績や未計測の削減効果を主張しません。クリーナーは現在Excel入出力として紹介します。

初期原稿は `content/case-studies.php`。公開様式やCrowdWorksの画面画像はテーマへ転載していません。

新規ETLサンプルは `samples/incremental-file-etl-sample/` に格納しています。GitHub公開後は `content/case-studies.php` のincremental-file-etlのrepoへ実際のURLを設定し、既に作成済みの固定ページ本文にもリンクを追加してください。
