<?php
/**
 * Block template file: /lib/template-parts/blocks/team.php
 *
 * Team Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'team-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-team';
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
</style>

<?php $id = get_field( 'id' ); ?>
<?php if ( $id ) { ?>
        <a class="linkedID" id="<?php the_field( 'id' ); ?>"></a>
<?php } ?> 
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php if ( get_field( 'top_and_bottom_margin' ) == 1 ) { ?>has-top-bottom-margin<?php } ?> <?php if ( get_field( 'top_and_bottom_padding' ) == 1 ) : ?>has-top-bottom-padding<?php endif; ?>">
<div class="gridcontainer__team coll<?php the_field( 'number_of_columns' ); ?> has-column-gap">
    <?php $posts = get_field( 'team_members' ); ?>
    
    <?php if ( $posts ): ?>
        <?php global $post; ?>
        <?php foreach ( $posts as $post ):  ?>
        <section class="team-member">
            <?php setup_postdata ( $post ); ?>
            <?php $title = get_post_meta( $post->ID, 'title', true ); ?>
            <?php $email = get_post_meta( $post->ID, 'email', true ); ?>
            <?php $telephone = get_post_meta( $post->ID, 'telephone', true ); ?>
            <?php $short_biography = get_post_meta( $post->ID, 'short_biography', true ); ?>
            <?php $leave_description = get_post_meta( $post->ID, 'leave_description', true ); ?>
            <?php $person_on_leave = get_post_meta( $post->ID, 'person_on_leave', true ); ?>
                <?php if ( (is_single() || is_page()) && has_post_thumbnail() ) { ?>
                    <figure>
                        <?php $imgfull = genesis_get_image( array( 'format' => 'html' ) ); printf( '%s', $imgfull ); ?>
                        <?php if ( $person_on_leave == 1 ) { ?>
 		                    <span class="onleave"><svg class="icon-warning"><use xlink:href="#icon-warning"></use></svg> <?php echo $leave_description; ?></span>
                        <?php } ?>
                </figure>
                <?php } ?>
                
                <p><span class="name"><?php the_title(); ?></span>
                    <?php if ($title){ ?><span class="title"><?php echo $title; ?></span><?php } ?>
                    <?php if ($email){ ?><span class="email"><svg class="icon-mail"><use xlink:href="#icon-mail"></use></svg> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span><?php } ?>
                    <?php if ($telephone){ ?><span class="phone"><svg class="icon-phone"><use xlink:href="#icon-phone"></use></svg> <a href="tel:<?php echo $telephone; ?>"><?php echo $telephone; ?></a></span></p><?php } ?>
                    <?php if ($short_biography){ ?><p class="biography"><?php echo $short_biography; ?></p><?php } ?>
            </section>
		<?php endforeach; ?>
	<?php wp_reset_postdata(); ?>
    <?php endif; ?>
</div>
</div>