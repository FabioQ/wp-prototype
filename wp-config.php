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
define('DB_USER', 'hsdbproto');

/** MySQL database password */
define('DB_PASSWORD', 'U)~S=H%CKFa6');

/** MySQL hostname */
define('DB_HOST', '23.229.229.73');

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
define('AUTH_KEY',         ';@xGIngusnx^[&IR2j  TX+8OoC`G,z$Df(ASb+JzKZfreGOdil_8HAd8N1&dH&{');
define('SECURE_AUTH_KEY',  'w]f:6^ZC.1a>tm-&*xPyUrg?`b>Fi1K1/t(<`+vm2~W8e0SH|k_r1`7c:kv6xH]y');
define('LOGGED_IN_KEY',    'Xj_7P~qK#8LaOq)0x-_+67l6P-rl p*y<PI]{pmmMHVfu|}wU,Ciih)f|gbZHAq>');
define('NONCE_KEY',        '++V:gSktAnQE_kX:K)(=0sJy!O^t(M`/?-ml,6zP:<wH9+}Ug~Y|a>Ji:mZoj{+=');
define('AUTH_SALT',        'pLJ}<(v+)y.-W0a7`f)OY:z>{SL^yy;NSX8;zR)+_@_;|Q*;ZNeZ89X|+9o9l-;)');
define('SECURE_AUTH_SALT', 'NU[4UnmWH|Q!4VZ0(zxY(m2ZCTt/@BLE/HR#i][_/:4~]u[h+yKux2b#1MG>t3,>');
define('LOGGED_IN_SALT',   'Ogz6*&.]^/IGY_w~MQrLD+mZu$^-~S<Rh}G!,XhR;I-&,l8aEXP7>l*iP[vm]E+2');
define('NONCE_SALT',       'pIbM665:}dNsSqDXV6TVei6+jmM9(HsS_/SgQr+6A,qL@3?:A}.K#V+173ij;X[^');

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
