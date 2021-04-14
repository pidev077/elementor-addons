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
		return [ 'elementor-addons-content-filter' ];
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
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => [ 'lorem ipsum', 'dolor semet', 'sed it embaco' ],
			]
		);

		$this->add_control(
			'ica_filters',
			[
				'label' => __( 'Filters', 'bearsthemes-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'ins-type'  => __( 'Types', 'bearsthemes-addons' ),
					'ins-topic' => __( 'Topic', 'bearsthemes-addons' ),
					'date' => __( 'Date', 'bearsthemes-addons' ),
				],
				'label_block' => true,
				'default' => [ 'ins-type', 'ins-topic', 'date' ],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_layout_section_controls() {
		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => __( 'Settings', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'bearsthemes-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'bearsthemes-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bearsthemes-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bearsthemes-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'condition' => [
					'icon_position' => ['', 'top'],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-counter' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'vertical_ignment',
			[
				'label' => __( 'Vertical Alignment', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top' => __( 'Top', 'bearsthemes-addons' ),
					'middle' => __( 'Middle', 'bearsthemes-addons' ),
					'bottom' => __( 'Bottom', 'bearsthemes-addons' ),
				],
				'condition' => [
					'icon_position!' => ['', 'top'],
				],
				'prefix_class' => 'elementor-counter--vertical-align-',
			]
		);

		$this->end_controls_section();
	}

  protected function _register_controls() {
		$this->register_layout_section_controls();
		//$this->register_design_layout_section_controls();
	}

	protected function counter_data() {
		$settings = $this->get_settings_for_display();

		$counter_data = array(
			'easing' => 'linear',
			'duration' => $settings['duration'],
			'toValue' => $settings['ending_number'],
			'rounding' => 0,
		);

		if ( ! empty( $settings['thousand_separator'] ) ) {
			$counter_data['delimiter'] = $settings['thousand_separator_char'];
		}

		return $counter_data = json_encode( $counter_data );
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
		$suggestions = implode(',',$settings['ica_suggestions']);
		$filters = implode(',',$settings['ica_filters']);
		echo do_shortcode('[ica_content_filter placeholder="'.$placeholder.'" suggestions="'.$suggestions.'" filters="'.$filters.'"]');
	}

	protected function _content_template() {

	}
}
