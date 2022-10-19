<?php
$sections = array(
    'appzend_highlight_service'         => '#highlight-service-section',
    'appzend_features_service'          => '#get-started',
    'appzend_aboutus'                   => '#aboutus',
    'appzend_calltoaction'              => '#app-cta',
    'appzend_howitworks'                => '#app-how-it-works',
    'appzend_recentwork'                => '#app-portfolio',
    'appzend_service'                   => '#appzend-service-section',
    'appzend_productcat'                => '#cl-productcat-section',
    'appzend_producttype'               => '#cl-producttype-section',
    'appzend_producthotoffer'           => '#cl-hotoffer-section',

);
$exclude_section = array('appzend_calltoaction', 'appzend_producthotoffer','appzend_productcat', 'appzend_producttype', 'appzend_aboutus');

foreach($sections as $section => $parent):
    
    /**
     * Enable/Disable Option
     *
     * @since 1.0.0
    */
    $wp_customize->add_setting($section.'_section', array(
        'default' => 'disable',
        'transport' => 'postMessage',
        'sanitize_callback' => 'appzend_sanitize_switch',     
    ));

    $wp_customize->add_control(new AppZend_Switch_Control($wp_customize, $section.'_section', array(
        'label' => esc_html__('Enable', 'appzend'),
        'section' => $section.'_section',
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'appzend'),
            'disable' => esc_html__('No', 'appzend'),
        ),
    )));

    $wp_customize->selective_refresh->add_partial( $section.'_section', array(
        'settings' => array( $section.'_section' ),
        'selector' => $parent,
        'container_inclusive' => true,
        'render_callback' => function($item) {
            if(get_theme_mod($section."_section", 'disable') == 'enable'):
                $appzend_homepage_section = str_replace('appzend_', '', $section);
                return get_template_part( 'section/section', $appzend_homepage_section );
            endif;
        },
    ));

    // Section Super.
    $wp_customize->add_setting( $section.'_super_title', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( $section.'_super_title', array(
        'label'    => esc_html__( 'Super Title', 'appzend' ),
        'section'  => $section.'_section',
        'type'     => 'text',
    ));

    // Section Title.
    $wp_customize->add_setting( $section.'_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'			
    ) );

    $wp_customize->add_control( $section.'_title', array(
        'label'    => esc_html__( 'Title', 'appzend' ),
        'section'  => $section.'_section',
        'type'     => 'text',
    ));

    // Section Sub Title.
    $wp_customize->add_setting( $section.'_sub_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'			
    ) );

    $wp_customize->add_control( $section.'_sub_title', array(
        'label'    => esc_html__( 'Sub Title', 'appzend' ),
        'section'  => $section.'_section',
        'type'     => 'text',
    ));
    /**
     * style
     */
    $wp_customize->add_setting($section.'_bg_color', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new AppZend_Gradient_Control($wp_customize, $section.'_bg_color', array(
        'label' => esc_html__('Background Color', 'appzend'),
        'section' => $section.'_section'
    )));

    $wp_customize->add_setting($section.'_super_title_color', array(
        'default' => '#0d1e67',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $section.'_super_title_color', array(
        'section' => $section.'_section',
        'label' => esc_html__('Super Title Color', 'appzend')
    )));

    $wp_customize->add_setting($section.'_title_color', array(
        'default' => '#02114f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $section.'_title_color', array(
        'section' => $section.'_section',
        'label' => esc_html__('Title Color', 'appzend')
    )));
    $wp_customize->add_setting($section.'_subtitle_color', array(
        'default' => '#828282',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $section.'_subtitle_color', array(
        'section' => $section.'_section',
        'label' => esc_html__('Description Color', 'appzend')
    )));

    if(!in_array($section, $exclude_section)):
        $wp_customize->add_setting($section.'_box_bg_color', array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_setting($section.'_icon_color', array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_setting($section.'_box_title_color', array(
            'default' => '#333',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));

        $wp_customize->add_setting($section.'_text_color', array(
            'default' => '#333',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));
        // Slider Button Hover Color
        $wp_customize->add_setting($section.'_bg_hov_color', array(
            'default' => '#02114f',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_setting($section.'_icon_hov_color', array(
            'default' => '#02114f',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_setting($section.'_title_hov_color', array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));

        $wp_customize->add_setting($section.'_text_hov_color', array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(new AppZend_Color_Tab_Control($wp_customize, $section.'_color_group', array(
            'label' => esc_html__('Service Box Color', 'appzend'),
            'section' => $section.'_section',
            'show_opacity' => false,
            'settings' => array(
                'normal_'. $section .'box_bg_color' => $section.'_box_bg_color',
                'normal_'. $section .'icon_color' => $section.'_icon_color',
                'normal_'. $section .'title_color' => $section.'_box_title_color',
                'normal_'. $section .'text_color' => $section.'_text_color',
                'hover_'. $section .'bg_hov_color' => $section.'_bg_hov_color',
                'hover_'. $section .'icon_hov_color' => $section.'_icon_hov_color',
                'hover_'. $section .'title_hov_color' => $section.'_title_hov_color',
                'hover_'. $section .'text_hov_color' => $section.'_text_hov_color',
            ),
            'group' => array(
                'normal_'. $section .'box_bg_color' => esc_html__('Background Color', 'appzend'),
                'normal_'. $section .'icon_color' => esc_html__('Icon Color', 'appzend'),
                'normal_'. $section .'title_color' => esc_html__('Title Color', 'appzend'),
                'normal_'. $section .'text_color' => esc_html__('Text Color', 'appzend'),
                'hover_'. $section .'bg_hov_color' => esc_html__('Background Color', 'appzend'),
                'hover_'. $section .'icon_hov_color' => esc_html__('Icon Color', 'appzend'),
                'hover_'. $section .'title_hov_color' => esc_html__('Title Color', 'appzend'),
                'hover_'. $section .'text_hov_color' => esc_html__('Text Color', 'appzend')
            )
        )));
    endif;


    // Margin Padding
    $wp_customize->add_setting($section.'_margin_msg', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new AppZend_Customize_Heading($wp_customize, $section.'_margin_msg', array(
        'section' => $section.'_section',
        'label' => esc_html__('Margin & Padding', 'appzend')
    )));
    $wp_customize->add_setting(
        $section.'_margin',
        array(
            'sanitize_callback' => 'appzend_sanitize_field_default_css_box',
            'default'           => '',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new AppZend_Cssbox(
            $wp_customize,
            $section.'_margin',
            array(
                'label'    => esc_html__( 'Margin (px)', 'appzend' ),
                'section'  => $section.'_section',
                'settings' => $section.'_margin',
            ),
            array(),
            array()
        )
    );
    /* Padding*/
    $wp_customize->add_setting(
        $section.'_padding',
        array(
            'sanitize_callback' => 'appzend_sanitize_field_default_css_box',
            'default'           => '',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new AppZend_Cssbox(
            $wp_customize,
            $section.'_padding',
            array(
                'label'    => esc_html__( 'Padding (px)', 'appzend' ),
                'section'  => $section.'_section',
                'settings' => $section.'_padding',
            ),
            array(),
            array()
        )
    );

    /**
     * Slider Alignment
     */
    $wp_customize->add_setting(
        $section.'_alignment',
        array(
            'default'           => json_encode(array(
                'desktop' => 'text-center',
                'tablet' => 'text-center',
                'mobile' => 'text-center'
            )),
            'sanitize_callback' => 'appzend_sanitize_field_responsive_buttonset',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new AppZend_Responsive_Buttonset(
            $wp_customize,
            $section.'_alignment',
            array(
                'choices'  => appzend_text_alignment_class(),
                'label'    => esc_html__( 'Alignment', 'appzend' ),
                'section'  => $section.'_section',
                'settings' => $section.'_alignment',
            )
        )
    );

endforeach;