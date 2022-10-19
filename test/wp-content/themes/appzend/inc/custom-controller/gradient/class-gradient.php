<?php
/**
 * Customizer Control: appzend-gradient
 *
 * @subpackage  Controls
 * @since       1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'AppZend_Gradient_Control' ) ) :
    /**
     * Gradient Control
     */
    class AppZend_Gradient_Control extends WP_Customize_Control {
        public $type = 'gradient';
        public $params = array();
        public function __construct($manager, $id, $args = array()) {
            if (isset($args['params'])) {
                $this->params = $args['params'];
            }
            parent::__construct($manager, $id, $args);
        }
        public function enqueue() {
            wp_enqueue_script('color-picker', get_template_directory_uri() . '/inc/custom-controller/gradient/js/colorpicker.js', array('jquery'), '1.0', true);
            wp_enqueue_script('jquery-classygradient', get_template_directory_uri() . '/inc/custom-controller/gradient/js/jquery.classygradient.js', array('jquery'), '1.0', true);
            wp_enqueue_script('custom-gradient', get_template_directory_uri() . '/inc/custom-controller/gradient/js/gradient.js', array('jquery', 'jquery-ui-slider'), '1.0', true);
            wp_enqueue_style('color-picker', get_template_directory_uri() . '/inc/custom-controller/gradient/css/colorpicker.css');
            wp_enqueue_style('jquery-classygradient', get_template_directory_uri() . '/inc/custom-controller/gradient/css/jquery.classygradient.css');
            wp_enqueue_style('gradient-controller', get_template_directory_uri() . '/inc/custom-controller/gradient/css/gradient.css');
        }
        public function render_content() {
            if (!empty($this->label)) :
                ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php
            endif;
            if (!empty($this->description)) :
                ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php
            endif;
            $type = $this->type;
            $params = $this->params;
            $class = isset($params['class']) ? $params['class'] : '';
            $default_color = isset($params['default_color']) ? $params['default_color'] : '0% #0051FF, 100% #00C5FF';
            $picker_label = isset($params['picker_label']) ? $params['picker_label'] : esc_html__("Define Gradient Colors", "appzend");
            $picker_description = isset($params['picker_description']) ? $params['picker_description'] : esc_html__("For a gradient, at least one starting and one end color should be defined.", "appzend");
            $angle_label = isset($params['angle_label']) ? $params['angle_label'] : esc_html__("Define Gradient Direction", "appzend");
            $preview_label = isset($params['preview_label']) ? $params['preview_label'] : esc_html__("Gradient Preview", "appzend");
            $html = '<div class="gradient-box" data-default-color="' . esc_attr($default_color) . '">';
            // Classy Gradient Picker
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-label">' . esc_html($picker_label) . '</div>';
            $html .= '<div class="gradient-picker"></div>';
            $html .= '<div class="gradient-description">' . esc_html($picker_description) . '</div>';
            $html .= '</div>';
            // Gradient Linear Direction Selector
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-label">' . esc_html($angle_label) . '</div>';
            $html .= '<select class="gradient-direction">
        <option value="vertical">' . esc_html__('Vertical Spread (Top to Bottom)', 'appzend') . '</option>
        <option value="horizontal">' . esc_html__('Horizontal Spread (Left To Right)', 'appzend') . '</option>
        <option value="custom">' . esc_html__('Custom Angle Spread', 'appzend') . '</option>
      </select>';
            $html .= '</div>';
            // Gradient Custom Angle Input
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-custom" style="display: none;">';
            $html .= '<div class="gradient-label">' . esc_html__('Define Custom Angle', 'appzend') . '</div>';
            $html .= '<div class="gradient-angle-slider">';
            $html .= '<div class="gradient-range"></div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            // Gradient Preview Panel
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-label">' . esc_html($preview_label) . '</div>';
            $html .= '<div class="gradient-preview"></div>';
            $html .= '</div>';
            echo $html;
            ?>
            <input type="hidden" class="<?php echo esc_attr($type) . ' ' . esc_attr($class) ?> gradient-val"  value="<?php echo esc_attr($this->value()) ?>" <?php $this->link(); ?> />
            </div>
            <?php
        }
    }
    // $wp_customize->register_control_type('AppZend_Gradient_Control');
endif;