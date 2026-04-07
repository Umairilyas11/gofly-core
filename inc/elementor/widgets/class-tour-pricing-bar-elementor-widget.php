<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

use Egns_Core\Egns_Helper;
use Elementor\Group_Control_Typography;

class Gofly_Tour_Pricing_Bar_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'gofly_tour_pricing_bar';
    }

    public function get_title()
    {
        return esc_html__('EG Tour Pricing Bar', 'gofly-core');
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
            'gofly_tour_pbar_content',
            ['label' => esc_html__('Content', 'gofly-core')]
        );

        $this->add_control(
            'tour_pbar_panel_notice',
            [
                'type'        => \Elementor\Controls_Manager::NOTICE,
                'notice_type' => 'warning',
                'dismissible' => true,
                'heading'     => esc_html__('Notice', 'gofly-core'),
                'content'     => esc_html__('This widget is only for the Tour single/details page.', 'gofly-core'),
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_deal_label',
            [
                'label'       => esc_html__('Deal / Sale Label', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Travel Sale', 'gofly-core'),
                'placeholder' => esc_html__('e.g. Travel Sale', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_from_label',
            [
                'label'   => esc_html__('From Label', 'gofly-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('From', 'gofly-core'),
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_was_label',
            [
                'label'   => esc_html__('Was Label', 'gofly-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Was', 'gofly-core'),
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_save_label',
            [
                'label'   => esc_html__('Save Label', 'gofly-core'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Save up to', 'gofly-core'),
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_quote_btn_label',
            [
                'label'       => esc_html__('Quote Button Label', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Easy Quote', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_call_btn_label',
            [
                'label'       => esc_html__('Call Button Label', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Call Us', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_phone_number',
            [
                'label'       => esc_html__('Phone Number', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '+1 800 000 0000',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_sticky_offset',
            [
                'label'       => esc_html__('Sticky Trigger (scroll px)', 'gofly-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 200,
                'min'         => 0,
                'description' => esc_html__('How many pixels to scroll before the bar sticks to the top.', 'gofly-core'),
            ]
        );

        $this->end_controls_section();

        // ===================== Style – Pricing Box ===================== //
        $this->start_controls_section(
            'gofly_tour_pbar_pricing_style',
            [
                'label' => esc_html__('Pricing Area', 'gofly-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_box_bg',
            [
                'label'     => esc_html__('Box Background', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eg-tour-pricing-bar' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gofly_tour_pbar_box_radius',
            [
                'label'      => esc_html__('Border Radius', 'gofly-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .eg-tour-pricing-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_deal_color',
            [
                'label'     => esc_html__('Deal Label Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eg-pbar-deal-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'gofly_tour_pbar_price_typ',
                'label'    => esc_html__('Main Price Typography', 'gofly-core'),
                'selector' => '{{WRAPPER}} .eg-pbar-price-main',
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_price_color',
            [
                'label'     => esc_html__('Main Price Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eg-pbar-price-main' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_old_price_color',
            [
                'label'     => esc_html__('Old Price Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eg-pbar-old-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_save_badge_bg',
            [
                'label'     => esc_html__('Save Badge Background', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eg-pbar-save-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_save_badge_color',
            [
                'label'     => esc_html__('Save Badge Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eg-pbar-save-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ===================== Style – Quote Button ===================== //
        $this->start_controls_section(
            'gofly_tour_pbar_quote_btn_style',
            [
                'label' => esc_html__('Quote Button', 'gofly-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'gofly_tour_pbar_quote_typ',
                'selector' => '{{WRAPPER}} .eg-pbar-quote-btn',
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_quote_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .eg-pbar-quote-btn' => 'color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_quote_hover_color',
            [
                'label'     => esc_html__('Hover Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .eg-pbar-quote-btn:hover' => 'color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_quote_bg',
            [
                'label'     => esc_html__('Background', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .eg-pbar-quote-btn' => 'background-color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_quote_hover_bg',
            [
                'label'     => esc_html__('Hover Background', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .eg-pbar-quote-btn:hover' => 'background-color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_quote_border_color',
            [
                'label'     => esc_html__('Border Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .eg-pbar-quote-btn' => 'border-color: {{VALUE}};'],
            ]
        );

        $this->add_responsive_control(
            'gofly_tour_pbar_quote_radius',
            [
                'label'      => esc_html__('Border Radius', 'gofly-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .eg-pbar-quote-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ===================== Style – Call Button ===================== //
        $this->start_controls_section(
            'gofly_tour_pbar_call_btn_style',
            [
                'label' => esc_html__('Call Button', 'gofly-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'gofly_tour_pbar_call_typ',
                'selector' => '{{WRAPPER}} .eg-pbar-call-btn',
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_call_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .eg-pbar-call-btn' => 'color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_call_hover_color',
            [
                'label'     => esc_html__('Hover Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .eg-pbar-call-btn:hover' => 'color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_call_bg',
            [
                'label'     => esc_html__('Background', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .eg-pbar-call-btn' => 'background-color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_call_hover_bg',
            [
                'label'     => esc_html__('Hover Background', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .eg-pbar-call-btn:hover' => 'background-color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_call_border_color',
            [
                'label'     => esc_html__('Border Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .eg-pbar-call-btn' => 'border-color: {{VALUE}};'],
            ]
        );

        $this->add_responsive_control(
            'gofly_tour_pbar_call_radius',
            [
                'label'      => esc_html__('Border Radius', 'gofly-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .eg-pbar-call-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ===================== Style – Sticky Bar ===================== //
        $this->start_controls_section(
            'gofly_tour_pbar_sticky_style',
            [
                'label' => esc_html__('Sticky Bar Style', 'gofly-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_sticky_bg',
            [
                'label'     => esc_html__('Sticky Bar Background', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.eg-tour-sticky-bar-<?php echo $this->get_id(); ?>' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_pbar_sticky_shadow',
            [
                'label'     => esc_html__('Show Shadow', 'gofly-core'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'selectors' => [
                    '.eg-tour-sticky-bar-<?php echo $this->get_id(); ?>' => 'box-shadow: 0 4px 20px rgba(0,0,0,0.12);',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings   = $this->get_settings_for_display();
        $id         = get_the_ID();
        $widget_id  = $this->get_id();

        // Pricing data
        $meta          = get_post_meta($id, 'EGNS_TOUR_META_ID', true);
        $tour_packages = $meta['tour_pricing_package'] ?? [];
        $has_sale      = Egns_Helper::has_sale_price($id);

        // Calculate min sale price and min regular price for display
        $min_sale    = null;
        $min_regular = null;

        if (is_array($tour_packages)) {
            foreach ($tour_packages as $package) {
                $reg_prices  = $package['trip_price_table']['regular_price'] ?? [];
                $sale_prices = $package['trip_price_table']['sale_price'] ?? [];

                foreach ($reg_prices as $taxonomy => $reg_values) {
                    if (!is_array($reg_values)) continue;
                    foreach ($reg_values as $index => $reg_price) {
                        $reg  = ($reg_price !== '' && $reg_price !== null) ? floatval($reg_price) : 0;
                        $sale = isset($sale_prices[$taxonomy][$index]) && $sale_prices[$taxonomy][$index] !== ''
                            ? floatval($sale_prices[$taxonomy][$index])
                            : null;

                        if ($reg > 0) {
                            $min_regular = ($min_regular === null || $reg < $min_regular) ? $reg : $min_regular;
                        }
                        if ($sale !== null && $sale > 0) {
                            $min_sale = ($min_sale === null || $sale < $min_sale) ? $sale : $min_sale;
                        }
                    }
                }
            }
        }

        $current_price = ($min_sale !== null && $min_sale < $min_regular) ? $min_sale : $min_regular;
        $old_price     = ($min_sale !== null && $min_sale < $min_regular) ? $min_regular : null;
        $savings       = ($old_price !== null && $current_price !== null) ? ($old_price - $current_price) : null;

        $deal_label  = esc_html($settings['gofly_tour_pbar_deal_label'] ?? 'Travel Sale');
        $from_label  = esc_html($settings['gofly_tour_pbar_from_label'] ?? 'From');
        $was_label   = esc_html($settings['gofly_tour_pbar_was_label'] ?? 'Was');
        $save_label  = esc_html($settings['gofly_tour_pbar_save_label'] ?? 'Save up to');
        $quote_label = esc_html($settings['gofly_tour_pbar_quote_btn_label'] ?? 'Easy Quote');
        $call_label  = esc_html($settings['gofly_tour_pbar_call_btn_label'] ?? 'Call Us');
        $phone       = esc_attr($settings['gofly_tour_pbar_phone_number'] ?? '');
        $offset      = intval($settings['gofly_tour_pbar_sticky_offset'] ?? 200);
?>
<style>
.eg-tour-pricing-bar {
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    padding: 22px 24px;
    font-family: inherit;
}
.eg-pbar-deal-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
}
.eg-pbar-deal-label {
    font-size: 13px;
    font-weight: 600;
    color: #555;
    text-transform: uppercase;
    letter-spacing: .5px;
}
.eg-pbar-from-row {
    display: flex;
    align-items: baseline;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 8px;
}
.eg-pbar-from-txt {
    font-size: 14px;
    color: #444;
    font-weight: 500;
}
.eg-pbar-price-main {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    line-height: 1;
}
.eg-pbar-was-row {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
    flex-wrap: wrap;
}
.eg-pbar-old-price {
    font-size: 14px;
    color: #999;
    text-decoration: line-through;
}
.eg-pbar-save-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #b32a2a;
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 4px;
}
.eg-pbar-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.eg-pbar-quote-btn,
.eg-pbar-call-btn {
    flex: 1;
    min-width: 120px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 13px 20px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 8px;
    border: 2px solid;
    cursor: pointer;
    text-decoration: none;
    transition: background .2s, color .2s, border-color .2s;
    line-height: 1;
}
.eg-pbar-quote-btn {
    background: #b32a2a;
    color: #fff;
    border-color: #b32a2a;
}
.eg-pbar-quote-btn:hover {
    background: #8f2020;
    border-color: #8f2020;
    color: #fff;
}
.eg-pbar-call-btn {
    background: #fff;
    color: #b32a2a;
    border-color: #b32a2a;
}
.eg-pbar-call-btn:hover {
    background: #b32a2a;
    color: #fff;
}

/* Sticky floating bar */
.eg-tour-sticky-bar {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 9990;
    background: #fff;
    padding: 10px 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    border-bottom: 1px solid #eee;
}
.eg-tour-sticky-bar.eg-sticky-visible {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
}
.eg-tour-sticky-info {
    display: flex;
    align-items: baseline;
    gap: 10px;
    flex-wrap: wrap;
}
.eg-tour-sticky-title {
    font-size: 16px;
    font-weight: 700;
    color: #1a1a1a;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 260px;
}
.eg-tour-sticky-price {
    font-size: 15px;
    font-weight: 700;
    color: #b32a2a;
}
.eg-tour-sticky-btns {
    display: flex;
    gap: 8px;
    flex-shrink: 0;
}
.eg-tour-sticky-btns .eg-pbar-quote-btn,
.eg-tour-sticky-btns .eg-pbar-call-btn {
    padding: 9px 18px;
    font-size: 14px;
    min-width: unset;
    flex: unset;
}
</style>

<div class="eg-tour-pricing-bar" id="eg-pricing-bar-<?php echo esc_attr($widget_id); ?>">

    <!-- Deal label row -->
    <?php if (!empty($deal_label)): ?>
    <div class="eg-pbar-deal-row">
        <span class="eg-pbar-deal-label"><?php echo $deal_label; ?></span>
        <?php if ($has_sale): ?>
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="7" cy="7" r="6.5" stroke="#b32a2a"/>
                <path d="M7 4v3.5l2 2" stroke="#b32a2a" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Main price row -->
    <div class="eg-pbar-from-row">
        <span class="eg-pbar-from-txt"><?php echo $from_label; ?></span>
        <?php if ($current_price !== null): ?>
            <span class="eg-pbar-price-main"><?php echo Egns_Helper::gofly_format_price($current_price); ?></span>
        <?php else: ?>
            <span class="eg-pbar-price-main"><?php echo esc_html__('Contact Us', 'gofly-core'); ?></span>
        <?php endif; ?>
    </div>

    <!-- Was / Save row -->
    <?php if ($old_price !== null && $savings !== null): ?>
    <div class="eg-pbar-was-row">
        <span class="eg-pbar-old-price"><?php echo $was_label; ?> <?php echo Egns_Helper::gofly_format_price($old_price); ?></span>
        <span class="eg-pbar-save-badge">
            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 5h8M5 1v8" stroke="#fff" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <?php echo $save_label . ' ' . Egns_Helper::gofly_format_price($savings); ?>
        </span>
    </div>
    <?php endif; ?>

    <!-- Buttons -->
    <div class="eg-pbar-buttons">
        <!-- Quote button → opens the same enquiry modal as EG Tour Check Availability -->
        <button class="eg-pbar-quote-btn"
            data-bs-toggle="modal"
            data-bs-target="#enquiry<?php echo esc_attr($id); ?>">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <?php echo $quote_label; ?>
        </button>

        <!-- Call button -->
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>" class="eg-pbar-call-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.25h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.84a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 16.92z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <?php echo $call_label; ?>
        </a>
        <?php endif; ?>
    </div>
</div>

<!-- Sticky bar that appears at top when scrolling -->
<div class="eg-tour-sticky-bar eg-tour-sticky-bar-<?php echo esc_attr($widget_id); ?>" id="eg-sticky-bar-<?php echo esc_attr($widget_id); ?>">
    <div class="eg-tour-sticky-info">
        <span class="eg-tour-sticky-title"><?php the_title(); ?></span>
        <?php if ($current_price !== null): ?>
            <span class="eg-tour-sticky-price"><?php echo Egns_Helper::gofly_format_price($current_price); ?></span>
        <?php endif; ?>
    </div>
    <div class="eg-tour-sticky-btns">
        <button class="eg-pbar-quote-btn"
            data-bs-toggle="modal"
            data-bs-target="#enquiry<?php echo esc_attr($id); ?>">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <?php echo $quote_label; ?>
        </button>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>" class="eg-pbar-call-btn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.25h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.84a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <?php echo $call_label; ?>
        </a>
        <?php endif; ?>
    </div>
</div>

<script>
(function () {
    var stickyBar = document.getElementById('eg-sticky-bar-<?php echo esc_js($widget_id); ?>');
    var offset    = <?php echo intval($offset); ?>;
    if (!stickyBar) return;

    function onScroll() {
        if (window.scrollY > offset) {
            stickyBar.classList.add('eg-sticky-visible');
        } else {
            stickyBar.classList.remove('eg-sticky-visible');
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // run on load in case page is already scrolled
})();
</script>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Gofly_Tour_Pricing_Bar_Widget());
