<?php
    /**
	 * Features Service Section 
	*/
	$wp_customize->add_section(new AppZend_Toggle_Section($wp_customize,'appzend_features_service_section', array(
		'title'		=>	esc_html__('Features Service Section','appzend'),
		'panel'		=> 'appzend_frontpage_settings',
		'priority'  => appzend_get_section_position('appzend_features_service_section'),
		'hiding_control' => 'appzend_features_service_section',
	)));


		//others settings from common settings
		
		/**
		 * Tab Section
		 */
		$wp_customize->add_setting('appzend_features_service_nav', array(
			'sanitize_callback' => 'wp_kses_post',
		));


		$wp_customize->add_control(new AppZend_Custom_Control_Tab($wp_customize, 'appzend_features_service_nav', array(
			'type' => 'tab',
			'section' => 'appzend_features_service_section',
			'priority' => 1,
			'buttons' => array(
				array(
					'name' => esc_html__('Content', 'appzend'),
					'fields' => array(
						'appzend_features_service_section',
						'appzend_features_service_super_title',
						'appzend_features_service_title',
						'appzend_features_service_sub_title',
						'appzend_features_service'
					),
					'active' => true,
				),
				array(
					'name' => esc_html__('Style', 'appzend'),
					'fields' => array(
						'appzend_features_service_bg_color',
						'appzend_features_service_super_title_color',
						'appzend_features_service_title_color',
						'appzend_features_service_subtitle_color',
						'appzend_features_service_color_group',
					),
				),
				array(
					'name' => esc_html__('Advance', 'appzend'),
					'fields' => array(
						'appzend_features_service_margin_msg',
						'appzend_features_service_margin',
						'appzend_features_service_padding',
						'appzend_features_service_alignment'
					),
				),
			),
		)));   


		//  Features Service Page.
		$wp_customize->add_setting('appzend_features_service', array(
			'transport' => 'postMessage',
		    'sanitize_callback' => 'appzend_sanitize_repeater',		
		    'default' => json_encode(array(
		        array(
		            'page' => '',
		            'icon' =>'fa fa-cogs',

		        )
		    ))
		));

		$wp_customize->add_control(new AppZend_Repeater_Control( $wp_customize, 
			'appzend_features_service', 
			array(
			    'label' 	   => esc_html__('Feature Items', 'appzend'),
			    'section' 	   => 'appzend_features_service_section',
			    'settings' 	   => 'appzend_features_service',
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

		$wp_customize->selective_refresh->add_partial( 'features_service', array(
			'settings' => 'appzend_features_service',
			'selector' => '#get-started',
			'container_inclusive' => true,
			'render_callback' => function() {
				return get_template_part( 'section/section', 'features_service' );
			}
		));

		$wp_customize->add_setting('appzend_features_upgrade_text', array(
			'sanitize_callback' => 'sanitize_text_field'
		));
	
		$wp_customize->add_control(new Appzend_Upgrade_Text($wp_customize, 'appzend_features_upgrade_text', array(
			'section' => 'appzend_features_service_section',
			'label' => esc_html__('For more settings,', 'appzend'),
			'choices' => array(
				esc_html__('Select from five different title styles', 'appzend'),
				esc_html__('Four different layouts to choose from', 'appzend'),
				esc_html__('Set column number', 'appzend'),
				esc_html__('Advance features items', 'appzend'),
				esc_html__('Three different types of background', 'appzend'),
			),
			'priority' => 100
		)));