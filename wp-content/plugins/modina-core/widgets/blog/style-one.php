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
        $theAuthorDataRoles = get_userdata($author_id);
        $theRolesAuthor = $theAuthorDataRoles -> roles;
    ?>
    <div class="col-lg-4 col-md-6 col-12">
        <div class="single-blog-card">
            <div class="featured-img bg-cover" style="background-image: url('<?php echo esc_url($featured_img_url); ?>')">
            </div>
            <div class="post-content">
                <div class="post-date">
                    <span><?php $post_date = get_the_date( 'j' ); echo $post_date; ?></span>
                    <?php $post_mon = get_the_date( 'M' ); echo $post_mon; ?>
                </div>
                <div class="post-meta">
                    <?php 
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="post-cat">' . esc_html( $categories[0]->name ) . '</a>';
                        }
                    ?> / 
                    <a href="<?php echo get_the_author_meta( 'user_url', $author_id ); ?>" class="post-author"><?php echo get_the_author_meta( 'display_name', $author_id ); ?></a>
                </div>
                <h3><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>                        
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>