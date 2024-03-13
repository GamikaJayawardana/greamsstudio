<?php
Redux::setSection('dustrix_opt', array(
    'title'            => esc_html__( 'Preloader Settings', 'dustrix' ),
    'id'               => 'preloader_opt',
    'icon'             => 'dashicons dashicons-sos',
    'fields'           => array(

        array(
            'id'      => 'is_preloader',
            'type'    => 'switch',
            'title'   => esc_html__( 'Pre-loader', 'dustrix' ),
            'on'      => esc_html__('Enable', 'dustrix'),
            'off'     => esc_html__('Disable', 'dustrix'),
            'default'   => '0',
        ),

        array(
            'title'     => esc_html__('Pre-Loader Title Text', 'dustrix'),
            'desc'  => esc_html__('change preloader title with your own.', 'dustrix'),
            'id'        => 'preloader_title',
            'type'      => 'text',
            'default'  => get_bloginfo('name'),
            'required' => array('is_preloader', '=', '1'),
        ),

        array(
            'required' => array('is_preloader', '=', '1'),
            'id'       => 'loading_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Loading Text', 'dustrix' ),
            'default'  => esc_html__('Loading', 'dustrix'),
        ),

        array(
            'title'     => esc_html__('Preloader Title Color', 'dustrix'),
            'subtitle'  => esc_html__( 'Choice solid color for preloader title (Big Heading) color.', 'dustrix' ),
            'id'        => 'preloader_title_color',
            'type'      => 'color',
            'output'      => array(
                'color' => '.preloader .animation-preloader .txt-loading .letters-loading, .preloader .animation-preloader .txt-loading .letters-loading::before',
            ),
            'required' => array('is_preloader', '=', '1'),
        ),

        array(
            'title'     => esc_html__('Preloader Loading Text Color', 'dustrix'),
            'subtitle'  => esc_html__( 'Choice color for preloader loading text (p) color.', 'dustrix' ),
            'id'        => 'preloader_text_color',
            'type'      => 'color',
            'output'      => array(
                'color' => '.preloader .animation-preloader p',
            ),
            'required' => array('is_preloader', '=', '1'),
        ),

        array(
            'title'     => esc_html__('Preloader Spinner (moving) Color', 'dustrix'),
            'subtitle'  => esc_html__( 'Choice your solid color for border top Spinner (moving) color.', 'dustrix' ),
            'id'        => 'preloader_spinner_color',
            'type'      => 'color',
            'output'      => array(
                'border-top-color' => '.preloader .animation-preloader .spinner',
            ),
            'required' => array('is_preloader', '=', '1'),
        ),

        array(
            'required' => array('is_preloader', '=', '1'),
            'title'     => esc_html__('Preloader Background', 'dustrix'),
            'id'        => 'preloader_bg',
            'type'      => 'background',
        ),

    )
));