<?php
/**
 * dustrix functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dustrix
 */

if ( ! defined( 'DUSTRIX_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'DUSTRIX_VERSION', '1.5.0' );
}

if ( ! function_exists( 'dustrix_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dustrix_setup() {

		load_theme_textdomain( 'dustrix', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );


		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );
		// Enable excerpt support for page
    	add_post_type_support( 'page', 'excerpt' );
		add_theme_support( 'post-formats', array( 'audio', 'video', 'quote', 'link' ) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'main_menu' => esc_html__( 'Main Menu', 'dustrix' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'dustrix_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

        add_theme_support( 'align-wide' );

         // woo support
         add_theme_support( 'wc-product-gallery-zoom' );
         add_theme_support( 'wc-product-gallery-lightbox' );
         add_theme_support( 'wc-product-gallery-slider' );

        // page support
        add_post_type_support( 'page', 'excerpt' );
        add_theme_support( 'editor-style' );
        add_theme_support( 'responsive-embeds' );

		/** custom background **/
        $bg_defaults = array(
            'default-image'          => '',
            'default-preset'         => 'default',
            'default-size'           => 'cover',
            'default-repeat'         => 'no-repeat',
            'default-attachment'     => 'scroll',
        );
        add_theme_support( 'custom-background', $bg_defaults );
        add_theme_support( 'custom-header' );
		add_editor_style( 'style-editor.css' );

	}
endif;
add_action( 'after_setup_theme', 'dustrix_setup' );


function dustrix_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dustrix_content_width', 1200 );
}
add_action( 'after_setup_theme', 'dustrix_content_width', 0 );

/**
 * Constants
 * Defining default asset paths
 */
define('DUSTRIX_DIR_CSS', get_template_directory_uri().'/assets/css');
define('DUSTRIX_DIR_JS', get_template_directory_uri().'/assets/js');
define('DUSTRIX_DIR_IMG', get_template_directory_uri().'/assets/img');
define('DUSTRIX_DIR_FONT', get_template_directory_uri().'/assets/fonts');


/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Theme's helper functions
 */
require get_template_directory() . '/inc/dustrix_functions.php';

/**
 * Theme's template-tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Required plugins activation
 */
require get_template_directory() . '/inc/plugin_activation.php';

// /**
//  * Bootstrap Nav Walker
//  */
require get_template_directory() . '/inc/Dustrix_Nav_Walker.php';

/**
 * Register Sidebar Areas
 */
require get_template_directory() . '/inc/sidebars.php';

// /**
//  * Theme Options - Redux
//  */
require get_template_directory() . '/options/opt-config.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// /**
//  * One Click Demo Import.
//  */
require get_template_directory() . '/inc/one_click_demo_config.php';


// /**
//  * Woocommerce Config
//  */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woo-config.php';
}