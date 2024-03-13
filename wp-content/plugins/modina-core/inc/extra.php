<?php
// Add image sizes
add_action( 'after_setup_theme', function() {
    add_image_size( 'modina_100x100', 177, 100, true );
});


// Elementor is anchor external target
function modina_is_external($settings_key) {
    if(isset($settings_key['is_external'])) {
        echo $settings_key['is_external'] == true ? 'target="_blank"' : '';
    }
}

// Elementor is anchor nofollow
function modina_is_nofollow($settings_key) {
    if(isset($settings_key['nofollow'])) {
        echo $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
    }
}


function modina_icon_array($k, $replace = 'icon', $separator = '-') {
    $v = array();
    foreach ($k as $kv) {
        $kv = str_replace($separator, ' ', $kv);
        $kv = str_replace($replace, '', $kv);
        $v[] = array_push($v, ucwords($kv));
    }
    foreach($v as $key => $value) if($key&1) unset($v[$key]);
    return array_combine($k, $v);
}


// Category array
function modina_cat_array($term = 'category') {
    $cats = get_terms( array(
        'taxonomy' => $term,
        'hide_empty' => true
    ));
    $cat_array = array();
    $cat_array['all'] = esc_html__('All', 'modina-core');
    foreach ($cats as $cat) {
        $cat_array[$cat->slug] = $cat->name;
    }
    return $cat_array;
}


// Get the first category name
function modina_first_category($term = 'category') {
    $cats = get_the_terms(get_the_ID(), $term);
    $cat  = is_array($cats) ? $cats[0]->name : '';
    echo esc_html($cat);
}


// Get the first category link
function modina_first_category_link($term='category') {
    $cats = get_the_terms(get_the_ID(), $term);
    $cat  = is_array($cats) ? get_category_link($cats[0]->term_id) : '';
    echo esc_url($cat);
}


// Post title array
function modina_get_postTitleArray($postType = 'post') {
    $post_type_query  = new WP_Query(
        array (
            'post_type'      => $postType,
            'posts_per_page' => -1
        )
    );
    // we need the array of posts
    $posts_array      = $post_type_query->posts;
    // create a list with needed information
    // the key equals the ID, the value is the post_title
    $post_title_array = wp_list_pluck( $posts_array, 'post_title', 'ID' );

    return array_flip($post_title_array);
}


// Support SVG file format. Allow .svg file to upload
function modina_add_svg_to_upload_mimes( $upload_mimes )
{
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}
add_filter( 'upload_mimes', 'modina_add_svg_to_upload_mimes', 10, 1 );


// Limit latter
function modina_core_limit_latter($string, $limit_length, $suffix = '...') {
    if (strlen($string) > $limit_length) {
        echo strip_shortcodes(substr($string, 0, $limit_length) . $suffix);
    }
    else {
        echo strip_shortcodes(esc_html($string));
    }
}

add_filter('widget_text', 'do_shortcode');



/**
 * Check if contact form 7 is activated
 *
 * @return bool
 */
if ( !function_exists( 'modina_core_is_cf7_activated' ) ) {
    function modina_core_is_cf7_activated() {
        return class_exists( 'WPCF7' );
    }
}

/**
 * Get a list of all CF7 forms
 *
 * @return array
 */
if ( !function_exists( 'modina_core_get_cf7_forms' ) ) {
    function modina_core_get_cf7_forms() {
        $forms = get_posts( [
            'post_type'      => 'wpcf7_contact_form',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ] );

        if ( !empty( $forms ) ) {
            return wp_list_pluck( $forms, 'post_title', 'ID' );
        }
        return [];
    }
}

if ( !function_exists( 'modina_core_do_shortcode' ) ) {
    function modina_core_do_shortcode( $tag, array $atts = array(), $content = null ) {
        global $shortcode_tags;
        if ( !isset( $shortcode_tags[$tag] ) ) {
            return false;
        }
        return call_user_func( $shortcode_tags[$tag], $atts, $content, $tag );
    }
}