<?php
/**
 * Template part for displaying downloads
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package swc
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>

		<?php do_action( 'edd_after_download_content', get_the_ID() ); ?>
	</header><!-- .entry-header -->

	<?php swc_post_thumbnail(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php swc_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
