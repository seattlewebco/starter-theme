<?php
/**
 * Easy Digital Downloads.
 * 
 * @package swc
 */

// Change downloads slug
define( 'EDD_SLUG', 'store' );

remove_filter( 'the_content', 'edd_after_download_content' );

function swc_download_post_type_args( $args ) {
    $args['show_in_rest'] = true;

    return $args;
}
add_filter( 'register_post_type_args', 'swc_download_post_type_args' );