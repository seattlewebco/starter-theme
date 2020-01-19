<?php
/**
 * Splash template structure
 *
 * @package swc
 */

/**
 * Remove hero section
 */
remove_theme_support( 'custom-header' );

/**
 * New body classes for this page template
 *
 * @param array $classes
 * @return array
 */
function splash_template_body_classes( $classes ) {
    $classes[] = 'transparent-header';

    return $classes;
}
add_filter( 'body_class', 'splash_template_body_classes' );

function splash_template_css() {
    $thumbnail = get_the_post_thumbnail_url( get_queried_object_id(), 'full' );

    if ( $thumbnail ) {
        wp_add_inline_style( 'swc-style', sprintf( ".splash-template { background-image: url('%s'); }", esc_url( $thumbnail ) ) );
    }
}
add_action( 'wp_enqueue_scripts', 'splash_template_css', 15 );

/*
function splash_template_title() {
    print swc_get_the_title( '<h1>', '</h1>' );
}
add_action( 'swc_before_content', 'splash_template_title' );
*/