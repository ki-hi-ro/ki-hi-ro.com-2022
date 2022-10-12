<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'xs437226_vsm7r' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'xs437226_g0svl' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'qk9egwlysq' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'mysql10018.xserver.jp' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'AUl7.3EIf:2]k$QG)=6}D8(95$04~Qs?K*lI<@=nG/jP4w8qY-V]? Vh8.J2@Gi$' );
define( 'SECURE_AUTH_KEY',  'S{X:@nMUU<&k`H~~&iD`Pp1$T1B%Sqik:>` swJ6apq|EL{Q+lzj5yuA0`+ Fgl?' );
define( 'LOGGED_IN_KEY',    'q5xYOLmH,[Ar{ub26;e<P3K:(?> @a|VHjE/%,ci0(mI )4rq3$Oc~Xk)b}JGnMB' );
define( 'NONCE_KEY',        ']G^He?i-MSh~0w$=k&yzE%XY2M9&c^&VLg.7AGm@(r*zNjj@cTyx8~!I`]AIkFzB' );
define( 'AUTH_SALT',        'r D6P}D5IdVDou[~Mne%,nx#-S|Lxbc@g<>Z=gh2rTg4t233(0kV+o2eb|!f$W6<' );
define( 'SECURE_AUTH_SALT', 'f:6_:HT{sfIkl+>+Xz{7dNOtK_<ghSe.V=*<..Eh}fDhJ.E3.b]sTId>ti_S*=%`' );
define( 'LOGGED_IN_SALT',   'CJ;{uY?tIR>&?-x/5W`i`F]agZp~Cc^RWvyXm7(154[k:,i~H&EZ:7|vnTdmhnBv' );
define( 'NONCE_SALT',       '8qzH_d?-A&cT9?t0=o#gRFPq[F!UmybZk6(^GH?v:;]&N&3?B:7z&Sz8a(MJZ ;W' );
define( 'WP_CACHE_KEY_SALT','lL_T4{iSaGEREh#lLZx*3YGDY)1)t23L2}+#)w25i~v*1^ziM{WO:mEnE]-/2bQ_' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* カスタム値は、この行と「編集が必要なのはここまでです」の行の間に追加してください。 */


/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */


/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

update_option('siteurl', 'https://ki-hi-ro.com/ki-hi-ro.com-2022');
update_option('home', 'https://ki-hi-ro.com');