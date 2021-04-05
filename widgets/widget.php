<?php
namespace ElementorAddons\Widgets\Icon_Box;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Icon_Box extends Widget_Base {

	public function get_name() {
		return 'be-icon-box';
	}

	public function get_title() {
		return __( 'Icon Box', 'elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function get_style_depends() {
		return [ 'elementor-addons' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'elementor-addons' ),
			]
		);

		$this->add_control(
			'select_icon',
			[
				'label' => __( 'Icon', 'elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'This is the heading', 'elementor-addons' ),
			]
		);

		$this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-addons' ),
			]
		);

		$this->add_control(
			'list_url', [
				'label' => __( 'Url', 'elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '#',
			]
		);

		$this->end_controls_section();
	}

	public function render_icon( $icon ) {
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
		<div class="elementor-icon-box">

			<div class="elementor-icon-box__icon">
				<?php echo $this->render_icon( $settings['select_icon'] ); ?>
			</div>

			<div class="elementor-icon-box__content">

				<h3 class="elementor-icon-box__title"><?php echo $settings['title']; ?></h3>

				<div class="elementor-icon-box__desc"><?php echo $settings['desc']; ?></div>

				<a href="<?php echo esc_url( $item['list_content'] ); ?>" class="readmore"><?php esc_html_e( 'Read More', 'elementor-addons' ); ?></a>

			</div>

		</div>


		<?php

	}

	protected function _content_template() {

	}
}
