<?php
namespace Zemez_Dashboard;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Theme_Page extends Base_Page {

	private $theme_status    = null;
	private $backups_manager = null;

	/**
	 * Page slug
	 *
	 * @return string
	 */
	public function get_slug() {
		return 'theme';
	}

	/**
	 * Get icon
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'dashicons dashicons-admin-appearance';
	}

	/**
	 * Page name
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_attr__( 'Theme', 'zemez-dashboard' );
	}

	/**
	 * Atach required hooks
	 *
	 * @return [type] [description]
	 */
	public function init_glob() {

		// Check theme update
		add_filter( 'pre_set_site_transient_update_themes', array( $this, 'check_theme_update' ), 50 );

		add_action( 'wp_ajax_jet_core_update_theme', array( $this, 'update_theme' ) );

		add_action( 'wp_ajax_jet_core_install_child_theme', array( $this, 'install_child_theme' ) );

		add_action( 'wp_ajax_jet_core_activate_child_theme', array( $this, 'activate_child_theme' ) );

		add_action( 'wp_ajax_jet_core_update_backup_status', array( $this, 'update_backup_status' ) );
	}

	/**
	 * Check theme updates
	 *
	 * @param  array $data
	 * @return array
	 */
	public function check_theme_update( $data ) {

		$theme_data = $this->get_remote_data();

		if ( ! $theme_data['theme_version'] ) {
			return $data;
		}

		$theme_status = $this->get_theme_status( $theme_data['theme_slug'] );

		if ( ! $theme_status['version'] ) {
			return $data;
		}

		if ( ! version_compare( $theme_data['theme_version'], $theme_status['version'], '>' ) ) {
			return $data;
		}

		$update = array();

		$update['theme']       = $theme_data['theme_slug'];
		$update['new_version'] = $theme_data['theme_version'];
		$update['url']         = '';
		$update['package']     = $theme_data['theme_path'];

		$data->response[ $theme_data['theme_slug'] ] = $update;

		return $data;
	}

	/**
	 * Update backup status
	 *
	 * @return void
	 */
	public function update_backup_status() {

		$status = array();

		if ( ! current_user_can( 'manage_options' ) ) {
			$status['errorMessage'] = __( 'You are not allowed to save options.', 'zemez-dashboard' );
			wp_send_json_error( $status );
		}

		if ( ! isset( $_POST['new_value'] ) ) {
			$status['errorMessage'] = __( 'New value not provided.', 'zemez-dashboard' );
			wp_send_json_error( $status );
		}

		$new_value = filter_var( $_POST['new_value'], FILTER_VALIDATE_BOOLEAN );

		if ( true === $new_value ) {
			$value = 'true';
		} else {
			$value = 'false';
		}

		zemez_dashboard()->settings->save_key( 'auto_backup', $value );

		wp_send_json_success( $status );

	}

	/**
	 * Update theme handler
	 *
	 * @return void
	 */
	public function update_theme() {

		$status      = array();
		$remote_data = $this->get_remote_data();

		$slug = $remote_data['theme_slug'];

		if ( ! current_user_can( 'update_themes' ) ) {
			$status['errorMessage'] = __( 'You are not allowed to update themes.', 'zemez-dashboard' );
			wp_send_json_error( $status );
		}

		$stylesheet = preg_replace( '/[^A-z0-9_\-]/', '', wp_unslash( $slug ) );

		$status     = array(
			'update'     => 'theme',
			'slug'       => $stylesheet,
			'oldVersion' => '',
			'newVersion' => '',
		);

		$backups = $this->maybe_backup_before_update();

		if ( ! empty( $backups ) ) {
			$status['backupsList'] = $backups;
		}

		$theme = wp_get_theme( $stylesheet );

		if ( $theme->exists() ) {
			$status['oldVersion'] = $theme->get( 'Version' );
		}

		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

		$current = get_site_transient( 'update_themes' );

		if ( empty( $current ) ) {
			wp_update_themes();
		}

		$skin     = new WP_Ajax_Upgrader_Skin();
		$upgrader = new Theme_Upgrader( $skin );
		$result   = $upgrader->bulk_upgrade( array( $stylesheet ) );

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$status['debug'] = $skin->get_upgrade_messages();
		}

		if ( is_wp_error( $skin->result ) ) {
			$status['errorCode']    = $skin->result->get_error_code();
			$status['errorMessage'] = $skin->result->get_error_message();
			wp_send_json_error( $status );
		} elseif ( $skin->get_errors()->get_error_code() ) {
			$status['errorMessage'] = $skin->get_error_messages();
			wp_send_json_error( $status );
		} elseif ( is_array( $result ) && ! empty( $result[ $stylesheet ] ) ) {

			// Theme is already at the latest version.
			if ( true === $result[ $stylesheet ] ) {
				$status['errorMessage'] = $upgrader->strings['up_to_date'];
				wp_send_json_error( $status );
			}

			$theme = wp_get_theme( $stylesheet );
			if ( $theme->exists() ) {
				$status['newVersion'] = $theme->get( 'Version' );
			}

			wp_send_json_success( $status );
		} elseif ( false === $result ) {
			global $wp_filesystem;

			$status['errorCode']    = 'unable_to_connect_to_filesystem';
			$status['errorMessage'] = __( 'Unable to connect to the filesystem. Please confirm your credentials.', 'zemez-dashboard' );

			// Pass through the error from WP_Filesystem if one was raised.
			if ( $wp_filesystem instanceof WP_Filesystem_Base && is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->get_error_code() ) {
				$status['errorMessage'] = esc_html( $wp_filesystem->errors->get_error_message() );
			}

			wp_send_json_error( $status );
		}

		// An unhandled error occurred.
		$status['errorMessage'] = __( 'Update failed.', 'zemez-dashboard' );
		wp_send_json_error( $status );

	}

	/**
	 * Install Child theme handler
	 *
	 * @return void
	 */
	public function install_child_theme() {

		$status = array();

		if ( ! current_user_can( 'install_themes' ) ) {
			$status['errorMessage'] = __( 'You are not allowed to install themes.', 'zemez-dashboard' );
			wp_send_json_error( $status );
		}

		$child_theme_url = zemez_dashboard()->api->get_info( 'child_theme_path' );

		if ( ! $child_theme_url ) {
			$status['errorMessage'] = __( 'Child theme URL not found.', 'zemez-dashboard' );
			wp_send_json_error( $status );
		}

		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
		include_once( ABSPATH . 'wp-admin/includes/theme.php' );

		$skin     = new \WP_Ajax_Upgrader_Skin();
		$upgrader = new \Theme_Upgrader( $skin );
		$result   = $upgrader->install( $child_theme_url );

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$status['debug'] = $skin->get_upgrade_messages();
		}

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
			if ( $wp_filesystem instanceof WP_Filesystem_Base && is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->get_error_code() ) {
				$status['errorMessage'] = esc_html( $wp_filesystem->errors->get_error_message() );
			}

			wp_send_json_error( $status );
		}

		/*
		 * See WP_Theme_Install_List_Table::_get_theme_status() if we wanted to check
		 * on post-installation status.
		 */
		wp_send_json_success( $status );

	}

	/**
	 * Activate Child theme callback
	 *
	 * @return void
	 */
	public function activate_child_theme() {

		$status = array();

		if ( ! current_user_can( 'switch_themes' ) ) {
			$status['errorMessage'] = __( 'You are not allowed to switch themes.', 'zemez-dashboard' );
			wp_send_json_error( $status );
		}

		$themes      = wp_get_themes();
		$remote_data = $this->get_remote_data();
		$slug        = $remote_data['theme_slug'];

		if ( isset( $themes[ $slug ] ) ) {
			unset( $themes[ $slug ] );
		}

		$theme_slug = false;

		foreach ( $themes as $theme ) {
			if ( $slug === $theme->get_template() ) {
				$theme_slug = $theme->get_stylesheet();
				break;
			}
		}

		if ( ! $theme_slug ) {
			$status['errorMessage'] = __( 'Theme not found.', 'zemez-dashboard' );
			wp_send_json_error( $status );
		}

		switch_theme( $theme_slug );

		wp_send_json_success( $status );

	}

	/**
	 * Custom initializtion
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_theme_assets' ), 0 );
		$this->init_backups_manager();
	}

	/**
	 * Initialize backups manager
	 *
	 * @return void
	 */
	public function init_backups_manager() {
		if ( null === $this->backups_manager ) {
			require zemez_dashboard()->plugin_path( 'includes/backups.php' );
			$this->backups_manager = new Backups();
		}
	}

	/**
	 * LLicense assets
	 *
	 * @return [type] [description]
	 */
	public function enqueue_theme_assets() {

		wp_enqueue_script(
			'jet-theme-core-theme',
			zemez_dashboard()->plugin_url( 'assets/js/theme.js' ),
			array( 'jquery' ),
			zemez_dashboard()->get_version(),
			true
		);

		wp_localize_script( 'jet-theme-core-theme', 'JetThemeData', array(
			'installing' => __( 'Installing...', 'zemez-dashboard' ),
			'installed'  => esc_attr__( 'Installed but not active', 'zemez-dashboard' ),
			'activate'   => __( 'Activate', 'zemez-dashboard' ),
			'activating' => __( 'Activating...', 'zemez-dashboard' ),
			'activated'  => __( 'Activated', 'zemez-dashboard' ),
			'updating'   => __( 'Updating...', 'zemez-dashboard' ),
			'updated'    => __( 'Updated', 'zemez-dashboard' ),
			'failed'     => __( 'Failed', 'zemez-dashboard' ),
		) );

	}

	/**
	 * Get remote data about Kava theme
	 *
	 * @return array
	 */
	public function get_remote_data() {

		$theme_data = get_transient( 'jet_core_theme_data' );

		$theme_data = false;

		if ( ! $theme_data ) {
			$theme_data = zemez_dashboard()->api->get_info(
				array( 'theme_version', 'theme_name', 'theme_slug', 'theme_thumb', 'theme_path' )
			);
			set_transient( 'jet_core_theme_data', $theme_data, DAY_IN_SECONDS );
		}

		return $theme_data;

	}

	/**
	 * Check theme updates
	 *
	 * @return void
	 */
	public function check_updates() {

		if ( ! current_user_can( 'update_themes' ) ) {
			return;
		}

		set_site_transient( 'update_themes', null );
		set_transient( 'jet_core_theme_data', null );

		wp_redirect( $this->get_current_page_link() );
		die();

	}

	/**
	 * Create theme backup
	 *
	 * @return void
	 */
	public function create_backup() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$this->run_backup();

		wp_redirect( $this->get_current_page_link() );
		die();

	}

	/**
	 * Backup handler
	 *
	 * @return [type] [description]
	 */
	public function run_backup() {

		$this->init_backups_manager();

		$remote_data  = $this->get_remote_data();
		$slug         = $remote_data['theme_slug'];
		$theme_status = $this->get_theme_status( $remote_data['theme_slug'] );

		if ( empty( $theme_status['version'] ) ) {
			return;
		}

		$this->backups_manager->make_backup( $slug, $theme_status['version'] );

	}

	/**
	 * Maybe create theme before update
	 *
	 * @return string
	 */
	public function maybe_backup_before_update() {

		$backup_enabled = zemez_dashboard()->settings->get( 'auto_backup', 'true' );

		if ( 'true' !== $backup_enabled ) {
			return '';
		}

		$this->run_backup();

		ob_start();

		$backups = $this->backups_manager->get_backups();

		if ( ! empty( $backups ) ) {
			include zemez_dashboard()->get_template( 'dashboard/theme/backups-list.php' );
		}

		return ob_get_clean();

	}

	/**
	 * Get check updates URL
	 *
	 * @return string
	 */
	public function get_check_updates_url() {
		return add_query_arg(
			array(
				'jet_action' => $this->get_slug(),
				'handle'     => 'check_updates',
			),
			admin_url( 'admin.php' )
		);
	}

	/**
	 * Get theme status
	 *
	 * @param  string $slug Theme slug to check.
	 * @return array
	 */
	public function get_theme_status( $slug ) {

		if ( null === $this->theme_status ) {

			$statuses = array(
				'active'        => esc_attr__( 'Active', 'zemez-dashboard' ),
				'active_child'  => esc_attr__( 'Child theme active', 'zemez-dashboard' ),
				'installed'     => esc_attr__( 'Installed but not active', 'zemez-dashboard' ),
				'not_installed' => esc_attr__( 'Not Installed', 'zemez-dashboard' ),
			);

			$theme_obj  = wp_get_theme( $slug );
			$template   = get_template();
			$stylesheet = get_stylesheet();

			if ( $theme_obj->get_template() === $stylesheet ) {
				$code = 'active';
			} elseif ( $theme_obj->get_template() === $template ) {
				$code = 'active_child';
			} elseif ( $theme_obj->exists() ) {
				$code = 'installed';
			} else {
				$code = 'not_installed';
			}

			$this->theme_status = array(
				'code'    => $code,
				'message' => $statuses[ $code ],
				'version' => ( 'not_installed' !== $code ) ? $theme_obj->get( 'Version' ) : '',
			);
		}

		return $this->theme_status;

	}

	/**
	 * Get child theme staus for passed slug
	 *
	 * @return [type] [description]
	 */
	public function get_child_status( $slug = null ) {

		$theme_status = $this->get_theme_status( $slug );
		$statuses     = array(
			'active'        => __( 'Active', 'zemez-dashboard' ),
			'installed'     => __( 'Installed but not active', 'zemez-dashboard' ),
			'not_installed' => __( 'Not installed', 'zemez-dashboard' ),
		);

		if ( 'active_child' === $theme_status['code'] ) {
			$code = 'active';
		} else {
			$themes = wp_get_themes();

			if ( isset( $themes[ $slug ] ) ) {
				unset( $themes[ $slug ] );
			}

			$found = false;

			foreach ( $themes as $theme ) {
				if ( $slug === $theme->get_template() ) {
					$found = true;
					break;
				}
			}

			$code = ( true === $found ) ? 'installed' : 'not_installed';

		}

		return array(
			'code'    => $code,
			'message' => $statuses[ $code ],
		);

	}

	/**
	 * Download Backup
	 *
	 * @return [type] [description]
	 */
	public function download_backup() {

		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		$file = isset( $_GET['file'] ) ? esc_attr( $_GET['file'] ) : false;

		if ( ! $file ) {
			die();
		}

		$nonce = isset( $_GET['_nonce'] ) ? esc_attr( $_GET['_nonce'] ) : false;

		if ( ! $nonce ) {
			die();
		}

		if ( ! wp_verify_nonce( $nonce, 'download_backup' ) ) {
			die();
		}

		$this->init_backups_manager();
		$this->backups_manager->download_backup( $file );

	}

	/**
	 * Delete Backup
	 *
	 * @return [type] [description]
	 */
	public function delete_backup() {

		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		$file = isset( $_GET['file'] ) ? esc_attr( $_GET['file'] ) : false;

		if ( ! $file ) {
			die();
		}

		$nonce = isset( $_GET['_nonce'] ) ? esc_attr( $_GET['_nonce'] ) : false;

		if ( ! $nonce ) {
			die();
		}

		if ( ! wp_verify_nonce( $nonce, 'delete_backup' ) ) {
			die();
		}

		$this->init_backups_manager();
		$this->backups_manager->delete_backup( $file );

		wp_redirect( $this->get_current_page_link() );
		die();

	}

	/**
	 * Backup action HTML markup
	 *
	 * @param  string $file Backup file name
	 * @return string
	 */
	public function get_backup_actions( $file ) {

		$download_link = add_query_arg(
			array(
				'jet_action' => $this->get_slug(),
				'handle'     => 'download_backup',
				'file'       => urlencode( $file ),
				'_nonce'     => wp_create_nonce( 'download_backup' ),
			),
			esc_url( admin_url( 'admin.php' ) )
		);

		$delete_link = add_query_arg(
			array(
				'jet_action' => $this->get_slug(),
				'handle'     => 'delete_backup',
				'file'       => urlencode( $file ),
				'_nonce'     => wp_create_nonce( 'delete_backup' ),
			),
			esc_url( admin_url( 'admin.php' ) )
		);

		$download = sprintf(
			'<a href="%1$s" class="jet-backup-download"><i class="dashicons dashicons-download"></i>%2$s</a>',
			$download_link,
			__( 'Download', 'zemez-dashboard' )
		);

		$delete = sprintf(
			'<a href="%1$s" class="jet-backup-delete"><i class="dashicons dashicons-trash"></i>%2$s</a>',
			$delete_link,
			__( 'Delete', 'zemez-dashboard' )
		);

		return $download . $delete;
	}

	/**
	 * Renderer callback
	 *
	 * @return void
	 */
	public function render_page() {

		$remote_data  = $this->get_remote_data();

		$theme_status = $this->get_theme_status( $remote_data['theme_slug'] );

		$has_update   = false;
		$installed    = ! empty( $theme_status['version'] ) ? true : false;

		if ( $theme_status['version'] && version_compare( $remote_data['theme_version'], $theme_status['version'], '>' ) ) {
			$has_update = true;
		}

		include zemez_dashboard()->get_template( 'dashboard/theme/theme.php' );

		$current_theme = wp_get_theme();

		$child_status  = $this->get_child_status( $remote_data['theme_slug'] );

		include zemez_dashboard()->get_template( 'dashboard/theme/child-theme.php' );

		include zemez_dashboard()->get_template( 'dashboard/theme/backup-actions.php' );

		$backups = $this->backups_manager->get_backups();

		echo '<div class="jet-backups-wrap">';
		if ( ! empty( $backups ) ) {
			include zemez_dashboard()->get_template( 'dashboard/theme/backups-list.php' );
		}
		echo '</div>';

	}

}