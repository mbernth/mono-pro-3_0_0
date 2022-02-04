<?php
/**
 * @author mono voce aps
 * @package Mono Pro
*/

/*
Template Name: Single
*/

add_action ( 'genesis_entry_content', 'single_post_featured_image', 1 );
function single_post_featured_image() {
	if ( (is_single() || is_page()) && has_post_thumbnail() ) :
		
		$imgfull = genesis_get_image( array( 'format' => 'html' ) );
		printf( '<div class="alignwide">%s</div>', $imgfull );

	endif;
	
}

//* Run the Genesis loop
genesis();