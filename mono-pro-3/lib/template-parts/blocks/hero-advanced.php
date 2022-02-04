<?php
/**
 * Block template file: /lib/template-parts/blocks/hero-advanced.php
 *
 * Hero Advanced Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-advanced-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-hero-advanced';
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
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> hero ">
    <?php $headline = get_field( 'headline' ); ?>
    <?php $text = get_field( 'text' ); ?>
    <?php $countdown_to_date = get_field( 'countdown_to_date' ); ?>
    <?php $button = get_field( 'button' ); ?>
    <?php $background_video_thumbnail = get_field( 'background_video_thumbnail' ); ?>
    <?php $background_image = get_field( 'background_image' ); ?>

    <div class="wrap">
        <?php if($headline) { ?>
            <h2 class="hero-title"><?php the_field( 'headline' ); ?></h2>
        <?php } ?>
        
        <?php if($countdown_to_date) { ?>
            <div id="clockdiv">
                <div class="counter"><div class="days"></div><div class="smalltext">Days</div></div>
                <div class="counter"><div class="hours"></div><div class="smalltext">Hours</div></div>
                <div class="counter"><div class="minutes"></div><div class="smalltext">Minutes</div></div>
                <div class="counter"><div class="seconds"></div><div class="smalltext">Seconds</div></div>
            </div>
            <script>
            var deadline = "<?php the_field( 'countdown_to_date' ); ?> GMT+0200";
            function time_remaining(endtime){
                var t = Date.parse(endtime) - Date.parse(new Date());
                var seconds = Math.floor( (t/1000) % 60 );
                var minutes = Math.floor( (t/1000/60) % 60 );
                var hours = Math.floor( (t/(1000*60*60)) % 24 );
                var days = Math.floor( t/(1000*60*60*24) );
                return {"total":t, "days":days, "hours":hours, "minutes":minutes, "seconds":seconds};
            }
            function run_clock(id,endtime){
                var clock = document.getElementById(id);
	
                // get divs where our clock numbers are held
                var days_div = clock.querySelector(".days");
                var hours_div = clock.querySelector(".hours");
                var minutes_div = clock.querySelector(".minutes");
                var seconds_div = clock.querySelector(".seconds");

                function update_clock(){
                    var t = time_remaining(endtime);
		
                    // update the numbers in each part of the clock
                    days_div.innerHTML = t.days;
                    hours_div.innerHTML = ("0" + t.hours).slice(-2);
                    minutes_div.innerHTML = ("0" + t.minutes).slice(-2);
                    seconds_div.innerHTML = ("0" + t.seconds).slice(-2);
		
                    if(t.total<=0){ clearInterval(timeinterval); }
                }
                update_clock();
                var timeinterval = setInterval(update_clock,1000);
            }
            run_clock("clockdiv",deadline);
            </script>
        <?php } ?>

        <?php if($text) { ?>
            <p class="<?php the_field( 'text_size' ); ?>"><?php the_field( 'text' ); ?></p>
        <?php } ?>
        <?php if ( $button ) : ?>
		    <a class="wp-block-button__link" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
	    <?php endif; ?>

        <?php if ( get_field( 'background_type' ) == 1 ) : ?>

            <?php $background_image = get_field( 'background_image' ); ?>
            <?php $size = 'full'; ?>
            <?php $background_image_caption = get_the_excerpt( $background_image ); ?>
            <?php if ( $background_image ) : ?>
                <?php echo wp_get_attachment_image( $background_image, $size ); ?>
                <?php if ( $background_image_caption ) { ?>
                <figcaption><?php echo $background_image_caption; ?></figcaption>
                <?php } ?>
            <?php endif; ?>
            
	    <?php else : ?>

            <?php if ( have_rows( 'background_video' ) ) : ?>
		    <div class="wrap__video">
                <video autoplay="" preload="auto" muted="" playsinline="" -webkit-playsinline="" loop=""  <?php if ( $background_video_thumbnail ) : ?>poster="<?php the_field( 'background_video_thumbnail' ); ?>"<?php endif ?>>
                    <?php while ( have_rows( 'background_video' ) ) : the_row(); ?>
                        <?php if ( get_sub_field( 'video_link' ) ) : ?>
                            <source src="<?php the_sub_field( 'video_link' ); ?>" type="video/<?php the_sub_field( 'video_type' ); ?>">
                        <?php endif; ?>
                    <?php endwhile; ?>
                </video>
            </div>
            <?php endif; ?>

	    <?php endif; ?>
    </div>
	
	
	
	

</div>

<?php
/*
add_action( 'genesis_after', 'mono_hero_countdown_script' );
function mono_hero_countdown_script() { ?>
        <script>
            var deadline = "<?php the_field( 'countdown_to_date' ); ?> GMT+0200";
            function time_remaining(endtime){
                var t = Date.parse(endtime) - Date.parse(new Date());
                var seconds = Math.floor( (t/1000) % 60 );
                var minutes = Math.floor( (t/1000/60) % 60 );
                var hours = Math.floor( (t/(1000*60*60)) % 24 );
                var days = Math.floor( t/(1000*60*60*24) );
                return {"total":t, "days":days, "hours":hours, "minutes":minutes, "seconds":seconds};
            }
            function run_clock(id,endtime){
                var clock = document.getElementById(id);
	
                // get divs where our clock numbers are held
                var days_div = clock.querySelector(".days");
                var hours_div = clock.querySelector(".hours");
                var minutes_div = clock.querySelector(".minutes");
                var seconds_div = clock.querySelector(".seconds");

                function update_clock(){
                    var t = time_remaining(endtime);
		
                    // update the numbers in each part of the clock
                    days_div.innerHTML = t.days;
                    hours_div.innerHTML = ("0" + t.hours).slice(-2);
                    minutes_div.innerHTML = ("0" + t.minutes).slice(-2);
                    seconds_div.innerHTML = ("0" + t.seconds).slice(-2);
		
                    if(t.total<=0){ clearInterval(timeinterval); }
                }
                update_clock();
                var timeinterval = setInterval(update_clock,1000);
            }
            run_clock("clockdiv",deadline);
        </script>
<?php } ?>
*/ ?>