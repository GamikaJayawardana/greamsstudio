<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function dustrix_widgets_init() {
  
    $opt = get_option( 'dustrix_opt' );
    $footer_column = !empty($opt['footer_column']) ? $opt['footer_column'] : '3';

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'dustrix' ),
			'id'            => 'blog_sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'dustrix' ),
			'before_widget' => '<div id="%1$s" class="single-sidebar-widget widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="wid-title"><h3>',
			'after_title'   => '</h3></div>',
		)
	);

	
    if ( class_exists('ReduxFrameworkPlugin') ) {
        register_sidebar( array(
            'name'          => esc_html__( 'Footer Widgets', 'dustrix' ),
            'id'            => 'footer_widgets',
            'description'   => esc_html__( 'Add widgets here.', 'dustrix' ),
            'before_widget' => '<div class="widget %2$s col-xl-'.$footer_column.' col-md-6 col-12" id="%1$s"><div class="single-footer-wid">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<div class="wid-title"><h6>',
            'after_title'   => '</h6></div>',
        ) );
    }
}
add_action( 'widgets_init', 'dustrix_widgets_init' );
