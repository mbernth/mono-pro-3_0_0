<?php
/**
 * @author mono voce aps
 * @package Mono Pro
*/

/*
Template Name: Archive
*/

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );

//* Run the Genesis loop
genesis();