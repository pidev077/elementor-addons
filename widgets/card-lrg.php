<?php
/**
* Element Card Lrg
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
// use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Card_Lrg extends Widget_Base {

    public function get_name() {
        return 'card-lrg';
    }

    public function get_title() {
        return __( 'Card Lrg', 'bearsthemes-addons' );
    }

    public function get_icon() {
        return 'fas fa-columns';
    }

    public function get_categories() {
        return [ 'bearsthemes-addons' ];
    }

    public function get_script_depends() {
        return [ 'elementor-addons-custom-frontend' ];
    }

    public function get_style_depends() {
        return [ 'elementor-addons-custom-frontend' ];
    }

    protected function register_content_section_controls() {
        $this->start_controls_section(
            'section_content_layout',[
                'label' => __( 'Content', 'bearsthemes-addons' ),
             ]
        );

            $this->add_control(
                'sub_heading_card_lrg',
                    [
                        'label' => __( 'Sub Heading', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'CONSUMERS', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );

            $this->add_control(
                'heading_card_lrg',
                    [
                        'label' => __( 'Heading', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Help in disasters', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );

            $this->add_control(
                'description_card_lrg',
                    [
                        'label' => __( 'Description', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem ', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );

        $this->end_controls_section();
    }


    protected function register_image_section_controls() {
        $this->start_controls_section(
            'section_image_layout',[
                'label' => __( 'Images', 'bearsthemes-addons' ),
             ]
        );

            $this->add_control(
                'image_card_lrg',
                [
                    'label' => __( 'Choose Image', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ]
                ]
            );

            $this->add_control(
                'image_animation_card_lrg',
                [
                    'label' => __( 'Animation', 'elementor' ),
                    'type' => Controls_Manager::HOVER_ANIMATION,
                ]
            );

        $this->end_controls_section();
    }

    protected function register_cta_section_controls() {
        $this->start_controls_section(
            'section_button_layout',[
                'label' => __( 'Button', 'bearsthemes-addons' ),
             ]
        );

            $this->add_control(
                'cta_name_card_lrg',
                    [
                        'label' => __( 'Button Name', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Lorem ipsum', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );

            $this->add_control(
                'cta_link_card_lrg',
                [
                    'label' => __( 'Button Link', 'elementor' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => 'http://your-link.com',
                    'default' => [
                        'url' => '!#',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    protected function register_style_title_section_controls() {
        $this->start_controls_section(
            'style_content_section',[
                'label' => __( 'Content', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

            $this->add_responsive_control(
                'content_padding_card_lrg',
                [
                    'label' => __( 'Padding', 'elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .bt-elements-elementor.card-lrg-elements' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // style sub heading
            $this->add_control(
                'style_sub_heading_card_lrg',
                [
                    'label' => __( 'Sub Heading', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sub_heading_card_lrg_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .sub-heading',
                ]
            );

            $this->add_control(
                'sub_heading_card_lrg_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .sub-heading' => 'color: {{VALUE}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'sub_heading_card_lrg_alignment',
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
                        '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .sub-heading' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'sub_heading_card_lrg_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 28,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .sub-heading' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );


            // style heading
            $this->add_control(
                'style_heading_card_lrg',
                [
                    'label' => __( 'Heading', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_card_lrg_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .heading',
                ]
            );

            $this->add_control(
                'heading_card_lrg_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .heading' => 'color: {{VALUE}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'heading_card_lrg_alignment',
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
                        '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .heading' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'heading_card_lrg_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 10,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // style description
            $this->add_control(
                'description_heading_card_lrg',
                [
                    'label' => __( 'Description', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_card_lrg_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .description',
                ]
            );

            $this->add_control(
                'description_card_lrg_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .description' => 'color: {{VALUE}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'description_card_lrg_alignment',
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
                        '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .description' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'description_card_lrg_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 100,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 800,
                        ],
                    ],
                    'selectors' => [
                        '{WRAPPER}} .card-lrg-elements .meta-card-lrg .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function register_style_image_section_controls() {
        $this->start_controls_section(
            'style_image_section',[
                'label' => __( 'Image', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

            $this->add_responsive_control(
                'width_image_card_lrg',
                [
                    'label' => __( 'Width', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .card-lrg-elements .card-lrg-content .thumbnail-card-lrg' => 'width: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .card-lrg-elements .card-lrg-content .meta-card-lrg' => 'width: calc( 100% - {{SIZE}}{{UNIT}} )',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_card_lrg_alignment',
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
                        '{{WRAPPER}} .card-lrg-elements .card-lrg-content .thumbnail-card-lrg' => 'text-align: {{VALUE}};',
                    ],
                ]
            );


        $this->end_controls_section();
    }

    protected function register_style_button_section_controls() {
        $this->start_controls_section(
            'style_button_section',[
                'label' => __( 'Button', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'cta_card_lrg_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .cta > a',
                ]
            );

            $this->start_controls_tabs('tabs_cta_style');
                $this->start_controls_tab(
                    'cta_tab_normal',
                    [
                        'label' => __( 'Normal', 'bearsthemes-addons' ),
                    ]
                );

                    $this->add_control(
                        'cta_normal_color',
                        [
                            'label' => __( 'Color', 'bearsthemes-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#2f2f39',
                            'selectors' => [
                                '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .cta > a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'cta_normal_background',
                        [
                            'label' => __( 'Background Color', 'bearsthemes-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => 'transparent',
                            'selectors' => [
                                '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .cta > a' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'cta_normal_border_radius',
                        [
                            'label' => __( 'Border Radius', 'elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .cta > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'cta_tab_hover',
                    [
                        'label' => __( 'Hover', 'bearsthemes-addons' ),
                    ]
                );


                    $this->add_control(
                        'cta_hover_color',
                        [
                            'label' => __( 'Color', 'bearsthemes-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#2f2f39',
                            'selectors' => [
                                '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .cta > a:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'cta_hover_background',
                        [
                            'label' => __( 'Background Color', 'bearsthemes-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => 'transparent',
                            'selectors' => [
                                '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .cta > a:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'cta_hover_border_radius',
                        [
                            'label' => __( 'Border Radius', 'elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .cta > a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );


                $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_responsive_control(
                'cta_padding',
                [
                    'label' => __( 'Padding', 'elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .cta > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cta_border_width',
                [
                    'label' => __( 'Border Width', 'elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .card-lrg-elements .meta-card-lrg .cta > a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'cta_card_lrg_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 800,
                        ],
                    ],
                    'selectors' => [
                        '{WRAPPER}} .card-lrg-elements .meta-card-lrg .cta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );



        $this->end_controls_section();
    }

    protected function _register_controls() {
        $this->register_content_section_controls();
        $this->register_style_title_section_controls();
        $this->register_style_button_section_controls();
        $this->register_image_section_controls();
        $this->register_cta_section_controls();
        $this->register_style_image_section_controls();
    }


    protected function render() {
        $settings   = $this->get_settings_for_display();
        $heading    = $settings['heading_card_lrg'];
        $subheading = $settings['sub_heading_card_lrg'];
        $description = $settings['description_card_lrg'];
        $content    = $settings['content_alert_banner'];
        $ctaName = $settings['cta_name_card_lrg'];
        $ctaLink = $settings['cta_link_card_lrg'];
        $images = $settings['image_card_lrg'];
        $animation = $settings['image_animation_card_lrg'];
        $classAnimation = $animation ? "elementor-animation-"."$animation" : "" ;

        // echo "<pre>";
        // echo print_r($settings);
        // echo "</pre>";
        ?>

        <div class="bt-elements-elementor card-lrg-elements">
            <div class="content-elements">
                <div class="card-lrg-content">
                    <div class="meta-card-lrg">
                        <?php if ($subheading): ?>
                            <p class="sub-heading"> <?php echo $subheading ?> </p>
                        <?php endif; ?>

                        <?php if ($heading): ?>
                            <h2 class="heading"> <?php echo $heading ?> </h2>
                        <?php endif; ?>

                        <?php if ($description): ?>
                            <p class="description">  <?php echo $description ?> </p>
                        <?php endif; ?>

                        <?php if ($ctaName): ?>
                            <div class="cta">
                                <?php if ($ctaLink['url']): ?>
                                    <a href="<?php echo $ctaLink['url'] ?>"> <?php echo $ctaName ?>  </a>
                                <?php else: ?>
                                    <span><?php echo $ctaName; ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="thumbnail-card-lrg">
                        <?php if ($images['url']): ?>
                            <img class="<?php echo $classAnimation ?>" src="<?php echo $images['url'] ?>" alt="images">
                        <?php endif; ?>
                    </div>

                </div>
            </div>

        </div>
        <?php
    }



    protected function _content_template() {

    }
}
