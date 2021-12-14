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
 * Anipat elementor team section widget.
 *
 * @since 1.0
 */
class Anipat_Team extends Widget_Base {

	public function get_name() {
		return 'anipat-team';
	}

	public function get_title() {
		return __( 'Team Member Section', 'anipat-companion' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'anipat-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  team content ------------------------------
		$this->start_controls_section(
			'team_content',
			[
				'label' => __( 'Team Member contents', 'anipat-companion' ),
			]
        );
        
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'anipat-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Our Team', 'anipat-companion' ),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'anipat-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.', 'anipat-companion' ),
            ]
        );
		$this->add_control(
            'sliders', [
                'label' => __( 'Create New Slider', 'anipat-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ member_name }}}',
                'fields' => [
                    [
                        'name' => 'member_img',
                        'label' => __( 'Member Image', 'anipat-companion' ),
                        'description' => __( 'Best size is 360x317', 'anipat-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'member_name',
                        'label' => __( 'Member Name', 'anipat-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Rala Emaia', 'anipat-companion' ),
                    ],
                    [
                        'name' => 'member_designation',
                        'label' => __( 'Member Designation', 'anipat-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Senior Director', 'anipat-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'client_name'           => __( 'Jhon Walker', 'anipat-companion' ),
                        'client_designation'    => __( 'Head of web design', 'anipat-companion' ),
                    ],
                    [      
                        'client_name'           => __( 'jhon Smith', 'anipat-companion' ),
                        'client_designation'    => __( 'Head of Development', 'anipat-companion' ),
                    ],
                    [      
                        'client_name'           => __( 'Rala Emaia', 'anipat-companion' ),
                        'client_designation'    => __( 'Head of Design', 'anipat-companion' ),
                    ],
                ]
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
				'label' => __( 'Style Team Section', 'anipat-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_col', [
				'label' => __( 'Title Color', 'anipat-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team_area .section_title h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sub_title_col', [
				'label' => __( 'Sub Title Color', 'anipat-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team_area .section_title p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}
    
	protected function render() {
    $settings  = $this->get_settings();
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sub_title = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $sliders = !empty( $settings['sliders'] ) ? $settings['sliders'] : '';
    ?>
    
    <!-- team_area_start  -->
    <div class="team_area">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-6 col-md-10">
                    <div class="section_title text-center mb-95">
                        <?php
                            if ( $sec_title ) {
                                echo '<h3>'.esc_html($sec_title).'</h3>';
                            }
                            if ( $sub_title ) {
                                echo '<p>'.wp_kses_post($sub_title).'</p>';
                            }
                        
                        ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php 
                if( is_array( $sliders ) && count( $sliders ) > 0 ) {
                    foreach( $sliders as $item ) {
                        $member_name = !empty( $item['member_name'] ) ? $item['member_name'] : '';
                        $member_img   = !empty( $item['member_img']['id'] ) ? wp_get_attachment_image( $item['member_img']['id'], 'anipat_team_thumb_360x317', '', array( 'alt' => $member_name ) ) : '';
                        $member_designation = !empty( $item['member_designation'] ) ? $item['member_designation'] : '';
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="single_team">
                                <?php
                                    if ( $member_img ) {
                                        echo '
                                        <div class="thumb">
                                            '.wp_kses_post($member_img).'
                                        </div>
                                        ';
                                    }
                                ?>
                                <div class="member_name text-center">
                                    <div class="mamber_inner">
                                        <?php
                                            if ( $member_name ) {
                                                echo '<h4>'.esc_html($member_name).'</h4>';
                                            }
                                            if ( $member_designation ) {
                                                echo '<p>'.esc_html($member_designation).'</p>';
                                            }
                                        
                                        ?>
                                    </div>
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
}