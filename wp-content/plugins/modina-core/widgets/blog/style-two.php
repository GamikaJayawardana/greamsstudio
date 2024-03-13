<div class="row">
    <?php
        global $post;
        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => 1,
        );

        $the_query = new \WP_Query($args);
        while ($the_query->have_posts()) : $the_query->the_post();
        $do_not_duplicate = $post->ID;
        
        $featured_img_url = get_the_post_thumbnail_url($post->ID,'full');
        $author_id = get_the_author_meta( 'ID' ); 
    ?>
    <div class="col-lg-6 pe-3 ps-3 pe-lg-5">
        <div class="single-blog-vcard bg-cover" style="background-image: linear-gradient( 0deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0) 100%), url('<?php echo esc_url($featured_img_url); ?>')">
            <div class="post-content text-white">
                <div class="post-meta d-flex">
                    <div class="post-author me-2">
                        <i class="fal fa-user"></i><?php the_author_posts_link(); ?>
                    </div>
                    |
                    <div class="post-date ms-2">
                        <i class="fal fa-calendar-alt"></i>
                        <span><?php echo get_the_date( 'dS F Y ', $post->ID); ?></span>
                    </div>
                </div>
                <h3><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>

    <div class="col-lg-6">
        <div class="blog-list-view">
            <?php
                $args = array(
                    'post_type'             => 'post',
                    'post_status'           => 'publish',
                    'ignore_sticky_posts'   => 1,
                    'posts_per_page'        => !empty($settings['post_limit']) ? $settings['post_limit'] : 3,
                );

                $the_query = new \WP_Query($args);

                while ($the_query->have_posts()) : $the_query->the_post();

                if( $post->ID == $do_not_duplicate ) continue;

                $featured_img_url = get_the_post_thumbnail_url($post->ID,'full'); 
            ?>
            <div class="single-blog-item">
                <div class="featured-thumb bg-cover" style="background-image: url('<?php echo esc_url($featured_img_url); ?>')"></div>
                <div class="post-content">
                    <div class="post-meta">
                        <div class="post-author">
                            <i class="fal fa-user"></i><?php the_author_posts_link(); ?>
                        </div>
                        <div class="post-date">
                            <i class="fal fa-calendar-alt"></i>
                            <span><?php echo get_the_date( 'dS F Y', $post->ID); ?></span>
                        </div>
                    </div>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div>
            </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</div>


