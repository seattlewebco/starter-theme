<?php
/**
 * Template Name: Splash Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package swc
 */

do_action( 'swc_header' );

do_action( 'swc_before_content' );
?>

	<div id="primary" class="content">
		<main id="main" class="site-main">

		<?php
			if ( have_posts() ) :

				do_action( 'swc_before_loop' );

				/** Start the loop */
				while ( have_posts() ) : the_post();

					do_action( 'swc_loop' );

				endwhile; // End of the loop.

				do_action( 'swc_after_loop' );

			else :

				do_action( 'swc_content_none' );

			endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

do_action( 'swc_after_content' );

do_action( 'swc_footer' );