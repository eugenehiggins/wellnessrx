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

function yit_sub_navigation_text_font_style( $array ) {
    $array['selectors'] = '#header div.menu > ul ul li a, .classic #nav ul.sub-menu li a, #nav ul.children a';    
    return $array;
}
add_filter( 'yit_sub-navigation-text-font_style', 'yit_sub_navigation_text_font_style' );

function yit_sub_navigation_text_font_hover_style( $array ) {
    $array['selectors'] = '#header div.menu > ul ul li a:hover, .classic #nav ul.sub-menu li a:hover, #nav ul.children a:hover';    
    return $array;
}
add_filter( 'yit_sub-navigation-text-font-hover_style', 'yit_sub_navigation_text_font_hover_style' );

function yit_sub_navigation_text_font_active_style( $array ) {
    $array['selectors'] = '#header div.menu > ul ul li.current-menu-item > a, #header div.menu > ul ul .current-menu-ancestor > a, .classic #nav ul.sub-menu li.current-menu-item a';    
    return $array;
}
add_filter( 'yit_sub-navigation-text-font-active_style', 'yit_sub_navigation_text_font_active_style' );