<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

use Egns_Core\Egns_Helper;

class Gofly_Tour_Destination_Widget extends Widget_Base
{
    public function get_name()        { return 'gofly_tour_destination'; }
    public function get_title()       { return esc_html__('EG Tour Destinations', 'gofly-core'); }
    public function get_icon()        { return 'egns-widget-icon'; }
    public function get_categories()  { return ['gofly_tour']; }

    protected function register_controls()
    {
        $this->start_controls_section('gofly_tdest_content_section', [
            'label' => esc_html__('Content', 'gofly-core'),
        ]);

        $this->add_control('gofly_tdest_notice', [
            'type'        => \Elementor\Controls_Manager::NOTICE,
            'notice_type' => 'warning',
            'dismissible' => true,
            'heading'     => esc_html__('Notice', 'gofly-core'),
            'content'     => esc_html__('Shows the destination posts selected in this tour\'s meta box. Becomes a Swiper carousel when there are more than 3 destinations.', 'gofly-core'),
        ]);

        $this->add_control('gofly_tdest_show_title', [
            'label'        => esc_html__('Show Section Title', 'gofly-core'),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Yes', 'gofly-core'),
            'label_off'    => esc_html__('No', 'gofly-core'),
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->add_control('gofly_tdest_title', [
            'label'     => esc_html__('Section Title', 'gofly-core'),
            'type'      => Controls_Manager::TEXT,
            'default'   => esc_html__('Tour Destinations', 'gofly-core'),
            'condition' => ['gofly_tdest_show_title' => 'yes'],
        ]);

        $this->end_controls_section();

        // Style: Card
        $this->start_controls_section('gofly_tdest_card_style', [
            'label' => esc_html__('Card Style', 'gofly-core'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('gofly_tdest_card_height', [
            'label'      => esc_html__('Card Height', 'gofly-core'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => ['px' => ['min' => 150, 'max' => 600]],
            'default'    => ['unit' => 'px', 'size' => 300],
            'selectors'  => ['{{WRAPPER}} .gofly-tdest-card' => 'height: {{SIZE}}{{UNIT}};'],
        ]);

        $this->add_responsive_control('gofly_tdest_border_radius', [
            'label'      => esc_html__('Border Radius', 'gofly-core'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => ['px' => ['min' => 0, 'max' => 40]],
            'default'    => ['unit' => 'px', 'size' => 16],
            'selectors'  => ['{{WRAPPER}} .gofly-tdest-card' => 'border-radius: {{SIZE}}{{UNIT}};'],
        ]);

        $this->end_controls_section();

        // Style: Label
        $this->start_controls_section('gofly_tdest_label_style', [
            'label' => esc_html__('Label Style', 'gofly-core'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'gofly_tdest_label_typography',
            'selector' => '{{WRAPPER}} .gofly-tdest-label',
        ]);

        $this->add_control('gofly_tdest_label_color', [
            'label'     => esc_html__('Color', 'gofly-core'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => ['{{WRAPPER}} .gofly-tdest-label' => 'color: {{VALUE}};'],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $meta     = get_post_meta(get_the_ID(), 'EGNS_TOUR_META_ID', true);
        $dest_ids = !empty($meta['tour_destination_select']) ? (array) $meta['tour_destination_select'] : [];

        if (empty($dest_ids)) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<p style="color:#aaa;font-style:italic;">' . esc_html__('No destinations selected for this tour. Add them in the Tour meta box → General tab.', 'gofly-core') . '</p>';
            }
            return;
        }

        $posts = get_posts([
            'post_type'      => 'destination',
            'post__in'       => $dest_ids,
            'orderby'        => 'post__in',
            'posts_per_page' => -1,
        ]);

        if (empty($posts)) return;

        $count      = count($posts);
        $is_carousel = $count > 3;
        $uid        = 'gofly-tdest-' . $this->get_id();
        $show_title = $settings['gofly_tdest_show_title'] === 'yes';
        $title      = $settings['gofly_tdest_title'] ?? '';
?>
        <div class="gofly-tour-destinations">
            <?php if ($show_title && !empty($title)) : ?>
                <h3 class="gofly-tdest-section-title"><?php echo esc_html($title); ?></h3>
            <?php endif; ?>

            <?php if ($is_carousel) : ?>
            <div class="swiper <?php echo esc_attr($uid); ?>">
                <div class="swiper-wrapper">
                    <?php foreach ($posts as $post) :
                        $thumb = get_the_post_thumbnail_url($post->ID, 'large');
                    ?>
                        <div class="swiper-slide">
                            <a href="<?php echo get_permalink($post->ID); ?>" class="gofly-tdest-card" <?php if ($thumb) echo 'style="background-image:url(' . esc_url($thumb) . ');"'; ?>>
                                <span class="gofly-tdest-label"><?php echo esc_html(get_the_title($post->ID)); ?></span>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next <?php echo esc_attr($uid); ?>-next"></div>
                <div class="swiper-button-prev <?php echo esc_attr($uid); ?>-prev"></div>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('.<?php echo esc_js($uid); ?>', {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: '.<?php echo esc_js($uid); ?>-next',
                        prevEl: '.<?php echo esc_js($uid); ?>-prev',
                    },
                    breakpoints: {
                        768:  { slidesPerView: 2, spaceBetween: 20 },
                        1024: { slidesPerView: 3, spaceBetween: 20 },
                    },
                });
            });
            </script>

            <?php else : ?>
            <div class="gofly-tdest-grid gofly-tdest-count-<?php echo $count; ?>">
                <?php foreach ($posts as $post) :
                    $thumb = get_the_post_thumbnail_url($post->ID, 'large');
                ?>
                    <a href="<?php echo get_permalink($post->ID); ?>" class="gofly-tdest-card" <?php if ($thumb) echo 'style="background-image:url(' . esc_url($thumb) . ');"'; ?>>
                        <span class="gofly-tdest-label"><?php echo esc_html(get_the_title($post->ID)); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

        <style>
            .gofly-tour-destinations { width: 100%; }
            .gofly-tdest-section-title { margin-bottom: 20px; }

            .gofly-tdest-card {
                display: block;
                position: relative;
                height: 300px;
                border-radius: 16px;
                overflow: hidden;
                background-size: cover;
                background-position: center;
                background-color: #ddd;
                text-decoration: none;
            }
            .gofly-tdest-label {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                padding: 30px 18px 16px;
                color: #fff;
                font-weight: 600;
                font-size: 15px;
                background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, transparent 100%);
                text-align: center;
            }

            /* Grid layout for ≤3 items */
            .gofly-tdest-grid {
                display: grid;
                gap: 20px;
            }
            .gofly-tdest-count-1 { grid-template-columns: 1fr; }
            .gofly-tdest-count-2 { grid-template-columns: 1fr 1fr; }
            .gofly-tdest-count-3 { grid-template-columns: 1fr 1fr; }
            .gofly-tdest-count-3 .gofly-tdest-card:first-child {
                grid-row: span 1;
            }

            /* Swiper nav buttons */
            .gofly-tour-destinations .swiper-button-next,
            .gofly-tour-destinations .swiper-button-prev {
                width: 40px;
                height: 40px;
                background: #ff5800;
                border-radius: 50%;
                color: #fff;
            }
            .gofly-tour-destinations .swiper-button-next::after,
            .gofly-tour-destinations .swiper-button-prev::after {
                font-size: 14px;
                font-weight: 700;
            }

            @media (max-width: 600px) {
                .gofly-tdest-count-2,
                .gofly-tdest-count-3 { grid-template-columns: 1fr; }
            }
        </style>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Gofly_Tour_Destination_Widget());