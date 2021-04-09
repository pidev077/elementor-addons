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
        return 'eicon-counter';
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
            'items_sidebar_main',
            [
                'label' => __( 'List Items', 'bearsthemes-addons' ),
                'type' => Controls_Manager::REPEATER,
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
                'fields' => [
                    [
                        'name' => 'name',
                        'label' => __( 'Name', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( '#!' , 'bearsthemes-addons' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'link',
                        'label' => __( 'Link', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( '#!' , 'bearsthemes-addons' ),
                        'label_block' => true,
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
            'items_sidebar_pdf',
            [
                'label' => __( 'List PDF', 'bearsthemes-addons' ),
                'type' => Controls_Manager::REPEATER,
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
                'fields' => [
                    [
                        'name' => 'name',
                        'label' => __( 'Name', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Name' , 'bearsthemes-addons' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'link',
                        'label' => __( 'Link', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Name' , 'bearsthemes-addons' ),
                        'label_block' => true,
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
            'items_sidebar_footer',
            [
                'label' => __( 'List Items', 'bearsthemes-addons' ),
                'type' => Controls_Manager::REPEATER,
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
                'fields' => [
                    [
                        'name' => 'name',
                        'label' => __( 'Name', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Name' , 'bearsthemes-addons' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'link',
                        'label' => __( 'Link', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Name' , 'bearsthemes-addons' ),
                        'label_block' => true,
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function _register_controls() {
        $this->register_sidebar_header_section_controls();
        $this->register_sidebar_main_section_controls();
        $this->register_sidebar_pdf_section_controls();
        $this->register_sidebar_footer_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        // echo "<pre>";
        // echo print_r($settings);
        // echo "</pre>";
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
                            <?php $this->loop_items($items_pdf); ?>
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
