<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_skillbar extends Widget_Base {

    public function get_name() {
        return 'modina_skillbar';
    }

    public function get_title() {
        return esc_html__( 'Skill Progress Bar', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-skill-bar';
    }

    public function get_keywords() {
        return [ 'skill', 'progressbar', 'funfact', 'bar', 'counter', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

        // ----- service Item Box ---------//
        $this->start_controls_section(
            'skills_section',
            [
                'label' => esc_html__( 'Skill Progress Bars', 'modina-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'skill_title',
            [
                'label' => esc_html__( 'Skill Title', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Construction',
            ]
        );

        $repeater->add_control(
            'skill_bar_percent',
            [
                'label' => esc_html__( 'Skill Percent?', 'modina-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => '90',
            ]
        );
        
        $this->add_control(
            'skill_items',
            [
                'label' => esc_html__( 'All Skill Circle', 'modina-core' ),
                'type' =>Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'skill_title'   => 'Construction',
                    ],
                ],
                'title_field' => '{{{skill_title}}}'
            ]
        );

        $this->end_controls_section();        

        $this->start_controls_section(
            'style_skill_item', [
                'label' => esc_html__( 'Skill Bar Style', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            's_color_title', [
                'label' => esc_html__( 'Skill Title Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-progress-bar h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_skill_title',
                'selector' => '{{WRAPPER}} .single-progress-bar h5',
            ]
        );

        $this->add_control(
            'bar_percent-_text_color', [
                'label' => esc_html__( 'Progress Percent Text Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-progress-bar span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bar_fil_color_bg', [
                'label' => esc_html__( 'Progress Percent Bar Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-progress-bar .progress .progress-bar' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bar_color_bg', [
                'label' => esc_html__( 'Progress Bar Background', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-progress-bar .progress' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bar_item_margin', [
                'label' => esc_html__( 'Progress Bar Margin', 'modina-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .single-progress-bar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
    $skill_items = $settings['skill_items'];
    ?>
        <div class="skill-wrapper">
        <?php
        if (!empty($skill_items)) { $i = 0;
            foreach ($skill_items as $item) { $i++; ?> 
            <div class="single-progress-bar">
                <div class="title justify-content-between d-flex align-items-center">
                    <h5><?php echo esc_html($item['skill_title']); ?></h5>
                    <span class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay="1s"><?php echo esc_attr( $item['skill_bar_percent'] ); ?><?php echo esc_html( '%' ); ?></span>
                </div>
                <div class="progress">
                    <div class="progress-bar wow fadeInLeft" data-wow-duration="2s" data-wow-delay=".1s" role="progressbar" style="width: <?php echo esc_attr( $item['skill_bar_percent'] ); ?>%;"></div>
                </div>
            </div>
            <?php } 
        } ?>
        </div>
    <?php
    }
}