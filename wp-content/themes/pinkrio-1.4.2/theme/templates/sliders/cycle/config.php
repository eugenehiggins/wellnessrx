<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
 
yit_register_slider_style(  $slider_type, 'slider-cycle', 'css/cycle.css' );
yit_register_slider_style(  $slider_type, 'slider-cycle-ie', 'css/cycle-ie.css' );
yit_register_slider_script( $slider_type, 'jquery-cycle', 'js/jquery.anythingslider.js' );

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = false;

// add support to slide
yit_add_slide_support( $slider_type, 'title, content-editor, link', array(
    array(
        'name' => __( 'Background Color', 'yit' ),
        'id' => 'background_color',
        'type' => 'colorpicker',
        'desc' => __( 'Select the background color for this slide. It changes also the text color automatically, in base of this color.', 'yit' ),
        'std' => '',
    ),  
    array(
        'name' => __( 'Position Image', 'yit' ),
        'id' => 'position_image',
        'type' => 'text-array',
        'desc' => __( 'Select the position of image (leave empty to put it to the top left of the slider container).', 'yit' ),
        'fields' => array(
            'top'    => __( 'Top', 'yit' ),        
            'right'  => __( 'Right', 'yit' ),
            'bottom' => __( 'Bottom', 'yit' ),
            'left'   => __( 'Left', 'yit' ),
        ),
        'size' => 40,
        'std' => '',
    ),    
    array(
        'name' => __( 'Position Text', 'yit' ),
        'id' => 'position_text',
        'type' => 'text-array',
        'desc' => __( 'Select the position of the text (leave empty to put it to the top left of the slider container).', 'yit' ),
        'fields' => array(
            'top'    => __( 'Top', 'yit' ),        
            'right'  => __( 'Right', 'yit' ),
            'bottom' => __( 'Bottom', 'yit' ),
            'left'   => __( 'Left', 'yit' ),
        ),            
        'size' => 40,
        'std' => '',
    )        
) );
 
// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
    array(
        'name' => __( 'Height', 'yit' ),
        'id' => 'height',
        'type' => 'number',
        'desc' => __( 'Select the height of slider.', 'yit' ),
        'min' => 50,
        'max' => 700,
        'std' => 485,
    ),        
    array( "name" => __("Next & Prev navigation", 'yit'),
           "desc" => __("Choose if you want to show Next & Prev arrows", 'yit'),
           "id" => 'directionNav',
           "type" => "onoff",
           "std" => 1),

    array( "name" => __("Next & Prev only on hover", 'yit'),
           "desc" => __("Choose if you want to show Next & Prev arrows only on hover", 'yit'), 
           "id" => 'directionNavHide',
           "type" => "onoff",
           "std" => 1),

    array( "name" => __("Autoplay", 'yit'),
           "desc" => __("Choose if you want to start automatically the slider transitions", 'yit'),
           "id" => 'autoplay',
           "type" => "onoff",
           "std" => 1),
           
    array( "name" => __("Enable Widget Area", 'yit'),
           "desc" => __("Choose if you want to enable or disable the widget area below the slider", 'yit'),
           "id" => 'enable_widget_area',
           "type" => "onoff",
           "std" => 1),
           
    array( "name" => __("Widget area", 'yit'),
           "desc" => sprintf( __("Choose the sidebar use for the 'Widget area' to use in the slider. Create a new one in <a href=\"%s\">Sidebars</a>.", 'yit'), admin_url( 'admin.php?page=yit_panel_sidebars' ) ),
           "id" => 'sidebar',
           "type" => "sidebarlist",
           "std" => ''),
    array(
        'name' => __( 'Pause between slides (s)', 'yit' ),                         
        'id' => 'interval',
        'type' => 'slider',        
        'desc' => __( 'Select the delay between slides, expressed in seconds.', 'yit' ),
        'min' => 0.1,
        'max' => 20,
        'step' => 0.1,
        'std' => 3
    ),
    array(
        'name' => __( 'Animation speed (s)', 'yit' ),
        'id' => 'speed',
        'type' => 'slider',
        'desc' => __( 'The speed of the animation between two slide, expressed in seconds.', 'yit' ),
        'min' => 0.1,
        'max' => 20,   
        'step' => 0.1,  
        'std' => 0.8
    ),
    array(
        'name' => __( 'Text color for dark background', 'yit' ),
        'id' => 'light_color',
        'type' => 'colorpicker',
        'desc' => __( 'A light color for the text in a slide with the background of the slide is dark.', 'yit' ),
        'std' => '#fff'
    ),
    array(
        'name' => __( 'Text color for light background', 'yit' ),
        'id' => 'dark_color',
        'type' => 'colorpicker',
        'desc' => __( 'A dark color for the text in a slide with the background of the slide is light.', 'yit' ),
        'std' => '#030303'
    ),
	array(
        'type' => 'sep'
    ),
	array(
        'id' => 'responsive_mode', 
        'name' => __('Responsive mode', 'yit'),        
        'desc' => __('Select some other responsive slider or static image to replace to this slider, when you are in responsive.', 'yit'),
        'type' => 'responsivesliders'
    ),
	array(
        'id' => 'responsive_image', 
        'name' => __('Responsive Image', 'yit'),        
        'desc' => __('Upload here an image, if you have defined the "Static Image" in the option above.', 'yit'),
        'type' => 'upload'
    )
));               
 
// add the slider fields for the admin
yit_slider_typography_options( $slider_type, array(
    array(
        'id'   => 'title-font',
        'type' => 'typography',
        'name' => __( 'Title', 'yit' ),
        'desc' => __( 'Configure the title.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 48,
            'unit'   => 'px',
            'family' => 'Oswald',
            'style'  => 'regular',
            'color'  => '#ffffff' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.slider_cycle .slide-title h2, #slider-%s.slider_cycle .slide-title h2 span',
			'properties' => 'font-size, font-family, font-style, font-weight'
		)
    ),
    array(
        'id'   => 'title-font-highlight',
        'type' => 'typography',
        'name' => __( 'Title highlight', 'yit' ),
        'desc' => __( 'Configure the highlight of the title (that is the text inside the brackets).', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 48,
            'unit'   => 'px',
            'family' => 'Oswald',
            'style'  => 'regular',
            'color'  => '#ea7206' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.slider_cycle .slide-title h2 span',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    ),
    array(
        'id'   => 'paragraphs-font',
        'type' => 'typography',
        'name' => __( 'Paragraphs', 'yit' ),
        'desc' => __( 'Configure the paragraphs.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 14,
            'unit'   => 'px',
            'family' => 'Droid Sans',
            'style'  => 'regular',
            'color'  => '#ffffff' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.slider_cycle .slide-content p',
			'properties' => 'font-size, font-family, font-style, font-weight'
		)
    )
) );              


/**
 * Return the absolute position of an object
 *
 * @since 1.0
 */
function yit_slide_get_style( $style ) {
    $return = '';
    
    foreach( $style as $p => $v ) {
        $v = is_numeric( $v ) ? $v . 'px' : $v;
        if($v!='') $return .= $p . ':' . $v . ';';
    }
    
    return $return;
}