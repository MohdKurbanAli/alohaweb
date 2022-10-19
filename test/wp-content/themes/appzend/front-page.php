<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Appzend
 */
get_header();

/**
 * Enable Front Page
 */
do_action( 'appzend_enable_front_page' );

    $enable_front_page = get_theme_mod( 'appzend_enable_frontpage' ,'disable');

    if ($enable_front_page == 'enable'):

        $appzend_home_sections = appzend_homepage_section();
    
        foreach ($appzend_home_sections as $appzend_homepage_section) {
            if( get_theme_mod($appzend_homepage_section, 'disable') == 'enable'):
                $appzend_homepage_section = str_replace('appzend_', '', $appzend_homepage_section);
                $appzend_homepage_section = str_replace('_section', '', $appzend_homepage_section);
                get_template_part( 'section/section', $appzend_homepage_section );
            endif;
        }
        
    endif;

get_footer();