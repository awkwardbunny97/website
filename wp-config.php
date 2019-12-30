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
define( 'DB_NAME', 'caothanh_nam' );

/** MySQL database username */
define( 'DB_USER', 'caothanh_nam' );

/** MySQL database password */
define( 'DB_PASSWORD', 'R03eaUpA5w' );

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
define( 'AUTH_KEY',         ';hlBo_$hixZ<uzj70o7>>nW]qGZxO!$[3No/nnK[v_.1ClvCUpb,e>NJFo>9e^5r' );
define( 'SECURE_AUTH_KEY',  'XnY{.o~g%r,#a`h]f^B~F[FT(!Id)~/-&nS!z3_^N4>LMPAf x9uI#`ne=Amp64T' );
define( 'LOGGED_IN_KEY',    '>6QSi)D]!:jRW<6>+7GyV)-Xr:Q irOc8F,VHO.-o,}YFGz8[etL*2X5}%GD8BtN' );
define( 'NONCE_KEY',        '`U}$.$H4=Nv)RoAvi:usO:NF!B]r+1gF~gBm@Yag.(wvQx>c.9-MwgVFgJ7 }(~i' );
define( 'AUTH_SALT',        '@7fg`7*A%#`NKQ Kv|l/Z7xKJ##4|:#1L).<?/0Xb/O!e4cNd[Jnr0XBOZ=K~>,~' );
define( 'SECURE_AUTH_SALT', 'dPsOz7k:u10t]P;8O&FvuR7+m]y2_k^lDy+DEJ^wnRRcN0mOT%qtW[fZNi&jF}rb' );
define( 'LOGGED_IN_SALT',   ';X} Ve*r[.T+ Kvmi9[9V> za+HaE^la%@gF*%v(/15Z0)~+?QA8d3JR,me&xTTv' );
define( 'NONCE_SALT',       '%nRJlARvwD?0.uZv,/gT5~l10$@3sMx(Aa_#wF|0Z/0fM3-0ysM1kLR}wZP9){cd' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
