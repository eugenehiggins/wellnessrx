<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 

include 'layerslider.php';

// add the check in case you use the [button]
add_filter( 'yit_sc_button_include_content', create_function( '$to_check', '$to_check[] = serialize( get_option("layerslider-slides") ); return $to_check;' ) );

// add the layer slider in the sample data
add_filter( 'yit_sample_data_options', create_function( '$options', '$options[] = "layerslider-slides"; return $options;' ) );

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = true;
 
// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
	array(
        'type' => 'simple-text',
        'desc' => sprintf( __( 'Configure the slider in <a href="%s">LayerSlider</a> page and then select below the slider to use for this slider.', 'yit' ), admin_url( 'admin.php?page=layerslider' ) )
    ),
	array(
        'id' => 'layer_slider', 
        'name' => __('Select the slider', 'yit'),        
        'desc' => __('Select the slider you want to show when you want to show this slider.', 'yit'),
        'type' => 'select',   
        'options' => layerslider_get_sliders()
    ),
// 	array(
//         'type' => 'sep'
//     ),
// 	array(
//         'id' => 'responsive_mode',
//         'name' => __('Responsive mode', 'yit'),
//         'desc' => __('Select some other responsive slider or static image to replace to this slider, when you are in responsive.', 'yit'),
//         'type' => 'responsivesliders'
//     ),
// 	array(
//         'id' => 'responsive_image',
//         'name' => __('Responsive Image', 'yit'),
//         'desc' => __('Upload here an image, if you have defined the "Static Image" in the option above.', 'yit'),
//         'type' => 'upload'
//     )
));                           
 
// add the slider fields for the admin
yit_slider_typography_options( $slider_type, array(
    array(
        'id'   => 'p-font',
        'type' => 'typography',
        'name' => __( 'p', 'yit' ),
        'desc' => __( 'Configure the font for the "p" elements.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Droid Sans',
            'style'  => 'regular',
            'color'  => '#585555' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.layer-slider .ls-layer p',
			'properties' => 'font-size, font-family, font-style, font-weight, color'
		)
    ),
    array(
        'id'   => 'a-font',
        'type' => 'typography',
        'name' => __( 'Links', 'yit' ),
        'desc' => __( 'Configure the color for the links.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Droid Sans',
            'style'  => 'regular',
            'color'  => '#c97e08' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.layer-slider .ls-layer a',
			'properties' => 'color'
		)
    ),
    array(
        'id'   => 'a-hover-font',
        'type' => 'typography',
        'name' => __( 'Links hover', 'yit' ),
        'desc' => __( 'Configure the color for the links, when mouse over.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Droid Sans',
            'style'  => 'regular',
            'color'  => '#2E2D2D' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.layer-slider .ls-layer a:hover',
			'properties' => 'color'
		)
    ),
    array(
        'id'   => 'h1-font',
        'type' => 'typography',
        'name' => __( 'h1', 'yit' ),
        'desc' => __( 'Configure the font for the "h1" elements.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 34,
            'unit'   => 'px',
            'family' => 'Rokkitt',
            'style'  => 'regular',
            'color'  => '#2E2D2D' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.layer-slider .ls-layer h1',
			'properties' => 'font-size, font-family, font-style, font-weight, color'
		)
    ),
    array(
        'id'   => 'h2-font',
        'type' => 'typography',
        'name' => __( 'h2', 'yit' ),
        'desc' => __( 'Configure the font for the "h2" elements.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 30,
            'unit'   => 'px',
            'family' => 'Rokkitt',
            'style'  => 'regular',
            'color'  => '#2E2D2D' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.layer-slider .ls-layer h2',
			'properties' => 'font-size, font-family, font-style, font-weight, color'
		)
    ),
    array(
        'id'   => 'h3-font',
        'type' => 'typography',
        'name' => __( 'h3', 'yit' ),
        'desc' => __( 'Configure the font for the "h3" elements.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 26,
            'unit'   => 'px',
            'family' => 'Rokkitt',
            'style'  => 'regular',
            'color'  => '#c97e08' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.layer-slider .ls-layer h3',
			'properties' => 'font-size, font-family, font-style, font-weight, color'
		)
    ),
    array(
        'id'   => 'h4-font',
        'type' => 'typography',
        'name' => __( 'h4', 'yit' ),
        'desc' => __( 'Configure the font for the "h4" elements.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 22,
            'unit'   => 'px',
            'family' => 'Rokkitt',
            'style'  => 'regular',
            'color'  => '#2E2D2D' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.layer-slider .ls-layer h1',
			'properties' => 'font-size, font-family, font-style, font-weight, color'
		)
    ),
    array(
        'id'   => 'h5-font',
        'type' => 'typography',
        'name' => __( 'h5', 'yit' ),
        'desc' => __( 'Configure the font for the "h5" elements.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 18,
            'unit'   => 'px',
            'family' => 'Rokkitt',
            'style'  => 'regular',
            'color'  => '#2E2D2D' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.layer-slider .ls-layer h5',
			'properties' => 'font-size, font-family, font-style, font-weight, color'
		)
    ),
    array(
        'id'   => 'h6-font',
        'type' => 'typography',
        'name' => __( 'h6', 'yit' ),
        'desc' => __( 'Configure the font for the "h6" elements.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 14,
            'unit'   => 'px',
            'family' => 'Rokkitt',
            'style'  => 'regular',
            'color'  => '#2E2D2D' 
        ),
        'style' => array(
			'selectors' => '#slider-%s.layer-slider .ls-layer h6',
			'properties' => 'font-size, font-family, font-style, font-weight, color'
		)
    ),
) );             

// add the script js to hide the second tab, if is selected the Layer slider in the select
function yit_hide_second_tab_layersslider() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            if ( $('#<?php echo yit_get_model('cpt_unlimited')->metabox_name ?>_slider_type').val() == 'layer-slider' )
                $('a[href="#item-edit"]').parent().remove();
        });
    </script>
    <?php
}
add_action( 'admin_print_footer_scripts', 'yit_hide_second_tab_layersslider' );    

function layerslider_get_sliders() {

	// Get WPDB Object
	global $wpdb;

	// Table name
	$table_name = $wpdb->prefix . "layerslider";

	if ( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == null ) {
        return;
    }

    $slides = $wpdb->get_results("SELECT * FROM $table_name
								  WHERE flag_hidden = '0'
								  AND flag_deleted = '0'
								  ORDER BY date_c DESC" );

    if ( ! is_array( $slides ) || empty( $slides ) )
        return array();

    foreach ( $slides as $slide )
        $sliders[ $slide->id ] = empty( $slide->name ) ? 'Unamed' : $slide->name;
    return $sliders;
}
// function yiw_import_slider_layers_options( $options ) {
//     $options[] = 'layerslider_slides';
//     return $options;
// }
// add_filter( 'yiw_sample_data_options', 'yiw_import_slider_layers_options' );


function yiw_add_layerslider_tables( $tables ) {
    $tables[] = 'layerslider';
    return $tables;
}
add_filter( 'yit_sample_data_tables', 'yiw_add_layerslider_tables' );