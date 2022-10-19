<?php
/**
 * Product Type Settings
*/
$wp_customize->add_section(new AppZend_Toggle_Section($wp_customize, 'appzend_producthotoffer_section', array(
    'title' => esc_html__('Hot Offer Products', 'appzend'),
    'panel' => 'appzend_frontpage_settings',
    'priority' => appzend_get_section_position('appzend_producthotoffer_section'),
    'hiding_control' => 'appzend_producthotoffer_section'
)));

$wp_customize->add_setting('appzend_producthotoffer_nav', array(
    // 'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control(new AppZend_Custom_Control_Tab($wp_customize, 'appzend_producthotoffer_nav', array(
    'type' => 'tab',
    'section' => 'appzend_producthotoffer_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'appzend'),
            'fields' => array(
                'appzend_producthotoffer_section',
                'appzend_producthotoffer_title_style',
                'appzend_producthotoffer_super_title',
                'appzend_producthotoffer_title',
                'appzend_producthotoffer_sub_title',
                'appzend_producthotoffer_category',
                'appzend_producthotoffer_layout',
                'appzend_producthotoffer_category_view',
                'appzend_producthotoffer_per_page',
                'appzend_producthotoffer_column',
                'appzend_producthotofer_offer_text'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'appzend'),
            'fields' => array(
                'appzend_producthotoffer_bg_type',
                'appzend_producthotoffer_bg_color',
                'appzend_producthotoffer_bg_gradient',
                'appzend_producthotoffer_bg_image',
                'appzend_producthotoffer_super_title_color',
                'appzend_producthotoffer_title_color',
                'appzend_producthotoffer_subtitle_color'
            ),
        ),
        array(
            'name' => esc_html__( 'Advance', 'appzend'),
            'fields' => array(
                'appzend_producthotoffer_margin_msg',
                'appzend_producthotoffer_margin',
                'appzend_producthotoffer_padding',
                'appzend_producthotoffer_alignment'
            )
        ),
        array(
            'name' => esc_html__( 'Hidden', 'appzend'),
            'class' => 'sp-hidden',
            'fields' => array(
                'appzend_producthotoffer_type'
            )
        )
    ),
)));

$wp_customize->add_setting('appzend_producthotoffer_section_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('appzend_producthotoffer_category', array(
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new AppZend_Multiple_Check_Control($wp_customize, 'appzend_producthotoffer_category', array(
    'label'     => esc_html__('Select Category', 'appzend'),
    'settings' => 'appzend_producthotoffer_category',
    'section'  => 'appzend_producthotoffer_section',
    'choices'  => appzend_woocommerce_category(),
)));

$wp_customize->selective_refresh->add_partial( 'producthotoffer_category', array(
    'settings' => array( 'appzend_producthotoffer_category' ),
    'selector' => '#cl-hotoffer-section',
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'producthotoffer' );
    }
));

$wp_customize->add_setting('appzend_producthotoffer_category_view', array(
    'default' => 'grid',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));
$wp_customize->add_control('appzend_producthotoffer_category_view', array(
    'section' => 'appzend_producthotoffer_section',
    'type' => 'select',
    'label' => esc_html__('View', 'appzend'),
    'choices' => array(
        'grid'  => esc_html__('Grid', 'appzend'),
        'slider'  => esc_html__('Slider', 'appzend')
    )
));
$wp_customize->selective_refresh->add_partial( 'producthotoffer_category_view', array(
    'settings' => array( 'appzend_producthotoffer_category_view' ),
    'selector' => '#cl-hotoffer-section',
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'producthotoffer' );
    }
));
$wp_customize->add_setting('appzend_producthotofer_offer_text', array(
    'sanitize_callback' => 'wp_kses_post',
    'default' => '<span class="color-primary">Hurry up!</span> Offers end in',
    'transport' => 'postMessage'
));

$wp_customize->add_control('appzend_producthotofer_offer_text', array(
    'label'     => esc_html__('Offer Text', 'appzend'),
    'type'      => 'text',
    'section'   => 'appzend_producthotoffer_section'
));

$wp_customize->add_setting('appzend_producthotoffer_per_page', array(
    'sanitize_callback' => 'absint',
    'default' => 9,
    'transport' => 'postMessage'
));
$wp_customize->add_control(new AppZend_Range_Control($wp_customize, 'appzend_producthotoffer_per_page', array(
    'section' => 'appzend_producthotoffer_section',
    'label' => esc_html__('No of Products', 'appzend'),
    'input_attrs' => array(
        'min' => 1,
        'max' => 100,
        'step' => 1,
    )
)));
$wp_customize->selective_refresh->add_partial( 'producthotoffer_per_page', array(
    'settings' => array( 'appzend_producthotoffer_per_page' ),
    'selector' => "#cl-hotoffer-section",
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'producthotoffer' );
    }
));

$wp_customize->add_setting('appzend_producthotoffer_column', array(
    'sanitize_callback' => 'absint',
    'default' => 3,
    'transport' => 'postMessage'
));
$wp_customize->add_control(new AppZend_Range_Control($wp_customize, 'appzend_producthotoffer_column', array(
    'section' => 'appzend_producthotoffer_section',
    'label' => esc_html__('No of Columns', 'appzend'),
    'input_attrs' => array(
        'min' => 1,
        'max' => 6,
        'step' => 1,
    )
)));
$wp_customize->selective_refresh->add_partial( 'producthotoffer_column', array(
    'settings' => array( 'appzend_producthotoffer_column' ),
    'selector' => '#cl-hotoffer-section',
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'producthotoffer' );
    }
));
$wp_customize->add_setting('appzend_producthotoffer_upgrade_text', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Appzend_Upgrade_Text($wp_customize, 'appzend_producthotoffer_upgrade_text', array(
    'section' => 'appzend_producthotoffer_section',
    'label' => esc_html__('For more settings,', 'appzend'),
    'choices' => array(
        esc_html__('Change title styles', 'appzend'),
        esc_html__('Different types of layout', 'appzend'),
        esc_html__('Change number of columns', 'appzend'),
        esc_html__('Switch between Color/Gradient/Image background', 'appzend'),
        esc_html__('Advance Option - Directly Change Content from customizer', 'appzend'),
    ),
    'priority' => 100
)));