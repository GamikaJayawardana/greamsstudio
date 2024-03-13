<?php

namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use WP_Query;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}


class Modina_recent_post_list extends Widget_Base
{

    public function get_name()
    {
        return 'modina_recent_post_list';
    }

    public function get_title()
    {
        return esc_html__('Recent Post List', 'modina-core');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_keywords()
    {
        return ['blog', 'post', 'recent', 'list', 'news', 'latest', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

         // ------------------- layout select  -----------------------//

        $this->start_controls_section(
            'post_style_select', [
                'label' => __( 'List View - Choice', 'modina-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_1' => esc_html__( 'Style One', 'modina-core' ),
                ],
                'default' => 'style_1'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_content_option',
            [
                'label' => __('Post Options', 'modina-core'),
            ]
        );

        $this->add_control(
            'post_limit',
            [
                'label' => __('How many posts want to show?', 'modina-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_post_date',
            [
                'label' => esc_html__('Show Post Date?', 'modina-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
   
        //--------------- Recent Post Style Section ---------

        $this->start_controls_section(
            'style_tab_recent_post',
            [
                'label' => esc_html__('Recent Post List', 'modina-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Color
        $this->add_control(
            'recent_post_title_color',
            [
                'label' => esc_html__('Title Color', 'modina-core'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .single-recent-post h5, {{WRAPPER}} .single-news-card h5, {{WRAPPER}} .single-blog-item h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Title Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'latest_post_title_typo',
                'selector' => '{{WRAPPER}} .single-recent-post h5, {{WRAPPER}} .single-news-card h5, {{WRAPPER}} .single-blog-item h5',
            ]
        );

        // Button Color
        $this->add_control(
            'latest_post_date_color',
            [
                'label' => esc_html__('Date Color', 'modina-core'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .single-recent-post .post-data span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

    $settings = $this->get_settings();

    if ( $settings['style'] == 'style_1' ) {
        include 'recent/style-one.php';
    }

    }
}
