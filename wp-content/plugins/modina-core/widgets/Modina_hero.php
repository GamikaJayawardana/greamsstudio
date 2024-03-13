<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_hero extends Widget_Base {

    public function get_name() {
        return 'modina_hero';
    }

    public function get_title() {
        return esc_html__( 'Hero - Sliders', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_keywords() {
        return [ 'dustrix', 'hero', 'slider', 'carosuel', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

        // -------------------  Title Section  -----------------------//


        $this->start_controls_section(
            'hero_style_select', [
                'label' => __( 'Hero Style - Choice', 'modina-core' ),
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
            'hero_section_heading',
            [
                'label' => esc_html__( 'Slider - Hero', 'modina-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'hero_image', [
                'label' => esc_html__( 'Slide Background Image', 'modina-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => [
                    'url' => plugin_dir_url( __DIR__ ).'assets/img/slide1.jpg',
                ],
            ]
        );

        $repeater->add_control(
            'hero_heading',
            [
                'label' => esc_html__( 'Heading Text', 'modina-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Global Automotive',
            ]
        );

        $repeater->add_control(
            'hero_subtitle',
            [
                'label' => esc_html__( 'Sub Heading Text', 'modina-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Welcome To Dustrix',
            ]
        );

        $repeater->add_control(
            'hero_text',
            [
                'label' => esc_html__( 'Short Text', 'modina-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Dustrix is a construction and architecture environmentally most responsible for any kinds of themes.',
            ]
        );

        $repeater->add_control(
            'button_text1',
            [
                'label' => esc_html__( 'Button Title - Active', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Our Services',                
            ]
        );

        $repeater->add_control(
            'btn_link1',
            [
                'label' => esc_html__( 'Button Link', 'modina-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => __( 'https://', 'modina-core' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $repeater->add_control(
            'button_text2',
            [
                'label' => esc_html__( 'Button Text - Normal', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'learn more',
            ]
        );

        $repeater->add_control(
            'btn_link2',
            [
                'label' => esc_html__( 'Button Link', 'modina-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => __( 'https://', 'modina-core' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'hero_slides',
            [
                'label' => esc_html__( 'All Slides', 'modina-core' ),
                'type' =>Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'hero_image' => [
                            'url' => plugin_dir_url( __DIR__ ).'assets/img/slide1.jpg',
                        ],
                        'hero_heading'   => 'Global Automotive',
                    ],
                ],
                'title_field' => '{{{hero_heading}}}'
            ]
        );

        $this->end_controls_section();

        // Slider Option
        $this->start_controls_section('slider_settings',
            [
                'label' => __('Slider Settings', 'modina-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label' => __( 'Show arrows?', 'modina-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'modina-core' ),
                'label_off' => __( 'Hide', 'modina-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label' => __( 'Show Dots?', 'modina-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'modina-core' ),
                'label_off' => __( 'Hide', 'modina-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Auto Play?', 'modina-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'modina-core' ),
                'label_off' => __( 'Hide', 'modina-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => __( 'Infinite Loop', 'modina-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'modina-core' ),
                'label_off' => __( 'Hide', 'modina-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __( 'Autoplay Timeout', 'modina-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '9000',
                'options' => [
                    '1000'  => __( '1 Second', 'modina-core' ),
                    '2000'  => __( '2 Second', 'modina-core' ),
                    '3000'  => __( '3 Second', 'modina-core' ),
                    '4000'  => __( '4 Second', 'modina-core' ),
                    '5000'  => __( '5 Second', 'modina-core' ),
                    '6000'  => __( '6 Second', 'modina-core' ),
                    '7000'  => __( '7 Second', 'modina-core' ),
                    '8000'  => __( '8 Second', 'modina-core' ),
                    '9000'  => __( '9 Second', 'modina-core' ),
                    '10000' => __( '10 Second', 'modina-core' ),
                    '11000' => __( '11 Second', 'modina-core' ),
                    '12000' => __( '12 Second', 'modina-core' ),
                    '13000' => __( '13 Second', 'modina-core' ),
                    '14000' => __( '14 Second', 'modina-core' ),
                    '15000' => __( '15 Second', 'modina-core' ),
                ],
            ]
        );
        
        $this->end_controls_section();


        $this->start_controls_section(
            'slide_items_style', [
                'label' => esc_html__( 'Slide Style', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_heading', [
                'label' => esc_html__( 'Heading Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-slide .hero-contents h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_heading',
                'selector' => '{{WRAPPER}} .single-slide .hero-contents h1',
            ]
        );

        $this->add_control(
            'color_subheading', [
                'label' => esc_html__( 'Sub Heading Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-slide .hero-contents .sub-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subheading',
                'selector' => '{{WRAPPER}} .single-slide .hero-contents .sub-title h3',
            ]
        );

        $this->add_control(
            'button_color1', [
                'label' => esc_html__( 'Button Text Color - Active', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-slide .hero-contents .theme-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color1', [
                'label' => esc_html__( 'Button Background Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-slide .hero-contents .theme-btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color2', [
                'label' => esc_html__( 'Button Text Color - Normal', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-slide .hero-contents .theme-btn.black' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color2', [
                'label' => esc_html__( 'Button Background Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-slide .hero-contents .theme-btn.black' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Section Color 
        $this->start_controls_section(
            'hero_slide_bg_color',
            [
                'label' => esc_html__( 'Slide Background Color', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'slide_bg_color', [
                'label'   => esc_html__( 'Background Color', 'modina-core' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider .single-slide' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slide_padding_tab', [
                'label' => esc_html__( 'Slide Padding', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slide_padding', [
                'label' => esc_html__( 'Padding', 'modina-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider .single-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
    $hero_slides = $settings['hero_slides'];
    $dynamic_id = rand(123, 456);
    
    if ( $settings['style'] == 'style_1' ) {
        include 'hero/style-one.php';
    }

    if ( $settings['style'] == 'style_2' ) {
        include 'hero/style-two.php';
    }

    
    if ( $settings['style'] == 'style_3' ) {
        include 'hero/style-three.php';
    }

    $arrows = $settings['arrows'] == 'yes' ? 'true' : 'true';
    $dots = $settings['dots'] == 'yes' ? 'true' : 'false';
    $infinite = $settings['infinite'] == 'yes' ? 'true' : 'false';
    $autoplay = $settings['autoplay'] == 'yes' ? 'true' : 'false';
    $autoplaytimeout =  !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '8000';  

    ?>

    <script>
        (function ( $ ) {
            "use strict";
            $(document).ready( function() {
               
                const $owlCarousel =  $(".hero-slider-active.slider-<?php echo $dynamic_id; ?>").owlCarousel({        
                    items: 1,     
                    dots: <?php echo $dots; ?>,
                    loop: <?php echo $infinite; ?>,
                    autoplayTimeout: <?php echo $autoplaytimeout; ?>,
                    autoplay: <?php echo $autoplay; ?>,
                    nav: <?php echo $arrows; ?>,          
                    navText: ['<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>'],
                });
                
                $(".owl-carousel").on("initialized.owl.carousel", () => {
                    setTimeout(() => {
                        $(".owl-item.active .animated-text").addClass("is-transitioned");
                    }, 300);
                });

                $owlCarousel.on("changed.owl.carousel", e => {
                    $(".animated-text").removeClass("is-transitioned");
                    
                    const $currentOwlItem = $(".owl-item").eq(e.item.index);
                    $currentOwlItem.find(".animated-text").addClass("is-transitioned");
                    
                    const $target = $currentOwlItem.find(".hero-contents");
                });

            });
        }( jQuery ));
    </script>

    <?php
    }
}