<?php 
// CSS Code
Redux::setSection('dustrix_opt', array(
    'title'            => esc_html__( 'Custom CSS', 'dustrix' ),
    'id'               => 'head_custom_css',
    'subsection'       => false,
    'icon'             => 'dashicons dashicons-editor-code',
    'fields'           => array(

        array(
            'id' => 'css_code',
            'type' => 'ace_editor',
            'title' => __( 'Custom CSS Style' , 'dustrix' ),
            'desc' => __( 'Paste your CSS Code or write CSS style here. without (style) tag' , 'dustrix' ),
            'mode'     => 'css',
            'compiler' => true,
            'validate' => array(
                'css'
            )
        ),

    )
) );