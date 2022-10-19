<?php
    /**
	 * Call To Action Section
	*/
	$wp_customize->add_section(new AppZend_Toggle_Section($wp_customize,'appzend_calltoaction_section', array(
		'title'		=> 	esc_html__('Call To Action Section','appzend'),
		'panel'		=> 'appzend_frontpage_settings',
		'priority'  => appzend_get_section_position('appzend_calltoaction_section'),
		'hiding_control' => 'appzend_calltoaction_section',
	)));


		/**
		 * Tab Section
		 */
		$wp_customize->add_setting('appzend_calltoaction_nav', array(
			'sanitize_callback' => 'wp_kses_post',
		));


		$wp_customize->add_control(new AppZend_Custom_Control_Tab($wp_customize, 'appzend_calltoaction_nav', array(
			'type' => 'tab',
			'priority' => 1,
			'section' => 'appzend_calltoaction_section',
			'buttons' => array(
				array(
					'name' => esc_html__('Content', 'appzend'),
					'fields' => array(
						'appzend_calltoaction_section',
						'appzend_calltoaction_super_title',
						'appzend_calltoaction_title',
						'appzend_calltoaction_sub_title',
						'appzend_calltoaction_image',
						'appzend_calltoaction_button',
						'appzend_calltoaction_link',
						'appzend_calltoaction_button_one',
						'appzend_calltoaction_link_one',
					),
					'active' => true,
				),
				array(
					'name' => esc_html__('Style', 'appzend'),
					'fields' => array(
						'appzend_calltoaction_bg_color',
						'appzend_calltoaction_super_title_color',
						'appzend_calltoaction_title_color',
						'appzend_calltoaction_subtitle_color',
						'appzend_calltoaction_color_group',
						'appzend_calltoaction_margin_msg',
						'appzend_calltoaction_margin',
						'appzend_calltoaction_padding',
						'appzend_calltoaction_alignment'
					),
				)
			),
		)));   

		// Call To Action Image.
		$wp_customize->add_setting('appzend_calltoaction_image', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw'		
		));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'appzend_calltoaction_image', array(
			'label'	   => esc_html__('Upload Background Image','appzend'),
			'section'  => 'appzend_calltoaction_section',
			'type'	   => 'image',
		)));


		// Call To Action Button.
		$wp_customize->add_setting('appzend_calltoaction_button', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field'		
		));

		$wp_customize->add_control('appzend_calltoaction_button', array(
			'label'	   => esc_html__('Enter Button One Text','appzend'),
			'section'  => 'appzend_calltoaction_section',
			'type'	   => 'text',
		));

		
		// Call To Action Button Link.
		$wp_customize->add_setting('appzend_calltoaction_link', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw'		
		));

		$wp_customize->add_control('appzend_calltoaction_link', array(
			'label'	   => esc_html__('Enter Button One Link','appzend'),
			'section'  => 'appzend_calltoaction_section',
			'type'	   => 'url',
		));


		// Call To Action Button.
		$wp_customize->add_setting('appzend_calltoaction_button_one', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field'		
		));

		$wp_customize->add_control('appzend_calltoaction_button_one', array(
			'label'	   => esc_html__('Enter Button Two Text','appzend'),
			'section'  => 'appzend_calltoaction_section',
			'type'	   => 'text',
		));
		
		// Call To Action Button Link.
		$wp_customize->add_setting('appzend_calltoaction_link_one', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw'		
		));

		$wp_customize->add_control('appzend_calltoaction_link_one', array(
			'label'	   => esc_html__('Enter Button Two Link','appzend'),
			'section'  => 'appzend_calltoaction_section',
			'type'	   => 'url',
		));

		$wp_customize->add_setting('appzend_cta_upgrade_text', array(
			'sanitize_callback' => 'sanitize_text_field'
		));
	
		$wp_customize->add_control(new Appzend_Upgrade_Text($wp_customize, 'appzend_cta_upgrade_text', array(
			'section' => 'appzend_calltoaction_section',
			'label' => esc_html__('For more settings,', 'appzend'),
			'choices' => array(
				esc_html__('Change title styles', 'appzend'),
				esc_html__('Different types of layout', 'appzend'),
				esc_html__('Change number of columns', 'appzend'),
				esc_html__('Switch between Color/Gradient/Image background', 'appzend'),
			),
			'priority' => 100
		)));

		$wp_customize->selective_refresh->add_partial( 'appzend_calltoaction', array(
            'selector'        => '#app-cta',
        ) );
