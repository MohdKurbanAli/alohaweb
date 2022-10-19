<?php
/**
 * Customizer Control: appzend-switch
 *
 * @subpackage  Controls
 * @since       1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'AppZend_Background_Control' ) ) :
   /**
     * Background Control
     */
    class AppZend_Background_Control extends WP_Customize_Upload_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'background-image';
        /**
         * Mime type for upload control.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $mime_type = 'image';
        /**
         * Labels for upload control buttons.
         *
         * @since  1.0.0
         * @access public
         * @var    array
         */
        public $button_labels = array();
        /**
         * Field labels
         *
         * @since  1.0.0
         * @access public
         * @var    array
         */
        public $field_labels = array();
        /**
         * Background choices for the select fields.
         *
         * @since  1.0.0
         * @access public
         * @var    array
         */
        public $background_choices = array();
        /**
         * Constructor.
         *
         * @since 1.0.0
         * @uses WP_Customize_Upload_Control::__construct()
         *
         * @param WP_Customize_Manager $manager Customizer bootstrap instance.
         * @param string               $id      Control ID.
         * @param array                $args    Optional. Arguments to override class property defaults.
         */
        public function __construct($manager, $id, $args = array()) {
            // Calls the parent __construct
            parent::__construct($manager, $id, $args);
            // Set button labels for image uploader
            $button_labels = $this->get_button_labels();
            $this->button_labels = apply_filters('customizer_background_button_labels', $button_labels, $id);
            // Set field labels
            $field_labels = $this->get_field_labels();
            $this->field_labels = apply_filters('customizer_background_field_labels', $field_labels, $id);
            // Set background choices
            $background_choices = $this->get_background_choices();
            $this->background_choices = apply_filters('customizer_background_choices', $background_choices, $id);
        }
        /**
         * 
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_style('appzend-background-control', get_template_directory_uri() . '/inc/custom-controller/background-control/background.css', array(), '1.0.0');
            wp_enqueue_script('appzend-background-control', get_template_directory_uri().'/inc/custom-controller/background-control/background.js', array( 'jquery', 'jquery-ui-datepicker' ), '1.0.0', true);
        }
        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $background_choices = $this->background_choices;
            $field_labels = $this->field_labels;
            // Loop through each of the settings and set up the data for it.
            foreach ($this->settings as $setting_key => $setting_id) {
                $this->json[$setting_key] = array(
                    'link' => $this->get_link($setting_key),
                    'value' => $this->value($setting_key),
                    'label' => isset($field_labels[$setting_key]) ? $field_labels[$setting_key] : ''
                );
                if ('image_url' === $setting_key) {
                    if ($this->value($setting_key)) {
                        // Get the attachment model for the existing file.
                        $attachment_id = attachment_url_to_postid($this->value($setting_key));
                        if ($attachment_id) {
                            $this->json['attachment'] = wp_prepare_attachment_for_js($attachment_id);
                        }
                    }
                } elseif ('repeat' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['repeat'];
                } elseif ('size' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['size'];
                } elseif ('position' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['position'];
                } elseif ('attach' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['attach'];
                }
            }
        }
        /**
         * Render a JS template for the content of the media control.
         *
         * @since 1.0.0
         */
        public function content_template() {
            parent::content_template();
            ?>
            <div class="background-image-fields">
                <# if ( data.attachment && data.repeat && data.repeat.choices ) { #>
                <li class="background-image-repeat">
                    <# if ( data.repeat.label ) { #>
                    <span class="customize-control-title">{{ data.repeat.label }}</span>
                    <# } #>
                    <select {{{ data.repeat.link }}}>
                        <# _.each( data.repeat.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.repeat.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>
                <# if ( data.attachment && data.size && data.size.choices ) { #>
                <li class="background-image-size">
                    <# if ( data.size.label ) { #>
                    <span class="customize-control-title">{{ data.size.label }}</span>
                    <# } #>
                    <select {{{ data.size.link }}}>
                        <# _.each( data.size.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.size.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>
                <# if ( data.attachment && data.position && data.position.choices ) { #>
                <li class="background-image-position">
                    <# if ( data.position.label ) { #>
                    <span class="customize-control-title">{{ data.position.label }}</span>
                    <# } #>
                    <select {{{ data.position.link }}}>
                        <# _.each( data.position.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.position.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>
                <# if ( data.attachment && data.attach && data.attach.choices ) { #>
                <li class="background-image-attach">
                    <# if ( data.attach.label ) { #>
                    <span class="customize-control-title">{{ data.attach.label }}</span>
                    <# } #>
                    <select {{{ data.attach.link }}}>
                        <# _.each( data.attach.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.attach.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>
            </div>
            <?php
        }
        /**
         * Returns button labels.
         *
         * @since 1.0.0
         */
        public static function get_button_labels() {
            $button_labels = array(
                'select' => esc_html__('Select Image', 'appzend'),
                'change' => esc_html__('Change Image', 'appzend'),
                'remove' => esc_html__('Remove', 'appzend'),
                'default' => esc_html__('Default', 'appzend'),
                'placeholder' => esc_html__('No image selected', 'appzend'),
                'frame_title' => esc_html__('Select Image', 'appzend'),
                'frame_button' => esc_html__('Choose Image', 'appzend'),
            );
            return $button_labels;
        }
        /**
         * Returns field labels.
         *
         * @since 1.0.0
         */
        public static function get_field_labels() {
            $field_labels = array(
                'repeat' => esc_html__('Repeat', 'appzend'),
                'size' => esc_html__('Size', 'appzend'),
                'position' => esc_html__('Position', 'appzend'),
                'attach' => esc_html__('Attachment', 'appzend')
            );
            return $field_labels;
        }
        /**
         * Returns the background choices.
         *
         * @since 1.0.0
         * @return array
         */
        public static function get_background_choices() {
            $choices = array(
                'repeat' => array(
                    'no-repeat' => esc_html__('No Repeat', 'appzend'),
                    'repeat' => esc_html__('Tile', 'appzend'),
                    'repeat-x' => esc_html__('Tile Horizontally', 'appzend'),
                    'repeat-y' => esc_html__('Tile Vertically', 'appzend')
                ),
                'size' => array(
                    'auto' => esc_html__('Default', 'appzend'),
                    'cover' => esc_html__('Cover', 'appzend'),
                    'contain' => esc_html__('Contain', 'appzend')
                ),
                'position' => array(
                    'left-top' => esc_html__('Left Top', 'appzend'),
                    'left-center' => esc_html__('Left Center', 'appzend'),
                    'left-bottom' => esc_html__('Left Bottom', 'appzend'),
                    'right-top' => esc_html__('Right Top', 'appzend'),
                    'right-center' => esc_html__('Right Center', 'appzend'),
                    'right-bottom' => esc_html__('Right Bottom', 'appzend'),
                    'center-top' => esc_html__('Center Top', 'appzend'),
                    'center-center' => esc_html__('Center Center', 'appzend'),
                    'center-bottom' => esc_html__('Center Bottom', 'appzend')
                ),
                'attach' => array(
                    'fixed' => esc_html__('Fixed', 'appzend'),
                    'scroll' => esc_html__('Scroll', 'appzend')
                )
            );
            return $choices;
        }
    }
    $wp_customize->register_control_type('AppZend_Background_Control');
endif;