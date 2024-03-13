<div class="recent-post-list">
    <?php
        global $post;
        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => !empty($settings['post_limit']) ? $settings['post_limit'] : 3,
        );
        $the_query = new \WP_Query($args);
        while ($the_query->have_posts()) : $the_query->the_post();

        $featured_img_url = get_the_post_thumbnail_url($post->ID,'full');
        $author_id = get_the_author_meta( 'ID' );
    ?>
    <div class="single-recent-post">
        <div class="thumb bg-cover" style="background-image: url('<?php echo esc_url($featured_img_url); ?>');"></div>
        <div class="post-data">
            <?php if ( $settings['show_post_date'] == 'yes' ) : ?>
            <span><i class="fal fa-calendar-alt"></i> <?php echo get_the_date( 'dS F Y', $post->ID); ?></span>
            <?php endif; ?>
            <h5><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a></h5>
        </div>
    </div>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>