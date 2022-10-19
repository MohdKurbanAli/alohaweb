<?php
namespace Zemez_Dashboard;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Config {

	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;

	/**
	 * Config holder
	 *
	 * @var array
	 */
	private $config = array();

	/**
	 * Constructor for the class
	 */
	public function __construct() {

		// register default config
		$this->config = array(
			'dashboard_page_name' => esc_html__( 'Zemez', 'zemez-dashboard' ),
			'documentation' => 'https://crocoblock.com/knowledge-base/article-category/site-builder-functionality',
			'editor' => array(
				'template_before' => '',
				'template_after'  => '',
			),
			'library_button' => '',
			'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9 17.5C13.6944 17.5 17.5 13.6944 17.5 9C17.5 4.30558 13.6944 0.5 9 0.5C4.30558 0.5 0.5 4.30558 0.5 9C0.5 13.6944 4.30558 17.5 9 17.5ZM9 18C13.9706 18 18 13.9706 18 9C18 4.02944 13.9706 0 9 0C4.02944 0 0 4.02944 0 9C0 13.9706 4.02944 18 9 18Z" fill="white"/><path d="M5.76731 8.09292L3.23999 12.1852V12.7465H7.71497V11.5071H5.04853L7.55267 7.41476V6.85353H3.42548V8.09292H5.76731Z" fill="white"/><path d="M13.6052 9.67138C13.6052 9.00492 13.3966 8.31507 12.9792 7.74215C12.5618 7.14584 11.8083 6.75999 10.8808 6.75999C8.8752 6.75999 8.07527 8.39692 8.07527 9.79999C8.07527 11.2031 8.8752 12.84 10.8808 12.84C12.1561 12.84 13.0372 12.2671 13.5357 11.1212L12.3764 10.6886C12.0286 11.2966 11.5532 11.6006 10.962 11.6006C10.1273 11.6006 9.61717 10.9809 9.58239 10.2677H13.6052V9.67138ZM10.8808 7.99938C11.5532 7.99938 11.9706 8.37353 12.1329 9.12184H9.61717C9.72151 8.50215 10.1968 7.99938 10.8808 7.99938Z" fill="white"/><path d="M7.72 3.88L8.90706 5.80001H9.64L9.01859 3.88H7.72Z" fill="white"/><path d="M14.12 3.88L12.9329 5.80001H12.2L12.8214 3.88H14.12Z" fill="white"/><path d="M11.56 3.88L11.24 5.80001H10.6L10.28 3.88H11.56Z" fill="white"/></svg>'),

			'library' => array(
				'version' => '1.0.0',
				'tabs'    => array(
					'jet_header'  => '',
					'jet_footer'  => '',
					'jet_section' => '',
					'jet_page'    => '',
				),
				'keywords' => array(),
			),
			'guide' => array(
				'enabled' => true,
				'title'   => __( 'Learn More About Crocoblock', 'zemez-dashboard' ),
				'content' => __( 'Here you can get all the necessary information, detailed instructions and latest news.', 'zemez-dashboard' ),
				'links'   => array(
					'documentation' => array(
						'label'  => __( 'Check documentation', 'zemez-dashboard' ),
						'type'   => 'primary',
						'target' => '_blank',
						'icon'   => 'dashicons-welcome-learn-more',
						'desc'   => __( 'Get more info from documentation', 'zemez-dashboard' ),
						'url'    => 'https://crocoblock.com/knowledge-base/article-category/crocoblock-overview/',
					),
					'knowledge-base' => array(
						'label'  => __( 'Knowledge Base', 'zemez-dashboard' ),
						'type'   => 'primary',
						'target' => '_blank',
						'icon'   => 'dashicons-sos',
						'desc'   => __( 'Access the vast knowledge base', 'zemez-dashboard' ),
						'url'    => 'https://crocoblock.com/knowledge-base/',
					),
					'community' => array(
						'label'  => __( 'Community', 'zemez-dashboard' ),
						'type'   => 'primary',
						'target' => '_blank',
						'icon'   => 'dashicons-facebook',
						'desc'   => __( 'Join community to stay tuned to the latest news', 'zemez-dashboard' ),
						'url'    => 'https://www.facebook.com/groups/CrocoblockCommunity/',
					),
					'video-tutorials' => array(
						'label' => __( 'View Video', 'zemez-dashboard' ),
						'type'   => 'primary',
						'target' => '_blank',
						'icon'   => 'dashicons-format-video',
						'desc'   => __( 'View video tutorials', 'zemez-dashboard' ),
						'url'    => 'https://www.youtube.com/channel/UClbIlkP6078-DapTSPwYy7Q',
					),
				),
			),
			'api' => array(
				'enabled'   => true,
				'base'      => 'https://account.crocoblock.com/',
				'path'      => 'wp-json/croco/v1',
				'id'        => 9,
				'endpoints' => array(
					'templates'  => '/templates/',
					'keywords'   => '/keywords/',
					'categories' => '/categories/',
					'info'       => '/info/',
					'template'   => '/template/',
					'plugins'    => '/plugins/',
					'plugin'     => '/plugin/',
				),
			),
			'skins' => array(
				'enabeld' => true,
				'synch'   => true,
			),
		);

		/**
		 * Register custom config on this hook
		 */
		do_action( 'jet-theme-core/register-config', $this );
	}

	/**
	 * Register custom config from theme or plugin
	 *
	 * @param  array $config Config to register
	 * @return void
	 */
	public function register_config( $config ) {

		foreach ( $config as $key => $data ) {

			if ( ! empty( $this->config[ $key ] ) ) {
				if ( is_array( $this->config[ $key ] ) ) {
					$this->config[ $key ] = array_merge( $this->config[ $key ], $data );
				} else {
					$this->config[ $key ] = $data;
				}
			} else {
				$this->config[ $key ] = $data;
			}

		}

	}

	/**
	 * Returns config value by key
	 *
	 * @param  string $key Key to get.
	 * @return mixed
	 */
	public function get( $key = '' ) {
		return isset( $this->config[ $key ] ) ? $this->config[ $key ] : false;
	}

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
}