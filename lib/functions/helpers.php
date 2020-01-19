<?php
/**
 * Helper functions
 * 
 * @package swc
 */


/**
 * Returns whether the current page should be considered an archive.
 * 
 * @return boolean
 */
function swc_is_type_archive() {
	return \is_home() || \is_post_type_archive() || \is_category() || \is_tag() || \is_tax() || \is_author() || \is_date() || \is_year() || \is_month() || \is_day() || \is_time() || \is_archive() || \is_search();
}

/**
 * Returns the current page template / layout
 */
function swc_get_template() {
    switch ( true ) {
        case swc_is_type_archive() :
            $template = 'content-sidebar';
            break;
        
        default :
            $template = 'full-width-content';
    }

    return apply_filters( 'swc_get_template', $template );
}