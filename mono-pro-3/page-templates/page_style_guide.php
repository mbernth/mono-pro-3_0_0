<?php
/**
 * This file adds the home template to the mono pro.
 *
 * @author mono voce aps
 * @package mono pro
 * @subpackage Customizations
*/

/*
Template Name: Style Guide
*/

//* Add custom body class to the head
add_filter( 'body_class', 'style_guide_add_body_class' );
function style_guide_add_body_class( $classes ) {
   $classes[] = 'style-guide';
   return $classes;

}

//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Setup Colour palette
include_once( get_stylesheet_directory() . '/lib/template-parts/palettes.php' );

// Setup Swatches
include_once( get_stylesheet_directory() . '/lib/template-parts/typography.php' );


//* Run the Genesis loop
genesis();