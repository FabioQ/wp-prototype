<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hsdbproto');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '734rUHoasTS5NsV z[a{D?f6FQFP{n|;hiKOhTotx=asE1LJEt2oNr0uSn~&4Su&');
define('SECURE_AUTH_KEY',  'i2&Cq:x==|as$B=d|aD`=p%mcT),UMg~uuQy.}mFuXZK[3Z7h#d+:l 6~r/z+3-/');
define('LOGGED_IN_KEY',    'HSv*3]ig&VEbOm L7zVtpB8q`ebM^Trvgqc%4w.$vIDr~9Qrg+SWH&Nfrs`5SNQ}');
define('NONCE_KEY',        'AIhD.[Y#Ii:P(eqc:c+iOPm4zi?Ny!c(+9_M@H6kbttSyd1Cl:I/}SstLR]cH_G)');
define('AUTH_SALT',        'Gi1wx-RLD! jo$-o3|$=3T+;LKg^^l@b]n[>lZO[RjF8e(6eGw8*6p8qC7X)H`L&');
define('SECURE_AUTH_SALT', 'AVb4A`Cax:L#3-.W!v-x) B&$%Q+-&UFR-flD)~r|q!D-C]suoq1{P+}Tjv~5>]h');
define('LOGGED_IN_SALT',   'yeS1+yOEK)mf59teFO+R2?%psVxWf^TpVY:^k`s-aZcOtq<}`23bD#S+<MH7E[k}');
define('NONCE_SALT',       'kR0Hem,$bSB-d(6IFGa[&^$S?WPID/_R}Rq6y.#Ho11Bt%Af~@)UtI{=` N/F]fW');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'hs_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
