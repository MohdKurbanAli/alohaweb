<?php
/**
 * appzend Theme Customizer
 *
 * @package appzend
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function appzend_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->title = __('Site Title Color', 'appzend');

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'appzend_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'appzend_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_section(new AppZend_Toggle_Section($wp_customize, 'static_front_page', array(
        'title'		=>	esc_html__('Enable Front Page','appzend'),
        'priority' => -1,
        'hiding_control' => 'appzend_enable_frontpage'
    )));

	/**
	 *	Enable Front Page.
	*/
    $wp_customize->add_setting('appzend_enable_frontpage', array(
    	'default' => 'disable',
        'sanitize_callback' => 'appzend_sanitize_switch',	
    ));

	$wp_customize->add_control(new AppZend_Switch_Control($wp_customize, 'appzend_enable_frontpage', array(
		'label' => esc_html__('Enable Front Page', 'appzend'),
		'section' => 'static_front_page',
		'priority' => -1,
		'description' => esc_html__( 'Note :- Front Page only Works after selecting "Your latest posts" Options & Enabling the check box', 'appzend' ),
		'switch_label' => array(
			'enable' => esc_html__('Yes', 'appzend'),
			'disable' => esc_html__('No', 'appzend'),
		),
	)));

    $wp_customize->get_section( 'colors' )->title = esc_html__('Theme Colors', 'appzend');
	$wp_customize->get_section( 'colors' )->priority = 3;
	$wp_customize->get_section( 'colors' )->panel = 'appzend_theme_options';
	
	// Primary Color.
	$wp_customize->add_setting('appzend_primary_color', array(
	    'default' => '#f64d2b',
	    'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control('appzend_primary_color', array(
	    'type' => 'color',
	    'label' => esc_html__('Primary Color', 'appzend'),
	    'section' => 'colors',
	));

    /**
	 * Add General Settings Panel
	 *
	 * @since 1.0.0
	*/
	$wp_customize->add_panel(
	    'appzend_general_settings_panel',
	    array(
	        'priority'       => 3,
	        'title'          => esc_html__( 'General Settings', 'appzend' ),
	    )
	);
	$wp_customize->get_section( 'background_image' )->panel = 'appzend_general_settings_panel';
	$wp_customize->get_section( 'background_image' )->priority = 15;

    // List All Pages
	$pages = array();

	$pages_obj = get_pages();

	$pages[''] = esc_html__('Select Page', 'appzend');

	foreach ($pages_obj as $page) {
	    $pages[$page->ID] = $page->post_title;
	}

	// List All Category
	$categories = get_categories();
	$blog_cat = array();

	foreach ($categories as $category) {
	    $blog_cat[$category->term_id] = $category->name;
	}
	
	require get_template_directory() . '/inc/customizer/header-settings.php';
	/**
	 * home sections
	 */
	require get_template_directory() . '/inc/customizer/home-page/init.php';
	
	/**
	 * Footer Settings
	 */
	require get_template_directory() . '/inc/customizer/footer.php';

	/**
	 * Theme Option Setting.
	*/
	$wp_customize->add_panel('appzend_theme_options', array(
		'title'		=>	esc_html__('Theme Options','appzend'),
		'priority'	=>	55,
	));

		// Site Layout.
		$wp_customize->add_section('appzend_site_layout_section', array(
			'title'		=>	esc_html__('Web Site Layout','appzend'),
			'panel'		=> 'appzend_theme_options',
		));

			// Site Layout Options.
			$wp_customize->add_setting('appzend_site_layout', array(
				'transport' => 'postMessage',
				'default' => 'full_width',
				'sanitize_callback' => 'appzend_sanitize_select'         
			));

			$wp_customize->add_control('appzend_site_layout', array(
				'label'   => esc_html__('Site Layout','appzend'),
				'section' => 'appzend_site_layout_section',
				'type'    => 'select',
				'choices' => array(
					'full_width' => esc_html__('Full Width','appzend'),
					'boxed' => esc_html__('Boxed','appzend'),			
				)
			));

		/**
		 * Page Layout Sidebar Options
		*/
		$wp_customize->add_section('appzend_sidebar', array(
			'title'		=>	esc_html__('Display Sidebar Settings','appzend'),
			'panel'		=> 'appzend_theme_options',
		));

			// Index Page Sidebar Options.
			$wp_customize->add_setting('appzend_index_blog_sidebar', array(
			    'default' => 'right',
			    'sanitize_callback' => 'appzend_sanitize_select',     
			));

			$wp_customize->add_control('appzend_index_blog_sidebar', array(
			    'label'   => esc_html__('Index Blog Posts Sidebar', 'appzend'),
			    'section' => 'appzend_sidebar',
			    'type'    => 'select',
			    'choices' => array(
			        'right' => esc_html__('Content / Sidebar', 'appzend'),
			        'left' => esc_html__('Sidebar / Content', 'appzend'),
			        'no' => esc_html__('Full Width', 'appzend'),
			    ),
			));

			// Archive Page Sidebar Options.
			$wp_customize->add_setting('appzend_archive_sidebar', array(
			    'default' => 'right',
			    'sanitize_callback' => 'appzend_sanitize_select',     
			));

			$wp_customize->add_control('appzend_archive_sidebar', array(
			    'label'   => esc_html__('Blog Archive Sidebar', 'appzend'),
			    'section' => 'appzend_sidebar',
			    'type'    => 'select',
			    'choices' => array(
			        'right' => esc_html__('Content / Sidebar', 'appzend'),
			        'left' => esc_html__('Sidebar / Content', 'appzend'),
			        'no' => esc_html__('Full Width', 'appzend'),	        
			    ),
			));

			// Page Sidebar Options.
			$wp_customize->add_setting('appzend_default_page_sidebar', array(
			    'default' => 'right',
			    'sanitize_callback' => 'appzend_sanitize_select',     
			));

			$wp_customize->add_control('appzend_default_page_sidebar', array(
			    'label'   => esc_html__('Page Sidebar', 'appzend'),
			    'section' => 'appzend_sidebar',
			    'type'    => 'select',
			    'choices' => array(
			        'right' => esc_html__('Content / Sidebar', 'appzend'),
			        'left' => esc_html__('Sidebar / Content', 'appzend'),
			        'no' => esc_html__('Full Width', 'appzend'),	        
			    ),
			));

			// Search Page Sidebar Options.
			$wp_customize->add_setting('appzend_search_sidebar', array(
			    'default' => 'right',
			    'sanitize_callback' => 'appzend_sanitize_select',     
			));

			$wp_customize->add_control('appzend_search_sidebar', array(
			    'label'   => esc_html__('Search Page Sidebar', 'appzend'),
			    'section' => 'appzend_sidebar',
			    'type'    => 'select',
			    'choices' => array(
			        'right' => esc_html__('Content / Sidebar', 'appzend'),
			        'left' => esc_html__('Sidebar / Content', 'appzend'),
			        'no' => esc_html__('Full Width', 'appzend'),	        
			    ),
			));
		
		
		/**
		 * Breadcrumbs Settings. 
		*/
		$wp_customize->add_section('appzend_breadcrumb_section', array(
			'title'		=>	esc_html__('Breadcrumb Settings','appzend'),
			'panel'		=> 'appzend_theme_options',
		));

		    // Breadcrumb Image.
			$wp_customize->add_setting('appzend_breadcrumbs_image', array(
				'transport' => 'postMessage',
				'sanitize_callback'	=> 'esc_url_raw'		//done
			));

			$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'appzend_breadcrumbs_image', array(
				'label'	   => esc_html__('Upload Background Image','appzend'),
				'section'  => 'appzend_breadcrumb_section',
				'type'	   => 'image',
			)));
			

		/**
		 * Blog Template.
		*/
		$wp_customize->add_section('appzend_blog_template', array(
			'title'		  => esc_html__('Blog Template Settings','appzend'),
			'priority'	  => 65,
		));


			//  Blog Template Blog Posts by Category.
			$wp_customize->add_setting('appzend_blogtemplate_postcat', array(
			    'sanitize_callback' => 'sanitize_text_field',     
			));

			$wp_customize->add_control(new AppZend_Multiple_Check_Control($wp_customize, 'appzend_blogtemplate_postcat', array(
			    'label'    => esc_html__('Select Category To Show Posts', 'appzend'),
			    'settings' => 'appzend_blogtemplate_postcat',
			    'section'  => 'appzend_blog_template',
			    'choices'  => $blog_cat,
			    'description' => esc_html__('Note: Selected Category Only Work When you can select page template (
			    	Blog Template )','appzend'),
			)));



			// Blog Sidebar Options.
			$wp_customize->add_setting('appzend_blog_template_sidebar', array(
			    'default' => 'right',
			    'sanitize_callback' => 'appzend_sanitize_select',     
			));

			$wp_customize->add_control('appzend_blog_template_sidebar', array(
			    'label'   => esc_html__('Blog Template Layout Settings', 'appzend'),
			    'section' => 'appzend_blog_template',
			    'type'    => 'select',
			    'description' => esc_html__('Note: Blog Template Layout Only Work When you can select page template ( Blog Template )','appzend'),
			    'choices' => array(
			        'right' => esc_html__('Content / Sidebar', 'appzend'),
			        'left' => esc_html__('Sidebar / Content', 'appzend'),
			        'no' => esc_html__('Full Width', 'appzend'),
			    ),
			));


		$post_description = array(
	        'none'     => esc_html__( 'None', 'appzend' ),
	        'excerpt'  => esc_html__( 'Post Excerpt', 'appzend' ),
	        'content'  => esc_html__( 'Post Content', 'appzend' )
	    );
	        
	        $wp_customize->add_setting( 
	            'appzend_post_description_options', 

	            array(
	                'default'           => 'excerpt',
	                'sanitize_callback' => 'appzend_sanitize_select'
	            ) 
	        );
	        
	        $wp_customize->add_control( 
	            'appzend_post_description_options', 

	            array(
	                'type' => 'select',
	                'label' => esc_html__( 'Post Description', 'appzend' ),
	                'section' => 'appzend_blog_template',
	                'choices' => $post_description
	            ) 
	        );


			// Blog Template Read More Button.
			$wp_customize->add_setting( 'appzend_post_continue_reading_text', array(
				'default'           => esc_html__( 'Read More','appzend' ),
				'sanitize_callback' => 'sanitize_text_field',		
			));

			$wp_customize->add_control('appzend_post_continue_reading_text', array(
				'label'		  => esc_html__( 'Enter Read More Button Text', 'appzend' ),
				'section'	  => 'appzend_blog_template',
				'type' 		  => 'text',
			));


			/**
	         * Number field for Excerpt Length section
	         *
	         * @since 1.0.0
	         */
	        $wp_customize->add_setting(
	            'appzend_post_excerpt_length',
	            array(
	                'default'    => 35,
	                'sanitize_callback' => 'absint'
	            )
	        );

	        $wp_customize->add_control(
	            'appzend_post_excerpt_length',

	            array(
	                'type'      => 'number',
	                'label'     => esc_html__( 'Enter Posts Excerpt Length', 'appzend' ),
	                'section'   => 'appzend_blog_template',
	            )
	        );

}
add_action( 'customize_register', 'appzend_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function appzend_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function appzend_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function appzend_customize_preview_js() {
	wp_enqueue_script( 'appzend-admin-custom', get_template_directory_uri() . '/assets/js/appzend-custom.js', array( 'customize-preview' ), _S_VERSION, true );
	wp_enqueue_script( 'appzend-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'appzend_customize_preview_js' );

/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 *
 */
function appzend_customize_scripts(){

	wp_enqueue_style( 'fontawesome-4-5', get_template_directory_uri(). '/assets/library/fontawesome/css/all.min.css');

	wp_enqueue_style('appzend-customizer', get_template_directory_uri() . '/assets/css/customizer.css');

	wp_enqueue_script('appzend-customizer', get_template_directory_uri() . '/assets/js/customizer-admin.js', array('jquery', 'customize-controls'), true);
}
add_action('customize_controls_enqueue_scripts', 'appzend_customize_scripts');

/**
 * Section Re Order
*/
add_action('wp_ajax_appzend_sections_reorder', 'appzend_sections_reorder');

function appzend_sections_reorder() {

    if (isset($_POST['sections'])) {

        set_theme_mod('appzend_frontpage_sections', $_POST['sections']);
    }

    wp_die();
}

function appzend_get_section_position($key) {

    $sections = appzend_homepage_section();

    $position = array_search($key, $sections);

    $return = ( $position + 1 ) * 7;

    return $return;
}

if( !function_exists('appzend_homepage_section') ){

	function appzend_homepage_section(){

		$defaults = apply_filters('appzend_homepage_sections',
			array(
				'appzend_aboutus_section',
				'appzend_features_service_section',
				'appzend_highlight_service_section',
				'appzend_service_section',
				'appzend_calltoaction_section',
				'appzend_recentwork_section',
				'appzend_howitworks_section',
				'appzend_productcat_section',
				'appzend_producttype_section',
				'appzend_producthotoffer_section',
			)
		);

		$sections = get_theme_mod('appzend_frontpage_sections', $defaults);
		
        return $sections;
	}
}

if ( ! function_exists( 'appzend_save_menu_location' ) ) {
    /**
     * appzend_save_menu_location
     * since 1.0.0
     * Save menu location for select menu on customizer
     * @return void
     */
    function appzend_save_menu_location(){

        if( ! current_user_can( 'manage_options' )){
            return;
        }
        /*
		* update menu location value
		*/
        if( is_customize_preview()){
            $nav_locations =  get_theme_mod( 'nav_menu_locations');
            if( isset($nav_locations['menu-1'] )){
                set_theme_mod( 'appzend-menu', $nav_locations['menu-1'] );
            }
        }
        /*just run once for previous*/
        if( get_theme_mod( 'primary_menu' ) !== 'lUpdated' ){
            $nav_locations =  get_theme_mod( 'nav_menu_locations');
            if( 'custom' == get_theme_mod( 'primary_menu' ) && get_theme_mod( 'appzend-menu' ) ){
                $nav_locations['menu-1'] = get_theme_mod( 'appzend-menu' );
            }
            
            /*Now we dont need this theme mode*/
            set_theme_mod( 'primary_menu', 'lUpdated' );
            if( is_array( $nav_locations )){
                set_theme_mod( 'nav_menu_locations', array_map( 'absint', $nav_locations ) );
            }
        }
    }
    add_action( 'after_setup_theme', 'appzend_save_menu_location' );
}