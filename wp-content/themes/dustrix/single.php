<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Dustrix
 */

get_header();

$opt = get_option('dustrix_opt');
$share_options = isset( $opt['is_social_share'] ) ? $opt['is_social_share'] : '';
$share_heading = isset( $opt['share_heading'] ) ? $opt['share_heading'] : '';
$blog_column = is_active_sidebar( 'blog_sidebar' ) ? '8' : '12';
$blog_layout_style = isset( $opt['blog_layout_style'] ) ? $opt['blog_layout_style'] : '';

?>
    <section class="blog-wrapper news-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-<?php echo esc_attr($blog_column) ?> <?php if(!empty($blog_layout_style) && $blog_layout_style == '2') :  ?> order-xl-2 order-1<?php endif;?>">
                    <div class="blog-post-details border-wrap">                        
                        <?php
	                    while ( have_posts() ) : the_post();
	                        get_template_part('template-parts/content/content-single');
                            
                            the_post_navigation(
                                array(
                                    'prev_text' => '<span class="dustrix-nav-title">%title</span>',
                                    'next_text' => '<span class="dustrix-nav-title">%title</span>',
                                )
                            );
	                    endwhile;
	                    ?>
                        <?php
                            if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) :
                                comments_template();
                            endif;
                        ?>                        
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>
<?php
get_footer();
