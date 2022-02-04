<?php
/**
 * @author mono voce aps
 * @package Mono Pro
*/

/*
Template Name: Team Members Archive
*/

//* Add landing body class to the head
add_filter( 'body_class', 'work_single_add_body_class' );
function work_single_add_body_class( $classes ) {
	$classes[] = 'team-member-archive';
	return $classes;
}
add_filter( 'genesis_attr_content', 'content_add_css_attr' );
function content_add_css_attr( $attributes ) {
    // add original plus extra CSS classes
    $attributes['class'] .= ' alignwide';
 // return the attributes
 return $attributes;
 
}

// List post alphabetical ascending
add_action( 'genesis_before_loop', 'team_list_order' );
function team_list_order() {
    global $query_string;
    query_posts( wp_parse_args( $query_string, array( 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page'=> -1 ) ) );
}

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

add_action ( 'genesis_entry_content', 'single_team_member', 15 );
function single_team_member() {
	$title = get_field( 'title' );
	$email = get_field( 'email' );
	$telephone = get_field( 'telephone' );
	$leave_description = get_field( 'leave_description' );
	$person_on_leave = get_field( 'person_on_leave' );
    $short_biography = get_field( 'short_biography' );
    
    echo '<figure>';
    if ( has_post_thumbnail() ) :		
		$imgfull = genesis_get_image( array( 'format' => 'html' ) );
		printf( '<a class="archive--link--picture" href="' . get_permalink() . '">%s</a>', $imgfull );
	endif;
	if ( $person_on_leave == 1 ) { 
		echo '<span class="onleave"><svg class="icon-warning"><use xlink:href="#icon-warning"></use></svg> '.$leave_description.'</span>'; 
    } else { 
		// echo 'false'; 
    }
    echo '</figure>';
    echo '<p><span class="name">';the_title(); echo '</span>';
    echo '<span class="title">'.$title.'</span>';
	echo '<span class="email"><svg class="icon-mail"><use xlink:href="#icon-mail"></use></svg> <a href="mailto:'.$email.'">'.$email.'</a></span>';
	echo '<span class="phone"><svg class="icon-phone"><use xlink:href="#icon-phone"></use></svg> <a href="tel:'.$telephone.'">'.$telephone.'</a></phone></p>';
	echo ''.$short_biography.'';
	
}

//* Run the Genesis loop
genesis();