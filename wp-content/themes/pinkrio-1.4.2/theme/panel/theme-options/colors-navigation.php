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

function yit_sub_navigation_background_style( $array ) {
    $array['selectors'] = '#header .menu > ul ul, .classic > ul ul.sub-menu li, .classic .classic > ul ul.children li';    
    return $array;
}
add_filter( 'yit_sub-navigation-background_style', 'yit_sub_navigation_background_style' );