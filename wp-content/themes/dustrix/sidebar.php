<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dustrix
 */

if ( ! is_active_sidebar( 'blog_sidebar' ) ) {
	return;
}

$opt = get_option('dustrix_opt');
$blog_layout_style = isset( $opt['blog_layout_style'] ) ? $opt['blog_layout_style'] : '';

?>

<div class="col-lg-4 <?php if(!empty($blog_layout_style) && $blog_layout_style == '2') :  ?> order-xl-1 order-2 <?php endif; ?>">
    <div class="main-sidebar">
        <?php dynamic_sidebar( 'blog_sidebar' ); ?>
    </div>
</div>