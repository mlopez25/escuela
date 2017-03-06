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
define('DB_NAME', 'actividades');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'ZP[6It5^`VwWEp-`4]Vc]t+UGY5_xT0A  i9N^$72;d%<,:.,JI)CnS@C%.QVPph');
define('SECURE_AUTH_KEY',  'DS[E4_A~/QGnUwRYyC+wOoth~y{bE^|(q%Aqxm;BTX%TiA&KCnMiWrCMbCA,XJfw');
define('LOGGED_IN_KEY',    '~;{.XVJOlytV8r/*S^Lp=V0j.7[2YE9SoMUjW0q)R1ET ??QPaJ,:otCF]bRWj) ');
define('NONCE_KEY',        '.AO=*mkM] 7)1U$8/9/^yH9A[B%CTZu<i93YrNeg#_qm:4CF96.Yc[TpP 2Wp+jR');
define('AUTH_SALT',        'wCBPc4&mL)x8?Seas}@x(J5Es6O{uO+cA;-gNFyNEN6@jPpS4!8N4#(1J[Sk%@0o');
define('SECURE_AUTH_SALT', 'd8%3[u{OMz?Z.*Nrm,]z0;fey[A`cZ5y1VDJf{V%DuBI)V)QFKJ#^.ytU[qTOAS-');
define('LOGGED_IN_SALT',   ']1<1G4uj &wAu4&85,@u_#N5qtExp1u+WMdEkt9r8Vnh<P|Z=3?qU2pX:33[D=_F');
define('NONCE_SALT',       '5n!mL;!`DO&JxcX`bv42{$wd;h<v{b1zd7p<qPo`sPZZ.<]v/&$12NQF{X#U18*J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

define('WPLANG', 'en_US');