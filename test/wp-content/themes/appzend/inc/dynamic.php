<?php
/**
 * Dynamic css
*/
if (! function_exists('appzend_dynamic_css')){

	function appzend_dynamic_css(){

        $primary_color    = get_theme_mod('appzend_primary_color','#f64d2b');
        $px = 70;

		$appzend_dynamic = $appzend_dynamic_tablet = $appzend_dynamic_mobile = '';

        /**
         * Primary Navigation
         */
        $nav_bg_color = get_theme_mod('appzend_menu_bg');
        if($nav_bg_color){
            $appzend_dynamic .= " .site-header, .box-header-nav .main-menu .children, .box-header-nav .main-menu .sub-menu {background-color: {$nav_bg_color}}";
        }
        $nav_text_color = get_theme_mod('appzend_menu_text_color');
        if($nav_text_color) $appzend_dynamic .="
            .box-header-nav .main-menu .menu-item a,
            .box-header-nav .main-menu .children > .page_item > a, 
            .box-header-nav .main-menu .sub-menu > .menu-item > a
            {color: $nav_text_color}";

        // button color 
        $btn_bg = get_theme_mod('appzend_button_bg_color') . '!important';
        $btn_text = get_theme_mod('appzend_button_text_color') . '!important';
        $btn_hov_bg = get_theme_mod('appzend_button_bg_hov_color') . '!important';
        $btn_hov_text = get_theme_mod('appzend_button_text_hov_color') . '!important';
        if( $btn_bg || $btn_text || $btn_hov_bg || $btn_hov_text){
            $appzend_dynamic .=".extralmenu-item .right-btn a{
                background-color: {$btn_bg};
                color: {$btn_text};
            }";

            $appzend_dynamic .=".extralmenu-item .right-btn a:hover{
                background-color: {$btn_hov_bg};
                color: {$btn_hov_text};
            }";
        }
        
        /**
         * Slider Dynamic
         */
        $_margin = get_theme_mod('appzend_slider_margin');
        //margin
        $_margin = json_decode( $_margin, true );
        $section_style = $section_style_tablet = $section_style_mobile = "";

        // desktop margin
        $_margin_desktop = appzend_cssbox_values_inline( $_margin, 'desktop' );
        if ( strpos( $_margin_desktop, 'px' ) !== false ) {
            $section_style3 = 'margin:' . $_margin_desktop . ';';
            $appzend_dynamic .=".bannerslider{ $section_style3 }";
        }
        // tablet margin
        $_margin_desktop = appzend_cssbox_values_inline( $_margin, 'tablet' );
        if ( strpos( $_margin_desktop, 'px' ) !== false ) {
            $section_style_tablet3= 'margin:' . $_margin_desktop . ';';
            $appzend_dynamic_tablet .=".bannerslider{ $section_style_tablet3 }";
        }
        // mobile margin
        $_margin_desktop = appzend_cssbox_values_inline( $_margin, 'mobile' );
        if ( strpos( $_margin_desktop, 'px' ) !== false ) {
            $section_style_mobile3 = 'margin:' . $_margin_desktop . ';';
            $appzend_dynamic_mobile .=".bannerslider{ $section_style_mobile3 }";
        }
        $_padding = get_theme_mod('appzend_slider_padding');
        $_padding = json_decode( $_padding, true );
        // desktop padding
        $_padding_desktop = appzend_cssbox_values_inline( $_padding, 'desktop' );
        if ( strpos( $_padding_desktop, 'px' ) !== false ) {
            $section_style .= 'padding:' . $_padding_desktop . ';';
        }
        // tablet padding
        $_padding_desktop = appzend_cssbox_values_inline( $_padding, 'tablet' );
        if ( strpos( $_padding_desktop, 'px' ) !== false ) {
            $section_style_tablet .= 'padding:' . $_padding_desktop . ';';
        }
        // mobile padding
        $_padding_desktop = appzend_cssbox_values_inline( $_padding, 'mobile' );
        if ( strpos( $_padding_desktop, 'px' ) !== false ) {
            $section_style_mobile .= 'padding:' . $_padding_desktop . ';';
        }

        /** height */
        $slider_height = get_theme_mod('appzend_slider_height', 550);
        $section_style .= 'height: '.$slider_height .'px;';
        $slider_height = get_theme_mod('appzend_slider_height_tablet');
        if($slider_height) $section_style_tablet .= 'height: '.$slider_height .'px;';
        
        $slider_height = get_theme_mod('appzend_slider_height_mobile');
        if($slider_height) $section_style_mobile .= 'height: '.$slider_height .'px;';


        if($section_style) $appzend_dynamic .= ".bannerwrap{ {$section_style} } ";
        if($section_style_tablet) $appzend_dynamic_tablet .= ".bannerwrap { {$section_style_tablet} } ";
        if($section_style_mobile) $appzend_dynamic_mobile .= ".bannerwrap { {$section_style_mobile} } ";

        


        // Theme Primary Background Colors.
        $appzend_dynamic .= "
            .articlesListing .article .btns .btn,
            .btn-primary,
            .btn-border:hover,
            .post-format-media-quote,
            .bannerwrap .slider-content a,
            .widget_product_search a.button, 
            .widget_product_search button, 
            .widget_product_search input[type='submit'], 
            .widget_search .search-submit,
            .page-numbers,
            .reply .comment-reply-link,
            a.button, button, input[type='submit'],
            .wpcf7 input[type='submit'], 
            .wpcf7 input[type='button'],
            .calendar_wrap caption,
            .posts-tag ul li,
            .arrow-top-line{
            
            background-color: $primary_color;
            
        }\n";

        

        /**
         * WooCommerce
        */
        
        $appzend_dynamic .= "
        body.woocommerce-active ul.products li.product .woocommerce-loop-category__title,
        body.woocommerce-active a.added_to_cart, 
        body.woocommerce-active a.button.add_to_cart_button, 
        body.woocommerce-active a.button.product_type_grouped, 
        body.woocommerce-active a.button.product_type_external, 
        body.woocommerce-active a.button.product_type_variable,
        body.woocommerce-active a.added_to_cart:before, 
        body.woocommerce-active a.button.add_to_cart_button:before, 
        body.woocommerce-active a.button.product_type_grouped:before, 
        body.woocommerce-active a.button.product_type_external:before, 
        body.woocommerce-active a.button.product_type_variable:before,
        body.woocommerce-active nav.woocommerce-pagination ul li a:focus, 
        body.woocommerce-active nav.woocommerce-pagination ul li a:hover, 
        body.woocommerce-active nav.woocommerce-pagination ul li span.current,
        body.woocommerce-active #respond input#submit, 
        body.woocommerce-active a.button, 
        body.woocommerce-active button.button, 
        body.woocommerce-active input.button,
        body.woocommerce-active #respond input#submit:hover, 
        body.woocommerce-active a.button:hover, 
        body.woocommerce-active button.button:hover, 
        body.woocommerce-active input.button:hover,
        body.woocommerce-active .widget_price_filter .price_slider_wrapper .ui-widget-content,
        body.woocommerce-active #respond input#submit.alt.disabled, 
        body.woocommerce-active #respond input#submit.alt.disabled:hover, 
        body.woocommerce-active #respond input#submit.alt:disabled, 
        body.woocommerce-active #respond input#submit.alt:disabled:hover, 
        body.woocommerce-active #respond input#submit.alt:disabled[disabled], 
        body.woocommerce-active #respond input#submit.alt:disabled[disabled]:hover, 
        body.woocommerce-active a.button.alt.disabled, 
        body.woocommerce-active a.button.alt.disabled:hover, 
        body.woocommerce-active a.button.alt:disabled, 
        body.woocommerce-active a.button.alt:disabled:hover, 
        body.woocommerce-active a.button.alt:disabled[disabled], 
        body.woocommerce-active a.button.alt:disabled[disabled]:hover, 
        body.woocommerce-active button.button.alt.disabled, 
        body.woocommerce-active button.button.alt.disabled:hover, 
        body.woocommerce-active button.button.alt:disabled, 
        body.woocommerce-active button.button.alt:disabled:hover, 
        body.woocommerce-active button.button.alt:disabled[disabled], 
        body.woocommerce-active button.button.alt:disabled[disabled]:hover, 
        body.woocommerce-active input.button.alt.disabled, 
        body.woocommerce-active input.button.alt.disabled:hover, 
        body.woocommerce-active input.button.alt:disabled, 
        body.woocommerce-active input.button.alt:disabled:hover, 
        body.woocommerce-active input.button.alt:disabled[disabled], 
        body.woocommerce-active input.button.alt:disabled[disabled]:hover,
        .single-product div.product .entry-summary .flash .appzend_sale_label,
        body.woocommerce-active #respond input#submit.alt, 
        body.woocommerce-active a.button.alt, 
        body.woocommerce-active button.button.alt, 
        body.woocommerce-active input.button.alt,
        body.woocommerce-active #respond input#submit.alt:hover, 
        body.woocommerce-active a.button.alt:hover, 
        body.woocommerce-active button.button.alt:hover, 
        body.woocommerce-active input.button.alt:hover,
        body.woocommerce-active .woocommerce-MyAccount-navigation ul li a,
        
        .not-found .backhome a,
        body.woocommerce-active .appzend-buttons-wrapper .products_item_info a,
        .owl-carousel .owl-nav button.owl-next:hover, 
        .owl-carousel .owl-nav button.owl-prev:hover,
        .owl-carousel .owl-nav button.owl-next.focus-visible, 
        .owl-carousel .owl-nav button.owl-prev.focus-visible,
        .calltoaction_promo_wrapper .calltoaction_button_wrap a
        {
                background-color: $primary_color;

        }\n";

        $appzend_dynamic .= "
        body.woocommerce-active a.added_to_cart:hover, 
        body.woocommerce-active a.button.add_to_cart_button:hover, 
        body.woocommerce-active a.button.product_type_grouped:hover, 
        body.woocommerce-active a.button.product_type_external:hover, 
        body.woocommerce-active a.button.product_type_variable:hover,
        body.woocommerce-active nav.woocommerce-pagination ul li,
        body.woocommerce-active a.added_to_cart, 
        body.woocommerce-active a.button.add_to_cart_button, 
        body.woocommerce-active a.button.product_type_grouped, 
        body.woocommerce-active a.button.product_type_external, 
        body.woocommerce-active a.button.product_type_variable,
        body.woocommerce-active nav.woocommerce-pagination ul li,
        body.woocommerce-active-message, 
        body.woocommerce-active-info,
        body.woocommerce-active .woocommerce-MyAccount-navigation ul li a:hover,
        body.woocommerce-active .woocommerce-MyAccount-navigation ul li:hover a, 
        
        .not-found .backhome a:hover,
        .not-found .backhome a,
        .cross-sells h2, .cart_totals h2, .up-sells h2:not(.woocommerce-loop-product__title), .related h2:not(.woocommerce-loop-product__title), .woocommerce-billing-fields h3, .woocommerce-shipping-fields h3, .woocommerce-additional-fields h3, #order_review_heading, .woocommerce-order-details h2, .woocommerce-column--billing-address h2, .woocommerce-column--shipping-address h2, .woocommerce-Address-title h3, .woocommerce-MyAccount-content h3, .wishlist-title h2, .woocommerce-account .woocommerce h2, .widget-area .widget .widget-title, .comments-area .comments-title,
        .page-numbers,
        .page-numbers:hover,
        .site-footer .widget h2.widget-title::before,
        .wpcf7 input[type='submit'], .wpcf7 input[type='button']
        {

                border-color: $primary_color;

        }\n";

        $appzend_dynamic .= "
        

        body.woocommerce-active a.added_to_cart:hover, 
        body.woocommerce-active a.button.add_to_cart_button:hover, 
        body.woocommerce-active a.button.product_type_grouped:hover, 
        body.woocommerce-active a.button.product_type_external:hover, 
        body.woocommerce-active a.button.product_type_variable:hover,
        body.woocommerce-active ul.products li.product .price, 
        body.woocommerce-active div.product p.price, 
        body.woocommerce-active div.product span.price,
        body.woocommerce-active nav.woocommerce-pagination ul li .page-numbers,
        body.woocommerce-active .product_list_widget .woocommerce-Price-amount,
        body.woocommerce-active .star-rating span, 
        body.woocommerce-active-page .star-rating span,
        body.woocommerce-active-message::before, 
        body.woocommerce-active-info::before,
        body.woocommerce-active .woocommerce-MyAccount-navigation ul li a:hover,
        body.woocommerce-active .woocommerce-MyAccount-content a:not(.button),
        
        .woocommerce-MyAccount-navigation ul li:hover a, 
        .woocommerce-MyAccount-navigation ul li a:hover,
        .appzend_products_item_details h3 a:hover,
        .appzend_products_item_details .price, 
        .comment-form-rating p.stars a,
        .not-found .page-header h1,
        .not-found .backhome a:hover,
        
        .site-footer .widget a:hover, 
        .site-footer .widget a:hover::before, 
        .site-footer .widget li:hover::before,
        .articlesListing .article .btns .btn.focus-visible,
        .articlesListing .article .btns .btn:hover,
        .page-numbers.current,
        .page-numbers:hover,
        .breadcrumb ul li a,
        .post-navigation a span,
        .sub-footer .copyright-wrap a,
        .logged-in-as a,
        .entry-content a,
        button.toggle.close-nav-toggle:hover,
        .color-primary,
        .banner-slider.owl-carousel .owl-nav [class*='owl-']:hover{
                color: $primary_color;
        }\n";

        $appzend_aboutus_text_color = get_theme_mod('appzend_aboutus_text_color');
        $appzend_aboutus_bg_color = get_theme_mod('appzend_aboutus_bg_color');
        $appzend_dynamic .= "
            .about_us_front{ 
                color: $appzend_aboutus_text_color; 
                background-color: $appzend_aboutus_bg_color;
            }
            .about_us_front h3{
                color: $appzend_aboutus_text_color;
            }
        ";


        $appzend_dynamic .= "@media (max-width: 992px) {
            .headerthree .nav-classic,
            .headerthree .nav-classic .nav-menu .box-header-nav{
                background-color: $primary_color;
            } 
            .headerthree .toggle-inner{
                color:#ffffff;
            }
        }\n";

        $dynamic_sections = array(
            'appzend_highlight_service'         => '#highlight-service-section',
            'appzend_features_service'          => '#get-started',
            'appzend_aboutus'                   => '#aboutus',
            'appzend_calltoaction'              => '#app-cta',
            'appzend_howitworks'                => '#app-how-it-works',
            'appzend_recentwork'                => '#app-portfolio',
            'appzend_service'                   => '#appzend-service-section',
            'appzend_productcat'                => '#cl-productcat-section',
            'appzend_producttype'               => '#cl-producttype-section',
            'appzend_producthotoffer'           => '#cl-hotoffer-section',

        );
        foreach($dynamic_sections as $section => $parent):
            
            $background         = get_theme_mod($section."_bg_color");
            $super_title_color  = get_theme_mod($section."_super_title_color");
            $title_color        = get_theme_mod($section."_title_color");
            $subtitle_color     = get_theme_mod($section."_subtitle_color");
            $_margin            = get_theme_mod($section."_margin");
            $_padding           = get_theme_mod($section."_padding");


            $box_bg_color      = get_theme_mod($section."_box_bg_color");
            $icon_color        = get_theme_mod($section."_icon_color");
            $box_title_color       = get_theme_mod($section."_box_title_color");
            $text_color        = get_theme_mod($section."_text_color");
            
            $bg_hov_color      = get_theme_mod($section."_bg_hov_color");
            $icon_hov_color    = get_theme_mod($section."_icon_hov_color");
            $title_hov_color    = get_theme_mod($section."_title_hov_color");
            $text_hov_color    = get_theme_mod($section."_text_hov_color");
            
            
            //margin
            $_margin = json_decode( $_margin, true );
            $section_style = $section_style_tablet = $section_style_mobile = "";

            // desktop margin
            $_margin_desktop = appzend_cssbox_values_inline( $_margin, 'desktop' );
            if ( strpos( $_margin_desktop, 'px' ) !== false ) {
                $section_style .= 'margin:' . $_margin_desktop . ';';
            }
            // tablet margin
            $_margin_desktop = appzend_cssbox_values_inline( $_margin, 'tablet' );
            if ( strpos( $_margin_desktop, 'px' ) !== false ) {
                $section_style_tablet .= 'margin:' . $_margin_desktop . ';';
            }
            // mobile margin
            $_margin_desktop = appzend_cssbox_values_inline( $_margin, 'mobile' );
            if ( strpos( $_margin_desktop, 'px' ) !== false ) {
                $section_style_mobile .= 'margin:' . $_margin_desktop . ';';
            }

            $_padding = json_decode( $_padding, true );
            // desktop padding
            $_padding_desktop = appzend_cssbox_values_inline( $_padding, 'desktop' );
            if ( strpos( $_padding_desktop, 'px' ) !== false ) {
                $section_style .= 'padding:' . $_padding_desktop . ';';
            }
            // tablet padding
            $_padding_desktop = appzend_cssbox_values_inline( $_padding, 'tablet' );
            if ( strpos( $_padding_desktop, 'px' ) !== false ) {
                $section_style_tablet .= 'padding:' . $_padding_desktop . ';';
            }
            // mobile padding
            $_padding_desktop = appzend_cssbox_values_inline( $_padding, 'mobile' );
            if ( strpos( $_padding_desktop, 'px' ) !== false ) {
                $section_style_mobile .= 'padding:' . $_padding_desktop . ';';
            }

            if( $background ) {
                $css = [];
                $css[] = "$background";
                $section_style .=  implode(';', $css);
            }
            if($section_style) $appzend_dynamic .= " {$parent} { $section_style } ";

            if($section_style_tablet) $appzend_dynamic_tablet .= " {$parent} { $section_style_tablet } ";

            if($section_style_mobile) $appzend_dynamic_mobile .= " {$parent} { $section_style_mobile } ";

            if($super_title_color){
                $appzend_dynamic .= "
                    {$parent} .headlines h4{
                        color: {$super_title_color};
                    }";
            }
            if($title_color){
                $appzend_dynamic .="
                {$parent} .headlines h2{
                    color: {$title_color};
                }";
            }
            if($subtitle_color){
                $appzend_dynamic .="
                {$parent} .headlines p{
                    color: {$subtitle_color};
                }";
            }


            /**
             * Box Dynamic
             */
            if($box_bg_color){
                $appzend_dynamic .= " {$parent} .section-box{ background-color: $box_bg_color }";
            }
            if($box_title_color){
                $appzend_dynamic .= " {$parent} .section-box .box-title{ color: $box_title_color }";
            }
            if($text_color){
                $appzend_dynamic .= " {$parent} .section-box .box-content{ color: $text_color }";
            }
            if($icon_color){
                $appzend_dynamic .= " {$parent} .section-box .box-icon{ color: $icon_color }";
            }
            if($bg_hov_color){
                if( $section === 'appzend_howitworks' ) {
                    $appzend_dynamic .= " {$parent} .section-box:hover{ background: $bg_hov_color }";
                } else {
                    $appzend_dynamic .= " {$parent} .section-box:hover{ background-color: $bg_hov_color }";
                }
            }
            if($title_hov_color){
                $appzend_dynamic .= " {$parent} .section-box:hover .box-title{ color: $title_hov_color }";
            }
            if($text_hov_color){
                $appzend_dynamic .= " {$parent} .section-box:hover .box-content{ color: $text_hov_color }";
            }
            if($icon_hov_color){
                $appzend_dynamic .= " {$parent} .section-box:hover .box-icon{ color: $icon_hov_color }";
            }
            
            if( $section == "appzend_features_service" ):
                $appzend_dynamic .= "
                    {$parent} .section-box .hex { background-color: $bg_hov_color; border-color: $bg_hov_color}
                    {$parent} .section-box:hover .hex { background-color: $box_bg_color; border-color: $box_bg_color}
                ";
            endif;
            
            if( $section == 'appzend_service'):
                $icon_bg_color = get_theme_mod($section."_icon_and_before_color");
                if( $icon_bg_color){
                    $css[] = "$icon_bg_color";
                    $section_style =  implode(';', $css);
                    $appzend_dynamic .= "
                        {$parent} .section-box .box-icon i.icon, {$parent} .get-started-item::before{ $section_style }
                    ";
                }
            endif;
        endforeach;


        if ( has_header_image() ) {
            $appzend_dynamic .= '#masthead{ background-image: url("' . esc_url( get_header_image() ) . '"); background-repeat: no-repeat; background-position: center center; background-size: cover; }';
        }

        global $post;
        $breadcrumb_attr = '';
        $meta_fields = array();
        if($post) $meta_fields = get_post_meta( $post->ID, 'post_meta', true );
        if( is_array( $meta_fields ) && array_key_exists( 'breadcrumb_disable', $meta_fields ) ) :
            if( $meta_fields['breadcrumb_disable'] ) {
            $breadcrumb_attr .= "display: none;";
            } 
        endif;

        $breadcrumb_img_url = get_theme_mod('appzend_breadcrumbs_image');
        if( $breadcrumb_img_url ) {
            $breadcrumb_attr .= "background-image: url( $breadcrumb_img_url );";
        }

        if( is_array( $meta_fields ) ) :
            if( array_key_exists( 'breadcrumb_overwrite_default', $meta_fields ) ) {
                $breadcrumb_img_url     = $meta_fields['breadcrumb_bg_image'];
                $breadcrumb_bg_color    = $meta_fields['breadcrumb_alpha_color'];
                $breadcrumb_margin      = $meta_fields['breadcrumb_margin'] . 'px';
                $breadcrumb_padding     = $meta_fields['breadcrumb_padding'] . 'px'; 
                if( $breadcrumb_img_url ) {
                    $breadcrumb_attr .= "background-image: url( $breadcrumb_img_url );";
                }
                if( $breadcrumb_bg_color ) {
                    $appzend_dynamic .= ".breadcrumb:before { background-image: none; background: $breadcrumb_bg_color; }";
                }
                if( $breadcrumb_margin ) {
                    $breadcrumb_attr .= "margin-top: $breadcrumb_margin; margin-bottom: $breadcrumb_margin;";
                }

                if( $breadcrumb_padding ) {
                    $breadcrumb_attr .= "padding-top: $breadcrumb_padding; padding-bottom: $breadcrumb_padding;";
                }
            }
        endif;

        $appzend_dynamic .= ".breadcrumb{ $breadcrumb_attr }";

        $appzend_dynamic .= "@media screen and (max-width:768px){{$appzend_dynamic_tablet}}";
        $appzend_dynamic .= "@media screen and (max-width:480px){{$appzend_dynamic_mobile}}";
        
        $appzend_dynamic = apply_filters( 'appzend_dynamic_css', $appzend_dynamic );

        wp_add_inline_style( 'appzend-style', appzend_strip_whitespace($appzend_dynamic) );
	}
}
add_action( 'wp_enqueue_scripts', 'appzend_dynamic_css', 99 );

function appzend_strip_whitespace($css) {
    $replace = array(
        "#/\*.*?\*/#s" => "", // Strip C style comments.
        "#\s\s+#" => " ", // Strip excess whitespace.
    );
    $search = array_keys($replace);
    $css = preg_replace($search, $replace, $css);

    $replace = array(
        ": " => ":",
        "; " => ";",
        " {" => "{",
        " }" => "}",
        ", " => ",",
        "{ " => "{",
        ";}" => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} " => "}", // Put each rule on it's own line.
    );
    $search = array_keys($replace);
    $css = str_replace($search, $replace, $css);

    return trim($css);
}