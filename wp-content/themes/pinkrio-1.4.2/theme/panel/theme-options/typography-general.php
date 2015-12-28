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
function yit_tab_typography_general( $fields ) {
    $fields[100] = array(
        'id'   => 'back-top-font',
        'type' => 'typography',
        'name' => __( 'Back to Top font', 'yit' ),
        'desc' => __( 'Select the font for "Back to top" button. ', 'yit' ),
        'min'  => 1,
        'max'  => 18,
        'std'  => apply_filters( 'yit_back-top-font_std', array(
            'size'   => 14,
            'unit'   => 'px',
            'family' => 'Rokkit',
            'style'  => 'regular',
            'color'  => '#585555'
        ) ),
        'style' => apply_filters( 'yit_back-top-font_style', array(
            'selectors' => '#back-top a, #back-top a:hover',
            'properties' => 'font-size, font-family, color, font-style, font-weight'
        ) )
    );

    return $fields;
}
add_filter( 'yit_submenu_tabs_theme_option_typography_general', 'yit_tab_typography_general' );

function yit_general_font_style( $array ) {
    $array['selectors'] = 'p, li, address, dd, blockquote, td, th, .paragraph-links a, a.text-color, a';    
    return $array;
}
add_filter( 'yit_general-font_style', 'yit_general_font_style' );