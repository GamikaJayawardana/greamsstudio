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
    <?php
        while ( have_posts() ) : the_post();

            the_content();

        endwhile; 
    ?>

<?php
get_footer();
