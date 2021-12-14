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
class Anipat_Home_Contact extends Widget_Base {

	public function get_name() {
		return 'anipat-home-contact';
	}

	public function get_title() {
		return __( 'Home Contact', 'anipat-companion' );
	}

	public function get_icon() {
		return 'eicon-tel-field';
	}

	public function get_categories() {
		return [ 'anipat-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  Home Contact content ------------------------------
        $this->start_controls_section(
            'home_contact_content',
            [
                'label' => __( 'Home Contact Settings', 'anipat-companion' ),
            ]
        );

        $this->add_control(
            'sec_img',
            [
                'label' => esc_html__( 'BG Image', 'anipat-companion' ),
                'description' => esc_html__( 'Best size is 1920x609', 'anipat-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'anipat-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Why go with Anipat?', 'anipat-companion' ),
            ]
        );
        $this->add_control(
            'sec_text',
            [
                'label' => esc_html__( 'Section Text', 'anipat-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Because we know that even the best technology is only as good as the people behind it. 24/7 tech support.', 'anipat-companion' ),
            ]
        );
        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'anipat-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Contact Us', 'anipat-companion' ),
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
        $this->add_control(
            'phone_number',
            [
                'label' => esc_html__( 'Phone Number', 'anipat-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( '+880 4664 216', 'anipat-companion' ),
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
                    '{{WRAPPER}} .contact_anipat .contact_text .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_col', [
                'label' => __( 'Text Color', 'anipat-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact_anipat .contact_text .section_title p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .contact_anipat .contact_text .contact_btn p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .contact_anipat .contact_text .contact_btn p a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_col', [
                'label' => __( 'Button Color', 'anipat-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact_anipat .contact_text .boxed-btn4' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .contact_anipat .contact_text .boxed-btn4:hover' => 'color: #fff; background: {{VALUE}}; border-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

    }

	protected function render() {
    $settings   = $this->get_settings();
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sec_img    = !empty( $settings['sec_img']['url'] ) ? $settings['sec_img']['url'] : '';
    $sec_text   = !empty( $settings['sec_text'] ) ? $settings['sec_text'] : '';
    $btn_title  = !empty( $settings['btn_title'] ) ? $settings['btn_title'] : '';
    $btn_url    = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    $phone_number = !empty( $settings['phone_number'] ) ? $settings['phone_number'] : '';
    ?>
    
    <div class="contact_anipat" <?php echo anipat_inline_bg_img(esc_url($sec_img))?>>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact_text text-center">
                        <div class="section_title text-center">
                            <?php 
                                if ( $sec_title ) { 
                                    echo '<h3>'.esc_html($sec_title).'</h3>';
                                }
                                if ( $sec_text ) { 
                                    echo '<p>'.wp_kses_post(nl2br($sec_text)).'</p>';
                                }
                            ?>
                        </div>
                        <div class="contact_btn d-flex align-items-center justify-content-center">
                            <?php 
                                if ( $btn_title ) { 
                                    echo '<a href="'.esc_url($btn_url).'" class="boxed-btn4">'.esc_html($btn_title).'</a>';
                                }
                                if ( $phone_number ) { 
                                    echo '<p>Or  <a href="tel:'.esc_attr($phone_number).'">'.esc_html($phone_number).'</a></p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
}