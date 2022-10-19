<?php
/**
 * Main Custom admin functions area
 *
 * @since Sparkle Themes
 *
 * @param appzend
 *
 */

/**
 * Load Custom Themes functions that act independently of the theme functions.
 */
require get_theme_file_path('inc/themes-functions.php');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/** Customizer Controls */
require get_template_directory() . '/inc/custom-controller/init.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Customizer Sanitization.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

/**
 * Customizer Custom Controller.
 */
require get_template_directory() . '/inc/customizer/custom-controller.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {

	require get_template_directory() . '/inc/woocommerce.php';
	
}


/**
 * Dynamic Color.
 */
require get_template_directory() . '/inc/dynamic.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {

	require get_template_directory() . '/inc/jetpack.php';
	
}
/**
 * Load breadcrumbs class
 */
if ( ! function_exists( 'breadcrumb_trail' ) ) {

	require get_template_directory() . '/inc/breadcrumbs.php';
}

/**
 * Mobile Menu
 */
require get_template_directory() . '/inc/mobile-menu/init.php';
if( is_admin() ) {
	require get_template_directory() . '/welcome/welcome.php';
	/**
	 * Load in customizer upgrade to pro
	*/
	require get_template_directory() .'/inc/custom-controller/customizer-pro/class-customize.php';

}

require get_template_directory() . '/inc/meta-boxes/post-meta.php';

require get_template_directory() . '/inc/meta-fields.php';