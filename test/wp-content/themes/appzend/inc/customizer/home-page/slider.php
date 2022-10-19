<?php
    /**
     *	Main Banner Slider.
    */
    $wp_customize->add_section(new AppZend_Toggle_Section($wp_customize, 'appzend_slider_section', array(
        'title'		=>	esc_html__('Home Slider Settings','appzend'),
        'panel'		=> 'appzend_frontpage_settings',
        'transport' => 'postMessage',
        'hiding_control' => 'appzend_banner_slider_section',
        'priority'  => -1
    )));


    /**
     * Enable/Disable Option
     *
     * @since 1.0.0
    */
    $wp_customize->add_setting('appzend_banner_slider_section', array(
        'default' => 'enable',
        'transport' => 'postMessage',
        'sanitize_callback' => 'appzend_sanitize_switch',     
    ));

    $wp_customize->add_control(new AppZend_Switch_Control($wp_customize, 'appzend_banner_slider_section', array(
        'label' => esc_html__('Enable', 'appzend'),
        'section' => 'appzend_slider_section',
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'appzend'),
            'disable' => esc_html__('No', 'appzend'),
        ),
    )));

    $wp_customize->selective_refresh->add_partial( 'appzend_banner_slider_section', array(
        'selector' => '.banner-slider',
        'container_inclusive' => true,
        'render_callback' => function() {
            if( get_theme_mod( 'appzend_banner_slider_section', 'enable' ) === 'enable' )
                get_template_part( 'section/home', 'slider' );
        }
    ));

    /**
     * Tab Section
     */
    $wp_customize->add_setting('appzend_banner_slider_section_nav', array(
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new AppZend_Custom_Control_Tab($wp_customize, 'appzend_banner_slider_section_nav', array(
        'type' => 'tab',
        'section' => 'appzend_slider_section',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'appzend'),
                'fields' => array(
                    'appzend_slider',
                ),
                'active' => true,
            ),
            array(
                'name' => esc_html__('Style', 'appzend'),
                'fields' => array(
                    'appzend_slider_overlay_color',
                    'appzend_slider_title_color',
                    'appzend_slider_subtitle_color',
                    'appzend_slider_caption_button_color_group',
                    'appzend_slider_margin_msg',
                    'appzend_slider_margin',
                    'appzend_slider_padding',
                    'appzend_slider_height_msg',
                    'appzend_slider_height_group'
                ),
            )
        ),
    )));    


    // Select Slider Page Slider
    $wp_customize->add_setting('appzend_slider', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'appzend_sanitize_repeater',		
        'default' => json_encode(array(
            array(
                'slider_page' => '',
                'button_text' => '',
                'button_url' => '',
                'alignment' => 'left',
                'banner' => 'background'
            )
        ))
    ));

    $wp_customize->add_control(new AppZend_Repeater_Control( $wp_customize, 
        'appzend_slider', 
        array(
            'label' 	   => esc_html__('Banner Slider Settings', 'appzend'),
            'section' 	   => 'appzend_slider_section',
            'settings' 	   => 'appzend_slider',
            'box_label' => esc_html__('Item #', 'appzend'),
            'add_label' => esc_html__('Add New', 'appzend'),
        ),

        array(
            'slider_page' => array(
                'type' => 'select',
                'label' => esc_html__('Select Page', 'appzend'),
                'description' => esc_html__('You can edit page title and content from pages', 'appzend'),
                'options' => $pages
            ),

            'button_text' => array(
                'type' => 'text',
                'label' => esc_html__('First Button Text', 'appzend'),
                'default' => ''
            ),
            
            'button_url' => array(
                'type' => 'url',
                'label' => esc_html__('First Button URL', 'appzend'),
                'default' => ''
            ),
            'alignment' => array(
                'type' => 'select',
                'label' => esc_html__('Alignment', 'appzend'),
                'options' => array(
                    'text-left' => __("Left", 'appzend'),
                    'text-center' => __("Center", 'appzend'),
                    'text-right' => __("Right", 'appzend'),
                )
            ),
            'banner' => array(
                'type' => 'select',
                'label' => esc_html__('Banner Position', 'appzend'),
                'options' => array(
                    'right' => __("Right", 'appzend'),
                    'left' => __("Left", 'appzend'),
                    'background' => __("Background", 'appzend'),
                )
            )
        )
    ));

    $wp_customize->selective_refresh->add_partial( 'appzend_slider_ss', array(
        'settings'        => array( 'appzend_slider' ),
        'selector'        => '.bannerslider.banner-slider',
        'container_inclusive'  => true,
        'render_callback' => function() {
            get_template_part( 'section/home', 'slider' ); 
        }
    ) );

    $wp_customize->add_setting('appzend_home_slider_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Appzend_Upgrade_Text($wp_customize, 'appzend_home_slider_upgrade_text', array(
        'section' => 'appzend_slider_section',
        'label' => esc_html__('For more settings,', 'appzend'),
        'choices' => array(
            esc_html__('Set the type of silder animation', 'appzend'),
            esc_html__('Custom image upload with advanced settings', 'appzend'),
            esc_html__('Banner Settings', 'appzend'),
            esc_html__('Video Banner Settings', 'appzend'),
            esc_html__('And more...', 'appzend'),
        ),
        'priority' => 100
    )));

    /**
     * style
     */
    $wp_customize->add_setting('appzend_slider_overlay_color', array(
        'transport' => 'postMessage',
        'default' => 'rgba(255,255,255,0)',
        'show_opacity' => true,
        'sanitize_callback' => 'appzend_sanitize_color_alpha',
    ));
    $wp_customize->add_control(new AppZend_Alpha_Color_Control($wp_customize, 'appzend_slider_overlay_color', array(
        'label' => esc_html__('Background Overlay Color', 'appzend'),
        'section' => 'appzend_slider_section',
        
    )));
    $wp_customize->add_setting('appzend_slider_title_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'appzend_slider_title_color', array(
        'section' => 'appzend_slider_section',
        'label' => esc_html__('Title Color', 'appzend')
    )));
    $wp_customize->add_setting('appzend_slider_subtitle_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'appzend_slider_subtitle_color', array(
        'section' => 'appzend_slider_section',
        'label' => esc_html__('Description Color', 'appzend')
    )));
    $wp_customize->add_setting('appzend_slider_caption_button_bg_color', array(
        'default' => '#f74d2c',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting('appzend_slider_caption_button_border_color', array(
        'default' => '#f74d2c',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting('appzend_slider_caption_button_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    // Slider Button Hover Color
    $wp_customize->add_setting('appzend_slider_caption_button_bg_hov_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting('appzend_slider_caption_button_border_hov_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting('appzend_slider_caption_button_text_hov_color', array(
        'default' => '#02114f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new AppZend_Color_Tab_Control($wp_customize, 'appzend_slider_caption_button_color_group', array(
        'label' => esc_html__('Caption Button Colors', 'appzend'),
        'section' => 'appzend_slider_section',
        'show_opacity' => false,
        'settings' => array(
            'normal_appzend_slider_caption_button_bg_color' => 'appzend_slider_caption_button_bg_color',
            'normal_appzend_slider_caption_button_border_color' => 'appzend_slider_caption_button_border_color',
            'normal_appzend_slider_caption_button_text_color' => 'appzend_slider_caption_button_text_color',
            'hover_appzend_slider_caption_button_bg_hov_color' => 'appzend_slider_caption_button_bg_hov_color',
            'hover_appzend_slider_caption_button_border_hov_color' => 'appzend_slider_caption_button_border_hov_color',
            'hover_appzend_slider_caption_button_text_hov_color' => 'appzend_slider_caption_button_text_hov_color',
        ),
        'group' => array(
            'normal_appzend_slider_caption_button_bg_color' => esc_html__('Button Background Color', 'appzend'),
            'normal_appzend_slider_caption_button_border_color' => esc_html__('Button Border Color', 'appzend'),
            'normal_appzend_slider_caption_button_text_color' => esc_html__('Button Text Color', 'appzend'),
            'hover_appzend_slider_caption_button_bg_hov_color' => esc_html__('Button Background Color', 'appzend'),
            'hover_appzend_slider_caption_button_border_hov_color' => esc_html__('Button Border Color', 'appzend'),
            'hover_appzend_slider_caption_button_text_hov_color' => esc_html__('Button Text Color', 'appzend')
        )
    )));
    // slider Margin Padding
    $wp_customize->add_setting('appzend_slider_margin_msg', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new AppZend_Customize_Heading($wp_customize, 'appzend_slider_margin_msg', array(
        'section' => 'appzend_slider_section',
        'label' => esc_html__('Margin & Padding', 'appzend')
    )));
    $wp_customize->add_setting(
        'appzend_slider_margin',
        array(
            'sanitize_callback' => 'appzend_sanitize_field_default_css_box',
            'default'           => '',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new AppZend_Cssbox(
            $wp_customize,
            'appzend_slider_margin',
            array(
                'label'    => esc_html__( 'Margin (px)', 'appzend' ),
                'section'  => 'appzend_slider_section',
                'settings' => 'appzend_slider_margin',
            ),
            array(),
            array()
        )
    );
    /* Padding*/
    $wp_customize->add_setting(
        'appzend_slider_padding',
        array(
            'sanitize_callback' => 'appzend_sanitize_field_default_css_box',
            'default'           => '',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new AppZend_Cssbox(
            $wp_customize,
            'appzend_slider_padding',
            array(
                'label'    => esc_html__( 'Padding (px)', 'appzend' ),
                'section'  => 'appzend_slider_section',
                'settings' => 'appzend_slider_padding',
            ),
            array(),
            array()
        )
    );

    // height heading 
    $wp_customize->add_setting('appzend_slider_height_msg', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new AppZend_Customize_Heading($wp_customize, 'appzend_slider_height_msg', array(
        'section' => 'appzend_slider_section',
        'label' => esc_html__('Slider Height', 'appzend')
    )));
    $wp_customize->add_setting("appzend_slider_height", array(
        'sanitize_callback' => 'appzend_sanitize_number_blank',
        'default' => 550,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting("appzend_slider_height_tablet", array(
        'sanitize_callback' => 'appzend_sanitize_number_blank',
        'default' => '',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting("appzend_slider_height_mobile", array(
        'sanitize_callback' => 'appzend_sanitize_number_blank',
        'default' => '',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new AppZend_Range_Slider_Control($wp_customize, "appzend_slider_height_group", array(
        'section' => "appzend_slider_section",
        'label' => esc_html__('Height (px)', 'appzend'),
        'input_attrs' => array(
            'min' => 20,
            'max' => 900,
            'step' => 1,
        ),
        'settings' => array(
            'desktop' => "appzend_slider_height",
            'tablet' => "appzend_slider_height_tablet",
            'mobile' => "appzend_slider_height_mobile",
        ),
        // 'priority' => 140
    )));