<?php
namespace Zemez_Dashboard;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Utils {

	/**
	 * [is_license_exist description]
	 * @return boolean [description]
	 */
	public static function get_license() {
		return get_option( 'jet_theme_core_license' );
	}

	/**
	 * [active_license_link description]
	 * @return [type] [description]
	 */
	public static function active_license_link() {

		return add_query_arg(
			array(
				'page' => 'zemez-dashboard',
				'tab'  => 'license',
			),
			esc_url( admin_url( 'admin.php' ) )
		);
	}

	/**
	 * Perform plugin installtion by passed plugin slug and plugin package URL (optional)
	 *
	 * @param  [type]  $plugin     [description]
	 * @param  boolean $plugin_url [description]
	 * @return [type]              [description]
	 */
	public static function install_plugin( $plugin, $plugin_url = false ) {

		$status = array();

		if ( ! current_user_can( 'install_plugins' ) ) {
			$status['errorMessage'] = __( 'Sorry, you are not allowed to install plugins on this site.', 'zemez-dashboard' );
			wp_send_json_error( $status );
		}

		if ( ! $plugin ) {
			$status['errorMessage'] = __( 'Plugin slug is required', 'zemez-dashboard' );
			wp_send_json_error( $status );
		}

		if ( ! $plugin_url ) {
			$api_url = zemez_dashboard()->api->api_base();
			$package = add_query_arg(
				array(
					'ct_api_action' => 'get_plugin',
					'license'       => self::get_license(),
					'url'           => urlencode( home_url( '/' ) ),
					'slug'          => dirname( $plugin ),
				),
				$api_url
			);
		} else {
			$package = $plugin_url;
		}

		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );

		$skin     = new \WP_Ajax_Upgrader_Skin();
		$upgrader = new \Plugin_Upgrader( $skin );
		$result   = $upgrader->install( $package );

		if ( is_wp_error( $result ) ) {
			$status['errorCode']    = $result->get_error_code();
			$status['errorMessage'] = $result->get_error_message();
			wp_send_json_error( $status );
		} elseif ( is_wp_error( $skin->result ) ) {
			$status['errorCode']    = $skin->result->get_error_code();
			$status['errorMessage'] = $skin->result->get_error_message();
			wp_send_json_error( $status );
		} elseif ( $skin->get_errors()->get_error_code() ) {
			$status['errorMessage'] = $skin->get_error_messages();
			wp_send_json_error( $status );
		} elseif ( is_null( $result ) ) {
			global $wp_filesystem;

			$status['errorCode']    = 'unable_to_connect_to_filesystem';
			$status['errorMessage'] = __( 'Unable to connect to the filesystem. Please confirm your credentials.', 'zemez-dashboard' );

			// Pass through the error from WP_Filesystem if one was raised.
			if ( $wp_filesystem instanceof \WP_Filesystem_Base && is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->get_error_code() ) {
				$status['errorMessage'] = esc_html( $wp_filesystem->errors->get_error_message() );
			}

			wp_send_json_error( $status );
		}

		$all_plugins = get_plugins();
		$plugin_data = isset( $all_plugins[ $plugin ] ) ? $all_plugins[ $plugin ] : array();

		if ( isset( $plugin_data['Version'] ) ) {
			$version = $plugin_data['Version'];
		} else {
			$version = '---';
		}

		$status['version'] = $version;

		wp_send_json_success( $status );

	}

	/**
	 * Performs plugin activation
	 *
	 * @param  [type] $plugin [description]
	 * @return [type]         [description]
	 */
	public static function activate_plugin( $plugin ) {

		$status = array();

		if ( ! current_user_can( 'activate_plugins' ) ) {
			$status['errorMessage'] = __( 'Sorry, you are not allowed to install plugins on this site.', 'zemez-dashboard' );
			wp_send_json_error( $status );
		}

		if ( ! $plugin ) {
			$status['errorMessage'] = __( 'Plugin slug is required', 'zemez-dashboard' );
			wp_send_json_error( $status );
		}

		$activate = null;

		if ( ! is_plugin_active( $plugin ) ) {
			$activate = activate_plugin( $plugin );
		}

		if ( is_wp_error( $activate ) ) {
			$status['errorMessage'] = $activate->get_error_message();
			wp_send_json_error( $status );
		}

		wp_send_json_success( apply_filters( 'zemez-dashboard/utils/activate-plugin-response', $status ) );

	}

}
