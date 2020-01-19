<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package swc
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'swc' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="wrap">
			<div class="title-area">
				<a href="<?php print home_url(); ?>" class="custom-logo-link" title="<?php esc_html_e( get_option( 'blogname' ) ); ?>">
					<svg id="custom-logo" class="custom-logo" data-name="custom-logo" width="<?php print esc_attr( get_theme_support( 'custom-logo', 'width' ) ); ?>" height="<?php print esc_attr( get_theme_support( 'custom-logo', 'height' ) ); ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 73.62 30.83"><defs><style>.cls-1{fill:#fff}</style></defs><path class="cls-1" d="M27.5 18.64c0-2.67 1.8-5.06 5.58-5.27a5.88 5.88 0 00-.6 0V13c-6.48.3-9.59 3.65-9.59 8.28 0 10.94 17.18 7.87 17.18 16.51 0 3.07-2.16 5.71-6.91 5.71-6.62 0-8.54-5.23-10.37-10h-.29l.53 9a51.13 51.13 0 0010 1.25c7.82 0 11.71-3.46 11.71-8.69a9.31 9.31 0 00-.16-1.72l-1.21-2.9c-4.04-5.74-15.87-5.01-15.87-11.8zM44.62 33.43a7.34 7.34 0 00-1.21-2.9z" transform="translate(-22.5 -13)"/><path class="cls-1" d="M33.08 13.37h.51c6 0 8 5.19 9.6 9.27l.24-.05-.57-9.31c-3.22.72-5.57-.28-9.41-.28h-1v.29a5.88 5.88 0 01.63.08z" transform="translate(-22.5 -13)"/><path class="cls-1" d="M38.87 19.63c-1.2-2.88-2.74-6.29-6.39-6.29V13h15v.34c-3.6 0-4 2.16-2.64 5.52l6.56 16.51 5.47-14-.62-1.73c-1.4-3.6-3.17-6.29-6.25-6.29V13h15.27v.34c-3.79 0-4.18 2.5-2.93 6L68 35.09l4-10.71A23.92 23.92 0 0073.77 17c0-2.26-1.2-3.65-4.13-3.65V13l12.14.47v-.13a6.68 6.68 0 00-6 3.46 53.3 53.3 0 00-3.41 7.82l-7 18.29h-.33l-8-20.79-8.14 20.79h-.34z" transform="translate(-22.5 -13)"/><path class="cls-1" d="M38.87 19.63c-1.2-2.88-2.74-6.29-6.39-6.29V13h15v.34c-3.6 0-4 2.16-2.64 5.52l6.56 16.51 5.47-14-.62-1.73c-1.4-3.6-3.17-6.29-6.25-6.29V13h15.27v.34c-3.79 0-4.18 2.5-2.93 6L68 35.09l.26-.71 3.72-10A23.92 23.92 0 0073.77 17a5.65 5.65 0 00-.1-1c-.34-1.64-1.58-2.61-4-2.61V13h12.11v.34a6.68 6.68 0 00-6 3.46 53.3 53.3 0 00-3.41 7.82l-7 18.29h-.33l-8-20.79-8.14 20.79h-.34z" transform="translate(-22.5 -13)"/><path class="cls-1" d="M73.66 16A18.4 18.4 0 0184 13c3.94 0 7.2 1 10.66.1l.81 9.74h-.23c-2.74-6.63-6.15-9.55-11-9.55-7.63 0-10.51 7.29-10.51 15.12s2.74 15.07 10.23 15.07c5.76 0 9.5-4.37 12-10.13h.24l-1.59 9a41.1 41.1 0 01-10.36 1.44c-8.19 0-13.73-3.78-15.91-9.44z" transform="translate(-22.5 -13)"/></svg>
				</a>
			</div><!-- .site-branding -->

			<button class="menu-toggle" aria-controls="nav-primary" aria-expanded="false">
				<span class="hamburger"> </span>
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'swc' ); ?></span>
			</button>
			<nav id="site-navigation" class="nav-primary responsive-menu">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'menu_class'	 => wp_script_is( 'swc-superfish', 'enqueued' ) ? 'js-superfish ' : ' '
				) );
				?>
			</nav><!-- #site-navigation -->
		</div><!-- .wrap -->
	</header><!-- #masthead -->

	<?php do_action( 'swc_after_header' ); ?>

	<div id="content" class="site-container">
		
		<?php do_action( 'swc_before_content_wrap' ); ?>

		<div class="wrap">