<?php
/**
 * WordPress の基本設�?
 *
 * こ�?�ファイルは、インスト�?�ル時に wp-config.php 作�?�ウィザードが利用します�?
 * ウィザードを介さずにこ�?�ファイル�? "wp-config.php" と�?�?名前でコピ�?�して
 * 直接編�?して値を�?�力してもかま�?ません�?
 *
 * こ�?�ファイルは、以下�?�設定を含みます�?
 *
 * * MySQL 設�?
 * * 秘�?鍵
 * * �?ータベ�?�ス�?ーブル接頭�?
 * * ABSPATH
 *
 * @link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注�?:
// Windows の "メモ帳" でこ�?�ファイルを編�?しな�?でください !
// 問題なく使える�?キストエ�?ィタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参�?�)
// を使用し、�?�? UTF-8 の BOM な�? (UTF-8N) で保存してください�?

// ** MySQL 設�? - こ�?��?報はホス�?ィング先から�?�手してください�? ** //
/** WordPress のための�?ータベ�?�ス�? */
define('DB_NAME', 'wordpress');

/** MySQL �?ータベ�?�スのユーザー�? */
define('DB_USER', 'root');

/** MySQL �?ータベ�?�スのパスワー�? */
define('DB_PASSWORD', 'root');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** �?ータベ�?�スの�?ーブルを作�?�する際の�?ータベ�?�スの�?字セ�?�? */
define('DB_CHARSET', 'utf8mb4');

/** �?ータベ�?�スの照合�??�? (ほとんどの場合変更する�?要�?�ありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニ�?�クキー
 *
 * それぞれを異なるユニ�?�ク (一�?) な�?字�?�に変更してください�?
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘�?鍵サービス} で自動生成することもできます�?
 * 後で�?つでも変更して、既存�?�すべての cookie を無効にできます。これにより、すべてのユーザーを強制�?に再ログインさせることになります�?
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'sU%j&{9GY0GgB7Ut-MqL/bS.RUdUrXR(|s)5(-P9/]g58C;6uUp~djG)|Bq|a= ~');
define('SECURE_AUTH_KEY',  '_)OF6ifnb5:^!1H30]gB8C9n+]hSxys!z}na}cua/D415LoG2^{-eN1Y69dJ[X4.');
define('LOGGED_IN_KEY',    'Mtm;n=u>2QFC}&^j!]!orVdUhD^YvgyL3N9LAGg$P1[-o{O`;4<A6JI?#Ej{PC)?');
define('NONCE_KEY',        'yBD/V01|a]#|oK1rf49QuaUJ1+N2bP#h ]BS!^Ivha+g0[G9C)$v5fc#+9YZnsd+');
define('AUTH_SALT',        '51{Z*@J/3,q{o0RvHgiHs*Z9np]yYTJ&HQ,[{t~3>V2_%#H?n6g7i)y{S-?mm,Z!');
define('SECURE_AUTH_SALT', '7GaZp osjyg^_U-JmPJ!-prUN_8J05{CVe|d]q^Hdy`q*)bhYx:$V)-D(U0~8.ML');
define('LOGGED_IN_SALT',   'a~aBb^Bv+b_X-y=Y-[~*8J(<=9VAkS/X|p#W_r!OBbB4Qe;+3,@7chDtE]?M42&V');
define('NONCE_SALT',       '^3sxh/Nz8 :$j)9a{6OPF/^)GGKsRWnG&yaIaA~*#H$k-|N/0+CC{R(IDW-JQ|Ej');

/**#@-*/

/**
 * WordPress �?ータベ�?�ス�?ーブルの接頭�?
 *
 * それぞれにユニ�?�ク (一�?) な接頭辞を与えることで一つの�?ータベ�?�スに�?数の WordPress �?
 * インスト�?�ルすることができます。半角英数字と下線�?�みを使用してください�?
 */
$table_prefix  = 'wp_';

/**
 * 開発�?へ: WordPress �?バッグモー�?
 *
 * こ�?�値�? true にすると�?開発中に注�? (notice) を表示します�?
 * �?ーマおよ�?�プラグインの開発�?には、その開発環�?においてこ�?� WP_DEBUG を使用することを強く推奨します�?
 *
 * そ�?�他�?��?バッグに利用できる定数につ�?ては Codex をご覧ください�?
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', true);

/* 編�?が�?要なのはここまでで�? ! WordPress でブログをお楽しみください�? */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
