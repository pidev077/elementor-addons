<?php
/**
* Element Subhead Bodycopy
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Repeater_resources_widget extends Widget_Base {

    public function get_name() {
        return 'repeater_resources';
    }

    public function get_title() {
        return __( 'Repeater Resources', 'bearsthemes-addons' );
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


    protected function register_sidebar_pdf_section_controls() {
        $this->start_controls_section(
            'section_sidebar_pdf_layout',[
                'label' => __( 'Choose PDF', 'bearsthemes-addons' ),
             ]
        );

        $this->add_control(
            'heading_resources_repeater',
                [
                    'label' => __( 'Heading', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __( 'Key documentation sed do eiusmod tempor incididunt', 'bearsthemes-addons' ),
                    'label_block' => true,
                ]
        );

        $itemsPDF = new \Elementor\Repeater();

        $itemsPDF->add_control(
            'post_ids_resources',
            [
                'label'       => __( 'Select Resources', 'bears-elementor-extension' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'multiple'    => false,
                'options'     => $this->bears_show_post_resources_for_select(),
                'default'     => [],
                'description' => __( 'Select post to be included', 'bearsthemes-addons' )
            ]
        );

        $itemsPDF->add_control(
            'name',
            [
                'label' => __( 'Name', 'bearsthemes-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
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
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function _register_controls() {
        $this->register_sidebar_pdf_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $items_pdf = $settings['items_sidebar_pdf'];
        $heading_top = $settings['heading_resources_repeater'];
        $link_pdf_all = [];
        $name_pdf_custom = [];
        $pdf_file_size = [];
        foreach ($items_pdf as $key => $value) {
            $pdf= get_field('upload_file',$value['post_ids_resources']);

            $id_pdf = $pdf['ID'];
            $name_pdf = $pdf['title'];
            $filesize = filesize( get_attached_file( $id_pdf ) );
            $filesize = size_format($filesize, 2);
            $link_pdf = $pdf['url'];
            if(!empty($link_pdf)){
                array_push ($link_pdf_all,$link_pdf);
            }
            if(!empty($filesize)) {
                array_push($pdf_file_size,$filesize);
            }

            if(!empty($value['name'])){
                array_push ($name_pdf_custom,$value['name']);
            }else{
                array_push ($name_pdf_custom,$name_pdf);
            }

        }
        ?>

        <div class="bt-elements-elementor resources-elements">
            <div class="content-elements">
                <?php if ($heading_top): ?>
                    <h2 class="heading"> <?php echo $heading_top ?> </h2>
                <?php endif; ?>

                <div class="list-pdf-resources">
                    <?php
                        if(!empty($link_pdf_all)){
                            foreach ($link_pdf_all as $key => $value) {
                                ?>
                                <div class="items item-pdf">
                                    <div class="__content">
                                        <div class="meta-resources">
                                            <a href="<?php echo $value; ?>" target="<?php echo $items_pdf[$key]['link_target']?>">
                                                <h4 class="info-pdf name-pdf"> <?php echo $name_pdf_custom[$key]; ?> </h4>
                                                <div class="info-pdf size-pdf"> [PDF <span><?php echo $pdf_file_size[$key] ?>]</span></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>

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
            $name_pdf = $pdf['title'];
            $filesize = filesize( get_attached_file( $id_pdf ) );
            $filesize = size_format($filesize, 2);
            $link_pdf = $pdf['url'];
        endwhile;
        wp_reset_postdata();
    }

    protected function _content_template() {

    }


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
}
