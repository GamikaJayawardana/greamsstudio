<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package saasland
 */

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
$is_post_author = isset($opt['is_post_author']) ? $opt['is_post_author'] : '1';
$is_post_cat = isset($opt['is_post_cat']) ? $opt['is_post_cat'] : '1';
$read_more = isset($opt['read_more']) ? $opt['read_more'] : 'Read More';

?>

<div <?php post_class( 'single-blog-post format-video video-post' ); ?>>
    <?php       
    if ( has_post_thumbnail() ) :
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
    ?> 
        <div class="post-featured-thumb bg-cover" style="background-image: url('<?php echo esc_url($featured_img_url); ?>')">
            <?php
            $video_url = function_exists( 'get_field' ) ? get_field( 'video_url' ) : '';
            if (!empty($video_url)) : ?>
            <div class="video-play-btn">
                <a href="<?php echo esc_url($video_url); ?>" class="play-video popup-video"><i class="fas fa-play"></i></a>               
            </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>    
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
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        
        <?php if ( $is_post_meta === '1' ) : ?>
        <div class="post-meta">
            <span><i class="fal fa-comments"></i><?php comments_number( 'no responses', 'One Comment', '% Comments' ); ?></span>
            <span><i class="fal fa-calendar-alt"></i><?php the_time( get_option('date_format') ); ?></span>
        </div>
        <?php endif; ?>
        <p><?php echo strip_shortcodes(dustrix_excerpt('dustrix_opt', 'blog_excerpt', false)); ?> </p>
        <div class="d-flex justify-content-between align-items-center mt-30">
            <?php if ( $is_post_author === '1' ) : ?>
            <div class="author-info">
                <?php $avatar_url = get_avatar_url(get_the_author_meta( 'ID' ), array('size' => 100)); ?>
                <div class="author-img" style="background-image: url('<?php echo esc_url( $avatar_url ); ?>')"></div>               
                <h5>by <?php echo get_the_author_link(); ?></h5>
            </div>
            <?php endif; ?>

            <div class="post-link">
                <a href="<?php the_permalink(); ?>"><i class="fal fa-long-arrow-right"></i> <?php echo esc_html($read_more); ?></a>
            </div>
        </div>
    </div>
</div>
