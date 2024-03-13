<?php

Redux::setSection('dustrix_opt', array(
    'title'     => esc_html__('404 Page Settings', 'dustrix'),
    'id'        => '404_0pt',
    'icon'      => 'dashicons dashicons-megaphone',
    'fields'    => array(

        array(
            'title'    => esc_html__('404 Banner Image', 'dustrix'),
            'id'       => 'error_img_banner',
            'type'     => 'media',
            'compiler' => true,
            'default'  => array(
                'url'  => DUSTRIX_DIR_IMG.'/opt/404.png'
            ),
        ),

        array(
            'title'     => esc_html__('Heading', 'dustrix'),
            'id'        => 'error_title',
            'type'      => 'text',
            'default'   => esc_html__("Page Not Found", 'dustrix'),
        ),

        array(
            'title'     => esc_html__('Sub Heading', 'dustrix'),
            'id'        => 'error_subtitle',
            'type'      => 'textarea',
            'default'   => esc_html__('Sorry! The page you are looking doesn’t exist or broken. Go to Homepage from the below button', 'dustrix'),
        ),

        array(
            'title'     => esc_html__('Button Text', 'dustrix'),
            'id'        => 'error_btn_label',
            'type'      => 'text',
            'default'   => esc_html__('Back To Home', 'dustrix'),
        ),

        array(
            'id'          => 'btn_font_color',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Text Color', 'dustrix' ),
            'output'      => array(
                'color' => '.content-not-found .theme-btn',
            ),
        ),

        array(
            'id'          => 'btn_bg_color',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Background Color', 'dustrix' ),
            'output'      => array(
                'background' => '.content-not-found .theme-btn',
            ),
        ),

        array(
            'id'          => 'btn_border_color',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Border Color', 'dustrix' ),
            'output'      => array(
                'border-color' => '.content-not-found .theme-btn',
            ),
        ),

        array(
            'id'          => 'btn_font_color_hover',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Text Hover Color', 'dustrix' ),
            'output'      => array(
                'color' => '.content-not-found .theme-btn:hover',
            ),
        ),

        array(
            'id'          => 'btn_bg_hover',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Background Hover Color', 'dustrix' ),
            'output'      => array(
                'background' => '.content-not-found .theme-btn:hover',
            ),
        ),

        array(
            'id'          => 'btn_border_hover',
            'type'        => 'color',
            'title'       => esc_html__( 'Button Border Hover Color', 'dustrix' ),
            'output'      => array(
                'border-color' => '.content-not-found .theme-btn:hover',
            ),
        ),
    )
));
