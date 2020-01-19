<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package swc
 */

?>

		</div><!-- .wrap -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<?php if ( $footer_widgets = get_theme_mod( 'footer_widgets', swc_get_theme_option_default( 'footer_widgets' ) ) ) : ?>

		<div class="footer-widgets">
			<div class="wrap">
				
				<?php for ( $i = 1; $i <= $footer_widgets; $i++ ) : ?>

					<div class="widget-area footer-widgets footer-widget-area">
						<?php dynamic_sidebar( 'footer-' . $i ); ?>
					</div>

				<?php endfor; ?>

			</div><!-- .wrap -->
		</div><!-- .footer-widgets -->

		<?php endif; ?>

		<div class="footer-credits">
			<div class="wrap">
				<div class="site-info">
					<?php do_action( 'swc_footer_credits' ); ?>
				</div><!-- .site-info -->
			</div><!-- .wrap -->
		</div><!-- .footer-credits -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
