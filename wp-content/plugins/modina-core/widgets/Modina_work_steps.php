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


class Modina_work_steps extends Widget_Base
{

    public function get_name()
    {
        return 'modina_work_steps';
    }

    public function get_title()
    {
        return esc_html__('Work Steps', 'modina-core');
    }

    public function get_icon()
    {
        return 'eicon-check-circle';
    }

    public function get_keywords()
    {
        return ['work', 'steps', 'process', 'how', 'modina'];
    }

    public function get_categories() {
        return [ 'modina-elements' ];
    }

    protected function register_controls() {


         // -------------------  Title Section  -----------------------//
        $this->start_controls_section(
            'section_contents',
            [
                'label' => esc_html__( 'How We Work', 'modina-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon', [
                'label' => esc_html__( 'Icon Image', 'modina-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'step_title',
            [
                'label' => esc_html__( 'Steps Title', 'modina-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Listening You',
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'modina-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Greenling sleeper, Owens pupfish large-eye bream kokanee sprat shrimpfish pleasure',
            ]
        );

        $this->add_control(
            'all_work_steps',
            [
                'label' => esc_html__( 'All Work Steps', 'modina-core' ),
                'type' =>Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'step_title'   => 'Listening You',
                    ],
                ],
                'title_field' => '{{{step_title}}}'
            ]
        );

        $this->end_controls_section(); 

    }

    protected function render() {

    $settings = $this->get_settings();
    $all_work_steps = $settings['all_work_steps'];
    ?>
    
    <?php if (!empty($all_work_steps)) : ?>
    <div class="work-steps-list">
        <div class="row">
        <?php if (!empty($all_work_steps)) { $i = 0;
            foreach ($all_work_steps as $item) { $i++; ?>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="single-work-steps">
                    <?php if( !empty($item['icon']['url'] ) ) : ?>
                    <div class="icon">
                        <img src="<?php echo esc_url($item['icon']['url']); ?>" alt="<?php echo esc_attr($item['step_title']); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="content text-center">
                        <h4><?php echo htmlspecialchars_decode(esc_html($item['step_title'])); ?></h4>
                        <p><?php echo htmlspecialchars_decode(esc_html($item['text'])); ?></p>
                    </div>
                </div>
            </div>
            <?php }
        } ?>
        </div>
    </div>
    <?php endif; ?>
<?php
    }
}
