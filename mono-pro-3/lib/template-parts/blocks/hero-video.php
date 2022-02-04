<?php

/**
 * Block template file: /lib/template-parts/hero-video.php
 *
 * Hero Video Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-video-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-hero-video';
if( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		
    }
    .hero{
        position:relative;
        display: flex;
        justify-content:center;
        align-items:center;
        width:auto;
        min-height:calc(100vh - 126px);
        overflow:hidden;
    }
    .hero h2.hero-title{
        color:#F2F2F2;
        font-size: clamp(4.8rem, 7vw, 18rem);
        text-align:center;
    }
    .hero .wrap{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        max-width:90%;
    }
    .hero .wrap p{
        color:#F2F2F2;
        text-align:center;
    }
    .hero .wrap__video{
        position:absolute;
        top:0;
        right:0;
        bottom:0;
        left:0;
        z-index:-1;
    }
    <?php echo '#' . $id; ?> video {
        position:absolute;
        top:50%;
        left:50%;
        transform: translate(-50%, -50%);
        max-width:unset;
        min-height:100%;
        min-width:100%;
        z-index:-1;
    }
</style>

<?php

$hero_text          = get_field('video_hero_text');
$hero_video_text    = get_field('video-text');
$text_size          = get_field('text_size');
$hero_video         = get_field('video_link');
$video_thumbnail    = get_field( 'video_thumbnail' );
$button_video_hero  = get_field( 'button_video_hero' );
$columns            = get_field( 'columns' );

if ( get_field( 'columns' ) == 1 ) :
echo '<div id="'.esc_attr( $id ).'" class="hero hero-video '.esc_attr( $classes ).'">';
    else :
echo '<div id="'.esc_attr( $id ).'" class="hero hero-video coll2 '.esc_attr( $classes ).'">';
endif;

// echo '<div id="'.esc_attr( $id ).'" class="hero hero-video '.esc_attr( $classes ).'">';
    echo '<div class="wrap">';
        if ( $hero_text ) {
            echo '<h2 class="hero-title">'.$hero_text.'</h2>';
        }
        if ( $hero_video_text ) {
            echo '<p class="'.$text_size.'">'.$hero_video_text.'</p>';
        }
	    if ( $button_video_hero ) {
		    echo '<a class="wp-block-button__link" href="<'.$button_video_hero['url'].'" target="<'.$button_video_hero['target'].'">'.$button_video_hero['title'].'</a>';
        }
    echo '</div>';
    
    if ( $hero_video ) :
    echo '<div class="wrap__video">';
        echo '<video autoplay="" preload="auto" muted="" playsinline="" -webkit-playsinline="" loop=""  poster="'.$video_thumbnail.'">';
            echo '<source src="'.$hero_video.'" type="video/mp4">';
        echo '</video>';
    echo '</div>';
    else :
        // no rows found
    endif;
echo '</div>';