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
 * Anipat elementor adopt section widget.
 *
 * @since 1.0
 */
class Anipat_Adopt extends Widget_Base {

	public function get_name() {
		return 'anipat-adopt';
	}

	public function get_title() {
		return __( 'Adopt Section', 'anipat-companion' );
	}

	public function get_icon() {
		return 'eicon-apps';
	}

	public function get_categories() {
		return [ 'anipat-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  adopt content ------------------------------
		$this->start_controls_section(
			'adopt_content',
			[
				'label' => __( 'Adopt contents', 'anipat-companion' ),
			]
        );
        
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Sec Title', 'anipat-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => '<span>We need your</span> help Adopt Us',
            ]
        );
        $this->add_control(
            'sec_text',
            [
                'label' => esc_html__( 'Sub Title', 'anipat-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Lorem ipsum dolor sit , consectetur adipiscing elit, sed do iusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices.',
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
            'adopts', [
                'label' => __( 'Create New Slider', 'anipat-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ counter_title }}}',
                'fields' => [
                    [
                        'name' => 'adopt_icon',
                        'label' => __( 'Select Icon', 'anipat-companion' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'adopt_icon_1',
                        'options' => [
                            'adopt_icon_1' => __( 'Adopt Icon 1', 'anipat-companion' ),
                            'adopt_icon_2' => __( 'Adopt Icon 2', 'anipat-companion' ),
                            'adopt_icon_3' => __( 'Adopt Icon 3', 'anipat-companion' ),
                        ]
                    ],
                    [
                        'name' => 'counter_val',
                        'label' => __( 'Counter Title', 'anipat-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( '452', 'anipat-companion' ),
                    ],
                    [
                        'name' => 'counter_title',
                        'label' => __( 'Counter Title', 'anipat-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Pets Available', 'anipat-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'adopt_icon'        => 'adopt_icon_1',
                        'counter_val'       => __( '452', 'anipat-companion' ),
                        'counter_title'     => __( 'Pets Available', 'anipat-companion' ),
                    ],
                    [      
                        'adopt_icon'        => 'adopt_icon_3',
                        'counter_val'       => __( '52', 'anipat-companion' ),
                        'counter_title'     => __( 'Pets Available', 'anipat-companion' ),
                    ],
                    [      
                        'adopt_icon'        => 'adopt_icon_2',
                        'counter_val'       => __( '62', 'anipat-companion' ),
                        'counter_title'     => __( 'Pets Available', 'anipat-companion' ),
                    ],
                ]
            ]
        );
        $this->end_controls_section(); // End Hero content

        //------------------------------ Style title ------------------------------
        
        // Top Section Styles
        $this->start_controls_section(
            'apartment_sec_style', [
                'label' => __( 'Apartments Section Styles', 'anipat-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'anipat-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adapt_area .section_title h3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .adapt_area .adapt_about .single_adapt .adapt_content h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_col', [
                'label' => __( 'Text Color', 'anipat-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adapt_area .section_title p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .adapt_area .adapt_about .single_adapt .adapt_content p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_col', [
                'label' => __( 'Button Color', 'anipat-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adapt_area .section_title .boxed-btn3' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
	}
    
	protected function render() {
    $settings  = $this->get_settings();
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sec_text = !empty( $settings['sec_text'] ) ? $settings['sec_text'] : '';
    $btn_title = !empty( $settings['btn_title'] ) ? $settings['btn_title'] : '';
    $btn_url = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    $adopts = !empty( $settings['adopts'] ) ? $settings['adopts'] : '';
    ?>

    <!-- adapt_area_start  -->
    <div class="adapt_area">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5">
                    <div class="adapt_help">
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
                <div class="col-lg-6">
                    <div class="adapt_about">
                        <div class="row align-items-center">
                            <?php
                            if( is_array( $adopts ) && count( $adopts ) > 0 ) {
                                $counter = 0;
                                foreach( $adopts as $item ) {
                                    $counter++;
                                    $adopt_icon = !empty( $item['adopt_icon'] ) ? ANIPAT_DIR_ICON_IMG_URI . $item['adopt_icon'] .'.png' : '';
                                    $counter_val = !empty( $item['counter_val'] ) ? $item['counter_val'] : '';
                                    $counter_title = !empty( $item['counter_title'] ) ? $item['counter_title'] : '';
                                    $wrapper_class_open =  '<div class="col-lg-6 col-md-6">';
                                    $wrapper_class_close =  '</div>';
                                    echo ($counter != 3) ? $wrapper_class_open : '';
                                    ?>
                                    <div class="single_adapt text-center">
                                        <img src="<?php echo esc_url($adopt_icon)?>" alt="<?php echo esc_html($counter_title)?>">
                                        <div class="adapt_content">
                                            <h3 class="counter"><?php echo esc_html($counter_val)?></h3>
                                            <p><?php echo esc_html($counter_title)?></p>
                                        </div>
                                    </div>
                                    <?php
                                    echo ($counter != 2) ? $wrapper_class_close : '';
                                }
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