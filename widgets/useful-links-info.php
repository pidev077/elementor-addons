<?php
/**
* Element Subhead Bodycopy
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
// use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Useful_Links_Info extends Widget_Base {

    public function get_name() {
        return 'useful-links-info';
    }

    public function get_title() {
        return __( 'Useful Links Info', 'bearsthemes-addons' );
    }

    public function get_icon() {
        return 'fas fa-columns';
    }

    public function get_categories() {
        return [ 'bearsthemes-addons' ];
    }

    public function get_script_depends() {
        return [ 'elementor-addons' ];
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
                'title_useful_link_info',
                    [
                        'label' => __( 'Title', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Useful', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );

            $litsItems = new \Elementor\Repeater();
            $litsItems->add_control(
                'title',
                [
                    'label' => __( 'Title', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );
            $litsItems->add_control(
                'content',
                [
                    'label' => __( 'Content', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'items_useful_link_info',
                [
                    'label' => __( 'List Items', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $litsItems->get_controls(),
                    'default' => [
                        [
                            'title' => __( 'General enquiries', 'bearsthemes-addons' ),
                            'content' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'bearsthemes-addons' ),

                        ],
                        [
                            'title' => __( 'Mail', 'bearsthemes-addons' ),
                            'content' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'bearsthemes-addons' ),

                        ],
                        [
                            'title' => __( 'Office Location', 'bearsthemes-addons' ),
                            'content' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'bearsthemes-addons' ),

                        ],
                        [
                            'title' => __( 'ABN', 'bearsthemes-addons' ),
                            'content' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'bearsthemes-addons' ),

                        ],
                    ],
                    'title_field' => '{{{ title }}}',
                ]
            );

        $this->end_controls_section();
    }

    protected function register_style_general_section_controls() {
        $this->start_controls_section(
            'style_general_section',[
                'label' => __( 'General', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

            $this->add_control(
                'background_color_useful_link_info',
                [
                    'label' => __( 'Background Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f5f4f1',
                    'selectors' => [
                        '{{WRAPPER}} .useful-link-info-elements .content-elements' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'width_useful_link_info',
                [
                    'label' => __( 'Width', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'size' => 221,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 800,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .useful-link-info-elements .content-elements' => 'max-width: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'useful_link_info_padding',
                [
                    'label' => __( 'Padding', 'elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .useful-link-info-elements .content-elements' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    protected function register_style_title_section_controls() {
        $this->start_controls_section(
            'style_title_section',[
                'label' => __( 'Title', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );
            $this->add_control(
                'style_title_useful_link_info',
                [
                    'label' => __( 'Heading', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_useful_link_info_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .useful-link-info-elements .content-elements > .heading',
                ]
            );

            $this->add_control(
                'title_useful_link_info_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .useful-link-info-elements .content-elements > .heading' => 'color: {{VALUE}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'title_useful_link_info_alignment',
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
                        '{{WRAPPER}} .useful-link-info-elements .content-elements > .heading' => 'text-align: {{VALUE}};',
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
                'items_useful_link_info_spacing',
                [
                    'label' => __( 'Spacing Items', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 23,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .useful-link-info-elements .list-items .item' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'title_content_useful_link_info_heading',
                [
                    'label' => __( 'Title', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_content_useful_link_info_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .useful-link-info-elements .list-items .item .heading',
                ]
            );

            $this->add_control(
                'title_content_useful_link_info_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .useful-link-info-elements .list-items .item .heading' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_content_useful_link_info_alignment',
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
                        '{{WRAPPER}} .useful-link-info-elements .list-items .item .heading' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_content_useful_link_info_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 5,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .useful-link-info-elements .list-items .item .heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // style content
            $this->add_control(
                'content_useful_link_info_heading',
                [
                    'label' => __( 'Content', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_useful_link_info_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .useful-link-info-elements .list-items .item .content',
                ]
            );

            $this->add_control(
                'content_useful_link_info_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .useful-link-info-elements .list-items .item .content' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_useful_link_info_alignment',
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
                        '{{WRAPPER}} .useful-link-info-elements .list-items .item .content' => 'text-align: {{VALUE}};',
                    ],
                ]
            );


        $this->end_controls_section();
    }

    protected function _register_controls() {
        $this->register_content_section_controls();
        // $this->register_style_title_section_controls_fff();
        $this->register_style_general_section_controls();
        $this->register_style_title_section_controls();
        $this->register_style_content_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading  = $settings['title_useful_link_info'];
        $items = $settings['items_useful_link_info']
        ?>
        <div class="bt-elements-elementor useful-link-info-elements">
            <div class="content-elements">
                <?php if ($heading): ?>
                    <h2 class="heading"> <?php echo $heading ?> </h2>
                <?php endif; ?>
                <?php if ($items): ?>
                    <div class="list-items">
                        <?php foreach ($items as $key => $item): ?>
                            <div class="item">
                                <div class="_content">
                                    <?php if ($item['title']): ?>
                                        <h6 class="heading"> <?php echo $item['title'] ?> </h6>
                                    <?php endif; ?>
                                    <?php if ($item['content']): ?>
                                        <div class="content"> <?php echo $item['content']; ?> </div>
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
