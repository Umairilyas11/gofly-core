<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

use Egns_Core\Egns_Helper;
use Elementor\Group_Control_Typography;

class Gofly_Tour_Gallery_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'gofly_tour_gallery';
    }

    public function get_title()
    {
        return esc_html__('EG Tour Gallery', 'gofly-core');
    }

    public function get_icon()
    {
        return 'egns-widget-icon';
    }

    public function get_categories()
    {
        return ['gofly_tour'];
    }

    protected function register_controls()
    {
        // ===================== Content ===================== //
        $this->start_controls_section(
            'gofly_tour_gallery_content_section',
            [
                'label' => esc_html__('Content', 'gofly-core'),
            ]
        );

        $this->add_control(
            'tour_gallery_panel_notice',
            [
                'type'        => \Elementor\Controls_Manager::NOTICE,
                'notice_type' => 'warning',
                'dismissible' => true,
                'heading'     => esc_html__('Notice', 'gofly-core'),
                'content'     => esc_html__('This widget is only for the Tour single/details page.', 'gofly-core'),
            ]
        );

        $this->add_control(
            'gofly_tour_gallery_view_all_label',
            [
                'label'       => esc_html__('View All Label', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('View All Media', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_tour_gallery_show_view_all',
            [
                'label'        => esc_html__('Show View All Button', 'gofly-core'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'gofly-core'),
                'label_off'    => esc_html__('Hide', 'gofly-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'gofly_tour_gallery_aspect_ratio',
            [
                'label'   => esc_html__('Main Image Height (px)', 'gofly-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 430,
                'min'     => 200,
                'max'     => 800,
            ]
        );

        $this->end_controls_section();

        // ===================== Style ===================== //
        $this->start_controls_section(
            'gofly_tour_gallery_style_section',
            [
                'label' => esc_html__('Gallery Style', 'gofly-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'gofly_tour_gallery_border_radius',
            [
                'label'      => esc_html__('Main Image Border Radius', 'gofly-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .eg-tour-gallery-main-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_gallery_arrow_bg_color',
            [
                'label'     => esc_html__('Arrow Background', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eg-tour-gallery-nav-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_gallery_arrow_color',
            [
                'label'     => esc_html__('Arrow Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eg-tour-gallery-nav-btn svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_gallery_view_all_color',
            [
                'label'     => esc_html__('View All Text Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eg-tour-gallery-view-all' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eg-tour-gallery-view-all svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'gofly_tour_gallery_view_all_typ',
                'label'    => esc_html__('View All Typography', 'gofly-core'),
                'selector' => '{{WRAPPER}} .eg-tour-gallery-view-all',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings  = $this->get_settings_for_display();
        $id        = get_the_ID();
        $main_h    = !empty($settings['gofly_tour_gallery_aspect_ratio']) ? intval($settings['gofly_tour_gallery_aspect_ratio']) : 430;

        // Collect images: featured + gallery
        $images = [];

        if (has_post_thumbnail()) {
            $images[] = [
                'url'  => get_the_post_thumbnail_url($id, 'full'),
                'alt'  => get_the_title(),
                'thumb' => get_the_post_thumbnail_url($id, 'thumbnail'),
            ];
        }

        $gallery_opt = Egns_Helper::egns_get_tour_value('tour_feature_image_gallery');
        if (!empty($gallery_opt)) {
            $gallery_ids = array_filter(array_map('trim', explode(',', $gallery_opt)));
            foreach ($gallery_ids as $img_id) {
                $full  = wp_get_attachment_image_url($img_id, 'full');
                $thumb = wp_get_attachment_image_url($img_id, 'thumbnail');
                $alt   = get_post_meta($img_id, '_wp_attachment_image_alt', true);
                if ($full) {
                    $images[] = [
                        'url'   => $full,
                        'alt'   => $alt ?: get_the_title(),
                        'thumb' => $thumb,
                    ];
                }
            }
        }

        if (empty($images)) {
            echo '<p>' . esc_html__('No gallery images found.', 'gofly-core') . '</p>';
            return;
        }

        $total      = count($images);
        $widget_id  = 'eg-tour-gallery-' . $this->get_id();
        $show_all   = $settings['gofly_tour_gallery_show_view_all'] === 'yes';
        $view_label = !empty($settings['gofly_tour_gallery_view_all_label']) ? $settings['gofly_tour_gallery_view_all_label'] : 'View All Media';
?>
        <div class="eg-tour-gallery-wrap" id="<?php echo esc_attr($widget_id); ?>">

            <!-- Main Image -->
            <div class="eg-tour-gallery-main" style="position:relative; overflow:hidden; height:<?php echo esc_attr($main_h); ?>px; border-radius:12px; background:#111;">
                <?php foreach ($images as $index => $img): ?>
                    <div class="eg-tour-gallery-slide<?php echo $index === 0 ? ' active' : ''; ?>" data-index="<?php echo esc_attr($index); ?>"
                        style="display:<?php echo $index === 0 ? 'block' : 'none'; ?>; height:100%;">
                        <img class="eg-tour-gallery-main-img"
                            src="<?php echo esc_url($img['url']); ?>"
                            alt="<?php echo esc_attr($img['alt']); ?>"
                            style="width:100%; height:<?php echo esc_attr($main_h); ?>px; object-fit:cover; display:block;">
                    </div>
                <?php endforeach; ?>

                <!-- Prev / Next arrows -->
                <?php if ($total > 1): ?>
                    <button class="eg-tour-gallery-nav-btn eg-tour-gallery-prev" aria-label="Previous"
                        style="position:absolute; left:14px; top:50%; transform:translateY(-50%); z-index:10; border:none; cursor:pointer; width:38px; height:38px; border-radius:50%; background:rgba(0,0,0,0.45); display:flex; align-items:center; justify-content:center;">
                        <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.5 1L1.5 8L8.5 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button class="eg-tour-gallery-nav-btn eg-tour-gallery-next" aria-label="Next"
                        style="position:absolute; right:14px; top:50%; transform:translateY(-50%); z-index:10; border:none; cursor:pointer; width:38px; height:38px; border-radius:50%; background:rgba(0,0,0,0.45); display:flex; align-items:center; justify-content:center;">
                        <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 1L8.5 8L1.5 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                <?php endif; ?>

                <!-- View All button -->
                <?php if ($show_all && $total > 1): ?>
                    <a href="#" class="eg-tour-gallery-view-all eg-tour-gallery-lightbox-open"
                       style="position:absolute; bottom:16px; right:18px; display:inline-flex; align-items:center; gap:6px; font-size:14px; font-weight:600; color:#fff; text-decoration:none; background:rgba(0,0,0,0.45); border-radius:30px; padding:6px 14px; backdrop-filter:blur(4px);">
                        <?php echo esc_html($view_label . ' ' . $total); ?>
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 7H13M7 1L13 7L7 13" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Thumbnails -->
            <?php if ($total > 1): ?>
            <div class="eg-tour-gallery-thumbs" style="display:flex; gap:8px; margin-top:10px; overflow-x:auto; padding-bottom:4px;">
                <?php foreach ($images as $index => $img): ?>
                    <div class="eg-tour-gallery-thumb<?php echo $index === 0 ? ' active' : ''; ?>"
                         data-index="<?php echo esc_attr($index); ?>"
                         style="flex:0 0 auto; cursor:pointer; border-radius:6px; overflow:hidden; border:2px solid <?php echo $index === 0 ? 'var(--primary-color1, #e8604c)' : 'transparent'; ?>; transition:border-color .2s;">
                        <img src="<?php echo esc_url($img['thumb']); ?>"
                             alt="<?php echo esc_attr($img['alt']); ?>"
                             style="width:72px; height:52px; object-fit:cover; display:block;">
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Lightbox -->
            <?php if ($show_all && $total > 1): ?>
            <div class="eg-tour-gallery-lightbox" style="display:none; position:fixed; inset:0; z-index:99999; background:rgba(0,0,0,0.92); align-items:center; justify-content:center; flex-direction:column;">
                <button class="eg-tour-gallery-lightbox-close" style="position:absolute; top:18px; right:22px; background:none; border:none; color:#fff; font-size:28px; cursor:pointer; z-index:2; line-height:1;">&times;</button>
                <div class="eg-tour-lightbox-inner" style="position:relative; width:90vw; max-width:960px; max-height:80vh; display:flex; align-items:center; justify-content:center;">
                    <button class="eg-tour-lightbox-prev" style="position:absolute; left:-50px; background:rgba(255,255,255,0.15); border:none; border-radius:50%; width:40px; height:40px; cursor:pointer; color:#fff; font-size:20px; display:flex; align-items:center; justify-content:center;">&#8592;</button>
                    <img class="eg-tour-lightbox-img" src="" alt="" style="max-width:100%; max-height:78vh; border-radius:8px; object-fit:contain; display:block;">
                    <button class="eg-tour-lightbox-next" style="position:absolute; right:-50px; background:rgba(255,255,255,0.15); border:none; border-radius:50%; width:40px; height:40px; cursor:pointer; color:#fff; font-size:20px; display:flex; align-items:center; justify-content:center;">&#8594;</button>
                </div>
                <div class="eg-tour-lightbox-counter" style="color:#ccc; margin-top:14px; font-size:14px;"></div>
            </div>
            <?php endif; ?>
        </div>

        <script>
        (function () {
            var wrap      = document.getElementById('<?php echo esc_js($widget_id); ?>');
            if (!wrap) return;

            var slides    = wrap.querySelectorAll('.eg-tour-gallery-slide');
            var thumbs    = wrap.querySelectorAll('.eg-tour-gallery-thumb');
            var prevBtn   = wrap.querySelector('.eg-tour-gallery-prev');
            var nextBtn   = wrap.querySelector('.eg-tour-gallery-next');
            var current   = 0;
            var total     = slides.length;

            function goTo(idx) {
                slides[current].style.display = 'none';
                if (thumbs[current]) thumbs[current].style.borderColor = 'transparent';
                current = (idx + total) % total;
                slides[current].style.display = 'block';
                if (thumbs[current]) {
                    thumbs[current].style.borderColor = 'var(--primary-color1, #e8604c)';
                    thumbs[current].scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                }
                // sync lightbox
                var lbImg = wrap.querySelector('.eg-tour-lightbox-img');
                var lbCnt = wrap.querySelector('.eg-tour-lightbox-counter');
                if (lbImg) lbImg.src = slides[current].querySelector('img').src;
                if (lbCnt) lbCnt.textContent = (current + 1) + ' / ' + total;
            }

            if (prevBtn) prevBtn.addEventListener('click', function(e){ e.preventDefault(); goTo(current - 1); });
            if (nextBtn) nextBtn.addEventListener('click', function(e){ e.preventDefault(); goTo(current + 1); });

            thumbs.forEach(function(th) {
                th.addEventListener('click', function() { goTo(parseInt(this.dataset.index)); });
            });

            // Lightbox
            var lb       = wrap.querySelector('.eg-tour-gallery-lightbox');
            var openBtn  = wrap.querySelector('.eg-tour-gallery-lightbox-open');
            var closeBtn = wrap.querySelector('.eg-tour-gallery-lightbox-close');
            var lbPrev   = wrap.querySelector('.eg-tour-lightbox-prev');
            var lbNext   = wrap.querySelector('.eg-tour-lightbox-next');
            var lbImg    = wrap.querySelector('.eg-tour-lightbox-img');
            var lbCnt    = wrap.querySelector('.eg-tour-lightbox-counter');

            if (lb && openBtn) {
                openBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    lb.style.display = 'flex';
                    if (lbImg) lbImg.src = slides[current].querySelector('img').src;
                    if (lbCnt) lbCnt.textContent = (current + 1) + ' / ' + total;
                    document.body.style.overflow = 'hidden';
                });
                if (closeBtn) closeBtn.addEventListener('click', function() {
                    lb.style.display = 'none';
                    document.body.style.overflow = '';
                });
                lb.addEventListener('click', function(e) {
                    if (e.target === lb) { lb.style.display = 'none'; document.body.style.overflow = ''; }
                });
                if (lbPrev) lbPrev.addEventListener('click', function() { goTo(current - 1); });
                if (lbNext) lbNext.addEventListener('click', function() { goTo(current + 1); });

                document.addEventListener('keydown', function(e) {
                    if (lb.style.display !== 'flex') return;
                    if (e.key === 'Escape') { lb.style.display = 'none'; document.body.style.overflow = ''; }
                    if (e.key === 'ArrowLeft') goTo(current - 1);
                    if (e.key === 'ArrowRight') goTo(current + 1);
                });
            }
        })();
        </script>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Gofly_Tour_Gallery_Widget());
