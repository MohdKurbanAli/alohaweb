<?php
namespace Zemez_Dashboard;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Main file
 */
class Plugin {

	/**
	 * Instance.
	 *
	 * Holds the plugin instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Plugin
	 */
	public static $instance = null;

	/**
	 * @var null
	 */
	public $module_loader = null;

	/**
	 * @var
	 */
	public $config;
	public $settings;
	public $assets;
	public $api;
	public $dashboard_manager;

	/**
	 * Instance.
	 *
	 * Ensures only one instance of the plugin class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Load files
	 */
	private function load_files() {
		require ZEMEZ_DASHBOARD_PATH . 'includes/config.php';
		require ZEMEZ_DASHBOARD_PATH . 'includes/utils.php';
		require ZEMEZ_DASHBOARD_PATH . 'includes/settings.php';
		require ZEMEZ_DASHBOARD_PATH . 'includes/api.php';
		require ZEMEZ_DASHBOARD_PATH . 'includes/dashboard/manager.php';
	}

	/**
	 * Load framework modules
	 *
	 * @return [type] [description]
	 */
	public function module_loader() {

		require $this->plugin_path( 'includes/modules/loader.php' );

		$this->module_loader = new \Zemez_Dashboard_CX_Loader(
			array(
				$this->plugin_path( 'includes/modules/interface-builder/cherry-x-interface-builder.php' ),
			)
		);

	}

	/**
	 * Initialize plugin parts
	 *
	 * @return void
	 */
	public function init_components() {

		$this->load_files();

		$this->config = new Config();
		//$this->assets = new Assets();
		$this->api = new API();
		//$this->settings = new Settings();

		if ( is_admin() ) {
			$this->settings = new Settings();
			$this->dashboard_manager = new Page_Manager();
		}
	}

	/**
	 * Returns plugin version
	 *
	 * @return string
	 */
	public function get_version() {
		return ZEMEZ_DASHBOARD_VERSION;
	}

	/**
	 * Returns path to file or dir inside plugin folder
	 *
	 * @param  string $path Path inside plugin dir.
	 * @return string
	 */
	public function plugin_path( $path = null ) {
		return ZEMEZ_DASHBOARD_PATH . $path;
	}
	/**
	 * Returns url to file or dir inside plugin folder
	 *
	 * @param  string $path Path inside plugin dir.
	 * @return string
	 */
	public function plugin_url( $path = null ) {
		return ZEMEZ_DASHBOARD_URL . $path;
	}

	/**
	 * Get the template path.
	 *
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'zemez-dashboard/template-path', 'jet-theme-core/' );
	}

	/**
	 * Returns path to template file.
	 *
	 * @return string|bool
	 */
	public function get_template( $name = null ) {

		$template = locate_template( $this->template_path() . $name );

		if ( ! $template ) {
			$template = $this->plugin_path( 'templates/' . $name );
		}

		if ( file_exists( $template ) ) {
			return $template;
		} else {
			return false;
		}
	}

	/**
	 * Loads the translation files.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function lang() {
		load_plugin_textdomain( 'zemez-dashboard', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Plugin constructor.
	 */
	private function __construct() {
		add_action( 'after_setup_theme', array( $this, 'module_loader' ), -20 );
		add_action( 'after_setup_theme', array( $this, 'init_components' ) );
	}

}

Plugin::instance();
