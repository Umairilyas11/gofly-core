<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

use Egns_Core\Egns_Helper;

class Gofly_Tour_Accommodation_Widget extends Widget_Base
{
    public function get_name()       { return 'gofly_tour_accommodation'; }
    public function get_title()      { return esc_html__('EG Tour Accommodations', 'gofly-core'); }
    public function get_icon()       { return 'egns-widget-icon'; }
    public function get_categories() { return ['gofly_tour']; }

    protected function register_controls()
    {
        $this->start_controls_section('gofly_taccom_content_section', [
            'label' => esc_html__('Content', 'gofly-core'),
        ]);

        $this->add_control('gofly_taccom_notice', [
            'type'        => \Elementor\Controls_Manager::NOTICE,
            'notice_type' => 'warning',
            'dismissible' => true,
            'heading'     => esc_html__('Notice', 'gofly-core'),
            'content'     => esc_html__('Displays the accommodation cards from the Tour meta box → Accommodations tab. Shows a grid for 1–3 items, carousel for 4+.', 'gofly-core'),
        ]);

        $this->add_control('gofly_taccom_show_title', [
            'label'        => esc_html__('Show Section Title', 'gofly-core'),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->add_control('gofly_taccom_title', [
            'label'     => esc_html__('Section Title', 'gofly-core'),
            'type'      => Controls_Manager::TEXT,
            'default'   => esc_html__('Accommodations', 'gofly-core'),
            'condition' => ['gofly_taccom_show_title' => 'yes'],
        ]);

        $this->add_control('gofly_taccom_btn_label', [
            'label'   => esc_html__('Button Label', 'gofly-core'),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__('View', 'gofly-core'),
        ]);

        $this->end_controls_section();

        // Style: Card
        $this->start_controls_section('gofly_taccom_card_style', [
            'label' => esc_html__('Card Style', 'gofly-core'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('gofly_taccom_img_height', [
            'label'      => esc_html__('Image Height', 'gofly-core'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => ['px' => ['min' => 100, 'max' => 500]],
            'default'    => ['unit' => 'px', 'size' => 230],
            'selectors'  => ['{{WRAPPER}} .gofly-taccom-img' => 'height: {{SIZE}}{{UNIT}};'],
        ]);

        $this->add_responsive_control('gofly_taccom_border_radius', [
            'label'      => esc_html__('Card Border Radius', 'gofly-core'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => ['px' => ['min' => 0, 'max' => 40]],
            'default'    => ['unit' => 'px', 'size' => 16],
            'selectors'  => ['{{WRAPPER}} .gofly-taccom-card' => 'border-radius: {{SIZE}}{{UNIT}}; overflow: hidden;'],
        ]);

        $this->add_control('gofly_taccom_card_bg', [
            'label'     => esc_html__('Card Background', 'gofly-core'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => ['{{WRAPPER}} .gofly-taccom-card' => 'background: {{VALUE}};'],
        ]);

        $this->end_controls_section();

        // Style: Text
        $this->start_controls_section('gofly_taccom_text_style', [
            'label' => esc_html__('Text Style', 'gofly-core'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'gofly_taccom_name_typography',
            'label'    => esc_html__('Name Typography', 'gofly-core'),
            'selector' => '{{WRAPPER}} .gofly-taccom-name',
        ]);

        $this->add_control('gofly_taccom_name_color', [
            'label'     => esc_html__('Name Color', 'gofly-core'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .gofly-taccom-name' => 'color: {{VALUE}};'],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'gofly_taccom_desc_typography',
            'label'    => esc_html__('Description Typography', 'gofly-core'),
            'selector' => '{{WRAPPER}} .gofly-taccom-desc',
        ]);

        $this->add_control('gofly_taccom_desc_color', [
            'label'     => esc_html__('Description Color', 'gofly-core'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .gofly-taccom-desc' => 'color: {{VALUE}};'],
        ]);

        $this->end_controls_section();

        // Style: Button
        $this->start_controls_section('gofly_taccom_btn_style', [
            'label' => esc_html__('Button Style', 'gofly-core'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('gofly_taccom_btn_bg', [
            'label'     => esc_html__('Background', 'gofly-core'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ff5800',
            'selectors' => ['{{WRAPPER}} .gofly-taccom-btn' => 'background: {{VALUE}};'],
        ]);

        $this->add_control('gofly_taccom_btn_color', [
            'label'     => esc_html__('Text Color', 'gofly-core'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => ['{{WRAPPER}} .gofly-taccom-btn' => 'color: {{VALUE}};'],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings    = $this->get_settings_for_display();
        $meta        = get_post_meta(get_the_ID(), 'EGNS_TOUR_META_ID', true);
        $items       = !empty($meta['tour_accommodation_list']) ? (array) $meta['tour_accommodation_list'] : [];

        if (empty($items)) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<p style="color:#aaa;font-style:italic;">' . esc_html__('No accommodations found. Add them in the Tour meta box → Accommodations tab.', 'gofly-core') . '</p>';
            }
            return;
        }

        $count       = count($items);
        $is_carousel = $count > 3;
        $uid         = 'gofly-taccom-' . $this->get_id();
        $show_title  = $settings['gofly_taccom_show_title'] === 'yes';
        $title       = $settings['gofly_taccom_title'] ?? '';
        $btn_label   = !empty($settings['gofly_taccom_btn_label']) ? $settings['gofly_taccom_btn_label'] : 'View';
?>
        <div class="gofly-tour-accommodations">

            <?php if ($show_title && !empty($title)) : ?>
                <h3 class="gofly-taccom-section-title"><?php echo esc_html($title); ?></h3>
            <?php endif; ?>

            <?php if ($is_carousel) : ?>
            <div class="swiper <?php echo esc_attr($uid); ?>">
                <div class="swiper-wrapper">
                    <?php foreach ($items as $item) : ?>
                        <div class="swiper-slide">
                            <?php echo $this->render_card($item, $btn_label); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next <?php echo esc_attr($uid); ?>-next"></div>
                <div class="swiper-button-prev <?php echo esc_attr($uid); ?>-prev"></div>
            </div>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('.<?php echo esc_js($uid); ?>', {
                    slidesPerView: 1,
                    spaceBetween: 24,
                    navigation: {
                        nextEl: '.<?php echo esc_js($uid); ?>-next',
                        prevEl: '.<?php echo esc_js($uid); ?>-prev',
                    },
                    breakpoints: {
                        600:  { slidesPerView: 2, spaceBetween: 24 },
                        1024: { slidesPerView: 3, spaceBetween: 24 },
                    },
                });
            });
            </script>

            <?php else : ?>
            <div class="gofly-taccom-grid gofly-taccom-count-<?php echo $count; ?>">
                <?php foreach ($items as $item) : ?>
                    <?php echo $this->render_card($item, $btn_label); ?>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>

        <style>
            .gofly-tour-accommodations { width: 100%; }
            .gofly-taccom-section-title { margin-bottom: 24px; }

            /* Grid */
            .gofly-taccom-grid {
                display: grid;
                gap: 24px;
            }
            .gofly-taccom-count-1 { grid-template-columns: 1fr; }
            .gofly-taccom-count-2 { grid-template-columns: 1fr 1fr; }
            .gofly-taccom-count-3 { grid-template-columns: repeat(3, 1fr); }

            /* Card */
            .gofly-taccom-card {
                background: #fff;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 2px 16px rgba(0,0,0,0.09);
                display: flex;
                flex-direction: column;
            }

            /* Image area with thumbnail strip */
            .gofly-taccom-img-wrap { position: relative; }
            .gofly-taccom-img {
                width: 100%;
                height: 230px;
                object-fit: cover;
                display: block;
            }
            .gofly-taccom-img-placeholder {
                width: 100%;
                height: 230px;
                background: #e0e0e0;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #aaa;
                font-size: 13px;
            }

            /* Card body */
            .gofly-taccom-body {
                padding: 16px 18px 18px;
                display: flex;
                flex-direction: column;
                flex: 1;
            }
            .gofly-taccom-stars {
                color: #f5a623;
                font-size: 15px;
                margin-bottom: 8px;
                line-height: 1;
            }
            .gofly-taccom-name {
                font-size: 16px;
                font-weight: 700;
                margin: 0 0 8px;
                color: #1a1a1a;
                line-height: 1.35;
            }
            .gofly-taccom-desc {
                font-size: 13px;
                color: #555;
                line-height: 1.6;
                margin: 0 0 16px;
                flex: 1;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            .gofly-taccom-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                background: #ff5800;
                color: #fff;
                text-decoration: none;
                font-weight: 600;
                font-size: 15px;
                padding: 12px;
                border-radius: 8px;
                transition: opacity 0.2s;
            }
            .gofly-taccom-btn:hover { opacity: 0.88; color: #fff; }
            .gofly-taccom-btn svg { flex-shrink: 0; }

            /* Swiper nav */
            .gofly-tour-accommodations .swiper-button-next,
            .gofly-tour-accommodations .swiper-button-prev {
                width: 40px; height: 40px;
                background: #ff5800;
                border-radius: 50%;
                color: #fff;
            }
            .gofly-tour-accommodations .swiper-button-next::after,
            .gofly-tour-accommodations .swiper-button-prev::after {
                font-size: 14px; font-weight: 700;
            }

            @media (max-width: 768px) {
                .gofly-taccom-count-2,
                .gofly-taccom-count-3 { grid-template-columns: 1fr; }
            }
        </style>
<?php
    }

    private function render_card($item, $btn_label)
    {
        $name  = !empty($item['tour_accom_name']) ? esc_html($item['tour_accom_name']) : '';
        $desc  = !empty($item['tour_accom_desc']) ? esc_html($item['tour_accom_desc']) : '';
        $stars = !empty($item['tour_accom_stars']) ? intval($item['tour_accom_stars']) : 0;
        $img   = !empty($item['tour_accom_image']['url']) ? esc_url($item['tour_accom_image']['url']) : '';
        $link  = !empty($item['tour_accom_link']['url']) ? esc_url($item['tour_accom_link']['url']) : '#';
        $target = !empty($item['tour_accom_link']['target']) ? esc_attr($item['tour_accom_link']['target']) : '_self';
        $stars_html = $stars > 0 ? str_repeat('★', min($stars, 5)) : '';

        ob_start(); ?>
        <div class="gofly-taccom-card">
            <div class="gofly-taccom-img-wrap">
                <?php if ($img) : ?>
                    <img class="gofly-taccom-img" src="<?php echo $img; ?>" alt="<?php echo $name; ?>">
                <?php else : ?>
                    <div class="gofly-taccom-img-placeholder"><?php esc_html_e('No image', 'gofly-core'); ?></div>
                <?php endif; ?>
            </div>
            <div class="gofly-taccom-body">
                <?php if ($stars_html) : ?>
                    <div class="gofly-taccom-stars"><?php echo $stars_html; ?></div>
                <?php endif; ?>
                <?php if ($name) : ?>
                    <h4 class="gofly-taccom-name"><?php echo $name; ?></h4>
                <?php endif; ?>
                <?php if ($desc) : ?>
                    <p class="gofly-taccom-desc"><?php echo $desc; ?></p>
                <?php endif; ?>
                <a href="<?php echo $link; ?>" target="<?php echo $target; ?>" class="gofly-taccom-btn">
                    <?php echo esc_html($btn_label); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                </a>
            </div>
        </div>
        <?php return ob_get_clean();
    }
}

Plugin::instance()->widgets_manager->register(new Gofly_Tour_Accommodation_Widget());