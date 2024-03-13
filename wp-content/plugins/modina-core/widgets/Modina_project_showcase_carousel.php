<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_project_showcase_carousel extends Widget_Base {

    public function get_name() {
        return 'modina_project_showcase_carousel';
    }

    public function get_title() {
        return esc_html__( 'Project Showcase - Carousel', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_keywords() {
        return [ 'dustrix', 'project', 'case study', 'portfolio', 'showcase', 'carosuel', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'carousel_section',
            [
                'label' => esc_html__( 'Project Showcase Card', 'modina-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'project_img', [
                'label' => esc_html__( 'Project Thumb / Image', 'modina-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => [
                    'url' => plugin_dir_url( __DIR__ ).'assets/img/project1.jpg',
                ],
            ]
        );

        $repeater->add_control(
            'project_title',
            [
                'label' => esc_html__( 'Project Title', 'modina-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Leverage agile motive frameworks',
            ]
        );

        $repeater->add_control(
            'project_details',
            [
                'label' => esc_html__( 'Project Short Text', 'modina-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliqui',
            ]
        );

        $repeater->add_control(
            'project_client_name',
            [
                'label' => esc_html__( 'Client Name', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Rosalina D.',
            ]
        );

        $repeater->add_control(
            'project_cat',
            [
                'label' => esc_html__( 'Project / Case Study Category', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Industrial',
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Title', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Case Details',            
            ]
        );

        $repeater->add_control(
            'btn_link',
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
            'project_showcase_list',
            [
                'label' => esc_html__( 'All Project / Case Study', 'modina-core' ),
                'type' =>Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'project_img' => [
                            'url' => plugin_dir_url( __DIR__ ).'assets/img/project1.jpg',
                        ],
                        'project_title'   => 'Leverage agile motive frameworks',
                    ],
                    [
                        'project_img' => [
                            'url' => plugin_dir_url( __DIR__ ).'assets/img/project2.jpg',
                        ],
                        'project_title'   => 'Best Construction WordPress Theme',
                    ],
                ],
                'title_field' => '{{{project_title}}}'
            ]
        );

        $this->end_controls_section();

        // Slider Option
        $this->start_controls_section('carousel_settings',
            [
                'label' => __('Carousel Settings', 'modina-core'),
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
                'default' => '8000',
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
            'project_items_style', [
                'label' => esc_html__( 'Project / Case Study Style', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_project_heading', [
                'label' => esc_html__( 'Project Title Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-project .project-details h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_project_heading',
                'selector' => '{{WRAPPER}} .single-project .project-details h2',
            ]
        );

        $this->add_control(
            'color_short_text', [
                'label' => esc_html__( 'Project Text Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-project .project-details p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_text_short',
                'selector' => '{{WRAPPER}} .single-project .project-details p',
            ]
        );

        $this->add_control(
            'button_color', [
                'label' => esc_html__( 'Button Text Color - Active', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-project .project-details .read-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color', [
                'label' => esc_html__( 'Button Background Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-project .project-details .read-btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Section Color 
        $this->start_controls_section(
            'project_card_bg',
            [
                'label' => esc_html__( 'Project Card BG Color', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'project_card_bg_color', [
                'label'   => esc_html__( 'Background Color', 'modina-core' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .single-project .project-contents' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

    $settings = $this->get_settings();
    $project_showcase_list = $settings['project_showcase_list'];
    $dynamic_id = rand(123, 456);

    $arrows = $settings['arrows'] == 'yes' ? 'true' : 'true';
    $dots = $settings['dots'] == 'yes' ? 'true' : 'false';
    $infinite = $settings['infinite'] == 'yes' ? 'true' : 'false';
    $autoplay = $settings['autoplay'] == 'yes' ? 'true' : 'false';
    $autoplaytimeout =  !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '8000';  

    ?>
    <div class="project-wrapper">
        <div class="portfolio-carousel-active carousel-<?php echo $dynamic_id; ?> owl-carousel">
        <?php if (!empty($project_showcase_list)) { $i = 0;
        foreach ($project_showcase_list as $item) { $i++; ?>
            <div class="single-project">
                <div class="project-contents">
                    <div class="row">
                        <div class="project-details col-lg-4 offset-lg-1 ps-lg-0 order-2 order-lg-1 col-12">
                            <div class="project-meta">
                                <span class="project-cat"><?php echo htmlspecialchars_decode(esc_html($item['project_cat'])); ?></span>
                                <div class="client-info d-inline">
                                    <span><i class="fal fa-user"></i> <?php echo esc_html__('Client', 'modina-core'); ?> :</span> <?php echo htmlspecialchars_decode(esc_html($item['project_client_name'])); ?>
                                </div>
                            </div>
                            <h2><?php echo htmlspecialchars_decode(esc_html($item['project_title'])); ?></h2>
                            <p><?php echo htmlspecialchars_decode(esc_html($item['project_details'])); ?></p>
                            <?php if( !empty( $item['btn_link']['url'] && $item['button_text'] ) ) : ?>
                            <a href="<?php echo esc_url($item['btn_link']['url']); ?>" <?php modina_is_external($item['btn_link']); ?> <?php modina_is_nofollow($item['btn_link']); ?> class="read-btn theme-btn"><?php echo esc_html( $item['button_text'] ); ?> <i class="fal fa-long-arrow-right"></i></a>
                            <?php endif; ?>
                        </div>
                        <div class="project-thumbnail col-lg-5 offset-lg-1 p-lg-0 order-1 order-lg-2 col-12">
                            <a href="<?php echo esc_url($item['project_img']['url']); ?>" class="popup-gallery bg-cover" style="background-image: url('<?php echo esc_url($item['project_img']['url']); ?>')"></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
         } ?>
        </div>

        <div class="project-carousel-nav"></div>
    </div>

    <script>
        (function ( $ ) {
            "use strict";
            $(document).ready( function() {
               
                if( $('.portfolio-carousel-active.carousel-<?php echo $dynamic_id; ?>').length > 0) {
                    $('.portfolio-carousel-active.carousel-<?php echo $dynamic_id; ?>').owlCarousel({                        
                        items: 1,     
                        dots: <?php echo $dots; ?>,
                        loop: <?php echo $infinite; ?>,
                        autoplayTimeout: <?php echo $autoplaytimeout; ?>,
                        autoplay: <?php echo $autoplay; ?>,
                        nav: <?php echo $arrows; ?>,
                        navText: ['<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>'],
                        navContainer: '.project-wrapper .project-carousel-nav',   
                    });
                }

            });
        }( jQuery ));
    </script>

    <?php
    }
}