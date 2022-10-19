<?php
/**
 * Header Settings.
*/

$wp_customize->get_section( 'header_image' )->panel = 'appzend_general_settings_panel';
$wp_customize->get_section( 'header_image' )->priority = 7;

$wp_customize->get_section( 'title_tagline' )->panel = 'appzend_general_settings_panel';
$wp_customize->get_section( 'title_tagline' )->priority = 5;


/**
 * Navigation Settings
 */
// Site Layout.
$wp_customize->add_section('appzend_header_settings', array(
    'title'		=>	esc_html__('Header Setting','appzend'),
    'priority'	=>	10,
));

    /**
     * Tab Section
     */
    $wp_customize->add_setting('appzend_header_settings_nav', array(
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new AppZend_Custom_Control_Tab($wp_customize, 'appzend_header_settings_nav', array(
        'type' => 'tab',
        'section' => 'appzend_header_settings',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'appzend'),
                'fields' => array(
                    'appzend-menu',
                    'appzend-menu-style',
                    'appzend-show-cart',
                    'appzend-cart-icon',
                    'appzend_button_enable',
                    'appzend_menu_relative',
                    'appzend_menu_sticky',
                    'appzend_menu_alignment',
                    'appzend-button-text',
                    'appzend-button-enable-icon',
                    'appzend-button-icon',
                    'appzend-button-url',
                    'appzend-button-open-link-new-tab',
                    'appzend-button-class',
                    // child theme
                    'appzend_call_button',
                    'appzend-call-button-text',
                    'appzend-call-phone-text',
                    'appzend-call-phone-icon'
                ),
                'active' => true,
            ),
            array(
                'name' => esc_html__('Style', 'appzend'),
                'fields' => array(
                    'appzend_menu_bg',
                    'appzend_menu_text_color',
                    'appzend_button_color_group',
                ),
            )
        ),
    )));


    /*Custom Menu*/
    $wp_customize->add_setting(
        'appzend-menu',
        array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );
    
    $wp_customize->add_control(
        'appzend-menu',
        array(
            'label'           => esc_html__( 'Select Menu', 'appzend' ),
            'section'         => 'appzend_header_settings',
            'settings'        => 'appzend-menu',
            'type'            => 'select',
            'choices'         => appzend_get_nav_menus(),
        )
    );

    /**
     * Relative Menu
     */
    $wp_customize->add_setting('appzend_menu_relative', array(
    	'default' => 'enable',
        'transport' => 'postMessage',
        'sanitize_callback' => 'appzend_sanitize_switch',	
    ));

    $wp_customize->add_control(new AppZend_Switch_Control($wp_customize, 'appzend_menu_relative', array(
		'label' => esc_html__('Relative', 'appzend'),
		'section' => 'appzend_header_settings',
		'switch_label' => array(
			'enable' => esc_html__('Yes', 'appzend'),
			'disable' => esc_html__('No', 'appzend'),
		),
	)));


    /**
     * sticky Menu
     */
    $wp_customize->add_setting('appzend_menu_sticky', array(
    	'default' => 'disable',
        'transport' => 'postMessage',
        'sanitize_callback' => 'appzend_sanitize_switch',	
    ));

    $wp_customize->add_control(new AppZend_Switch_Control($wp_customize, 'appzend_menu_sticky', array(
		'label' => esc_html__('Sticky', 'appzend'),
		'section' => 'appzend_header_settings',
		'switch_label' => array(
			'enable' => esc_html__('Yes', 'appzend'),
			'disable' => esc_html__('No', 'appzend'),
		),
	)));

    /**
     * Menu Alignement
     */
    $wp_customize->add_setting(
        'appzend_menu_alignment',
        array(
            'sanitize_callback' => 'appzend_sanitize_field_responsive_buttonset',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new AppZend_Responsive_Buttonset(
            $wp_customize,
            'appzend_menu_alignment',
            array(
                'choices'  => appzend_text_alignment_class(),
                'label'    => esc_html__( 'Alignment', 'appzend' ),
                'section'  => 'appzend_header_settings',
                'settings' => 'appzend_menu_alignment',
            )
        )
    );

    /**
     * Enable / Disable Button On Header
     */
    $wp_customize->add_setting('appzend_button_enable', array(
    	'default' => 'disable',
        'transport' => 'postMessage',
        'sanitize_callback' => 'appzend_sanitize_switch',	
    ));

    $wp_customize->add_control(new AppZend_Switch_Control($wp_customize, 'appzend_button_enable', array(
		'label' => esc_html__('Enable Button', 'appzend'),
		'section' => 'appzend_header_settings',
		'switch_label' => array(
			'enable' => esc_html__('Yes', 'appzend'),
			'disable' => esc_html__('No', 'appzend'),
		),
	)));

    /*Button Text*/
    $wp_customize->add_setting( 'appzend-button-text',
        array(
            'default'           => esc_html__("Shop Now", 'appzend'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control( 'appzend-button-text',
        array(
            'label'    => esc_html__( 'Button Text', 'appzend' ),
            'section'         => 'appzend_header_settings',
            'settings' => 'appzend-button-text',
            'type'     => 'text',
        )
    );

    /*Button URL*/
    $wp_customize->add_setting( 'appzend-button-url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control( 'appzend-button-url',
        array(
            'label'     => esc_html__( 'Button URL', 'appzend' ),
            'section'         => 'appzend_header_settings',
            'settings'  => 'appzend-button-url',
            'type'      => 'url',
        )
    );

    /*Open link in new tab */
    $wp_customize->add_setting( 'appzend-button-open-link-new-tab',
    array(
        'default'           => true,
        'sanitize_callback' => 'appzend_sanitize_checkbox',
        'transport'         => 'postMessage',
    )
    );

    $wp_customize->add_control( 'appzend-button-open-link-new-tab',
    array(
        'label'    => esc_html__( 'Open link in a new tab', 'appzend' ),
        'section'         => 'appzend_header_settings',
        'settings' => 'appzend-button-open-link-new-tab',
        'type'     => 'checkbox',
    )
    );

    $wp_customize->add_setting( 'appzend-button-class',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control( 'appzend-button-class',
        array(
            'label'       => esc_html__( 'Button CSS Class ', 'appzend' ),
            'description' => __( 'Multiple classes added by space', 'appzend' ),
            'section'         => 'appzend_header_settings',
            'settings'    => 'appzend-button-class',
            'type'        => 'text',
        )
    );

    /**
     * Style 
     */
    /**
     * Menu background Color
     */
    $wp_customize->add_setting('appzend_menu_bg', array(
        'default' => '#0d2690',
        'transport' => 'postMessage',
        'sanitize_callback' => 'appzend_sanitize_color_alpha',
    ));

    $wp_customize->add_control(new AppZend_Alpha_Color_Control($wp_customize, 'appzend_menu_bg', array(
        'label' => esc_html__('Menu Background Color', 'appzend'),
        'section' => 'appzend_header_settings'
    )));

    /**
     * Menu Text Color
     */
    $wp_customize->add_setting('appzend_menu_text_color', array(
        'default' => '#fff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'appzend_sanitize_color_alpha',
    ));

    $wp_customize->add_control(new AppZend_Alpha_Color_Control($wp_customize, 'appzend_menu_text_color', array(
        'label' => esc_html__('Menu Text Color', 'appzend'),
        'section' => 'appzend_header_settings'
    )));

    /* button color*/
    $wp_customize->add_setting('appzend_button_bg_color', array(
        'default' => '#f74d2c',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_setting('appzend_button_text_color', array(
        'default' => '#ffffff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    // Slider Button Hover Color
    $wp_customize->add_setting('appzend_button_bg_hov_color', array(
        'default' => '#ffffff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_setting('appzend_button_text_hov_color', array(
        'default' => '#000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control(new AppZend_Color_Tab_Control($wp_customize, 'appzend_button_color_group', array(
        'label' => esc_html__('Button Color', 'appzend'),
        'section' => 'appzend_header_settings',
        'show_opacity' => true,
        'settings' => array(
            'normal_appzend_button_bg_color' => 'appzend_button_bg_color',
            'normal_appzend_button_text_color' => 'appzend_button_text_color',
            'hover_appzend_button_bg_hov_color' => 'appzend_button_bg_hov_color',
            'hover_appzend_button_text_hov_color' => 'appzend_button_text_hov_color',
        ),
        'group' => array(
            'normal_appzend_button_bg_color' => esc_html__('Background Color', 'appzend'),
            'normal_appzend_button_text_color' => esc_html__('Text Color', 'appzend'),
            'hover_appzend_button_bg_hov_color' => esc_html__('Background Color', 'appzend'),
            'hover_appzend_button_text_hov_color' => esc_html__('Text Color', 'appzend')
        )
    )));

    $wp_customize->selective_refresh->add_partial( 'appzend_button-text', array(
        'selector' => '.header-container .swp-header-button',
        'container_inclusive' => false,
    ) );