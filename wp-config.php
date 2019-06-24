<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'emmaqgwu_wordTestEmma');
/** MySQL database username */
define('DB_USER', 'emmaqgwu_emma_heidars');
/** MySQL database password */
define('DB_PASSWORD', 'Vietnam2');
/** MySQL hostname */
define('DB_HOST', 'server246.web-hosting.com');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');
/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '}H4.NVpf<Dtl}4R6:pCU3pr}6k!tRTKqR_f%o1f sdn0-*5;;x_Qk,+O]-a6ed*~');
define('SECURE_AUTH_KEY',  'P0fH=G[m?!]?u*pcIt/7hbws0#/,eN5T 6Pk|4?-ZvqcG^BItc,pb&&<KVw@6#>r');
define('LOGGED_IN_KEY',    'Vi7-Pm7jyD0KFIT2NR9q,$ma{*KIyOaNlZ+|>:pD~;,ayAC7MxxW( D!3y,}w.KH');
define('NONCE_KEY',        '=?{tF@au`{:-(*]D&{!sG9snGlw[F]:[jl>AXCl+.yGMB0{7Q!;!uAa|v3^89|&)');
define('AUTH_SALT',        'J:rw!=H}:d&OaD#HU=tF.h4Y+cF+$E9YAJ2Dnw:cwJp@$VnOtbFi)7QZpO1jT2B)');
define('SECURE_AUTH_SALT', '>@xROtkkQq=Y/|kS?2&L|{[P>Z&+P+t(AD=e cwOlRYc2)TOP^tI{q&|#Z|}C%LJ');
define('LOGGED_IN_SALT',   'Z0,f+)lpyxT~&tF+.86yoK2JH/+a+krYOLyE4%KZZ73#!o}]Mad54oyv/ji}%P,e');
define('NONCE_SALT',       '*nLMR,XF-ySG)D9Lk-bTCEt<Dt0{n9-Vu&;?C}P?_LWAjzd.}g.c.m:A<0/ZtyPV');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'xyz77_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('WP_HOME','https://emmaheidarsdottir.info');
define('WP_SITEURL','https://emmaheidarsdottir.info');
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
