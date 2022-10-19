<?php

add_action( 'wp_enqueue_scripts', 'bizberg_agency_chld_thm_parent_css' );
function bizberg_agency_chld_thm_parent_css() {

    wp_enqueue_style( 
    	'bizberg_agency_chld_css', 
    	trailingslashit( get_template_directory_uri() ) . 'style.css', 
    	array( 
    		'bootstrap',
    		'font-awesome-5',
    		'bizberg-main',
    		'bizberg-component',
    		'bizberg-style2',
    		'bizberg-responsive' 
    	) 
    );
    
}

add_filter( 'bizberg_banner_spacing', 'bizberg_agency_banner_spacing' );
function bizberg_agency_banner_spacing(){
    return [
        'padding-top'    => '200px',
        'padding-bottom' => '200px',
        'padding-left'   => '0px',
        'padding-right'  => '0px',
    ];
}

add_filter( 'bizberg_sidebar_spacing_status', 'bizberg_agency_sidebar_spacing_status' );
function bizberg_agency_sidebar_spacing_status(){
    return '0px';
}

add_filter( 'bizberg_sidebar_widget_border_color', 'bizberg_agency_sidebar_widget_background_color' );
add_filter( 'bizberg_sidebar_widget_background_color', 'bizberg_agency_sidebar_widget_background_color' );
function bizberg_agency_sidebar_widget_background_color(){
    return 'rgba(251,251,251,0)';
}

add_filter( 'bizberg_sidebar_settings', 'bizberg_agency_sidebar_settings' );
function bizberg_agency_sidebar_settings(){
    return '4';
}

add_filter( 'bizberg_three_col_listing_radius', 'bizberg_agency_three_col_listing_radius' );
function bizberg_agency_three_col_listing_radius(){
    return '0';
}

add_filter( 'bizberg_background_color_1', 'bizberg_agency_top_bar_background_1' );
add_filter( 'bizberg_background_color_2', 'bizberg_agency_top_bar_background_1' );
function bizberg_agency_top_bar_background_1(){
    return '#0088cc';
}

add_filter( 'bizberg_banner_title', 'bizberg_agency_banner_title' );
function bizberg_agency_banner_title(){
    return current_user_can( 'edit_theme_options' ) ? esc_html__( 'Welcome to Bizberg Agency' , 'bizberg-agency' ) : '';
}

add_filter( 'bizberg_banner_subtitle', 'bizberg_agency_banner_subtitle' );
function bizberg_agency_banner_subtitle(){
    return current_user_can( 'edit_theme_options' ) ? esc_html__( "Lorem Ipsum has been the industry's standard dummy" , 'bizberg-agency' ) : '';
}

add_filter( 'bizberg_banner_image', 'bizberg_agency_banner_image' );
function bizberg_agency_banner_image(){
    return [
        'background-color'      => 'rgba(20,20,20,.8)',
        'background-image'      => get_stylesheet_directory_uri() . '/images/computer-hand-man-working-person-technology-1076173-pxhere.com.jpg',
        'background-repeat'     => 'repeat',
        'background-position'   => 'center center',
        'background-size'       => 'cover',
        'background-attachment' => 'fixed'
    ];
}

add_filter( 'bizberg_banner_opacity_primary_color', 'bizberg_agency_banner_opacity_primary_color' );
function bizberg_agency_banner_opacity_primary_color(){
    return 'rgba(0,0,0,0.3)';
}

add_filter( 'bizberg_banner_opacity_secondary_color', 'bizberg_agency_banner_opacity_secondary_color' );
function bizberg_agency_banner_opacity_secondary_color(){
    return 'rgba(0,0,0,0.3)';
}

add_filter( 'bizberg_top_header_status', 'bizberg_agency_top_header_status' );
function bizberg_agency_top_header_status(){
    return false;
}

add_filter( 'bizberg_getting_started_screenshot', function(){
    return true;
});

add_action( 'after_setup_theme', 'bizberg_agency_setup_theme' );
function bizberg_agency_setup_theme() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
}