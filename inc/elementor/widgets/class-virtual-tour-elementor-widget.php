<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;  // Exit if accessed directly

use Elementor\core\Schemes;
use Elementor\Group_Control_Typography;
use Egns_Core\Egns_Helper;

class Gofly_Virtual_Tour_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'gofly_virtual_tour';
    }

    public function get_title()
    {
        return esc_html__('EG Virtual Tour', 'gofly-core');
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
            'gofly_virtual_tour_genaral',
            [
                'label' => esc_html__('General', 'gofly-core')
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_genaral_title',
            [
                'label'       => __('Title', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Take a Virtual Tour', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_genaral_title_gallery_area',
            [
                'label'     => esc_html__('Gallery Area', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'gofly_virtual_tour_genaral_title_gallery_area_image',
            [
                'label'   => __('Image', 'gofly-core'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'gofly_virtual_tour_genaral_title_gallery_social_area',
            [
                'label'     => esc_html__('Social Area', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $repeater->add_control(
            'gofly_virtual_tour_genaral_title_gallery_social_area_icon',
            [
                'label'   => esc_html__('Social Icon', 'gofly-core'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'gofly_virtual_tour_genaral_title_gallery_social_area_icon_link',
            [
                'label'       => esc_html__('Link', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::URL,
                'default'     => ['url' => '#'],
                'placeholder' => esc_html__('write your url here', 'gofly-core'),
                'label_block' => true,

            ]
        );

        $repeater->add_control(
            'gofly_virtual_tour_genaral_title_gallery_social_area_icon_name',
            [
                'label'       => __('Name', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Noor_Khelsi', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'gofly_virtual_tour_genaral_title_gallery_social_area_icon_name_follow',
            [
                'label'       => __('text', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Follow', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_genaral_title_gallery_area_images',
            [
                'label'   => __('Image List', 'gofly-core'),
                'type'    => \Elementor\Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'gofly_virtual_tour_genaral_title_gallery_area_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'gofly_virtual_tour_genaral_title_gallery_area_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'gofly_virtual_tour_genaral_title_gallery_area_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => __('Image Item', 'gofly-core'),
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_genaral_title_btn_area',
            [
                'label'     => esc_html__('Button Area', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_genaral_desc_button',
            [
                'label'       => esc_html__('Button Label', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('@goflytravelagency', 'gofly-core'),
                'placeholder' => esc_html__('write your label here', 'gofly-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'gofly_virtual_tour_genaral_desc_button_copy_text',
            [
                'label'       => esc_html__('Copy Text', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Copied', 'gofly-core'),
                'placeholder' => esc_html__('write your label here', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        //============Style One Start=============//

        $this->start_controls_section(
            'gofly_virtual_tour_style_genaral',
            [
                'label' => esc_html__('Styles', 'gofly-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_style_genaral_title',
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
                'name'     => 'gofly_virtual_tour_style_genaral_title_typ',
                'selector' => '{{WRAPPER}} .section-title h2',

            ]
        );

        $this->add_control(
            'gofly_virtual_tour_style_genaral_title_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_style_genaral_title_social_area_style',
            [
                'label'     => esc_html__('Social Area', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_style_genaral_title_social_area_name_style',
            [
                'label'     => esc_html__('Name', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_virtual_tour_style_genaral_title_social_area_name_style_typ',
                'selector' => '{{WRAPPER}} .visual-tour-section .visual-tour-slider .tour-img .social-area .content h6',

            ]
        );

        $this->add_control(
            'gofly_virtual_tour_style_genaral_title_social_area_name_style_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .visual-tour-section .visual-tour-slider .tour-img .social-area .content h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_style_genaral_title_social_area_name_style_follow_text_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .visual-tour-section .visual-tour-slider .tour-img .social-area .content span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_style_genaral_title_social_area_name_style_follow_text_bac_color',
            [
                'label'     => esc_html__('Background Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .visual-tour-section .visual-tour-slider .tour-img .social-area .content span' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_style_genaral_title_btn_style',
            [
                'label'     => esc_html__('Button', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_virtual_tour_style_genaral_title_btn_style_typ',
                'selector' => '{{WRAPPER}} .btn-area .copy-email-btn',

            ]
        );

        $this->add_control(
            'gofly_virtual_tour_style_genaral_title_btn_style_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-area .copy-email-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_style_genaral_title_btn_style_hov_color',
            [
                'label'     => esc_html__('Hover Text Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-area .copy-email-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_virtual_tour_style_genaral_title_btn_style_bac_color',
            [
                'label'     => esc_html__('Hover Background Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-area .copy-email-btn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        //============Style Two End=============//

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>
        <?php if (is_admin()): ?>
            <script>
                //------Home10 Tour slider-----//
                var swiper = new Swiper(".visual-tour-slider", {
                    slidesPerView: 1,
                    speed: 1500,
                    spaceBetween: 24,
                    autoplay: {
                        delay: 2500, // Autoplay duration in milliseconds
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    pagination: {
                        el: ".progress-pagination",
                        type: "progressbar",
                    },
                    navigation: {
                        nextEl: ".testimonial-slider-next",
                        prevEl: ".testimonial-slider-prev",
                        clickable: true,
                    },
                    breakpoints: {
                        350: {
                            slidesPerView: 1,
                            spaceBetween: 15,
                        },
                        576: {
                            slidesPerView: 2,
                            spaceBetween: 15,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 10,
                        },
                        992: {
                            slidesPerView: 3,
                            spaceBetween: 15,
                        },
                        1200: {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
                        1400: {
                            slidesPerView: 5,
                        },
                    },
                });

                // On click email copy to clipboard
                document.addEventListener("DOMContentLoaded", function() {
                    const copyBtn = document.querySelector(".copy-email-btn");
                    const copyAlert = document.querySelector(".copy-alert");

                    // If element not found, stop here
                    if (!copyBtn || !copyAlert) return;

                    copyBtn.addEventListener("click", function() {
                        const emailText = this.innerText.trim();

                        navigator.clipboard.writeText(emailText).then(() => {
                            copyAlert.classList.add("show");

                            setTimeout(() => {
                                copyAlert.classList.remove("show");
                            }, 2000);
                        });
                    });
                });
            </script>
        <?php endif; ?>

        <div class="visual-tour-section">
            <div class="container wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="row mb-60">
                    <div class="col-lg-12">
                        <?php if (!empty($settings['gofly_virtual_tour_genaral_title'])): ?>
                            <div class="section-title text-center">
                                <h2><?php echo esc_html($settings['gofly_virtual_tour_genaral_title']); ?></h2>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="container-fluid mb-60">
                <div class="swiper visual-tour-slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['gofly_virtual_tour_genaral_title_gallery_area_images'] as $item): ?>
                            <div class="swiper-slide">
                                <div class="tour-img">
                                    <?php if (!empty($item['gofly_virtual_tour_genaral_title_gallery_area_image']['url'])): ?>
                                        <img src="<?php echo esc_url($item['gofly_virtual_tour_genaral_title_gallery_area_image']['url']); ?>" alt="<?php echo esc_attr__('gallry-image', 'gofly-core'); ?>" class="vector2">
                                    <?php endif ?>
                                    <a href="<?php echo esc_url($item['gofly_virtual_tour_genaral_title_gallery_social_area_icon_link']['url']); ?>" class="social-area">
                                        <?php if (!empty($item['gofly_virtual_tour_genaral_title_gallery_social_area_icon'])): ?>
                                            <div class="icon">
                                                <?php \Elementor\Icons_Manager::render_icon($item['gofly_virtual_tour_genaral_title_gallery_social_area_icon'], ['aria-hidden' => 'true']); ?>
                                            </div>
                                        <?php endif ?>
                                        <div class="content">
                                            <?php if (!empty($item['gofly_virtual_tour_genaral_title_gallery_social_area_icon_name'])): ?>
                                                <h6><?php echo esc_html($item['gofly_virtual_tour_genaral_title_gallery_social_area_icon_name']); ?></h6>
                                            <?php endif ?>
                                            <?php if (!empty($item['gofly_virtual_tour_genaral_title_gallery_social_area_icon_name_follow'])): ?>
                                                <span><?php echo esc_html($item['gofly_virtual_tour_genaral_title_gallery_social_area_icon_name_follow']); ?></span>
                                            <?php endif ?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="btn-area">
                            <?php if (!empty($settings['gofly_virtual_tour_genaral_desc_button'])): ?>
                                <button class="copy-email-btn">
                                    <span><?php echo esc_html($settings['gofly_virtual_tour_genaral_desc_button']); ?></span>
                                </button>
                            <?php endif ?>
                            <?php if (!empty($settings['gofly_virtual_tour_genaral_desc_button_copy_text'])): ?>
                                <span class="copy-alert"><?php echo esc_html($settings['gofly_virtual_tour_genaral_desc_button_copy_text']); ?></span>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php
    }
}

Plugin::instance()->widgets_manager->register(new Gofly_Virtual_Tour_Widget());
