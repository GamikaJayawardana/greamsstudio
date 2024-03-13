<?php

$allowed_html = array(
	'a' => array(
		'href' => array(),
		'title' => array()
	),
	'br' => array(),
	'em' => array(),
	'strong' => array(),
    'iframe' => array(
        'src' => array(),
    )
);

$opt = get_option( 'dustrix_opt' );
$is_post_meta = isset($opt['is_post_meta']) ? $opt['is_post_meta'] : '1';
$share_options = isset($opt['is_social_share']) ? $opt['is_social_share'] : '0';
$share_heading = isset($opt['share_heading']) ? $opt['share_heading'] : '';
$is_post_author = isset($opt['is_post_author']) ? $opt['is_post_author'] : '1';
$is_post_cat = isset($opt['is_post_cat']) ? $opt['is_post_cat'] : '1';
?>
<div <?php post_class( 'single-blog-post post-details' ); ?> id="post-<?php the_ID(); ?>">
    <div class="post-content">
        <?php if ( $is_post_cat === '1' ) : ?>
            <div class="post-cat">
                <?php 
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                    }
                ?>  
            </div>
        <?php endif; ?>
        <?php if ( $is_post_meta === '1' ) : ?>
        <div class="post-meta">
            <span><i class="fal fa-comments"></i><?php comments_number( 'No Responses', 'One Comment', '% Comments' ); ?></span>
            <span><i class="fal fa-calendar-alt"></i><?php the_time( get_option('date_format') ); ?></span>
        </div>
        <?php endif; ?>
        <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links mt-3"><span class="page-link-label">' . esc_html__( 'Pages:', 'dustrix' ) . '</span>',
                'after'  => '</div>',
            ) );
        ?>     
    </div>
</div>

<?php if( has_tag() ) : ?>
<div class="row tag-share-wrap">
    <div class="col-lg-<?php echo esc_attr(($share_options == '1') ? '8' : '12'); ?> post-tags">
        <h4 class="d-line-block ms-1"><?php echo esc_html__('Tags:', 'dustrix') ?></h4>
        <?php the_tags( '', '', '' ); ?>
    </div>
    <?php if( !empty( $share_options ) && $share_options == '1' ) : ?>
    <div class="col-lg-4 col-12 text-lg-end">
        <h4><?php echo esc_html($share_heading); ?></h4>
        <div class="social-share">
            <?php echo dustrix_post_share(); ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>