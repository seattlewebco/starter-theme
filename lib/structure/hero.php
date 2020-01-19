<?php
/**
 * Replace default implementation of the theme Custom Header feature
 *
 * @package swc
 */

/**
 * Remove default custom header implementation
 */
function swc_custom_header_setup() {
	remove_action( 'wp_head', get_theme_support( 'custom-header', 'wp-head-callback' ) );
}
add_action( 'wp_loaded', 'swc_custom_header_setup' );

/**
 * Render our own custom header as the hero section
 */
function swc_custom_header() {
	$header_text_color = get_header_textcolor();
	$header_selector   = get_theme_support( 'custom-header', 'header-selector' );

	// Do nothing if custom header not supported.
	if ( ! current_theme_supports( 'custom-header' ) || ! post_type_supports( get_post_type(), 'hero-section' ) ) {
		return;
	}

	get_template_part( 'template-parts/hero-section' );

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
	// Has the text been hidden?
	if ( ! display_header_text() ) :
		?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
	// If the user has set a custom color for the text use that.
	else :
		printf( esc_attr( $selector ) . '{background-image:url(%s)}' . "n", esc_url( $url ) );
		printf( esc_attr( $header_selector ) . '{color: #%s}' . "\n", esc_attr( $header_text_color ) );

	endif;
		?>
	</style>
	<?php
}
