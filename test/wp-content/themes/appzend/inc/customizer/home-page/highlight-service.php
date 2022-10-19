<?php
    /**
	 * Highlight Service Section
	*/
	$wp_customize->add_section(new AppZend_Toggle_Section($wp_customize, 'appzend_highlight_service_section', array(
		'title'		=>	esc_html__('Highlight Service Section','appzend'),
		'panel'		=> 'appzend_frontpage_settings',
		'priority'  => appzend_get_section_position('appzend_highlight_service_section'),
		'hiding_control' => 'appzend_highlight_service_section',
	)));

		/**
		 * Tab Section
		 */
		$wp_customize->add_setting('appzend_highlight_service_nav', array(
			'sanitize_callback' => 'wp_kses_post',
		));


		$wp_customize->add_control(new AppZend_Custom_Control_Tab($wp_customize, 'appzend_highlight_service_nav', array(
			'type' => 'tab',
			'priority' => 1,
			'section' => 'appzend_highlight_service_section',
			'buttons' => array(
				array(
					'name' => esc_html__('Content', 'appzend'),
					'fields' => array(
						'appzend_highlight_service_section',
						'appzend_highlight_service_super_title',
						'appzend_highlight_service_title',
						'appzend_highlight_service_sub_title',
						'appzend_highlight_service_image',
						'appzend_highlight_service',
						'appzend_highlight_service_layout'
					),
					'active' => true,
				),
				array(
					'name' => esc_html__('Style', 'appzend'),
					'fields' => array(
						'appzend_highlight_service_bg_color',
						'appzend_highlight_service_super_title_color',
						'appzend_highlight_service_title_color',
						'appzend_highlight_service_subtitle_color',
						'appzend_highlight_service_color_group',
						'appzend_highlight_service_margin_msg',
						'appzend_highlight_service_margin',
						'appzend_highlight_service_padding',
						'appzend_highlight_service_alignment'
					),
				)
			),
		)));
		

		// Highlight Service Image
		$wp_customize->add_setting('appzend_highlight_service_image', array(
			'transport' => 'postMessage',
		    'sanitize_callback' => 'esc_url_raw',		
		    
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'appzend_highlight_service_image',
				array(
					'label'      => __( 'Highlight Image', 'appzend' ),
					'section' 	   => 'appzend_highlight_service_section',
			    	'settings' 	   => 'appzend_highlight_service_image',
					
				)
			)
		);
		
		// Highlight Service Page.
		$wp_customize->add_setting('appzend_highlight_service', array(
			'transport' => 'postMessage',
		    'sanitize_callback' => 'appzend_sanitize_repeater',		
		    'default' => json_encode(array(
		        array(
		            'page' => '',
		            'icon' =>'fa fa-cogs'
		        )
		    ))
		));

		$wp_customize->add_control(new AppZend_Repeater_Control( $wp_customize, 'appzend_highlight_service', 
			array(
			    'label' 	   => esc_html__('Highlights', 'appzend'),
			    'section' 	   => 'appzend_highlight_service_section',
			    'settings' 	   => 'appzend_highlight_service',
			    'box_label' => esc_html__('Item #', 'appzend'),
			    'add_label' => esc_html__('Add New', 'appzend'),
			),
		    array(
		        'page' => array(
		            'type' => 'select',
		            'label' => esc_html__('Select Page', 'appzend'),
		            'options' => $pages
		        )
			)
		));

		$wp_customize->selective_refresh->add_partial( 'highlight_service', array(
			'settings' => array( 'appzend_highlight_service' ),
			'selector' => '#highlight-service-section',
			'contianer_inclusive' => true,
			'render_callback' => function() {
				return get_template_part( 'section/section', 'highlight_service' );
			}
		));

		// Highlight Service Section Layout.
		$wp_customize->add_setting( 'appzend_highlight_service_layout', array(
			'transport' => 'postMessage',
			'default' => 'layout-one',
			'sanitize_callback' => 'appzend_sanitize_select'			
		) );

		$wp_customize->add_control( 'appzend_highlight_service_layout', array(
			'label'    => esc_html__( 'Layout', 'appzend' ),
			'section'  => 'appzend_highlight_service_section',
			'type'     => 'select',
			'choices'  => array(
				'layout-one'  => esc_html__('Layout One', 'appzend'),
				'layout-two'  => esc_html__('Layout Two', 'appzend'),
			)
		));

		$wp_customize->add_setting('appzend_highlight_upgrade_text', array(
			'sanitize_callback' => 'sanitize_text_field'
		));
	
		$wp_customize->add_control(new Appzend_Upgrade_Text($wp_customize, 'appzend_highlight_upgrade_text', array(
			'section' => 'appzend_highlight_service_section',
			'label' => esc_html__('For more settings,', 'appzend'),
			'choices' => array(
				esc_html__('Five different title styles', 'appzend'),
				esc_html__('Change column number', 'appzend'),
				esc_html__('Choose between default and advance items', 'appzend'),
				esc_html__('Set position of highlight image', 'appzend'),
				esc_html__('Three different layouts', 'appzend'),
				esc_html__('Choose from Color/Gradient/Image background', 'appzend'),
			),
			'priority' => 100
		)));	