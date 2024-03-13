<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dustrix
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php if ( have_comments() ) : ?>
	<div class="comments-section-wrap pt-40" id="comments">
	    <div class="comments-heading">
	        <h3><?php dustrix_comment_count(get_the_ID(), '') ?></h3>
	    </div>

	    <ul class="comments-item-list">

	    	<?php
		        wp_list_comments(
		            array(
		                'style'        => 'li',
		                'short_ping'   => true,
		                'callback'     => 'dustrix_comments_items',
		                'avatar_size'  => 100,
		            ),
		            get_comments(array(
		                'post_id' => get_the_ID(),
		            ))
		        );
		        the_comments_navigation();
		    ?>
	    </ul>
	</div>
<?php endif; ?>

<div class="comment-form-wrap mt-40">	
	<?php comment_form(); ?>
</div>



