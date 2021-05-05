<?php
/**
* Element Heading Media Bodycopy
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Heading_Media_BodyCopy extends Widget_Base {

    public function get_name() {
        return 'heading-media-bodycopy';
    }

    public function get_title() {
        return __( 'Heading Media Bodycopy', 'bearsthemes-addons' );
    }

    public function get_icon() {
        return 'fas fa-file-signature';
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
            'section_image_layout',[
                'label' => __( 'Images', 'bearsthemes-addons' ),
             ]
        );
          $this->add_control(
            'show_image_heading',
            [
              'label' => __( 'Images', 'bearsthemes-addons' ),
              'type' => Controls_Manager::SWITCHER,
              'label_on' => __( 'Show', 'bearsthemes-addons' ),
              'label_off' => __( 'Hide', 'bearsthemes-addons' ),
              'default' => 'no',
            ]
          );
            $this->add_control(
                'image_heading_media_bodycopy',
                [
                    'label' => __( 'Choose Image', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                      'show_image_heading' => 'yes',
                    ],
                ]
            );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_layout',[
                'label' => __( 'Content', 'bearsthemes-addons' ),
             ]
        );
            $this->add_control(
                'title_heading_media_bodycopy',
                    [
                        'label' => __( 'Heading', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'This is the heading', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );
            $this->add_control(
                'html_heading_media_bodycopy',
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
                    'default' => 'h1',
                ]
            );
            $this->add_control(
              'show_sub_heading',
              [
                'label' => __( 'Sub Heading', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'bearsthemes-addons' ),
                'label_off' => __( 'Hide', 'bearsthemes-addons' ),
                'default' => 'yes',
              ]
            );

            $this->add_control(
                'sub_heading_media_bodycopy',
                    [
                        'label' => __( 'Sub Heading', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'This is the sub heading', 'bearsthemes-addons' ),
                        'label_block' => true,
                        'condition' => [
                          'show_sub_heading!' => '',
                        ],
                    ]
            );


            $this->add_control(
                'content_title_heading_media_bodycopy',
                    [
                    'label' => __( 'Content', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    ]
            );
            $this->add_control(
                'content_heading_media_bodycopy',
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

            $this->add_responsive_control(
            'max_width_heading_bodycopy',
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
                    '{{WRAPPER}} .heading-media-bodycopy-elements .heading' => 'max-width: {{SIZE}}{{UNIT}}',
                ],
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

            // style heading in elements
            $this->add_control(
                'style_sub_heading_subhead_bodycopy',
                    [
                    'label' => __( 'Sub Heading', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    ]
            );


            $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
            'name' => 'sub_heading_typography',
            'default' => '',
            'selector' => '{{WRAPPER}} .heading-media-bodycopy-elements .bt-sub-heading',
          ]
        );

            $this->add_control(
          'sub_heading_color',
          [
            'label' => __( 'Color', 'bearsthemes-addons' ),
            'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
              '{{WRAPPER}} .heading-media-bodycopy-elements .bt-sub-heading' => 'color: {{VALUE}};',
            ],
          ]
        );

            $this->add_responsive_control(
                'sub_heading_alignment',
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
              '{{WRAPPER}} .heading-media-bodycopy-elements .bt-sub-heading' => 'text-align: {{VALUE}};',
            ],
                ]
            );

            $this->add_responsive_control(
                'spacing_sub_heading',
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
                        '{{WRAPPER}} .heading-media-bodycopy-elements .bt-sub-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
        $this->register_style_image_controls();
        $this->register_style_content_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading  = $settings['title_heading_media_bodycopy'];
        $heading_html_tag = $settings['html_heading_media_bodycopy'];
        $content = $settings['content_heading_media_bodycopy'];
        $images = $settings['image_heading_media_bodycopy'];
        ?>
        <div class="bt-elements-elementor heading-media-bodycopy-elements">
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
                <?php if ($settings['show_image_heading'] =="yes"): ?>
                    <?php if ($images['url']): ?>
                        <div class="thumbnail">
                            <img src="<?php echo $images['url'] ?>" alt="image">
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php
      						if( '' !== $settings['show_sub_heading'] ) {
      							echo '<h4 class="bt-sub-heading"">' . $settings['sub_heading_media_bodycopy'] . '</h4>';
      						}
      					?>
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
