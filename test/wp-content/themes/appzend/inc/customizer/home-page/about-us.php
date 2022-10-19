<?php
    /**
	 * About Us Section 
	*/
	$wp_customize->add_section(new AppZend_Toggle_Section($wp_customize, 'appzend_aboutus_section', array(
		'title'		=>	esc_html__('About Us Section','appzend'),
		'panel'		=> 'appzend_frontpage_settings',
		'priority'  => appzend_get_section_position('appzend_aboutus_section'),
		'hiding_control' => 'appzend_aboutus_service_section',
	)));
		/**
		 * Tab Section
		 */
		$wp_customize->add_setting('appzend_aboutus_nav', array(
			'sanitize_callback' => 'wp_kses_post',
		));


		$wp_customize->add_control(new AppZend_Custom_Control_Tab($wp_customize, 'appzend_aboutus_nav', array(
			'type' => 'tab',
			'priority' => 1,
			'section' => 'appzend_aboutus_section',
			'buttons' => array(
				array(
					'name' => esc_html__('Content', 'appzend'),
					'fields' => array(
						'appzend_aboutus_section',
						'appzend_aboutus_super_title',
						'appzend_aboutus_title',
						'appzend_aboutus_sub_title',
						'appzend_aboutus',
						'appzend_aboutus_email_address',
						'appzend_aboutus_phone_number',
					),
					'active' => true,
				),
				array(
					'name' => esc_html__('Style', 'appzend'),
					'fields' => array(
						'appzend_aboutus_bg_color',
						'appzend_aboutus_super_title_color',
						'appzend_aboutus_title_color',
						'appzend_aboutus_subtitle_color',
						'appzend_aboutus_color_group',
					),
				),
				array(
					'name' => esc_html__('Advance', 'appzend'),
					'fields' => array(
						'appzend_aboutus_margin_msg',
						'appzend_aboutus_margin',
						'appzend_aboutus_padding',
						'appzend_aboutus_alignment'
					),
				)
			),
		)));   


		// About Us Page.
		$wp_customize->add_setting( 'appzend_aboutus', array(
			'sanitize_callback' => 'absint',
			'transport' => 'postMessage'
		) );

		$wp_customize->add_control( 'appzend_aboutus', array(
			'label'    => esc_html__( 'Select Page ', 'appzend' ),
			'section'  => 'appzend_aboutus_section',
			'type'     => 'dropdown-pages'
		));

		$wp_customize->selective_refresh->add_partial( 'aboutus', array(
			'settings' => array( 'appzend_aboutus' ),
			'selector' => "#aboutus",
			'container_inclusive' => true,
			'render_callback' => function() {
				return get_template_part( 'section/section', 'aboutus' );
			}
		));

		$wp_customize->add_setting( 'appzend_aboutus_email_address', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',		
		));

		$wp_customize->add_control( 'appzend_aboutus_email_address', array(
			'label'    => esc_html__( 'Email Address', 'appzend' ),
			'section'  => 'appzend_aboutus_section',
			'type'     => 'text',
		));

		$wp_customize->add_setting( 'appzend_aboutus_phone_number', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'		
		) );

		$wp_customize->add_control( 'appzend_aboutus_phone_number', array(
			'label'    => esc_html__( 'Phone Number', 'appzend' ),
			'section'  => 'appzend_aboutus_section',
			'type'     => 'text',
		));

		$wp_customize->add_setting('appzend_about_us_upgrade_text', array(
			'sanitize_callback' => 'sanitize_text_field'
		));
	
		$wp_customize->add_control(new Appzend_Upgrade_Text($wp_customize, 'appzend_about_us_upgrade_text', array(
			'section' 	=> 'appzend_aboutus_section',
			'label' 	=> esc_html__('For more settings,', 'appzend'),
			'choices' 	=> array(
				esc_html__('Choose from five different title styles', 'appzend'),
				esc_html__('Select from four different layouts', 'appzend'),
				esc_html__('Three different types of background', 'appzend'),
			),
			'priority' => 100
		)));