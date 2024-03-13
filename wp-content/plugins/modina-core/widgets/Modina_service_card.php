<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_service_card extends Widget_Base {

    public function get_name() {
        return 'modina_service_card';
    }

    public function get_title() {
        return esc_html__( 'Service Box Card', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_keywords() {
        return [ 'service', 'power', 'construction', 'card', 'factory', 'we do', 'modina'];
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
            'service_bg',
            [
                'label' => esc_html__( 'Image', 'modina-core' ),
                'type' =>Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugin_dir_url( __DIR__ ).'assets/img/service1.jpg',
                ],              
            ]
        );

        $repeater->add_control(
            'flaticon',
            [
                'label'      => __( 'Flaticon', 'modina-core' ),
                'type'       => Controls_Manager::ICON,
                'options'    => modina_flaticons(),
                'include'    => modina_include_flaticons(),
                'default'    => 'flaticon-blueprint-1',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label' => esc_html__( 'Service Title', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Quick Coordinate E-business',
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

        $repeater->add_control(
            'service_active',
            [
                'label' => esc_html__('Active / Hover Effect', 'modina-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'label_block' => true,
                'default' => 'no',
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
                        'service_title'   => 'Quick Coordinate E-business',
                    ],
                    [
                        'service_title'   =>  'Power & Energy Sector',
                        'flaticon'        =>  'flaticon-electricity',
                    ],
                    [
                        'service_title'   => 'Mechanical Engineering',
                        'flaticon'        =>  'flaticon-engineering',
                    ],
                    [
                        'service_title'   => 'Fuel & Gas Management',
                        'flaticon'        =>  'flaticon-gas-station',
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
                    '{{WRAPPER}} .single-our-service h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            's_item_margin', [
                'label' => esc_html__( 'Service Item Margin', 'modina-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .single-our-service' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                'selector' => '{{WRAPPER}} .single-our-service h3',
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
        <div class="col-md-6 col-xl-3 col-12">
            <div class="single-service-item service-1 <?php if( !empty( $item['service_active'] ) && $item['service_active'] == 'yes' ) : ?> active <?php endif; ?>">
                <div class="service-bg bg-cover" style="background-image: url('<?php echo esc_url($item['service_bg']['url']); ?>')"></div>
                <?php if(!empty($item['flaticon'])) : ?>
                <div class="icon">
                    <i class="<?php echo esc_attr( $item['flaticon'] ); ?>"></i>
                </div>
                <?php endif; ?>
                <h3><?php echo esc_html($item['service_title']) ?></h3>
                <a href="<?php echo esc_url($item['btn_link']['url']); ?> <?php modina_is_external($item['btn_link']); ?> <?php modina_is_nofollow($item['btn_link']); ?>"><span><?php echo esc_html($item['btn_text']); ?></span><i class="fal fa-long-arrow-right"></i></a>
            </div>
        </div>
        <?php } 
    } ?>
    </div>

    <?php
    }
}