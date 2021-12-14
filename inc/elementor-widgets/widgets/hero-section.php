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
 * Anipat elementor hero section widget.
 *
 * @since 1.0
 */
class Anipat_Hero extends Widget_Base {

	public function get_name() {
		return 'anipat-hero';
	}

	public function get_title() {
		return __( 'Hero Section', 'anipat-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'anipat-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Hero content ------------------------------
		$this->start_controls_section(
			'hero_content',
			[
				'label' => __( 'Hero section content', 'anipat-companion' ),
			]
        );
        
		$this->add_control(
            'bg_img', [
                'label' => __( 'BG Image', 'anipat-companion' ),
                'label' => __( 'Best size is 1920x888', 'anipat-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
		$this->add_control(
            'pet_img', [
                'label' => __( 'Pet Image', 'anipat-companion' ),
                'label' => __( 'Best option is upload a tranparent image with the size 947x745', 'anipat-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
		$this->add_control(
            'sec_title', [
                'label' => __( 'Section Title', 'anipat-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'We Care <br> <span>Your Pets</span>',
            ]
        );
		$this->add_control(
            'sub_title', [
                'label' => __( 'Section Text', 'anipat-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Lorem ipsum dolor sit amet, consectetur <br> adipiscing elit, sed do eiusmod.',
            ]
        );
		$this->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'anipat-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Contact Us', 'anipat-companion' ),
            ]
        );
		$this->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'anipat-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );
        
        $this->end_controls_section(); // End Hero content


    /**
     * Style Tab
     * ------------------------------ Style Title ------------------------------
     *
     */
        $this->start_controls_section(
			'style_title', [
				'label' => __( 'Style Hero Section', 'anipat-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_col', [
				'label' => __( 'Big Title Color', 'anipat-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_col', [
				'label' => __( 'Text Color', 'anipat-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_col', [
				'label' => __( 'Button Color', 'anipat-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn4' => 'color: {{VALUE}};',
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn4:hover' => 'background: {{VALUE}}; border-color: {{VALUE}}; color: #fff',
				],
			]
		);
		$this->end_controls_section();
	}
    
	protected function render() {
    $settings  = $this->get_settings();
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $bg_img = !empty( $settings['bg_img']['url'] ) ? $settings['bg_img']['url'] : '';
    $pet_img = !empty( $settings['pet_img']['id'] ) ? wp_get_attachment_image( $settings['pet_img']['id'], 'anipat_hero_pet_thumb_947x745', '', array( 'alt' => $sec_title ) ) : '';
    $sub_title = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $btn_title = !empty( $settings['btn_title'] ) ? $settings['btn_title'] : '';
    $btn_url = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    ?>

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider d-flex align-items-center" <?php echo anipat_inline_bg_img(esc_url($bg_img))?>>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="slider_text">
                            <?php 
                                if ( $sec_title ) { 
                                    echo '<h3>'.wp_kses_post( nl2br($sec_title) ).'</h3>';
                                }
                                if ( $sub_title ) { 
                                    echo '<p>'.wp_kses_post( nl2br($sub_title) ).'</p>';
                                }
                                if ( $btn_title ) { 
                                    echo '<a href="'.esc_url( $btn_url ).'" class="boxed-btn4">'.esc_html( $btn_title ).'</a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dog_thumb d-none d-lg-block">
                <?php 
                    if ( $pet_img ) { 
                        echo wp_kses_post( $pet_img );
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->
    <?php
    } 
}