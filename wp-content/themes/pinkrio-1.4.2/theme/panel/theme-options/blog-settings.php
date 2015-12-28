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

function yit_blog_type_options( $array ) {
    $array['big']     = __( 'Big Thumbnail', 'yit' );
    $array['small']   = __( 'Small Thumbnail', 'yit' );
    
    return $array;
}
add_filter( 'yit_blog-type_options', 'yit_blog_type_options' );
 
function yit_tab_blog_settings( $items ) {
    unset( $items[62], $items[64], $items[66], $items[68] );
    
    return $items;
}
add_filter( 'yit_submenu_tabs_theme_option_blog_settings', 'yit_tab_blog_settings' );