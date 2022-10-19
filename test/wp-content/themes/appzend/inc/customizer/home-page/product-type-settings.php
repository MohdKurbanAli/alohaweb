<?php
/**
 * Product Type Settings
*/
$wp_customize->add_section(new AppZend_Toggle_Section($wp_customize, 'appzend_producttype_section', array(
    'title' => esc_html__('Product Type (Tab)', 'appzend'),
    'panel' => 'appzend_frontpage_settings',
    'priority' => appzend_get_section_position('appzend_producttype_section'),
    'hiding_control' => 'appzend_producttype_section'
)));

$wp_customize->add_setting('appzend_producttype_nav', array(
    // 'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control(new AppZend_Custom_Control_Tab($wp_customize, 'appzend_producttype_nav', array(
    'type' => 'tab',
    'section' => 'appzend_producttype_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'appzend'),
            'fields' => array(
                'appzend_producttype_section',
                'appzend_producttype_title_style',
                'appzend_producttype_super_title',
                'appzend_producttype_title',
                'appzend_producttype_sub_title',
                'appzend_producttype_layout',
                'appzend_producttype_category',
                'appzend_producttype_category_view',
                'appzend_producttype_no_of_product',
                'appzend_producttype_no_of_product',
                'appzend_producttype_column'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'appzend'),
            'fields' => array(
                'appzend_producttype_bg_type',
                'appzend_producttype_bg_color',
                'appzend_producttype_bg_gradient',
                'appzend_producttype_bg_image',
                'appzend_producttype_super_title_color',
                'appzend_producttype_title_color',
                'appzend_producttype_subtitle_color',
                'appzend_producttype_columnor_group',
                'appzend_producttype_color_group',
            ),
        ),
        array(
            'name' => esc_html__( 'Advance', 'appzend'),
            'fields' => array(
                'appzend_producttype_margin_msg',
                'appzend_producttype_margin',
                'appzend_producttype_padding',
                'appzend_producttype_alignment'
            )
        ),
        array(
            'name' => esc_html__( 'Hidden', 'appzend'),
            'class' => 'sp-hidden',
            'fields' => array(
                'appzend_producttype_type'
            )
        )
    ),
)));


$wp_customize->add_setting('appzend_producttype_category', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control(new AppZend_Multiple_Check_Control($wp_customize, 'appzend_producttype_category', array(
    'section' => 'appzend_producttype_section',
    'settings' => 'appzend_producttype_category',
    'label' => esc_html__('Select Product Type', 'appzend'),
    'choices' => array(
        'latest_product'  => esc_html__('Latest Product', 'appzend'),
        'upsell_product'  => esc_html__('UpSell Product', 'appzend'),
        'feature_product' => esc_html__('Feature Product', 'appzend'),
        'on_sale'         => esc_html__('On Sale Product', 'appzend'),
    )
)));
$wp_customize->selective_refresh->add_partial( 'producttype_category', array(
    'settings' => array( 'appzend_producttype_category' ),
    'selector' => '#cl-producttype-section', 
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'producttype' );
    }
));
$wp_customize->add_setting('appzend_producttype_layout', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'tab_styleone',
));
$wp_customize->add_control('appzend_producttype_layout', array(
    'section' => 'appzend_producttype_section',
    'type' => 'select',
    'label' => esc_html__('Layout', 'appzend'),
    'choices' => array(
        'tab_styleone' => __('Style One', 'appzend'),
        'tab_styletwo' => __('Style Two', 'appzend'),
        'tab_stylethree' => __('Style Three', 'appzend'),
    )
));
$wp_customize->add_setting('appzend_producttype_category_view', array(
    'default' => 'grid',
    'sanitize_callback' => 'appzend_sanitize_select',
    'transport' => 'postMessage'
));
$wp_customize->add_control('appzend_producttype_category_view', array(
    'section'   => 'appzend_producttype_section',
    'type'      => 'select',
    'label'     => esc_html__('View', 'appzend'),
    'choices'   => array(
        'grid'      => esc_html__('Grid', 'appzend'),
        'slider'    => esc_html__('Slider', 'appzend')
    )
));
$wp_customize->selective_refresh->add_partial( 'producttype_category_view', array(
    'settings' => 'appzend_producttype_category_view',
    'selector' => '#cl-producttype-section',
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'producttype' );
    }
));
$wp_customize->add_setting('appzend_producttype_column', array(
    'sanitize_callback' => 'absint',
    'default'           => 3,
    'transport' => 'postMessage'
));
$wp_customize->add_control(new AppZend_Range_Control($wp_customize, 'appzend_producttype_column', array(
    'section' => 'appzend_producttype_section',
    'label' => esc_html__('No of Columns', 'appzend'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 4,
        'step' => 1,
    )
)));
$wp_customize->selective_refresh->add_partial( 'producttype_column', array(
    'settings' => array( 'appzend_producttype_column' ),
    'selector' => '#cl-producttype-section',
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'producttype' );
    }
));
$wp_customize->add_setting('appzend_producttype_no_of_product', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'absint',
    'default' => 4,
));
$wp_customize->add_control(new AppZend_Range_Control($wp_customize, 'appzend_producttype_no_of_product', array(
    'section' => 'appzend_producttype_section',
    'label' => esc_html__('No of Products', 'appzend'),
    'input_attrs' => array(
        'min' => 4,
        'max' => 12,
        'step' => 1,
    )
)));
$wp_customize->selective_refresh->add_partial( 'producttype_no_of_product', array(
    'settings' => array( 'appzend_producttype_no_of_product' ),
    'selector' => '#cl-producttype-section',
    'container_inclusive' => true,
    'render_callback' => function() {
        return get_template_part( 'section/section', 'producttype' );
    }
));

$wp_customize->add_setting('appzend_producttype_upgrade_text', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Appzend_Upgrade_Text($wp_customize, 'appzend_producttype_upgrade_text', array(
    'section' => 'appzend_producttype_section',
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