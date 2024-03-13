<?php
    add_filter('get_search_form', function($form) {
        $value = get_search_query() ? get_search_query() : '';
        $form = '<form action="'.esc_url(home_url("/")).'" class="search-form-box">
                    <input type="search" name="s" placeholder="'.esc_attr__( 'Search', 'dustrix' ).'" value="'.esc_attr($value).'">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>';
        return $form;
    }); 
?>