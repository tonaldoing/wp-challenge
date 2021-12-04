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
define( 'DB_NAME', 'u624845037_4vD4n' );

/** MySQL database username */
define( 'DB_USER', 'u624845037_C5xHX' );

/** MySQL database password */
define( 'DB_PASSWORD', 'InVXOn5IlR' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '+,o_%;I?&GQ&1EkgbrP,v^5EvKxxBn>Cg2=@ctiA0,/kre]*Vf,Kvk&Vrodk!diY' );
define( 'SECURE_AUTH_KEY',   'T&DE1%01Zy@J-r7VB-=8aOw$J*|!*^(D$+z,j` jwKp.+T%|{-3|3RDQ~VflCFG`' );
define( 'LOGGED_IN_KEY',     'k9Ll~|Z *>w4B ^Um |DdY2;k*Z3>L5o-enI|L}xch?x`LXC<|.6fm?o<U/!;TJt' );
define( 'NONCE_KEY',         'GJF p^A^]$I#)%)8}f38c{$Ud98}6X;g,l?i?WP)VG;vvex^<},matGUn(96M&aq' );
define( 'AUTH_SALT',         'M}1*{-7+j|xRd5^k|c#<B ubu3GB(`B3FQLkdh9i,fYNnsjP|&RB{?wY?>NwJ]6_' );
define( 'SECURE_AUTH_SALT',  'dc5S4[zarr7$R[j#v{?%@!M!;eTpUBXh/aFl.?jqlMgur~x*L!o]>T@F*n7p9g/C' );
define( 'LOGGED_IN_SALT',    'FLdyhS2*g1k9k6kpbiq2CWETx;4hm#Y;qWy<u|6%5.s %S$h{R` V7G.@910>rSD' );
define( 'NONCE_SALT',        'flfJV0:Xh{XHd,d&x8{ AXnAf8Kp/:jv7N&88J Q?WpPHq>8Jb:$#^V:}6MohHeo' );
define( 'WP_CACHE_KEY_SALT', '2:Ef>drVO!h&>6+w$+&nEq?v9M#jZ-=[G*)UI=i=#dFTyfi()W9R7`Yl1~g)P%Cb' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
