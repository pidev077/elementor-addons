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

        $this->add_control(
            'hidden_sidebar_main',
            [
                'label' => __( 'Show', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .sidebar-widget-elements .content-elements > div.sidebar-main' => 'display:none;',
                ],
            ]
        );


        $this->add_control(
			'show_icon_sidebar_main',
			[
				'label' => __( 'Show Icon', 'elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'YES', 'elementor-addons' ),
				'label_off' => __( 'NO', 'elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
            'icon_sidebar_main',[
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'default' => 'fa fa-file-pdf-o',
                'condition' => [
                    'show_icon_sidebar_main' => 'yes',
                ],
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
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'default' => [
                    'url' => '#!',
                ],
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

        $this->add_control(
            'hidden_sidebar_pdf',
            [
                'label' => __( 'Show', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .sidebar-widget-elements .content-elements > div.sidebar-pdf' => 'display:none;',
                ],
            ]
        );

        $this->add_control(
            'show_icon_sidebar_pdf',
            [
                'label' => __( 'Show Icon', 'elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'YES', 'elementor-addons' ),
                'label_off' => __( 'NO', 'elementor-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'icon_sidebar_pdf',[
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'default' => 'fa fa-file-pdf-o',
                'condition' => [
                    'show_icon_sidebar_pdf' => 'yes',
                ],
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
              'file_link',
              [
                'label' => esc_html__( 'Select File', 'bearsthemes-addons' ),
                'type'	=> 'file-select',
                'placeholder' => esc_html__( 'URL to File', 'bearsthemes-addons' ),
                'description' => esc_html__( 'Select file from media library or upload', 'bearsthemes-addons' ),
              ]
          );

        $itemsPDF->add_control(
      			'link_target',
      			[
      				'label' => esc_html__( 'Link Target', 'bearsthemes-addons' ),
      				'type' => \Elementor\Controls_Manager::SELECT,
      				'options' => [
      					'_parent' => esc_html__( 'Same Tab', 'bearsthemes-addons' ),
      					'_blank' => esc_html__( 'New Tab', 'bearsthemes-addons' ),
      				],
      				'default' => '_parent',
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
                    ],
                    [
                        'name' => __( 'Ducimus qui blanditlls', 'bearsthemes-addons' ),
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

        $this->add_control(
            'hidden_sidebar_footer',
            [
                'label' => __( 'Show', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .sidebar-widget-elements .content-elements > div.sidebar-footer' => 'display:none;',
                ],
            ]
        );

        $this->add_control(
            'show_icon_sidebar_footer',
            [
                'label' => __( 'Show Icon', 'elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'YES', 'elementor-addons' ),
                'label_off' => __( 'NO', 'elementor-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'icon_sidebar_footer',[
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'default' => 'fa fa-file-pdf-o',
                'condition' => [
                    'show_icon_sidebar_footer' => 'yes',
                ],
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
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'default' => [
                    'url' => '#!',
                ],
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

    protected function register_style_details_controls() {
        $this->start_controls_section(
            'style_details_section',[
                'label' => __( 'Details', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

            // style sidebar main
            $this->add_control(
                'sidebar_main_heading',
                    [
                    'label' => __( 'Sidebar Main', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    ]
            );

            $this->add_responsive_control(
                'font_size_icon_sidebar_main',
                [
                    'label' => __( 'Font Size Icon', 'elementor' ),
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
                        '{{WRAPPER}}  .sidebar-widget-elements .content-elements .sidebar-main i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'Spacing_icon_sidebar_main',
                [
                    'label' => __( 'Spacing Icon', 'elementor' ),
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
                        '{{WRAPPER}}  .sidebar-widget-elements .content-elements .sidebar-main i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_sidebar_main_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#C09A37',
                    'selectors' => [
                        '{{WRAPPER}} .sidebar-widget-elements .content-elements .sidebar-main i' => 'color: {{VALUE}};',
                    ],
                ]
            );


            // style sidebar pdf
            $this->add_control(
                'sidebar_pdf_heading',
                    [
                    'label' => __( 'Sidebar PDF', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    ]
            );

            $this->add_responsive_control(
                'font_size_icon_sidebar_pdf',
                [
                    'label' => __( 'Font Size Icon', 'elementor' ),
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
                        '{{WRAPPER}}  .sidebar-widget-elements .content-elements .sidebar-pdf i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'Spacing_icon_sidebar_pdf',
                [
                    'label' => __( 'Spacing Icon', 'elementor' ),
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
                        '{{WRAPPER}}  .sidebar-widget-elements .content-elements .sidebar-pdf i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_sidebar_pdf_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#C09A37',
                    'selectors' => [
                        '{{WRAPPER}} .sidebar-widget-elements .content-elements .sidebar-pdf i' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // style sidebar footer
            $this->add_control(
                'sidebar_footer_heading',
                    [
                    'label' => __( 'Sidebar Footer', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    ]
            );

            $this->add_responsive_control(
                'font_size_icon_sidebar_footer',
                [
                    'label' => __( 'Font Size Icon', 'elementor' ),
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
                        '{{WRAPPER}}  .sidebar-widget-elements .content-elements .sidebar-footer i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'Spacing_icon_sidebar_ft',
                [
                    'label' => __( 'Spacing Icon', 'elementor' ),
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
                        '{{WRAPPER}}  .sidebar-widget-elements .content-elements .sidebar-footer i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_sidebar_ft_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#C09A37',
                    'selectors' => [
                        '{{WRAPPER}} .sidebar-widget-elements .content-elements .sidebar-footer i' => 'color: {{VALUE}};',
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
        $this->register_style_details_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading  = $settings['heading_sidebar_widget'];
        $items_main = $settings['items_sidebar_main'];
        $items_pdf = $settings['items_sidebar_pdf'];
        $items_footer = $settings['items_sidebar_footer'];
        $icon_main = $settings['icon_sidebar_main'];
        $icon_pdf = $settings['icon_sidebar_pdf'];
        $icon_footer = $settings['icon_sidebar_footer'];



        ?>
        <div class="bt-elements-elementor sidebar-widget-elements">
            <div class="content-elements">
                <?php if ($heading): ?>
                    <h2 class="heading"> <?php echo $heading ?> </h2>
                <?php endif; ?>
                <?php if ($items_main): ?>
                    <div class="sidebar-main">
                        <div class="_content">

                            <?php foreach ($items_main as $key => $item) { ?>
                                <?php if ($item['name']): ?>
                                    <div class="item">
                                        <a href="<?php echo $item['link']['url'] ?>" target="<?php echo $item['link']['is_external'] ? '_blank' :  '_self' ?>">
                                            <?php if ($icon_main): ?>
                                                    <i class="<?php echo $icon_main ?>"></i>
                                            <?php endif; ?>
                                            <span> <?php echo $item['name'] ?> </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php } ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($items_pdf): ?>
                    <div class="sidebar-pdf">
                        <div class="_content">

                            <?php foreach ($items_pdf as $key => $item) { ?>
                                <?php if ($item['name']): ?>
                                    <div class="item">
                                        <a href="<?php echo $item['file_link'] ?>" target="<?php echo $item['link_target'] ?>">
                                            <?php if ($icon_pdf): ?>
                                                    <i class="<?php echo $icon_pdf ?>"></i>
                                            <?php endif; ?>
                                            <span> <?php echo $item['name'] ?> </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php } ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($items_footer): ?>
                    <div class="sidebar-footer">
                        <div class="_content">

                            <?php foreach ($items_footer as $key => $item) { ?>
                                <?php if ($item['name']): ?>
                                    <div class="item">
                                        <a href="<?php echo $item['link']['url'] ?>" target="<?php echo $item['link']['is_external'] ? '_blank' :  '_self' ?>">
                                            <?php if ($icon_footer): ?>
                                                    <i class="<?php echo $icon_footer ?>"></i>
                                            <?php endif; ?>
                                            <span> <?php echo $item['name'] ?> </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php } ?>


                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    protected function loop_items($items){
        foreach ($items as $key => $item) { ?>
            <?php if ($item['name']): ?>
                <div class="item">
                    <a href="<?php echo $item['link']['url'] ?>" target="<?php echo $item['link']['is_external'] ? '_blank' :  '_self' ?>"> <?php echo $item['name'] ?>  </a>
                </div>
            <?php endif; ?>
        <?php }
    }

    protected function _content_template() {

    }
}
