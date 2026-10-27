<?php
/** トップページの課題別記事と、記事冒頭へ反映する読者向けの案内。 */
return array(
    21845 => array(
        'title' => 'Excelの転記作業を減らしたい方へ｜Pythonでファイル一覧を出力する方法',
        'heading' => 'Excelの転記作業に時間がかかる方へ',
        'topic' => 'EXCEL / PYTHON',
        'summary' => 'まずは小さな作業から。フォルダ内のCSVファイル名をExcelへ一覧出力する例と、PythonでExcelを扱い始めたときの記録を紹介します。',
        'intro' => <<<'HTML'
<section class="article-reader-guide" aria-label="この記事の読み方">
<h2>Excelの転記作業に時間がかかる方へ</h2>
<p>ファイル名を一つずつExcelへ入力するなど、同じ操作を繰り返していませんか。私自身、業務でファイル名の転記に約3時間かかり、Pythonで作業を減らせないかと考えたことが、この記事の出発点です。</p>
<p>最初から業務全体を自動化するのではなく、まずは「フォルダ内のCSVファイル名をExcelへ出力する」という小さな例から始めます。Web画面から情報を取得する処理は、この例には含みません。</p>
<h3>まず試せる例：CSVファイル名をExcelへ一覧出力する</h3>
<ol><li>作業用フォルダに<code>input</code>フォルダを作り、一覧にしたいCSVファイルを入れます。</li><li>Pythonを実行する環境にopenpyxlを用意します。インストールする場合は<code>python3 -m pip install openpyxl</code>を使います。</li><li>次のコードを<code>file_list.py</code>として保存し、作業用フォルダから<code>python3 file_list.py</code>で実行します。</li></ol>
<pre><code class="language-python">from pathlib import Path
from openpyxl import Workbook

input_dir = Path("input")
output_path = Path("file_list.xlsx")

if not input_dir.is_dir():
    raise FileNotFoundError("inputフォルダを作成してください")
if output_path.exists():
    raise FileExistsError("file_list.xlsxは既にあります。移動するか出力名を変更してください")

workbook = Workbook()
sheet = workbook.active
sheet.title = "ファイル一覧"
sheet.append(["ファイル名"])

for path in sorted(input_dir.glob("*.csv")):
    if path.is_file():
        cell = sheet.cell(row=sheet.max_row + 1, column=1, value=path.name)
        cell.data_type = "s"

workbook.save(output_path)
print(f"{sheet.max_row - 1}件のファイル名を{output_path}へ出力しました")</code></pre>
<p><strong>確認すること：</strong><code>file_list.xlsx</code>の「ファイル一覧」シートに、1行目の見出しと、2行目以降のファイル名が入っていることを確かめます。対象は<code>input</code>直下の拡張子が<code>.csv</code>のファイルです。元のCSVの中身は変更しません。CSVがなければ、見出しだけを出力します。</p>
<p>同名の出力ファイルがある場合は、上書きせず停止します。実際の業務へ広げるときは、何を取得し、どの列へ書き、何をもって完了とするかを整理することが次の一歩です。</p>
<p>参考：<a href="https://openpyxl.readthedocs.io/en/stable/tutorial.html">openpyxl公式チュートリアル</a></p>
</section>
HTML
    ),
    28408 => array(
        'title' => 'CSVの新規・更新ファイルを見分けたい方へ｜pandas・SQLによる判定の実践記録',
        'heading' => 'CSVを毎回すべて処理している方へ',
        'topic' => 'CSV / DATA PROCESSING',
        'summary' => '取り込み履歴とファイルの最終更新日時を比べ、新規・更新ファイルを判定する考え方を、サンプルと期待結果で解説します。',
        'intro' => <<<'HTML'
<section class="article-reader-guide" aria-label="この記事の読み方">
<h2>CSVを毎回すべて処理している方へ</h2>
<p>「前回から増えたファイルだけ取り込みたい」「更新されたCSVを人の目で選んでいる」。そんな作業を見直すための一つの考え方が、取り込み履歴とファイルの最終更新日時を比べる方法です。</p>
<p>この記事では、PentahoからPythonへのETL移行業務で出会った処理をもとに、pandasとSQLiteを使ったサンプルを読み解きます。業務データをそのまま掲載したものではありません。</p>
<h3>この記事で分かる判定の考え方</h3>
<ul><li><strong>履歴にないファイル：</strong>新規の処理対象にします。</li><li><strong>履歴より最終更新日時が新しいファイル：</strong>更新分の処理対象にします。</li><li><strong>履歴と同じ、または古い日時のファイル：</strong>このサンプルの判定では処理対象から外します。</li></ul>
<h3>実際の業務へ使う前に確認したいこと</h3>
<p>ここで扱うのは<strong>処理対象ファイルの判定まで</strong>です。データの取り込み本体や、処理後の履歴更新は含みません。ファイル名だけで同じファイルを識別できるか、日時の扱いがそろっているか、取り込み成功をどの時点で履歴へ残すかも整理します。</p>
<p>本文の検証は、入力ファイルと履歴レコードがある状態を前提にしています。初回で履歴が空の場合、入力が0件の場合、処理失敗後にやり直す場合は、追加の分岐と動作確認が必要です。本文には、確認に使った条件・期待結果・全ソースコードを載せています。</p>
</section>
HTML
    ),
    3666 => array(
        'title' => 'サイト変更後、フォームが送れずお困りの方へ｜ドメイン移管時の不具合対応記録',
        'heading' => 'サイト変更後、フォームが送れない方へ',
        'topic' => 'WEB / MAINTENANCE',
        'summary' => 'ドメイン変更後に問い合わせフォームが動かなくなった経験から、原因の確認と、納品前のチェックについて振り返ります。',
        'intro' => <<<'HTML'
<section class="article-reader-guide" aria-label="この記事の読み方">
<h2>サイト変更後、フォームが送れない方へ</h2>
<p>ページは表示できるのに、問い合わせフォームだけ送れなくなった。この記事は、私がドメイン変更を伴うサイト対応で実際に経験した不具合の記録です。</p>
<p>このときは、フォームに使っていた「メールフォームプロCGI」の実行権限が変わっていたことが原因でした。知り合いのエンジニアの協力を得て復旧し、納品前の確認手順を見直すきっかけになりました。</p>
<h3>同じような状況で整理したいこと</h3>
<ol><li><strong>変更前後を整理する：</strong>ドメイン、サーバー、設置場所など、何を変更したかを控えます。</li><li><strong>どこで止まるかを確かめる：</strong>フォームの入力、送信後の画面、受信先への到着を分けて確認します。</li><li><strong>フォームの方式を確認する：</strong>CGI、WordPressのプラグイン、外部サービスなど、何が動かしているかを確認します。</li><li><strong>復旧後まで確認する：</strong>テスト送信と受信確認を行い、変更内容・確認結果をチェックリストへ残します。</li></ol>
<p>本文にある権限設定は、当時のCGI環境での対応です。すべてのフォームに同じ設定を適用するものではありません。原因が分からないときは、変更履歴と症状をまとめ、サーバーやフォームの担当者へ相談する材料にしてください。</p>
</section>
HTML
    ),
);
