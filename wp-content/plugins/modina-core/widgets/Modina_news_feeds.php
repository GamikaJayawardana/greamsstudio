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


class Modina_news_feeds extends Widget_Base
{

    public function get_name()
    {
        return 'modina_news_feeds';
    }

    public function get_title()
    {
        return esc_html__('News Feeds', 'modina-core');
    }

    public function get_icon()
    {
        return 'eicon-info-box';
    }

    public function get_keywords()
    {
        return ['blog', 'post', 'article', 'news', 'latest', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

         // ------------------- layout select  -----------------------//

        $this->start_controls_section(
            'news_style_select', [
                'label' => __( 'Blog Layout - Choice', 'modina-core' ),
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
            'content_length',
            [
                'label' => esc_html__('Content Length', 'modina-core'),
                'type' => Controls_Manager::NUMBER,
                'step' => 1,
                'default' => 12,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_read_more_btn',
            [
                'label' => esc_html__('Show Read More Button?', 'modina-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'read_more_txt',
            [
                'label' => esc_html__('Read More Button Text', 'modina-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'modina-core'),
                'placeholder' => esc_html__('Read More', 'modina-core'),
                'condition' => [
                    'show_read_more_btn' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
   
        //--------------- Latest Post Style Section ---------

        $this->start_controls_section(
            'style_tab_latest_post',
            [
                'label' => esc_html__('Latest News', 'modina-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Color
        $this->add_control(
            'latest_post_title_color',
            [
                'label' => esc_html__('Title Color', 'modina-core'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .single-news-box h3, {{WRAPPER}} .single-news-card h5, {{WRAPPER}} .single-blog-item h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Title Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'latest_post_title_typo',
                'selector' => '{{WRAPPER}} .single-news-box h3, {{WRAPPER}} .single-news-card h5, {{WRAPPER}} .single-blog-item h3',
            ]
        );

        // Button Color
        $this->add_control(
            'latest_post_button_color',
            [
                'label' => esc_html__('Button Color', 'modina-core'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .single-news-box .read-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Button Hover Color
        $this->add_control(
            'latest_post_button_h_color',
            [
                'label' => esc_html__('Button Hover Color', 'modina-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-news-box .read-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

    $settings = $this->get_settings();

    if ( $settings['style'] == 'style_1' ) {
        include 'blog/style-one.php';
    }

    if ( $settings['style'] == 'style_2' ) {
        include 'blog/style-two.php';
    }

    if ( $settings['style'] == 'style_3' ) {
        include 'blog/style-three.php';
    }

    }
}
