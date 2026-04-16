<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

use Egns_Core\Egns_Helper;

class Gofly_Tour_Excursions_Widget extends Widget_Base
{
    public function get_name()   { return 'gofly_tour_excursions'; }
    public function get_title()  { return esc_html__('EG Tour Excursions', 'gofly-core'); }
    public function get_icon()   { return 'egns-widget-icon'; }
    public function get_categories() { return ['gofly_tour']; }

    protected function register_controls()
    {
        $this->start_controls_section('gofly_tour_excursions_content_section', [
            'label' => esc_html__('Content', 'gofly-core'),
        ]);

        $this->add_control('tour_excursions_panel_notice', [
            'type'        => \Elementor\Controls_Manager::NOTICE,
            'notice_type' => 'warning',
            'dismissible' => true,
            'heading'     => esc_html__('Notice', 'gofly-core'),
            'content'     => esc_html__('Displays the Tour Excursions list from the Tour meta box. Wrap a line in <strong> to render it as a heading without a bullet icon.', 'gofly-core'),
        ]);

        $this->add_control('gofly_tour_excursions_title', [
            'label'   => esc_html__('Section Title', 'gofly-core'),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__('Tour Excursions', 'gofly-core'),
        ]);

        $this->add_control('gofly_tour_excursions_show_title', [
            'label'        => esc_html__('Show Title', 'gofly-core'),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Yes', 'gofly-core'),
            'label_off'    => esc_html__('No', 'gofly-core'),
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->end_controls_section();

        // Style: Title
        $this->start_controls_section('gofly_tour_excursions_title_style_section', [
            'label'     => esc_html__('Title Style', 'gofly-core'),
            'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => ['gofly_tour_excursions_show_title' => 'yes'],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'gofly_tour_excursions_title_typography',
            'selector' => '{{WRAPPER}} .gofly-excursions-title',
        ]);

        $this->add_control('gofly_tour_excursions_title_color', [
            'label'     => esc_html__('Color', 'gofly-core'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .gofly-excursions-title' => 'color: {{VALUE}};'],
        ]);

        $this->add_responsive_control('gofly_tour_excursions_title_margin', [
            'label'      => esc_html__('Margin', 'gofly-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => ['{{WRAPPER}} .gofly-excursions-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
        ]);

        $this->end_controls_section();

        // Style: Items
        $this->start_controls_section('gofly_tour_excursions_items_style_section', [
            'label' => esc_html__('Items Style', 'gofly-core'),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'gofly_tour_excursions_item_typography',
            'selector' => '{{WRAPPER}} .gofly-excursions-list li span',
        ]);

        $this->add_control('gofly_tour_excursions_item_color', [
            'label'     => esc_html__('Text Color', 'gofly-core'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .gofly-excursions-list li span' => 'color: {{VALUE}};'],
        ]);

        $this->add_responsive_control('gofly_tour_excursions_item_gap', [
            'label'      => esc_html__('Gap Between Items', 'gofly-core'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => ['px' => ['min' => 0, 'max' => 40]],
            'default'    => ['unit' => 'px', 'size' => 10],
            'selectors'  => ['{{WRAPPER}} .gofly-excursions-list' => 'gap: {{SIZE}}{{UNIT}};'],
        ]);

        $this->add_responsive_control('gofly_tour_excursions_columns', [
            'label'          => esc_html__('Columns', 'gofly-core'),
            'type'           => Controls_Manager::SELECT,
            'default'        => '1',
            'tablet_default' => '1',
            'mobile_default' => '1',
            'options'        => ['1' => '1', '2' => '2', '3' => '3'],
            'selectors'      => ['{{WRAPPER}} .gofly-excursions-list' => 'grid-template-columns: repeat({{VALUE}}, 1fr);'],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings     = $this->get_settings_for_display();
        $raw          = Egns_Helper::egns_get_tour_value('tour_excursions_list');
        $show_title   = $settings['gofly_tour_excursions_show_title'] === 'yes';
        $title        = !empty($settings['gofly_tour_excursions_title']) ? $settings['gofly_tour_excursions_title'] : '';

        if (empty($raw)) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<p style="color:#aaa;font-style:italic;">' . esc_html__('No excursions found. Add them in the Tour meta box → General tab.', 'gofly-core') . '</p>';
            }
            return;
        }

        $items = array_filter(array_map('trim', explode("\n", $raw)));
        if (empty($items)) return;

        $svg_icon = '<svg class="gofly-excursion-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path fill="#ff5800" d="M15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15V16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8C16 12.4183 12.4183 16 8 16V15C11.866 15 15 11.866 15 8Z"></path><path fill="#ff5800" d="M11.6947 6.45795L7.24644 10.9086C7.17556 10.9771 7.08572 11.0126 6.99596 11.0126C6.9494 11.0127 6.90328 11.0035 6.86027 10.9857C6.81727 10.9678 6.77822 10.9416 6.7454 10.9086L4.3038 8.46699C4.16436 8.32987 4.16436 8.10539 4.3038 7.96595L5.16652 7.10083C5.29892 6.96851 5.53524 6.96851 5.66764 7.10083L6.99596 8.42915L10.3309 5.09179C10.3638 5.05887 10.4028 5.03274 10.4457 5.01489C10.4887 4.99705 10.5347 4.98784 10.5812 4.98779C10.6757 4.98779 10.7656 5.02563 10.8317 5.09179L11.6944 5.95699C11.8341 6.09643 11.8341 6.32091 11.6947 6.45795Z"></path></svg>';
?>
        <div class="gofly-tour-excursions">
            <?php if ($show_title && !empty($title)) : ?>
                <h3 class="gofly-excursions-title"><?php echo esc_html($title); ?></h3>
            <?php endif; ?>
            <ul class="gofly-excursions-list">
                <?php foreach ($items as $item) :
                    // Detect if the line is wrapped in <strong> — heading mode, no icon
                    $is_heading = (bool) preg_match('/^\s*<strong>.*<\/strong>\s*$/i', $item);
                ?>
                    <li class="<?php echo $is_heading ? 'gofly-excursion-heading' : ''; ?>">
                        <?php if (!$is_heading) echo $svg_icon; ?>
                        <span><?php echo wp_kses_post($item); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <style>
            .gofly-tour-excursions .gofly-excursions-list {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                gap: 10px;
            }
            .gofly-tour-excursions .gofly-excursions-list li {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .gofly-tour-excursions .gofly-excursions-list li.gofly-excursion-heading {
                margin-top: 6px;
            }
            .gofly-tour-excursions .gofly-excursions-list li.gofly-excursion-heading span {
                font-weight: 600;
            }
            .gofly-tour-excursions .gofly-excursions-list li .gofly-excursion-icon {
                flex-shrink: 0;
                width: 16px;
                height: 16px;
            }
        </style>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Gofly_Tour_Excursions_Widget());