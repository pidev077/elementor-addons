<?php
namespace ElementorAddons;

use ElementorAddons\PageSettings\Page_Settings;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}


	/**
	 * widget_styles
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function widget_styles() {
		wp_register_style( 'elementor-addons', plugins_url( '/assets/css/frontend.css', __FILE__ ) , array() ,ELEMENT_ADDON_VER );
		wp_register_style( 'elementor-addons-custom-frontend', plugins_url( '/assets/css/custom-frontend.css', __FILE__ ) , array() , ELEMENT_ADDON_VER);
		wp_register_style( 'elementor-addons-content-filter', plugins_url( '/assets/widgets/content-filter.css', __FILE__ ) , array() , ELEMENT_ADDON_VER );
	}


	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'elementor-addons', plugins_url( '/assets/js/frontend.js', __FILE__ ), [ 'jquery' ], ELEMENT_ADDON_VER, true );
		wp_register_script( 'elementor-addons-content-filter', plugins_url( '/assets/js/content-filter.js', __FILE__ ), [ 'jquery' ], ELEMENT_ADDON_VER, true );
		wp_register_script( 'elementor-addons-custom-frontend', plugins_url( '/assets/js/custom-frontend.js', __FILE__ ), [ 'jquery' ], ELEMENT_ADDON_VER, true );
		wp_register_script( 'elementor-addons-bloodhound', plugins_url( '/assets/js/typeahead/typeahead.bundle.min.js', __FILE__ ), [ 'jquery' ], ELEMENT_ADDON_VER, true );
		wp_register_script( 'elementor-addons-masonry', plugins_url( '/assets/js/masonry.pkgd.min.js', __FILE__ ), [ 'jquery' ], ELEMENT_ADDON_VER, true );
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'elementor-addons-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}
	function void_grid_post_type(){
		$args= array(
				'public'	=> 'true',
				'_builtin'	=> false
			);
		$post_types = get_post_types( $args, 'names', 'and' );
		$post_types = array( 'post'	=> 'post' ) + $post_types;
		return $post_types;
	}
	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'elementor-addons-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/be-counter.php' );
		require_once( __DIR__ . '/widgets/be-post.php' );
		require_once( __DIR__ . '/widgets/subhead-bodycopy.php' );
		require_once( __DIR__ . '/widgets/heading-media-bodycopy.php' );
		require_once( __DIR__ . '/widgets/sidebar.php' );
		require_once( __DIR__ . '/widgets/useful-links-info.php' );
		require_once( __DIR__ . '/widgets/accordion-navigation-tabs.php' );
		require_once( __DIR__ . '/widgets/content-filter.php' );
		require_once( __DIR__ . '/widgets/secondary-ctas.php' );
		require_once( __DIR__ . '/widgets/alert-banner.php' );
		require_once( __DIR__ . '/widgets/alert-banner.php' );
		require_once( __DIR__ . '/widgets/resources.php' );
		require_once( __DIR__ . '/widgets/repeater-resources.php' );
		require_once( __DIR__ . '/widgets/card-lrg.php' );
		require_once( __DIR__ . '/widgets/be-promo.php' );
		require_once( __DIR__ . '/widgets/be-latest-resources.php' );
		require_once( __DIR__ . '/widgets/be-popular-results.php' );
		require_once( __DIR__ . '/widgets/be-top-faq.php' );
		require_once( __DIR__ . '/widgets/be-card-carousel.php' );
		// M.8.3 Card lrg (landing page)
	}

	/**
 * Register Category
 *
 * Register new Elementor category.
 *
 * @since 1.0.0
 * @access public
 */
public function add_category( $elements_manager ) {
	$elements_manager->add_category(
		'bearsthemes-addons',
		[
			'title' => esc_html__( 'Bearsthemes Addons', 'bearsthemes-addons' )
		]
	);
}


	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Be_Counter() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Be_Posts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Subhead_Bodycopy() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Heading_Media_BodyCopy() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Sidebar() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Useful_Links_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Content_Filter() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Accordion_Navigation_Tabs() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Secondary_CTAs() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Alert_Banner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Resources_Widgets() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Card_Lrg() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Be_Promo() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Be_Latest_Resources() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Be_Popular_Results() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Be_Top_Faq() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Be_Card_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Repeater_resources_widget());

	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget styles
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );

		// Register category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Plugin::instance();
