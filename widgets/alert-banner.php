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

class Alert_Banner extends Widget_Base {

    public function get_name() {
        return 'alert-banner';
    }

    public function get_title() {
        return __( 'Alert Banner', 'bearsthemes-addons' );
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
                'heading_alert_banner',
                    [
                        'label' => __( 'Heading', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Current alerts lorem ipsum', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );
            $this->add_control(
                'content_alert_banner',
                    [
                        'label' => __( 'Content', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::WYSIWYG,
                        'default' => __( 'Lorem ipsum dolor sit amet, quis nostrud exercitation ullamco Bushfires, Queensland', 'bearsthemes-addons' ),
                        'label_block' => true,
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
                    'name' => 'heading_alert_banner_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .alert-banner-elements .heading',
                ]
            );

            $this->add_control(
                'heading_alert_banner_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .alert-banner-elements .heading' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .alert-banner-elements .heading::before' => 'color: {{VALUE}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'heading_alert_banner_alignment',
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
                        '{{WRAPPER}} .alert-banner-elements .heading' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'heading_alert_banner_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 8,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .alert-banner-elements .heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_alert_banner_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .alert-banner-elements .content',
                ]
            );

            $this->add_control(
                'content_alert_banner_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .alert-banner-elements .content' => 'color: {{VALUE}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'content_alert_banner_alignment',
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
                        '{{WRAPPER}} .alert-banner-elements .content' => 'text-align: {{VALUE}};',
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

        $this->add_responsive_control(
            'button_font_size_alert_banner',
            [
                'label' => __( 'Spacing', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .alert-banner-elements > .cta-close i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_font_size_alert_color',
            [
                'label' => __( 'Color', 'bearsthemes-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#2f2f39',
                'selectors' => [
                    '{{WRAPPER}} .alert-banner-elements > .cta-close i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function _register_controls() {
        $this->register_content_section_controls();
        $this->register_style_title_section_controls();
        $this->register_style_content_section_controls();
        $this->register_style_button_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading  = $settings['heading_alert_banner'];
        $content  = $settings['content_alert_banner'];

        // echo "<pre>";
        // echo print_r($settings);
        // echo "</pre>";
        ?>

        <div class="bt-elements-elementor alert-banner-elements">
            <div class="content-elements">
                <?php if ($heading): ?>
                    <h2 class="heading"> <?php echo $heading ?> </h2>
                <?php endif; ?>
                <?php if ($content): ?>
                    <div class="content"> <?php echo $content ?>  </div>
                <?php endif; ?>
            </div>
            <div class="cta-close"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
        <?php
    }



    protected function _content_template() {

    }
}
