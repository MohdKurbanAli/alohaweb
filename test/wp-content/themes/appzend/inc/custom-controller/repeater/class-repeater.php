<?php
/**
 * Customizer Control: AppZend_Repeater_Control
 *
 * @subpackage  Controls
 * @since       1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'AppZend_Repeater_Control' ) ) :
    /**
    * Repeater Custom Control Function
    */
    class AppZend_Repeater_Control  extends WP_Customize_Control {
        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'repeater';
        public $box_label = '';
        public $add_label = '';
        private $cats = '';
        /**
         * The fields that each container row will contain.
         *
         * @access public
         * @var array
         */
        public $fields = array();
        /**
		 * enqueue css and scrpts
		 *
		 * @since  1.2.8
		 */
		public function enqueue() {
            wp_enqueue_style('appzend-repeater-control', get_template_directory_uri() . '/inc/custom-controller/repeater/repeater.css', array(), '1.0.0');
            wp_enqueue_script('appzend-repeater-control', get_template_directory_uri().'/inc/custom-controller/repeater/repeater.js', array( 'jquery', 'customize-controls' ), '1.0.0', true);
            wp_enqueue_style('font-awesome-icon-control', get_template_directory_uri() . '/inc/custom-controller/font-awesome-icon/font-awesome-icon.css', array(), '1.0.0');
			wp_enqueue_script('font-awesome-icon-control', get_template_directory_uri().'/inc/custom-controller/font-awesome-icon/font-awesome-icon.js', array( 'jquery', 'jquery-ui-slider' ), '1.0.0', true);
		}
        /**
         * Repeater drag and drop controller
         *
         * @since  1.0.0
         */
        public function __construct($manager, $id, $args = array(), $fields = array()) {
            $this->fields = $fields;
            $this->box_label = $args['box_label'];
            $this->add_label = $args['add_label'];
            $this->cats = get_categories(array('hide_empty' => false));
            parent::__construct($manager, $id, $args);
        }
        public function render_content() {
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>
            <ul class="appzend-repeater-field-control-wrap">
                <?php
                $this->get_fields();
                ?>
            </ul>
            <input type="hidden" <?php esc_attr($this->link()); ?> class="appzend-repeater-collector" value="<?php echo esc_attr($this->value()); ?>" />
            <button type="button" class="button appzend-add-control-field"><?php echo esc_html($this->add_label); ?></button>
            <?php
        }
        private function get_fields() {
            $fields = $this->fields;
            $values = json_decode($this->value());
            if (is_array($values)) {
                foreach ($values as $value) {
                    ?>
                    <li class="appzend-repeater-field-control">
                        <h3 class="appzend-repeater-field-title"><?php echo esc_html($this->box_label); ?></h3>
                        <div class="appzend-repeater-fields">
                            <?php
                            foreach ($fields as $key => $field) {
                                $class = isset($field['class']) ? $field['class'] : '';
                                ?>
                                <div class="appzend-fields appzend-type-<?php echo esc_attr($field['type']) . ' ' . esc_attr($class); ?>">
                                    <?php
                                    $label = isset($field['label']) ? $field['label'] : '';
                                    $description = isset($field['description']) ? $field['description'] : '';
                                    if ($field['type'] != 'checkbox') {
                                        ?>
                                        <span class="customize-control-repeater-title"><?php echo esc_html($label); ?></span>
                                        <span class="description customize-control-description"><?php echo esc_html($description); ?></span>
                                        <?php
                                    }
                                    $new_value = isset($value->$key) ? $value->$key : '';
                                    $default = isset($field['default']) ? $field['default'] : '';
                                    switch ($field['type']) {
                                        case 'url':
                                            echo '<input data-default="' . esc_attr($default) . '" data-name="' . esc_attr($key) . '" type="url" value="' . esc_attr($new_value) . '"/>';
                                            break;
                                        case 'text':
                                            echo '<input data-default="' . esc_attr($default) . '" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                            break;
                                        case 'textarea':
                                            echo '<textarea data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">' . esc_textarea($new_value) . '</textarea>';
                                            break;
                                        case 'upload':
                                            $image = $image_class = "";
                                            if ($new_value) {
                                                $image = '<img src="' . esc_url($new_value) . '" style="max-width:100%;"/>';
                                                $image_class = ' hidden';
                                            }
                                            echo '<div class="appzend-fields-wrap">';
                                            echo '<div class="attachment-media-view">';
                                            echo '<div class="placeholder' . esc_attr($image_class) . '">';
                                            esc_html_e('No image selected', 'appzend');
                                            echo '</div>';
                                            echo '<div class="thumbnail thumbnail-image">';
                                            echo $image;
                                            echo '</div>';
                                            echo '<div class="actions cl-clearfix">';
                                            echo '<button type="button" class="button appzend-delete-button align-left">' . esc_html__('Remove', 'appzend') . '</button>';
                                            echo '<button type="button" class="button appzend-upload-button alignright">' . esc_html__('Select Image', 'appzend') . '</button>';
                                            echo '<input data-default="' . esc_attr($default) . '" class="upload-id" data-name="' . esc_attr($key) . '" type="hidden" value="' . esc_attr($new_value) . '"/>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            break;
                                        case 'category':
                                            echo '<select data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                            echo '<option value="0">' . esc_html__('Select Category', 'appzend') . '</option>';
                                            echo '<option value="-1">' . esc_html__('Latest Posts', 'appzend') . '</option>';
                                            foreach ($this->cats as $cat) {
                                                printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($cat->term_id), selected($new_value, $cat->term_id, false), esc_html($cat->name));
                                            }
                                            echo '</select>';
                                            break;
                                        case 'select':
                                            $options = $field['options'];
                                            echo '<select  data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                            foreach ($options as $option => $val) {
                                                printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
                                            }
                                            echo '</select>';
                                            break;
                                        case 'checkbox':
                                            echo '<label>';
                                            echo '<input data-default="' . esc_attr($default) . '" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '" type="checkbox" ' . checked($new_value, 'yes', false) . '/>';
                                            echo esc_html($label);
                                            echo '<span class="description customize-control-description">' . esc_html($description) . '</span>';
                                            echo '</label>';
                                            break;
                                        case 'colorpicker':
                                            echo '<input data-default="' . esc_attr($default) . '" class="appzend-color-picker" data-alpha="true" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                            break;
                                        case 'selector':
                                            $options = $field['options'];
                                            echo '<div class="selector-labels">';
                                            foreach ($options as $option => $val) {
                                                $class = ( $new_value == $option ) ? 'selector-selected' : '';
                                                echo '<label class="' . $class . '" data-val="' . esc_attr($option) . '">';
                                                echo '<img src="' . esc_url($val) . '"/>';
                                                echo '</label>';
                                            }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;
                                        case 'radio':
                                            $options = $field['options'];
                                            echo '<div class="radio-labels">';
                                            foreach ($options as $option => $val) {
                                                echo '<label>';
                                                echo '<input value="' . esc_attr($option) . '" type="radio" ' . checked($new_value, $option, false) . '/>';
                                                echo esc_html($val);
                                                echo '</label>';
                                            }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;
                                        case 'switch':
                                            $switch = $field['switch'];
                                            $switch_class = ($new_value == 'on') ? 'switch-on' : '';
                                            echo '<div class="onoffswitch ' . esc_attr($switch_class) . '">';
                                            echo '<div class="onoffswitch-inner">';
                                            echo '<div class="onoffswitch-active">';
                                            echo '<div class="onoffswitch-switch">' . esc_html($switch["on"]) . '</div>';
                                            echo '</div>';
                                            echo '<div class="onoffswitch-inactive">';
                                            echo '<div class="onoffswitch-switch">' . esc_html($switch["off"]) . '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;
                                        case 'range':
                                            $options = $field['options'];
                                            $new_value = $new_value ? $new_value : $options['val'];
                                            echo '<div class="appzend-range-slider" >';
                                            echo '<div class="range-input" data-defaultvalue="' . esc_attr($options['val']) . '" data-value="' . esc_attr($new_value) . '" data-min="' . esc_attr($options['min']) . '" data-max="' . esc_attr($options['max']) . '" data-step="' . esc_attr($options['step']) . '"></div>';
                                            echo '<input  class="range-input-selector" type="text" disabled="disabled" value="' . esc_attr($new_value) . '"  data-name="' . esc_attr($key) . '"/>';
                                            echo '<span class="unit">' . esc_html($options['unit']) . '</span>';
                                            echo '</div>';
                                            break;
                                        case 'icon':
                                            echo '<div class="appzend-customizer-icon-box">';
                                            echo '<div class="appzend-selected-icon">';
                                            echo '<i class="' . esc_attr($new_value) . '"></i>';
                                            echo '<span><i class="dashicons dashicons-arrow-down-alt2"></i></span>';
                                            echo '</div>';
                                            echo '<div class="appzend-icon-box">';
                                            echo '<div class="appzend-icon-search">';
                                            echo '<select>';
                                            if (apply_filters('appzend_show_ico_font', false)) {
                                                echo '<option value="icofont-list">' . esc_html__('Ico Font', 'appzend') . '</option>';
                                            }
                                            if (apply_filters('appzend_show_font_awesome', true)) {
                                                echo '<option value="fontawesome-list">' . esc_html__('Font Awesome', 'appzend') . '</option>';
                                            }
                                            if (apply_filters('appzend_show_essential_icon', false)) {
                                                echo '<option value="essential-icon-list">' . esc_html__('Essential Icon', 'appzend') . '</option>';
                                            }
                                            if (apply_filters('appzend_show_material_icon', false)) {
                                                echo '<option value="material-icon-list">' . esc_html__('Material Icon', 'appzend') . '</option>';
                                            }
                                            echo '</select>';
                                            echo '<input type="text" class="appzend-icon-search-input" placeholder="' . esc_html__('Type to filter', 'appzend') . '" />';
                                            echo '</div>';
                                            
                                            if (apply_filters('appzend_show_font_awesome', true)) {
                                                echo '<ul class="appzend-icon-list fontawesome-list active cl-clearfix">';
                                                $appzend_font_awesome_icon_array = appzend_awesome_icon_array();
                                                foreach ($appzend_font_awesome_icon_array as $appzend_font_awesome_icon) {
                                                    $icon_class = $new_value == $appzend_font_awesome_icon ? 'icon-active' : '';
                                                    echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($appzend_font_awesome_icon) . '"></i></li>';
                                                }
                                                echo '</ul>';
                                            }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            echo '</div>';
                                            break;
                                        case 'multicategory':
                                            $new_value_array = !is_array($new_value) ? explode(',', $new_value) : $new_value;
                                            echo '<ul class="appzend-multi-category-list">';
                                            echo '<li><label><input type="checkbox" value="-1" ' . checked('-1', $new_value, false) . '/>' . esc_html__('Latest Posts', 'appzend') . '</label></li>';
                                            foreach ($this->cats as $cat) {
                                                $checked = in_array($cat->term_id, $new_value_array) ? 'checked="checked"' : '';
                                                echo '<li>';
                                                echo '<label>';
                                                echo '<input type="checkbox" value="' . esc_attr($cat->term_id) . '" ' . $checked . '/>';
                                                echo esc_html($cat->name);
                                                echo '</label>';
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr(implode(',', $new_value_array)) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;
                                        default:
                                            break;
                                    }
                                    ?>
                                </div>
                            <?php }
                            ?>
                            <div class="cl-clearfix appzend-repeater-footer">
                                <div class="alignright">
                                    <a class="appzend-repeater-field-remove" href="#remove"><?php esc_html_e('Delete', 'appzend') ?></a> |
                                    <a class="appzend-repeater-field-close" href="#close"><?php esc_html_e('Close', 'appzend') ?></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            }
        }
    }
    //end repeater control
endif;
if( !function_exists('appzend_sanitize_repeater')){
    /**
     * Repeat Fields Sanitization
    */
    function appzend_sanitize_repeater($input) {
        $input_decoded = json_decode($input, true);
        if (!empty($input_decoded)) {
            foreach ($input_decoded as $boxes => $box) {
                foreach ($box as $key => $value) {
                    $input_decoded[$boxes][$key] = wp_kses_post($value);
                }
            }
            return json_encode($input_decoded);
        }
        //return $input;
    }
}