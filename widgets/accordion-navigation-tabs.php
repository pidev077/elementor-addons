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

class Accordion_Navigation_Tabs extends Widget_Base {

    public function get_name() {
        return 'accordion-navigation-tabs';
    }

    public function get_title() {
        return __( 'Accordion Navigation Tabs', 'bearsthemes-addons' );
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


    protected function register_tabs_section_controls() {
        $this->start_controls_section(
            'section_tabs_layout',[
                'label' => __( 'Tabs', 'bearsthemes-addons' ),
             ]
        );

            $this->add_control(
                'title_accordion_navigation_tabs',
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
                'post_ids_tabs',
                [
                    'label'       => __( 'Select Team', 'bears-elementor-extension' ),
                    'type'        => \Elementor\Controls_Manager::SELECT2,
                    'multiple'    => true,
                    'options'     => $this->bears_show_post_team_for_select(),
                    'default'     => [],
                    'description' => __( 'Select post to be included', 'bearsthemes-addons' )
                ]
            );
            $this->add_control(
                'list_tabs_items',
                [
                    'label' => __( 'Tabs Items', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $litsItems->get_controls(),
                    'default' => [
                        [
                            'title' => __( 'Our board', 'bearsthemes-addons' ),
                            'post_ids_tabs' => __( '', 'bearsthemes-addons' ),

                        ],
                        [
                            'title' => __( 'Our exec team ', 'bearsthemes-addons' ),
                            'post_ids_tabs' => __( '', 'bearsthemes-addons' ),

                        ],
                    ],
                    'title_field' => '{{{ title }}}',
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

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_ant_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .accordion-navigation-tabs-elements > .content-elements > .heading',
                ]
            );

            $this->add_control(
                'title_ant_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2F2F39',
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-elements > .content-elements > .heading' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_ant_alignment',
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
                        '{{WRAPPER}} .accordion-navigation-tabs-elements > .content-elements > .heading' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_ant_spacing',
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
                        '{{WRAPPER}} .accordion-navigation-tabs-elements > .content-elements > .heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    protected function register_style_tabs_section_controls() {
        $this->start_controls_section(
            'style_tabs_section',[
                'label' => __( 'Tabs', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

            // style images tabs
            $this->add_control(
                'image_ant_heading',
                [
                    'label' => __( 'Images', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'width_image_ant',
                [
                    'label' => __( 'Width', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 800,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .content-team .thumbnail-team' => 'width: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .content-team .thumbnail-team' => 'height: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .content-team .meta-team' => 'width: calc(100% - {{SIZE}}{{UNIT}})',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    // function query post type team
    protected function bears_show_post_team_for_select(){
        $supported_ids = [];

        $wp_query = new \WP_Query( array(
            'post_type' => 'team',
            'post_status' => 'publish'
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
        $this->register_tabs_section_controls();
        $this->register_style_title_section_controls();
        $this->register_style_tabs_section_controls();
        // $this->register_content_section_controls();
        // // $this->register_style_title_section_controls_fff();
        // $this->register_style_general_section_controls();
        // $this->register_style_title_section_controls();
        // $this->register_style_content_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading  = $settings['title_accordion_navigation_tabs'];
        $items = $settings['list_tabs_items'];
        // echo "<pre>";
        // echo print_r($items);
        // echo "</pre>";
        ?>
        <div class="bt-elements-elementor accordion-navigation-tabs-elements">
            <div class="content-elements">
                <?php if ($heading): ?>
                    <h2 class="heading"> <?php echo $heading ?> </h2>
                <?php endif; ?>
                <?php if ($items): ?>
                    <div class="accordion-navigation-tabs-container">
                        <div class="accordion-navigation-tabs-warp">
                            <div class="accordion-navigation-tabs-title">
                                <?php foreach ($items as $key => $item): ?>
                                    <?php $activeTitle = ($key == 0) ? "active" : " " ;?>
                                    <?php if ($item['title']): ?>
                                        <div class="items item-tabs-title <?php echo $activeTitle; ?>" data-tab="bears-tab-<?php echo $key ?>">
                                            <?php echo $item['title'];  ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="accordion-navigation-tabs-content">
                                <?php foreach ($items as $key => $item): ?>
                                    <?php $activeContent = ($key == 0) ? "active" : " " ;?>
                                    <?php $ids = $item['post_ids_tabs'] ?>
                                    <?php if ($ids): ?>
                                        <div class="items item-tabs-content bears-tab-<?php echo $key ?> <?php echo $activeContent; ?>">
                                            <?php $this->get_team_template($ids); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    protected function get_team_template($id) {
        $loop = new \WP_Query( array(
            'post_type' => 'team',
            'post_status' => 'publish',
            'post__in' => $id,
        ) ); ?>
        <?php
        while ( $loop->have_posts() ) : $loop->the_post();
            $id_team = get_the_ID();
            $thumbnail_url = get_the_post_thumbnail_url($id_team);
            $postions = get_field('position_team_insuranceca');
            $addrress = get_field('addrress_team_insuranceca');
            // $link_industry = get_field( "link_industry" );
            ?>
            <div id="post-<?php the_ID(); ?>" class="item-team">
                <div class="content-team">
                    <div class="thumbnail-team">
                        <div class="avatar" style="background-image:url('<?php echo $thumbnail_url ?>')"></div>
                    </div>
                    <div class="meta-team">
                        <h3 class="name"> <?php the_title(); ?> </h3>
                        <?php if ($postions): ?>
                            <p class="positions"> <?php echo $postions ?>  </p>
                        <?php endif; ?>
                        <?php if ($addrress): ?>
                            <p class="addrress"> <?php echo $addrress ?>  </p>
                        <?php endif; ?>
                        <div class="description"> <?php the_content(); ?> </div>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata(); ?>
    <?php
    }

    protected function _content_template() {

    }
}
