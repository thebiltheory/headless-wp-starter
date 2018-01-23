<?php
/**
 * By default, in Add/Edit Post, WordPress moves checked categories to the top of the list, and unchecked to the bottom.
 * When you have subcategories that you want to keep below their parents at all times, this makes no sense.
 * This function removes that automatic reordering so the categories widget retains its order regardless of checked state.
 * Thanks to https://stackoverflow.com/a/12586404
 */
function taxonomy_checklist_checked_ontop_filter ( $args ) {
	$args['checked_ontop'] = false;
	return $args;
}

add_filter( 'wp_terms_checklist_args', 'taxonomy_checklist_checked_ontop_filter' );

/**
 * Customize the preview button in the WordPress admin to point to the headless client.
 *
 * @param  str $link The WordPress preview link.
 * @return str The headless WordPress preview link.
 */
function set_headless_preview_link( $link ) {
	return get_frontend_origin()
		. '_preview/'
		. get_the_ID() . '/'
		. wp_create_nonce( 'wp_rest' );
}

/**
 * Placeholder function for determining the frontend origin.
 * @TODO Determine the headless client's URL based on the current environment.
 *
 * @return str Frontend origin URL, i.e., http://localhost:3000/.
 */
function get_frontend_origin() {
	return 'http://localhost:3000/';
}

add_filter( 'preview_post_link', 'set_headless_preview_link' );

