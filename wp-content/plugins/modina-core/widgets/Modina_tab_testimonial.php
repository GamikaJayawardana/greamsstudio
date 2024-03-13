<?php

namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}


class Modina_tab_testimonial extends Widget_Base
{

    public function get_name()
    {
        return 'modina_tab_testimonial';
    }

    public function get_title()
    {
        return esc_html__('Testimonials - Tabs', 'modina-core');
    }

    public function get_icon()
    {
        return ' eicon-post-list';
    }

    public function get_keywords()
    {
        return ['testimonial', 'review', 'client', 'tab', 'feedback', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {


         // -------------------  Title Section  -----------------------//
        $this->start_controls_section(
            'section_contents',
            [
                'label' => esc_html__( 'Testimonials', 'modina-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'client_img', [
                'label' => esc_html__( 'Client Image', 'modina-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => [
                    'url' => plugin_dir_url( __DIR__ ).'assets/img/client1.jpg',
                ],
            ]
        );

        $repeater->add_control(
            'client_name',
            [
                'label' => esc_html__( 'Client Name', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'client_position',
            [
                'label' => esc_html__( 'Client Position - Level', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'client_feedback',
            [
                'label' => esc_html__( 'Client Feedback - Review', 'modina-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'rating',
            [
                'label' => __('Rating', 'modina-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => .5,
                    ],
                ],
                'default' => [
                    'size' => 5,
                ]
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Title - Active', 'modina-core' ),
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
            'all_testimonial',
            [
                'label' => esc_html__( 'All Testimonial', 'modina-core' ),
                'type' =>Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'client_img' => [
                            'url' => plugin_dir_url( __DIR__ ).'assets/img/client1.jpg',
                        ],
                        'client_name'   => 'Thomas Smith',
                        'client_position'   => 'Founder, Romada Co.',
                        'client_feedback'   => 'The average national hourly rate for house cleaning services is $25 to $90 per individual, or $50 to $90 per hour. The size and condition of your home will strongly impact.',
                    ],
                ],
                'title_field' => '{{{client_name}}}'
            ]
        );

        $this->end_controls_section(); 

    }

    protected function rating_render($value = '') {
        $ratefull = '<span class="fas fa-star"></span>';
        $ratehalf = '<span class="fas fa-star-half-alt"></span>';
        $rateO = '<span class="far fa-star"></span>';

        if ($value > 4.75) {
            return $ratefull . $ratefull . $ratefull . $ratefull . $ratefull;
        } elseif ($value <= 4.75 && $value > 4.25) {
            return $ratefull . $ratefull . $ratefull . $ratefull . $ratehalf;
        } elseif ($value <= 4.25 && $value > 3.75) {
            return $ratefull . $ratefull . $ratefull . $ratefull . $rateO;
        } elseif ($value <= 3.75 && $value > 3.25) {
            return $ratefull . $ratefull . $ratefull . $ratehalf . $rateO;
        } elseif ($value <= 3.25 && $value > 2.75) {
            return $ratefull . $ratefull . $ratefull . $rateO . $rateO;
        } elseif ($value <= 2.75 && $value > 2.25) {
            return $ratefull . $ratefull . $ratehalf . $rateO . $rateO;
        } elseif ($value <= 2.25 && $value > 1.75) {
            return $ratefull . $ratefull . $rateO . $rateO . $rateO;
        } elseif ($value <= 1.75 && $value > 1.25) {
            return $ratefull . $ratehalf . $rateO . $rateO . $rateO;
        } elseif ($value <= 1.25) {
            return $ratefull . $rateO . $rateO . $rateO . $rateO;
        }
    }


    protected function render() {

    $settings = $this->get_settings();
    $all_testimonial = $settings['all_testimonial'];
    ?>
    
    <?php if (!empty($all_testimonial)) : ?>
        <div class="row testimonial-tabs-wrapper">
            <div class="col-xl-3 p-xl-0 order-2 order-xl-1">
                <div class="testimonial-nav">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php if (!empty($all_testimonial)) { $i = 0;
                        foreach ($all_testimonial as $item) { $i++; ?>
                        <button class="nav-link <?=($i == 1) ? 'active' : ''?>" id="reviewid<?php echo esc_attr($i); ?>" data-bs-toggle="pill" data-bs-target="#testimonial<?php echo esc_attr($i); ?>" type="button" role="tab" aria-controls="reviewid<?php echo esc_attr($i); ?>">
                            <div class="single-client-tab">
                                <?php if( !empty($item['client_img']['url'] ) ) : ?>
                                <div class="profile-img bg-cover" style="background-image: url('<?php echo esc_url($item['client_img']['url']); ?>')"></div>
                                <?php endif; ?>
                                <div class="client-info">
                                    <h3><?php echo htmlspecialchars_decode(esc_html($item['client_name'])); ?></h3>
                                    <p><?php echo htmlspecialchars_decode(esc_html($item['client_position'])); ?></p>
                                </div>
                            </div>
                        </button>
                        <?php }
                    } ?>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 ps-xl-5 order-1 order-xl-2">
                <div class="testimonial-contents">
                    <div class="tab-content" id="v-pills-tabContent">
                    <?php if (!empty($all_testimonial)) { $i = 0;
                    foreach ($all_testimonial as $item) { $i++; ?>
                        <div class="tab-pane fade <?=($i == 1) ? 'active show' : ''?>" id="testimonial<?php echo esc_attr($i); ?>" role="tabpanel">
                            <div class="single-testimonial-content align-items-center">
                                <?php if( !empty($item['client_img']['url'] ) ) : ?>
                                <div class="engginer-img">
                                    <img src="<?php echo esc_url($item['client_img']['url']); ?>" alt="">
                                </div>
                                <?php endif; ?>
                                <div class="content">
                                    <?php if (!empty($item['rating']['size'])) : ?>
                                    <div class="rating-star">
                                        <?php echo $this->rating_render($item['rating']['size']); ?>
                                    </div>
                                    <?php endif; ?>
                                    <h3><?php echo htmlspecialchars_decode(esc_html($item['client_feedback'])); ?></h3>
                                    <?php if( !empty( $item['btn_link']['url'] && $item['button_text'] ) ) : ?>
                                    <a href="<?php echo esc_url($item['btn_link']['url']); ?>" <?php modina_is_external($item['btn_link']); ?> <?php modina_is_nofollow($item['btn_link']); ?> class="theme-btn theme-2"><?php echo esc_html( $item['button_text'] ); ?> <i class="fal fa-long-arrow-right"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php }
                    } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php
    }
}
