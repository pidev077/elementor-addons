<?php
/**
* Element Heading Media Bodycopy
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Promo extends Widget_Base {

    public function get_name() {
        return 'be-promo';
    }

    public function get_title() {
        return __( 'Promo', 'bearsthemes-addons' );
    }

    public function get_icon() {
        return 'eicon-hotspot';
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

    protected function register_content_section_controls() {

        $this->start_controls_section(
            'section_content_layout',[
                'label' => __( 'Content', 'bearsthemes-addons' ),
             ]
        );
            $this->add_control(
                'heading_promo',
                    [
                        'label' => __( 'Heading', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Find an insurer', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );

            $this->add_control(
                'content_promo',
                    [
                        'label' => __( 'Content', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::WYSIWYG,
                        'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', 'bearsthemes-addons' ),
                        'separator' => 'none',
                        'rows' => 10,
                        'show_label' => false,
                    ]
            );
            $this->add_control(
              'promo_button',
              [
                'label' => __( 'Button', 'bearsthemes-addons' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Find an insurer', 'bearsthemes-addons' ),
              ]
            );
            $this->add_control(
              'promo_button_url', [
                'label' => __( 'Button Link', 'bearsthemes-addons' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '#',
              ]
            );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_image_layout',[
                'label' => __( 'Images', 'bearsthemes-addons' ),
             ]
        );

            $this->add_control(
                'image_promo',
                [
                    'label' => __( 'Choose Image', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ]
                ]
            );


        $this->end_controls_section();
    }


    protected function register_style_image_controls() {
        $this->start_controls_section(
            'style_image_section',[
                'label' => __( 'Image', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

            $this->add_responsive_control(
    			'width_image_subhead_bodycopy',
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
    					'{{WRAPPER}} .heading-media-bodycopy-elements .thumbnail img' => 'width: {{SIZE}}{{UNIT}}',
    				],
    			]
    		);

            $this->add_responsive_control(
    			'max-width_image_subhead_bodycopy',
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
    					'{{WRAPPER}} .heading-media-bodycopy-elements .thumbnail img' => 'max-width: {{SIZE}}{{UNIT}}',
    				],
    			]
    		);

            $this->add_responsive_control(
    			'border_radius_image_subhead_bodycopy',
    			[
    				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
    				'type' => Controls_Manager::SLIDER,
    				'size_units' => [ 'px', '%' ],
    				'range' => [
    					'px' => [
    						'min' => 0,
    						'max' => 100,
    					],
    				],
    				'selectors' => [
    					'{{WRAPPER}} .heading-media-bodycopy-elements .thumbnail img' => 'border-radius: {{SIZE}}{{UNIT}}',
    				],
    			]
    		);



            $this->add_responsive_control(
                'image_alignment',
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
    					'{{WRAPPER}} .heading-media-bodycopy-elements .thumbnail' => 'text-align: {{VALUE}};',
    				],
                ]
            );


            $this->add_responsive_control(
                'spacing_image',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 25,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .heading-media-bodycopy-elements .thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
    				'selector' => '{{WRAPPER}} .heading-media-bodycopy-elements .heading',
    			]
    		);

            $this->add_control(
    			'heading_color',
    			[
    				'label' => __( 'Color', 'bearsthemes-addons' ),
    				'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
    					'{{WRAPPER}} .heading-media-bodycopy-elements .heading' => 'color: {{VALUE}};',
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
    					'{{WRAPPER}} .heading-media-bodycopy-elements .heading' => 'text-align: {{VALUE}};',
    				],
                ]
            );

            $this->add_responsive_control(
                'spacing_heading',
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
                        '{{WRAPPER}} .heading-media-bodycopy-elements .heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                    'selectors' => [
    					'{{WRAPPER}} .heading-media-bodycopy-elements .content',
    				],
                ]
            );

            $this->add_control(
                'content_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
    					'{{WRAPPER}} .heading-media-bodycopy-elements .content' => 'color: {{VALUE}};',
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
    					'{{WRAPPER}} .heading-media-bodycopy-elements .content' => 'text-align: {{VALUE}};',
    				],
                ]
            );


        $this->end_controls_section();
    }



    protected function _register_controls() {
        $this->register_content_section_controls();
        //$this->register_style_image_controls();
        //$this->register_style_content_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading  = $settings['heading_promo'];
        $content = $settings['content_promo'];
        $images = $settings['image_promo'];
        ?>
        <div class="bt-elements-elementor bt-promo">
            <div class="content-promo">
                <?php if ($heading): ?>
                    <h2 class="bt-heading"> <?php echo $heading ?> </h2>
                <?php endif; ?>
                <?php if ($content): ?>
                    <div class="bt-des"> <?php echo $content ?> </div>
                <?php endif; ?>
                <a class="bt-button" href="<?php echo $settings['promo_button_url']; ?>"><?php echo $settings['promo_button']; ?></a>
            </div>
            <?php if ($images['url']): ?>
                <div class="thumbnail-promo">
                    <img src="<?php echo $images['url'] ?>" alt="image">
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() {

    }
}
