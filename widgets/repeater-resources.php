<?php
/**
* Element Resources
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
// use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Resources_Widgets extends Widget_Base {

    public function get_name() {
        return 'resources-widgets';
    }

    public function get_title() {
        return __( 'Resources Widgets', 'bearsthemes-addons' );
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
                'heading_resources',
                    [
                        'label' => __( 'Heading', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Key documentation sed do eiusmod tempor incididunt', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );


            $this->add_control(
                'post_ids_resources',
                [
                    'label'       => __( 'Select Resources', 'bears-elementor-extension' ),
                    'type'        => \Elementor\Controls_Manager::SELECT2,
                    'multiple'    => true,
                    'options'     => $this->bears_show_post_resources_for_select(),
                    'default'     => [],
                    'description' => __( 'Select post to be included', 'bearsthemes-addons' )
                ]
            );

            $colum_pdf_resources = range( 1, 4);
            $colum_pdf_resources = array_combine( $colum_pdf_resources, $colum_pdf_resources );
            $this->add_responsive_control(
                'colum_pdf_resources',
                [
                'label' => __( 'Columns', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 2,
                'options' => $colum_pdf_resources,
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
                    'name' => 'heading_resources_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .resources-elements .heading',
                ]
            );

            $this->add_control(
                'heading_resources_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .resources-elements .heading' => 'color: {{VALUE}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'heading_resources_alignment',
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
                        '{{WRAPPER}} .resources-elements .heading' => 'text-align: {{VALUE}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'heading_resources_spacing',
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
                        '{{WRAPPER}} .resources-elements .heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                    'name' => 'content_resources_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .list-pdf-resources .meta-resources .info-pdf',
                ]
            );

            $this->add_control(
                'content_resources_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2f2f39',
                    'selectors' => [
                        '{{WRAPPER}} .list-pdf-resources .meta-resources .info-pdf' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .list-pdf-resources .meta-resources > a' => 'color: {{VALUE}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'content_resources_alignment',
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
                        '{{WRAPPER}} .list-pdf-resources .meta-resources .info-pdf' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_resources_spacing',
                [
                    'label' => __( 'Spacing Items PDF', 'elementor' ),
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
                        '{{WRAPPER}} .resources-elements .list-pdf-resources .item-pdf' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
    			'container_items_pdf_resources',
    			[
    				'label' => __( 'Container Items PDF', 'bearsthemes-addons' ),
    				'type' => Controls_Manager::SLIDER,
    				'size_units' => [ 'px', '%' ],
    				'range' => [
    					'px' => [
    						'min' => 0,
    						'max' => 800,
    					],
    				],
    				'selectors' => [
    					'{{WRAPPER}} .resources-elements .list-pdf-resources .meta-resources' => 'max-width: {{SIZE}}{{UNIT}}',
    				],
    			]
    		);


        $this->end_controls_section();
    }


    // function query post type resources
    protected function bears_show_post_resources_for_select(){
        $supported_ids = [];

        $wp_query = new \WP_Query( array(
            'post_type' => 'resources',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_query' => array(
              'relation'		=> 'AND',
              array(
                'key'     => 'select_type_resources',
                'value'   => 'PDF',
                'compare' => '=',
              ),
              array(
          		'key'	  	=> 'upload_file',
                'value'   => '',
                'compare' => '!=',
          		),
            ),
        ) );

        if ( $wp_query->have_posts() ) {
            while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                $supported_ids[get_the_ID()] = get_the_title();
            }
        }
        return $supported_ids;
    }

    protected function _register_controls() {
        $this->register_content_section_controls();
        $this->register_style_title_section_controls();
        $this->register_style_content_section_controls();

    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading  = $settings['heading_resources'];
        $ids = $settings['post_ids_resources'];
        $column_des = $settings['colum_pdf_resources'];
        $column_tab = $settings['colum_pdf_resources_tablet'];
        $column_mobi = $settings['colum_pdf_resources_mobile'];
        $class_des = '';
        $class_tab = '';
        $class_mobi = '';
        //var_dump($ids);
        switch ($column_des) {
            case '4':
                $class_des = 'columns-des-4';
                break;
            case '3':
                $class_des = 'columns-des-3';
            break;
            case '2':
                $class_des = 'columns-des-2';
            break;

            default:
                $class_des = 'columns-des-1';
                break;
        }

        switch ($column_mobi) {
            case '4':
                $class_mobi = 'columns-mobi-4';
                break;

            case '3':
                $class_mobi = 'columns-mobi-3';
            break;

            case '2':
                $class_mobi = 'columns-mobi-2';
            break;

            default:
                $class_mobi = 'columns-mobi-1';
                break;
        }

        switch ($column_tab) {
            case '4':
                $class_tab = 'columns-tab-4';
                break;

            case '3':
                $class_tab = 'columns-tab-3';
            break;

            case '2':
                $class_tab = 'columns-tab-2';
            break;

            default:
                $class_tab = 'columns-tab-1';
                break;
        }
        // $content  = $settings['content_alert_banner'];

        // echo "<pre>";
        // echo print_r($settings);
        // echo "</pre>";
        ?>

        <div class="bt-elements-elementor resources-elements">
            <div class="content-elements">
                <?php if ($heading): ?>
                    <h2 class="heading"> <?php echo $heading ?> </h2>
                <?php endif; ?>

                <div class="list-pdf-resources">
                    <?php $this->get_resources_template($ids, $class_des,  $class_tab,  $class_mobi); ?>
                </div>

            </div>
        </div>
        <?php
    }


    protected function get_resources_template($id, $class_des, $class_tab,  $class_mobi){

        $loop = new \WP_Query( array(
            'post_type' => 'resources',
            'post_status' => 'publish',
            'post__in' => $id,
            'meta_query' => array(
              array(
                'key'     => 'select_type_resources',
                'value'   => 'PDF',
                'compare' => 'LIKE',
              ),
            ),
        ) );
        while ( $loop->have_posts() ) : $loop->the_post();
        //var_dump($loop);
            $pdf= get_field('upload_file');
            $id_pdf = $pdf['ID'];
            // echo "<pre>";
            // echo print_r($pdf);
            // echo "</pre>";
            $name_pdf = $pdf['title'];
            $filesize = filesize( get_attached_file( $id_pdf ) );
            $filesize = size_format($filesize, 2);
            $link_pdf = $pdf['url'];
            ?>

            <div id="post-<?php the_ID(); ?>" class="items item-pdf <?php echo $class_des; echo " "; echo $class_tab; echo " "; echo $class_mobi ?>">
                <div class="__content">
                    <div class="meta-resources">
                        <a href="<?php echo $link_pdf; ?>" target="_blank">
                            <h4 class="info-pdf name-pdf"> <?php echo $name_pdf; ?> </h4>
                            <div class="info-pdf size-pdf"> [PDF <span><?php echo $filesize ?>]</span></div>
                        </a>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
    }

    protected function _content_template() {

    }
}
