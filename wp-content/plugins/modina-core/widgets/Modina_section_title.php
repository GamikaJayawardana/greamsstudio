<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_section_title extends Widget_Base {

    public function get_name() {
        return 'modina_section_title';
    }

    public function get_title() {
        return esc_html__( 'Section Title', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_keywords() {
        return [ 'title', 'section', 'dustrix', 'heading', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_title_style_select', [
                'label' => __( 'Section Title Style - Choice', 'modina-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_1' => esc_html__( 'Style One', 'modina-core' ),
                    'style_2' => esc_html__( 'Style Two', 'modina-core' ),
                    'style_3' => esc_html__( 'Style Three', 'modina-core' ),
                ],
                'default' => 'style_1'
            ]
        );

        $this->end_controls_section();

        // -------------------  Title Section  -----------------------//
        $this->start_controls_section(
            'section_heading',
            [
                'label' => esc_html__( 'Section Heading', 'modina-core' ),
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__( 'Heading Text', 'modina-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'What We Do',
            ]
        );

        $this->add_control(
            'color_heading', [
                'label' => esc_html__( 'Heading Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h2, {{WRAPPER}} .section-title-2 h2, {{WRAPPER}} .section-title-3 h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_heading',
                'selector' => '{{WRAPPER}} .section-title h2, {{WRAPPER}} .section-title-2 h2,  {{WRAPPER}} .section-title-3 h2',
            ]
        );

        $this->end_controls_section(); 

        // ------------------- Sub Title Section  -----------------------//
        $this->start_controls_section(
            'section_sub_heading',
            [
                'label' => esc_html__( 'Section Sub Heading', 'modina-core' ),
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label' => esc_html__( 'Sub Heading', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Our Services',
            ]
        );

        $this->add_control(
            'color_sub_heading', [
                'label' => esc_html__( 'Sub Heading Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title > p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_sub_heading',
                'selector' => '{{WRAPPER}} .section-title p, {{WRAPPER}} .section-title-2 p, {{WRAPPER}} .section-title-3 p',
            ]
        );

        $this->end_controls_section(); 

        $this->start_controls_section(
            'section_big_text',
            [
                'label' => esc_html__( 'Big Transparent Text', 'modina-core' ),
                'condition' => [
                    'style!' => 'style_3'
                ],
            ]
        );
        
        $this->add_control(
            'big_transparent_text',
            [
                'label' => esc_html__( 'Transparent Heading', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Services',
                'condition' => [
                    'style!' => 'style_3'
                ],
            ]
        );

        $this->add_control(
            'color_big_heading', [
                'label' => esc_html__( 'Big Heading Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_big_heading',
                'selector' => '{{WRAPPER}} .section-title span',
            ]
        );
        
        $this->end_controls_section(); 

        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Section Alignment', 'modina-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => __( 'Alignment', 'modina-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __( 'Left', 'modina-core' ),
                        'icon' => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'modina-core' ),
                        'icon' => 'fas fa-align-center',
                    ],
                    'end' => [
                        'title' => __( 'Right', 'modina-core' ),
                        'icon' => 'fas fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        $this->end_controls_section(); 

    }

    protected function render() {
    $settings = $this->get_settings();
    $section_style = $settings['style'];
    ?>
    <?php if (!empty($settings['heading']) && $section_style == 'style_1' ) : ?>
    <div class="section-title text-<?php echo esc_attr( $settings['text_align'] ); ?>">
        <span><?php echo htmlspecialchars_decode(esc_html($settings['big_transparent_text'])); ?></span>
        <p><?php echo htmlspecialchars_decode(esc_html($settings['sub_heading'])); ?></p>
        <h2><?php echo htmlspecialchars_decode(esc_html($settings['heading'])); ?></h2>
    </div>
    <?php endif; ?>

    <?php if (!empty($settings['heading']) && $section_style == 'style_2' ) : ?>
    <div class="section-title-2 text-<?php echo esc_attr( $settings['text_align'] ); ?>">
        <span><?php echo htmlspecialchars_decode(esc_html($settings['big_transparent_text'])); ?></span>
        <p><?php echo htmlspecialchars_decode(esc_html($settings['sub_heading'])); ?></p>
        <h2><?php echo htmlspecialchars_decode(esc_html($settings['heading'])); ?></h2>
    </div>
    <?php endif; ?>

    <?php if (!empty($settings['heading']) && $section_style == 'style_3' ) : ?>
    <div class="section-title-3 text-<?php echo esc_attr( $settings['text_align'] ); ?>">
        <p><?php echo htmlspecialchars_decode(esc_html($settings['sub_heading'])); ?></p>
        <h2><?php echo htmlspecialchars_decode(esc_html($settings['heading'])); ?></h2>
    </div>
    <?php endif; ?>
    <?php
    }
}