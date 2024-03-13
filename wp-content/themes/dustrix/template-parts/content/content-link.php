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
$is_post_author = isset($opt['is_post_author']) ? $opt['is_post_author'] : '1';
$is_post_cat = isset($opt['is_post_cat']) ? $opt['is_post_cat'] : '1';

?>

<div <?php post_class( 'single-blog-post quote-post format-quote' ); ?>>
    <div class="post-content text-white bg-cover">
        <div class="quote-content">
            <div class="icon">
                <i class="fas fa-link"></i>
            </div>
            <div class="quote-text">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php if ( $is_post_meta === '1' ) : ?>
                <ul class="post-meta">
                    <span><i class="fal fa-comments"></i><?php comments_number( 'No responses', 'One Comment', '% Comments' ); ?></span>
                    <span><i class="fal fa-calendar-alt"></i><?php the_time( get_option('date_format') ); ?></span>
                </ul>
                <?php endif; ?>
            </div>
        </div>                                                                
    </div>
</div>
