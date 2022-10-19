<?php
    /**
	 * How it Works Section. 
	*/
	$wp_customize->add_section(new AppZend_Toggle_Section($wp_customize,'appzend_howitworks_section', array(
		'title'		=> 	esc_html__('How it Works Section','appzend'),
		'panel'		=> 'appzend_frontpage_settings',
		'priority'  => appzend_get_section_position('appzend_howitworks_section'),
		'hiding_control' => 'appzend_howitworks_section',
	)));

		/**
		 * Tab Section
		 */
		$wp_customize->add_setting('appzend_howitworks_nav', array(
			'sanitize_callback' => 'wp_kses_post',
		));


		$wp_customize->add_control(new AppZend_Custom_Control_Tab($wp_customize, 'appzend_howitworks_nav', array(
			'type' => 'tab',
			'priority' => 1,
			'section' => 'appzend_howitworks_section',
			'buttons' => array(
				array(
					'name' => esc_html__('Content', 'appzend'),
					'fields' => array(
						'appzend_howitworks_section',
						'appzend_howitworks_super_title',
						'appzend_howitworks_title',
						'appzend_howitworks_sub_title',
						'appzend_howitworks_image',
						'appzend_howitworks',
					),
					'active' => true,
				),
				array(
					'name' => esc_html__('Style', 'appzend'),
					'fields' => array(
						'appzend_howitworks_bg_color',
						'appzend_howitworks_super_title_color',
						'appzend_howitworks_title_color',
						'appzend_howitworks_subtitle_color',
						'appzend_howitworks_color_group',
					),
				),
				array(
					'name' => esc_html__('Advance', 'appzend'),
					'fields' => array(
						'appzend_howitworks_margin_msg',
						'appzend_howitworks_margin',
						'appzend_howitworks_padding',
						'appzend_howitworks_alignment'
					),
				),
			),
		)));  

		// image
		$wp_customize->add_setting('appzend_howitworks_image', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw'		
		));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'appzend_howitworks_image', array(
			'label'	   => esc_html__('Image','appzend'),
			'section'  => 'appzend_howitworks_section',
			'type'	   => 'image',
		)));


		//  How it Works Page.
		$wp_customize->add_setting('appzend_howitworks', array(
			'transport' => 'postMessage',
		    'sanitize_callback' => 'appzend_sanitize_repeater',		
		    'default' => json_encode(array(
		        array(
		            'howitworks_page' => ''
		        )
		    ))
		));

		$wp_customize->add_control(new AppZend_Repeater_Control( $wp_customize,
			'appzend_howitworks',
			array(
			    'label' 	   => esc_html__('How it Works Items', 'appzend'),
			    'section' 	   => 'appzend_howitworks_section',
			    'settings' 	   => 'appzend_howitworks',
			    'box_label'    => esc_html__('Item#', 'appzend'),
			    'add_label'    => esc_html__('Add New', 'appzend'),
			),
		    array(
		        'howitworks_page' => array(
		            'type' => 'select',
		            'label' => esc_html__('Select Page', 'appzend'),
		            'options' => $pages
		        )
			)
		));

		$wp_customize->selective_refresh->add_partial( 'how_it_works', array( 
			'settings' => array( 'appzend_howitworks' ),
			'selector' => '#app-how-it-works',
			'container_inclusive' => true,
			'render_callback' => function() {
				return get_template_part( 'section/section', 'howitworks' );
			}
		));

		$wp_customize->add_setting('how_it_works_upgrade_text', array(
			'sanitize_callback' => 'sanitize_text_field'
		));
	
		$wp_customize->add_control(new Appzend_Upgrade_Text($wp_customize, 'how_it_works_upgrade_text', array(
			'section' => 'appzend_howitworks_section',
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