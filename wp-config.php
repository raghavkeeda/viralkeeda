<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

// ===================================================
// Load database info and local development parameters
// ===================================================
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	define( 'WP_LOCAL_DEV', true );
	include( dirname( __FILE__ ) . '/local-config.php' );
} else {
	define( 'WP_LOCAL_DEV', false );
	define( 'DB_NAME', 'viralkeeda_prod' );
	define( 'DB_USER', 'user' );
	define( 'DB_PASSWORD', 'Whysoserious123' );
	define( 'DB_HOST', 'localhost' ); // Probably 'localhost'
}

// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
//define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/viralkeeda/content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );
define( 'UPLOADS', '../shared/content/uploads' );
define( 'WP_MEMORY_LIMIT', '96M' );

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define('AUTH_KEY',         '%-~iFXvl%zzN-Ti|@-#[Y$oYvJe+PB,8<X6Q%fd}OHV1dc+{qcKtPV=fv|zA,:eD');
define('SECURE_AUTH_KEY',  'H|d^kji2e>*%91Jotebc+TeJo>a9nDmr[,O1_j{wY+.)apCnl6&O&B%gz3-%H_Ax');
define('LOGGED_IN_KEY',    'k|s~,^8:DsoYPk|fv:7`r|~vQ<2Bv8XG}7Y^8z+Y58EW6>gq:*rMP/SIM,J>!sH%');
define('NONCE_KEY',        '.,jsKQH RM`6`75|,?a=A+ts2v6tjO0=/bl+A0V#6bS;?+_.`^1(blC+QdO]yp<%');
define('AUTH_SALT',        'qY6P_UT-YP3&=+Vo:Q/h<<rNmT+BO$P*d=X7BK}H+ J|2uq/<c&<!6cH~E~M6K3e');
define('SECURE_AUTH_SALT', '#=nd/a%2Ol&ZG)E:08(qtLf=zSSzpX+u^`&|/-Yuazm#+KaDC5+vc[his*hM<2G6');
define('LOGGED_IN_SALT',   '4KT;+yAa~0~# XnZMXmaRlgAIH<R+M%!!0`oE6lK*O3Kg*nmmeA+Dr3L]`vk=W8l');
define('NONCE_SALT',       '}Z#+7J]jo{!1vi))B~OqAQ~QO{sj?7BJJ=ty=X`#%emEfPNmM6Lc78I@lV9:^,y<');

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );

// ===========
// Hide errors
// ===========
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );

// =================================================================
// Debug mode
// Debugging? Enable these. Can also enable them in local-config.php
// =================================================================
// define( 'SAVEQUERIES', true );
// define( 'WP_DEBUG', true );

// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) )
	$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );

// ===========================================================================================
// This can be used to programatically set the stage when deploying (e.g. production, staging)
// ===========================================================================================
define( 'WP_STAGE', '%%WP_STAGE%%' );
define( 'STAGING_DOMAIN', '%%WP_STAGING_DOMAIN%%' ); // Does magic in WP Stack to handle staging domain rewriting

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
require_once( ABSPATH . 'wp-settings.php' );
