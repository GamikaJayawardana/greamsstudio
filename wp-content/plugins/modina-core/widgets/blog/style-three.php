<div class="row">
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
    <div class="col-xl-4 col-md-6 col-12">
        <div class="single-news-box">
            <div class="blog-featured-thumb bg-cover" style="background-image: url('<?php echo esc_url($featured_img_url); ?>')"></div>
            <div class="content">
                <div class="post-author">
                    <i class="fal fa-user-circle"></i> <?php the_author_link(); ?>
                </div>
                <h3><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
                <div class="btn-link-share">
                    <a href="<?php the_permalink(); ?>" class="theme-btn minimal-btn"><?php echo esc_html( $settings['read_more_txt'] ); ?> <i class="fas fa-arrow-right"></i></a>
                    <a href="<?php the_permalink(); ?>"><i class="fal fa-share-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>