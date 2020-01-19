<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package swc
 */

namespace SeattleWebCo\StarterTheme\Functions;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function swc_body_classes( $classes ) {
	$classes[] = 'sticky-header';

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_single() ) {
		$classes[] = 'narrow-content';
	}

	if ( is_page() ) {
		$classes[] = basename( get_page_template_slug(), '.php' );
	}

	$classes[] = esc_attr( swc_get_template() );

	return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\swc_body_classes' );

function swc_post_classes( $classes ) {
	if ( ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) && is_admin() ) {
		return $classes;
	}

	$classes[] = 'entry';

	if ( is_singular() && is_main_query() ) {
		$classes[] = get_post_type() . '-entry';
	}

	return $classes;
}
add_filter( 'post_class', __NAMESPACE__ . '\swc_post_classes' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function swc_content_width( $content_width ) {
	switch ( swc_get_template() ) {
		case 'content-sidebar' :
		case 'sidebar-content' :
			$content_width = 804;
			break;

		default :
			$content_width = 1152;
	}

	return $content_width;
}
add_filter( 'content_width', __NAMESPACE__ . '\swc_content_width' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function swc_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', __NAMESPACE__ . '\swc_pingback_header' );

/**
 * Adds a custom logo when header is sticky
 */
function swc_custom_sticky_logo( $html ) {
	$custom_sticky_logo = get_theme_mod( 'custom_sticky_logo' );

	if ( current_theme_supports( 'custom-sticky-logo' ) && $custom_sticky_logo ) {
		$html = str_replace( '<img', sprintf( '<img src="%s" class="custom-sticky-logo" /><img', esc_url( $custom_sticky_logo ) ), $html );
	}

	return $html;
}
add_filter( 'get_custom_logo', __NAMESPACE__ . '\swc_custom_sticky_logo' );

/**
 * Set syntax color for code block.
 * 
 * @return string
 */
function swc_set_syntax_color() {
	return 'github';
}
add_filter( 'syntax_highlighting_code_block_style', __NAMESPACE__ . '\swc_set_syntax_color' );

/**
 * Undocumented function
 *
 * @return void
 */
function swc_hook_loader() {
	$paths = [];

	if ( is_page() ) {
		$paths[] = 'page.php';
	}

	if ( get_page_template() ) {
		$paths[] = basename( get_page_template_slug() );
	}

	if ( is_singular() ) {
		$paths[] = 'singular.php';
	}

	if ( is_single() ) {
		$paths[] = 'single.php';
	}

	if ( swc_is_type_archive() ) {
		$paths[] = 'archive.php';
	}

	foreach ( $paths as $path ) {
		$file = get_template_directory() . '/structure/' . $path;

		if ( file_exists( $file ) ) {
			load_template( $file );
		}
	}
}
add_action( 'wp', __NAMESPACE__ . '\swc_hook_loader' );