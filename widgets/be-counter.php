<?php
namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Counter extends Widget_Base {

	public function get_name() {
		return 'be-counter';
	}

	public function get_title() {
		return __( 'Data story', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-counter';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

  public function get_script_depends() {
		//return [ 'elementor-addons' ];
		return [ 'elementor-waypoints', 'jquery-numerator', 'elementor-addons' ];
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
		$this->add_responsive_control(
			'columns',
			[
				'label' => __( 'Columns', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'prefix_class' => 'elementor-grid%s-',
			]
		);
		$this->add_control(
			'bt_heading',
			[
				'label' => __( 'Heading', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Lorem ipsum dolor hero data story', 'bearsthemes-addons' ),
			]
		);
		$this->add_control(
			'bt_button',
			[
				'label' => __( 'Button', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Visit our data hub', 'bearsthemes-addons' ),
			]
		);
		$this->add_control(
			'bt_button_url', [
				'label' => __( 'Button Link', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '#',
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'select_icon',
			[
				'label' => __( 'Choose Image', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$repeater->add_control(
			'starting_number',
			[
				'label' => __( 'Starting Number', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'ending_number',
			[
				'label' => __( 'Ending Number', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
			]
		);


		$repeater->add_control(
			'duration',
			[
				'label' => __( 'Animation Duration', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2000,
				'min' => 100,
				'step' => 100,
			]
		);

		$repeater->add_control(
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

		$repeater->add_control(
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
		$repeater->add_control(
			'sub_title',
			[
				'label' => __( 'Sub Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'This is the heading​', 'bearsthemes-addons' ),
				'condition' => [
					'show_title!' => '',
				],
			]
		);
		$repeater->add_control(
			'link_url', [
				'label' => __( 'Link', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '#',
				'condition' => [
					'show_title!' => '',
				],
			]
		);
		$this->add_control(
			'list',
			[
				'label' => __( 'Counter', 'bearsthemes-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __( 'Total lorem ipsum', 'bearsthemes-addons' ),
						'sub_title' => __( 'BILLION', 'bearsthemes-addons' ),
						'ending_number' => __( '7655', 'bearsthemes-addons' ),
						'select_icon' => __( [
							'value' => 'fas fa-fire',
							'library' => 'fa-solid',
						], 'bearsthemes-addons' ),
					],
					[
						'title' => __( 'Total lorem ipsum', 'bearsthemes-addons' ),
						'sub_title' => __( 'BILLION', 'bearsthemes-addons' ),
						'ending_number' => __( '4176', 'bearsthemes-addons' ),
						'select_icon' => __( [
							'value' => 'fas fa-house-damage',
							'library' => 'fa-solid',
						], 'bearsthemes-addons' ),
					],
					[
						'title' => __( 'Total lorem ipsum', 'bearsthemes-addons' ),
						'sub_title' => __( 'BILLION', 'bearsthemes-addons' ),
						'ending_number' => __( '3397', 'bearsthemes-addons' ),
						'select_icon' => __( [
							'value' => 'fas fa-stethoscope',
							'library' => 'fa-solid',
						], 'bearsthemes-addons' ),
					],
					[
						'title' => __( 'Total lorem ipsum', 'bearsthemes-addons' ),
						'sub_title' => __( 'BILLION', 'bearsthemes-addons' ),
						'ending_number' => __( '5118', 'bearsthemes-addons' ),
						'select_icon' => __( [
							'value' => 'fas fa-home',
							'library' => 'fa-solid',
						], 'bearsthemes-addons' ),
					],
				],
				'title_field' => '{{{ ending_number }}}',
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

		//$this->register_design_layout_section_controls();
		$this->register_design_icon_section_controls();
		$this->register_design_number_section_controls();
		$this->register_design_title_section_controls();
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
		//var_dump($settings['columns']);
		if ( empty( $settings['list'] ) ) {
			return;
		} ?>
		<div class="elementor-grid-<?php echo $settings['columns']; ?> bt-custom-counter">
		<h2 class=bt-heading><?php echo $settings['bt_heading']; ?></h2>
		<div class="elementor-grid">
		<?php
		$i = 0;
		$i < 10;
		$i++;
		foreach ( $settings['list'] as $index => $item ) {
			$images = $item['select_icon'];
		?>
		<div class="elementor-counter">
			<h2 class=bt-title><?php echo $item['title']; ?></h2>
			<?php if ( '' !== $settings['show_icon'] ) { ?>
				<div class="elementor-counter__icon-wrap">
					<?php if ($images['url']): ?>
							<div class="elementor-counter__icon">
									<img src="<?php echo $images['url'] ?>" alt="image">
							</div>
					<?php endif; ?>
				</div>
			<?php } ?>

			<div class="elementor-counter__content">
				<div class="elementor-counter__number-wrap">
					<?php if( $item['prefix'] ) { ?>
						<span class="elementor-counter__number-prefix">
							<?php echo $item['prefix']; ?>
						</span>
					<?php } ?>

					<span class="elementor-counter__number vv<?php echo $i++; ?>" data-counter={"easing":"linear","duration":<?php echo $item['duration'] ?>,"toValue":<?php echo $item['ending_number'] ?>,"rounding":0,"delimiter":"."}>
						<?php echo $item['starting_number']; ?>
					</span>

					<?php if( $item['suffix'] ) { ?>
						<span class="elementor-counter__number-suffix">
							<?php echo $item['suffix']; ?>
						</span>
					<?php } ?>
				</div>

				<?php if ( '' !== $item['show_title'] ) { ?>
					<h3 class="elementor-counter__title">
						<a href="<?php echo $item['link_url']; ?>"><?php echo $item['sub_title']; ?></a>
					</h3>
				<?php	} ?>
			</div>
		</div>

		<?php
		}
		?>
	</div><a class="bt-button" href="<?php echo $settings['bt_button_url']; ?>"><?php echo $settings['bt_button']; ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></div><?php
	}

	protected function _content_template() {

	}
}
