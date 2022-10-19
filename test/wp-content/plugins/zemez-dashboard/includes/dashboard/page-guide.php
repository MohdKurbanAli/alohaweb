<?php
namespace Zemez_Dashboard;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Guide_Page extends Base_Page {

	/**
	 * Page slug
	 *
	 * @return string
	 */
	public function get_slug() {
		return 'guide';
	}

	/**
	 * Get icon
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'dashicons dashicons-info';
	}

	/**
	 * Page name
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_attr__( 'User Guide', 'zemez-dashboard' );
	}

	/**
	 * Renderer callback
	 *
	 * @return void
	 */
	public function render_page() {

		$guide = zemez_dashboard()->config->get( 'guide' );
		$title   = ! empty( $guide['title'] ) ? $guide['title'] : '';
		$content = ! empty( $guide['content'] ) ? $guide['content'] : '';

		include zemez_dashboard()->get_template( 'dashboard/guide/heading.php' );

		if ( ! empty( $guide['links'] ) ) {
			$links = $guide['links'];
			include zemez_dashboard()->get_template( 'dashboard/guide/links.php' );
		}
	}

}
