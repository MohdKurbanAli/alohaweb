<?php
    /**
	 * Home Page Settings
	*/
	$wp_customize->add_panel('appzend_frontpage_settings', array(
		'title'		=>	esc_html__('Home Sections','appzend'),
		'priority'	=>	35,
		'description' => esc_html__('Drag and Drop to Reorder', 'appzend'). '<img class="appzend-drag-spinner" src="'.admin_url('/images/spinner.gif').'">',
        'active_callback' => 'appzend_front_page_active',
	));

    function appzend_front_page_active(){
        // Check for the slider plugin class
        if( get_theme_mod('appzend_enable_frontpage', 'disable') == 'enable' ) {
            return true;
        } else {
            return false;
        }
    }

    require get_template_directory() . '/inc/customizer/home-page/common-settings.php';
    require get_template_directory() . '/inc/customizer/home-page/slider.php';
    require get_template_directory() . '/inc/customizer/home-page/about-us.php';
    require get_template_directory() . '/inc/customizer/home-page/featured-service.php';
    require get_template_directory() . '/inc/customizer/home-page/highlight-service.php';
    require get_template_directory() . '/inc/customizer/home-page/our-service.php';
    require get_template_directory() . '/inc/customizer/home-page/cta.php';
    require get_template_directory() . '/inc/customizer/home-page/portfolio.php';
    require get_template_directory() . '/inc/customizer/home-page/how-it-works.php';

    if (class_exists('woocommerce')) {
		require get_template_directory() . '/inc/customizer/home-page/product-type-settings.php';
		require get_template_directory() . '/inc/customizer/home-page/product-category-settings.php';
		require get_template_directory() . '/inc/customizer/home-page/product-hotoffer.php';
	}

    /**
     * Home init.php
     */