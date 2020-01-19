<?php
/**
 * Shortcodes.
 * 
 * @package swc
 */

/**
 * Returns current year
 *
 * @param array $atts
 * @param string $content
 * @return string
 */
function swc_shortcode_current_year( $atts, $content = '' ) {
    return date( 'Y' );
}
add_shortcode( 'current-year', 'swc_shortcode_current_year' );

/**
 * Returns site title
 *
 * @param array $atts
 * @param string $content
 * @return string
 */
function swc_shortcode_site_title( $atts, $content = '' ) {
    return esc_html__( get_option( 'blogname' ), 'swc' );
}
add_shortcode( 'site-title', 'swc_shortcode_site_title' );