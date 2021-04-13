<?php
/**
* Element Subhead Bodycopy
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Subhead_Bodycopy extends Widget_Base {

    public function get_name() {
        return 'subhead-bodycopy';
    }

    public function get_title() {
        return __( 'Subhead Bodycopy', 'bearsthemes-addons' );
    }

    public function get_icon() {
        return 'far fa-edit';
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
                'heading_subhead_bodycopy',
                    [
                        'label' => __( 'Heading', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'This is the heading', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );
            $this->add_control(
                'html_heading_subhead_bodycopy',
                [
                    'label' => __( 'Select HTML Heading', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'h1' => __( 'H1', 'bearsthemes-addons' ),
                        'h2' => __( 'H2', 'bearsthemes-addons' ),
                        'h3' => __( 'H3', 'bearsthemes-addons' ),
                        'h4' => __( 'H4', 'bearsthemes-addons' ),
                        'h5' => __( 'H5', 'bearsthemes-addons' ),
                        'h6' => __( 'H6', 'bearsthemes-addons' ),
                    ],
                    'default' => 'h2',
                ]
            );

            $this->add_control(
                'content_title_subhead_bodycopy',
                    [
                    'label' => __( 'Content', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    ]
            );
            $this->add_control(
                'content_subhead_bodycopy',
                    [
                        'label' => __( 'Content', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::WYSIWYG,
                        'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bearsthemes-addons' ),
                        'separator' => 'none',
                        'rows' => 10,
                        'show_label' => false,
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

            // style heading in elements
            $this->add_control(
                'style_heading_subhead_bodycopy',
                    [
                    'label' => __( 'Heading', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    ]
            );


            $this->add_group_control(
    			Group_Control_Typography::get_type(),
    			[
    				'name' => 'heading_typography',
    				'default' => '',
    				'selector' => '{{WRAPPER}} .subhead-bodycopy-elements .heading',
    			]
    		);



            $this->add_control(
    			'heading_color',
    			[
    				'label' => __( 'Color', 'bearsthemes-addons' ),
    				'type' => Controls_Manager::COLOR,
                    'default' => '#4a4a4a',
                    'selectors' => [
    					'{{WRAPPER}} .subhead-bodycopy-elements .heading' => 'color: {{VALUE}};',
    				],
    			]
    		);

            $this->add_responsive_control(
                'heading_alignment',
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
    					'{{WRAPPER}} .subhead-bodycopy-elements .heading' => 'text-align: {{VALUE}};',
    				],
                ]
            );

            $this->add_responsive_control(
                'spacing_heading',
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
                        '{{WRAPPER}} .subhead-bodycopy-elements .heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


            // style content in elements
            $this->add_control(
                'style_content_subhead_bodycopy',
                    [
                    'label' => __( 'Content', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    ]
            );



            $this->add_group_control(
    			Group_Control_Typography::get_type(),
    			[
    				'name' => 'content_typography',
    				'default' => '',
    				'selector' => '{{WRAPPER}} .subhead-bodycopy-elements .content',
    			]
    		);

            $this->add_control(
                'content_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
    					'{{WRAPPER}} .subhead-bodycopy-elements .content' => 'color: {{VALUE}};',
    				],
                ]
            );

            $this->add_responsive_control(
                'content_alignment',
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
    					'{{WRAPPER}} .subhead-bodycopy-elements .content' => 'text-align: {{VALUE}};',
    				],
                ]
            );


        $this->end_controls_section();
    }



    protected function _register_controls() {
        $this->register_content_section_controls();
        $this->register_style_content_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading  = $settings['heading_subhead_bodycopy'];
        $heading_html_tag = $settings['html_heading_subhead_bodycopy'];
        $content = $settings['content_subhead_bodycopy'];
        ?>
        <div class="bt-elements-elementor subhead-bodycopy-elements">
            <div class="content-elements">
                <?php if ($heading): ?>
                    <?php
                    switch ($heading_html_tag) {
                        case "h2":
                            ?> <h2 class="heading"> <?php echo $heading ?> </h2> <?php
                        break;
                        case "h3":
                            ?> <h3 class="heading"> <?php echo $heading ?> </h3> <?php
                        break;
                        case "h4":
                            ?> <h4 class="heading"> <?php echo $heading ?> </h4> <?php
                        break;
                        case "h5":
                            ?> <h5 class="heading"> <?php echo $heading ?> </h5> <?php
                        break;
                        case "h6":
                            ?> <h6 class="heading"> <?php echo $heading ?> </h6> <?php
                        break;
                        default:
                            ?> <h1 class="heading"> <?php echo $heading ?> </h1> <?php
                        break;
                    }
                    ?>
                <?php endif; ?>
                <?php if ($content): ?>
                    <div class="content"> <?php echo $content ?> </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    protected function _content_template() {

    }
}
