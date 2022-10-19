<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u585144271_21q50' );
/** Database username */
define( 'DB_USER', 'u585144271_9Hcrm' );
/** Database password */
define( 'DB_PASSWORD', 'BOeexLBbBo' );
/** Database hostname */
define( 'DB_HOST', 'mysql' );
/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'my!]{(YrT3rgpL!Ck1%Af}H 50.zTJ,]TPC6 5r ?^+dZ#F5DXwsx|BK@fL0&Va~' );
define( 'SECURE_AUTH_KEY',   'z?1jX;>}RUq( EFb7`x%1!?n.(3-*/kc_<g<$mk?skLU$!.Tp(uW(6sTp=U!S@>j' );
define( 'LOGGED_IN_KEY',     ']R[Q,#tcWL^-(d]IJAKC4JT%HU%bG*JaV7vt:H]uA[K&s__G*q /AcT1+bbz6E/]' );
define( 'NONCE_KEY',         'KF?H%ny;(5(=&V!_TMj7M3~an?,14@.OH0(Cprk`l38@k+1)Hz?<]SZ ZmRg{ n?' );
define( 'AUTH_SALT',         '(5/H:vK9f&6dCV=w_n^J.LCkHBe57&1tCdn4f&:7p]rt..x351F)aYR)Kt(YDr%A' );
define( 'SECURE_AUTH_SALT',  'o~TB.(i>%I`orZ;uVl]`rg);eCz5~HUbSC)EZ@|jPQh.t,?]rF {:b6VsiNsKH}8' );
define( 'LOGGED_IN_SALT',    '#ysz@Kl}rzhm`,MTHE+t89pCa._3OXc|JQNOiwT~m[26(gYcl;(MY#CK/O+nTX[)' );
define( 'NONCE_SALT',        '&8I{7u5@:Z]@.Ia=.+>E+r29kwh5%Ez gq<]e>UCTxcxH&XPbsZs!YZYs;Ve`aqg' );
define( 'WP_CACHE_KEY_SALT', '4)Pu<z6Chh#~T2%1sdcwQeW7IP!8yVT<JqIGJk8U7{//G8$:PDMrys*Ni_:_E~_h' );
/**#@-*/
/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
/* Add any custom values between this line and the "stop editing" line. */
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';