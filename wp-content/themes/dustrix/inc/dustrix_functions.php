<?php 

/**
 * Logo
 */
function dustrix_logo() {

    $opt = get_option('dustrix_opt');

    $logo = isset($opt['logo_select']) ? $opt['logo_select']: '2';
    
    $main_img_logo = isset($opt['main_logo'] ['url']) ? $opt['main_logo'] ['url'] : DUSTRIX_DIR_IMG.'/logo.svg';

    $main_text_logo = !empty($opt['main_text_logo']) ? $opt['main_text_logo'] : get_bloginfo( 'name' );    

    if ( function_exists('get_field') ) {
        $is_custom_logo = get_field('is_custom_logo');
        $page_logo = get_field('page_logo');
    }

    if ( !empty($is_custom_logo) && $is_custom_logo == '1' && !empty($page_logo['url']) ) { ?>
        <img src="<?php echo esc_url($page_logo['url']) ?>" alt="<?php bloginfo('name'); ?>">
    <?php }

    elseif ( $logo == 1 & !empty( $main_text_logo ) )  { ?>
            <h3 class="logo_text mb-0"> <?php echo esc_html($main_text_logo); ?></h3>
        <?php
    }

    else { ?>
        <img src="<?php echo esc_url($main_img_logo) ?>" alt="<?php bloginfo('name'); ?>">       
        <?php
    }
}

// Banner Title
function dustrix_banner_title() {
    $opt = get_option('dustrix_opt');
    if( is_home() ) {
        $blog_title = !empty($opt['blog_title']) ? $opt['blog_title'] : esc_html__('News', 'dustrix');
        echo esc_html($blog_title);
    }
    elseif( is_page() || is_single() ) {
        the_title();
    }
    elseif( is_category() ) {
        single_cat_title();
    }
    elseif( is_archive() ) {
        the_archive_title();
    }
    elseif ( is_search() ) {
        esc_html_e( 'Search result for: “', 'dustrix' ); echo get_search_query().'”';
    }
    elseif ( is_404() ) {
        printf( esc_html__( '404 Error!', 'dustrix' ) );
    }
    else {
        the_title();
    }
}

// Post's excerpt text
function dustrix_excerpt($redux_opt, $settings_key, $echo = true) {
    $opt = get_option($redux_opt);
    $excerpt_limit = !empty($opt[$settings_key]) ? $opt[$settings_key] : 50;
    $excerpt = wp_trim_words(get_the_content(), $excerpt_limit, '');
    if($echo == true) {
        echo esc_html($excerpt);
    }else {
        return esc_html($excerpt);
    }
}

// Social Links
function dustrix_social_links() {
    $opt = get_option('dustrix_opt');
    ?>
    <?php if(!empty($opt['facebook'])) { ?>
        <a href="<?php echo esc_url($opt['facebook']); ?>">
            <i class="fab fa-facebook-f" aria-hidden="true"></i>
        </a>
    <?php } ?>
    <?php if(!empty($opt['twitter'])) { ?>
        <a href="<?php echo esc_url($opt['twitter']); ?>">
            <i class="fab fa-twitter" aria-hidden="true"></i>
        </a>
    <?php } ?>
    <?php if(!empty($opt['instagram'])) { ?>
        <a href="<?php echo esc_url($opt['instagram']); ?>">
            <i class="fab fa-instagram" aria-hidden="true"></i>
        </a>
    <?php } ?>
    <?php if(!empty($opt['linkedin'])) { ?>
        <a href="<?php echo esc_url($opt['linkedin']); ?>">
            <i class="fab fa-linkedin-in" aria-hidden="true"></i>
        </a>
    <?php } ?>
    <?php if(!empty($opt['youtube'])) { ?>
        <a href="<?php echo esc_url($opt['youtube']); ?>">
            <i class="fab fa-youtube" aria-hidden="true"></i>
        </a> 
    <?php } ?>
    <?php if(!empty($opt['dribbble'])) { ?>
        <a href="<?php echo esc_url($opt['dribbble']); ?>">
            <i class="fab fa-dribbble" aria-hidden="true"></i>
        </a>
    <?php } ?>
    <?php if (!empty($opt['pinterest'])) { ?>
        <a href="<?php echo esc_url($opt['pinterest']); ?>">
            <i class="fab fa-pinterest-p" aria-hidden="true"></i>
        </a>
    <?php } ?>
    <?php if(!empty($opt['skype'])) { ?>
        <a href="<?php echo esc_url($opt['skype']); ?>">
            <i class="fab fa-skype" aria-hidden="true"></i>
        </a> 
    <?php } ?>
    <?php
}

// dustrix Social Share Options
function dustrix_post_share() {
    $opt = get_option('dustrix_opt');

    if ( $opt['is_post_fb'] == '1' ) : ?>
            <a href="//facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
                <i class="fab fa-facebook-f" aria-hidden="true"></i>
            </a>
    <?php endif; ?>

    <?php if ( $opt['is_post_twitter'] == '1' ) : ?>
            <a href="//twitter.com/intent/tweet?text=<?php the_permalink(); ?>">
                <i class="fab fa-twitter" aria-hidden="true"></i>
            </a>
    <?php endif; ?>

    <?php if ( $opt['is_post_linkedin'] == '1' ) : ?>
            <a href="//www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>">
                <i class="fab fa-linkedin-in" aria-hidden="true"></i>
            </a>
    <?php endif; ?>

    <?php if ( $opt['is_post_pinterest'] == '1' ) : ?>
            <a href="//pinterest.com/share?url=<?php the_permalink() ?>">
                <i class="fab fa-pinterest-p" aria-hidden="true"></i>
            </a>
    <?php endif; ?>

    <?php
}

function dustrix_comments_items($comment, $args, $depth){
     if ( 'ol' === $args['style'] ) {
        $tag       = 'li';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    $is_reply = ($depth > 1) ? 'has_replay' : '';
    $has_children = ( !empty( $args['children'] ) ) ? ' has_children' : '';
    ?>

        <li <?php comment_class( "comment single-comment-item $has_children $is_reply") ?> id="comment-<?php comment_ID()?>">
            <?php if ( get_avatar($comment) ) : ?>
            <div class="author-img">
                <?php echo get_avatar( $comment, 100, null, null, array( 'class' => 'comment-user', )); ?>
            </div>
            <?php endif; ?>
            <div class="author-info-comment">
                <div class="info">
                    <h5><?php echo ucwords(get_comment_author()) ?></h5>
                    <span><?php comment_time( get_option('date_format') ); ?></span>
                    <?php
                        comment_reply_link(
                            array_merge( $args,
                                array( 
                                'reply_text' => '<i class="fal fa-reply"></i>'.esc_html__( 'Reply', 'dustrix' ),
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'])
                            )
                        );
                    ?>
                </div>
                <div class="comment-text">
                    <?php echo get_comment_text(); ?>
                </div>
            </div>
        </li>    
    <?php
}

// Day link to archive page
function dustrix_day_link() {
    $archive_year   = get_the_time('Y');
    $archive_month  = get_the_time('m');
    $archive_day    = get_the_time('d');
    echo get_day_link( $archive_year, $archive_month, $archive_day);
}

// Get comment count text
function dustrix_comment_count($post_id) {
    $comments_number = get_comments_number($post_id);
    if($comments_number == 0) {
        $comment_text = esc_html__('0 comment', 'dustrix');
    }elseif($comments_number == 1) {
        $comment_text = esc_html__('1 comment', 'dustrix');
    }elseif($comments_number > 1) {
        $comment_text = $comments_number.esc_html__(' Comments', 'dustrix');
    }
    echo esc_html($comment_text);
}

// Pagination
function dustrix_pagination() {
    global $wp_query;
    if ( $wp_query->max_num_pages <= 1 ) return;
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'type'  => 'array',
        'prev_text' => '<i class="fal fa-long-arrow-left"></i>',
        'next_text' => '<i class="fal fa-long-arrow-right"></i>',
    ) );
    
    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<ul>';
        foreach ( $pages as $page ) {
            echo "<li>$page</li>";
        }
        echo '</ul>';
    }
}

/**
 * Custom CSS Code
 */
function dustrix_hook_css() {
    $opt = get_option('dustrix_opt');
    $css_code = !empty($opt['css_code']) ? $opt['css_code'] : '';
    ?>
        <?php if( !empty($css_code) ) : ?>
        <style>
            <?php echo esc_attr($css_code); ?>
        </style>
        <?php endif; ?>
    <?php
}
add_action('wp_head', 'dustrix_hook_css');

/**
 * Get a specific html tag from content
 * @return a specific HTML tag from the loaded content
 */
function dustrix_get_html_tag( $tag = 'blockquote', $content = '' ) {
    $dom = new DOMDocument();
    $dom->loadHTML($content);
    $divs = $dom->getElementsByTagName( $tag );
    $i = 0;
    foreach ( $divs as $div ) {
        if ( $i == 1 ) {
            break;
        }
        echo "<p>{$div->nodeValue}</p>";
        ++$i;
    }
}

add_filter( 'widget_text', 'do_shortcode' );
add_image_size( 'dustrix_820x460', 820, 461, true );
add_image_size( 'dustrix_1170x600', 1170, 658, true );


// Add Span In category number
add_filter('wp_list_categories', 'dustrix_cat_count_span');

function dustrix_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span class="number">(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}

// Add Span In archive number
function dustrix_the_archive_count($links) {
    $links = str_replace('</a>'.esc_attr__('&nbsp;','dustrix').'(', '</a> <span class="number">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

add_filter('get_archives_link', 'dustrix_the_archive_count');


if ( !function_exists( 'dustrix_comments_pagination' ) ) {
    function dustrix_comments_pagination() {
        the_comments_pagination( array(
            'screen_reader_text' => ' ',
            'prev_text'          => '<i class="fal fa-angle-left"></i>',
            'next_text'          => '<i class="fal fa-angle-right"></i>',
            'type'               => 'list',
            'mid_size'           => 1,
        ) );
    }
}


function dustrix_add_upload_mimes($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    $mimes['doc'] = 'application/msword';
    $mimes['csv'] = 'text/csv';
    unset( $mimes['exe'] );
    return $mimes;
}
add_filter('upload_mimes', 'dustrix_add_upload_mimes');
