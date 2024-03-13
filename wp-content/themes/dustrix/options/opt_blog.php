<?php

Redux::setSection('dustrix_opt', array(
	'title'     => esc_html__('Blog Settings', 'dustrix'),
	'id'        => 'blog_page',
	'icon'      => 'dashicons dashicons-admin-post',
));


Redux::setSection('dustrix_opt', array(
	'title'     => esc_html__('Title-Bar', 'dustrix'),
	'id'        => 'blog_titlebar_settings',
	'icon'      => 'dashicons dashicons-admin-post',
    'subsection' => true,
	'fields'    => array(
		array(
			'title'     => esc_html__('Blog Page Title', 'dustrix'),
			'subtitle'  => esc_html__('Give here the blog page title', 'dustrix'),
			'desc'      => esc_html__('This text will be show on blog page banner', 'dustrix'),
			'id'        => 'blog_title',
			'type'      => 'text',
			'default'   => 'News'
		),
	)
));


Redux::setSection('dustrix_opt', array(
    'title'     => esc_html__('Layout Style', 'dustrix'),
    'id'        => 'blog_layout_settings',
    'icon'      => 'dashicons dashicons-align-left',
    'subsection' => true,
    'fields'    => array(
        array(
            'title'     => esc_html__('Select Blog Layout Style', 'dustrix'),
            'id'        => 'blog_layout_style',
            'type'      => 'image_select',
            'default'   => '1',
            'options'   => array(
                '1' => array(
                    'alt' => esc_html__('Right Sidebar - Default', 'dustrix'),
                    'img' => esc_url(DUSTRIX_DIR_IMG.'/opt/right-sidebar.png')
                ),
                '2' => array(
                    'alt' => esc_html__('Left Sidebar', 'dustrix'),
                    'img' => esc_url(DUSTRIX_DIR_IMG.'/opt/left-sidebar.png')
                ),
            )
        ),

    )
));


Redux::setSection('dustrix_opt', array(
	'title'     => esc_html__('Blog Single', 'dustrix'),
	'id'        => 'blog_single_opt',
	'icon'      => 'dashicons dashicons-media-document',
	'subsection' => true,
	'fields'    => array(
        array(
			'title'     => esc_html__( 'Post Meta', 'dustrix' ),
			'subtitle'  => esc_html__( 'Show/hide post meta on blog archive page', 'dustrix' ),
			'id'        => 'is_post_meta',
			'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'dustrix' ),
            'off'       => esc_html__( 'Hide', 'dustrix' ),
            'default'   => '1',
		),
	)
));

// blog Share Options
Redux::setSection('dustrix_opt', array(
    'title'     => esc_html__('Blog Social Share', 'dustrix'),
    'id'        => 'blog_share_opt',
    'subsection'=> true,
    'icon'      => 'dashicons dashicons-share',
    'fields'    => array(

        array(
            'title'     => esc_html__( 'Social Share', 'dustrix' ),
            'id'        => 'is_social_share',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'dustrix' ),
            'off'       => esc_html__( 'Disabled', 'dustrix' ),
            'default'   => '0'
        ),

        array(
            'id' => 'blog_share_start',
            'type' => 'section',
            'title' => __('Share Options', 'dustrix'),
            'subtitle' => __('Enable/Disable social media share options as you want.', 'dustrix'),
            'required' => array('is_social_share','=','1'),
            'indent' => true,
        ),

        array(
            'title'    => esc_html__('Title', 'dustrix'),
            'id'       => 'share_heading',
            'type'     => 'text',
            'compiler' => true,
            'default'  => esc_html__('Share on', 'dustrix'),
        ),

        array(
            'id'       => 'is_post_fb',
            'type'     => 'switch',
            'title'    => esc_html__('Facebook', 'dustrix'),
            'default'  => true,
            'on'       => esc_html__('Show', 'dustrix'),
            'off'      => esc_html__('Hide', 'dustrix'),
        ),

        array(
            'id'       => 'is_post_twitter',
            'type'     => 'switch',
            'title'    => esc_html__('Twitter', 'dustrix'),
            'default'  => true,
            'on'       => esc_html__('Show', 'dustrix'),
            'off'      => esc_html__('Hide', 'dustrix'),
        ),

        array(
            'id'       => 'is_post_linkedin',
            'type'     => 'switch',
            'title'    => esc_html__('Linkedin', 'dustrix'),
            'on'       => esc_html__('Show', 'dustrix'),
            'off'      => esc_html__('Hide', 'dustrix'),
            'default'  => true,
        ),

        array(
            'id'       => 'is_post_pinterest',
            'type'     => 'switch',
            'title'    => esc_html__('Pinterest', 'dustrix'),
            'default'  => true,
            'on'       => esc_html__('Show', 'dustrix'),
            'off'      => esc_html__('Hide', 'dustrix'),
        ),

        array(
            'id'     => 'post_share_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));


