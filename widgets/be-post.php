<?php
namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Posts extends Widget_Base {

	public function get_name() {
		return 'be-posts';
	}

	public function get_title() {
		return __( 'Posts', 'elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-post-list';
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

	protected function get_supported_ids() {
		$supported_ids = [];

		$wp_query = new \WP_Query( array(
														'post_type' => 'resources',
														'post_status' => 'publish'
													) );

		if ( $wp_query->have_posts() ) {
	    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $supported_ids[get_the_ID()] = get_the_title();
	    }
		}

		return $supported_ids;
	}

	protected function get_supported_taxonomies() {
		$supported_taxonomies = [];

		$categories = get_terms( array(
			'taxonomy' => 'ins-type',
	    'hide_empty' => false,
		) );
		if( ! empty( $categories ) ) {
			foreach ( $categories as $category ) {
			    $supported_taxonomies[$category->term_id] = $category->name;
			}
		}

		return $supported_taxonomies;
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
			]
		);

		$this->add_responsive_control(
			'sliders_per_view',
			[
				'label' => __( 'Slides Per View', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
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
			]
		);

		$this->add_control(
			'posts_count',
			[
				'label' => __( 'Posts count', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'show_category',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Length', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => apply_filters( 'excerpt_length', 25 ),
				'condition' => [
					'show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_more',
			[
				'label' => __( 'Excerpt More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => apply_filters( 'excerpt_more', '' ),
				'condition' => [
					'show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'show_read_more',
			[
				'label' => __( 'Read More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => __( 'Read More Text', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'bearsthemes-addons' ),
				'condition' => [
					'show_read_more!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_query_section_controls() {
		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Query', 'bearsthemes-addons' ),
			]
		);

		$this->start_controls_tabs( 'tabs_query' );

		$this->start_controls_tab(
			'tab_query_include',
			[
				'label' => __( 'Include', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'ids',
			[
				'label' => __( 'Ids', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_query_exnlude',
			[
				'label' => __( 'Exclude', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'ids_exclude',
			[
				'label' => __( 'Ids', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category_exclude',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => __( 'Offset', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'description' => __( 'Use this setting to skip over posts (e.g. \'2\' to skip over 2 posts).', 'bearsthemes-addons' ),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date' => __( 'Date', 'bearsthemes-addons' ),
					'post_title' => __( 'Title', 'bearsthemes-addons' ),
					'menu_order' => __( 'Menu Order', 'bearsthemes-addons' ),
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

		$this->add_control(
			'ignore_sticky_posts',
			[
				'label' => __( 'Ignore Sticky Posts', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => __( 'Sticky-posts ordering is visible on frontend only', 'bearsthemes-addons' ),
			]
		);

		$this->end_controls_section();
	}

	protected function register_pagination_section_controls() {
		$this->start_controls_section(
			'section_pagination',
			[
				'label' => __( 'Pagination', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' => __( 'Pagination', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'bearsthemes-addons' ),
					'number' => __( 'Number', 'bearsthemes-addons' ),
					'both' => __( 'Number + Previous/Next', 'bearsthemes-addons' ),
				],
			]
		);

		$this->end_controls_section();

	}


	protected function register_design_latyout_section_controls() {
		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => __( 'Space Between', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 30,
				],
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
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_box_section_controls() {
		$this->start_controls_section(
			'section_design_box',
			[
				'label' => __( 'Box', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_border_width',
			[
				'label' => __( 'Border Width', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'bg_effects_tabs' );

		$this->start_controls_tab( 'classic_style_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .elementor-post',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'classic_style_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .elementor-post:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_design_image_section_controls() {
		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-post__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label' => __( 'Spacing', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post__thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
				'default' => [
					'size' => '',
				],
			]
		);

		$this->start_controls_tabs( 'thumbnail_effects_tabs' );

		$this->start_controls_tab( 'normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_filters',
				'selector' => '{{WRAPPER}} .elementor-post__thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_hover_filters',
				'selector' => '{{WRAPPER}} .elementor-post:hover .elementor-post__thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_design_content_section_controls() {
		$this->start_controls_section(
			'section_design_content',
			[
				'label' => __( 'Content', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_comment_count_style',
			[
				'label' => __( 'Comment Count', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_comment_count!' => '',
				],
			]
		);

		$this->add_control(
			'comment_count_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__comment-count svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'show_comment_count!' => '',
				],
			]
		);

		$this->add_control(
			'comment_count_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-post__comment-count:hover svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'show_comment_count!' => '',
				],
			]
		);

		$this->add_control(
			'heading_category_style',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__cat-links' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-post__cat-links:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_category!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__cat-links',
				'condition' => [
					'show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_spacing',
			[
				'label' => __( 'Spacing', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post__cat-links' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_category!' => '',
				],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
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
					'{{WRAPPER}} .elementor-post__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-post__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__title',
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label' => __( 'Spacing', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_meta_style',
			[
				'label' => __( 'Meta Data', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__meta' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-post__meta a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_space_between_size',
			[
				'label' => __( 'Space Between Size', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post__meta li:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_space_between_color',
			[
				'label' => __( 'Space Between Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-post__meta li:not(:last-child):after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__meta li',
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_spacing',
			[
				'label' => __( 'Spacing', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post__meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'heading_excerpt_style',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_excerpt!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__excerpt',
				'condition' => [
					'show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_spacing',
			[
				'label' => __( 'Spacing', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post__excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'heading_read_more_style',
			[
				'label' => __( 'Read More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_read_more!' => '',
				],
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__read-more' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_read_more!' => '',
				],
			]
		);

		$this->add_control(
			'read_more_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-post__read-more:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_read_more!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'read_more_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__read-more',
				'condition' => [
					'show_read_more!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_additional_section_controls() {
		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'navigation',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Navigation', 'bearsthemes-addons' ),
				'default' => 'icon',
				'options' => [
					'' => __( 'None', 'bearsthemes-addons' ),
					'icon' => __( 'Icon', 'bearsthemes-addons' ),
					'text' => __( 'Text', 'bearsthemes-addons' ),
					'both' => __( 'Icon and Text', 'bearsthemes-addons' ),
				],
				'prefix_class' => 'elementor-navigation-type-',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' => __( 'Pagination', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bullets',
				'options' => [
					'' => __( 'None', 'bearsthemes-addons' ),
					'bullets' => __( 'Dots', 'bearsthemes-addons' ),
					'fraction' => __( 'Fraction', 'bearsthemes-addons' ),
					'progressbar' => __( 'Progress', 'bearsthemes-addons' ),
				],
				'prefix_class' => 'elementor-pagination-type-',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => __( 'Transition Duration', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => __( 'Infinite Loop', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_navigation_section_controls() {
	$this->start_controls_section(
		'section_design_navigation',
		[
			'label' => __( 'Navigation', 'bearsthemes-addons' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);

	$this->start_controls_tabs( 'tabs_arrows' );

	$this->start_controls_tab(
		'tabs_arrow_prev',
		[
			'label' => __( 'Previous', 'bearsthemes-addons' ),
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->add_control(
		'arrow_prev_icon',
		[
			'label' => __( 'Previous Icon', 'bearsthemes-addons' ),
			'type' => Controls_Manager::ICONS,
			'fa4compatibility' => 'icon',
			'default' => [
				'value' => 'fas fa-angle-left',
				'library' => 'fa-solid',
			],
			'condition' => [
				'navigation!' => ['text', ''],
			],
		]
	);

	$this->add_control(
		'arrow_prev_text',
		[
			'label' => __( 'Previous Text', 'bearsthemes-addons' ),
			'type' => Controls_Manager::TEXT,
			'default' => __( 'Prev', 'bearsthemes-addons' ),
			'label_block' => true,
			'condition' => [
				'navigation!' => ['icon', ''],
			],
		]
	);

	$this->end_controls_tab();

	$this->start_controls_tab(
		'tabs_arrow_next',
		[
			'label' => __( 'Next', 'bearsthemes-addons' ),
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->add_control(
		'arrow_next_icon',
		[
			'label' => __( 'Next Icon', 'bearsthemes-addons' ),
			'type' => Controls_Manager::ICONS,
			'fa4compatibility' => 'icon',
			'default' => [
				'value' => 'fas fa-angle-right',
				'library' => 'fa-solid',
			],
			'condition' => [
				'navigation!' => ['text', ''],
			],
		]
	);

	$this->add_control(
		'arrow_next_text',
		[
			'label' => __( 'Next Text', 'bearsthemes-addons' ),
			'type' => Controls_Manager::TEXT,
			'default' => __( 'Next', 'bearsthemes-addons' ),
			'label_block' => true,
			'condition' => [
				'navigation!' => ['icon', ''],
			],
		]
	);

	$this->end_controls_tab();

	$this->end_controls_tabs();

	$this->add_control(
		'navigation_position',
		[
			'label' => __( 'Position', 'bearsthemes-addons' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'inside',
			'options' => [
				'inside' => __( 'Inside', 'bearsthemes-addons' ),
				'outside' => __( 'Outside', 'bearsthemes-addons' ),
			],
			'prefix_class' => 'elementor-navigation-position-',
			'render_type' => 'template',
			'separator' => 'before',
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->add_responsive_control(
		'navigation_space',
		[
			'label' => __( 'Spacing', 'bearsthemes-addons' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}}.elementor-navigation-position-inside .elementor-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}.elementor-navigation-position-inside .elementor-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}.elementor-navigation-position-outside .elementor-swiper-button-prev' => 'left: -{{SIZE}}{{UNIT}};',
				'{{WRAPPER}}.elementor-navigation-position-outside .elementor-swiper-button-next' => 'right: -{{SIZE}}{{UNIT}};',

			],
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->add_control(
		'navigation_size',
		[
			'label' => __( 'Button Size', 'bearsthemes-addons' ),
			'type' => Controls_Manager::SLIDER,
			'default' => [
				'size' => '',
			],
			'range' => [
				'px' => [
					'min' => 30,
					'max' => 120,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button' => 'height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}',
			],
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->add_control(
		'navigation_icon_size',
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
				'{{WRAPPER}} .elementor-swiper-button' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .elementor-swiper-button img' => 'width: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'navigation!' => ['text', ''],
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'navigation_text_typography',
			'label' => __( 'Text Typography', 'bearsthemes-addons' ),
			'selector' => '{{WRAPPER}} .elementor-swiper-button span',
			'condition' => [
				'navigation!' => ['icon', ''],
			],
		]
	);

	$this->add_control(
		'navigation_border_width',
		[
			'label' => __( 'Border Width', 'bearsthemes-addons' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 10,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->add_control(
		'navigation_border_radius',
		[
			'label' => __( 'Border Radius', 'bearsthemes-addons' ),
			'type' => Controls_Manager::DIMENSIONS,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->start_controls_tabs( 'tabs_navigation' );

	$this->start_controls_tab(
		'tabs_navigation_normal',
		[
			'label' => __( 'Normal', 'bearsthemes-addons' ),
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->add_control(
		'navigation_icon_color',
		[
			'label' => __( 'Icon Color', 'bearsthemes-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button i' => 'color: {{VALUE}}',
				'{{WRAPPER}} .elementor-swiper-button svg' => 'fill: {{VALUE}}',
			],
			'condition' => [
				'navigation!' => ['text', ''],
			],
		]
	);

	$this->add_control(
		'navigation_text_color',
		[
			'label' => __( 'Text Color', 'bearsthemes-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button span' => 'color: {{VALUE}}',
			],
			'condition' => [
				'navigation!' => ['icon', ''],
			],
		]
	);

	$this->add_control(
		'navigation_background',
		[
			'label' => __( 'Background Color', 'bearsthemes-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button' => 'background-color: {{VALUE}}',
			],
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->add_control(
		'navigation_border_color',
		[
			'label' => __( 'Border Color', 'bearsthemes-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button' => 'border-color: {{VALUE}}',
			],
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->end_controls_tab();

	$this->start_controls_tab(
		'tabs_navigation_hover',
		[
			'label' => __( 'Hover', 'bearsthemes-addons' ),
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->add_control(
		'navigation_icon_color_hover',
		[
			'label' => __( 'Icon Color', 'bearsthemes-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button:hover i' => 'color: {{VALUE}}',
				'{{WRAPPER}} .elementor-swiper-button:hover svg' => 'fill: {{VALUE}}',
			],
			'condition' => [
				'navigation!' => ['text', ''],
			],
		]
	);

	$this->add_control(
		'navigation_text_color_hover',
		[
			'label' => __( 'Text Color', 'bearsthemes-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button:hover span' => 'color: {{VALUE}}',
			],
			'condition' => [
				'navigation!' => ['icon', ''],
			],
		]
	);

	$this->add_control(
		'navigation_background_hover',
		[
			'label' => __( 'Background Color', 'bearsthemes-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button:hover' => 'background-color: {{VALUE}}',
			],
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->add_control(
		'navigation_border_color_hover',
		[
			'label' => __( 'Border Color', 'bearsthemes-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-button:hover' => 'border-color: {{VALUE}}',
			],
			'condition' => [
				'navigation!' => '',
			],
		]
	);

	$this->end_controls_tab();

	$this->end_controls_tabs();

	$this->end_controls_section();
}

protected function register_design_pagination_section_controls() {
	$this->start_controls_section(
		'section_design_pagination',
		[
			'label' => __( 'Pagination', 'bearsthemes-addons' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);

	$this->add_control(
		'pagination_position',
		[
			'label' => __( 'Position', 'bearsthemes-addons' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'inside',
			'options' => [
				'inside' => __( 'Inside', 'bearsthemes-addons' ),
				'outside' => __( 'Outside', 'bearsthemes-addons' ),
			],
			'prefix_class' => 'elementor-pagination-position-',
			'render_type' => 'template',
			'condition' => [
				'pagination!' => '',
			],
		]
	);

	$this->add_responsive_control(
		'pagination_space',
		[
			'label' => __( 'Spacing', 'bearsthemes-addons' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}}.elementor-pagination-position-inside .elementor-swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}.elementor-pagination-position-outside .swiper-container' => 'margin-bottom: {{SIZE}}{{UNIT}};',

			],
			'condition' => [
				'pagination!' => '',
			],
		]
	);

	$this->add_responsive_control(
		'pagination_align',
		[
			'label' => __( 'Alignment', 'bearsthemes-addons' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left'    => [
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
			'default' => 'center',
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-pagination' => 'text-align: {{VALUE}};',
			],
			'condition' => [
				'pagination!' => '',
			],
		]
	);


	$this->add_control(
		'pagination_space_between',
		[
			'label' => __( 'Space Between', 'bearsthemes-addons' ),
			'type' => Controls_Manager::SLIDER,
			'default' => [
				'size' => 6,
			],
			'range' => [
				'px' => [
					'min' => 2,
					'max' => 20,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-swiper-pagination .swiper-pagination-bullet' => 'margin: 0 {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'pagination' => 'bullets',
			],
		]
	);


	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'pagination_typography',
			'label' => __( 'Typography', 'bearsthemes-addons' ),
			'selector' => '{{WRAPPER}} .swiper-pagination-fraction',
			'condition' => [
				'pagination' => 'fraction',
			],
		]
	);

	$this->end_controls_section();
}

	protected function _register_controls() {

		$this->register_layout_section_controls();
		$this->register_query_section_controls();
		$this->register_additional_section_controls();

		$this->register_design_latyout_section_controls();
		$this->register_design_box_section_controls();
		$this->register_design_image_section_controls();
		$this->register_design_content_section_controls();
		$this->register_design_navigation_section_controls();
		$this->register_design_pagination_section_controls();

	}


	public function query_posts() {
		$settings = $this->get_settings_for_display();

		if( is_front_page() ) {
	    $paged = (get_query_var('page')) ? absint( get_query_var('page') ) : 1;
		} else {
	    $paged = (get_query_var('paged')) ? absint( get_query_var('paged') ) : 1;
		}

		$args = [
			'post_type' => 'resources',
			'post_status' => 'publish',
			'posts_per_page' => $this->get_settings_for_display('posts_per_page'),
			'paged' => $paged,
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
			'ignore_sticky_posts' => ('yes' !== $settings['ignore_sticky_posts']) ? true : false,
		];

		if( ! empty( $settings['ids'] ) ) {
			$args['post__in'] = $settings['ids'];
		}

		if( ! empty( $settings['ids_exclude'] ) ) {
			$args['post__not_in'] = $settings['ids_exclude'];
		}

		if( ! empty( $settings['category'] ) ) {
			$args['tax_query'] = array(
				array(
						'taxonomy' => 'ins-type',
						'field'    => 'term_id',
						'terms'    => $settings['category'],
				),
			);
		}

		if( ! empty( $settings['category_exclude'] ) ) {
			$args['tax_query'] = array(
				array(
						'taxonomy' => 'ins-type',
						'field'    => 'term_id',
						'terms'    => $settings['category_exclude'],
						'operator' => 'NOT IN',
				),
			);
		}
		if( 0 !== absint( $settings['offset'] ) ) {
			$args['offset'] = $settings['offset'];
		}

		return $query = new \WP_Query( $args );
	}

	protected function swiper_data() {
		$settings = $this->get_settings_for_display();

		$slides_per_view = $this->get_settings_for_display('sliders_per_view') ? $this->get_settings_for_display('sliders_per_view') : 1;
		$slides_per_view_tablet = $this->get_settings_for_display('sliders_per_view_tablet') ? $this->get_settings_for_display('sliders_per_view_tablet') : $slides_per_view;
		$slides_per_view_mobile = $this->get_settings_for_display('sliders_per_view_mobile') ? $this->get_settings_for_display('sliders_per_view_mobile') : $slides_per_view_tablet;

		$space_between = $this->get_settings_for_display('space_between')['size'] ? $this->get_settings_for_display('space_between')['size'] : 30;
		$space_between_tablet = $this->get_settings_for_display('space_between_tablet')['size'] ? $this->get_settings_for_display('space_between_tablet')['size'] : $space_between;
		$space_between_mobile = $this->get_settings_for_display('space_between_mobile')['size'] ? $this->get_settings_for_display('space_between_mobile')['size'] : $space_between_tablet;


		$swiper_data = array(
			'slidesPerView' => $slides_per_view_mobile,
			'spaceBetween' => $space_between_mobile,
			'speed' => $settings['speed'],
			'loop' => $settings['loop'] == 'yes' ? true : false,
			'breakpoints' => array(
				767 => array(
				  'slidesPerView' => $slides_per_view_tablet,
				  'spaceBetween' => $space_between_tablet,
				),
				1024 => array(
				  'slidesPerView' => $slides_per_view,
				  'spaceBetween' => $space_between,
				)
			),

		);

		if( '' !== $settings['navigation'] ) {
			$swiper_data['navigation'] = array(
				'nextEl' => '.elementor-swiper-button-next',
				'prevEl' => '.elementor-swiper-button-prev',
			);
		}

		if( '' !== $settings['pagination'] ) {
			$swiper_data['pagination'] = array(
				'el' => '.elementor-swiper-pagination',
				'type' => $settings['pagination'],
				'clickable' => true,
			);
		}

		if( $settings['autoplay'] === 'yes' ) {
			$swiper_data['autoplay'] = array(
				'delay' => $settings['autoplay_speed'],
			);
		}

		return $swiper_json = json_encode($swiper_data);
	}
	public function render_loop_header() {
		$settings = $this->get_settings_for_display();

		$classes = 'elementor-swiper swiper-container';

		$classes .= ' elementor-posts--default';

		?>
		<div class="<?php echo esc_attr( $classes ); ?>" data-swiper="<?php echo esc_attr( $this->swiper_data() ); ?>">
		<div class="swiper-wrapper">
		<?php
	}

	protected function render_icon( $icon ) {
		$icon_html = '';

		if( !empty( $icon['value'] ) ) {
			if( 'svg' !== $icon['library'] ) {
				$icon_html = '<i class="' . esc_attr( $icon['value'] ) . '" aria-hidden="true"></i>';
			} else {
				$icon_html = file_get_contents($icon['value']['url']);;
			}
		}

		return $icon_html;
	}

	protected function render_navigation() {
		$settings = $this->get_settings_for_display();

		if( '' === $settings['navigation'] ) {
			return;
		}

		?>
		<div class="elementor-swiper-button elementor-swiper-button-prev">
			<?php
				if( '' !== $this->render_icon( $settings['arrow_prev_icon'] ) ) {
					echo $this->render_icon( $settings['arrow_prev_icon'] );
				}

				if( ( 'both' === $settings['navigation'] || 'text' === $settings['navigation'] ) && '' !== $settings['arrow_prev_text'] ) {
					echo '<span>' . $settings['arrow_prev_text'] . '</span>';
				}
			?>

		</div>
		<div class="elementor-swiper-button elementor-swiper-button-next">
			<?php
				if( ( 'both' === $settings['navigation'] || 'text' === $settings['navigation'] ) && '' !== $settings['arrow_next_text'] ) {
					echo '<span>' . $settings['arrow_next_text'] . '</span>';
				}

				if( '' !== $this->render_icon( $settings['arrow_next_icon'] ) ) {
					echo $this->render_icon( $settings['arrow_next_icon'] );
				}
			?>
		</div>
		<?php
	}

	protected function render_pagination() {
		$settings = $this->get_settings_for_display();

		if( '' === $settings['pagination'] ) {
			return;
		}

		?>
		<div class="elementor-swiper-pagination"></div>
		<?php
	}

	public function render_loop_footer() {
		$settings = $this->get_settings_for_display();

		?>
				</div>

					<?php
						if( 'inside' === $settings['pagination_position'] ) {
							$this->render_pagination();
						}

						if( 'inside' === $settings['navigation_position'] ) {
							$this->render_navigation();
						}
					?>

			</div>

			<?php
				if( 'outside' === $settings['pagination_position'] ) {
					$this->render_pagination();
				}

				if( 'outside' === $settings['navigation_position'] ) {
					$this->render_navigation();
				}
			?>

		<?php
	}

	public function filter_excerpt_length() {

		return $this->get_settings_for_display('excerpt_length');
	}

	public function filter_excerpt_more() {

		return $this->get_settings_for_display('excerpt_more');
	}

	protected function render_post() {
		$settings = $this->get_settings_for_display();
		$term_list = get_the_terms( get_the_id(), 'ins-type' );
		$currentcolor='';
		foreach($term_list as $term_single)
		{
				$termid= $term_single->term_id;
				$colorvalue= get_field('color',  'ins-type_' . $termid);
				if($colorvalue!='')  $currentcolor =$colorvalue;
		}
		?><div class="swiper-slide">
			<article id="post-<?php the_ID();  ?>" <?php post_class( 'elementor-post' ); ?> style="background-color:<?php echo $currentcolor; ?>">
				<div class="elementor-post__content">
					<?php if( '' !== $settings['show_category'] ) { ?>
						<div class="elementor-post__cat-links"><?php
							$terms = get_the_terms( get_the_id(), 'ins-type' );
							if ($terms) {
								foreach($terms as $term) {
									echo $term->name;
									//var_dump($term);
								}
							}
						 ?></div>
					<?php } ?>

					<?php
						if( '' !== $settings['show_title'] ) {
							the_title( '<h3 class="elementor-post__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
						}
					?>

					<?php
						if( '' !== $settings['show_excerpt'] ) {
							add_filter( 'excerpt_more', [ $this, 'filter_excerpt_more' ], 20 );
							add_filter( 'excerpt_length', [ $this, 'filter_excerpt_length' ], 20 );

							?>
							<div class="elementor-post__excerpt">
								<?php the_excerpt(); ?>
							</div>
							<?php

							remove_filter( 'excerpt_length', [ $this, 'filter_excerpt_length' ], 20 );
							remove_filter( 'excerpt_more', [ $this, 'filter_excerpt_more' ], 20 );
						}
					?>

					<?php
						if( '' !== $settings['show_read_more'] ) {
							echo '<a class="elementor-post__read-more" href="' . get_the_permalink() . '">' . $settings['read_more_text'] . '</a>';
						}
					?>
				</div>
			</article>
			</div>
		<?php
	}

	protected function render() {

	$query = $this->query_posts();

	if ( $query->have_posts() ) {

		$this->render_loop_header();

			while ( $query->have_posts() ) {
				$query->the_post();

				$this->render_post();

			}

		$this->render_loop_footer();

	} else {
			// no posts found
	}

	wp_reset_postdata();
}


	protected function _content_template() {

	}

}
