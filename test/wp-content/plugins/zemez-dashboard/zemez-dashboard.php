<?php
/**
 * Plugin Name: Zemez Dashboard
 * Plugin URI:
 * Description: Zemez Dashboard Plugin
 * Version:     1.0.0
 * Author:      Zemez
 * Author URI:
 * Text Domain: zemez-dashboard
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

add_action( 'plugins_loaded', 'zemez_dashboard_init' );

function zemez_dashboard_init() {

	define( 'ZEMEZ_DASHBOARD_VERSION', '1.0.0' );

	define( 'ZEMEZ_DASHBOARD__FILE__', __FILE__ );
	define( 'ZEMEZ_DASHBOARD_PLUGIN_NAME', plugin_basename( __FILE__ ) );
	define( 'ZEMEZ_DASHBOARD_PLUGIN_BASE', plugin_basename( ZEMEZ_DASHBOARD__FILE__ ) );
	define( 'ZEMEZ_DASHBOARD_PATH', plugin_dir_path( ZEMEZ_DASHBOARD__FILE__ ) );
	define( 'ZEMEZ_DASHBOARD_URL', plugins_url( '/', ZEMEZ_DASHBOARD__FILE__ ) );

	require ZEMEZ_DASHBOARD_PATH . 'includes/plugin.php';

}

function zemez_dashboard() {
	return Zemez_Dashboard\Plugin::instance();
}
