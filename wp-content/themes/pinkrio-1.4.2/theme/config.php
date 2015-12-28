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

//define area
define( 'YIT_THEME_NAME', 'pinkrio' );
define( 'YIT_THEME_NOTIFIER_URL', 'http://update.yithemes.com/' . YIT_THEME_NAME . '.xml');
define( 'YIT_DOCUMENTATION_URL', 'http://yithemes.com/docs/' . YIT_THEME_NAME . '/');
define( 'YIT_SUPPORT_URL', 'http://support.yithemes.com/' );
define( 'YIT_FREE_THEMES_URL', 'http://yithemes.com/' );
define( 'YIT_MARKETPLACE', 'yit' ); // ( tf | yit | free )

define( 'YIT_SHOW_PANEL_HEADER', 1 );
define( 'YIT_SHOW_PANEL_HEADER_LINKS', 1 );

if( !defined( 'YIT_DEBUG' ) ) { define( 'YIT_DEBUG', false ); }
if( !defined( 'YIT_SHOW_UPDATES' ) ) { define( 'YIT_SHOW_UPDATES', true ); }

function yit_theme_fonts() {
    
}
add_action( 'yit_loaded', 'yit_theme_fonts' );