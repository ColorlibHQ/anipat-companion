<?php
namespace Anipatelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Anipat elementor about section widget.
 *
 * @since 1.0
 */
class Anipat_About_Section extends Widget_Base {

	public function get_name() {
		return 'anipat-about-us';
	}

	public function get_title() {
		return __( 'About Section', 'anipat-companion' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'anipat-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  About Us content ------------------------------
        $this->start_controls_section(
            'left_content',
            [
                'label' => __( 'Left Section Settings', 'anipat-companion' ),
            ]
        );

        $this->add_control(
            'sec_img',
            [
                'label' => esc_html__( 'Left Image', 'anipat-companion' ),
                'description' => esc_html__( 'Best size is 514x669', 'anipat-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'anipat-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => '<span>We care your pet </span> <br> As you care',
            ]
        );
        $this->add_control(
            'sec_text',
            [
                'label' => esc_html__( 'Section Text', 'anipat-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Lorem ipsum dolor sit , consectetur adipiscing elit, sed do <br> iusmod tempor incididunt ut labore et dolore magna aliqua. <br> Quis ipsum suspendisse ultrices gravida. Risus commodo <br> viverra maecenas accumsan.',
            ]
        );
        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'anipat-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'About Us', 'anipat-companion' ),
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label' => esc_html__( 'Button URL', 'anipat-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );
        $this->end_controls_section(); // End left content

        //------------------------------ Style title ------------------------------
        
        // Top Section Styles
        $this->start_controls_section(
            'about_sec_style', [
                'label' => __( 'About Section Styles', 'anipat-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'anipat-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pet_care_area .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_col', [
                'label' => __( 'Text Color', 'anipat-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pet_care_area .section_title p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_col', [
                'label' => __( 'Button Color', 'anipat-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pet_care_area .section_title .boxed-btn3' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

    }

	protected function render() {
    $settings   = $this->get_settings();
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sec_img    = !empty( $settings['sec_img']['id'] ) ? wp_get_attachment_image( $settings['sec_img']['id'], 'anipat_about_thumb_514x669', '', array( 'alt' => $sec_title ) ) : '';
    $sec_text  = !empty( $settings['sec_text'] ) ? $settings['sec_text'] : '';
    $btn_title  = !empty( $settings['btn_title'] ) ? $settings['btn_title'] : '';
    $btn_url  = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    ?>
    
    <!-- pet_care_area_start  -->
    <div class="pet_care_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="pet_thumb">
                        <?php 
                            if ( $sec_img ) { 
                                echo wp_kses_post($sec_img);
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1 col-md-6">
                    <div class="pet_info">
                        <div class="section_title">
                            <?php 
                                if ( $sec_title ) { 
                                    echo '<h3>'.wp_kses_post(nl2br($sec_title)).'</h3>';
                                }
                                if ( $sec_text ) { 
                                    echo '<p>'.wp_kses_post(nl2br($sec_text)).'</p>';
                                }
                                if ( $btn_title ) { 
                                    echo '<a href="'.esc_url($btn_url).'" class="boxed-btn3">'.esc_html($btn_title).'</a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- pet_care_area_end  -->
    <?php
    }
}