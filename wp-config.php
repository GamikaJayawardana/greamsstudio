<?php
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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'greamsstudio_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'KkMKkn[t+uBwG<.KTAL&0bJ=In}8C2;=t}/MkRt#QTH/Ue+bz*:mgFcAJAuzRv<l' );
define( 'SECURE_AUTH_KEY',  '}?n#RX/)}L)%X70suSrrWf10pCikqFUn kTb0u2%Njj3x/ |u>7hW5XLVo!)FUMY' );
define( 'LOGGED_IN_KEY',    '7+UvRx`7 `)js5u!M.Ff,#)ciVS$Duk9-o3[al*7!NB>Xc14p3TsF^UjeIGf~{K_' );
define( 'NONCE_KEY',        '8@;4i0w/8%A2H>-w}%D-a/Y4uc6F(`Xuiw44hG}QBT?yj+R8Y96(hl[U:,>o(C(2' );
define( 'AUTH_SALT',        ']X~-|x:5p@/Z < .jHzn_2)=)L~aYfB*h~b=~qMq_?Hk&.X ylgZJ(R}S.qcuBhF' );
define( 'SECURE_AUTH_SALT', 'iQMsl?&HW@-THx1*hvXQ{O<F*!{<CfR|~RoX^E[HGoHiYq:*e41H5SJBIPM5*4iT' );
define( 'LOGGED_IN_SALT',   'M]1. =#s+<a+yOMaF}w//)tQ|G!g)^]$%s20m>2$ sfCK2|&rCX<j0O+W)FTC,lv' );
define( 'NONCE_SALT',       's*x7pNw:i&|YV.WS$httI.p{Wt5%43;&xzXRaCG])ge2V4XxPD9MglX#:UNI%`Ue' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
