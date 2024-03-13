<?php
namespace ModinaCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Modina_team extends Widget_Base {

    public function get_name() {
        return 'modina_team';
    }

    public function get_title() {
        return esc_html__( 'Our Team', 'modina-core' );
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_keywords() {
        return [ 'team', 'member', 'deliveryman', 'mates', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'team_style_select', [
                'label' => __( 'Team Layout - Choice', 'modina-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_1' => esc_html__( 'Style One', 'modina-core' ),
                    'style_2' => esc_html__( 'Style Two', 'modina-core' ),
                ],
                'default' => 'style_1'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'members_section',
            [
                'label' => esc_html__( 'Members', 'modina-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'member_img',
            [
                'label' => esc_html__( 'Profile Photo', 'modina-core' ),
                'type' =>Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugin_dir_url( __DIR__ ).'assets/img/team1.png',
                ],              
            ]
        );

        $repeater->add_control(
            'member_name',
            [
                'label' => esc_html__( 'Member Name', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Alaxis D. Dowson',
            ]
        );

        $repeater->add_control(
            'member_post',
            [
                'label' => esc_html__( 'Member Position', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Founder',
            ]
        );

        $repeater->add_control(
            'fb_link',
            [
                'label' => esc_html__( 'Facebook Link', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '#',
            ]
        );

        $repeater->add_control(
            'tw_link',
            [
                'label' => esc_html__( 'Twitter Link', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '#',
            ]
        );

        $repeater->add_control(
            'linkedin_link',
            [
                'label' => esc_html__( 'Linkedin Link', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '#',
            ]
        );

        $repeater->add_control(
            'insta_link',
            [
                'label' => esc_html__( 'Instagram Link', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '#',
            ]
        );

        $repeater->add_control(
            'skype_link',
            [
                'label' => esc_html__( 'Skype Link', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '#',
            ]
        );

        $repeater->add_control(
            'whatsapp_link',
            [
                'label' => esc_html__( 'WhatsApp Link', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'youtube_link',
            [
                'label' => esc_html__( 'Youtube Link', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '#',
            ]
        );

        $repeater->add_control(
            'member_active',
            [
                'label' => esc_html__('Active / Hover Effect - Member', 'modina-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'label_block' => true,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'all_members',
            [
                'label' => esc_html__( 'All Team Member', 'modina-core' ),
                'type' =>Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'member_img' => [
                            'url' => plugin_dir_url( __DIR__ ).'assets/img/team1.jpg',
                        ],
                        'member_name'   => 'Alaxis D. Dowson',
                    ],
                ],
                'title_field' => '{{{member_name}}}'
            ]
        );

        $this->end_controls_section();  

    }

    protected function render() {

        $settings = $this->get_settings();
        $all_members = $settings['all_members'];

        if ( $settings['style'] == 'style_1' ) {
            include 'team/style-one.php';
        }

        if ( $settings['style'] == 'style_2' ) {
            include 'team/style-two.php';
        }

    }
}