<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
class AppZend_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ), 10 );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'appzend_pro_enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {
		
		// Load custom sections.
		require_once get_theme_file_path('inc/custom-controller/customizer-pro/section-pro.php');

		// Register custom section types.
		$manager->register_section_type( 'AppZend_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new AppZend_Customize_Section_Pro(
				$manager,
				'appzend-info',
				array(
					'title'    => '',
					'pro_text' => esc_html__( 'Upgrade To Pro','appzend' ),
					'pro_url'  => 'https://www.templatemonster.com/authors/sparklewpthemes/',
					'priority'  => -11,
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function appzend_pro_enqueue_control_scripts() {
		wp_enqueue_script( 'appzend-pro-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/custom-controller/customizer-pro/customize-controls.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'appzned-pro-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/custom-controller/customizer-pro/customize-controls.css' );
	}
}
if(class_exists('WP_Customize_Section')){
	// Doing this customizer thang!
	AppZend_Customize::get_instance();
}