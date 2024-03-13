<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_mask_countup extends Widget_Base {

    public function get_name() {
        return 'modina_mask_countup';
    }

    public function get_title() {
        return esc_html__( 'Mask Image Text - Digits', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-clone';
    }

    public function get_keywords() {
        return [ 'image', 'transland', 'mask', 'count', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

        // ----- service Item Box ---------//
        $this->start_controls_section(
            'mask_section',
            [
                'label' => esc_html__( 'Mask Section', 'modina-core' ),
            ]
        );

        $this->add_control(
            'mask_bg',
            [
                'label' => esc_html__( 'Mask Image - BG', 'modina-core' ),
                'type' =>Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]             
            ]
        );

        $this->add_control(
            'mask_numbers',
            [
                'label' => esc_html__( 'Digits Number or Years', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '22,872',
            ]
        );

        $this->end_controls_section();        


        $this->start_controls_section(
            'style_alignment_section',
            [
                'label' => __('Alignment', 'modina-core'),
            ]
        );

        $this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'modina-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'modina-core' ),
						'icon' => 'fas fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'modina-core' ),
						'icon' => 'fas fa-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'modina-core' ),
						'icon' => 'fas fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

        $this->end_controls_section(); 

        $this->start_controls_section(
            'style_digit', [
                'label' => esc_html__( 'Mask Settings', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_digits_title',
                'selector' => '{{WRAPPER}} .mask-outline h3, {{WRAPPER}} .mask-outline h2, {{WRAPPER}} .mask-outline h1',
            ]
        );

        $this->add_control(
			'bg_alignment',
			[
				'label' => esc_html__( 'Background Position', 'modina-core' ),
                'label_block' => true,
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'modina-core' ),
						'icon' => 'fas fa-arrow-up',
					],
					'left' => [
						'title' => esc_html__( 'Left', 'modina-core' ),
						'icon' => 'fas fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'modina-core' ),
						'icon' => 'fas fa-align-center',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'modina-core' ),
						'icon' => 'fas fa-arrow-down',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

        $this->add_control(
            'mask_margin', [
                'label' => esc_html__( 'Margin', 'modina-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mask-outline' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_section();
        
    }

    protected function render() {

    $settings = $this->get_settings();
    ?>
    
    <?php if(!empty($settings['mask_numbers'])) : ?>
        <div class="mask-outline text-<?php echo esc_attr( $settings['text_align'] ); ?>" style="background-image: url('<?php echo esc_url($settings['mask_bg']['url']); ?>'); background-position: <?php echo esc_attr( $settings['bg_alignment'] ); ?>">
            <?php if(!empty($settings['mask_numbers'])) : ?>
                <h1><?php echo esc_html($settings['mask_numbers']); ?></h1>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php
    }
}