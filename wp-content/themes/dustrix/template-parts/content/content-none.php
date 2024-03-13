<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dustrix
 */

?>

<section class="no-results not-found text-center">
	<h1><?php esc_html_e( 'Nothing Found', 'dustrix' ); ?></h1>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'dustrix' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'dustrix' ); ?></p>
            
			<div class="mt-5">
				<?php echo get_search_form() ?>
			</div>
        <?php else : ?>

        	<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dustrix' ); ?></p>
        	
			<div class="mt-5">
				<?php echo get_search_form() ?>
			</div>
        <?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
