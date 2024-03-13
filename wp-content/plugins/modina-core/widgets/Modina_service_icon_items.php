<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_service_icon_items extends Widget_Base {

    public function get_name() {
        return 'Modina_service_icon_items';
    }

    public function get_title() {
        return esc_html__( 'Service Info Item', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_keywords() {
        return [ 'service', 'info', 'item', 'card', 'icon', 'we do', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

        // ----- service Item Box ---------//
        $this->start_controls_section(
            'services_section',
            [
                'label' => esc_html__( 'Services', 'modina-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'flaticon',
            [
                'label'      => __( 'Flaticon', 'modina-core' ),
                'type'       => Controls_Manager::ICON,
                'options'    => modina_flaticons(),
                'include'    => modina_include_flaticons(),
                'default'    => 'fal fa-user-hard-hat',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label' => esc_html__( 'Service Title', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Engineering',
            ]
        );

        $repeater->add_control(
            'service_text',
            [
                'label' => esc_html__( 'Service Short Text', 'modina-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Construction is a general term meaning the art and science to form objects systems organizations',
            ]
        );

        $repeater->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'learn more',
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
            'service_items',
            [
                'label' => esc_html__( 'Our Services', 'modina-core' ),
                'type' =>Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'service_title'   => 'Engineering',
                    ],
                ],
                'title_field' => '{{{service_title}}}'
            ]
        );

        $this->end_controls_section();        

        $this->start_controls_section(
            'style_service_item', [
                'label' => esc_html__( 'Service Item Style', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            's_color_title', [
                'label' => esc_html__( 'Service Title Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-service-icon-box h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            's_color_text', [
                'label' => esc_html__( 'Service Text Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-service-icon-box p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            's_item_margin', [
                'label' => esc_html__( 'Service Item Margin', 'modina-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .single-service-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'default' => [
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_service_title',
                'selector' => '{{WRAPPER}} .single-service-icon-box h3',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

    $settings = $this->get_settings();
    $service_items = $settings['service_items'];
    ?>

    <div class="row">
    <?php
    if (!empty($service_items)) { $i = 0;
        foreach ($service_items as $item) { $i++; ?> 
        <div class="col-lg-4 col-md-6 col-12">
            <div class="single-service-icon-box">
                <?php if(!empty($item['flaticon'])) : ?>
                <div class="icon">
                    <i class="<?php echo esc_attr( $item['flaticon'] ); ?>"></i>
                </div>
                <?php endif; ?>
                <div class="contents">
                    <h3><?php echo esc_html($item['service_title']) ?></h3>
                    <p><?php echo esc_html($item['service_text']) ?></p>
                    <a href="<?php echo esc_url($item['btn_link']['url']); ?> <?php modina_is_external($item['btn_link']); ?> <?php modina_is_nofollow($item['btn_link']); ?>"><span><?php echo esc_html($item['btn_text']); ?></span><i class="fal fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <?php } 
    } ?>
    </div>

    <?php
    }
}