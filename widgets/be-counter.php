<?php
namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Counter extends Widget_Base {

	public function get_name() {
		return 'be-counter';
	}

	public function get_title() {
		return __( 'Counter', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-counter';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

  public function get_script_depends() {
		return [ 'elementor-addons' ];
	}

  public function get_style_depends() {
		return [ 'elementor-addons' ];
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label' => __( 'Show Icon', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'select_icon',
			[
				'label' => __( 'Icon', 'bearsthemes-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_view',
			[
				'label' => __( 'View', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'bearsthemes-addons' ),
					'stacked' => __( 'Stacked', 'bearsthemes-addons' ),
					'framed' => __( 'Framed', 'bearsthemes-addons' ),
				],
				'condition' => [
					'show_icon!' => '',
				],
				'prefix_class' => 'elementor-counter--icon-view-',
			]
		);

		$this->add_control(
			'icon_shape',
			[
				'label' => __( 'Shape', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'circle',
				'options' => [
					'circle' => __( 'Circle', 'bearsthemes-addons' ),
					'square' => __( 'Square', 'bearsthemes-addons' ),
				],
				'condition' => [
					'show_icon!' => '',
					'icon_view!' => '',
				],
				'prefix_class' => 'elementor-counter--icon-shape-',
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => __( 'Icon Position', 'bearsthemes-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'bearsthemes-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'bearsthemes-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'bearsthemes-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor-counter--icon-position-',
				'condition' => [
					'show_icon!' => '',
				],
			]
		);

		$this->add_control(
			'starting_number',
			[
				'label' => __( 'Starting Number', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ending_number',
			[
				'label' => __( 'Ending Number', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
			]
		);

		$this->add_control(
			'prefix',
			[
				'label' => __( 'Number Prefix', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => 1,
			]
		);

		$this->add_control(
			'suffix',
			[
				'label' => __( 'Number Suffix', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Plus', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'duration',
			[
				'label' => __( 'Animation Duration', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2000,
				'min' => 100,
				'step' => 100,
			]
		);

		$this->add_control(
			'thousand_separator',
			[
				'label' => __( 'Thousand Separator', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'thousand_separator_char',
			[
				'label' => __( 'Separator', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'thousand_separator' => 'yes',
				],
				'options' => [
					',' => 'Default',
					'.' => 'Dot',
					' ' => 'Space',
				],
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'This is the heading​', 'bearsthemes-addons' ),
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_layout_section_controls() {
		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
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

	protected function register_design_icon_section_controls() {
		$this->start_controls_section(
			'section_design_icon',
			[
				'label' => __( 'Icon', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-counter__icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-counter__icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_size_wrap',
			[
				'label' => __( 'Wrap Size', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
					],
				],
				'condition' => [
					'icon_view!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-counter--icon-view-stacked .elementor-counter__icon,
					 {{WRAPPER}}.elementor-counter--icon-view-framed .elementor-counter__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_border',
			[
				'label' => __( 'Border Size', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'icon_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-counter--icon-view-framed .elementor-counter__icon' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'icon_view!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-counter--icon-view-stacked .elementor-counter__icon,
					 {{WRAPPER}}.elementor-counter--icon-view-framed .elementor-counter__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-counter__icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-counter--icon-position-left .elementor-counter__icon-wrap' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-counter--icon-position-right .elementor-counter__icon-wrap' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-counter__icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-counter__icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}}.elementor-counter--icon-view-stacked .elementor-counter__icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}}.elementor-counter--icon-view-stacked .elementor-counter__icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}}.elementor-counter--icon-view-framed .elementor-counter__icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}}.elementor-counter--icon-view-framed .elementor-counter__icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'icon_view!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-counter--icon-view-stacked .elementor-counter__icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-counter--icon-view-framed .elementor-counter__icon' => 'background-color: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'icon_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-counter--icon-view-framed .elementor-counter__icon' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-counter__icon:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-counter__icon:hover svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}}.elementor-counter--icon-view-stacked .elementor-counter__icon:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}}.elementor-counter--icon-view-stacked .elementor-counter__icon:hover svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}}.elementor-counter--icon-view-framed .elementor-counter__icon:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}}.elementor-counter--icon-view-framed .elementor-counter__icon:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'icon_view!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-counter--icon-view-stacked .elementor-counter__icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-counter--icon-view-framed .elementor-counter__icon:hover' => 'background-color: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'icon_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'icon_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-counter--icon-view-framed .elementor-counter__icon:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_design_number_section_controls() {
		$this->start_controls_section(
			'section_design_number',
			[
				'label' => __( 'Number', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-counter__number-wrap' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_number',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-counter__number-wrap',
			]
		);

		$this->add_control(
			'number_spacing',
			[
				'label' => __( 'Spacing', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-counter__number-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_title_section_controls() {
		$this->start_controls_section(
			'section_design_title',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-counter__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-counter__title',
			]
		);

		$this->end_controls_section();
	}

  protected function _register_controls() {
		$this->register_layout_section_controls();

		$this->register_design_layout_section_controls();
		$this->register_design_icon_section_controls();
		$this->register_design_number_section_controls();
		$this->register_design_title_section_controls();
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

		?>
		<div class="elementor-counter">
			<?php if ( '' !== $settings['show_icon'] ) { ?>
				<div class="elementor-counter__icon-wrap">
					<div class="elementor-counter__icon">
						<?php echo $this->render_icon( $settings['select_icon'] ); ?>
					</div>
				</div>
			<?php } ?>

			<div class="elementor-counter__content">
				<div class="elementor-counter__number-wrap">
					<?php if( $settings['prefix'] ) { ?>
						<span class="elementor-counter__number-prefix">
							<?php echo $settings['prefix']; ?>
						</span>
					<?php } ?>

					<span class="elementor-counter__number" data-counter="<?php echo esc_attr( $this->counter_data() ); ?>">
						<?php echo $settings['starting_number']; ?>
					</span>

					<?php if( $settings['suffix'] ) { ?>
						<span class="elementor-counter__number-suffix">
							<?php echo $settings['suffix']; ?>
						</span>
					<?php } ?>
				</div>

				<?php if ( '' !== $settings['show_title'] ) { ?>
					<h3 class="elementor-counter__title">
						<?php echo $settings['title']; ?>
					</h3>
				<?php	} ?>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {

	}
}
