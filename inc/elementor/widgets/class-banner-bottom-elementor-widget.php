<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;  // Exit if accessed directly

use Elementor\core\Schemes;
use Egns_Core\Egns_Helper;

class Gofly_Banner_Bottom_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'gofly_banner_bottom';
    }

    public function get_title()
    {
        return esc_html__('EG Banner Bottom', 'gofly-core');
    }

    public function get_icon()
    {
        return 'egns-widget-icon';
    }

    public function get_categories()
    {
        return ['gofly_widgets'];
    }

    protected function register_controls()
    {

        //=====================General=======================//

        $this->start_controls_section(
            'gofly_counter_banner_bottom_genaral',
            [
                'label' => esc_html__('Banner Bottom Content', 'gofly-core'),

            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'gofly_counter_banner_bottom_genaral_icon_image',
            [
                'label'       => esc_html__('Icon Image ', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'media_types' => ['svg'],
                'default'     => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],

            ]
        );
        $repeater->add_control(
            'gofly_counter_banner_bottom_genaral_title',
            [
                'label'       => esc_html__('Counter Title', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Luxury Rooms & Suites',
                'placeholder' => esc_html__('write your title here', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'gofly_counter_banner_bottom_genaral_content',
            [
                'label'       => esc_html__('Content', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Modern, spacious, and designed for ultimate comfort.',
                'placeholder' => esc_html__('write your content here', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_counter_banner_bottom_genaral_content_list',
            [
                'label'   => esc_html__('Content List', 'gofly-core'),
                'type'    => \Elementor\Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'gofly_counter_banner_bottom_genaral_title' => esc_html('Luxury Rooms & Suites'),
                    ],
                    [
                        'gofly_counter_banner_bottom_genaral_title' => esc_html('World-Class Dining'),
                    ],
                    [
                        'gofly_counter_banner_bottom_genaral_title' => esc_html('Secure & Safe'),
                    ],

                ],
                'title_field' => '{{{ gofly_counter_banner_bottom_genaral_title }}}',
            ]
        );


        $this->end_controls_section();

        //============Style Start=============//

        $this->start_controls_section(
            'gofly_banner_bottom_general',
            [
                'label' => esc_html__('Styles', 'gofly-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'gofly_banner_bottom_general_short_description_icon_color',
            [
                'label'     => esc_html__('Icon BG Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-bottom-area .banner-bottom-area-wrapper .banner-bottom-list .banner-bottom-single-list .icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_banner_bottom_general_title',
            [
                'label'     => esc_html__(' Title', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_banner_bottom_general_title_typ',
                'selector' => '{{WRAPPER}} .banner-bottom-area .banner-bottom-area-wrapper .banner-bottom-list .banner-bottom-single-list .banner-bottom-content h5',

            ]
        );

        $this->add_control(
            'gofly_banner_bottom_general_title_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-bottom-area .banner-bottom-area-wrapper .banner-bottom-list .banner-bottom-single-list .banner-bottom-content h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_banner_bottom_general_short_description',
            [
                'label'     => esc_html__(' Content', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_banner_bottom_general_short_description_typ',
                'selector' => '{{WRAPPER}} .banner-bottom-area .banner-bottom-area-wrapper .banner-bottom-list .banner-bottom-single-list .banner-bottom-content p',

            ]
        );

        $this->add_control(
            'gofly_banner_bottom_general_short_description_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-bottom-area .banner-bottom-area-wrapper .banner-bottom-list .banner-bottom-single-list .banner-bottom-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_banner_bottom_box_bg_color',
            [
                'label'     => esc_html__('Box Background Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-bottom-area .banner-bottom-area-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
    }
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $data = $settings['gofly_counter_banner_bottom_genaral_content_list'];
?>

        <div class="banner-bottom-area two ">
            <div class="container-fluid">
                <div class="banner-bottom-area-wrapper">
                    <ul class="banner-bottom-list">
                        <?php foreach ($data as $item): ?>
                            <li class="banner-bottom-single-list wow animate fadeInDown" data-wow-delay="200ms"
                                data-wow-duration="1500ms">
                                <?php if (!empty($item['gofly_counter_banner_bottom_genaral_icon_image']['url'])): ?>
                                    <div class="icon">
                                        <img src="<?php echo esc_url($item['gofly_counter_banner_bottom_genaral_icon_image']['url']); ?>" alt="<?php echo esc_attr__('icon-image', 'gofly-core'); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="banner-bottom-content">
                                    <?php if (!empty($item['gofly_counter_banner_bottom_genaral_title'])): ?>
                                        <h5><?php echo esc_html($item['gofly_counter_banner_bottom_genaral_title']); ?></h5>
                                    <?php endif; ?>
                                    <?php if (!empty($item['gofly_counter_banner_bottom_genaral_content'])): ?>
                                        <p><?php echo esc_html($item['gofly_counter_banner_bottom_genaral_content']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Gofly_Banner_Bottom_Widget());
