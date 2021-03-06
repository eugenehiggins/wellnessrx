<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
                              
yit_register_portfolio_style(  $portfolio_type, 'portfolio-' . $portfolio_type, 'css/style.css' );

// add the image size
// add_image_size( 'thumb_portfolio_bigimage', 770, 368, true );
 
// add the slider fields for the admin
yit_add_portfolio_config( $portfolio_type, array(
    array(
        'name' => __( 'Items', 'yit' ),
        'id' => 'nitems',
        'type' => 'number',
        'min' => 0,
        'max' => 200,
        'desc' => __( 'Select the number of items to show (Only if the filters are disabled). Leave 0 to show all.', 'yit' ),
        'std' => 0
    ),
    
	array(
		'type' => 'sep'
	),
    
	array(
        'name' => __( 'Enable lightbox icon', 'yit' ),
        'id' => 'event_lightbox',
        'type' => 'onoff',
        'desc' => __( 'Enable lightbox icon on projects image.', 'yit' ),
	),
	
	array(
        'name' => __( 'Enable project details icon', 'yit' ),
        'id' => 'event_details',
        'type' => 'onoff',
        'desc' => __( 'Enable project details icon on projects image.', 'yit' ),
	),
	
	array(
        'name' => __( 'Project title on hover', 'yit' ),
        'id' => 'event_title',
        'type' => 'onoff',
        'desc' => __( 'Show the project name on image hover.', 'yit' ),
	),
	
	array(
		'type' => 'sep'
	),
	array(
		'type' => 'simple-text',
		'id'   => 'simple_text',
		'desc' => '<h4>' . __('Page detail settings', 'yit') . '</h4>'
	),
    array(
        'name' => __( 'Display Other Projects', 'yit' ),
        'id' => 'display_related',
        'type' => 'onoff',
        'desc' => __( 'Select if you want to show other projects below the item.', 'yit' )
    ),
    array(
        'name' => __( 'Items', 'yit' ),
        'id' => 'detail_nitems',
        'type' => 'number',
        'min' => 0,
        'max' => 200,
        'desc' => __( 'Select the number of items to show below the item. Leave 0 to show all.', 'yit' ),
        'std' => 0
    ),
    array(
        'name' => __( 'Other Projects label', 'yit' ),
        'id' => 'other_projects_label',
        'type' => 'text',
        'std' =>  __( 'Other Projects', 'yit' ),
        'desc' => __( 'Customize the Other Projects label', 'yit' )
    )
) );


add_action( 'yit_portfolio_type_args_portfolios', 'yit_work_change_args'  ); 
add_action( 'yit_portfolios_item_configuration', 'yit_work_change_configuration' );

function yit_work_change_args( $args ) {
	$args['settings_item'] = 'title, content-editor';
	
	return $args;
}

function yit_work_change_configuration( $args ) {
    unset($args[7]);
	unset($args[8]);
    
    return $args;
}

