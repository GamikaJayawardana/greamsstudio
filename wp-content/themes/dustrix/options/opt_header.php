<?php
// Header Section
Redux::setSection('dustrix_opt', array(
    'title'            => esc_html__( 'Header Settings', 'dustrix' ),
    'id'               => 'header_sec',
    'customizer_width' => '400px',
    'icon'             => 'el el-home',
    'fields'           => array(

        array (
            'title'     => esc_html__( 'Header Style', 'dustrix' ),
            'subtitle'  => esc_html__( 'Select your header style from this three design.', 'dustrix' ),
            'id'        => 'header_style',
            'type'      => 'image_select',
            'default'   => '1',
            'options'   => array (
                '1' => array (
                    'alt' => esc_html__( 'Header One', 'dustrix' ),
                    'img' => esc_url( DUSTRIX_DIR_IMG.'/opt/header1.png' ),
                ),
                '2' => array (
                    'alt' => esc_html__( 'Header Two', 'dustrix' ),
                    'img' => esc_url( DUSTRIX_DIR_IMG.'/opt/header2.png' ),
                ),
                '3' => array (
                    'alt' => esc_html__( 'Header Three', 'dustrix' ),
                    'img' => esc_url( DUSTRIX_DIR_IMG.'/opt/header3.png' ),
                )
            )
        ),

        array(
            'title'     => esc_html__('Top Header Bar', 'dustrix'),
            'subtitle'  => esc_html__( 'are you want show top bar ?', 'dustrix' ),
            'id'        => 'top_header_opt',
            'type'      => 'switch',
            'default'  => false,
            'on'       => esc_html__('Show', 'dustrix'),
            'off'      => esc_html__('Hide', 'dustrix'),
        ),
        array(
            'id'      => 'top_divider_1',
            'type'    => 'divide',
            'required'    => array('top_header_opt', '!=', 'false' ),
        ),

        array(
            'title'     => esc_html__('Phone Number', 'dustrix'),
            'subtitle'  => esc_html__( 'Type phone number.', 'dustrix' ),
            'id'        => 'phone_number',
            'type'      => 'text',
            'required'    => array('top_header_opt', '!=', 'false' ),
            'default'   => '987-098-098-09',
        ),

        array(
            'title'     => esc_html__('Email Address', 'dustrix'),
            'subtitle'  => esc_html__( 'Type email address.', 'dustrix' ),
            'id'        => 'email_address',
            'type'      => 'text',
            'required'    => array('top_header_opt', '!=', 'false' ),
            'default'   => 'info@example.com',
        ),

        array(
            'title'     => esc_html__('Office Address - Location', 'dustrix'),
            'subtitle'  => esc_html__( 'Type phone number.', 'dustrix' ),
            'id'        => 'office_address',
            'type'      => 'text',
            'required'    => array('top_header_opt', '!=', 'false' ),
            'default'   => 'Cargo Hub, LD 32614, UK',
        ),

        array(
            'title'     => esc_html__('Office Time Hours', 'dustrix'),
            'subtitle'  => esc_html__( 'Enter Days & Time.', 'dustrix' ),
            'id'        => 'office_hours',
            'type'      => 'text',
            'required'    => array('top_header_opt', '!=', 'false' ),
            'default'   => 'Mon-Fri 8am-5pm',
        ),

        array(
            'title'     => esc_html__('Welcome Text', 'dustrix'),
            'subtitle'  => esc_html__( 'Type your top bar welcome heading.', 'dustrix' ),
            'id'        => 'welcome_text',
            'type'      => 'textarea',
            'required'    => array('top_header_opt', '!=', 'false' ),
            'default'   => 'Welcome To No. 1 Construction Solutions',
            'args'   => array(
                'teeny'            => true,
                'textarea_rows'    => 10
            ),
        ),

        array(
            'id'      => 'top_divider_3',
            'type'    => 'divide',
        ),

    )
) );

// Logo
Redux::setSection('dustrix_opt', array(
    'title'            => esc_html__( 'Logo', 'dustrix' ),
    'id'               => 'logo_setting',
    'subsection'       => true,
    'icon'             => 'el el-upload',
    'fields'           => array(

        array(
            'title'     => esc_html__('Select Your Logo Type', 'dustrix'),
            'subtitle'  => esc_html__( 'which type logo you want for your site ?', 'dustrix' ),
            'id'        => 'logo_select',
            'type'      => 'select',
            'options'  => array(
                '1' => 'Text',
                '2' => 'Image',
            ),
            'default'  => '2',
        ),

        array(
            'title'     => esc_html__('Text Logo', 'dustrix'),
            'subtitle'  => esc_html__( 'Type your logo text , it is a text logo.', 'dustrix' ),
            'id'        => 'main_text_logo',
            'type'      => 'text',
            'default'   => 'dustrix',
            'required'  => array( 
                array('logo_select','equals','1')
            ),
        ),

        array(
            'title'     => esc_html__('Logo Text Color', 'dustrix'),
            'subtitle'  => esc_html__('Select Logo color', 'dustrix'),
            'id'        => 'logo_text_color',
            'type'      => 'color',
            'required'  => array( 
                array('logo_select','equals','1')
            ),
        ),

        array(
            'title'     => esc_html__('Main Logo Upload', 'dustrix'),
            'subtitle'  => esc_html__( 'Upload here a image file for your logo', 'dustrix' ),
            'id'        => 'main_logo',
            'type'      => 'media',
            'compiler'  => true,
            'required'  => array( 
                array('logo_select','equals','2')
            ),
            'default'   => array(
                'url'   => DUSTRIX_DIR_IMG.'/logo.svg'
            ),
        ),

        array(
            'title'     => esc_html__( 'Logo dimensions', 'dustrix' ),
            'subtitle'  => esc_html__( 'Set a custom height width for your upload logo.', 'dustrix' ),
            'id'        => 'logo_dimensions',
            'required'  => array( 
                array('logo_select','equals','2')
            ),            
            'type'      => 'dimensions',
            'units'     => array( 'em','px','%' ),
            'output'    => '.logo > img'
        ),

    )
) );

// banner Section
Redux::setSection('dustrix_opt', array(
    'title'            => esc_html__( 'Banner', 'dustrix' ),
    'id'               => 'banner_sec',
    'subsection'       => true,
    'icon'             => 'el el-picture',
    'fields'           => array(

        array(
            'id'      => 'is_breadcrumb',
            'type'    => 'switch',
            'title'   => esc_html__( 'Breadcrumb Option', 'dustrix' ),
            'on'      => esc_html__('Show', 'dustrix'),
            'off'     => esc_html__('Hide', 'dustrix'),
            'default' => false,
        ),

        array(
            'title'     => esc_html__( 'Banner Image Type', 'dustrix' ),
            'id'        => 'is_banner_img',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'dustrix' ),
            'off'       => esc_html__( 'Hide', 'dustrix' ),
            'default'   => '1'
        ),

        array(
            'id' => 'banner_opt_start',
            'type' => 'section',
            'title' => __('Banner Options', 'dustrix'),
            'subtitle' => __('Enable/Disable Header Banner Options as you want.', 'dustrix'),
            'required' => array('is_banner_img','=','1'),
            'indent' => true,
        ),

        array(
            'title'     => esc_html__('Header Banner Image Upload', 'dustrix'),
            'subtitle'  => esc_html__( 'Upload here a jpg/png file for header background image.', 'dustrix' ),
            'id'        => 'header_banner_img',
            'type'      => 'media',
            'compiler'  => true,
            'default'   => array(
                'url'   => DUSTRIX_DIR_IMG.'/page-banner.jpg'
            ),
        ),

        array(
            'title'     => esc_html__('Banner Overlay Color', 'dustrix'),
            'id'        => 'banner_overlay_color',
            'type'      => 'color',
        ),

        array(
            'id' => 'banner_overlay_color_opacity',
            'type' => 'slider',
            'title' => esc_html__('Banner Overlay Color Opacity', 'dustrix'),
            "min" => 0,
            "step" => .1,
            "max" => 1,
            'resolution' => 0.1,
            'display_value' => 'label'
        ),

        array(
            'id'     => 'banner_opt_end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id' => 'banner_opt_color_start',
            'type' => 'section',
            'title' => __('Banner Color', 'dustrix'),
            'required' => array('is_banner_img','=','0'),
            'indent' => true,
        ),

        array(
            'title'     => esc_html__('Banner Color', 'dustrix'),
            'subtitle'  => esc_html__( 'Choice your solid banner color', 'dustrix' ),
            'id'        => 'banner_color',
            'type'      => 'color'
        ),

        array(
            'id'     => 'banner_opt_color_end',
            'type'   => 'section',
            'indent' => false,
        ),

    )
) );

// Navbar styling
Redux::setSection('dustrix_opt', array(
    'title'            => esc_html__( 'Navbar', 'dustrix' ),
    'id'               => 'navbar_styling',
    'subsection'       => true,
    'icon'             => 'el el-lines',
    'fields'           => array(

        array(
            'title'     => esc_html__('Menu Item Color', 'dustrix'),
            'subtitle'  => esc_html__('Menu item Text color', 'dustrix'),
            'id'        => 'menu_text_color',
            'type'      => 'color',
        ),

        array(
            'title'     => esc_html__('Menu Item Hover Color', 'dustrix'),
            'subtitle'  => esc_html__('Menu item Text color', 'dustrix'),
            'id'        => 'menu_hover_text_color',
            'type'      => 'color',
        ),

        array(
            'title'     => esc_html__('Menu Active Color', 'dustrix'),
            'subtitle'  => esc_html__('Menu item active and hover text color', 'dustrix'),
            'id'        => 'menu_active_text_color',
            'type'      => 'color',
        ),

        array(
            'title'     => esc_html__('Sub Menu Background Color', 'dustrix'),
            'id'        => 'sub_menu_bg_color',
            'type'      => 'color',
        ),

        array(
            'title'     => esc_html__('Menu Item Margin', 'dustrix'),
            'subtitle'  => esc_html__('Margin around menu item (li).', 'dustrix'),
            'id'        => 'menu_item_margin',
            'type'      => 'spacing',
            'mode'      => 'margin',
            'units'     => array( 'em', 'px' ),
        ),

    )
));

// Menu action button
Redux::setSection('dustrix_opt', array(
    'title'            => esc_html__( 'Action Button', 'dustrix' ),
    'id'               => 'cta_btn_opt',
    'subsection'       => true,
    'icon'             => 'el el-link',
    'fields'           => array(
        
        array(
            'title'     => esc_html__('Button Visibility', 'dustrix'),
            'id'        => 'is_menu_btn',
            'type'      => 'switch',
            'on'        => esc_html__('Show', 'dustrix'),
            'off'       => esc_html__('Hide', 'dustrix'),
        ),

        array(
            'title'     => esc_html__('Button Label', 'dustrix'),
            'subtitle'  => esc_html__('Leave the button label field empty to hide the button.', 'dustrix'),
            'id'        => 'menu_btn_label',
            'type'      => 'text',
            'default'   => esc_html__('Get A Quote', 'dustrix'),
            'required'  => array('is_menu_btn', '=', '1')
        ),

        array(
            'title'     => esc_html__('Button URL', 'dustrix'),
            'id'        => 'menu_btn_url',
            'type'      => 'text',
            'default'   => '#',
            'required'  => array('is_menu_btn', '=', '1')
        ),

        array(
            'title'     => esc_html__('Font Size', 'dustrix'),
            'id'        => 'menu_btn_size',
            'type'      => 'spinner',
            'default'   => '14',
            'min'       => '12',
            'step'      => '1',
            'max'       => '50',
            'required'  => array('is_menu_btn', '=', '1')
        ),

        array(
            'title'     => esc_html__('Button Colors', 'dustrix'),
            'subtitle'  => esc_html__('Button style attributes on normal', 'dustrix'),
            'id'        => 'button_colors',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('is_menu_btn', '=', '1')
        ),

        array(
            'title'     => esc_html__('Text color', 'dustrix'),
            'id'        => 'menu_btn_font_color',
            'type'      => 'color',
            'output'    => array('header .header-promo-btn a, header.header-1 .top-bar .d-btn'),
            'required'  => array('is_menu_btn', '=', '1')
        ),
            
        array(
            'title'     => esc_html__('Background Color', 'dustrix'),
            'id'        => 'menu_btn_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('header .header-promo-btn a, header.header-1 .top-bar .d-btn'),
            'required'  => array('is_menu_btn', '=', '1')
        ),

        // Button color on hover stats
        array(
            'title'     => esc_html__('Hover Text Color', 'dustrix'),
            'subtitle'  => esc_html__('Text color on hover stats.', 'dustrix'),
            'id'        => 'menu_btn_hover_font_color',
            'type'      => 'color',
            'output'    => array('header .header-promo-btn a:hover, header.header-1 .top-bar .d-btn:hover'),
            'required'  => array('is_menu_btn', '=', '1')
        ),

        array(
            'title'     => esc_html__('Hover Background Color', 'dustrix'),
            'subtitle'  => esc_html__('Background color on hover stats.', 'dustrix'),
            'id'        => 'menu_btn_hover_bg_color',
            'type'      => 'color',
            'output'    => array(
                'background' => 'header.header-1 .top-bar .d-btn:hover, header .header-promo-btn a:hover',
            ),
            'required'  => array('is_menu_btn', '=', '1')
        ),

        array(
            'id'     => 'button_colors-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'title'     => esc_html__('Button Padding', 'dustrix'),
            'subtitle'  => esc_html__('Padding around the menu donate button.', 'dustrix'),
            'id'        => 'menu_btn_padding',
            'type'      => 'spacing',
            'output'    => array( 'header .header-promo-btn a, header.header-1 .top-bar .d-btn' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ), 
            'units_extended' => 'true',
            'required'  => array('is_menu_btn', '=', '1')
        ),
    )
));