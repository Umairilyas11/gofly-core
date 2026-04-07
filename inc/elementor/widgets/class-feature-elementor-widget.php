<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;  // Exit if accessed directly

use Elementor\core\Schemes;
use Egns_Core\Egns_Helper;

class Gofly_Feature_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'gofly_feature';
    }

    public function get_title()
    {
        return esc_html__('EG Feature', 'gofly-core');
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
            'gofly_feature_genaral',
            [
                'label' => esc_html__('Banner Bottom Content', 'gofly-core'),

            ]
        );

        $this->add_control(
            'gofly_feature_genaral_heading',
            [
                'label'     => esc_html__('Heading ', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'gofly_feature_genaral_heading_title',
            [
                'label'       => esc_html__('Title', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'What You Can Expect.',
                'placeholder' => esc_html__('write your title here', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_feature_genaral_heading_desc',
            [
                'label'       => esc_html__('Description', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'We offer curated amenities that ensure relaxation, convenience, and a truly enjoyable experience.',
                'placeholder' => esc_html__('write your desc here', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_feature_banner_image',
            [
                'label'   => esc_html__('Banner Image ', 'gofly-core'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],

            ]
        );

        $this->add_control(
            'gofly_feature_genaral_heading_feature_card',
            [
                'label'     => esc_html__('Feature Card ', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'gofly_feature_genaral_title',
            [
                'label'       => esc_html__('Counter Title', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'High-Speed & Free Wi-Fi also Parking.',
                'placeholder' => esc_html__('write your title here', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'gofly_feature_genaral_content',
            [
                'label'       => esc_html__('Content', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Every room is fully cleaned and sanitized for a fresh, safe stay.',
                'placeholder' => esc_html__('write your content here', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_feature_genaral_content_list',
            [
                'label'   => esc_html__('Content List', 'gofly-core'),
                'type'    => \Elementor\Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'gofly_feature_genaral_title' => esc_html('High-Speed & Free Wi-Fi also Parking.'),
                    ],
                    [
                        'gofly_feature_genaral_title' => esc_html('High-Speed & Free Wi-Fi also Parking.'),
                    ],
                    [
                        'gofly_feature_genaral_title' => esc_html('Daily Housekeeping Service.'),
                    ],
                    [
                        'gofly_feature_genaral_title' => esc_html('Golf Playing Ground & Fun Time.'),
                    ],
                    [
                        'gofly_feature_genaral_title' => esc_html('Private Balconies (Selected Rooms).'),
                    ],
                    [
                        'gofly_feature_genaral_title' => esc_html('Fitness Bar & Swimming Pool.'),
                    ],

                ],
                'title_field' => '{{{ gofly_feature_genaral_title }}}',
            ]
        );


        $this->end_controls_section();

        //============Style Start=============//

        $this->start_controls_section(
            'gofly_feature_general',
            [
                'label' => esc_html__('Styles', 'gofly-core'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'gofly_feature_general_title',
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
                'name'     => 'gofly_feature_general_title_typ',
                'selector' => '{{WRAPPER}} .section-title h2',

            ]
        );

        $this->add_control(
            'gofly_feature_general_title_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_feature_general_short_description',
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
                'name'     => 'gofly_feature_general_short_description_typ',
                'selector' => '{{WRAPPER}} .section-title p',

            ]
        );

        $this->add_control(
            'gofly_feature_general_short_description_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_feature_general_feature_card',
            [
                'label'     => esc_html__(' Feature Card', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'gofly_feature_general_feature_card_title_bac_color',
            [
                'label'     => esc_html__('Background Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home10-feature-section .feature-card .single-feature-card' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'gofly_feature_general_feature_card_title',
            [
                'label'     => esc_html__('Title', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_feature_general_feature_card_title_typ',
                'selector' => '{{WRAPPER}} .home10-feature-section .feature-card .single-feature-card .feature-content h5',

            ]
        );

        $this->add_control(
            'gofly_feature_general_feature_card_title_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home10-feature-section .feature-card .single-feature-card .feature-content h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_feature_general_feature_card_content',
            [
                'label'     => esc_html__('Content', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_feature_general_feature_card_content_typ',
                'selector' => '{{WRAPPER}} .home10-feature-section .feature-card .single-feature-card .feature-content h5',

            ]
        );

        $this->add_control(
            'gofly_feature_general_feature_card_content_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home10-feature-section .feature-card .single-feature-card .feature-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $data = $settings['gofly_feature_genaral_content_list'];

?>
        <?php if (is_admin()): ?>
            <script>
                //Home10 Feature Card
                document.querySelectorAll(".single-feature-card .span-icon")
                    .forEach((icon) => {
                        icon.addEventListener("click", () => {
                            const currentCard = icon.closest(".single-feature-card");

                            document.querySelectorAll(".single-feature-card").forEach((card) => {
                                if (card !== currentCard) {
                                    card.classList.remove("active");
                                }
                            });
                            currentCard.classList.toggle("active");
                        });
                    });
            </script>
        <?php endif; ?>

        <div class="home10-feature-section">
            <div class="container">
                <div class="row align-items-center justify-content-between gy-5">
                    <div class="col-xl-5 col-lg-6 wow animate fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="section-title mb-45">
                            <?php if (!empty($settings['gofly_feature_genaral_heading_title'])): ?>
                                <h2><?php echo esc_html($settings['gofly_feature_genaral_heading_title']); ?></h2>
                            <?php endif; ?>
                            <?php if (!empty($settings['gofly_feature_genaral_heading_desc'])): ?>
                                <p><?php echo esc_html($settings['gofly_feature_genaral_heading_desc']); ?></p>
                            <?php endif; ?>
                        </div>
                        <ul class="feature-card">
                            <?php foreach ($data as $item): ?>
                                <li class="single-feature-card">
                                    <div class="span-icon">
                                        <div class="icon">
                                            <svg width="12" height="12" viewBox="0 0 12 12"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path class="vertical" d="M6.75 0H5.25V12H6.75V0Z" />
                                                <path d="M0 5.25H12V6.75H0V5.25Z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="feature-content">
                                        <?php if (!empty($item['gofly_feature_genaral_title'])): ?>
                                            <h5><?php echo esc_html($item['gofly_feature_genaral_title']); ?></h5>
                                        <?php endif; ?>
                                        <?php if (!empty($item['gofly_feature_genaral_content'])): ?>
                                            <p><?php echo esc_html($item['gofly_feature_genaral_content']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-xxl-6 col-xl-7 col-lg-6 wow animate fadeInRight" data-wow-delay="400ms"
                        data-wow-duration="1500ms">
                        <?php if (!empty($settings['gofly_feature_banner_image']['url'])): ?>
                            <div class="feature-img">
                                <img src="<?php echo esc_url($settings['gofly_feature_banner_image']['url']); ?>" alt="<?php echo esc_attr__('feature-image', 'gofly-core'); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Gofly_Feature_Widget());
