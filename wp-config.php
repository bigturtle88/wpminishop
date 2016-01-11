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
define('DB_NAME', 'wp');

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
define('AUTH_KEY',         '|K~>5O5i:7JEETco+ k3xVg?VfSo3hwY{^mg]!fHp-N66hq>`Hd@, f1mOj:v2cw');
define('SECURE_AUTH_KEY',  '(HM#g@#gd1.8^M?Ue@d5TjKA!,g4 N1f2(Nnn+,j$IimVj6TAa!a0 /x32[0Cfv)');
define('LOGGED_IN_KEY',    'x=9NyuMTk;naJ|7NJL@# GcjQlelx77N=W{YrMeD%+QDab|Vg/a(G6}v+U-J*0,|');
define('NONCE_KEY',        'rbf+4,Qv)|jbRiQ[f`KFKH%aIZm-6Q2l6b@P!1{HtIhS3UkDcJ3]2pM8.1yl1fZ1');
define('AUTH_SALT',        '~wm`S8LsEl!*Z?MOHPuj(vIdh/xVxOgl]R>I-/n.,R/m{0&?s4r@i;Ps(rKN:[-(');
define('SECURE_AUTH_SALT', '+51 0R(iI c765w2e `<|B}mr-)I?y|_%.UepAd b+#V=p`F(o1 <Gg*|VXm#w&s');
define('LOGGED_IN_SALT',   '!u;66IprHe hzox>xo*HjR3TbGC@+-z0< Z3I![_TzLqg9<+lNP66rby=QYM|mtm');
define('NONCE_SALT',       '==5e[_|10pgm7rv/p?m`%Iw/z!(jy-{Qf?x&PgM)S[69(|+,0xu`WGTm%W+Q-$M;');

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
