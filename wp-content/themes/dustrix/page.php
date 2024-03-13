<?php
/**
 * The page template file
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dustrix
 */

get_header();
?>
    <section class="blog-wrapper news-wrapper section-padding">
        <div class="container">
            <div class="row">
                 <div class="col-12 col-lg-12 page-contents">
                    <?php
                        while ( have_posts() ) : the_post();

                            the_content();

                        endwhile; 

                        wp_link_pages(array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'dustrix' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'dustrix' ) . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                        ));

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>
                 </div>     
            </div>
        </div>
    </section>

<?php
get_footer();
