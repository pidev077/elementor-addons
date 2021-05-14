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

define('ELEMENT_ADDON_VER', '1.2.1' );
define('ELEMENT_ADDON_PATH', plugin_dir_path( __FILE__ ) );
define('ELEMENT_ADDON_TEMPLATE', ELEMENT_ADDON_PATH.'templates/' );

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
				'order' => "DESC",
				'pagination' => '',
				'showcontent' => '',
				'sortby'	=> '',
				'types'	=> '',
				'topics' => '',
				'cats_faq' => '',
				'ex_cats_faq' => '',
				'template' => ''
	  ), $atts, 'ica_content_filter' );

		// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
		wp_localize_script( 'elementor-addons-content-filter', 'ajaxObject',
            array( 'ajaxUrl' => admin_url( 'admin-ajax.php' ) ) );
	  ob_start();
		include(ELEMENT_ADDON_TEMPLATE.'content-filter/form-search.php');
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
		$paged = $_POST['paged'];
		$pagination = $_POST['pagination'];
		$orderby = $_POST['orderby'];
		$order = $_POST['order'];
		$option = $_POST['option'];
		$post_type = $_POST['post_type'];
		$template  = $_POST['template'];
		$sortby		 = $_POST['sortby'];
		$cats_faq  = $_POST['cats_faq'];
		$ex_cats_faq  = $_POST['ex_cats_faq'];

		$args = array(
			'post_type' => $post_type,
			'post_status' => 'publish',
			'posts_per_page' => $_POST['numberposts'],
			'orderby' 	 => $orderby,
			'order' 		 => $order,
			'paged' 		 => $paged,
			 's' =>        $key,
		);

		if(trim($key) != '' && $post_type == 'resources'){
			$args['meta_query'][] = array(
					'key' => 'content_file',
					'value' =>	$key,
					'compare' => 'LIKE'
			);
		}

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

		if(!empty($cats_faq)){
			$args['tax_query'][] = array(
					'taxonomy' => 'cat-faq',
					'field'    => 'slug',
					'terms'    => explode(',',$cats_faq)
			);
		}

		if(!empty($ex_cats_faq)){
			$args['tax_query'][] = array(
					'taxonomy' => 'cat-faq',
					'field'    => 'slug',
					'operator' => 'NOT IN',
					'terms'    => explode(',',$ex_cats_faq)
			);
		}

		// The Query
		ob_start();

		add_filter( 'posts_where', array($this, 'ica_title_filter' ) , 10, 2 );
		$the_query = new WP_Query($args);
		$_GLOBAL['wp_query'] = $the_query;

		remove_filter( 'posts_where', array($this, 'ica_title_filter' ) , 10, 2 );
		$totalpost = (($_POST['numberposts']*($paged-1)) + $the_query->post_count);

		//Top content filter
		if($paged < 2){
			if(!empty($filters)){
				foreach ($filters as $key => $filter) {
					if($filter['name'] == 'ins-type'){
						?>
						<div class="filter-selected">
								<label for="">Selected filters by “Type”</label>
								<div class="list-selected">
									<?php foreach ($filter['value'] as $key => $val) {
										$text = ucwords(str_replace('-',' ',$val));
										?><span class="item-filter"><?php echo $text; ?> <i class="fa fa-times" data-filter="<?php echo $val;?>"></i></span><?php
									} ?>
								</div>
						</div>
						<?php
						break;
					}

				}
			}
			if($sortby):
				?>
				<div class="sort-by-content">
					<div class="info-numberposts">Showing <span class="totalpost"><?php echo $totalpost ?></span> of <?php echo $the_query->found_posts; ?> results</div>
					<div class="btn-sortby <?php echo ($option == 'sortby') ? '__is-actived' : ''; ?>">
						<span>Sort by <i class="fa fa-angle-down" aria-hidden="true"></i></span>
						<div class="content-sortby" style="display:<?php echo ($option == 'sortby') ? 'block' : 'none'; ?>">
								<div class="item-sortby <?php echo $orderby == 'post_date' ? '__is-actived' : ''; ?>" data-order="<?php echo $orderby == 'post_date' ? $order : 'desc'; ?>" data-orderby="post_date">
									Date <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
								</div>
								<div class="item-sortby <?php echo $orderby == 'title' ? '__is-actived' : ''; ?>" data-order="<?php echo $orderby == 'title' ? $order : 'desc'; ?>" data-orderby="title">
									A-Z <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
								</div>
						</div>
					</div>
				</div>
				<?php
			endif;
		}

		// The Loop
		if ( $the_query->have_posts() ) {
				$countpost = $the_query->found_posts;
				$item = 0;
				if($paged < 2){ ?> <div class="list-grids template-<?php echo $post_type.($template ? '-'.$template:''); ?>"> <?php }
					while ( $the_query->have_posts() ) {
							$the_query->the_post();
							include(ELEMENT_ADDON_TEMPLATE.'content-filter/item-'.$post_type.($template ? '-'.$template:'').'.php');
					}
				if($paged < 2){ ?></div> <?php }
		} else {
			$countpost = 0;
			?> <div class="not-found">
				<i class="fa fa-frown-o" aria-hidden="true"></i>
				<div><?php echo __("Not found result!"); ?></div>
			</div> <?php
		}

		if($pagination && $the_query->max_num_pages > $paged && $paged < 2){
			?><div class="content-filter-pagination"><button type="button" name="button-showmore">Show more</button></div><?php
		}

		//Top content filter
		if($paged < 2){
			if(!empty($filters)){
				foreach ($filters as $key => $filter) {
					if($filter['name'] == 'ins-topic'){
						?>
						<div class="filter-selected">
								<label for="">Selected filters by “Topic”</label>
								<div class="list-selected">
									<?php foreach ($filter['value'] as $key => $val) {
										$text = ucwords(str_replace('-',' ',$val));
										?><span class="item-filter"><?php echo $text; ?> <i class="fa fa-times" data-filter="<?php echo $val;  ?>"></i></span><?php
									} ?>
								</div>
						</div>
						<?php
						break;
					}

				}
			}
		}

		//check pagination
		if($_GLOBAL['wp_query']->max_num_pages == $paged){
			$result['pagination'] = false;
		}else{
			$result['pagination'] = true;
		}

		$result['html'] = ob_get_clean();

		$result['countpost'] = $countpost;
		$result['totalpost'] = $totalpost;
		$result['global'] = $cats_faq;

		wp_send_json($result);
	}

	public function ica_title_filter( $where, &$wp_query ){
	    global $wpdb;
			if ( $search_date = $wp_query->get( 'search_date' ) ) {
				  $date = explode(',',$search_date);
					if($date[0] && !$date[1])
							$where .= " AND post_date >= '".$date[0]."-01-01'";
					if(!$date[0] && $date[1])
 						  $where .= " AND post_date <= '".$date[1]."-12-31'";
					if($date[0] && $date[1])
							$where .= " AND post_date >= '".$date[0]."-01-01'  AND post_date <= '".$date[1]."-12-31'";
	    }

		if ( $meta_query = $wp_query->get( 'meta_query' ) ) {

			// $where = preg_replace(
			// "/\)\)\)\s*AND \(\s*\(\s*".$wpdb->postmeta.".meta_key/",
			// "))) OR (( ".$wpdb->postmeta.".meta_key",
			// $where
			// );
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
