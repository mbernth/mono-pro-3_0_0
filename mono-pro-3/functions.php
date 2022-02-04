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

 // Starts the engine.
// =====================================================================================================================
require_once get_template_directory() . '/lib/init.php';

// Setup Theme.
// =====================================================================================================================
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

// Adds the theme helper functions
// =====================================================================================================================
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Set Localization (do not remove)
// =====================================================================================================================
add_action( 'after_setup_theme', 'mono_localization_setup' );
function mono_localization_setup() {

	load_child_theme_textdomain( 'mono-pro', get_stylesheet_directory() . '/languages' );

}

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

// Add desired theme supports
// =====================================================================================================================
add_action( 'after_setup_theme', 'mono_theme_support', 1 );
function mono_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

// Gutenberg support
// =====================================================================================================================
add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

function wpdc_disable_gutenberg_typography_settings() {
	add_theme_support( 'editor-font-sizes' );
	add_theme_support( 'disable-custom-font-sizes' );
}
add_action( 'after_setup_theme', 'wpdc_disable_gutenberg_typography_settings' );

// Global scripts
// =====================================================================================================================
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );

add_action( 'wp_enqueue_scripts', 'mono_enqueue_scripts_styles' );
function mono_enqueue_scripts_styles() {
	// wp_enqueue_style( 'mono-fonts', 'https//fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,500;0,600;1,200;1,300;1,500&display=swap', [], genesis_get_theme_version() );
	// wp_enqueue_style( 'mono-ionicons', '//unpkg.com/ionicons@4.1.2/dist/css/ionicons.min.css', [], genesis_get_theme_version() );

	wp_enqueue_script( 'mono-jquery', get_stylesheet_directory_uri() . '/dist/js/jquery-3.5.1.min.js', array( 'jquery' ), '3.5.1' );
	
	wp_enqueue_script( 'mono-global-script', get_stylesheet_directory_uri() . '/dist/js/global.js', [ 'jquery' ], '1.0.0', true );
	// wp_enqueue_script( 'mono-block-effects', get_stylesheet_directory_uri() . '/js/block-effects.js', array(), '1.0.0', true );
	// wp_enqueue_script( 'mono-animations', get_stylesheet_directory_uri() . '/js/animations.js', array(), '1.0.0', true );

	// Flickity
	wp_enqueue_script( 'flickity', get_stylesheet_directory_uri() . '/dist/js/flickity.pkgd.min.js', array( 'jquery' ), '2.2.1', true );

	// Fitvids
	wp_enqueue_script( 'mono-fitvids-script', get_stylesheet_directory_uri() . '/dist/js/jquery.fitvids.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'mono-fitvids', get_stylesheet_directory_uri() . '/dist/js/fitvids.js', array( 'jquery' ), '1.0.0', true );

	// Counter
	wp_enqueue_script( 'mono-waypoints', get_stylesheet_directory_uri() . '/dist/js/jquery.waypoints.min.js', array( 'jquery' ), '4.0.0', true );
	wp_enqueue_script( 'mono-counter', get_stylesheet_directory_uri() . '/dist/js/jquery.counterup.js', array( 'jquery' ), '2.1.0', true );
	wp_enqueue_script( 'mono-counter-setting', get_stylesheet_directory_uri() . '/dist/js/counterup-setting.js', array( 'jquery' ), '1.0.0' );

	// Types
	wp_enqueue_script( 'mono-types', get_stylesheet_directory_uri() . '/dist/js/typed.min.js', array( 'jquery' ), '2.0.11' );

	// Page transitions
	wp_enqueue_script( 'mono-smoothstate', get_stylesheet_directory_uri() . '/dist/js/jquery.smoothState.min.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'mono-main', get_stylesheet_directory_uri() . '/dist/js/main.js', array( 'jquery' ), '1.0.0' );

	// Timeline
	wp_enqueue_script( 'mono-modernizr', get_bloginfo( 'stylesheet_directory' ) . '/dist/js/modernizr.min.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'moono-timeline', get_bloginfo( 'stylesheet_directory' ) . '/dist/js/timeline.js', array( 'jquery' ), '1.0.0' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script( 'mono-responsive-menu', get_stylesheet_directory_uri() . '/dist/js/responsive-menus' . $suffix . '.js', [ 'jquery' ], genesis_get_theme_version(), true );
	wp_localize_script( 'mono-responsive-menu', 'genesis_responsive_menu', mono_responsive_menu_settings() );

}

/**
 * Defines responsive menu settings.
 *
 * @since 1.1.0
 */
function mono_responsive_menu_settings() {

	$settings = [
		'mainMenu'         => __( 'Menu', 'monochrome-pro' ),
		'menuIconClass'    => 'ionicons-before ion-ios-menu',
		'subMenu'          => __( 'Submenu', 'monochrome-pro' ),
		'subMenuIconClass' => 'ionicons-before ion-ios-arrow-down',
		'menuClasses'      => [
			'combine' => [],
			'others'  => [
				'.nav-primary',
			],
		],
	];

	return $settings;

}

function mono_pro_styles() {
    wp_register_style('mono-pro', get_bloginfo( 'stylesheet_directory' ) . '/dist/style.css', array(), '2.0.0');
    wp_enqueue_style('mono-pro'); // Enqueue it!
}
add_action('wp_enqueue_scripts', 'mono_pro_styles'); // Add Theme Stylesheet

// Favicon location and touch icons
// =====================================================================================================================
add_filter( 'genesis_pre_load_favicon', 'mono_favicon_filter' );
function mono_favicon_filter( $favicon ) {
	echo '<link rel="shortcut icon" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon.ico" type="image/x-icon" />';
	echo '<link rel="apple-touch-icon" sizes="57x57" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-57x57.png">';
	echo '<link rel="apple-touch-icon" sizes="60x60" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-60x60.png">';
	echo '<link rel="apple-touch-icon" sizes="72x72" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-72x72.png">';
	echo '<link rel="apple-touch-icon" sizes="76x76" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-76x76.png">';
	echo '<link rel="apple-touch-icon" sizes="114x114" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-114x114.png">';
	echo '<link rel="apple-touch-icon" sizes="120x120" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-120x120.png">';
	echo '<link rel="apple-touch-icon" sizes="144x144" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-144x144.png">';
	echo '<link rel="apple-touch-icon" sizes="152x152" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-152x152.png">';
	echo '<link rel="apple-touch-icon" sizes="180x180" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-180x180.png">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon-16x16.png" sizes="16x16">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon-32x32.png" sizes="32x32">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon-96x96.png" sizes="96x96">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/android-chrome-192x192.png" sizes="192x192">';
	echo '<meta name="msapplication-square70x70logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//smalltile.png" />';
	echo '<meta name="msapplication-square150x150logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//mediumtile.png" />';
	echo '<meta name="msapplication-wide310x150logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//widetile.png" />';
	echo '<meta name="msapplication-square310x310logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//largetile.png" />';
}

//* Add svg upload
// =====================================================================================================================
add_filter('upload_mimes', 'cc_mime_types');
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

//* Remove the edit link
// =====================================================================================================================
add_filter ( 'genesis_edit_post_link' , '__return_false' );

//* Widgets
// =====================================================================================================================
// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes primary sidebar.
unregister_sidebar( 'sidebar' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'before-header',
	'name'        => __( 'Before Header', 'mono' ),
	'description' => __( 'This is the before header widget area.', 'mono' ),
) );

//* Hook before header widget area above header
add_action( 'genesis_before_header', 'mono_before_header', 15 );
function mono_before_header() {

	genesis_widget_area( 'before-header', array(
		'before' => '<div class="before-header widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

//* Layout
// =====================================================================================================================
// Removes site layouts - full width only
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar' );
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Custom header
// =====================================================================================================================
//* Setup custom header
include_once( get_stylesheet_directory() . '/lib/template-parts/custom-header.php' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* ID to site container
// =====================================================================================================================
/*
add_filter( 'genesis_attr_site-container', 'transition_structural_id' );
function transition_structural_id( $attributes ) {
 $attributes['id'] = 'main';
 return $attributes;
}

add_filter( 'genesis_attr_site-header', 'transition_animation_header' );
function transition_animation_header( $class ) {
	$class['class'] .= ' scene_element scene_element--fadeinright';
	return $class;
}

add_filter( 'genesis_attr_content', 'transition_animation_content' );
function transition_animation_content( $content_class ) {
	$content_class['class'] .= ' scene_element scene_element--fadeinright';
	return $content_class;
}
*/
//* Mono Icons
// =====================================================================================================================
//* Setup custom header
include_once( get_stylesheet_directory() . '/lib/template-parts/mono-icons.php' );

//* Post archive page
// =====================================================================================================================

//* Customize the next page link
add_filter ( 'genesis_next_link_text' , 'sp_next_page_link' );
function sp_next_page_link ( $text ) {
    return '<svg class="icon-arrow-right5"><use xlink:href="#icon-arrow-right5"></use></svg>';
}
//* Customize the previous page link
add_filter ( 'genesis_prev_link_text' , 'sp_previous_page_link' );
function sp_previous_page_link ( $text ) {
    return '<svg class="icon-arrow-left5"><use xlink:href="#icon-arrow-left5"></use></svg>';
}

//* Custom post types
// =====================================================================================================================
include_once( get_stylesheet_directory() . '/lib/template-parts/post-types/post_type_team.php' );
include_once( get_stylesheet_directory() . '/lib/template-parts/post-types/post_type_work.php' );

// ACF Blocks
// ========================================================================== //
/**
 * ACF Color Palette
 *
 * Add default color palatte to ACF color picker for branding
 * Match these colors to colors in /functions.php & /assets/scss/partials/base/variables.scss
 *
*/
add_action( 'acf/input/admin_footer', 'wd_acf_color_palette' );
function wd_acf_color_palette() { ?>
<script type="text/javascript">
(function($) {
     acf.add_filter('color_picker_args', function( args, $field ){
          // add the hexadecimal codes here for the colors you want to appear as swatches
          args.palettes = ['#000b12', '#f2f2f2', '#242e36', '#c8cacc', '#ef405c']
          // return colors
          return args;
     });
})(jQuery);
</script>
<?php }

function mono_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'mono-blocks',
				'title' => __( 'Mono Blocks', 'mono-blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'mono_block_category', 10, 2);

function register_acf_block_types() {

	// Register a hero video block.
	acf_register_block_type(array(
		'name'              => 'hero_video',
		'title'             => __('Hero Video'),
		'description'       => __('A custom hero video block.'),
		'render_template'   => '/lib/template-parts/blocks/hero-video.php',
		'category'          => 'mono-blocks',
		'icon'              => 'format-video',
		'align' 			=> 'full',
		'supports' 			=> array( 
								'align' => array( 'wide', 'full' ),
							),
	));

	acf_register_block_type(array(
		'name'              => 'hero',
		'title'             => __('Hero'),
		'description'       => __('A custom hero block.'),
		'render_template'   => '/lib/template-parts/blocks/hero.php',
		'category'          => 'mono-blocks',
		'icon'              => 'awards',
		'align' 			=> 'full',
		'supports' 			=> array( 
								'align' => array( 'full' ),
							),
	));

	acf_register_block_type(array(
		'name'              => 'images_text',
		'title'             => __('Images and texts'),
		'description'       => __('A custom images and text repeater block.'),
		'render_template'   => '/lib/template-parts/blocks/images-text.php',
		'category'          => 'mono-blocks',
		'icon'              => 'index-card',
		'mode' 				=> 'edit',
		'align' 			=> 'wide',
		'supports' 			=> array( 
								'align' => array( 'wide', 'full' ),
							),
	));

	acf_register_block_type(array(
		'name'              => 'flexible_grid',
		'title'             => __('Flexible Grid'),
		'description'       => __('A custom flexible grid block.'),
		'render_template'   => '/lib/template-parts/blocks/flexible-grid.php',
		'category'          => 'mono-blocks',
		'icon'              => 'editor-table',
		'mode' 				=> 'edit',
		'align' 			=> 'wide',
		'supports' 			=> array( 
								'align' => array( 'wide', 'full' ),
							),
	));

	acf_register_block_type(array(
		'name'              => 'two_column_grid',
		'title'             => __('Two Column Grid'),
		'description'       => __('A custom two column grid block.'),
		'render_template'   => '/lib/template-parts/blocks/two-column-grid.php',
		'category'          => 'mono-blocks',
		'icon'              => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path d="M9,23.5v-6H23.5v6Zm-8.5,0v-6h6v6Zm17-8.5V9h6v6ZM.5,15V9H15v6ZM13.25,6.5V.5H23.5v6ZM.5,6.5V.5H10.75v6Z"/><path d="M23,1V6H13.75V1H23M10.25,1V6H1V1h9.25M23,9.5v5H18v-5h5m-8.5,0v5H1v-5H14.5M23,18v5H9.5V18H23M6,18v5H1V18H6M24,0H12.75V7H24V0ZM11.25,0H0V7H11.25V0ZM24,8.5H17v7h7v-7Zm-8.5,0H0v7H15.5v-7ZM24,17H8.5v7H24V17ZM7,17H0v7H7V17Z"/></g></svg>',
		'mode' 				=> 'edit',
		'align' 			=> 'wide',
		'supports' 			=> array( 
								'align' => array( 'wide', 'full' ),
							),
	));

	acf_register_block_type(array(
		'name'              => 'team',
		'title'             => __('Team'),
		'description'       => __('A custom team block.'),
		'render_template'   => '/lib/template-parts/blocks/team.php',
		'category'          => 'mono-blocks',
		'icon'              => 'groups',
		'mode' 				=> 'edit',
		'align' 			=> 'wide',
		'supports' 			=> array( 
								'align' => array( 'wide', 'full' ),
							),
	));

	acf_register_block_type(array(
		'name'              => 'image_hotspots',
		'title'             => __('Image hotspots'),
		'description'       => __('A custom image hotspot block.'),
		'render_template'   => '/lib/template-parts/blocks/image_hotspots.php',
		'category'          => 'mono-blocks',
		'icon'              => 'location',
		'align' 			=> 'wide',
		'supports' 			=> array( 
								'align' => array( 'wide', 'full' ),
							),
	));

	acf_register_block_type(array(
		'name'              => 'hero_carousel',
		'title'             => __('Hero Carousel'),
		'description'       => __('A custom hero carousel block.'),
		'render_template'   => '/lib/template-parts/blocks/hero-carousel.php',
		'category'          => 'mono-blocks',
		'icon'              => 'update',
		'mode' 				=> 'edit',
		'align' 			=> 'full',
		'supports' 			=> array( 
								'align' => array( 'full' ),
							),
	));

	acf_register_block_type(array(
		'name'              => 'hero_advanced',
		'title'             => __('Hero Advanced'),
		'description'       => __('A custom advanced hero block.'),
		'render_template'   => '/lib/template-parts/blocks/hero-advanced.php',
		'category'          => 'mono-blocks',
		'icon'              => 'laptop',
		'mode' 				=> 'edit',
		'align' 			=> 'full',
		'supports' 			=> array( 
								'align' => array( 'full' ),
							),
	));
	
}

// check function exists.
if( function_exists('acf_register_block_type') ) {
	add_action('acf/init', 'register_acf_block_types');
}