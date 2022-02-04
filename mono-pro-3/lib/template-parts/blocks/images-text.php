<?php
/**
 * Block template file: /lib/template-parts/images-text.php
 *
 * Images Text Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'images-text-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-images-text';
if( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
	@media only screen and (min-width: 768px) {
		.section-content{
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
		align-items: center;
	}
	.section-content .section-media,
	.section-content .section-text{
		
	}
	.section-content .section-media{
		order: 1;
	}
	.section-content .section-text{
		order: 2;
        margin-top: 0;
	}
	.section-content:nth-child(even) .section-media{
		order: 2;
	}
	.section-content:nth-child(even) .section-text{
		order: 1;
	}
	}
	
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>  <?php if ( get_field( 'top_and_bottom_padding' ) == 1 ) : ?>has-top-bottom-padding<?php endif; ?> <?php if ( get_field( 'top_and_bottom_margins' ) == 1 ) : ?>has-top-bottom-margin<?php endif ?>">
	<?php if ( have_rows( 'images_and_texts' ) ) : ?>

		<?php while ( have_rows( 'images_and_texts' ) ) : the_row(); ?>
			<?php $hide_section_array = get_sub_field( 'hide_section' ); ?>
            
			<?php if ( $hide_section_array ){ ?>
            <!-- Show nothing -->
            <?php }else{ ?>
            <!-- Section Start -->
            <?php $section_text = get_sub_field( 'section-text' ); ?>
			<?php $section_link = get_sub_field( 'section-link' ); ?>

            <section class="section-content">
			
            <div class="section-media">
			<?php if ( get_sub_field( 'select_image_or_gallery' ) == 1 ) { ?>
            
			    <div class="carousel" data-flickity='{ "autoPlay": 3000, "prevNextButtons": false, "pageDots": true}' tabindex="0">
                    

					<?php $gallery_ids = get_sub_field( 'gallery' ); ?>
					<?php $size = 'full'; ?>
					<?php if ( $gallery_ids ) :  ?>
						<?php foreach ( $gallery_ids as $gallery_id ): ?>
							<div class="carousel-cell">
								<?php echo wp_get_attachment_image( $gallery_id, $size ); ?>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>

                </div>
			    <?php } else { ?>
                <?php $section_image = get_sub_field( 'section-image' ); ?>
				<?php if ( $section_image ) : ?>
					<figure class="section-image">
						<?php echo wp_get_attachment_image( $section_image, $size ); ?>
					</figure>
				<?php endif; ?>
            
			<?php } ?>
            </div>
            
            <div class="section-text">
				<h3 class="section-header"><?php the_sub_field( 'section-headline' ); ?></h3>
				<?php the_sub_field( 'section-text' ); ?>
                <?php if ( $section_link ) { ?>
				    <a class="section-link" href="<?php echo $section_link['url']; ?>" target="<?php echo $section_link['target']; ?>"><?php echo $section_link['title']; ?> <svg class="icon-stepup-arrow"><use xlink:href="#icon-stepup-arrow"></use></svg></a>
			    <?php } ?>
			</div>

            <!-- Section End -->
            <?php } ?>
            </section>
		<?php endwhile; ?>

	<?php else : ?>
		<?php // no rows found ?>
	<?php endif; ?>
</div>

<?php