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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'handyma1_wp246' );

/** MySQL database username */
define( 'DB_USER', 'handyma1_wp246' );

/** MySQL database password */
define( 'DB_PASSWORD', ')@S280N5pK' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'LXJ#u]4,#}P:<Ef|hAkiog gni&+q8~:q}UHK/wHP2W>?HWn(+tM(pheCj#L:!A1' );
define( 'SECURE_AUTH_KEY',  '@n/43|om*F ;SMIS,n{ l@en%|3T~Oh2[D}H0bdf>axN;y09^bs2!Yr+xe%IDPx=' );
define( 'LOGGED_IN_KEY',    'r@?HnIzSzog;b(a/oXj+$9U^F/0DB?P3A}d2Q(~N<H7Z?.EKQ2NT}E1%R|.G}i7D' );
define( 'NONCE_KEY',        'f+&gIt@<44r0ZDJPhCJ$<]^OmI>!S*o[m@!g<oq#[xgD)Adb|F6t~=N[DEBjSVF7' );
define( 'AUTH_SALT',        'nFidfw lwzz+6le5UGvGz.*=tJ#5KRhq!Gv/A6i;}Q/<`#5q2O=Px.DR9qYkw)G`' );
define( 'SECURE_AUTH_SALT', '^hPiY}0m~|fhx=YxugB+d#;g>Cwf3T0|&7~2^HYma~@t4d3(J3_Q#[=o-=D[QmT4' );
define( 'LOGGED_IN_SALT',   '7m?1ZCtpsO2[8@&|DHzJd1gRj(BmRrnW(F`F@I0fuL;*CsHS.]U]e!Cstq%Sl<uH' );
define( 'NONCE_SALT',       'bWahscuJ40S63h{Z $oS/eD(m90ySIJ%/:/zICSUUbA?<q_q^eZ;]TjNt<8a~B90' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
