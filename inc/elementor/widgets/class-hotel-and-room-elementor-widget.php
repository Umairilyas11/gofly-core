<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;  // Exit if accessed directly

use Elementor\core\Schemes;
use Egns_Core\Egns_Helper;

class gofly_Hotel_And_Room_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'gofly_hotel_and_room';
    }

    public function get_title()
    {
        return esc_html__('EG Hotel & Room', 'gofly-core');
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
            'gofly_counter_hotel_room_genaral',
            [
                'label' => esc_html__('Hotel & Room Content', 'gofly-core'),

            ]
        );

        $this->add_control(
            'gofly_hotel_and_room_heading',
            [
                'label'     => esc_html__('Heading', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'gofly_hotel_and_and__room_title',
            [
                'label'       => esc_html__('Title', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Luxury Living Spaces', 'gofly-core'),
                'placeholder' => esc_html__('Type your title here', 'gofly-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'gofly_hotel_and_room_short_description',
            [
                'label'       => esc_html__('Short Desciption', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('A curated list of the most popular travel packages based on different destinations.', 'gofly-core'),
                'placeholder' => esc_html__('Type your value here', 'gofly-core'),
                'label_block' => true,
            ]
        );


        // Post Query 
        $this->add_control(
            'gofly_hotel_and_grid_query_area',
            [
                'label'     => esc_html__('Post Query', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'gofly_hotel_and_grid_order',
            [
                'label'   => esc_html__('Order', 'gofly-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'asc'  => esc_html__('Ascending', 'gofly-core'),
                    'desc' => esc_html__('Descending', 'gofly-core')
                ],
                'default' => 'desc',
            ]
        );
        $this->add_control(
            'gofly_hotel_and_grid_orderby',
            [
                'label'   => esc_html__('Order By', 'gofly-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'ID',
                'options' => [
                    'ID'         => esc_html__('Post Id', 'gofly-core'),
                    'author'     => esc_html__('Post Author', 'gofly-core'),
                    'title'      => esc_html__('Title', 'gofly-core'),
                    'post_date'  => esc_html__('Date', 'gofly-core'),
                    'rand'       => esc_html__('Random', 'gofly-core'),
                    'menu_order' => esc_html__('Menu Order', 'gofly-core'),
                ],
            ]
        );
        $this->add_control(
            'gofly_hotel_and_grid_post_per_page',
            [
                'label'   => esc_html__('Posts Per Page', 'gofly-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );
        $this->add_control(
            'gofly_hotel_and_grid_selected_cat',
            [
                'label'       => esc_html__('Hotel Category', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => \Egns_Core\Egns_Helper::get_post_terms_options('hotel-category'),
                'description' => esc_html__('Show hotel post only selected category', 'gofly-core'),
            ]
        );
        $this->add_control(
            'gofly_hotel_and_grid_post_list',
            [
                'label'       => esc_html__('Hotel Room lists', 'gofly-core'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => \Egns_Core\Egns_Helper::get_post_list_options('hotel'),
                'description' => esc_html__('Selected posts appear only when linked to an hotel category. By default, all selected posts are visible.', 'gofly-core'),
            ]
        );


        $this->end_controls_section();


        //============Style One Start=============//

        $this->start_controls_section(
            'gofly_hotel_and_header_styles',
            [
                'label' => esc_html__('Header Styles', 'gofly-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'gofly_hotel_and_general_title_style',
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
                'name'     => 'gofly_hotel_and_general_title_typ',
                'selector' => '{{WRAPPER}} .section-title h2',
            ]
        );
        $this->add_control(
            'gofly_hotel_and_general_title_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .section-title h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'gofly_hotel_and_general_desc_style',
            [
                'label'     => esc_html__('Description', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_hotel_and_general_desc_typ',
                'selector' => '{{WRAPPER}} .section-title p',
            ]
        );
        $this->add_control(
            'gofly_hotel_and_general_desc_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .section-title p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'gofly_hotel_and_general_price_style',
            [
                'label'     => esc_html__('Price', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_hotel_and_general_price_typ',
                'selector' => '{{WRAPPER}} .home10-hotel-and-room-section .hotel-and-room-slider-wrapper .hotel-room-card .hotel-room-img-area .price h6',
            ]
        );

        $this->add_control(
            'gofly_hotel_and_general_rpcie_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .home10-hotel-and-room-section .hotel-and-room-slider-wrapper .hotel-room-card .hotel-room-img-area .price h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_hotel_and_general_rpcie_price_text_color',
            [
                'label'     => esc_html__('Price Text Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .home10-hotel-and-room-section .hotel-and-room-slider-wrapper .hotel-room-card .hotel-room-img-area .price span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_hotel_and_general_price_extra_service_style',
            [
                'label'     => esc_html__('Extra Service ', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'gofly_hotel_and_general_price_extra_service_style_bac_color',
            [
                'label'     => esc_html__('Background Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .home10-hotel-and-room-section .hotel-and-room-slider-wrapper .hotel-room-card .hotel-room-img-area .room-details' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_hotel_and_general_price_extra_service_style_typ',
                'selector' => '{{WRAPPER}} .home10-hotel-and-room-section .hotel-and-room-slider-wrapper .hotel-room-card .hotel-room-img-area .room-details .single-room .single-room-content h6',
            ]
        );

        $this->add_control(
            'gofly_hotel_and_general_price_extra_service_style_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .home10-hotel-and-room-section .hotel-and-room-slider-wrapper .hotel-room-card .hotel-room-img-area .room-details .single-room .single-room-content h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gofly_hotel_and_general_price_extra_service_style_price_text_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .home10-hotel-and-room-section .hotel-and-room-slider-wrapper .hotel-room-card .hotel-room-img-area .room-details .single-room svg' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'gofly_hotel_and_general_title2_style',
            [
                'label'     => esc_html__('Title ', 'gofly-core'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'gofly-core'),
                'name'     => 'gofly_hotel_and_general_title_style_typ',
                'selector' => '{{WRAPPER}} .home10-hotel-and-room-section .hotel-and-room-slider-wrapper .hotel-room-card .hotel-room-content h4 a',
            ]
        );

        $this->add_control(
            'gofly_hotel_and_general_title_style_color',
            [
                'label'     => esc_html__('Color', 'gofly-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .home10-hotel-and-room-section .hotel-and-room-slider-wrapper .hotel-room-card .hotel-room-img-area .room-details .single-room svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $cat_ids           = $settings['gofly_hotel_and_grid_selected_cat'];
        $selected_post_ids = $settings['gofly_hotel_and_grid_post_list'];

        $args = array(
            'post_type'      => 'hotel',
            'order'          => $settings['gofly_hotel_and_grid_order'],
            'orderby'        => $settings['gofly_hotel_and_grid_orderby'],
            'posts_per_page' => $settings['gofly_hotel_and_grid_post_per_page'],
            'post_status'    => 'publish',
            'offset'         => 0,
        );

        if (!empty($cat_ids)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'hotel-category',
                    'field'    => 'slug',
                    'terms'    => $cat_ids,
                    'operator' => 'IN',
                ),
            );
        }

        // Add Included posts
        if (!empty($selected_post_ids)) {
            $args['post__in'] = $selected_post_ids;
        }

        $Query = new \WP_Query($args);

?>
        <?php if (is_admin()): ?>
            <script>
                //------Home10 Hotel Room slider-----//
                var swiper = new Swiper(".home10-hotel-slider", {
                    slidesPerView: 1,
                    speed: 1500,
                    spaceBetween: 50,
                    autoplay: {
                        delay: 2500, // Autoplay duration in milliseconds
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    pagination: {
                        el: ".progress-pagination2",
                        type: "progressbar",
                    },
                    navigation: {
                        nextEl: ".home10-room-hotel-slider-next",
                        prevEl: ".home10-room-hotel-slider-prev",
                        clickable: true,
                    },
                    breakpoints: {
                        350: {
                            slidesPerView: 1,
                            spaceBetween: 15,
                        },
                        576: {
                            slidesPerView: 1,
                            spaceBetween: 15,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 24,
                        },
                        992: {
                            slidesPerView: 3,
                            spaceBetween: 15,
                        },
                        1200: {
                            slidesPerView: 3,
                            spaceBetween: 18,
                        },
                        1400: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                    },
                });
            </script>
        <?php endif; ?>

        <div class="home10-hotel-and-room-section">
            <div class="container">
                <div class="row justify-content-center mb-60">
                    <div class="col-xl-5 col-lg-7">
                        <div class="section-title white text-center">
                            <?php if (!empty($settings['gofly_hotel_and_and__room_title'])): ?>
                                <h2><?php echo esc_html($settings['gofly_hotel_and_and__room_title']); ?></h2>
                            <?php endif; ?>
                            <?php if (!empty($settings['gofly_hotel_and_room_short_description'])): ?>
                                <p><?php echo esc_html($settings['gofly_hotel_and_room_short_description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mb-60">
                <div class="hotel-and-room-slider-wrapper">
                    <div class="swiper home10-hotel-slider">
                        <div class="swiper-wrapper">
                            <?php
                            while ($Query->have_posts()) {
                                $Query->the_post();
                            ?>
                                <div class="swiper-slide">
                                    <div class="hotel-room-card">
                                        <div class="hotel-room-img-area">
                                            <?php the_post_thumbnail('hotel2-card') ?>
                                            <div class="price">
                                                <?php echo Egns_Helper::hotel_global_starting_price(get_the_ID(), 'three') ?>
                                            </div>
                                            <?php if (!empty(Egns_Helper::egns_get_hotel_value('hotel_room_video', 'url'))) : ?>
                                                <div class="thumb-video">
                                                    <?php
                                                    $video = Egns_Helper::egns_get_hotel_value('hotel_room_video');
                                                    if (! empty($video) && is_array($video) && ! empty($video['url'])) :
                                                    ?>
                                                        <video autoplay loop muted playsinline>
                                                            <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
                                                        </video>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="video-icon">
                                                    <svg width="14" height="14" viewBox="0 0 14 14"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g>
                                                            <path d="M2.9781 0.308689C1.71592 -0.415315 0.692627 0.177798 0.692627 1.63238V12.3666C0.692627 13.8226 1.71592 14.415 2.9781 13.6917L12.3603 8.31101C13.6229 7.58675 13.6229 6.41334 12.3603 5.68925L2.9781 0.308689Z" />
                                                        </g>
                                                    </svg>
                                                </div>
                                            <?php endif; ?>
                                            <?php
                                            $room = Egns_Helper::egns_get_hotel_value('hotel_hotel_extra_repeater');
                                            if (is_array($room) && !empty($room)) :
                                            ?>
                                                <ul class="room-details">
                                                    <?php foreach ($room as $service) : ?>
                                                        <li class="single-room">
                                                            <?php
                                                            $media = $service['hotel_hotel_extra_media'] ?? [];
                                                            if (!empty($media['url'])) :
                                                                $file_url = $media['url'];
                                                                $file_ext = pathinfo($file_url, PATHINFO_EXTENSION);
                                                                // SVG inline render
                                                                if ($file_ext === 'svg') {
                                                                    $svg_path = wp_parse_url($file_url, PHP_URL_PATH);
                                                                    $svg_path = ABSPATH . ltrim($svg_path, '/');
                                                                    if (file_exists($svg_path)) {
                                                                        echo file_get_contents($svg_path);
                                                                    }
                                                                } else {
                                                            ?>
                                                                    <img class="single-room-icon" src="<?php echo esc_url($file_url); ?>" alt="icon" />
                                                            <?php
                                                                }
                                                            endif;
                                                            ?>
                                                            <?php if (!empty($service['hotel_hotel_extra_title'])) : ?>
                                                                <div class="single-room-content">
                                                                    <h6><?php echo wp_kses_post($service['hotel_hotel_extra_title']); ?></h6>
                                                                </div>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                        <div class="hotel-room-content">
                                            <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                            <?php echo do_shortcode('[post_rating_count]') ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            };
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="slider-btn-grp">
                    <div class="slider-btn home10-room-hotel-slider-prev">
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.5999 20.3917C11.7476 20.3956 11.8933 20.3567 12.0195 20.2797C12.3911 20.0509 12.5043 19.5541 12.2807 19.1829C12.2619 19.1501 9.92625 15.2525 5.46785 12.7997H22.7999C23.2411 12.7997 23.5999 12.4409 23.5999 11.9997C23.5999 11.5585 23.2411 11.1997 22.7999 11.1997H5.46785C9.90145 8.76086 12.2635 4.84606 12.2867 4.80686C12.5055 4.43326 12.3843 3.93606 12.0111 3.71486C11.6327 3.49046 11.1343 3.62046 10.9083 4.00086C10.5447 4.58086 7.13505 9.78046 1.01945 11.2193C0.653454 11.3093 0.399853 11.6297 0.399853 12.0001C0.399853 12.3705 0.651854 12.6917 1.01265 12.7793C7.15425 14.2233 10.5523 19.4297 10.9195 20.0189C11.0635 20.2497 11.3299 20.3865 11.5999 20.3917Z" />
                        </svg>
                    </div>
                    <div class="progress-pagination2"></div>
                    <div class="slider-btn home10-room-hotel-slider-next">
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.4001 20.3917C12.2524 20.3956 12.1067 20.3567 11.9805 20.2797C11.6089 20.0509 11.4957 19.5541 11.7193 19.1829C11.7381 19.1501 14.0737 15.2525 18.5321 12.7997H1.20015C0.758946 12.7997 0.400146 12.4409 0.400146 11.9997C0.400146 11.5585 0.758946 11.1997 1.20015 11.1997H18.5321C14.0985 8.76086 11.7365 4.84606 11.7133 4.80686C11.4945 4.43326 11.6157 3.93606 11.9889 3.71486C12.3673 3.49046 12.8657 3.62046 13.0917 4.00086C13.4553 4.58086 16.8649 9.78046 22.9805 11.2193C23.3465 11.3093 23.6001 11.6297 23.6001 12.0001C23.6001 12.3705 23.3481 12.6917 22.9873 12.7793C16.8457 14.2233 13.4477 19.4297 13.0805 20.0189C12.9365 20.2497 12.6701 20.3865 12.4001 20.3917Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new gofly_Hotel_And_Room_Widget());
