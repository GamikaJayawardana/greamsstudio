<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_video_popup extends Widget_Base {

    public function get_name() {
        return 'modina_video_popup';
    }

    public function get_title() {
        return esc_html__( 'Video Popup', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-video-playlist';
    }

    public function get_keywords() {
        return [ 'video', 'popup', 'skill', 'lightbox', 'youtube', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {              

        $this->start_controls_section(
            'video_pop_sec',
            [
                'label' => esc_html__( 'Video Popup', 'modina-core' ),
            ]
        );

        $this->add_control(
            'video_bg', [
                'label' => esc_html__( 'Upload Background Image', 'modina-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label' => esc_html__( 'Video Link', 'modina-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_tab', [
                'label' => esc_html__( 'Section Style', 'modina-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => esc_html__( 'Video Section Padding', 'modina-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .video-pop-up-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
    $settings = $this->get_settings();

    ?>
    <?php if (!empty ( $settings['video_link']['url'] && $settings['video_bg']['url'] ) ) : ?>
    <div class="video-pop-up-wrapper section-padding bg-cover" style="background-image: url('<?php echo esc_url($settings['video_bg']['url']); ?>')">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center d-flex justify-content-center align-items-center">
                    <div class="video-play-btn">
                        <a href="<?php echo esc_url($settings['video_link']['url']); ?>" class="popup-video play-video"><i class="fas fa-play"></i></a>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php
    }
}