<?php
/**
 * Mono Pro. II
 *
 * This file adds functions to the Mono Pro II Theme.
 *
 * @package Mono Pro. II
 * @author  mono voce aps
 * @license GNU General Public License v3.0
 * @link    https://github.com/mbernth/mono-pro-2_0
 */

add_filter( 'simple_social_default_styles', 'mono_social_default_styles' );
/**
 * Updates Simple Social Icon settings on activation.
 *
 * @since 1.0.0
 *
 * @param array $defaults Default social icon settings.
 * @return array Modified social styles.
 */
function mono_social_default_styles( $defaults ) {

	$args = genesis_get_config( 'simple-social-icons-settings' );

	return wp_parse_args( $args, $defaults );

}
