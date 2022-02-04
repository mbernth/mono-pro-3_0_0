<?php
/**
 * Gutenberg theme support.
 *
 * @package Mono Pro. II
 * @author  mono voce aps
 * @license GNU General Public License v3.0
 * @link    https://github.com/mbernth/mono-pro-2_0
 */

// add_action( 'wp_enqueue_scripts', 'mono_pro_enqueue_gutenberg_frontend_styles' );
/**
 * Enqueues Gutenberg front-end styles.
 *
 * @since 2.7.0
 */
function mono_pro_enqueue_gutenberg_frontend_styles() {

	wp_enqueue_style(
		genesis_get_theme_handle() . '-gutenberg',
		get_stylesheet_directory_uri() . '/lib/gutenberg/front-end.css',
		[ genesis_get_theme_handle() ],
		genesis_get_theme_version()
	);

}

add_action( 'enqueue_block_editor_assets', 'mono_pro_block_editor_styles' );
/**
 * Enqueues Gutenberg admin editor fonts and styles.
 *
 * @since 2.7.0
 */
function mono_pro_block_editor_styles() {

	$block_editor_settings = genesis_get_config( 'block-editor-settings' );

	wp_enqueue_style(
		genesis_get_theme_handle() . '-gutenberg-fonts',
		$block_editor_settings['admin-fonts-url'],
		[],
		genesis_get_theme_version()
	);

}

// Adds support for editor styles.
add_theme_support( 'editor-styles' );

// Enqueues editor styles.
add_editor_style( '/lib/gutenberg/style-editor-min.css' );

// Adds support for block alignments.
add_theme_support( 'align-wide' );

// Makes media embeds responsive.
add_theme_support( 'responsive-embeds' );

$mono_block_editor_settings = genesis_get_config( 'block-editor-settings' );

// Adds support for editor font sizes.
add_theme_support(
	'editor-font-sizes',
	$mono_block_editor_settings['editor-font-sizes']
);

require_once get_stylesheet_directory() . '/lib/gutenberg/inline-styles.php';

add_theme_support(
	'editor-color-palette',
	$mono_block_editor_settings['editor-color-palette']
);

add_action( 'after_setup_theme', 'mono_pro_content_width', 0 );
/**
 * Sets content width to match the “wide” Gutenberg block width.
 */
function mono_pro_content_width() {

	$block_editor_settings = genesis_get_config( 'block-editor-settings' );

	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- See https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/924
	$GLOBALS['content_width'] = apply_filters( 'mono_pro_content_width', $block_editor_settings['content-width'] );

}
