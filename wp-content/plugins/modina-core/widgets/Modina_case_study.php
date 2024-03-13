<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use WP_Query;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_case_study extends Widget_Base {

    public function get_name() {
        return 'modina_case_study';
    }

    public function get_title() {
        return esc_html__( 'Case Study - Carousel', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-carousel';
    }

    public function get_keywords() {
        return [ 'dustrix', 'project', 'case study', 'portfolio', 'masonry', 'filter', 'carousel', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

        // ---------------------------- Filtering ----------
        $this->start_controls_section(
            'portfolio_filter',
            [
                'label' => __('Case Study Settings', 'modina-core'),
            ]
        );

        $this->add_control(
            'item_show',
            [
                'label' => esc_html__('How many item shows', 'modina-core'),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => '3'
            ]
        );

        $this->add_control(
            'item_order',
            [
                'label' => esc_html__('Select Your Order.', 'modina-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
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
                    '{{WRAPPER}} .single-cause-item .cause-content h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_project_heading',
                'selector' => '{{WRAPPER}} .single-cause-item .cause-content h4',
            ]
        );

        $this->add_control(
            'color_short_text', [
                'label' => esc_html__( 'Project Client & Price Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cause-item .cause-content .cause-meta' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_text_short',
                'selector' => '{{WRAPPER}} .single-cause-item .cause-content .cause-meta',
            ]
        );

        $this->add_control(
            'button_color', [
                'label' => esc_html__( 'Button Text Color - Active', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cause-item:hover .cause-bg .icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color', [
                'label' => esc_html__( 'Button Background Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-cause-item:hover .cause-bg .icon' => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .single-cause-item .cause-bg::before, {{WRAPPER}} .single-cause-item .cause-content' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

    $settings = $this->get_settings();

    $portfolios = new WP_Query(array(
        'post_type'     => 'portfolio',
        'posts_per_page' => $settings['item_show'],
        'order'     => $settings['item_order']
    ));

    $item_show = $settings['item_show'];

    ?>
    
    <div class="portfolio-carousel-wrapper owl-carousel">

        <?php 
            while ($portfolios->have_posts()) : $portfolios->the_post();

            $client_name = get_field('client_name');   
            $project_total_cost = get_field('project_total_cost'); 
        ?>
        <div class="single-project-item">
            <div class="project-thumb bg-cover" style="background-image: url('<?php the_post_thumbnail_url('full'); ?>')"></div>
            <div class="project-details">
                <a href="<?php the_permalink(); ?>" class="icon"><i class="fal fa-long-arrow-right"></i></a>
                <div class="meta">
                    <span><?php echo esc_html( $client_name ); ?></span> | <span> <?php echo esc_html__('$', 'modina-core'); ?><?php echo esc_html( $project_total_cost ); ?></span>
                </div>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </div>
        </div>
        <?php endwhile;
            wp_reset_postdata();
        ?>
    </div>

    <script>
        (function ( $ ) {
            "use strict";
            $(document).ready( function() {
                if( $('.portfolio-carousel-wrapper').length > 0) {
                    $(".portfolio-carousel-wrapper").owlCarousel({ 
                        center: true,      
                        margin: 50,      
                        dots: false,
                        loop: true,
                        items: <?php echo $item_show; ?>,
                        autoplayTimeout: 8000,
                        autoplay:true,
                        nav: false,
                        responsive : {
                            0 : {
                                items: 1,
                            },
                            767 : {
                                items: 1
                            },                
                            991 : {
                                items: 2
                            },
                            1199 : {
                                items: 3
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