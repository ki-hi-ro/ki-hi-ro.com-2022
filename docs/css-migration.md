# CSS移行方針

`style.css` は過去ページを含むレガシー互換層として残し、新規・修正対象から順に以下へ移す。

1. `foundation/variables.css`: 色、余白、角丸、幅などの共通値
2. `base.css`: 要素セレクタと共通タイポグラフィ
3. `container.css`: レイアウト
4. `article-list.css`: 投稿一覧カード
5. `sidebar.css`: 検索、年月、サイドバー
6. `random-insert.css`: ランダムコンテンツカード
7. `single.css`: 個別投稿

移動時は1コンポーネント単位とし、PC 1280px・SP 375pxの比較後に元の定義を削除する。WordPressが動的に付与するクラスが多いため、自動Purgeだけで削除しない。
