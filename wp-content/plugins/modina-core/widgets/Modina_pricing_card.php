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


class Modina_pricing_card extends Widget_Base
{

    public function get_name()
    {
        return 'Modina_pricing_card';
    }

    public function get_title()
    {
        return esc_html__('Pricing Card', 'modina-core');
    }

    public function get_icon()
    {
        return 'eicon-price-table';
    }

    public function get_keywords()
    {
        return ['price', 'plan', 'package', 'table', 'card', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {


         // -------------------  Title Section  -----------------------//
        $this->start_controls_section(
            'section_contents',
            [
                'label' => esc_html__( 'Package - Pricing Card', 'modina-core' ),
            ]
        );

        $this->add_control(
            'package_name', [
                'label' => esc_html__( 'Plan Name', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Basic Plan',
            ]
        );

        $this->add_control(
            'package_types',
            [
                'label' => __( 'Plan Time - Types', 'modina-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => 'monthly',
                'options' => [
                    'monthly'  => __( 'Monthly', 'modina-core' ),
                    'yearly'  => __( 'Yearly', 'modina-core' ),
                ],
            ]
        );

        $this->add_control(
            'package_price',
            [
                'label' => esc_html__( 'Package Price - Value', 'modina-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => '590',
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => __( 'Currency', 'modina-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '$',
                'options' => [
                    '$'  => __( '$', 'modina-core' ),
                    '€'  => __( '€', 'modina-core' ),
                    '£'  => __( '£', 'modina-core' ),
                ],
            ]
        );
        
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Your Order Done',                 
            ]
        );

        $this->add_control(
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
            'active',
            [
                'label' => __( 'Package Bar Active?', 'modina-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'modina-core' ),
                'label_off' => __( 'No', 'modina-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'plan_bg',
            [
                'label' => esc_html__( 'Plan Hover Image - BG', 'modina-core' ),
                'type' =>Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]             
            ]
        );

        $this->end_controls_section();

        
        $this->start_controls_section(
            'style_plan_card', [
                'label' => esc_html__( 'Plan Item Style', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'p_color_price', [
                'label' => esc_html__( 'Package Price Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-pricing-table .price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_plan_pricing',
                'selector' => '{{WRAPPER}} .single-pricing-table .price',
            ]
        );

        $this->add_control(
            'plan_color_name', [
                'label' => esc_html__( 'Plan Name  Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-pricing-table .package-name h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_plan_name',
                'selector' => '{{WRAPPER}} .single-pricing-table .package-name h3',
            ]
        );

        $this->add_control(
            'p_color_btn', [
                'label' => esc_html__( 'Button Text Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-pricing-table .package-btn .theme-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'p_bg_color_btn', [
                'label' => esc_html__( 'Button Background Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-pricing-table .package-btn .theme-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_plan_btn',
                'selector' => '{{WRAPPER}} .single-pricing-table .package-btn .theme-btn',
            ]
        );

        $this->end_controls_section();

        // ----- Features Items ---------//
        $this->start_controls_section(
            'plan_features_section',
            [
                'label' => esc_html__( 'Plan Features List', 'modina-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'feature_title',
            [
                'label' => esc_html__( 'Features Name', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Objectively integrate competencies',
            ]
        );
        
        $this->add_control(
            'plan_features_list',
            [
                'label' => esc_html__( 'All Plan Features', 'modina-core' ),
                'type' =>Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'feature_title'   => 'Objectively integrate competencies',
                    ],
                    [
                        'feature_title'   => 'Process-centric communities',
                    ],
                    [
                        'feature_title'   => 'Emasculate holistic innovation',
                    ],
                    [
                        'feature_title'   => 'Incubate intuitive opportunities',
                    ],
                ],
                'title_field' => '{{{feature_title}}}'
            ]
        );

        $this->end_controls_section();        

        $this->start_controls_section(
            'style_plan_features_item', [
                'label' => esc_html__( 'Pricing Features Style', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'features_color_name', [
                'label' => esc_html__( 'Title Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-pricing-table ul li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_plane_features_title',
                'selector' => '{{WRAPPER}} .single-pricing-table ul li',
            ]
        );

        $this->add_control(
            'features_color_icon', [
                'label' => esc_html__( 'Title Icon Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-pricing-table ul li::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

    $settings = $this->get_settings();
    $all_package = $settings['plan_features_list'];
    ?>
        <div class="single-pricing-table bg-cover <?php if( !empty( $settings['active'] ) && $settings['active'] == 'yes' ) : ?> active <?php endif; ?>" style="background-image: url('<?php echo esc_url($settings['plan_bg']['url']); ?>')">
            <div class="price">
            <?php echo esc_html($settings['currency']); ?><span><?php echo esc_html($settings['package_price']); ?></span><?php echo esc_html__( '.00', 'modina-core' ); ?>
            </div>
            <div class="package-name">
                <h3><?php echo esc_html($settings['package_name']); ?></h3>
                <span><?php echo esc_html($settings['package_types']); ?></span>
            </div>
            <ul>
                <?php if (!empty($all_package)) { $i = 0;
                foreach ($all_package as $item) { $i++; ?>
                    <li><?php echo htmlspecialchars_decode(esc_html($item['feature_title'])); ?></li>
                <?php }
                } ?>
            </ul>
            <?php if( !empty( $settings['btn_link']['url'] && $settings['button_text'] ) ) : ?>
            <div class="package-btn">
                <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" <?php modina_is_external($settings['btn_link']); ?> <?php modina_is_nofollow($settings['btn_link']); ?> class="theme-btn black"><?php echo esc_html( $settings['button_text'] ); ?> <i class="fal fa-long-arrow-right"></i></a>
            </div>
            <?php endif; ?>
        </div>
    
    <?php
    }
}
