<?php

// Footer settings
Redux::setSection('dustrix_opt', array(
	'title'     => esc_html__('Footer', 'dustrix'),
	'id'        => 'dustrix_footer',
	'icon'      => 'dashicons dashicons-table-row-before',
));


// ScrollUp settings
Redux::setSection('dustrix_opt', array(
	'title'     => esc_html__('Scroll Up', 'dustrix'),
	'id'        => 'dustrix_scrollup',
	'icon'      => 'el el-arrow-up',
	'subsection'=> true,
	'fields'    => array(   

        array(
            'title'     => esc_html__('Scroll Up Icon Color', 'dustrix'),
            'id'        => 'scroll_icon_color',
            'type'      => 'color',
            'output'    => '.scroll-up',
        ),

        array(
            'title'     => esc_html__('Scroll Up Background Color', 'dustrix'),
            'id'        => 'scroll_bg_color',
            'type'      => 'color',
        ),
        
        array(
            'title'     => esc_html__('Scroll Up Hover Icon Color', 'dustrix'),
            'id'        => 'scroll_hover_icon_color',
            'type'      => 'color',
            'output'    => '.scroll-up:hover',
        ),

        array(
            'title'     => esc_html__('Scroll Up Hover Background Color', 'dustrix'),
            'id'        => 'scroll_hover_bg_color',
            'type'      => 'color',
        ),

	)
));

// Footer settings
Redux::setSection('dustrix_opt', array(
	'title'     => esc_html__('Footer Top Settings', 'dustrix'),
	'id'        => 'dustrix_footer_widgets_opt',
	'icon'      => 'dashicons dashicons-editor-kitchensink',
	'subsection'=> true,
	'fields'    => array(

        array(
            'title'     => esc_html__( 'Footer Column', 'dustrix' ),
            'id'        => 'footer_column',
            'type'      => 'select',
            'default'   => '3',
            'options'   => array(
                '6' => esc_html__( 'Two Column', 'dustrix' ),
                '4' => esc_html__( 'Three Column', 'dustrix' ),
                '3' => esc_html__( 'Four Column', 'dustrix' ),
            )
        ),

        array(
            'id'     => 'divider_three',
            'type'   => 'divide',
        ),

        array(
            'title'     => esc_html__('Widget Title Color', 'dustrix'),
            'id'        => 'widget_title_color',
            'type'      => 'color',
        ),

        array(
            'title'     => esc_html__('Footer Text Color', 'dustrix'),
            'id'        => 'footer_text_color',
            'type'      => 'color',
            'output'    => 'footer .single-footer-wid ul li a, .widget .textwidget p, footer span, footer p',
        ),

        array(
            'id'     => 'divider_six',
            'type'   => 'divide',
        ),

        array(
            'title'     => esc_html__('Footer Background Color', 'dustrix'),
            'id'        => 'footer_bg_color',
            'type'      => 'color',
        ),
        
        array(
            'title'    => esc_html__('Footer Background Image', 'dustrix'),
            'id'       => 'footer_bg_img',
            'type'     => 'media',
            'compiler' => true,
        ),

	)
));

// Footer settings
Redux::setSection('dustrix_opt', array(
	'title'     => esc_html__('Footer Bottom', 'dustrix'),
	'id'        => 'dustrix_footer_style_opt',
	'icon'      => 'dashicons dashicons-editor-kitchensink',
	'subsection'=> true,
	'fields'    => array(

        array(
			'title'     => esc_html__('Footer Copyright', 'dustrix'),
			'desc'      => esc_html__('write down your own copyright info.', 'dustrix'),
			'id'        => 'footer_copyright_content',
			'type'      => 'editor',
			'default'   => '<p>&copy; <b>Dustrix</b> - 2022. All rights reserved.</p>'
		),

        array(
            'title'     => esc_html__('Footer Text Color', 'dustrix'),
            'id'        => 'footer_text_color',
            'type'      => 'color',
            'output'    => 'footer .footer-bottom p',
        ),

        array(
            'title'     => esc_html__('Footer Link Color', 'dustrix'),
            'id'        => 'footer_link_color',
            'type'      => 'color',
            'output'    => 'footer .footer-bottom a',
        ),

        array(
            'title'     => esc_html__('Footer Bottom Bar Background', 'dustrix'),
            'id'        => 'footer_bottom_bg_color',
            'type'      => 'color',
        ),

	)
));
