<?php
/**
 * Template hooks / actions.
 * 
 * @package swc
 */

namespace SeattleWebCo\StarterTheme\Functions;

/**
 * Load the WordPress header
 */
function swc_header() {
    get_header();
}
add_action( 'swc_header', __NAMESPACE__ . '\swc_header', 0 );


/**
 * Load the WordPress footer
 * 
 * @return void
 */
function swc_footer() {
    get_footer();
}
add_action( 'swc_footer', __NAMESPACE__ . '\swc_footer', 20 );

/**
 * Adds hero section in our new position
 */
add_action( 'swc_before_content_wrap', __NAMESPACE__ . '\swc_custom_header' );

/**
 * Conditionally load the sidebar
 */
function swc_sidebar() {
    if ( swc_get_template() === 'content-sidebar' || swc_get_template() === 'sidebar-content' ) {
        get_sidebar();
    }
}
add_action( 'swc_after_content', __NAMESPACE__ . '\swc_sidebar' );

function swc_before_loop() {
    ?>
    <header>
        <h1 class="page-title screen-reader-text"><?php the_page_title(); ?></h1>
    </header>
    <?php
}
add_action( 'swc_before_loop', __NAMESPACE__ . '\swc_before_loop' );

function swc_entry_header() {
    ?>

    <header class="entry-header">
		<?php do_action( 'swc_entry_header' ); ?>
	</header><!-- .entry-header -->

    <?php
}
add_action( 'swc_entry', __NAMESPACE__ . '\swc_entry_header', 5 );

function swc_entry_content() {
    ?>

    <div class="entry-content">
        <?php do_action( 'swc_entry_content' ); ?>
    </div>

    <?php
}
add_action( 'swc_entry', __NAMESPACE__ . '\swc_entry_content' );

function swc_entry_footer() {
    ?>

    <footer class="entry-footer">
        <?php do_action( 'swc_entry_footer' ); ?>
    </footer>

    <?php
}
add_action( 'swc_entry', __NAMESPACE__ . '\swc_entry_footer', 20 );

function swc_loop() {
    get_template_part( 'template-parts/content', get_post_type() );
}
add_action( 'swc_loop', __NAMESPACE__ . '\swc_loop' );


function swc_comments() {
    if ( ! post_type_supports( get_post_type(), 'comments' ) ) {
        return;
    }

    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) {
        comments_template();
    }
}
add_action( 'swc_loop', __NAMESPACE__ . '\swc_comments', 15 );


function swc_after_loop() {
    the_posts_navigation();
}
add_action( 'swc_after_loop', __NAMESPACE__ . '\swc_after_loop' );


function swc_content_none() {
    get_template_part( 'template-parts/content', __NAMESPACE__ . '\none' );
}
add_action( 'swc_content_none', __NAMESPACE__ . '\swc_content_none' );


function swc_footer_credits() {
	print apply_filters( 'do_shortcode', do_shortcode( get_theme_mod( 'footer_credits', swc_get_theme_option_default( 'footer_credits' ) ) ) );
}
add_action( 'swc_footer_credits', __NAMESPACE__ . '\swc_footer_credits' );