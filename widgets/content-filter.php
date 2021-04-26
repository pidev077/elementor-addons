<?php
namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Content_Filter extends Widget_Base {

	public function get_name() {
		return 'ica-content-filter';
	}

	public function get_title() {
		return __( 'ICA Content Filter', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'fa fa-filter';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

  public function get_script_depends() {
		return [ 'elementor-addons-content-filter', 'elementor-addons-bloodhound' , 'elementor-addons-masonry' ];
	}

  public function get_style_depends() {
		return [ 'elementor-addons-content-filter' ];
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Settings', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label' => __( 'Placeholder', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Search....', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'ica_suggestions',
			[
				'label' => __( 'Suggestions', 'bearsthemes-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => 'lorem ipsum,dolor semet,sed it embaco',
			]
		);

		$this->add_control(
			'ajax_toggle',
			[
				'label' => __( 'Show results by ajax?', 'bearsthemes-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Yes', 'bearsthemes-addons' ),
				'label_on' => __( 'No', 'bearsthemes-addons' ),
				'return_value' => '1',
				'default' => '1',
			]
		);

		$this->add_control(
			'action_result',
			[
				'label' => __( 'Redirect to Page Result?', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( '', 'bearsthemes-addons' ),
				'placeholder' => home_url().'/advanced-search/',
				'condition' => [
					'ajax_toggle' => '',
				],
			]
		);

		$this->add_control(
			'content_toggle',
			[
				'label' => __( 'Default Content?', 'bearsthemes-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'OFF', 'bearsthemes-addons' ),
				'label_on' => __( 'ON', 'bearsthemes-addons' )
			]
		);

		$this->add_control(
			'filter_toggle',
			[
				'label' => __( 'Default Filter?', 'bearsthemes-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'OFF', 'bearsthemes-addons' ),
				'label_on' => __( 'ON', 'bearsthemes-addons' )
			]
		);

		$this->add_control(
			'pagination_toggle',
			[
				'label' => __( 'Pagination', 'bearsthemes-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'OFF', 'bearsthemes-addons' ),
				'label_on' => __( 'ON', 'bearsthemes-addons' )
			]
		);

		$this->end_controls_section();
	}

	protected function register_query_filter_section_controls() {
		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Query', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'ica_source',
			[
				'label' => __( 'Source', 'bearsthemes-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => true,
				'options' => [
					'resources'  => __( 'Resources', 'bearsthemes-addons' ),
					'ins-faqs' => __( 'FAQs', 'bearsthemes-addons' ),
					'post' => __( 'Post', 'bearsthemes-addons' ),
				],
				'label_block' => false,
				'default' => 'resources',
			]
		);

		$this->add_control(
			'ica_filters',
			[
				'label' => __( 'Filters by?', 'bearsthemes-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'ins-type'  => __( 'Types', 'bearsthemes-addons' ),
					'ins-topic' => __( 'Topic', 'bearsthemes-addons' ),
					'date' => __( 'Date', 'bearsthemes-addons' ),
				],
				'label_block' => true,
				'default' => [ 'ins-type', 'ins-topic', 'date' ]
			]
		);

		$this->add_control(
			'cat_type',
			[
				'label' => __( 'Types', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies('ins-type'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'ica_source' => 'resources',
				],
			]
		);

		$this->add_control(
			'cat_topic',
			[
				'label' => __( 'Topics', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies('ins-topic'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'ica_source' => 'resources',
				],
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date' => __( 'Date', 'bearsthemes-addons' ),
					'post_title' => __( 'Title', 'bearsthemes-addons' ),
					'rand' => __( 'Random', 'bearsthemes-addons' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'ASC', 'bearsthemes-addons' ),
					'desc' => __( 'DESC', 'bearsthemes-addons' ),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_form_section_controls(){
		$this->start_controls_section(
				'style_title_section',[
						'label' => __( 'Form', 'bearsthemes-addons' ),
						'tab' => Controls_Manager::TAB_STYLE,
				 ]
		);

		$this->add_control(
				'ica_form_bg',
				[
						'label' => __( 'Background Color', 'bearsthemes-addons' ),
						'type' => Controls_Manager::COLOR,
						'default' => 'transparent',
						'selectors' => [
								'{{WRAPPER}} .wrrap-content-filter' => 'background-color: {{VALUE}};',
						],
				]
		);

		$this->add_responsive_control(
				'ica_form_padding',
				[
						'label' => __( 'Padding', 'elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%' ],
						'selectors' => [
								'{{WRAPPER}} .wrrap-content-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
				]
		);

		$this->end_controls_section();
	}

	protected function get_supported_taxonomies($taxonomy) {
		$supported_taxonomies = [];

		$categories = get_terms( array(
			'taxonomy' => $taxonomy,
	    'hide_empty' => false,
		) );
		if( ! empty( $categories ) ) {
			foreach ( $categories as $category ) {
			    $supported_taxonomies[$category->slug] = $category->name;
			}
		}

		return $supported_taxonomies;
	}

  protected function _register_controls() {
		$this->register_layout_section_controls();
		$this->register_query_filter_section_controls();
		$this->register_style_form_section_controls();
	}

	protected function render_icon( $icon ) {
		$icon_html = '';

		if( !empty( $icon['value'] ) ) {
			if( 'svg' !== $icon['library'] ) {
				$icon_html = '<i class="' . esc_attr( $icon['value'] ) . '" aria-hidden="true"></i>';
			} else {
				$icon_html = file_get_contents($icon['value']['url']);
			}
		}

		return $icon_html;
	}

  protected function render() {
		$settings = $this->get_settings_for_display();
		$placeholder = $settings['placeholder'];
		$filters = implode(',',$settings['ica_filters']);
		$ajax = $settings['ajax_toggle'];
		$action = $settings['action_result'];
		echo do_shortcode('[ica_content_filter
			placeholder="'.$placeholder.'"
			suggestions="'.$settings['ica_suggestions'].'"
			filters="'.$filters.'"
			ajax="'.$ajax.'"
			action="'.$action.'"
			post_type="'.$settings['ica_source'].'"
			numberposts="'.$settings['posts_per_page'].'"
			orderby="'.$settings['orderby'].'"
			order="'.$settings['order'].'"
			default_filter="'.$settings['filter_toggle'].'"
			pagination="'.$settings['pagination_toggle'].'"
			showcontent="'.$settings['content_toggle'].'"
			types="'.($settings['cat_type'] ? implode(',',$settings['cat_type']) :'').'"
			topics="'.($settings['cat_topic'] ? implode(',',$settings['cat_topic']) : '').'"
		]');
	}

	protected function _content_template() {

	}
}
