<?php 

// Gist updated to use code from Genesis Framework 2.4.2
//remove initial header functions
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_header', 'genesis_do_header' );
//add in the new header markup - prefix the function name - here sm_ is used
add_action( 'genesis_header', 'sm_genesis_header_markup_open', 5 );
add_action( 'genesis_header', 'sm_genesis_header_markup_close', 15 );
add_action( 'genesis_header', 'sm_genesis_do_header' );

//New Header functions
function sm_genesis_header_markup_open() {
 genesis_markup( array(
 'html5' => '<header %s>',
 'context' => 'site-header',
 ) );
 /* Added in content
 echo '<div class="header-ghost"></div>';
 */
 genesis_structural_wrap( 'header' );
}
function sm_genesis_header_markup_close() {
 genesis_structural_wrap( 'header', 'close' );
 genesis_markup( array(
 'close' => '</header>',
 'context' => 'site-header',
 ) );
}

function sm_genesis_do_header() {
 global $wp_registered_sidebars;
 genesis_markup( array(
 'open' => '<div %s>',
 'context' => 'title-area',
 ) );
 // Added in content
 // Add your own svg log. Change viewbox values, path content and title. Remember to update style sheet to your logo.
echo '<div class="site-id">
 		<a class="site-logo" href="' . esc_url( home_url( '/' ) ) . '">
      <svg id="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 49.2">
        <title>mono pro 2.0</title>
        <g id="logotype">
          <path d="M873.25,534.69V547a7,7,0,0,1-13.92,0V534.69a5.38,5.38,0,0,0-10.75,0v12a7,7,0,0,1-13.92,0v-12a5.37,5.37,0,0,0-10.74,0V547A7,7,0,1,1,810,547V522.36a7,7,0,0,1,11.47-5.3,19.24,19.24,0,0,1,20.15,2.81,19.28,19.28,0,0,1,31.63,14.82Zm42.06,0A19.29,19.29,0,1,0,896,554,19.31,19.31,0,0,0,915.31,534.69Zm-13.92,0a5.37,5.37,0,1,1-5.37-5.37A5.38,5.38,0,0,1,901.39,534.69Zm98.05,0A19.29,19.29,0,1,0,980.15,554,19.31,19.31,0,0,0,999.44,534.69Zm-13.92,0a5.37,5.37,0,1,1-5.37-5.37A5.38,5.38,0,0,1,985.52,534.69Zm124.48,0A19.29,19.29,0,1,0,1090.71,554,19.31,19.31,0,0,0,1110,534.69Zm-13.92,0a5.37,5.37,0,1,1-5.37-5.37A5.38,5.38,0,0,1,1096.08,534.69Zm-158-19.29a19.11,19.11,0,0,0-7.83,1.66,7,7,0,0,0-11.47,5.3V547a7,7,0,0,0,13.92,0V534.69a5.38,5.38,0,0,1,10.75,0V547a7,7,0,0,0,13.92,0V534.69A19.31,19.31,0,0,0,938.09,515.4Zm103.42,19.29A19.31,19.31,0,0,1,1022.22,554a19.11,19.11,0,0,1-5.38-.76v4.42a7,7,0,0,1-13.92,0V522.36a7,7,0,0,1,11.47-5.3,19.11,19.11,0,0,1,7.83-1.66A19.31,19.31,0,0,1,1041.51,534.69Zm-13.92,0a5.38,5.38,0,1,0-5.37,5.37A5.38,5.38,0,0,0,1027.59,534.69Zm36.69-19.29a19.1,19.1,0,0,0-7.82,1.66,7,7,0,0,0-11.47,5.3V547a7,7,0,0,0,13.92,0V534.69a5.38,5.38,0,0,1,5.37-5.37,7,7,0,0,0,0-13.92Z" transform="translate(-810 -515.4)"/>
        </g>
      </svg>

    </a>';
     
 do_action( 'genesis_site_title' );
 do_action( 'genesis_site_description' );
 
 genesis_markup( array(
 'close' => '</div></div>',
 'context' => 'title-area',
 ) );
 if ( ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) || has_action( 'genesis_header_right' ) ) {
 genesis_markup( array(
 'open' => '<div %s>' . genesis_sidebar_title( 'header-right' ),
 'context' => 'header-widget-area',
 ) );
 do_action( 'genesis_header_right' );
 add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
 add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
 dynamic_sidebar( 'header-right' );
 remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
 remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
 genesis_markup( array(
 'close' => '</div>',
 'context' => 'header-widget-area',
 ) );
 }
}