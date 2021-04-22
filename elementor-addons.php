<?php
/**
 * Plugin Name: Elementor Addons
 * Description: Elementor addons plugin.
 * Plugin URI:  https://elementor.com/
 * Version:     1.2.1
 * Author:      Bearsthemes
 * Author URI:  https://elementor.com/
 * Text Domain: elementor-addons
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Elementor Hello World Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class Elementor_Addons {

	/**
	 * Plugin Version
	 *
	 * @since 1.2.1
	 * @var string The plugin version.
	 */
	const VERSION = '1.2.1';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );

		//Content Filter
		add_shortcode( 'ica_content_filter', array( $this, 'ica_content_filter_render' ) );
		add_action( 'wp_ajax_load_filter_data', array( $this, 'load_filter_data_ajax' )  );
		add_action( 'wp_ajax_nopriv_load_filter_data', array( $this, 'load_filter_data_ajax' ) );
	}

	//Search Content Filter
	public function ica_content_filter_render( $atts ) {
	  $atts = shortcode_atts( array(
	      'placeholder' => 'Search...',
				'suggestions' => '',
				'filters' => array(),
				'ajax'	=> true,
				'default_filter' => true,
				'action' => '',
				'post_type' => '',
				'numberposts' => 6,
				'orderby'	=> 'post_date',
				'order' => "DESC"
	  ), $atts, 'ica_content_filter' );

		// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
		wp_localize_script( 'elementor-addons-content-filter', 'ajaxObject',
            array( 'ajaxUrl' => admin_url( 'admin-ajax.php' ) ) );
	  ob_start();
		$TEMPLATEPATH =  dirname(__FILE__);
		include($TEMPLATEPATH.'/templates/content-filter/form-search.php');
	  return ob_get_clean();
	}

	/**
	* Ajax Content Filter
	* @access private
	*/

	public function load_filter_data_ajax(){
		$result = array();

		$key = $_POST['key'];
		$filters = $_POST['filters'];

		$args = array(
			'post_type' => $_POST['post_type'],
			'post_status' => 'public',
			'posts_per_page' => $_POST['numberposts'],
			'search_key' => $key,
			'orderby' => $_POST['orderby'],
			'order' => $_POST['order']
		);

		if(!empty($filters)){
			$args['tax_query']['relation'] = 'AND';

			foreach ($filters as $key => $filter) {
				if($filter['name'] !== 'post_date'){
					$args['tax_query'][] = array(
							'taxonomy' => $filter['name'],
							'field'    => 'slug',
							'terms'    => $filter['value']
					);
				}
				if($filter['name'] == 'post_date' && $filter['value'] !== ','){
					$args['search_date'] = $filter['value'];
				}
			}
		}

		$result['html'] = $this->get_data_filters($args);

		wp_send_json($result);
	}

	public function get_data_filters($args){
			// The Query
			ob_start();
			$TEMPLATEPATH =  dirname(__FILE__);
			add_filter( 'posts_where', array($this, 'ica_title_filter' ) , 10, 2 );
			$the_query = new WP_Query($args);
			remove_filter( 'posts_where', array($this, 'ica_title_filter' ) , 10, 2 );
			// The Loop
			if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
							$the_query->the_post();
							include($TEMPLATEPATH.'/templates/content-filter/item-resoures.php');
					}
			} else {
				?> <div class="not-found">
					<i class="fa fa-frown-o" aria-hidden="true"></i>
					<div><?php echo __("Not found result!"); ?></div>
				</div> <?php
			}
			return ob_get_clean();
	}

	function ica_title_filter( $where, &$wp_query ){
	    global $wpdb;
	    if ( $search_term = $wp_query->get( 'search_key' ) ) {
					$where .= ' AND (' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
	        $where .= ' OR ' . $wpdb->posts . '.post_content LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\')';
	    }
			if ( $search_date = $wp_query->get( 'search_date' ) ) {
				  $date = explode(',',$search_date);
					if($date[0] && !$date[1])
							$where .= " AND post_date >= '".$date[0]."-01-01'";
					if(!$date[0] && $date[1])
 						  $where .= " AND post_date <= '".$date[1]."-12-31'";
					if($date[0] && $date[1])
							$where .= " AND post_date >= '".$date[0]."-01-01'  AND post_date <= '".$date[1]."-12-31'";
	    }
	    return $where;
	}


	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'elementor-addons' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-addons' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'elementor-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-addons' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-addons' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'elementor-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-addons' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-addons' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'elementor-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-addons' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate Elementor_Addons.
new Elementor_Addons();
