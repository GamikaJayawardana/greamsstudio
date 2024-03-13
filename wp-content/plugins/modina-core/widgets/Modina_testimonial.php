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


class Modina_testimonial extends Widget_Base
{

    public function get_name()
    {
        return 'modina_testimonial';
    }

    public function get_title()
    {
        return esc_html__('Testimonials Card', 'modina-core');
    }

    public function get_icon()
    {
        return 'eicon-testimonial';
    }

    public function get_keywords()
    {
        return ['testimonial', 'review', 'client', 'feedback', 'modina'];
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
                        'client_position'   => 'Founder & CEO',
                        'client_feedback'   => 'Great experience and impressive product. It was a very professional and technically competent job from the whole team.',
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
        <div class="row">
        <?php if (!empty($all_testimonial)) { $i = 0;
            foreach ($all_testimonial as $item) { $i++; ?>
            <div class="col-md-6 col-xl-4 col-12">
                <div class="single-testimonial-card text-center">
                    <?php if( !empty($item['client_img']['url'] ) ) : ?>
                    <div class="client-img bg-cover bg-center" style="background-image: url('<?php echo esc_url($item['client_img']['url']); ?>')"></div>
                    <?php endif; ?>
                    <?php if( !empty($item['client_name'] ) ) : ?>
                    <div class="client-info">
                        <h4><?php echo htmlspecialchars_decode(esc_html($item['client_name'])); ?></h4>
                        <span><?php echo htmlspecialchars_decode(esc_html($item['client_position'])); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if( !empty($item['client_feedback'] ) ) : ?>
                    <div class="feedback">
                        <p><?php echo htmlspecialchars_decode(esc_html($item['client_feedback'])); ?></p>
                        <?php if (!empty($item['rating']['size'])) : ?>
                        <div class="star">
                            <?php echo $this->rating_render($item['rating']['size']); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php }
        } ?>
        </div>
    <?php endif; ?>
<?php
    }
}
