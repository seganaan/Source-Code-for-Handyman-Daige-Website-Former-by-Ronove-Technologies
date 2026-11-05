<?php
define('WP_AUTO_UPDATE_CORE', 'minor');
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
define('DB_NAME', 'handyma1_handyawp');

/** MySQL database username */
define('DB_USER', 'handyma1_wpuser');

/** MySQL database password */
define('DB_PASSWORD', '~8;7*MpWTd0$');

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
define('AUTH_KEY',         ', q1~B3$X7U^Z$cXh$6bx Mf6K$2r>?~P5d^X{=0!p.`{uY41hV,6o{$@FB%%`0w');
define('SECURE_AUTH_KEY',  'r]0MstOq#AR #j][NnLtOmxeiuk#8bK}D7KxVL[Bo`} qSu^)20>e+k) 9$}4a<V');
define('LOGGED_IN_KEY',    'A`0PG@[ Jy[fS l5/.~7o?%@m1Sfkl|llc?iEJJP7`q/x#?|DLeV##X7r@zS^F#Q');
define('NONCE_KEY',        'Kmp{p*?5++]4_FG>LS`>l.A+y7]-fW+X@{1AFzA(v$G%q(2_[cVcHox|Oxk6wU~&');
define('AUTH_SALT',        'x&@1bl(0)6i/X8rRT4P<:(9^Oq.(R^N!M%3*.u+pm*rDZx1Xr=M>]9Bb8tqQcd37');
define('SECURE_AUTH_SALT', '>Si2]WYy/kGn/vn4:.`JFw]2sc<Z~`)F]4=TCLQ-V^|cqnIDsx3CGlI!XJH4j<VT');
define('LOGGED_IN_SALT',   'Iu|55x_iT1zre?/+ .JBvt_fzPxz7P184]40C`X)M9|PUMn}}b<5h$}>8$&f4g0]');
define('NONCE_SALT',       '`WNxF ;~%`2^;w_X*Vm?R#q}>?^zDr}`v]Zhx[2Q8~]^PRZooZ1INtmRf)rN~~o(');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'hndy_';

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
