<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_icons extends Widget_Base {

    public function get_name() {
        return 'modina_icons';
    }

    public function get_title() {
        return esc_html__( 'Flaticon - Icon', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-favorite';
    }

    public function get_keywords() {
        return [ 'icon', 'flaticon', 'custom', 'font', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

        // ----- service Item Box ---------//
        $this->start_controls_section(
            'icon_section',
            [
                'label' => esc_html__( 'Icons - Flaticon', 'modina-core' ),
            ]
        );

        $this->add_control(
            'flaticon',
            [
                'label'      => __( 'Flaticon', 'modina-core' ),
                'type'       => Controls_Manager::ICON,
                'options'    => modina_flaticons(),
                'include'    => modina_include_flaticons(),
                'default'    => 'flaticon-truck-2',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'icons_color', [
                'label' => esc_html__( 'Icon Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_icon_style',
                'selector' => '{{WRAPPER}} .icon',
            ]
        );

        $this->end_controls_section();
        

    }

    protected function render() {

    $settings = $this->get_settings();
    $icon = $settings['flaticon'];

    ?>
        <?php if(!empty($icon)) : ?>
        <div class="icon">
            <i class="<?php echo esc_attr( $icon ); ?>"></i>
        </div>
        <?php endif; ?>
    <?php
    }
}