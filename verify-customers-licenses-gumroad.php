<?php 

/**
 * Plugin Name:       Verify Customers Licenses for Gumroad
 * Plugin URI:        https://unistudio.co/collections/apps/vl-gumroad/
 * Description:       Verify your Gumroad's customers licenses right within WordPress.
 * 
 * Version:           1.0.0
 * Requires at least: 5.4
 * Requires PHP:      7.2
 * Author:            UniStudio
 * Author URI:        https://unistudio.co
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       vclg
 * Domain Path:       /lang
**/

// Exit if directly accessed
if ( ! defined( 'ABSPATH' ) ) { 
    exit;
}

// Define variables for paths
define( 'VCLG_LOCATION', dirname( __FILE__ ) );
define( 'VCLG_LOCATION_URL', plugins_url( '', __FILE__ ) );
define( 'VCLG_ADMIN_URL', plugins_url( '/admin/assets', __FILE__ ) );
define( 'VCLG_FRONTEND_URL', plugins_url( '/frontend/assets', __FILE__ ) );
define( 'VCLG_VER', '1.0.0' );


/**
 * Include required files.
 */
require VCLG_LOCATION . '/inc/enqueue.php';
require VCLG_LOCATION . '/inc/functions.php';
require VCLG_LOCATION . '/inc/hooks.php';
require VCLG_LOCATION . '/inc/callback.php';
require VCLG_LOCATION . '/inc/shortcodes.php';

/**
 * Admin options page files.
 */
require VCLG_LOCATION . '/admin/menu.php';
require VCLG_LOCATION . '/admin/settings.php';