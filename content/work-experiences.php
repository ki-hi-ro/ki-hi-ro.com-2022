<?php
/** 本人提供の2026年10月9日付職務経歴書に基づく、担当経験の公開用要約。 */
return array(
    'etl' => array(
        'title' => '既存の処理を読み解き、PentahoからPythonへ移行',
        'period' => '2024.10–2025.06', 'role' => '約10名のチームのメンバー',
        'context' => 'Pentahoの将来的な廃止に伴い、データ抽出・加工・DB更新処理を、既存の設計方針に沿ってPython ETLへ移すプロジェクトに参画しました。',
        'tasks' => array('既存フローと入出力を解析し、データ仕様書・仕様確認シートを作成。', '共通テンプレートのクラス構成を確認し、pandas・NumPyによる加工とSQLAlchemyによるDB処理を実装。JOIN、縦横変換、履歴参照、Upsert、例外ログに対応。', '単体・システムテスト仕様書を作成し、Linux環境でのテストと不具合修正を担当。'),
        'approach' => '移行前後の結果差異を防ぐため、処理を工程ごとに分解し、条件とデータの流れを整理しました。仕様確認から実装・検証・修正まで担当した経験です。',
        'tech' => 'Python / pandas / NumPy / SQLAlchemy / PostgreSQL / Pentaho / Linux / GitLab',
    ),
    'bi' => array(
        'title' => 'Power BIのクラウド移行で、環境差による問題を切り分ける',
        'period' => '2024.04–2024.09', 'role' => '約10名のチームのメンバー',
        'context' => 'オンプレミス環境のPower BIレポートをクラウドへ移行するプロジェクトに参画しました。',
        'tasks' => array('Power Query MによるUTCから日本時間への変換・データ加工処理を修正し、DAXを使用した処理を確認。', 'SharePointのファイル移行に伴うURL変更や、データフローを用いた取得処理の移行に対応。', 'エラー原因を調査・修正し、必要に応じて入力ファイルの修正を依頼。'),
        'approach' => 'タイムゾーン、接続先DB、入力ファイルを順に確認し、環境差による問題を切り分けて設定と処理を修正しました。',
        'tech' => 'Power BI / Power BI Service / Power Query M / DAX / SharePoint / PostgreSQL / Oracle Database / SQL Server',
    ),
    'api' => array(
        'title' => '工場搬送システムで、位置情報と経路を返すAPIを追加',
        'period' => '2025.07–2025.09', 'role' => '開発メンバー',
        'context' => '工場内のAGV（無人搬送車）の搬送経路を管理するシステムで、Python・FastAPIによるAPI機能追加を担当しました。',
        'tasks' => array('既存コードと処理フローを調査し、AGVの位置情報取得を実装。', '幅優先探索（BFS）で現在地から目的地までの最短経路を算出。', '算出した経路をRMSが利用できるJSON形式に整え、REST APIで返す処理を実装。'),
        'approach' => '既存の処理を確認し、位置情報の取得から経路の算出、他システムが使う形式での返却までをつなぎました。',
        'tech' => 'Python / FastAPI / REST API / JSON / Docker / Red Hat系Linux',
    ),
    'web' => array(
        'title' => '制作会社の継続案件で、デザインからWordPressを実装',
        'period' => '2020.03–2022.10', 'role' => 'フリーランスのコーダー・Web制作者',
        'context' => 'Web制作会社からの継続案件を中心に、デザインカンプをもとにしたWeb制作を担当しました。',
        'tasks' => array('HTML・CSS・Sassの実装、レスポンシブ対応、jQueryによる画面動作を実装。', 'WordPressテーマの実装・カスタマイズを担当。LP、EC-CUBE、FutureShopの一部コーディングも経験。', '既存テーマやテンプレートの構造・影響範囲を確認し、表示崩れや不具合、レビュー指摘に対応。'),
        'approach' => 'デザインを形にするだけでなく、既存構造への影響を確認しながら修正・調整を行いました。掲載許可のある案件は開発事例でも紹介しています。',
        'tech' => 'HTML / CSS / Sass / JavaScript / jQuery / PHP / WordPress / MySQL',
    ),
    'maintenance' => array(
        'title' => '就業管理システムで、問い合わせの原因調査と移行を担当',
        'period' => '2025.11–2026.05', 'role' => '約6名のチームのメンバー',
        'context' => '就業管理パッケージの保守運用と、旧システムからの移行を担当しました。',
        'tasks' => array('問い合わせに応じ、SQL Serverのデータ、システム設定、通信状況を確認して原因を切り分け。', '旧システムからのデータ移行を担当。', 'タイムレコーダーの設定・接続確認・通信テストを実施。'),
        'approach' => 'データだけ、設定だけで判断せず、問い合わせの状況から確認する箇所を分け、システムと機器の接続も含めて調査しました。',
        'tech' => 'SQL Server / システム設定 / データ移行 / 通信テスト',
    ),
    'specification' => array(
        'title' => '英語の法規文書と既存仕様を確認し、自動車関連の仕様書を改版',
        'period' => '2023.03–2024.03', 'role' => '仕様書改版の担当メンバー',
        'context' => '居眠り運転防止システムで、欧州法規ADDWへの対応に伴う仕様書改版を担当しました。',
        'tasks' => array('英語の法規文書とSRSを確認し、要求仕様書・システム仕様書・ドライバ状態判定仕様書へ反映。', '変更の影響範囲を確認し、議事録を作成。', 'Jira・Confluenceで情報を管理。'),
        'approach' => '既存の資料と変更内容を照らし合わせ、どの仕様に影響するかを確認して文書に反映しました。',
        'tech' => '仕様確認 / 英語文書の読解 / Jira / Confluence',
    ),
);
