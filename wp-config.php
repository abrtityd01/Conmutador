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
define( 'DB_NAME', 'dbs1768925' );

/** MySQL database username */
define( 'DB_USER', 'dbu886353' );

/** MySQL database password */
define( 'DB_PASSWORD', 'e8nHz[AlJNA&;' );

/** MySQL hostname */
define( 'DB_HOST', 'db5002186738.hosting-data.io' );

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
define( 'AUTH_KEY',         '+0+SxW}P&G8dh{[eH8sU`HVQMJ(g=PSrN([wU GV,wzbs$y|~+5ubh|w5{9:LekS' );
define( 'SECURE_AUTH_KEY',  '( 3YCHB25zAnZhN#b2vNbel%}KBMg|x$wxkIS@IFTpJRz[ )b=mTo r`zrrsiq)0' );
define( 'LOGGED_IN_KEY',    'qkW0(@Y$;r.3&6DP8DIfPLK[5z@873!p`iU-cND*/Zh93PUVhpJ=v2<.*ePt%p54' );
define( 'NONCE_KEY',        '{d&^,^s#/YN]+a:0 $r@%c0;:^tczfYVJ7n2n`a0Xd>GBg*bQ%!fjzL`A%7.-tpM' );
define( 'AUTH_SALT',        '&eystz_jDyIC`zmbl[g:hYm?Q$G[ecyk7!v[k2>WB$lYZjYU~HSrr{!B<NR!Y<y6' );
define( 'SECURE_AUTH_SALT', 'M#tfLJD9WYp{sb|g@w=/qF=YkM8e*_1Qjh)AzIl[H1>;MP,wrIn$`U}& @6{p*nl' );
define( 'LOGGED_IN_SALT',   'AtT*ZKLC$Tca<}_8qeZE3+|/5#1y&eBWeAyT_8-nWPbU!Ec42{6hB-Xs=W[b!FbL' );
define( 'NONCE_SALT',       'F~fEFBaw(U/|S?&v`[!.Ilw-j!o>Fl$YKKu>%pV+Cp4@Zh7|A;^TNK)-CF~8SO=@' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_1tgrup0';

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

ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
