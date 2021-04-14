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
	}

	//Search Content Filter
	function ica_content_filter_render( $atts ) {
	  $atts = shortcode_atts( array(
	      'placeholder' => 'Search...',
				'suggestions' => '',
				'filters' => ''
	  ), $atts, 'ica_content_filter' );
	  ob_start();
		$suggestions = explode(',',$atts['suggestions']);
		$filters = explode(',',$atts['filters']);
		$is_date_filter = false;
	  ?>
	  <div class="ica-content-filter">
	      <form class="form-content-filter" action="/" method="post">
	         <input type="text" name="key-search" value="" placeholder="<?php echo $atts['placeholder']; ?>">
	         <button type="submit" name="button"><i class="fa fa-search" aria-hidden="true"></i></button>
	      </form>
				<div class="template-filter-form">
			      <div class="__filter-suggestion">
							<?php if(!empty($suggestions)): ?>
				        <div class="load-suggestion">
				          <?php echo __('Suggestions:','bearsthemes-addons') ?>
				          <div class="list-suggestions">
				            <?php foreach ($suggestions as $key => $suggestion): ?>
				            	<span><?php echo $suggestion; ?></span><?php echo (($key+1) < count($suggestions)) ? ',' : ''; ?>
				            <?php endforeach; ?>
				          </div>
				        </div>
							<?php endif; ?>
							<?php if(!empty($filters)): ?>
				        <div class="btn-filter">
				          <i class="fa fa-caret-right" aria-hidden="true"></i>
				          <?php echo __('Filters','bearsthemes-addons') ?>
				        </div>
							<?php endif; ?>
			      </div>
						<?php if(!empty($filters)): ?>
				      <div class="__filter-options">
									<?php foreach ($filters as $key => $filter): ?>
													<?php if($filter != 'date'){
																		$taxonomy = get_taxonomy($filter);
																		$terms = get_terms( array(
																			'taxonomy' => $filter,
																			'hide_empty' => false,
																		) );
														if(!empty($terms)):
															?>
															<div class="ica-item-filter">
																	<div class="name-filter">
																		<?php echo __('Filter by','bearsthemes-addons') ?> <?php echo $taxonomy->label; ?>
																		<i class="fa fa-angle-down" aria-hidden="true"></i>
																	</div>
																	<div class="select-filter">
																			<span class="btn-select-all"><?php echo __('Select all','bearsthemes-addons') ?></span>
																			<?php foreach ($terms as $key => $term) {
																					?>
																					<label class="checkbox-container"><?php echo $term->name ?>
																					  <input type="checkbox">
																					  <span class="checkmark"></span>
																					</label>
																					<?php
																			} ?>
																			<span class="btn-deselect-all"><?php echo __('Deselect all','bearsthemes-addons') ?></span>
																	</div>
															</div>
															<?php
														endif;
													} ?>
													<?php $is_date_filter = ($filter == 'date') ? true : false; ?>
									<?php endforeach; ?>
									<?php if($is_date_filter){
										$breakYears = 20;
										$years = date('Y',current_time( 'timestamp', 1 ));
										?>
										<div class="ica-item-filter select-date-range">
											<?php echo __('Select date range','bearsthemes-addons') ?>
											<div class="select-date-start">
												<select name="date-range-start">
													<option value="">Select start year</option>
													<?php for ($i=0; $i < $breakYears; $i++) {
														?><option value="<?php echo $years - $i ?>"><?php echo $years - $i ?></option><?php
													} ?>
												</select>
											</div>
											<div class="select-date-end">
												<select name="name="date-range-start"">
													<option value="">Select end year</option>
													<?php for ($i=0; $i < $breakYears; $i++) {
														?><option value="<?php echo $years - $i ?>"><?php echo $years - $i ?></option><?php
													} ?>
												</select>
											</div>
										</div>
									<?php } ?>
							</div>
						<?php endif; ?>
			  </div>
	  </div>
	  <?php
	  return ob_get_clean();
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
