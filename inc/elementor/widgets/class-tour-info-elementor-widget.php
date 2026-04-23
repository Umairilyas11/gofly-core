<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

class Gofly_Tour_Info_Widget extends Widget_Base
{
    public function get_name()       { return 'gofly_tour_info'; }
    public function get_title()      { return esc_html__('EG Tour Info', 'gofly-core'); }
    public function get_icon()       { return 'egns-widget-icon'; }
    public function get_categories() { return ['gofly_tour']; }

    protected function register_controls()
    {
        // ── Content ──────────────────────────────────────────────────────────
        $this->start_controls_section('gofly_tinfo_content', [
            'label' => esc_html__('Content', 'gofly-core'),
        ]);

        $this->add_control('gofly_tinfo_notice', [
            'type'        => Controls_Manager::NOTICE,
            'notice_type' => 'warning',
            'dismissible' => true,
            'heading'     => esc_html__('Notice', 'gofly-core'),
            'content'     => esc_html__('Reads the 6 Tour Info fields from the Tour meta box → Tour Info tab.', 'gofly-core'),
        ]);

        $this->add_control('gofly_tinfo_show_title', [
            'label'        => esc_html__('Show Section Title', 'gofly-core'),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->add_control('gofly_tinfo_title', [
            'label'     => esc_html__('Section Title', 'gofly-core'),
            'type'      => Controls_Manager::TEXT,
            'default'   => esc_html__('Tour Information', 'gofly-core'),
            'condition' => ['gofly_tinfo_show_title' => 'yes'],
        ]);

        $this->add_control('gofly_tinfo_columns', [
            'label'   => esc_html__('Columns', 'gofly-core'),
            'type'    => Controls_Manager::SELECT,
            'options' => ['2' => '2', '3' => '3', '6' => '6'],
            'default' => '3',
        ]);

        $this->end_controls_section();

        // ── Style: Label ──────────────────────────────────────────────────────
        $this->start_controls_section('gofly_tinfo_label_style', [
            'label' => esc_html__('Label', 'gofly-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('gofly_tinfo_label_color', [
            'label'     => esc_html__('Color', 'gofly-core'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#888888',
            'selectors' => ['{{WRAPPER}} .gofly-tinfo-label' => 'color: {{VALUE}};'],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'gofly_tinfo_label_typo',
            'label'    => esc_html__('Typography', 'gofly-core'),
            'selector' => '{{WRAPPER}} .gofly-tinfo-label',
        ]);

        $this->end_controls_section();

        // ── Style: Value ──────────────────────────────────────────────────────
        $this->start_controls_section('gofly_tinfo_value_style', [
            'label' => esc_html__('Value', 'gofly-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('gofly_tinfo_value_color', [
            'label'     => esc_html__('Color', 'gofly-core'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#222222',
            'selectors' => ['{{WRAPPER}} .gofly-tinfo-value' => 'color: {{VALUE}};'],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'gofly_tinfo_value_typo',
            'label'    => esc_html__('Typography', 'gofly-core'),
            'selector' => '{{WRAPPER}} .gofly-tinfo-value',
        ]);

        $this->end_controls_section();

        // ── Style: Icon ───────────────────────────────────────────────────────
        $this->start_controls_section('gofly_tinfo_icon_style', [
            'label' => esc_html__('Icon', 'gofly-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('gofly_tinfo_icon_color', [
            'label'     => esc_html__('Icon Color', 'gofly-core'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#444444',
            'selectors' => ['{{WRAPPER}} .gofly-tinfo-icon img' => 'filter: {{VALUE}};'],
        ]);

        $this->add_responsive_control('gofly_tinfo_icon_size', [
            'label'      => esc_html__('Icon Size', 'gofly-core'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => ['px' => ['min' => 20, 'max' => 80]],
            'default'    => ['unit' => 'px', 'size' => 36],
            'selectors' => ['{{WRAPPER}} .gofly-tinfo-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $meta     = get_post_meta(get_the_ID(), 'EGNS_TOUR_META_ID', true);

        $accommodation  = !empty($meta['tour_info_accommodation'])  ? esc_html($meta['tour_info_accommodation'])  : '';
        $meals          = !empty($meta['tour_info_meals'])          ? esc_html($meta['tour_info_meals'])          : '';
        $transportation = !empty($meta['tour_info_transportation'])  ? esc_html($meta['tour_info_transportation'])  : '';
        $language       = !empty($meta['tour_info_language'])       ? esc_html($meta['tour_info_language'])       : '';
        $season         = !empty($meta['tour_info_season'])         ? esc_html($meta['tour_info_season'])         : '';
        $category       = !empty($meta['tour_info_category'])       ? esc_html($meta['tour_info_category'])       : '';

        // Only show items that have a value
        $items = array_filter([
            'accommodation'  => ['label' => __('Accommodation', 'gofly-core'),  'value' => $accommodation,  'icon' => 'accommodation'],
            'meals'          => ['label' => __('Meals', 'gofly-core'),           'value' => $meals,          'icon' => 'meals'],
            'transportation' => ['label' => __('Transportation', 'gofly-core'),  'value' => $transportation, 'icon' => 'transportation'],
            'language'       => ['label' => __('Language', 'gofly-core'),        'value' => $language,       'icon' => 'language'],
            'season'         => ['label' => __('Season', 'gofly-core'),          'value' => $season,         'icon' => 'season'],
            'category'       => ['label' => __('Category', 'gofly-core'),        'value' => $category,       'icon' => 'category'],
        ], fn($item) => !empty($item['value']));

        if (empty($items)) return;

        $cols = intval($settings['gofly_tinfo_columns']);
        ?>
<div class="gofly-tinfo-wrap">
    <?php if ($settings['gofly_tinfo_show_title'] === 'yes' && !empty($settings['gofly_tinfo_title'])): ?>
    <h3 class="gofly-tinfo-section-title"><?php echo esc_html($settings['gofly_tinfo_title']); ?></h3>
    <?php endif; ?>

    <div class="gofly-tinfo-grid gofly-tinfo-cols-<?php echo esc_attr($cols); ?>">
        <?php foreach ($items as $item): ?>
        <div class="gofly-tinfo-item">
            <span class="gofly-tinfo-icon">
                <?php echo self::get_icon_svg($item['icon']); ?>
            </span>
            <div class="gofly-tinfo-text">
                <span class="gofly-tinfo-label"><?php echo esc_html($item['label']); ?></span>
                <strong class="gofly-tinfo-value"><?php echo esc_html($item['value']); ?></strong>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.gofly-tinfo-wrap {
    padding: 8px 0;
}

.gofly-tinfo-section-title {
    margin-bottom: 20px;
    font-size: 22px;
    font-weight: 700;
}

.gofly-tinfo-grid {
    display: grid;
    gap: 24px 16px;
}

.gofly-tinfo-cols-2 {
    grid-template-columns: repeat(2, 1fr);
}

.gofly-tinfo-cols-3 {
    grid-template-columns: repeat(3, 1fr);
}

.gofly-tinfo-cols-6 {
    grid-template-columns: repeat(6, 1fr);
}

@media (max-width: 767px) {

    .gofly-tinfo-cols-3,
    .gofly-tinfo-cols-6 {
        grid-template-columns: repeat(2, 1fr);
    }
}

.gofly-tinfo-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.gofly-tinfo-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* NEW */
.gofly-tinfo-icon img {
    width: 36px;
    height: 36px;
    object-fit: contain;
}

.gofly-tinfo-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.gofly-tinfo-label {
    font-size: 13px;
}

.gofly-tinfo-value {
    font-size: 15px;
    display: block;
}
</style>
<?php
    }

    /**
     * Returns inline SVG icon for each info type.
     * All icons use stroke (no fill) to match the screenshot style.
     */
   private static function get_icon_svg(string $key): string
{
    $icons = [
        'accommodation'  => 'https://vibesgroupuk.us/wp-content/uploads/2025/09/tour-details-icon1-1.svg',
        'meals'          => 'https://vibesgroupuk.us/wp-content/uploads/2025/09/tour-details-icon2-1.svg',
        'transportation' => 'https://vibesgroupuk.us/wp-content/uploads/2025/09/tour-details-icon3-1.svg',
        'language'       => 'https://vibesgroupuk.us/wp-content/uploads/2025/09/tour-details-icon5-1.svg',
        'season'         => 'https://vibesgroupuk.us/wp-content/uploads/2025/09/tour-details-icon8-1.svg',
        'category'       => 'https://vibesgroupuk.us/wp-content/uploads/2025/09/tour-details-icon9-1.svg',
    ];

    if (empty($icons[$key])) return '';

    return '<img src="' . esc_url($icons[$key]) . '" alt="' . esc_attr($key) . '" loading="lazy" />';
}
}

Plugin::instance()->widgets_manager->register(new Gofly_Tour_Info_Widget());