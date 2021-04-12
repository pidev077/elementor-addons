<?php
/**
* Element Subhead Bodycopy
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Sidebar extends Widget_Base {

    public function get_name() {
        return 'sidebar';
    }

    public function get_title() {
        return __( 'Sidebar Widgets', 'bearsthemes-addons' );
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

    protected function register_sidebar_header_section_controls() {
        $this->start_controls_section(
            'section_sidebar_header_layout',[
                'label' => __( 'Sidebar Header', 'bearsthemes-addons' ),
             ]
        );

            $this->add_control(
                'heading_sidebar_widget',
                    [
                        'label' => __( 'Title', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'This is the Title', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );


        $this->end_controls_section();
    }

    protected function register_sidebar_main_section_controls() {
        $this->start_controls_section(
            'section_sidebar_main_layout',[
                'label' => __( 'Sidebar Main', 'bearsthemes-addons' ),
             ]
        );


        $itemsMain = new \Elementor\Repeater();
        $itemsMain->add_control(
            'name',
            [
                'label' => __( 'Name', 'bearsthemes-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $itemsMain->add_control(
            'link',
            [
                'label' => __( 'Link', 'bearsthemes-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items_sidebar_main',
            [
                'label' => __( 'List Items', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $itemsMain->get_controls(),
                'default' => [
                    [
                        'name' => __( 'Lorem ipsum', 'bearsthemes-addons' ),
                        'link' => __( '#!', 'bearsthemes-addons' ),
                    ],
                    [
                        'name' => __( 'Ducimus qui blanditlls', 'bearsthemes-addons' ),
                        'link' => __( '#!', 'bearsthemes-addons' ),
                    ],
                    [
                        'name' => __( 'inventore veritatis', 'bearsthemes-addons' ),
                        'link' => __( '#!', 'bearsthemes-addons' ),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
    }


    protected function register_sidebar_pdf_section_controls() {
        $this->start_controls_section(
            'section_sidebar_pdf_layout',[
                'label' => __( 'Sidebar PDF', 'bearsthemes-addons' ),
             ]
        );

        $itemsPDF = new \Elementor\Repeater();
        $itemsPDF->add_control(
            'name',
            [
                'label' => __( 'Name', 'bearsthemes-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $itemsPDF->add_control(
            'link',
            [
                'label' => __( 'Link', 'bearsthemes-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items_sidebar_pdf',
            [
                'label' => __( 'List Items', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $itemsPDF->get_controls(),
                'default' => [
                    [
                        'name' => __( 'Lorem ipsum', 'bearsthemes-addons' ),
                        'link' => __( '#!', 'bearsthemes-addons' ),
                    ],
                    [
                        'name' => __( 'Ducimus qui blanditlls', 'bearsthemes-addons' ),
                        'link' => __( '#!', 'bearsthemes-addons' ),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_sidebar_footer_section_controls() {
        $this->start_controls_section(
            'section_sidebar_footer_layout',[
                'label' => __( 'Sidebar Footer', 'bearsthemes-addons' ),
             ]
        );

        $itemsFooter = new \Elementor\Repeater();
        $itemsFooter->add_control(
            'name',
            [
                'label' => __( 'Name', 'bearsthemes-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $itemsFooter->add_control(
            'link',
            [
                'label' => __( 'Link', 'bearsthemes-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items_sidebar_footer',
            [
                'label' => __( 'List Items', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $itemsFooter->get_controls(),
                'default' => [
                    [
                        'name' => __( 'Lorem ipsum', 'bearsthemes-addons' ),
                        'link' => __( '#!', 'bearsthemes-addons' ),
                    ],
                    [
                        'name' => __( 'Ducimus qui blanditlls', 'bearsthemes-addons' ),
                        'link' => __( '#!', 'bearsthemes-addons' ),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_general_controls() {
        $this->start_controls_section(
            'style_general_section',[
                'label' => __( 'General', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );


            $this->add_control(
                'background_sidebar_color',
                [
                    'label' => __( 'Background Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f5f4f1',
                    'selectors' => [
                        '{{WRAPPER}} .sidebar-widget-elements .content-elements' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'width_sidebar_widgets',
                [
                    'label' => __( 'Width Sidebar', 'bearsthemes-addons' ),
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
                        '{{WRAPPER}} .sidebar-widget-elements .content-elements' => 'max-width: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );


            $this->add_responsive_control(
                'sidebar_widgets_padding',
                [
                    'label' => __( 'Padding', 'elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .sidebar-widget-elements .content-elements' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'style_title_sidebar_widget',
                    [
                    'label' => __( 'Title', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    ]
            );

            $this->add_group_control(
    			Group_Control_Typography::get_type(),
    			[
    				'name' => 'title_sidebar_typography',
    				'default' => '',
    				'selector' => '{{WRAPPER}} .sidebar-widget-elements .content-elements > .heading',
    			]
    		);

            $this->add_control(
                'title_sidebar_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .sidebar-widget-elements .content-elements > .heading' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_sidebar_alignment',
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
                        '{{WRAPPER}} .sidebar-widget-elements .content-elements > .heading' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_sidebar_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 14,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}}  .sidebar-widget-elements .content-elements > .heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


            // style text
            $this->add_control(
                'style_content_sidebar_widget',
                    [
                    'label' => __( 'Content', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    ]
            );

            $this->add_group_control(
    			Group_Control_Typography::get_type(),
    			[
    				'name' => 'content_sidebar_typography',
    				'default' => '',
    				'selector' => '{{WRAPPER}} .sidebar-widget-elements .content-elements > div ._content .item a',
    			]
    		);

            $this->add_control(
                'content_sidebar_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .sidebar-widget-elements .content-elements > div ._content .item a' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_sidebar_alignment',
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
                        '{{WRAPPER}} .sidebar-widget-elements .content-elements > div ._content' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_sidebar_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 26,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}}  .sidebar-widget-elements .content-elements > div:not(:last-child)' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}}  .sidebar-widget-elements .content-elements > div' => 'padding-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // style text
            $this->add_control(
                'spacer_sidebar_widget',
                    [
                    'label' => __( 'Spacer', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    ]
            );

            $this->add_responsive_control(
                'spacer_sidebar_widget_width',
                [
                    'label' => __( 'Width', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 1,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}}  .sidebar-widget-elements .content-elements > div' => 'border-top-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'spacer_sidebar_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ccc7ba',
                    'selectors' => [
                        '{{WRAPPER}} .sidebar-widget-elements .content-elements > div' => 'border-top-color: {{VALUE}};',
                    ],
                ]
            );


        $this->end_controls_section();
    }

    protected function _register_controls() {
        $this->register_sidebar_header_section_controls();
        $this->register_sidebar_main_section_controls();
        $this->register_sidebar_pdf_section_controls();
        $this->register_sidebar_footer_section_controls();
        $this->register_style_general_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading  = $settings['heading_sidebar_widget'];
        $items_main = $settings['items_sidebar_main'];
        $items_pdf = $settings['items_sidebar_pdf'];
        $items_footer = $settings['items_sidebar_footer'];

        ?>
        <div class="bt-elements-elementor sidebar-widget-elements">
            <div class="content-elements">
                <?php if ($heading): ?>
                    <h2 class="heading"> <?php echo $heading ?> </h2>
                <?php endif; ?>
                <?php if ($items_main): ?>
                    <div class="sidebar-main">
                        <div class="_content">
                            <?php $this->loop_items($items_main); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($items_pdf): ?>
                    <div class="sidebar-pdf">
                        <div class="_content">
                            <?php foreach ($items_pdf as $key => $item) { ?>
                                <div class="item">
                                    <a href="<?php echo $item['link'] ?>" target="_blank"> <?php echo $item['name'] ?>  </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($items_footer): ?>
                    <div class="sidebar-footer">
                        <div class="_content">
                            <?php $this->loop_items($items_footer); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    protected function loop_items($items){
        foreach ($items as $key => $item) { ?>
            <div class="item">
                <a href="<?php echo $item['link'] ?>"> <?php echo $item['name'] ?>  </a>
            </div>
        <?php }
    }

    protected function _content_template() {

    }
}
