<?php
namespace Anipatelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Anipat elementor testimonial section widget.
 *
 * @since 1.0
 */
class Anipat_Testimonial extends Widget_Base {

	public function get_name() {
		return 'anipat-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial Section', 'anipat-companion' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	public function get_categories() {
		return [ 'anipat-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  testimonial content ------------------------------
		$this->start_controls_section(
			'testimonial_content',
			[
				'label' => __( 'Testimonial contents', 'anipat-companion' ),
			]
        );
        
		$this->add_control(
            'sliders', [
                'label' => __( 'Create New Slider', 'anipat-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ client_name }}}',
                'fields' => [
                    [
                        'name' => 'client_img',
                        'label' => __( 'Client Image', 'anipat-companion' ),
                        'description' => __( 'Best size is 131x149', 'anipat-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'client_name',
                        'label' => __( 'Client Name', 'anipat-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Jhon Walker', 'anipat-companion' ),
                    ],
                    [
                        'name' => 'client_designation',
                        'label' => __( 'Client Designation', 'anipat-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Head of web design', 'anipat-companion' ),
                    ],
                    [
                        'name' => 'text',
                        'label' => __( 'Review', 'anipat-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.', 'anipat-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'client_name'           => __( 'Jhon Walker', 'anipat-companion' ),
                        'client_designation'    => __( 'Head of web design', 'anipat-companion' ),
                        'text'                  => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.', 'anipat-companion' ),
                    ],
                    [      
                        'client_name'           => __( 'Jonathan Doe', 'anipat-companion' ),
                        'client_designation'    => __( 'Head of web design', 'anipat-companion' ),
                        'text'                  => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.', 'anipat-companion' ),
                    ],
                    [      
                        'client_name'           => __( 'Jhon Doe', 'anipat-companion' ),
                        'client_designation'    => __( 'Head of web design', 'anipat-companion' ),
                        'text'                  => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.', 'anipat-companion' ),
                    ],
                ]
            ]
        );
        $this->end_controls_section(); // End Hero content
	}
    
	protected function render() {
    $this->load_widget_script();
    $settings  = $this->get_settings();
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sliders = !empty( $settings['sliders'] ) ? $settings['sliders'] : '';
    ?>
    
    <!-- testmonial_area_start  -->
    <div class="testmonial_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="textmonial_active owl-carousel">
                        <?php 
                        if( is_array( $sliders ) && count( $sliders ) > 0 ) {
                            foreach( $sliders as $item ) {
                                $client_name = !empty( $item['client_name'] ) ? $item['client_name'] : '';
                                $client_img   = !empty( $item['client_img']['id'] ) ? wp_get_attachment_image( $item['client_img']['id'], 'anipat_testimonial_thumb_131x149', '', array( 'alt' => $client_name ) ) : '';
                                $client_designation = !empty( $item['client_designation'] ) ? $item['client_designation'] : '';
                                $text = !empty( $item['text'] ) ? $item['text'] : '';
                                ?>
                                <div class="testmonial_wrap">
                                    <div class="single_testmonial d-flex align-items-center">
                                        <?php
                                            if ( $client_img ) {
                                                echo '
                                                <div class="test_thumb">
                                                    '.wp_kses_post($client_img).'
                                                </div>
                                                ';
                                            }
                                        ?>
                                        <div class="test_content">
                                            <?php
                                                if ( $client_name ) {
                                                    echo '<h4>'.esc_html($client_name).'</h4>';
                                                }
                                                if ( $client_designation ) {
                                                    echo '<span>'.esc_html($client_designation).'</span>';
                                                }
                                                if ( $text ) {
                                                    echo '<p>'.wp_kses_post($text).'</p>';
                                                }
                                            
                                            ?>
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
        </div>
    </div>
    <!-- testimonial_end -->
    <?php
    } 

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // review-active
            $('.textmonial_active').owlCarousel({
            loop:true,
            margin:100,
            items:1,
            autoplay:true,
            navText:['<i class="Flaticon flaticon-left"></i>','<i class="Flaticon flaticon-right"></i>'],
            nav:true,
            dots:false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive:{
                0:{
                    items:1,
                    nav:false,
                },
                767:{
                    items:1,
                    nav:true,
                },
                992:{
                    items:1
                }
            }
            });
        })(jQuery);
        </script>
        <?php 
        }
    }	
}