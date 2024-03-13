<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dustrix
 */

    $opt = get_option('dustrix_opt');

    $footer_copyright_content = isset( $opt['footer_copyright_content'] ) ? $opt['footer_copyright_content'] : '<p>&copy; <b>Dustrix </b> Ltd - 2022. All rights reserved.</p>';

    $footer_visibility = function_exists( 'get_field' ) ? get_field( 'footer_visibility' ) : '1';
    $footer_visibility = isset($footer_visibility) ? $footer_visibility : '1';

?>

    <?php if( $footer_visibility  == '1' ) : ?>
    <footer class="footer-1 footer-wrap">
        <?php if ( is_active_sidebar( 'footer_widgets' ) ) : ?>
        <div class="footer-widgets dark-bg">
            <div class="container">
                <div class="row">
                    <?php dynamic_sidebar( 'footer_widgets' ); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ( class_exists('ReduxFrameworkPlugin') ) : ?>
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <?php if (!empty ($footer_copyright_content) ) : ?>
                    <div class="col-lg-6 col-12 text-center text-lg-start">
                        <div class="copyright-info">
                            <p><?php echo wp_specialchars_decode( esc_html( $footer_copyright_content ) ); ?></p>                         
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty ($footer_copyright_content) ) : ?>
        <div class="footer-bottom-bar <?php if ( class_exists('ReduxFrameworkPlugin') ) : ?>d-none<?php endif; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <div class="copyright-info">
                            <?php echo wp_specialchars_decode( esc_html( $footer_copyright_content ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </footer>
    <?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
