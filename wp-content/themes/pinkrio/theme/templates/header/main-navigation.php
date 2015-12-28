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
  
$args = array(
    'theme_location' => 'nav',
    'container' => 'div',
    'container_class' => 'menu ' . yit_get_option('nav_style', 'classic'),
    'menu_id' => 'nav',
    'depth' => apply_filters( 'yit_menu_depth', 3 ),
    'fallback_fb' => false
);
        
wp_nav_menu( $args ) ?>