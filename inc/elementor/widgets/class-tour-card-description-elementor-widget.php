<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;  // Exit if accessed directly

use Egns_Core;
use Elementor\core\Schemes;
use Egns_Core\Egns_Helper;

class Gofly_Tour_Card_Description_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'gofly_tour_card_description';
    }

    public function get_title()
    {
        return esc_html__('EG Tour Card Description', 'gofly-core');
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

        //===================== Content =======================//

        $this->start_controls_section(
            'gofly_tour_card_desc_content_section',
            [
                'label' => esc_html__('Content', 'gofly-core')
            ]
        );

        $this->add_control(
            'tour_card_desc_panel_notice',
            [
                'type'        => \Elementor\Controls_Manager::NOTICE,
                'notice_type' => 'warning',
                'dismissible' => true,
                'heading'     => esc_html__('Notice', 'gofly-core'),
                'content'     => esc_html__('This widget is intended for the "Tour" single/details page. It displays the Card Description field.', 'gofly-core'),
            ]
        );

        $this->add_control(
            'gofly_tour_card_desc_tag',
            [
                'label'   => esc_html__('HTML Tag', 'gofly-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'p',
                'options' => [
                    'p'    => 'p',
                    'div'  => 'div',
                    'span' => 'span',
                    'h2'   => 'h2',
                    'h3'   => 'h3',
                    'h4'   => 'h4',
                    'h5'   => 'h5',
                    'h6'   => 'h6',
                ],
            ]
        );

        $this->end_controls_section();


        //===================== Style =======================//

        $this->start_controls_section(
            'gofly_tour_card_desc_style_section',
            [
                'label' => esc_html__('Style', 'gofly-core'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_tour_card_desc_typography',
                'selector' => '{{WRAPPER}} .gofly-tour-card-description',
            ]
        );

        $this->add_control(
            'gofly_tour_card_desc_color',
            [
                'label'     => esc_html__('Text Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gofly-tour-card-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gofly_tour_card_desc_alignment',
            [
                'label'     => esc_html__('Alignment', 'gofly-core'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'gofly-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'gofly-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'gofly-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .gofly-tour-card-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gofly_tour_card_desc_margin',
            [
                'label'      => esc_html__('Margin', 'gofly-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .gofly-tour-card-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gofly_tour_card_desc_padding',
            [
                'label'      => esc_html__('Padding', 'gofly-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .gofly-tour-card-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $card_description = Egns_Helper::egns_get_tour_value('tour_card_description');
        $tag              = !empty($settings['gofly_tour_card_desc_tag']) ? $settings['gofly_tour_card_desc_tag'] : 'p';
        $allowed_tags     = ['p', 'div', 'span', 'h2', 'h3', 'h4', 'h5', 'h6'];

        if (!in_array($tag, $allowed_tags)) {
            $tag = 'p';
        }

        if (empty($card_description)) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<p style="color:#aaa;font-style:italic;">' . esc_html__('No card description found for this tour.', 'gofly-core') . '</p>';
            }
            return;
        }

        echo '<' . esc_attr($tag) . ' class="gofly-tour-card-description">';
        echo wp_kses_post(nl2br($card_description));
        echo '</' . esc_attr($tag) . '>';
    }
}

Plugin::instance()->widgets_manager->register(new Gofly_Tour_Card_Description_Widget());
