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
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'AppZend_Separator_Control' ) ) :
    /**
     * Separator Control
     */
    class AppZend_Separator_Control extends WP_Customize_Control {
        /**
         * Control type
         *
         * @var string
         */
        public $type = 'separator';
        /**
         * Control method
         *
         * @since 1.0.0
         */
        public function render_content() {
            ?>
            <p><span></span></p>
            <?php
        }
    }
endif;