# 本番データのローカル同期

エックスサーバー → このMacのMAMPへ、ユーザーが明示的にデータベースの取り込みを指示したときだけDBを取り込みます。定期実行や自動再試行は行いません。画像は本番のuploads URLで表示し、画像ファイルの転送は行いません。本番のDB・ファイルへの書き込みは行いません。テーマ・プラグイン・wp-config.phpは同期対象外です。ローカルの記事・固定ページ・ユーザー・設定は本番の内容で置き換わります。

2026-10-09に初回DB同期が完了しました。2026-10-11にユーザーの指示でlaunchdの定期実行を解除し、登録ファイルを削除しました。今後は取り込みの指示があった場合だけ実行し、定期実行を再登録しません。

## 接続の準備

1. エックスサーバーのサーバーパネルで「SSH設定」を有効にし、公開鍵を登録します。接続ポートは10022です。
   公式手順: https://www.xserver.ne.jp/manual/man_server_ssh.php
2. `scripts/sync/ssh-config.example` を参考に `.local-sync/ssh-config` に接続設定を作成します。サーバーID、ホスト名、秘密鍵のパスを実際の値にします。秘密鍵はGitに入れません。このファイルがある場合は同期処理が優先して使用し、ない場合は通常の `~/.ssh/config` を使います。
3. ターミナルで `ssh -F .local-sync/ssh-config production-wordpress` を一度実行してホスト鍵を確認します。パスフレーズ付きの鍵はssh-agentへ登録し、`ssh -F .local-sync/ssh-config -o BatchMode=yes production-wordpress true` が入力なしで成功する状態にします。保存したホスト鍵は次回以降厳密に照合します。
4. 本番でWP-CLIが使えるか確認します。`wp` がない場合はWP-CLIをホームディレクトリへ置き、`remote_wp_command` を `["php", "/home/SERVER_ID/wp-cli.phar"]` 等に変更します。本番のWP-CLI導入はまだ行っていません。
   公式手順: https://make.wordpress.org/cli/handbook/guides/installing/
5. `.local-sync/config.json` の `ssh_host` と本番のWordPress・uploadsの絶対パスを設定します。例の `/home/ACCOUNT` は実際のサーバーIDに置き換えてください。WordPressは `wp-config.php` のあるディレクトリを指定します。パスは空白なしを前提とします。

ローカルWP-CLIは `.local-sync/wp-cli.phar` に保存します。サンプル設定はMAMP PHP 8.3.30用です。バージョンを変更する場合は `local_wp_command` も変更してください。

このMacでは、本番の `wp` が古い既定PHPで実行されるため、`remote_wp_command` を `["/usr/bin/php8.3", "/usr/bin/wp"]` に設定しています。本番のWeb用PHP設定は変更しません。

## 指示を受けて取り込む手順

ユーザーから取り込みの指示を受けたら、MAMPのMySQLが起動している状態で、テーマディレクトリで実行します。

```sh
python3 scripts/sync/production_pull.py
python3 scripts/sync/production_pull.py --apply
```

最初のコマンドはDBの接続先・URL・プレフィックスと、DBバックアップ用の空き容量を検査します。DBの取り込みや画像の更新はしません。`--apply` が実際の同期です。失敗した場合は原因を報告し、定期的な再試行は行いません。

```sh
python3 scripts/sync/schedule.py generate  # plistだけ生成
python3 scripts/sync/schedule.py remove    # 自動実行を停止
```

ログは `.local-sync/sync.log` と `.local-sync/sync-error.log` です。ログの自動通知はありません。

## バックアップと失敗時の復旧

現在の設定は `media_mode: remote` です。DB用に最低2GiBの空き容量を確認し、記事本文・JSON・シリアライズデータ中のuploads URLを本番URLのまま保持します。添付画像の生成URLも `upload_url_path` を本番のuploads URLに設定して対応します。画像の閲覧にはネットワーク接続が必要です。ローカルからメディアを新規アップロードしても本番には転送されません。

同期ごとに `.local-backups/sync-日時/` に本番SQL、更新前のローカルSQLと `status.json` を保存します。バックアップが完了してからローカルを更新します。DB取り込み以降の失敗時には更新前SQLへ自動復旧を試みます。成功した同期バックアップは直近3世代（`keep_backups`）を保持します。失敗した同期や、この仕組み以外で作成したバックアップは自動削除しません。

ローカルで編集を止めた状態で同期してください。DBはローカル独自のテーブルを削除しません。画像は本番にある最新のファイルを参照します。

DB内のURLはシリアライズデータを扱えるWP-CLIで変換し、GUIDは保持します。`home` / `siteurl` はローカル値、検索エンジン公開設定は無効にします。DB_HOSTがlocalhost/127.0.0.1、WP_ENVIRONMENT_TYPEがlocal、DISABLE_WP_CRONがtrueであることを必須にしています。現在のローカル設定はlocal・cron無効です。同期後は本番のプラグイン設定・ユーザーも取り込まれます。メールや外部APIを使うプラグインはローカル側での扱いを確認してください。プラグインファイルは同期しないため、本番とのバージョン互換性も必要です。マルチサイトは対象外です。

`.local-sync/` と `.local-backups/` はGit・FTP配信の対象外です。同期スクリプトとこの説明書もFTP配信から除外しています。

## 全画像をダウンロードする方式への変更

十分な容量を確保して `media_mode` を `download` にすると、uploadsも取り込み、更新前uploads全体をバックアップします。この方式では必要容量を本番の画像総量＋SQL等の5GiBとして検査します。本番uploadsは約29GBのため、現在のMacでは不足します。ローカルにだけある画像は削除せず、転送失敗時にはDBを取り込みません。
