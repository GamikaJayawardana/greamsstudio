<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_card_item extends Widget_Base {

    public function get_name() {
        return 'modina_card_item';
    }

    public function get_title() {
        return esc_html__( 'Approach - Services Card', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_keywords() {
        return [ 'service', 'approach', 'features', 'card', 'block', 'we do', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

        // ----- Card Item Box ---------//
        $this->start_controls_section(
            'card_section',
            [
                'label' => esc_html__( 'Card Item', 'modina-core' ),
            ]
        );

        $this->add_control(
            'card_bg',
            [
                'label' => esc_html__( 'Image', 'modina-core' ),
                'type' =>Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],              
            ]
        );

        $this->add_control(
            'flaticon',
            [
                'label'      => __( 'Flaticon', 'modina-core' ),
                'type'       => Controls_Manager::ICON,
                'options'    => modina_flaticons(),
                'include'    => modina_include_flaticons(),
                'default'    => 'flaticon-sketch',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'card_title',
            [
                'label' => esc_html__( 'Card Title', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Our Vision',
            ]
        );

        
        $this->add_control(
            'card_text',
            [
                'label' => esc_html__( 'Card Text', 'modina-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod.',
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'read more',
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

        $this->end_controls_section();        

        $this->start_controls_section(
            'style_card_item', [
                'label' => esc_html__( 'Card Item Style', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            's_color_title', [
                'label' => esc_html__( 'Title Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-card-item h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sp_color_text', [
                'label' => esc_html__( 'Text Color', 'modina-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-card-item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            's_item_margin', [
                'label' => esc_html__( 'Card Item Margin', 'modina-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .single-card-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'default' => [
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_card_title',
                'selector' => '{{WRAPPER}} .single-card-item h3',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

    $settings = $this->get_settings();
    ?>

    <?php if(!empty($settings['card_title'])) : ?>
    <div class="single-approach-card single-card-item">
        <?php if(!empty($settings['card_bg']['url'])) : ?>
        <div class="card-thumb bg-cover" style="background-image: url('<?php echo esc_url($settings['card_bg']['url']); ?>')"></div>
        <?php endif; ?>
        <div class="content">
            <?php if(!empty($settings['flaticon'])) : ?>
            <div class="case-cat">
                <a href="<?php echo esc_url($settings['btn_link']['url']); ?>">
                    <i class="<?php echo esc_attr( $settings['flaticon'] ); ?>"></i>
                </a>
            </div>
            <?php endif; ?>
            <h3><a href="<?php echo esc_url($settings['btn_link']['url']); ?>"><?php echo esc_html($settings['card_title']) ?></a></h3>
            <p><?php echo esc_html($settings['card_text']); ?></p>
            <a href="<?php echo esc_url($settings['btn_link']['url']); ?> <?php modina_is_external($settings['btn_link']); ?> <?php modina_is_nofollow($settings['btn_link']); ?>" class="read-btn"><?php echo esc_html($settings['btn_text']); ?> <i class="fal fa-long-arrow-right"></i></a>
        </div>
    </div>
    <?php endif; ?>
    <?php
    }
}