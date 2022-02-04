<?php
/**
 * Mono Pro.
 *
 * Onboarding config to load plugins and homepage content on theme activation.
 *
 * Visit `/wp-admin/admin.php?page=genesis-getting-started` to trigger import.
 *
 * @package Mono Pro. II
 * @author  mono voce aps
 * @license GNU General Public License v3.0
 * @link    https://github.com/mbernth/mono-pro-2_0
 */

$mono_shared_content = genesis_get_config( 'onboarding-shared' );

$mono_starter_packs_content = [
	'starter_packs' => [
		'minimal'     => [
			'title'       => __( 'Minimal', 'mono-pro' ),
			'description' => __( 'A mono voce aps theme for Genesis', 'mono-pro' ),
			'thumbnail'   => '',
			'config'      => [
				'dependencies'     => [
					'plugins' => $mono_shared_content['dependencies']['plugins'],
				],
			],
		],
	],
];

return $mono_starter_packs_content;