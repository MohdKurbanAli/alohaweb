<?php
    /**
	 * Our Service Section 
	*/
	$wp_customize->add_section(new AppZend_Toggle_Section($wp_customize, 'appzend_service_section', array(
		'title'		=>	esc_html__('Our Service Section','appzend'),
		'panel'		=> 'appzend_frontpage_settings',
		'priority'  => appzend_get_section_position('appzend_service_section'),
		'hiding_control' => 'appzend_service_section',
	)));

		
	/**
	 * Tab Section
	 */
	$wp_customize->add_setting('appzend_service_nav', array(
		'sanitize_callback' => 'wp_kses_post',
	));


	$wp_customize->add_control(new AppZend_Custom_Control_Tab($wp_customize, 'appzend_service_nav', array(
		'type' => 'tab',
		'priority' => 1,
		'section' => 'appzend_service_section',
		'buttons' => array(
			array(
				'name' => esc_html__('Content', 'appzend'),
				'fields' => array(
					'appzend_service_section',
					'appzend_service_super_title',
					'appzend_service_title',
					'appzend_service_sub_title',
					'appzend_service',
					'appzend_service_button'
				),
				'active' => true,
			),
			array(
				'name' => esc_html__('Style', 'appzend'),
				'fields' => array(
					'appzend_service_bg_color',
					'appzend_service_super_title_color',
					'appzend_service_title_color',
					'appzend_service_subtitle_color',
					'appzend_service_color_group',
					'appzend_service_icon_and_before_color'
				),
			),
			array(
				'name' => esc_html__('Advance', 'appzend'),
				'fields' => array(
					'appzend_service_margin_msg',
					'appzend_service_margin',
					'appzend_service_padding',
					'appzend_service_alignment',
				),
			),
		),
	)));   

		//  Our Service Page.
		$wp_customize->add_setting('appzend_service', array(
			'transport' => 'postMessage',
		    'sanitize_callback' => 'appzend_sanitize_repeater',		
		    'default' => json_encode(array(
		        array(
		            'page' => '',
		            'icon' =>'fa fa-cogs'
		        )
		    ))
		));

		$wp_customize->add_control(new AppZend_Repeater_Control( $wp_customize,
			'appzend_service', 
			array(
			    'label' 	   => esc_html__('Our Services', 'appzend'),
			    'section' 	   => 'appzend_service_section',
			    'settings' 	   => 'appzend_service',
			    'box_label' => esc_html__('Item #', 'appzend'),
			    'add_label' => esc_html__('Add New', 'appzend'),
			),
		    array(
		        'page' => array(
		            'type' => 'select',
		            'label' => esc_html__('Select Page', 'appzend'),
		            'options' => $pages
		        ),

		        'icon' => array(
		            'type' => 'icon',
		            'label' => esc_html__('Choose Icon', 'appzend'),
		            'default' => 'fa fa-cogs'
		        )
			)
		));

		$wp_customize->selective_refresh->add_partial( 'service', array(
			'settings' => 'appzend_service',
			'selector' => '#appzend-service-section',
			'container_inclusive' => true,
			'render_callback' => function() {
				return get_template_part( 'section/section', 'service' );
			}
		));

		// Service Section Button text.
		$wp_customize->add_setting( 'appzend_service_button', array(
			'default'           => esc_html__( 'Read More','appzend' ),
			'sanitize_callback' => 'sanitize_text_field'			
		) );

		$wp_customize->add_control( 'appzend_service_button', array(
			'label'    => esc_html__( 'Enter Services Button Text', 'appzend' ),
			'section'  => 'appzend_service_section',
			'type'     => 'text',
		));

		$wp_customize->add_setting('appzend_service_icon_and_before_color', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		));
		$wp_customize->add_control(new AppZend_Gradient_Control($wp_customize, 'appzend_service_icon_and_before_color', array(
			'label' => esc_html__('Icon/Hover Bg Color', 'appzend'),
			'section' => 'appzend_service_section'
		)));

		$wp_customize->add_setting('appzend_service_upgrade_text', array(
			'sanitize_callback' => 'sanitize_text_field'
		));
	
		$wp_customize->add_control(new Appzend_Upgrade_Text($wp_customize, 'appzend_service_upgrade_text', array(
			'section' => 'appzend_service_section',
			'label' => esc_html__('For more settings,', 'appzend'),
			'choices' => array(
				esc_html__('Select from four different layouts', 'appzend'),
				esc_html__('Change column number', 'appzend'),
				esc_html__('Advance service items', 'appzend'),
				esc_html__('Choose from Color/Gradient/Image background', 'appzend'),
			),
			'priority' => 100
		)));
