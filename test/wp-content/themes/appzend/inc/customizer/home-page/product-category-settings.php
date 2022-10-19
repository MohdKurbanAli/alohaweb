<?php
/**
 * Product Type Settings
*/
$wp_customize->add_section(new AppZend_Toggle_Section($wp_customize, 'appzend_productcat_section', array(
    'title' => esc_html__('Product Category', 'appzend'),
    'panel' => 'appzend_frontpage_settings',
    'priority' => appzend_get_section_position('appzend_productcat_section'),
    'hiding_control' => 'appzend_productcat_section'
)));

$wp_customize->add_setting('appzend_productcat_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control(new AppZend_Custom_Control_Tab($wp_customize, 'appzend_productcat_nav', array(
    'type' => 'tab',
    'section' => 'appzend_productcat_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'appzend'),
            'fields' => array(
                'appzend_productcat_section',
                'appzend_productcat_section_heading',
                'appzend_productcat_title_style',
                'appzend_productcat_super_title',
                'appzend_productcat_title',
                'appzend_productcat_sub_title',
                'appzend_productcat_content',
                'appzend_productcat_image',
                'appzend_productcat_image_position',
                'appzend_productcat_category_view',
                'appzend_productcat_category',
                'appzend_productcat_layout',
                'appzend_productcat_column',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'appzend'),
            'fields' => array(
                'appzend_productcat_bg_type',
                'appzend_productcat_bg_color',
                'appzend_productcat_bg_gradient',
                'appzend_productcat_bg_image',
                'appzend_productcat_super_title_color',
                'appzend_productcat_title_color',
                'appzend_productcat_subtitle_color',
                'appzend_productcat_color_group'
            ),
        ),
        array(
            'name' => esc_html__( 'Advance', 'appzend'),
            'fields' => array(
                'appzend_productcat_margin_msg',
                'appzend_productcat_margin',
                'appzend_productcat_padding',
            )
        ),
        array(
            'name' => esc_html__( 'Hidden', 'appzend'),
            'class' => 'sp-hidden',
            'fields' => array(
                'appzend_productcat_alignment',
                'appzend_productcat_type',
            )
        )
    ),
)));
$wp_customize->add_setting('appzend_productcat_section_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('appzend_productcat_category', array(
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new AppZend_Multiple_Check_Control($wp_customize, 'appzend_productcat_category', array(
    'label'     => esc_html__('Select Category', 'appzend'),
    'settings' => 'appzend_productcat_category',
    'section'  => 'appzend_productcat_section',
    'choices'  => appzend_woocommerce_category(),
)));

$wp_customize->selective_refresh->add_partial( 'productcat_category', array(
    'settings' => array( 'appzend_productcat_category' ),
    'selector' => '#cl-productcat-section',
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'productcat' );
    },
));

$wp_customize->add_setting('appzend_productcat_layout', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'category-style-1',
    'transport' => 'postMessage'
));
$wp_customize->add_control('appzend_productcat_layout', array(
    'section' => 'appzend_productcat_section',
    'type' => 'select',
    'label' => esc_html__('Layout', 'appzend'),
    'choices' => array(
        'category-style-1' => __('Style One', 'appzend'),
        'category-style-2' => __('Style Two', 'appzend'),
        'category-style-3' => __('Style Three', 'appzend'),
        'category-style-4' => __('Style Four', 'appzend'),
    )
));
$wp_customize->selective_refresh->add_partial( 'appzend_productcat_layout', array(
    'selector' => '#cl-productcat-section',
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'productcat' );
    }
));
$wp_customize->add_setting('appzend_productcat_category_view', array(
    'default' => 'grid',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));
$wp_customize->add_control('appzend_productcat_category_view', array(
    'section' => 'appzend_productcat_section',
    'type' => 'select',
    'label' => esc_html__('View', 'appzend'),
    'choices' => array(
        'grid'  => esc_html__('Grid', 'appzend'),
        'slider'  => esc_html__('Slider', 'appzend')
    )
));
$wp_customize->selective_refresh->add_partial('productcat_category_view', array(
    'settings' => array( 'appzend_productcat_category_view' ),
    'selector' => '#cl-productcat-section',
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'productcat' );
    }
));
$wp_customize->add_setting('appzend_productcat_column', array(
    'sanitize_callback' => 'absint',
    'default' => 3,
    'transport' => 'postMessage',
));
$wp_customize->add_control(new AppZend_Range_Control($wp_customize, 'appzend_productcat_column', array(
    'section' => 'appzend_productcat_section',
    'label' => esc_html__('No of Columns', 'appzend'),
    'input_attrs' => array(
        'min' => 1,
        'max' => 6,
        'step' => 1,
    )
)));
$wp_customize->selective_refresh->add_partial('productcat_column', array(
    'settings' => array( 'appzend_productcat_column' ),
    'selector' => '#cl-productcat-section',
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'productcat' );
    }
));

$wp_customize->add_setting('appzend_productcat_upgrade_text', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Appzend_Upgrade_Text($wp_customize, 'appzend_productcat_upgrade_text', array(
    'section' => 'appzend_productcat_section',
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