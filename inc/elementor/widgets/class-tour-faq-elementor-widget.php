<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;  // Exit if accessed directly

use Egns_Core\Egns_Helper;

/**
 * Tour FAQ Elementor Widget
 *
 * Reads the tour_faq_list stored in the Tour meta box (EGNS_TOUR_META_ID)
 * and renders it with the same Bootstrap accordion design already used by
 * the site-wide EG FAQ widget (style_one / accordion-flush).
 *
 * PLACEMENT: gofly-core/inc/elementor/widgets/class-tour-faq-elementor-widget.php
 */

class Gofly_Tour_FAQ_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'gofly_tour_faq';
    }

    public function get_title()
    {
        return esc_html__('EG Tour FAQ', 'gofly-core');
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

        // ==================== Content ====================

        $this->start_controls_section(
            'gofly_tour_faq_content_section',
            [
                'label' => esc_html__('Content', 'gofly-core'),
            ]
        );

        $this->add_control(
            'tour_faq_panel_notice',
            [
                'type'        => \Elementor\Controls_Manager::NOTICE,
                'notice_type' => 'warning',
                'dismissible' => true,
                'heading'     => esc_html__('Notice', 'gofly-core'),
                'content'     => esc_html__('This widget is for the Tour single/details page. FAQ items are managed from the Tour meta box → FAQ tab.', 'gofly-core'),
            ]
        );

        $this->add_control(
            'gofly_tour_faq_section_title',
            [
                'label'       => esc_html__('Section Title', 'gofly-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Frequently Asked Questions', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_tour_faq_show_title',
            [
                'label'        => esc_html__('Show Section Title', 'gofly-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'gofly-core'),
                'label_off'    => esc_html__('No', 'gofly-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'gofly_tour_faq_section_desc',
            [
                'label'       => esc_html__('Section Description', 'gofly-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => esc_html__('Optional short description', 'gofly-core'),
                'label_block' => true,
                'condition'   => ['gofly_tour_faq_show_title' => 'yes'],
            ]
        );

        $this->end_controls_section();

        // ==================== Style: Title ====================

        $this->start_controls_section(
            'gofly_tour_faq_title_style',
            [
                'label'     => esc_html__('Title Style', 'gofly-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => ['gofly_tour_faq_show_title' => 'yes'],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_tour_faq_title_typ',
                'selector' => '{{WRAPPER}} .section-title h2',
            ]
        );

        $this->add_control(
            'gofly_tour_faq_title_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Description Typography', 'gofly-core'),
                'name'     => 'gofly_tour_faq_desc_typ',
                'selector' => '{{WRAPPER}} .section-title p',
            ]
        );

        $this->add_control(
            'gofly_tour_faq_desc_color',
            [
                'label'     => esc_html__('Description Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ==================== Style: Accordion ====================

        $this->start_controls_section(
            'gofly_tour_faq_accordion_style',
            [
                'label' => esc_html__("FAQ Accordion Style", 'gofly-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Question
        $this->add_control(
            'gofly_tour_faq_question_heading',
            [
                'label'     => esc_html__('Question Button', 'gofly-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_tour_faq_question_typ',
                'selector' => '{{WRAPPER}} .faq-wrap .accordion .accordion-item .accordion-header .accordion-button',
            ]
        );

        $this->add_control(
            'gofly_tour_faq_question_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-wrap .accordion .accordion-item .accordion-header .accordion-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_faq_question_bg',
            [
                'label'     => esc_html__('Background', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-wrap .accordion .accordion-item .accordion-header .accordion-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_faq_item_bg',
            [
                'label'     => esc_html__('Item Background (collapsed)', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-wrap .accordion .accordion-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Answer
        $this->add_control(
            'gofly_tour_faq_answer_heading',
            [
                'label'     => esc_html__('Answer Body', 'gofly-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_tour_faq_answer_typ',
                'selector' => '{{WRAPPER}} .faq-wrap .accordion .accordion-item .accordion-body',
            ]
        );

        $this->add_control(
            'gofly_tour_faq_answer_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-wrap .accordion .accordion-item .accordion-body' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_faq_answer_bg',
            [
                'label'     => esc_html__('Background', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-wrap .accordion .accordion-item .accordion-body' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_faq_border_color',
            [
                'label'     => esc_html__('Border Color (open)', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-wrap .accordion .accordion-item .accordion-header .accordion-button:not(.collapsed)' => 'border: 1px solid {{VALUE}};',
                    '{{WRAPPER}} .faq-wrap .accordion .accordion-item .accordion-body'                                     => 'border: 1px solid {{VALUE}};',
                ],
            ]
        );

        // Arrow
        $this->add_control(
            'gofly_tour_faq_arrow_heading',
            [
                'label'     => esc_html__('Arrow', 'gofly-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'gofly_tour_faq_arrow_color',
            [
                'label'     => esc_html__('Arrow Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-wrap .accordion .accordion-item .accordion-header .accordion-button::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_tour_faq_arrow_open_color',
            [
                'label'     => esc_html__('Arrow Color (open)', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-wrap .accordion .accordion-item .accordion-header .accordion-button:not(.collapsed)::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Pull FAQ list from tour post meta (saved via CSF group field)
        $faq_list  = Egns_Helper::egns_get_tour_value('tour_faq_list');
        $show_title = $settings['gofly_tour_faq_show_title'] === 'yes';
        $uniqID    = uniqid();

        // Empty state in editor
        if (empty($faq_list) || !is_array($faq_list)) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<p style="color:#aaa;font-style:italic;">'
                    . esc_html__('No FAQ items found. Add them in the Tour meta box → FAQ tab.', 'gofly-core')
                    . '</p>';
            }
            return;
        }
?>

        <div class="faq-page">

            <?php if ($show_title && !empty($settings['gofly_tour_faq_section_title'])) : ?>
                <div class="mb-50 wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <div class="section-title text-center">
                        <h2><?php echo esc_html($settings['gofly_tour_faq_section_title']); ?></h2>
                        <?php if (!empty($settings['gofly_tour_faq_section_desc'])) : ?>
                            <p><?php echo esc_html($settings['gofly_tour_faq_section_desc']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="faq-wrap">
                <div class="accordion accordion-flush" id="accordionFlush<?php echo esc_attr($uniqID); ?>">
                    <?php foreach ($faq_list as $key => $item) : ?>
                        <?php
                        $question = !empty($item['tour_faq_question']) ? $item['tour_faq_question'] : '';
                        $answer   = !empty($item['tour_faq_answer'])   ? $item['tour_faq_answer']   : '';
                        if (empty($question)) continue;
                        $is_first = ($key === array_key_first($faq_list));
                        ?>
                        <div class="accordion-item wow animate fadeInDown"
                            data-wow-delay="<?php echo ($key * 200); ?>ms"
                            data-wow-duration="1500ms">
                            <h5 class="accordion-header" id="flush-heading-tf-<?php echo esc_attr($uniqID . $key); ?>">
                                <button
                                    class="accordion-button <?php echo $is_first ? '' : 'collapsed'; ?>"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse-tf-<?php echo esc_attr($uniqID . $key); ?>"
                                    aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                                    aria-controls="flush-collapse-tf-<?php echo esc_attr($uniqID . $key); ?>">
                                    <?php echo esc_html($question); ?>
                                </button>
                            </h5>
                            <div
                                id="flush-collapse-tf-<?php echo esc_attr($uniqID . $key); ?>"
                                class="accordion-collapse collapse <?php echo $is_first ? 'show' : ''; ?>"
                                aria-labelledby="flush-heading-tf-<?php echo esc_attr($uniqID . $key); ?>"
                                data-bs-parent="#accordionFlush<?php echo esc_attr($uniqID); ?>">
                                <?php if (!empty($answer)) : ?>
                                    <div class="accordion-body">
                                        <?php echo wp_kses_post($answer); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div><!-- .faq-page -->

<?php
    }
}

Plugin::instance()->widgets_manager->register(new Gofly_Tour_FAQ_Widget());
