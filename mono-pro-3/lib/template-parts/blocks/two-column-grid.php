<?php
/**
 * Block template file: /lib/template-parts/blocks/two-column-grid.php
 *
 * Two Column Grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'two-column-grid-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-two-column-grid';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes_align .= ' align' . $block['align'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>

<?php
// Get ACF Values from color picker
$wd_acf_background_color_picker_values = get_field( 'background_color' );
$wd_acf_text_color_picker_values = get_field( 'text_color' );

// Set array of color classes (for block editor) and hex codes (from ACF)
$wd_block_background_colors = [
	 // Change these to match your color class (gutenberg) and hex codes (acf)
     "theme-shade"      => "#000b12",
     "theme-tint"       => "#f2f2f2",
     "theme-primary"    => "#242e36",
     "theme-secondary"  => "#c8cacc",
     "theme-active"     => "#ef405c",
];
$wd_block_text_colors = [
    // Change these to match your color class (gutenberg) and hex codes (acf)
    "theme-shade"      => "#000b12",
    "theme-tint"       => "#f2f2f2",
    "theme-primary"    => "#242e36",
    "theme-secondary"  => "#c8cacc",
    "theme-active"     => "#ef405c",
];

// Loop over colors array and set proper class if background color selection matches value
foreach( $wd_block_background_colors as $key => $value ) {
     if( $wd_acf_background_color_picker_values == $value ) {
          $wd_color_class = $key;

     }
}
// Loop over colors array and set proper class if text color selection matches value
foreach( $wd_block_text_colors as $key => $value ) {
    if( $wd_acf_text_color_picker_values == $value ) {
         $wd_color_text_class = $key;
    }
}
?>

<?php if ( get_field( 'hide' ) == 1 ) : ?>
    <?php // Hide content ?>
<?php else : ?>
    <?php // Show content ?>

    <?php $element_id = get_field( 'element_id' ); ?>
    
    <?php if ( $element_id ) { ?>
        <a class="linkedID" id="<?php the_field( 'element_id' ); ?>"></a>
    <?php } ?> 

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> alignfull <?php if ( get_field( 'top_and_bottom_padding' ) == 1 ) : ?>has-top-bottom-padding<?php endif; ?> <?php if ( $wd_color_text_class ) { ?>has-<?php echo $wd_color_text_class; ?>-color<?php } ?>  <?php if ( $wd_color_class ) { ?>has-<?php echo $wd_color_class; ?>-background-color<?php } ?>">
    <div class="gridcontainer <?php the_field( 'column_layout' ); ?> <?php if ( get_field( 'use_column_gap' ) == 1 ) { ?>has-column-gap<?php }else{ ?>has-no-column-gap<?php } ?> <?php echo esc_attr( $classes_align ); ?> <?php if ( get_field( 'top_and_bottom_margin' ) == 1 ) { ?>has-top-bottom-margin<?php } ?>">
    
    <!-- Row headline -->
    <?php $headline_row = get_field( 'headline' ); ?>
    <?php if ( $headline_row ) { ?>
	    <h2 class="section-header"><?php the_field( 'headline' ); ?></h2>
    <?php } ?> 

    <!-- Left column -->
    <?php if ( have_rows( 'left_column' ) ): ?>
        <section>
        <?php while ( have_rows( 'left_column' ) ) : the_row(); ?>
            <!-- Text element -->
            <?php if ( get_row_layout() == 'text_column_element' ) : ?>
				<?php if ( get_sub_field( 'hide' ) == 1 ) { 
				 // Hide element
				} else { ?>
				<div class="flexgrid-text vertical-<?php the_sub_field( 'align_content' ); ?>">
                    <?php $headline = get_sub_field( 'headline' ); ?>
                    <?php if ($headline) {?>
                        <h3 class="section-header"> <?php echo $headline; ?></h3>
                    <?php } ?>
				    <?php the_sub_field( 'text' ); ?>
				    <?php $button = get_sub_field( 'button' ); ?>
				    <?php if ( $button ) { ?>
					    <a class="button" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
                    <?php } ?>
                </div>
                <?php } ?>
            
            <!-- Image element -->
			<?php elseif ( get_row_layout() == 'image_column_element' ) : ?>
                <?php if ( get_sub_field( 'hide' ) == 1 ) { 
				 // Hide element
                } else { ?>
                <div class="flexgrid-image">
                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php $link = get_sub_field( 'link' ); ?>
				    <?php if ( $image ) { ?>
                        <?php if ( $link ) { ?>
                            <figure>
                                <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>"/></a>
                                <?php if ( $image['caption'] ) { ?><figcaption><?php echo $image['caption']; ?></figcaption><?php } ?>
                            </figure>
                        <?php }else{ ?>
                            <figure>
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>"/>
                                <?php if ( $image['caption'] ) { ?><figcaption><?php echo $image['caption']; ?></figcaption><?php } ?>
                            </figure>
                        <?php } ?>
				    <?php } ?>
                </div>
				<?php } ?>
            
            <!-- Gallery carousel -->
			<?php elseif ( get_row_layout() == 'carousel_column_element' ) : ?>
				<?php if ( get_sub_field( 'hide' ) == 1 ) { 
				 // hide element
				} else { ?>
                <div class="flexgrid-carousel">
                    

                    <?php $gallery_ids = get_sub_field( 'gallery' ); ?>
                    <?php $size = 'full'; ?>
                    <div class="carousel" data-flickity='{ "autoPlay": 3000, "prevNextButtons": false, "pageDots": true}' tabindex="0">
                    <?php if ( $gallery_ids ) :  ?>
                        <?php foreach ( $gallery_ids as $gallery_id ): ?>
                            <div class="carousel-cell">
                            <?php echo wp_get_attachment_image( $gallery_id, $size ); ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                </div>
                <?php } ?>
            
            <!-- Video element -->
			<?php elseif ( get_row_layout() == 'video_element' ) : ?>
				<?php if ( get_sub_field( 'hide' ) == 1 ) { 
				 // Hide element 
				} else { ?>
                <?php $video_thumbnail = get_sub_field( 'video_thumbnail' ); ?>
                <div class="flexgrid-video ">
                <?php if ( have_rows( 'video' ) ) : ?>
                    <video autoplay="" preload="auto" muted="" playsinline="" -webkit-playsinline="" loop="" poster="<?php echo ''.$video_thumbnail.''; ?>" >
					<?php while ( have_rows( 'video' ) ) : the_row(); ?>
                        <source src="<?php the_sub_field( 'video_link' ); ?>" type="video/<?php the_sub_field( 'video_type' ); ?>">
                    <?php endwhile; ?>
                    </video>
				<?php else : ?>
					<?php // no rows found ?>
                <?php endif; ?>
                </div>
                <?php } ?>
            
            <!-- Video embed -->
			<?php elseif ( get_row_layout() == 'video_embed' ) : ?>
				<?php if ( get_sub_field( 'hide' ) == 1 ) { 
				 // Hide elemet 
                } else { ?>
                <div class="flexgrid-embed">
                    <div class="wrap-embed">
                        <?php the_sub_field( 'embeding_code' ); ?>
                    </div>
                </div>
                <?php } ?>
            
            <!-- Counter element -->
			<?php elseif ( get_row_layout() == 'counter' ) : ?>
				<?php $prefix = get_sub_field( 'prefix' ); ?>
                <?php $suffix = get_sub_field( 'suffix' ); ?>
                <?php $offset = get_sub_field( 'offset' ); ?>
                <?php $beginat = get_sub_field( 'begin_at_number' ); ?>
                <div class="counter">
                    <div class="counter__numbers">
                    <?php if ($prefix){ ?>
                        <span class="counter__prefix"><?php the_sub_field( 'prefix' ); ?></span>
                    <?php } ?>
                    <h2 class="timer count-title count-number  <?php the_sub_field( 'description_font_size' ); ?>" data-counterup-time="<?php the_sub_field( 'speed' ); ?>" <?php if ($offset){ ?> data-counterup-offset="<?php the_sub_field( 'offset' ); ?>" <?php } ?> <?php if ($beginat){ ?> data-counterup-beginat="<?php the_sub_field( 'begin_at_number' ); ?>" <?php } ?> ><?php the_sub_field( 'number' ); ?></h2>
                    <?php if ( $suffix ){ ?>
                        <span class="counter__suffix"><?php the_sub_field( 'suffix' ); ?></span>
                    <?php } ?>
                    </div>
                    <p class="counter__text "><?php the_sub_field( 'description' ); ?></p>
                </div>
            
            <!-- Animated types -->
            <?php elseif ( get_row_layout() == 'animated_types' ) : ?>
                <?php
                    $rand1 = rand(0, 9);
                    $rand2 = rand(0, 9);
                    $rand3 = rand(0, 9);
                    $rand4 = rand(0, 9);
                ?>
                <div class="typed <?php the_sub_field( 'font_size' ); ?> <?php the_sub_field( 'font_weight' ); ?>">
                    <p>
                        <?php the_sub_field( 'static_text' ); ?> <?php echo '<span class="typed'.$rand1.''.$rand2.''.$rand3.''.$rand4.'"></span>'; ?>
                    </p>
                    <?php if ( have_rows( 'animated_text' ) ) : ?>
                    <script>
                        var typed = new Typed(".typed<?php echo''.$rand1.''.$rand2.''.$rand3.''.$rand4.''; ?>", {
                            strings: [
                                <?php while ( have_rows( 'animated_text' ) ) : the_row(); ?>
						        "<?php the_sub_field( 'text_animated' ); ?>",
                                <?php endwhile; ?>
                            ],
                            // typing speed
                            typeSpeed: <?php the_sub_field( 'typing_speed' ); ?>,
                            // time before typing starts
                            startDelay: <?php the_sub_field( 'delay_before_typing_starts' ); ?>,
                            // backspacing speed
                            backSpeed: <?php the_sub_field( 'backspacing_speed' ); ?>,
                            // time before backspacing
                            backDelay: <?php the_sub_field( 'delay_before_backspacing' ); ?>,
                            smartBackspace: true,
                            <?php if ( get_sub_field( 'loop' ) == 1 ) : ?>
                                // loop
                                loop: true,
                            <?php else : ?>
                                // false = infinite
                                loop: true,
                                loopCount: <?php the_sub_field( 'number_of_loops' ); ?>,
                            <?php endif; ?>
                            // show cursor
                            <?php if ( get_sub_field( 'show_character_cursor' ) == 1 ) : ?>
                                showCursor: true,
                            <?php else : ?>
                                showCursor: false,
                            <?php endif; ?>
                            // character for cursor
                            cursorChar: "|",
                            // attribute to type (null == text)
                            attr: null,
                            // either html or text
                            contentType: 'html',         
                        });
                    </script>
                    <?php else : ?>
					    <?php // no rows found ?>
				    <?php endif; ?>
                </div>
                
			<?php endif; ?>
        <?php endwhile; ?>
        </section>
	<?php else: ?>
		<section></section>
    <?php endif; ?>
    
    <!-- Right column -->
    <?php if ( have_rows( 'Right_column' ) ): ?>
        <section>
		<?php while ( have_rows( 'Right_column' ) ) : the_row(); ?>
			<!-- Text element -->
            <?php if ( get_row_layout() == 'text_column_element' ) : ?>
				<?php if ( get_sub_field( 'hide' ) == 1 ) { 
				 // Hide element
				} else { ?>
				<div class="flexgrid-text vertical-<?php the_sub_field( 'align_content' ); ?>">
                    <?php $headline = get_sub_field( 'headline' ); ?>
                    <?php if ($headline) {?>
                        <h3 class="section-header"> <?php echo $headline; ?></h3>
                    <?php } ?>
				    <?php the_sub_field( 'text' ); ?>
				    <?php $button = get_sub_field( 'button' ); ?>
				    <?php if ( $button ) { ?>
					    <a class="button" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
                    <?php } ?>
                </div>
                <?php } ?>
            
            <!-- Image element -->
			<?php elseif ( get_row_layout() == 'image_column_element' ) : ?>
                <?php if ( get_sub_field( 'hide' ) == 1 ) { 
				 // Hide element
                } else { ?>
                <div class="flexgrid-image">
                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php $link = get_sub_field( 'link' ); ?>
				    <?php if ( $image ) { ?>
                        <?php if ( $link ) { ?>
                            <figure>
                                <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>"/></a>
                                <?php if ( $image['caption'] ) { ?><figcaption><?php echo $image['caption']; ?></figcaption><?php } ?>
                            </figure>
                        <?php }else{ ?>
                            <figure>
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>"/>
                                <?php if ( $image['caption'] ) { ?><figcaption><?php echo $image['caption']; ?></figcaption><?php } ?>
                            </figure>
                        <?php } ?>
				    <?php } ?>
                </div>
				<?php } ?>
            
            <!-- Gallery carousel -->
			<?php elseif ( get_row_layout() == 'carousel_column_element' ) : ?>
				<?php if ( get_sub_field( 'hide' ) == 1 ) { 
				 // hide element
				} else { ?>
                <div class="flexgrid-carousel">
                    

                    <?php $gallery_ids = get_sub_field( 'gallery' ); ?>
                    <?php $size = 'full'; ?>
                    <div class="carousel" data-flickity='{ "autoPlay": 3000, "prevNextButtons": false, "pageDots": true}' tabindex="0">
                    <?php if ( $gallery_ids ) :  ?>
                        <?php foreach ( $gallery_ids as $gallery_id ): ?>
                            <div class="carousel-cell">
                            <?php echo wp_get_attachment_image( $gallery_id, $size ); ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                </div>
                <?php } ?>
            
            <!-- Video element -->
			<?php elseif ( get_row_layout() == 'video_element' ) : ?>
				<?php if ( get_sub_field( 'hide' ) == 1 ) { 
				 // Hide element 
				} else { ?>
                <?php $video_thumbnail = get_sub_field( 'video_thumbnail' ); ?>
                <div class="flexgrid-video ">
                <?php if ( have_rows( 'video' ) ) : ?>
                    <video autoplay="" preload="auto" muted="" playsinline="" -webkit-playsinline="" loop="" poster="<?php echo ''.$video_thumbnail.''; ?>" >
					<?php while ( have_rows( 'video' ) ) : the_row(); ?>
                        <source src="<?php the_sub_field( 'video_link' ); ?>" type="video/<?php the_sub_field( 'video_type' ); ?>">
                    <?php endwhile; ?>
                    </video>
				<?php else : ?>
					<?php // no rows found ?>
                <?php endif; ?>
                </div>
                <?php } ?>
            
            <!-- Video embed -->
			<?php elseif ( get_row_layout() == 'video_embed' ) : ?>
				<?php if ( get_sub_field( 'hide' ) == 1 ) { 
				 // Hide elemet 
                } else { ?>
                <div class="flexgrid-embed">
                    <div class="wrap-embed">
                        <?php the_sub_field( 'embeding_code' ); ?>
                    </div>
                </div>
                <?php } ?>
            
            <!-- Counter element -->
			<?php elseif ( get_row_layout() == 'counter' ) : ?>
				<?php $prefix = get_sub_field( 'prefix' ); ?>
                <?php $suffix = get_sub_field( 'suffix' ); ?>
                <?php $offset = get_sub_field( 'offset' ); ?>
                <?php $beginat = get_sub_field( 'begin_at_number' ); ?>
                <div class="counter">
                    <div class="counter__numbers">
                    <?php if ($prefix){ ?>
                        <span class="counter__prefix"><?php the_sub_field( 'prefix' ); ?></span>
                    <?php } ?>
                    <h2 class="timer count-title count-number  <?php the_sub_field( 'description_font_size' ); ?>" data-counterup-time="<?php the_sub_field( 'speed' ); ?>" <?php if ($offset){ ?> data-counterup-offset="<?php the_sub_field( 'offset' ); ?>" <?php } ?> <?php if ($beginat){ ?> data-counterup-beginat="<?php the_sub_field( 'begin_at_number' ); ?>" <?php } ?> ><?php the_sub_field( 'number' ); ?></h2>
                    <?php if ( $suffix ){ ?>
                        <span class="counter__suffix"><?php the_sub_field( 'suffix' ); ?></span>
                    <?php } ?>
                    </div>
                    <p class="counter__text "><?php the_sub_field( 'description' ); ?></p>
                </div>
            
            <!-- Animated types -->
            <?php elseif ( get_row_layout() == 'animated_types' ) : ?>
                <?php
                    $rand1 = rand(0, 9);
                    $rand2 = rand(0, 9);
                    $rand3 = rand(0, 9);
                    $rand4 = rand(0, 9);
                ?>
                <div class="typed <?php the_sub_field( 'font_size' ); ?> <?php the_sub_field( 'font_weight' ); ?>">
                    <p>
                        <?php the_sub_field( 'static_text' ); ?> <?php echo '<span class="typed'.$rand1.''.$rand2.''.$rand3.''.$rand4.'"></span>'; ?>
                    </p>
                    <?php if ( have_rows( 'animated_text' ) ) : ?>
                    <script>
                        var typed = new Typed(".typed<?php echo''.$rand1.''.$rand2.''.$rand3.''.$rand4.''; ?>", {
                            strings: [
                                <?php while ( have_rows( 'animated_text' ) ) : the_row(); ?>
						        "<?php the_sub_field( 'text_animated' ); ?>",
                                <?php endwhile; ?>
                            ],
                            // typing speed
                            typeSpeed: <?php the_sub_field( 'typing_speed' ); ?>,
                            // time before typing starts
                            startDelay: <?php the_sub_field( 'delay_before_typing_starts' ); ?>,
                            // backspacing speed
                            backSpeed: <?php the_sub_field( 'backspacing_speed' ); ?>,
                            // time before backspacing
                            backDelay: <?php the_sub_field( 'delay_before_backspacing' ); ?>,
                            smartBackspace: true,
                            <?php if ( get_sub_field( 'loop' ) == 1 ) : ?>
                                // loop
                                loop: true,
                            <?php else : ?>
                                // false = infinite
                                loop: true,
                                loopCount: <?php the_sub_field( 'number_of_loops' ); ?>,
                            <?php endif; ?>
                            // show cursor
                            <?php if ( get_sub_field( 'show_character_cursor' ) == 1 ) : ?>
                                showCursor: true,
                            <?php else : ?>
                                showCursor: false,
                            <?php endif; ?>
                            // character for cursor
                            cursorChar: "|",
                            // attribute to type (null == text)
                            attr: null,
                            // either html or text
                            contentType: 'html',         
                        });
                    </script>
                    <?php else : ?>
					    <?php // no rows found ?>
				    <?php endif; ?>
                </div>
                
			<?php endif; ?>
        <?php endwhile; ?>
        </section>
	<?php else: ?>
		<section></section>
    <?php endif; ?>
    </div>
</div>

<?php endif; ?>