<?php

function create_team_members_post_type() {

   $labels = array(
        'name' => __( 'Team members' ),
        'singular_name' => __( 'Team member' ),
        'add_new' => _x('Add New Team member', 'Team members'),
        'add_new_item' => __('Add New Team member'),
        'edit_item' => __('Edit Team member'),
        'new_item' => __('New Team member'),
        'all_items' => __('All Team members'),
        'view_item' => __('View Team member'),
        'search_items' => __('Search Team members'),
        'not_found' =>  __('No team members found'),
        'not_found_in_trash' => __('No team members found in trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Team'
    );

    $args = array(
        'labels' => $labels,
        'description' => 'Team members',
        'public' => true,
        'has_archive' => true,
        'menu_position' => 5,
        'rewrite' => array('slug' => 'team'),
        'supports'  => array( 'title', 'thumbnail', 'genesis-cpt-archives-settings' )
    );

  register_post_type( 'team', $args);
}
add_action( 'init', 'create_team_members_post_type' );


function custom_taxonomies_team_members() {

    $labels = array(
        'name'              => _x( 'Team member Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Team member Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Team member Categories' ),
        'all_items'         => __( 'All Team member Categories' ),
        'parent_item'       => __( 'Parent Team member Category' ),
        'parent_item_colon' => __( 'Parent Team member Category:' ),
        'edit_item'         => __( 'Edit Team member Category' ), 
        'update_item'       => __( 'Update Team member Category' ),
        'add_new_item'      => __( 'Add New Team member Category' ),
        'new_item_name'     => __( 'New Team member Category' ),
        'menu_name'         => __( 'Team member Categories' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_admin_column' => true,
    );

    register_taxonomy( 'team-members_category', 'team', $args );
}
add_action( 'init', 'custom_taxonomies_team_members', 0 );

// Add support for the Genesis Scripts meta box on a custom post type
add_post_type_support( 'team', 'genesis-scripts' );
add_post_type_support( 'team', 'genesis-layouts' );