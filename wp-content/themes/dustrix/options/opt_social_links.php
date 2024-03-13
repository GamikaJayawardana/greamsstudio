<?php
Redux::setSection('dustrix_opt', array(
    'title'     => esc_html__('Social Links', 'dustrix'),
    'id'        => 'opt_social_links',
    'icon'      => 'dashicons dashicons-share',
    'fields'    => array(
        array(
            'id'    => 'facebook',
            'type'  => 'text',
            'title' => esc_html__('Facebook', 'dustrix'),
            'default'	 => '#'
        ),
        array(
            'id'    => 'twitter',
            'type'  => 'text',
            'title' => esc_html__('Twitter', 'dustrix'),
            'default'	  => '#'
        ),
        array(
            'id'    => 'skype',
            'type'  => 'text',
            'title' => esc_html__('Skype', 'dustrix'),
            'default'	  => '#'
        ),
        array(
            'id'    => 'linkedin',
            'type'  => 'text',
            'title' => esc_html__('LinkedIn', 'dustrix'),
            'default'	  => '#'
        ),
        array(
            'id'    => 'dribbble',
            'type'  => 'text',
            'title' => esc_html__('Dribbble', 'dustrix'),
        ),
        array(
            'id'    => 'youtube',
            'type'  => 'text',
            'title' => esc_html__('Youtube', 'dustrix'),
            'default' => '#'
        ),
        array(
            'id'    => 'instagram',
            'type'  => 'text',
            'title' => esc_html__('Instagram', 'dustrix'),
        ),
    ),
));