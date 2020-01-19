<?php
/**
 * swc Theme Customizer
 *
 * @package swc
 */

namespace SeattleWebCo\StarterTheme\Admin;

class Customizer {

	public function __construct() {
		print 123;
	}

}



/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function swc_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'swc_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'swc_customize_partial_blogdescription',
		) );
		$wp_customize->selective_refresh->add_partial( 'footer_credits', array(
			'selector'        => '.footer-credits',
			'render_callback' => 'swc_footer_credits',
		) );
	}

	$wp_customize->add_setting( 'custom_sticky_logo', array(
		'theme_supports' => array( 'custom-sticky-logo' ),
		'transport'      => 'postMessage',
	) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_sticky_logo', array(
		'label'         => __( 'Sticky Logo' ),
		'section'       => 'title_tagline',
		'settings'      => 'custom_sticky_logo',
		'priority'      => 8,
		'button_labels' => array(
			'select'       => __( 'Select logo' ),
			'change'       => __( 'Change logo' ),
			'remove'       => __( 'Remove' ),
			'default'      => __( 'Default' ),
			'placeholder'  => __( 'No logo selected' ),
			'frame_title'  => __( 'Select logo' ),
			'frame_button' => __( 'Choose logo' ),
		),
	) ) );
	
	$wp_customize->selective_refresh->add_partial( 'custom_sticky_logo', array(
		'settings'            	=> array( 'custom_sticky_logo' ),
		'selector'            	=> '.custom-sticky-logo-link',
		'render_callback'     	=> array( $wp_customize, '_render_custom_logo_partial' ),
		'container_inclusive' 	=> true,
	) );

	$wp_customize->add_panel( 'theme_options', array(
		'title' 				=> __( 'Theme Options', 'swc' ),
		'description' 			=> '',
		'priority' 				=> 160, // Mixed with top-level-section hierarchy.
	) );

	$wp_customize->add_section( 'footer', array(
		'title' 				=> __( 'Footer', 'swc' ),
		'panel' 				=> 'theme_options',
	) );

	$wp_customize->add_setting( 'footer_widgets', array(
		'default' 				=> swc_get_theme_option_default( 'footer_widgets' ),
		'transport' 			=> 'refresh',
		'sanitize_callback' 	=> 'absint',
	) );

	$wp_customize->add_control( 'footer_widgets', array(
		'label'					=> __( 'Footer Widgets', 'swc' ),
		'type'					=> 'number',
		'section'				=> 'footer',
		'settings'				=> 'footer_widgets',
	) );

	$wp_customize->add_setting( 'footer_credits', array(
		'default' 				=> swc_get_theme_option_default( 'footer_credits' ),
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( 'footer_credits', array(
		'label'					=> __( 'Footer Credits', 'swc' ),
		'type'					=> 'textarea',
		'section'				=> 'footer',
		'settings'				=> 'footer_credits',
	) );
}
add_action( 'customize_register', 'swc_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function swc_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function swc_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function swc_customize_preview_js() {
	wp_enqueue_script( 'swc-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), swc_get_theme_version(), true );
}
add_action( 'customize_preview_init', 'swc_customize_preview_js' );
