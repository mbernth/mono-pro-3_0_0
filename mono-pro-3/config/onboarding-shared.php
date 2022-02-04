<?php
/**
 * Mono Pro.
 *
 * Onboarding config shared between Starter Packs.
 *
 * Genesis Starter Packs give you a choice of content variation when activating
 * the theme. The content below is common to all packs for this theme.
 *
 * @package Mono Pro. II
 * @author  mono voce aps
 * @license GNU General Public License v3.0
 * @link    https://github.com/mbernth/mono-pro-2_0
 */

$mono_onboarding_config = [
	'dependencies'     => [
		'plugins' => [
			[
				'name'       => __( 'Atomic Blocks', 'mono-pro' ),
				'slug'       => 'atomic-blocks/atomicblocks.php',
				'public_url' => 'https://atomicblocks.com/',
			],
			[
				'name'       => __( 'Simple Social Icons', 'mono-pro' ),
				'slug'       => 'simple-social-icons/simple-social-icons.php',
				'public_url' => 'https://wordpress.org/plugins/simple-social-icons/',
			],
		],
	],
];


return $mono_onboarding_config;
