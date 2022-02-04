<?php
/**
 * Block template file: /lib/template-parts/blocks/hero_carousel.php
 *
 * Hero Carousel Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-carousel-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-hero-carousel';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
    }
    .static-banner{
        position:absolute;
        z-index:10;
    }
    .block-hero-carousel .text-area{
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:self-start;
        z-index:-1;
    }
    .block-hero-carousel .text-area h3{
        font-size:clamp(3.6rem, 3vw, 18rem);
    }
    .block-hero-carousel img{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height:100%;
        width:100%;
        object-fit:cover;
    }
    .block-hero-carousel .carousel-cell {
        height: 100%;
    }
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <?php if ( have_rows( 'carousel' ) ) : ?>
        
        <div class="carousel" data-flickity='{ "autoPlay": <?php the_field( 'speed' ); ?>, "prevNextButtons": false, "pageDots": false, "draggable": false, "wrapAround": true, "pauseAutoPlayOnHover": false, "cellSelector": ".carousel-cell", "setGallerySize": false}' tabindex="0">
            
        <?php $button = get_field( 'button' ); ?>
        <?php if ( $button ) : ?>
            <div class="static-banner">
                <a class="wp-block-button__link" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
            </div>
        <?php endif; ?>
            
        <?php while ( have_rows( 'carousel' ) ) : the_row(); ?>
            <div class="carousel-cell text-area">
            <?php $headline = get_sub_field( 'headline' ); ?>
            <?php $short_text = get_sub_field( 'short_text' ); ?>
            <?php $link = get_sub_field( 'link' ); ?>

            <?php if ( $headline ) : ?>
                <h3><?php the_sub_field( 'headline' ); ?></h3>
            <?php endif; ?>
            <?php if ( $headline ) : ?>
                <?php the_sub_field( 'short_text' ); ?>
			<?php endif; ?>
			<?php $link = get_sub_field( 'link' ); ?>
			<?php if ( $link ) : ?>
				<a class="wp-block-button__link" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
            <?php endif; ?>
            </div>
        <?php endwhile; ?>
        </div>
        
        <div class="carousel" data-flickity='{ "autoPlay": <?php the_field( 'speed' ); ?>, "prevNextButtons": false, "pageDots": true, "draggable": false, "wrapAround": true, "pauseAutoPlayOnHover": false, "imagesLoaded": true, "setGallerySize": false}' tabindex="0">
        <?php while ( have_rows( 'carousel' ) ) : the_row(); ?>
            <?php $image = get_sub_field( 'image' ); ?>
			<?php $size = 'full'; ?>
            <div class="carousel-cell">
			<?php if ( $image ) : ?>
				<?php echo wp_get_attachment_image( $image, $size ); ?>
			<?php endif; ?>
            </div>
        <?php endwhile; ?>
        </div>
    
	<?php else : ?>
		<?php // no rows found ?>
    <?php endif; ?>
    
	
    
</div>