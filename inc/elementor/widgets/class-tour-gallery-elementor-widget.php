<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

use Egns_Core\Egns_Helper;
use Elementor\Group_Control_Typography;

class Gofly_Tour_Gallery_Widget extends Widget_Base
{
    public function get_name()   { return 'gofly_tour_gallery'; }
    public function get_title()  { return esc_html__('EG Tour Gallery', 'gofly-core'); }
    public function get_icon()   { return 'egns-widget-icon'; }
    public function get_categories() { return ['gofly_tour']; }

    protected function register_controls()
    {
        // ===================== Content ===================== //
        $this->start_controls_section('gofly_tour_gallery_content_section', ['label' => esc_html__('Content', 'gofly-core')]);

        $this->add_control('tour_gallery_panel_notice', [
            'type' => \Elementor\Controls_Manager::NOTICE, 'notice_type' => 'warning', 'dismissible' => true,
            'heading' => esc_html__('Notice', 'gofly-core'),
            'content' => esc_html__('This widget is only for the Tour single/details page.', 'gofly-core'),
        ]);

        $this->add_control('gofly_tour_gallery_view_all_label', [
            'label' => esc_html__('View All Label', 'gofly-core'),
            'type'  => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('View All Media', 'gofly-core'),
            'label_block' => true,
        ]);

        $this->add_control('gofly_tour_gallery_show_view_all', [
            'label' => esc_html__('Show View All Button', 'gofly-core'),
            'type'  => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'gofly-core'), 'label_off' => esc_html__('Hide', 'gofly-core'),
            'return_value' => 'yes', 'default' => 'yes',
        ]);

        $this->add_control('gofly_tour_gallery_aspect_ratio', [
            'label' => esc_html__('Main Image Height (px)', 'gofly-core'),
            'type'  => Controls_Manager::NUMBER,
            'default' => 430, 'min' => 200, 'max' => 800,
        ]);

        $this->add_control('gofly_tour_gallery_autoplay', [
            'label' => esc_html__('Autoplay', 'gofly-core'),
            'type'  => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'gofly-core'), 'label_off' => esc_html__('Off', 'gofly-core'),
            'return_value' => 'yes', 'default' => 'yes',
        ]);

        $this->add_control('gofly_tour_gallery_autoplay_speed', [
            'label'     => esc_html__('Autoplay Interval (ms)', 'gofly-core'),
            'type'      => Controls_Manager::NUMBER,
            'default'   => 4000, 'min' => 1000, 'max' => 15000, 'step' => 500,
            'condition' => ['gofly_tour_gallery_autoplay' => 'yes'],
        ]);

        $this->end_controls_section();

        // ===================== Style ===================== //
        $this->start_controls_section('gofly_tour_gallery_style_section', [
            'label' => esc_html__('Gallery Style', 'gofly-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('gofly_tour_gallery_border_radius', [
            'label' => esc_html__('Image Border Radius', 'gofly-core'),
            'type'  => Controls_Manager::DIMENSIONS, 'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .eg-tg-slide img'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .eg-tg-main-wrap'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control('gofly_tour_gallery_arrow_bg_color', [
            'label' => esc_html__('Arrow Background', 'gofly-core'), 'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .eg-tg-nav-btn' => 'background-color: {{VALUE}} !important;'],
        ]);

        $this->add_control('gofly_tour_gallery_arrow_color', [
            'label' => esc_html__('Arrow Color', 'gofly-core'), 'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .eg-tg-nav-btn svg path' => 'stroke: {{VALUE}} !important;'],
        ]);

        $this->add_control('gofly_tour_gallery_dot_color', [
            'label' => esc_html__('Dot Color (inactive)', 'gofly-core'), 'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .eg-tg-dot' => 'background: {{VALUE}};'],
        ]);

        $this->add_control('gofly_tour_gallery_dot_active_color', [
            'label' => esc_html__('Dot Color (active)', 'gofly-core'), 'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .eg-tg-dot.active' => 'background: {{VALUE}};'],
        ]);

        $this->add_control('gofly_tour_gallery_view_all_color', [
            'label' => esc_html__('View All Text Color', 'gofly-core'), 'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .eg-tg-view-all' => 'color: {{VALUE}};'],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'gofly_tour_gallery_view_all_typ',
            'label'    => esc_html__('View All Typography', 'gofly-core'),
            'selector' => '{{WRAPPER}} .eg-tg-view-all',
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings  = $this->get_settings_for_display();
        $id        = get_the_ID();
        $main_h    = !empty($settings['gofly_tour_gallery_aspect_ratio']) ? intval($settings['gofly_tour_gallery_aspect_ratio']) : 430;
        $autoplay  = ($settings['gofly_tour_gallery_autoplay'] ?? 'yes') === 'yes';
        $ap_speed  = !empty($settings['gofly_tour_gallery_autoplay_speed']) ? intval($settings['gofly_tour_gallery_autoplay_speed']) : 4000;
        $show_all  = ($settings['gofly_tour_gallery_show_view_all'] ?? 'yes') === 'yes';
        $view_lbl  = !empty($settings['gofly_tour_gallery_view_all_label']) ? $settings['gofly_tour_gallery_view_all_label'] : 'View All Media';

        $images = [];
        if (has_post_thumbnail()) {
            $images[] = ['url' => get_the_post_thumbnail_url($id, 'full'), 'alt' => get_the_title()];
        }
        $gallery_opt = Egns_Helper::egns_get_tour_value('tour_feature_image_gallery');
        if (!empty($gallery_opt)) {
            foreach (array_filter(array_map('trim', explode(',', $gallery_opt))) as $img_id) {
                $full = wp_get_attachment_image_url($img_id, 'full');
                if ($full) {
                    $images[] = ['url' => $full, 'alt' => get_post_meta($img_id, '_wp_attachment_image_alt', true) ?: get_the_title()];
                }
            }
        }

        if (empty($images)) { echo '<p>' . esc_html__('No gallery images found.', 'gofly-core') . '</p>'; return; }

        $total = count($images);
        $wid   = 'eg-tg-' . $this->get_id();
        $sel   = '#' . esc_attr($wid);
        ?>
<style>
<?php echo $sel; ?> .eg-tg-main-wrap {
    position: relative;
    overflow: hidden;
    height: <?php echo $main_h; ?>px;
    border-radius: 12px;
    background: #111;
    user-select: none
}

<?php echo $sel; ?> .eg-tg-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity .6s ease;
    pointer-events: none
}

<?php echo $sel; ?> .eg-tg-slide.active {
    opacity: 1;
    pointer-events: auto
}

<?php echo $sel; ?> .eg-tg-slide img {
    width: 100%;
    height: <?php echo $main_h; ?>px;
    object-fit: cover;
    display: block;
    border-radius: 12px
}

<?php echo $sel; ?> .eg-tg-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    border: none;
    cursor: pointer;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(0, 0, 0, .48);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s
}

<?php echo $sel; ?> .eg-tg-nav-btn:hover {
    background: rgba(0, 0, 0, .72)
}

<?php echo $sel; ?> .eg-tg-prev {
    left: 14px
}

<?php echo $sel; ?> .eg-tg-next {
    right: 14px
}

<?php echo $sel; ?> .eg-tg-dots {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin-top: 10px;
    flex-wrap: wrap
}

<?php echo $sel; ?> .eg-tg-dot {
    width: 80px;
    height: 60px;
    border-radius: 6px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    padding: 0;
    opacity: .65;
    transition: all .3s ease;
    flex-shrink: 0
}

<?php echo $sel; ?> .eg-tg-dot img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    pointer-events: none
}

<?php echo $sel; ?> .eg-tg-dot.active {
    border-color: #000;
    opacity: 1
}

<?php echo $sel; ?> .eg-tg-view-all {
    position: absolute;
    bottom: 14px;
    right: 16px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    background: rgba(0, 0, 0, .52);
    border-radius: 30px;
    padding: 6px 14px;
    backdrop-filter: blur(4px);
    z-index: 10;
    transition: background .2s
}

<?php echo $sel; ?> .eg-tg-view-all:hover {
    background: rgba(0, 0, 0, .75);
    color: #fff
}

.eg-tg-lb {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 99999;
    background: rgba(0, 0, 0, .92);
    align-items: center;
    justify-content: center;
    flex-direction: column
}

.eg-tg-lb.open {
    display: flex
}

.eg-tg-lb-close {
    position: absolute;
    top: 18px;
    right: 22px;
    background: rgba(255, 255, 255, .12);
    border: none;
    color: #fff;
    font-size: 22px;
    cursor: pointer;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center
}

.eg-tg-lb-inner {
    position: relative;
    width: 90vw;
    max-width: 960px;
    max-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center
}

.eg-tg-lb-img {
    max-width: 100%;
    max-height: 78vh;
    border-radius: 8px;
    object-fit: contain;
    display: block
}

.eg-tg-lb-prev,
.eg-tg-lb-next {
    position: absolute;
    background: rgba(255, 255, 255, .15);
    border: none;
    border-radius: 50%;
    width: 42px;
    height: 42px;
    cursor: pointer;
    color: #fff;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center
}

.eg-tg-lb-prev {
    left: -54px
}

.eg-tg-lb-next {
    right: -54px
}

.eg-tg-lb-counter {
    color: #bbb;
    margin-top: 14px;
    font-size: 13px;
    letter-spacing: .5px
}
</style>

<div id="<?php echo esc_attr($wid); ?>">
    <div class="eg-tg-main-wrap">
        <?php foreach ($images as $i => $img): ?>
        <div class="eg-tg-slide<?php echo $i === 0 ? ' active' : ''; ?>" data-index="<?php echo $i; ?>">
            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
        </div>
        <?php endforeach; ?>

        <?php if ($total > 1): ?>
        <button class="eg-tg-nav-btn eg-tg-prev" aria-label="<?php esc_attr_e('Previous', 'gofly-core'); ?>">
            <svg width="10" height="16" viewBox="0 0 10 16" fill="none">
                <path d="M8.5 1L1.5 8L8.5 15" stroke="white" stroke-width="2.2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <button class="eg-tg-nav-btn eg-tg-next" aria-label="<?php esc_attr_e('Next', 'gofly-core'); ?>">
            <svg width="10" height="16" viewBox="0 0 10 16" fill="none">
                <path d="M1.5 1L8.5 8L1.5 15" stroke="white" stroke-width="2.2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <?php endif; ?>

        <?php if ($show_all && $total > 1): ?>
        <a href="#" class="eg-tg-view-all eg-tg-lb-open">
            <?php echo esc_html($view_lbl . ' ' . $total); ?>
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                <path d="M1 6.5H12M6.5 1L12 6.5L6.5 12" stroke="white" stroke-width="1.8" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        <?php endif; ?>
    </div>
    <?php if ($total > 1): ?>
    <div class="eg-tg-dots">
        <?php foreach ($images as $i => $img): ?>
        <button class="eg-tg-dot<?php echo $i === 0 ? ' active' : ''; ?>" data-index="<?php echo $i; ?>"
            aria-label="Slide <?php echo $i + 1; ?>">
            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
        </button>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php if ($show_all && $total > 1): ?>
    <div class="eg-tg-lb" id="<?php echo esc_attr($wid); ?>-lb">
        <button class="eg-tg-lb-close">&times;</button>
        <div class="eg-tg-lb-inner">
            <button class="eg-tg-lb-prev">&#8592;</button>
            <img class="eg-tg-lb-img" src="" alt="">
            <button class="eg-tg-lb-next">&#8594;</button>
        </div>
        <div class="eg-tg-lb-counter"></div>
    </div>
    <?php endif; ?>
</div>

<script>
(function() {
    var wid = <?php echo json_encode($wid); ?>;
    var wrap = document.getElementById(wid);
    if (!wrap) return;
    var slides = wrap.querySelectorAll('.eg-tg-slide');
    var dots = wrap.querySelectorAll('.eg-tg-dot');
    var prev = wrap.querySelector('.eg-tg-prev');
    var next = wrap.querySelector('.eg-tg-next');
    var cur = 0,
        total = slides.length,
        timer = null;
    var autoplay = <?php echo $autoplay ? 'true' : 'false'; ?>;
    var apSpeed = <?php echo $ap_speed; ?>;

    function goTo(idx) {
        slides[cur].classList.remove('active');
        if (dots[cur]) dots[cur].classList.remove('active');
        cur = (idx + total) % total;
        slides[cur].classList.add('active');
        if (dots[cur]) dots[cur].classList.add('active');
        syncLb();
    }

    function syncLb() {
        var lb = document.getElementById(wid + '-lb');
        if (!lb) return;
        var img = lb.querySelector('.eg-tg-lb-img');
        var cnt = lb.querySelector('.eg-tg-lb-counter');
        if (img) img.src = slides[cur].querySelector('img').src;
        if (cnt) cnt.textContent = (cur + 1) + ' / ' + total;
    }

    function startAp() {
        if (!autoplay || total <= 1) return;
        timer = setInterval(function() {
            goTo(cur + 1);
        }, apSpeed);
    }

    function stopAp() {
        if (timer) {
            clearInterval(timer);
            timer = null;
        }
    }

    if (prev) prev.addEventListener('click', function(e) {
        e.preventDefault();
        stopAp();
        goTo(cur - 1);
        startAp();
    });
    if (next) next.addEventListener('click', function(e) {
        e.preventDefault();
        stopAp();
        goTo(cur + 1);
        startAp();
    });
    dots.forEach(function(d) {
        d.addEventListener('click', function() {
            stopAp();
            goTo(parseInt(this.dataset.index));
            startAp();
        });
    });

    var mw = wrap.querySelector('.eg-tg-main-wrap');
    var tx = 0;
    if (mw) {
        mw.addEventListener('touchstart', function(e) {
            tx = e.changedTouches[0].screenX;
        }, {
            passive: true
        });
        mw.addEventListener('touchend', function(e) {
            var d = tx - e.changedTouches[0].screenX;
            if (Math.abs(d) > 40) {
                stopAp();
                goTo(d > 0 ? cur + 1 : cur - 1);
                startAp();
            }
        });
    }

    var lb = document.getElementById(wid + '-lb');
    var openBtn = wrap.querySelector('.eg-tg-lb-open');
    if (lb && openBtn) {
        var lbClose = lb.querySelector('.eg-tg-lb-close');
        var lbP = lb.querySelector('.eg-tg-lb-prev');
        var lbN = lb.querySelector('.eg-tg-lb-next');
        openBtn.addEventListener('click', function(e) {
            e.preventDefault();
            lb.classList.add('open');
            document.body.style.overflow = 'hidden';
            stopAp();
            syncLb();
        });

        function closeLb() {
            lb.classList.remove('open');
            document.body.style.overflow = '';
            startAp();
        }
        if (lbClose) lbClose.addEventListener('click', closeLb);
        lb.addEventListener('click', function(e) {
            if (e.target === lb) closeLb();
        });
        if (lbP) lbP.addEventListener('click', function() {
            goTo(cur - 1);
        });
        if (lbN) lbN.addEventListener('click', function() {
            goTo(cur + 1);
        });
        document.addEventListener('keydown', function(e) {
            if (!lb.classList.contains('open')) return;
            if (e.key === 'Escape') closeLb();
            if (e.key === 'ArrowLeft') goTo(cur - 1);
            if (e.key === 'ArrowRight') goTo(cur + 1);
        });
    }
    startAp();
})();
</script>
<?php
    }
}
Plugin::instance()->widgets_manager->register(new Gofly_Tour_Gallery_Widget());