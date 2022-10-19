<?php
/**
 * Sanitize checkbox.
 * @param  $input Whether the checkbox is input.
 */
function appzend_sanitize_checkbox( $input ) {
  return ( ( isset( $input ) && true === $input ) ? true : false );
}

/**
 * Sanitization Select.
*/
function appzend_sanitize_select( $input, $setting ){
  //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
  $input = sanitize_key($input);
  //get the list of possible select options 
  $choices = $setting->manager->get_control( $setting->id )->choices;
  //return input if valid or return default option
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );  
}

/**
 * Switch Sanitization Function.
 *
 * @since 1.1
 */
function appzend_sanitize_switch($input) {

    $valid_keys = array(
        'enable'  => esc_html__( 'Yes', 'appzend' ),
        'disable' => esc_html__( 'No', 'appzend' )
    );

    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}