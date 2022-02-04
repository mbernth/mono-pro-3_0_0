<?php
/**
 * @author mono voce aps
 * @package Mono Pro
*/

/*
Template Name: Team Members Single
*/

//* Add landing body class to the head
add_filter( 'body_class', 'work_single_add_body_class' );
function work_single_add_body_class( $classes ) {
	$classes[] = 'team-member-single';
	return $classes;
}

add_action ( 'genesis_entry_content', 'single_team_member', 6 );
function single_team_member() {
	$title = get_field( 'title' );
	$email = get_field( 'email' );
	$telephone = get_field( 'telephone' );
	$leave_description = get_field( 'leave_description' );
	$person_on_leave = get_field( 'person_on_leave' );
	$short_biography = get_field( 'short_biography' );

	if ( (is_single()) && has_post_thumbnail() ) :		
		$imgfull = genesis_get_image( array( 'format' => 'html' ) );
		printf( '%s', $imgfull );
	endif;
	echo '<p><strong>'.$title.'</strong><br>';
	if ( $person_on_leave == 1 ) { 
		echo '<span class="onleave">'.$leave_description.'</span><br>'; 
   } else { 
		// echo 'false'; 
   }
	echo '<span class="email"><svg class="icon-mail"><use xlink:href="#icon-mail"></use></svg> <a href="mailto:'.$email.'">'.$email.'</a></span><br>';
	echo '<span class="phone"><svg class="icon-phone"><use xlink:href="#icon-phone"></use></svg> <a href="tel:'.$telephone.'">'.$telephone.'</a></phone></p>';
	echo ''.$short_biography.'';
	
}
//* Run the Genesis loop
genesis();