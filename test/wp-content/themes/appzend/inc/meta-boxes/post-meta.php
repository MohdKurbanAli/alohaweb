<?php

abstract class Post_Meta {

    static $post_meta = 'post_meta';

    public static function meta_fields() {

        $fields = array( 

            'tabs' => array(
                'appzend_meta_field_type' => 'tabs',
                'appzend_meta_field_options' => array(
                    'breadcrumb-setting' => esc_html__( 'Breadcrumb Setting', 'appzend' ),
                    'sidebar-setting' => esc_html__( 'Sidebar Setting', 'appzend' ),
                )
            ),

            'breadcrumb-setting-tab' => array(
                'appzend_meta_name'         => 'breadcrumb-setting',
                'appzend_meta_field_type'   => 'tabs_open',
            ),

            'breadcrumb_disable' => array(
                'appzend_meta_name'         => 'breadcrumb_disable',
                'appzend_meta_title'        => esc_html__( 'Hide Breadcrumb', 'appzend' ),
                'appzend_meta_field_type'   => 'checkbox',
            ),

            'breadcrumb_overwrite_default' => array(
                'appzend_meta_name'         => 'breadcrumb_overwrite_default',
                'appzend_meta_title'        => esc_html__( 'Overwrite Default Style', 'appzend' ),
                'appzend_meta_field_class'  => 'overwrite_defaults',
                'appzend_meta_field_type'   => 'checkbox',
            ),

            'breadcrumb_wrapper' => array(
                'appzend_meta_field_class' => 'meta_attr_container',
                'appzend_meta_field_type' => 'wrapper',
            ),

            'breadcrumb_alpha_color' => array(
                'appzend_meta_name' => 'breadcrumb_alpha_color',
                'appzend_meta_title' => esc_html__( 'Select Color', 'appzend' ),
                'appzend_meta_field_type' => 'color-picker',
            ),

            'breadcrumb_bg_image' => array(
                'appzend_meta_name'         => 'breadcrumb_bg_image',
                'appzend_meta_title'        => esc_html__( 'Upload Background Image', 'appzend' ),
                'appzend_meta_field_type'   => 'upload',
            ),

            'breadcrumb_margin_range' => array(
                'appzend_meta_name'         => 'breadcrumb_margin',
                'appzend_meta_title'        => esc_html__( 'Top Bottom Margin', 'appzend' ),
                'appzend_meta_field_type'   => 'range',
            ),

            'breadcrumb_padding_range' => array(
                'appzend_meta_name'         => 'breadcrumb_padding',
                'appzend_meta_title'        => esc_html__( 'Top Bottom Padding', 'appzend' ),
                'appzend_meta_field_type'   => 'range',
            ),

            'breadcrumb_wrapper_close' => array(
                'appzend_meta_field_type'   => 'wrapper_close', 
            ),

            'breadcrumb-setting-tab-close' => array(
                'appzend_meta_field_type'   => 'tabs_close', 
            ),

            'sidebar-setting-tab' => array(
                'appzend_meta_name'         => 'sidebar-setting',
                'appzend_meta_field_type'   => 'tabs_open',
            ),

            'sidebar_layout' => array(
                'appzend_meta_name'             => 'sidebar_layout',
                'appzend_meta_title'            => esc_html__( 'Sidebar Layout', 'appzend' ),
                'appzend_meta_default'          => 'right',
                'appzend_meta_field_type'       => 'selector',
                'appzend_meta_field_options'    => array(
                    'default'   => get_template_directory_uri(  ). "/assets/images/layout/default.png",
                    'left'      =>  get_template_directory_uri(  ). "/assets/images/layout/leftsidebar.png",
                    'no'        =>  get_template_directory_uri(  ). "/assets/images/layout/nosidebar.png",
                    'right'     =>  get_template_directory_uri(  ). "/assets/images/layout/rightsidebar.png",
                )
            ),

            'sidebar-setting-tab-close' => array(
                'appzend_meta_field_type'   => 'tabs_close', 
            ),

        );

        return $fields;
    }
    
    /**
     * Set up and add the meta box.
    */
    public static function add( $meta_box_attr ) {
        foreach ( $meta_box_attr[2] as $screen ) {
            add_meta_box(
                $meta_box_attr[0],          // Unique ID
                $meta_box_attr[1], // Box title
                [ self::class, 'html' ],   // Content callback, must be of type callable
                $screen                  // Post type
            );
        }
    }

    /**
     * Save the meta box selections.
    *
    * @param int $post_id  The post ID.
    */
    public static function save( int $post_id ) {
        $post_meta = self::$post_meta;
        $old = get_post_meta( $post_id, $post_meta, true );
        $new = '';
        if( isset( $_POST[$post_meta] ) ) 
            $new = $_POST[$post_meta];
        if ( $new && $new !== $old ) {
            update_post_meta( $post_id, $post_meta, $new );
        } elseif ( '' === $new && $old ) {
            delete_post_meta( $post_id, $post_meta, $old );
        }    
    }

    /**
     * Display the meta box HTML to the user.
    *
    * @param \WP_Post $post   Post object.
    */
    public static function html( $post ) {
        $post_meta = self::$post_meta;
        $post_meta_data = get_post_meta( $post->ID, $post_meta, true );
        $meta_fields = self::meta_fields();
        foreach ( $meta_fields as $meta_field ) {
            extract( $meta_field );
            // echo "\$appzend_meta_name : $appzend_meta_name" ;
            if( array_key_exists( 'appzend_meta_name', $meta_field ) ) {
                $meta_field_val = isset( $post_meta_data[$appzend_meta_name] ) ? $post_meta_data[$appzend_meta_name] : '' ;
            } else {
                $meta_field_val = '' ;
            }
            appzend_show_meta_field( $meta_field, $post_meta, $meta_field_val );
        }
    }
 
}

 
// $screenss[1] = 'post_page_meta_box_id';
// $add_2 = [ 'Post_Meta', 'save' ];
add_action( 'add_meta_boxes', function() { 
    $meta_box_title = esc_html__( 'AppZend Meta Settings', 'appzend' );
    $meta_box_attr  = [ 'meta_box_id', $meta_box_title, ['post','page'] ];
    Post_Meta::add( $meta_box_attr ); } );
add_action( 'save_post', [ 'Post_Meta', 'save' ] );