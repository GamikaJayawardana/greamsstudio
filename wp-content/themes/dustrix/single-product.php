<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Transland
 */

get_header();

$opt = get_option('dustrix_opt');
$share_options = isset( $opt['is_social_share'] ) ? $opt['is_social_share'] : '';
$share_heading = isset( $opt['share_heading'] ) ? $opt['share_heading'] : '';

?>
    <section class="blog-wrapper news-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-post-details border-wrap">                        
                        <?php
	                    while ( have_posts() ) : the_post();
                            the_content();
	                    endwhile;
	                    ?>                      
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
