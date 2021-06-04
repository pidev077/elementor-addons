<?php
/**
* Element Secondary CTAs
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
// use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Secondary_CTAs extends Widget_Base {

    public function get_name() {
        return 'secondary-ctas';
    }

    public function get_title() {
        return __( 'Secondary CTAs', 'bearsthemes-addons' );
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
                'heading_secondary_ctas',
                    [
                        'label' => __( 'Heading', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'More quick links', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );

            $litsItems = new \Elementor\Repeater();
            $litsItems->add_control(
                'image',
                [
                    'label' => __( 'Choose Image', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ]
                ]
            );
            $litsItems->add_control(
                'title',
                [
                    'label' => __( 'Title', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );
            $litsItems->add_control(
    			'link',
    			[
    				'label' => __( 'Link', 'elementor' ),
    				'type' => Controls_Manager::URL,
    				'placeholder' => 'http://your-link.com',
    				'default' => [
    					'url' => '',
    				],
    				'separator' => 'before',
    			]
    		);
            $this->add_control(
                'items_secondary_ctas',
                [
                    'label' => __( 'List Items', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $litsItems->get_controls(),
                    'default' => [
                        [
                            'title' => __( 'Help in disasters', 'bearsthemes-addons' ),
                            'link' => __( '#!', 'bearsthemes-addons' ),
                            'image' => __( '', 'bearsthemes-addons' ),
                        ],
                        [
                            'title' => __( 'Impact of COVID', 'bearsthemes-addons' ),
                            'link' => __( '#!', 'bearsthemes-addons' ),
                            'image' => __( ' ', 'bearsthemes-addons' ),
                        ],
                        [
                            'title' => __( 'Code of Practice', 'bearsthemes-addons' ),
                            'link' => __( '#!', 'bearsthemes-addons' ),
                            'image' => __( ' ', 'bearsthemes-addons' ),
                        ],
                        [
                            'title' => __( 'Industry data & stats', 'bearsthemes-addons' ),
                            'link' => __( '#!', 'bearsthemes-addons' ),
                            'image' => __( ' ', 'bearsthemes-addons' ),
                        ],
                    ],
                    'title_field' => '{{{ title }}}',
                ]
            );

        $this->end_controls_section();
    }



    protected function register_style_title_section_controls() {
        $this->start_controls_section(
            'style_heading_section',[
                'label' => __( 'Heading', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_secondary_ctas_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .secondary-ctas-elements > .content-elements > .heading',
                ]
            );

            $this->add_control(
                'heading_secondary_ctas_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .secondary-ctas-elements > .content-elements > .heading' => 'color: {{VALUE}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'heading_secondary_ctas_alignment',
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
                        '{{WRAPPER}} .secondary-ctas-elements > .content-elements > .heading' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'heading_secondary_ctas_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 30,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .secondary-ctas-elements > .content-elements > .heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


        $this->end_controls_section();

    }

    protected function register_style_content_section_controls() {
        $this->start_controls_section(
            'style_content_section',[
                'label' => __( 'Content', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

        $this->add_responsive_control(
            'items_secondary_ctas_Gap',
            [
                'label' => __( 'Spacing', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .secondary-ctas-elements .list-items .item' => 'margin-bottom: calc({{SIZE}}{{UNIT}} * 2) ; padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .secondary-ctas-elements .list-items' => 'margin-right: -{{SIZE}}{{UNIT}}; margin-left: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

            // style images items secondary ctas
            $this->add_control(
                'image_secondary_ctas_heading',
                [
                    'label' => __( 'Image', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'image_secondary_ctas_width',
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
                        '{{WRAPPER}} .secondary-ctas-elements .list-items .item .thumbnail img' => 'height: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_secondary_ctas_max_width',
                [
                    'label' => __( 'Max Width', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .secondary-ctas-elements .list-items .item .thumbnail img' => 'max-height: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_secondary_ctas_alignment',
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
                        '{{WRAPPER}} .secondary-ctas-elements .list-items .item .thumbnail' => 'text-align: {{VALUE}};',
                    ],
                ]
            );


            $this->add_control(
                'image_animation',
                [
                    'label' => __( 'Animation', 'elementor' ),
                    'type' => Controls_Manager::HOVER_ANIMATION,
                ]
            );


            // style title items secondary ctas
            $this->add_control(
                'title_items_secondary_ctas_heading',
                [
                    'label' => __( 'Title', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_items_secondary_ctas_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .secondary-ctas-elements .list-items .item .title',
                ]
            );

            $this->add_control(
                'title_items_secondary_ctas_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .secondary-ctas-elements .list-items .item .title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_items_secondary_ctas_alignment',
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
                        '{{WRAPPER}} .secondary-ctas-elements .list-items .item .title' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_items_secondary_ctas_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 13,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .secondary-ctas-elements .list-items .item .title' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    protected function _register_controls() {
        $this->register_content_section_controls();
        $this->register_style_title_section_controls();
        $this->register_style_content_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading  = $settings['heading_secondary_ctas'];
        $items = $settings['items_secondary_ctas'];
        $animation = $settings['image_animation'];
        $classAnimation = $animation ? "elementor-animation-"."$animation" : "" ;
        ?>
        <div class="bt-elements-elementor secondary-ctas-elements">
            <div class="content-elements">
                <?php if ($heading): ?>
                    <h2 class="heading"> <?php echo $heading ?> </h2>
                <?php endif; ?>
                <?php if ($items): ?>
                    <div class="list-items">
                        <?php foreach ($items as $key => $item):
                            $images = $item['image'];
                            $url = $item['link']; ?>

                            <div class="item secondary-ctas-<?php echo $key ?>">
                                <div class="_content">

                                    <?php if ($url['url']): ?>
                                        <a href="<?php echo $url['url'] ?>">
                                            <?php if ($images['url']): ?>
                                                <div class="thumbnail secondary-ctas-thumbnail-<?php echo $key ?>">
                                                    <img src="<?php echo $images['url'] ?>" alt="image" class="<?php echo $classAnimation ?>">
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($item['title']): ?>
                                                <h3 class="title">
                                                    <?php echo $item['title'];  ?>
                                                </h3>
                                            <?php endif; ?>
                                        </a>
                                    <?php else: ?>
                                        <?php if ($images['url']): ?>
                                            <div class="thumbnail secondary-ctas-thumbnail-<?php echo $key ?>">
                                                <img src="<?php echo $images['url'] ?>" alt="image" class="<?php echo $classAnimation ?>">
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($item['title']): ?>
                                            <h3 class="title">
                                                <?php echo $item['title'];  ?>
                                            </h3>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }



    protected function _content_template() {

    }
}
