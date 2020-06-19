<?php 

add_filter( 'mce_buttons_2', 'fb_mce_editor_buttons' );
function fb_mce_editor_buttons( $buttons ) {

    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

/**
 * Add styles/classes to the "Styles" drop-down
 */ 
add_filter( 'tiny_mce_before_init', 'fb_mce_before_init' );

function fb_mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => 'Expand-Collapse',
            'block' => 'div',
            'classes' => 'mobileExpand',
            'wrapper' => true
        ),
        array(
            'title' => 'Red Uppercase Text',
            'inline' => 'span',
            'styles' => array(
                'color'         => 'red', // or hex value #ff0000
                'fontWeight'    => 'bold',
                'textTransform' => 'uppercase'
            )
        ),
        array(
            'title' => 'Drop Caps',
            'inline' => 'span',
            'classes' => 'drop-caps',
            'styles' => array(
                'color'         => '#00508B', // or hex value #ff0000
                'fontWeight'    => 'bold',
                'float' 		=> 'left',
                'fontSize'		=> '70px'
            )
        ),
        array(
            'title' => 'Drop Caps w BG',
            'inline' => 'span',
            'classes' => 'drop-caps-w-bg',
            'styles' => array(
                'color'         => '#ffffff', // or hex value #ff0000
                'fontWeight'    => '100',
                'backgroundColor' => '#00508B',
                'float' 		=> 'left',
                'fontSize'		=> '50px'
            )
        ),
        array(
            'title' => 'Add Border to Heading',
            'inline' => 'span',
            'classes' => 'heading-border',
            'styles' => array(
                'color'         => '#00508B', // or hex value #ff0000
            )
        ),


    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}

