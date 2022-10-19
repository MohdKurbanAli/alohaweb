<?php
namespace Zemez_Dashboard;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Settings_Page extends Base_Page {

	/**
	 * [$has_license description]
	 * @var null
	 */
	private $has_license = null;

	/**
	 * Page slug
	 *
	 * @return string
	 */
	public function get_slug() {
		return 'settings';
	}

	/**
	 * Get icon
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'dashicons dashicons-admin-settings';
	}

	/**
	 * Page name
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_attr__( 'Settings', 'zemez-dashboard' );
	}

	/**
	 * Disable builder instance initialization
	 *
	 * @return bool
	 */
	public function use_builder() {
		return false;
	}

	/**
	 * Renderer callback
	 *
	 * @return void
	 */
	public function render_page() {
		$this->render_actions();

		//zemez_dashboard()->settings->render_page();
	}

	public function save_settings( $data ) {
		zemez_dashboard()->settings->save( $data );
	}

	/**
	 * Render plugins actions
	 * @return [type] [description]
	 */
	public function render_actions() {

		if ( null === $this->has_license ) {
			$this->has_license = \Zemez_Dashboard\Utils::get_license();
		}

		if ( empty( $this->has_license ) ) {
			return;
		}

		echo '<div class="jet-plugins-actions">';

		printf(
			'<a href="%2$s" class="cx-button cx-button-success-style">%1$s</a>',
			__( 'Synchronize Templates Library', 'zemez-dashboard' ),
			add_query_arg(
				array(
					'jet_action' => $this->get_slug(),
					'handle'     => 'sync_library',
				),
				admin_url( 'admin.php' )
			)
		);

		echo '</div>';

	}

	/**
	 * Clear templates Jet API cache
	 *
	 * @return void
	 */
	public function sync_library() {

		$api_source = zemez_dashboard()->templates_manager->get_source( 'jet-api' );
		$redirect   = $this->get_current_page_link();

		if ( ! $api_source ) {
			wp_safe_redirect( $redirect );
			die();
		}

		$api_source->delete_templates_cache();
		$api_source->delete_categories_cache();
		$api_source->delete_keywords_cache();

		wp_safe_redirect( $redirect );
		die();

	}

}