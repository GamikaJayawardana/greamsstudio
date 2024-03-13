<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Dustrix
 */

get_header();

$opt = get_option('dustrix_opt');

$error_title = !empty($opt['error_title']) ? $opt['error_title'] : esc_html__( 'Page Not Found', 'dustrix' );

$error_subtitle = !empty($opt['error_subtitle']) ? $opt['error_subtitle'] : esc_html__( 'Sorry! The page you are looking doesn’t exist or broken. Go to Homepage from the below button', 'dustrix' );
$error_btn_label  =!empty($opt['error_btn_label']) ?  $opt['error_btn_label'] :  esc_html__( 'Back To Home', 'dustrix' );

$error_img_banner = isset($opt['error_img_banner'] ['url']) ? $opt['error_img_banner'] ['url'] : DUSTRIX_DIR_IMG.'/opt/404.png';

?>
    <section class="blog-wrapper section-padding ">
        <div class="container">
            <div class="content-not-found text-center">
                <img src="<?php echo esc_url($error_img_banner) ?>" alt="<?php echo esc_attr($error_title) ?>"/>
                <h1 class="mt-4 mb-2"><?php echo esc_html($error_title); ?></h1>
                <p><?php echo esc_html($error_subtitle); ?></p>
                <a class="theme-btn mt-4" href="<?php echo esc_url( home_url('/') ); ?>"><?php echo esc_html($error_btn_label) ?></a>
            </div>   
        </div>
    </section>
<?php
get_footer();
