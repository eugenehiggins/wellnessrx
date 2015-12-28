<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

 
/**
 * Add more shortcodes to the framework
 * 
 */
function yit_add_shortcodes( $shortcodes ) {
	/** Removing Slider Align **/
	unset($shortcodes['slider']['attributes']['align']);
	
    return array_merge( $shortcodes, array(
		/* === TESTIMONIALS === */
		'testimonials' => array(
			'title' => 'Testimonials',
			'description' => 'Show all post on testimonials post types',
			'tab' => 'cpt',
            'has_content' => false,
			'attributes' => array(
				'items' => array(
					'title' => __('N. of items', 'yit'),
					'description' => __('Show all with -1', 'yit'),
            		'type' => 'number', 
					'std'  => '-1'
				)
			)
		),
		/* === TESTIMONIALS SLIDER === */
        'testimonials_slider' => array(
        	'title' => __('Testimonials slider', 'yit' ),
        	'description' =>  __('Show a slider with testimonials', 'yit' ),
        	'tab' => 'shortcodes',
            'has_content' => false,
        	'attributes' => array(
        		'items' => array(
        			'title' => __('N. of items', 'yit'),
            		'type' => 'number', 
        			'std'  => ''
        		),
        		'excerpt' => array(
        			'title' => __('Limit words', 'yit'),
            		'type' => 'number', 
        			'std'  => '32'
        		),
        		'speed' => array(
        			'title' => __('Speed (ms)', 'yit'),
            		'type' => 'number', 
        			'std'  => '500'
        		),
        		'timeout' => array(
        			'title' => __('Time out (ms)', 'yit'),
            		'type' => 'number', 
        			'std'  => '5000'
        		)
        	)
        ),
        /* === HIDE FOR THIS THEME === */        
         
	));
}
add_filter( 'yit_add_shortcodes', 'yit_add_shortcodes' );

add_action('wp_enqueue_scripts', 'add_shortcodes_theme_css');

if( !function_exists( 'add_shortcodes_theme_css' ) ) {
	/*
	 * Add style of widgets in theme
	 */
	function add_shortcodes_theme_css(){
		$url = YIT_THEME_ASSETS_URL . '/css/shortcodes.css';
	    //wp_register_style('shortcodes_theme_css', $url);
	    yit_enqueue_style(1201, 'shortcodes_theme_css', $url);	
	}
}