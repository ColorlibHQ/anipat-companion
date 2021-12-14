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
 * Anipat elementor services section widget.
 *
 * @since 1.0
 */
class Anipat_Services extends Widget_Base {

	public function get_name() {
		return 'anipat-services';
	}

	public function get_title() {
		return __( 'Services Section', 'anipat-companion' );
	}

	public function get_icon() {
		return 'eicon-settings';
	}

	public function get_categories() {
		return [ 'anipat-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  services content ------------------------------
		$this->start_controls_section(
			'services_content',
			[
				'label' => __( 'Services contents', 'anipat-companion' ),
			]
        );
        
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Sec Title', 'anipat-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Services for every dog', 'anipat-companion' ),
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
            'services', [
                'label' => __( 'Create New Slider', 'anipat-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'service_icon',
                        'label' => __( 'Select Icon', 'anipat-companion' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'service_icon_1',
                        'options' => [
                            'service_icon_1' => __( 'Service Icon 1', 'anipat-companion' ),
                            'service_icon_2' => __( 'Service Icon 2', 'anipat-companion' ),
                            'service_icon_3' => __( 'Service Icon 3', 'anipat-companion' ),
                        ]
                    ],
                    [
                        'name' => 'title',
                        'label' => __( 'Title', 'anipat-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Pet Boarding', 'anipat-companion' ),
                    ],
                    [
                        'name' => 'text',
                        'label' => __( 'Text', 'anipat-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut', 'anipat-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'service_icon'  => 'service_icon_1',
                        'title'         => __( 'Pet Boarding', 'anipat-companion' ),
                        'text'          => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut', 'anipat-companion' ),
                    ],
                    [      
                        'service_icon'  => 'service_icon_2',
                        'title'         => __( 'Healthy Meals', 'anipat-companion' ),
                        'text'          => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut', 'anipat-companion' ),
                    ],
                    [      
                        'service_icon'  => 'service_icon_3',
                        'title'         => __( 'Pet Spa', 'anipat-companion' ),
                        'text'          => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut', 'anipat-companion' ),
                    ],
                ]
            ]
        );
        $this->end_controls_section(); // End Hero content

        //------------------------------ Style title ------------------------------
        
        // Top Section Styles
        $this->start_controls_section(
            'service_sec_style', [
                'label' => __( 'Service Section Styles', 'anipat-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'anipat-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service_area .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sub_title_col', [
                'label' => __( 'Sub Title Color', 'anipat-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service_area .section_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'service_border_col', [
                'label' => __( 'Service Border Color', 'anipat-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service_area .single_service' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .service_area .single_service:hover' => 'border-color: transparent;',
                ],
            ]
        );

        $this->end_controls_section();
	}
    
	protected function render() {
    $settings  = $this->get_settings();
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sub_title = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $services = !empty( $settings['services'] ) ? $settings['services'] : '';
    // ANIPAT_DIR_ICON_IMG_URI
    // ANIPAT_DIR_IMGS_URI
    ?>

    <!-- service_area_start  -->
    <div class="service_area">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-7 col-md-10">
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
                if( is_array( $services ) && count( $services ) > 0 ) {
                    foreach( $services as $item ) {
                        $service_icon = !empty( $item['service_icon'] ) ? ANIPAT_DIR_ICON_IMG_URI . $item['service_icon'] .'.png' : '';
                        $service_icon_bg = ANIPAT_DIR_IMGS_URI . 'service_icon_bg.png';
                        $title = !empty( $item['title'] ) ? $item['title'] : '';
                        $text = !empty( $item['text'] ) ? $item['text'] : '';
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="single_service">
                                <div class="service_thumb d-flex align-items-center justify-content-center" <?php echo anipat_inline_bg_img(esc_url($service_icon_bg))?>>
                                    <div class="service_icon">
                                        <img src="<?php echo esc_url( $service_icon )?>" alt="<?php echo esc_attr( $title )?>">
                                    </div>
                                </div>
                                <div class="service_content text-center">
                                    <?php
                                        if ( $title ) {
                                            echo '<h3>'.esc_html($title).'</h3>';
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
    <?php
    }
}