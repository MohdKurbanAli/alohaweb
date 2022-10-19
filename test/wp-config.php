<?php
define('WP_CACHE', false); // Added by WP Rocket

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
define( 'DB_NAME', 'u585144271_5cYez' );

/** Database username */
define( 'DB_USER', 'u585144271_CXDwo' );

/** Database password */
define( 'DB_PASSWORD', '2Y3ezi2KtS' );

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
define( 'AUTH_KEY',          'h.oJhJ3r-sI3s8zh*^2C/wr2 ei=#8Rc%pEe6%=><Wx$&dtmLRkye:K8xnV[Jf3A' );
define( 'SECURE_AUTH_KEY',   '8F$x_O(H*3:s>5[1>e|1[!b@D[EJAF`&.(-i-#q:%ZcEV?EG2g.yk{~5J#:zJOVH' );
define( 'LOGGED_IN_KEY',     'n8`itV_:XlAH679cx%C@?]Zqi>?IBz,>I$<;V)of,hMY1~`e|I*$viN,!U~0`$qL' );
define( 'NONCE_KEY',         '+;NA|vWQa;MAl8XshL.PZ8OnRq%<tSWE/:,L1c8OlBqnq8Kao4P2xtucreky9r_=' );
define( 'AUTH_SALT',         'Gz=,v@3EBX~|)Jb5-YJo>C#Snt$7ye},,s_%f/E,yfUnw3s)ncVyzLPMhU +m:VK' );
define( 'SECURE_AUTH_SALT',  '0]Cs_IGk~6-;>[NkcfQ;}+7jE-&XqB=UB|X{I~|~+:f-KNb,+n>3GtIgbpkSmXnc' );
define( 'LOGGED_IN_SALT',    '5D^~EFD?suSWC!52:sp!V0zNF)g/,Vv+Z)XtWYn=fK76rHBmjCA[}I1,]7JJ}`4F' );
define( 'NONCE_SALT',        '}D3ri5&^glZ[52gHkBgnQ!/XQZ{,0H&-VVBGZ=B`>m%4]E&%D1j&RA1457={r0x#' );
define( 'WP_CACHE_KEY_SALT', 'fXi)!+N|1 IL:(X^Ej>UrkWYt$L?fN)wq]LH3(>gUG<b]*%yZ8xE)/tNnia,{zQ0' );


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
