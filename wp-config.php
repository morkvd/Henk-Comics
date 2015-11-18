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
define('DB_NAME', 'capybara_wp');

/** MySQL database username */
define('DB_USER', 'capybara_henk');

/** MySQL database password */
define('DB_PASSWORD', 'henkcomics123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'R++w /1ac.j-F%g @Zb8c$tLt{`ia[~}cTSvs[o<S|KOx%-iaR-.x&GXNDNx,.l}');
define('SECURE_AUTH_KEY',  'P$%(1#ul/y[ |1c 5H6VT04)AgK}Xf9X~s.0*:zr2::nZgrK7W.m_exHvQ,=3B0O');
define('LOGGED_IN_KEY',    'S+w!F.Xz-MbiS>M}%Y}Z^ac|u`?SaF]96fy6Gu%5h0M5t+ipGkTfXT1[pc,yM2$}');
define('NONCE_KEY',        'bfd*,p7r(-~5n-Edk#p)J3VOowqMR+y~O+1,7+q[iXH5)ci`9gu~AV3weg$q74rN');
define('AUTH_SALT',        '+=1!bb7/-~^f[QniZ,UnChj`,4_UG=U&c[e4GY1Mm+.l3m:[<N)(x%@O3ZaiY`gj');
define('SECURE_AUTH_SALT', 'gt91@zr9mHPLs#K>OoZK>`F_|{DRaAS4AKj2&g9HxD`N~&Np/5TAhXuMtz+|Q&r|');
define('LOGGED_IN_SALT',   'P?|{YL|(8V71A<i%D5*[T7-lgFLnR&XE8q4Eb,:&P<:r70az@uj2K1dR*>pZ(~YZ');
define('NONCE_SALT',       '5>Kc&4fNzyqTu(@OO]O:nIN-$Qaof?Y{[g# xOq+G=I)q{#,0(KoB2nC&j;XNt;l');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'cmswp_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
