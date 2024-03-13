<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_project_case_study_showcase extends Widget_Base {

    public function get_name() {
        return 'modina_project_case_study_showcase';
    }

    public function get_title() {
        return esc_html__( 'Projects - Case Study Showcase', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-carousel';
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
            ]
        );

        $repeater->add_control(
            'project_title',
            [
                'label' => esc_html__( 'Project Title', 'modina-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Transland Express Office',
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
            'btn_link',
            [
                'label' => esc_html__( 'Link', 'modina-core' ),
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
                    '{{WRAPPER}} .single-portfolio-item-card h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_project_heading',
                'selector' => '{{WRAPPER}} .single-portfolio-item-card h3',
            ]
        );

        $this->add_control(
            'color_short_text', [
                'label' => esc_html__( 'Project Category Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-portfolio-item-card span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_text_short',
                'selector' => '{{WRAPPER}} .single-portfolio-item-card span',
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
                    '{{WRAPPER}} .single-portfolio-item-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

    $settings = $this->get_settings();
    $project_showcase_list = $settings['project_showcase_list'];
    $dynamic_id = rand(123, 456);

    $infinite = $settings['infinite'] == 'yes' ? 'true' : 'false';
    $autoplay = $settings['autoplay'] == 'yes' ? 'true' : 'false';
    $autoplaytimeout =  !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000';  
    ?>

    <div class="portfolio-item-grid-active carousel-<?php echo $dynamic_id; ?> owl-carousel">
        <?php if (!empty($project_showcase_list)) { $i = 0;
        foreach ($project_showcase_list as $item) { $i++; ?>
        <div class="single-portfolio-item-card">
            <div class="portfolio-thumb bg-center bg-cover" style="background-image: url('<?php echo esc_url($item['project_img']['url']); ?>')"></div>
            <div class="content">
                <span><?php echo htmlspecialchars_decode(esc_html($item['project_cat'])); ?></span>
                <h3><a href="<?php echo esc_url($item['btn_link']['url']); ?>" <?php modina_is_external($item['btn_link']); ?> <?php modina_is_nofollow($item['btn_link']); ?>><?php echo htmlspecialchars_decode(esc_html($item['project_title'])); ?></a></h3>
            </div>
        </div>
        <?php }
         } ?>
    </div>

    <script>
        (function ( $ ) {
            "use strict";
            $(document).ready( function() {
               
                if( $('.portfolio-item-grid-active.carousel-<?php echo $dynamic_id; ?>').length > 0) {
                    $('.portfolio-item-grid-active.carousel-<?php echo $dynamic_id; ?>').owlCarousel({                            
                        loop: <?php echo $infinite; ?>,
                        autoplayTimeout: <?php echo $autoplaytimeout; ?>,
                        autoplay: <?php echo $autoplay; ?>,
                        center: true,
                        responsive : {
                            // breakpoint from 0 up
                            0 : {
                                items: 1,
                            },
                            700 : {
                                items: 2,
                                margin: 30,
                            },                               
                            // breakpoint from 992 up
                            1199 : {
                                items: 3,
                                margin: 40,
                            }
                        }
                    });
                }

            });
        }( jQuery ));
    </script>

    <?php
    }
}