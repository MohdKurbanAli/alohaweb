<?php
/**
 * Header Settings.
*/
$wp_customize->add_panel('appzend_footer_settings', array(
    'title'		=>	esc_html__('Footer Setting','appzend'),
    'priority'	=>	100,
));

/* Footer Sidebar*/
$footer_sidebar = $wp_customize->get_section( 'sidebar-widgets-footer-1' );

if($footer_sidebar){
    $footer_sidebar->panel    = 'appzend_footer_settings';
	$footer_sidebar->title    = esc_html__( 'Footer Widgets', 'appzend' );
	$footer_sidebar->priority = 110;
}