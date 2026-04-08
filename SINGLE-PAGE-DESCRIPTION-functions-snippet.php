<?php
/**
 * ============================================================
 * EG Travel Package – Card Description on Single Tour Page
 *
 * Add this snippet to your child theme's functions.php
 *
 * This hooks into GoFly's single tour page and outputs the
 * "Card Description" meta field you added to each Tour post.
 *
 * The hook 'gofly_after_tour_title' may vary depending on
 * your theme version. If it doesn't fire, use one of the
 * fallback hooks listed in the comments below.
 * ============================================================
 */

/**
 * Display card description on single tour / deal page.
 */
add_action( 'gofly_after_tour_meta_info', 'vibes_show_tour_card_description', 10 );

function vibes_show_tour_card_description() {
    if ( ! is_singular( 'tour' ) ) {
        return;
    }

    $meta    = get_post_meta( get_the_ID(), 'EGNS_TOUR_META_ID', true );
    $desc    = isset( $meta['tour_card_description'] ) ? sanitize_text_field( $meta['tour_card_description'] ) : '';

    if ( empty( $desc ) ) {
        return;
    }

    echo '<p class="tour-single-card-desc">' . esc_html( $desc ) . '</p>';
}

/**
 * Style for single page description.
 * Alternatively put this in your child theme's style.css.
 */
add_action( 'wp_head', 'vibes_tour_card_desc_inline_style' );

function vibes_tour_card_desc_inline_style() {
    if ( ! is_singular( 'tour' ) ) {
        return;
    }
    echo '<style>
    .tour-single-card-desc {
        font-size: 15px;
        line-height: 1.65;
        color: #555;
        margin: 12px 0 18px;
        max-width: 680px;
    }
    </style>';
}
