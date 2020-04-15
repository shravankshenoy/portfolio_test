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
define( 'DB_NAME', 'testwordpressdb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         ')4wuoA+qsv_mOvUWiirfk3YD$[:26SyS&HwJ+nN+yDm.01Z4}}2{@^#lF.;8Xc*a' );
define( 'SECURE_AUTH_KEY',  '9&UkRio^Kianx2,0J_Q=y$a7}86cnF3R*c81oe*G7Q|4LS 4$I? t{DXh,6z`6.T' );
define( 'LOGGED_IN_KEY',    'Z`6O11e$+4LjBI#%i8A%/.*0q>9G!)C%%ek#FTL/DeyE).4^>)n{dAC}>y^ND,jH' );
define( 'NONCE_KEY',        'x]CVQ,qsN@04S^cutJM-+o*6O1iJ!< qyQ~LEJA:!+AlA@*E<9#oDl}`sd]~JwX{' );
define( 'AUTH_SALT',        'ECv]SGGjVf}p+x|1_FX:2!^urtK:?UP+|9V6B(Jf&DRHDe)`fz9~A}Op@I>=USZ:' );
define( 'SECURE_AUTH_SALT', '2Ptx.[MHYG{3(dV3J(#Q~]fcLV+XYB&wjI`un2,/.CNHd80*o^t~dDkym::$TmEV' );
define( 'LOGGED_IN_SALT',   '[+rN22WEvEiFWz$|WcG9^~M<C=DR+f:]aY3^(.;;sJsn?S7:PC|h-sdH2@B;sQC,' );
define( 'NONCE_SALT',       '-B~c<_uy_{ARORI+L.6qw2:F,|;8>GnL$)TD&H6^dd FY]DM ]zAmI}X=P)b(x!/' );

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
