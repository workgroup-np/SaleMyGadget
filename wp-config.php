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
define('DB_NAME', 'gadget');

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
define('AUTH_KEY',         'lJfq^Ki_-T<w[FCCP{J8hxb~e#k}QRZyDquU?[&dcF=ZO=iwMr{0@?QWKqx}7q^P');
define('SECURE_AUTH_KEY',  '9e7rg@HnM.<Ka(0G#NT9kPh,F}uwY`q!}gt`FTgnjp1}9=]) YS*fLwTuT{qn{Qk');
define('LOGGED_IN_KEY',    'ByL})Zkn6j<71L1OwOrkx+DZ~J|hcD-#!wKC;$*j-Hu~K:1D*?Z+H5KXD;!_p4{+');
define('NONCE_KEY',        'Y~%F^*s]Fu;87POui4DRlQs0DN@;Ztnf*W(?Re?1m_V0zazW`$y+cfX!j]<dfs.V');
define('AUTH_SALT',        '`# 1Z2c . ZTfIbVSNJ6tvz2uOkWe/0v`F~ i!4aGr_1m2V$F+.0 GOMXJ/W-m2]');
define('SECURE_AUTH_SALT', '0gi[K.6Roihxm /A4 20jveTNosy Urrz+[6lWm1;QY9:wyx-6c.B[`/0TK_jC1/');
define('LOGGED_IN_SALT',   '%bGDsh){;m6D/hMUF`D<O0+Ndi$c:*,:bRjC5|G`jf>]Fzv8QjQ-9YnI C6s*z~W');
define('NONCE_SALT',       'VvK;vxsb0[6)z{|060{&nCU!Lns~Df KA=aA^~=u&y+[Ww@BzLnxQP*S%`byl-/}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'gad_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
