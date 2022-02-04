<?php if ( get_sub_field( 'hide_timeline' ) == 1 ) : ?>
    <?php // hide timeline ?>
<?php else : ?>
    <section>
        <div class="cd-container <?php if ( get_sub_field( 'animate_timeline' ) == 1 ) : ?>animate-timeline<?php endif; ?> <?php the_sub_field( 'items_alignment' ); ?>">
                        
            <?php if ( have_rows( 'timeline_items' ) ) : ?>
                <?php while ( have_rows( 'timeline_items' ) ) : the_row(); ?>
                    <?php if ( get_sub_field( 'hide_item' ) == 1 ) : ?>
                        <?php // hide timeline item ?>
                    <?php else : ?>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-picture"></div>
                        <div class="cd-timeline-content">
                            <span class="cd-date">
                                <?php the_sub_field( 'start_day' ); ?> <?php the_sub_field( 'start_month' ); ?> <?php the_sub_field( 'start_year' ); ?>
                                <?php if(get_sub_field('end_day') || get_sub_field('end_month') || get_sub_field('end_year')) : ?>
                                    - <?php the_sub_field( 'end_day' ); ?> <?php the_sub_field( 'end_month' ); ?> <?php the_sub_field( 'end_year' ); ?>
                                <?php endif; ?>
                            </span>
                            <h4><?php the_sub_field( 'headline' ); ?></h4>
                            <?php the_sub_field( 'text' ); ?>
                            <?php $link = get_sub_field( 'link' ); ?>
                            <?php if ( $link ) : ?>
                                <a class="section-link" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?> <svg class="icon-stepup-arrow"><use xlink:href="#icon-stepup-arrow"></use></svg></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>

        </div>
    </section>
<?php endif; ?>