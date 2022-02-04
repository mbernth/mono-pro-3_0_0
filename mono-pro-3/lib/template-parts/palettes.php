<?php
add_action( 'genesis_entry_content', 'mono_palettes', 1 );
function mono_palettes() {
	$show_array = get_field( 'show' );
	$black = get_field( 'black_colour' );
	$black_rgb = get_field( 'black_colour_rgb' );
	$white = get_field( 'white_colour' );
	$white_rgb = get_field( 'white_colour_rgb' );
	$primary = get_field( 'primary_colour' );
	$primary_rgb = get_field( 'primary_colour_rgb' );
	$secondary = get_field( 'secondary_colour' );
	$secondary_rgb = get_field( 'secondary_colour_rgb' );
	$active = get_field( 'active_colour' );
	$active_rgb = get_field( 'active_colour_rgb' );
	$accent_one = get_field( 'accent_1_colour' );
	$accent_one_rgb = get_field( 'accent_1_colour_rgb' );
	$accent_two = get_field( 'accent_2_colour' );
	$accent_two_rgb = get_field( 'accent_2_colour_rgb' );
	$accent_three = get_field( 'accent_3_colour' );
	$accent_three_rgb = get_field( 'accent_3_colour_rgb' );

    if ( $show_array ){
        echo '
		<section class="category">
		<h1 class="category_headline">Color palette</h1>
        <section class="primary_swatches">
        <ul class="swatch-primary">
           <li class="swatch-row-one"></li>
           <li class="swatch-row-one"><p>Primary<br>#'.$primary.'</p></li>

           <li class="swatch-row-one"></li>
           <li class="swatch-row-one"></li>
           <li class="swatch-row-one"></li>
           <li class="swatch-row-one"></li>

           <li class="swatch-row-two"></li>
           <li class="swatch-row-two"></li>
           <li class="swatch-row-two"></li>
           <li class="swatch-row-two"></li>
	   </ul>
	   <ul class="swatch-secondary">
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"><p>Secondary<br>#'.$secondary.'</p></li>
	   
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"></li>

	   		<li class="swatch-row-two"></li>
	   		<li class="swatch-row-two"></li>
	   		<li class="swatch-row-two"></li>
	   		<li class="swatch-row-two"></li>
	   </ul>
	   <ul class="swatch-active">
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"><p>Active<br>#'.$active.'</p></li>
	   
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"></li>

	   		<li class="swatch-row-two"></li>
	   		<li class="swatch-row-two"></li>
	   		<li class="swatch-row-two"></li>
	   		<li class="swatch-row-two"></li>
	   </ul>
	   <ul class="swatch-black">
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"><p>Shade<br>#'.$black.'</p></li>
	   
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"></li>
	   		<li class="swatch-row-one"></li>

	   		<li class="swatch-row-two"></li>
	   		<li class="swatch-row-two"></li>
	   		<li class="swatch-row-two"></li>
	   		<li class="swatch-row-two"></li>
	   </ul>
	   </section>
	   <section class="secondary_swatches">
	   		<span></span>
	   		<span></span>
	   		<span></span>
	   		<span></span>
	   		<span></span>
   	   </section>
       </section>
        ';
	}else{
		
    }
	
}