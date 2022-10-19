<?php

function appzend_show_meta_field( $meta_field = '', $meta_array = '', $meta_field_val = '' ) {
	extract( $meta_field );
    //print_r( $meta_field );
    if( array_key_exists( 'appzend_meta_name', $meta_field ) )
        $field_name = $meta_array . "[" . $appzend_meta_name . "]";

    switch( $appzend_meta_field_type ) {

        case 'tabs' :
            ?>
                <div class="meta-tabs">
                    <?php 
                        foreach( $appzend_meta_field_options as $option => $val ) { ?>
                            <button class="w3-bar-item w3-button tablink" onclick="openTab(event, '<?php echo esc_attr( $option ) ?>')"><?php echo esc_html( $val ); ?></button>
                        <?php }
                    ?>
                </div>

            <?php
        break;

        case 'tabs_open' : 
            ?>
                <div id="<?php echo esc_attr( $appzend_meta_name ); ?>" class="w3-container tab_content" style="display:none">
            <?php
        break;

        case 'tabs_close' :
            ?>
                </div>
            <?php
        break;

        case 'select' :
            // $title_layout = isset( $post_meta_data['title_style'] ) ? $post_meta_data['title_style'] : '';
            ?>
            <div>
                <label class="title"><?php echo esc_html( $appzend_meta_title ); ?></label>
                <select name="<?php echo esc_attr( $field_name ); ?>">
                <?php
                foreach ( $appzend_meta_field_options as $val => $option ) {
                    ?>
                    <option value="<?php echo esc_attr( $val ); ?>" <?php selected( $val, $meta_field_val ); ?>><?php echo esc_html( $option ); ?></option>
                <?php } ?>

                </select>
            </div>
        <?php 
        break; 
        
        case 'title' :
            $title = isset( $post_meta_data['title'] ) ? $post_meta_data['title'] : '';
            ?>
                <div>
                <label class="title"><?php echo esc_html( $appzend_meta_title ); ?></label>
                <input type="text" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $meta_field_val ); ?>">
                </div>
            <?php
        break;

        case 'text' :
            ?>
            <div>
                <label class="title"><?php echo esc_html( $appzend_meta_title ); ?></label>
                <input type="text" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $meta_field_val ); ?>"> 
            </div>
        <?php
        break;

        case 'textarea' :
            ?>
            <div>
                <label class="title"><?php echo esc_html( $appzend_meta_title ); ?></label>
                <textarea name="<?php echo esc_attr( $field_name ) ?>" rows="<?php echo esc_attr( $appzend_meta_field_row ); ?>"><?php echo esc_html( $meta_field_val ); ?></textarea>
            </div>
        <?php
        break;

        case 'number' :
            ?>
            <div>
                <label class="title"><?php echo esc_html( $appzend_meta_title ) ?></label>
                <input type="number" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo intval( $meta_field_val ); ?>">
            </div>
        <?php
        break;

        case 'checkbox' :
            ?>
            <div>
                <label class="title"><?php echo esc_html( $appzend_meta_title ) ?></label>
                <label class="switch">
                    <input type="checkbox" class="<?php if( isset( $appzend_meta_field_class ) ) echo $appzend_meta_field_class; ?>" name="<?php echo esc_attr( $field_name ); ?>" <?php if( isset( $meta_field_val ) && $meta_field_val == 'on' ) { echo "checked"; } ?>>
                    <div class="slider round">
                    <!--ADDED HTML -->
                    <span class="on"><?php echo esc_html__( 'On', 'appzend' ); ?></span>
                    <span class="off"><?php echo esc_html__( 'Off', 'appzend' ); ?></span>
                    <!--END-->
                    </div>
                </label>
            </div>
        <?php
        break;

        case 'selector' :
            ?>
            <div>
                <label class="title"><?php echo esc_html( $appzend_meta_title ); ?></label>
                <?php 
                    $meta_field_val = !empty( $meta_field_val ) ? $meta_field_val : $appzend_meta_default;
                    foreach( $appzend_meta_field_options as $option => $val ) { ?>
                        <input type="radio" name="<?php echo esc_attr( $field_name ); ?>" id="<?php echo esc_attr( $option ) ?>" class="radio_item" value="<?php echo esc_attr( $option ) ?>" <?php checked( $option, $meta_field_val ); ?>>
                        <label class="label_item" for="<?php echo esc_attr( $option ) ?>"><img src="<?php echo esc_url( $val ); ?>"></label>
                <?php }
                ?>
            </div>
            <?php
        break;

        case 'upload' :
            ?>
                <div class="meta-image-wrapper">
                    <label class="title"><?php echo esc_html( $appzend_meta_title ); ?></label>
                    <?php 
                        if( isset( $meta_field_val ) && $meta_field_val != '' ) { ?>
                            <span class="meta-image">
                                <img src="<?php echo esc_url( $meta_field_val ); ?>" width="100px" height="100px">
                            </span> 
                    <?php } ?>
                    <button class="meta-upload-image-btn">Select Image</button>
                    <button class="meta-remove-image-btn">Remove Image</button>
                    <input type="hidden" class="meta-upload-image" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_url( $meta_field_val ); ?>">
                </div>
            <?php
            break;

        case 'color-picker' :
            ?>
                <div>
                    <label class="title"><?php echo esc_html( $appzend_meta_title ); ?></label>
                    <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo sanitize_text_field( $meta_field_val ); ?>"/>
                </div>
            <?php
            break;

        case 'range' :
        ?>
            <div>
                <label class="title"><?php echo esc_html( $appzend_meta_title ); ?></label>
                <input type="range" min="-200" max="200" value="<?php echo intval( $meta_field_val ) ?>" name="<?php echo esc_attr( $field_name ); ?>" class="meta-range">
                <input type="text" class="meta-range-val" value="<?php if( $meta_field_val != '' ) { echo intval( $meta_field_val ); } else { echo intval(1); } ?>" readonly>
            </div>
        <?php
        break;

        case 'wrapper' :
            ?>
                <div class="<?php echo esc_attr( $appzend_meta_field_class ); ?>">
            <?php
            break;

        case 'wrapper_close' :
            ?>
                </div>
            <?php
            break;

    }

}