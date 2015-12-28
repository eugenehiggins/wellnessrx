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

/* === HEADER */
add_action( 'yit_head', 'yit_head', 10 );
add_action( 'wp_enqueue_scripts', 'yit_add_custom_styles' );
add_action( 'yit_header', 'yit_header', 10 );
add_action( 'yit_logo', 'yit_logo', 10 );
add_action( 'yit_main_navigation', 'yit_main_navigation', 10 );
add_action( 'yit_after_header', 'yit_slider_section', 10 );
//add_action( 'yit_after_header', 'yit_map', 20 );
add_action( 'yit_after_header', 'yit_page_meta', 30 );

/* === PAGE */
add_action( 'yit_page_content', 'yit_page_content', 10 );
add_action( 'yit_loop_page', 'yit_loop_page', 10 );
add_action( 'yit_404', 'yit_404', 10 );

/* === BLOG */
add_action( 'yit_comments', 'yit_comments', 10 );
add_action( 'yit_comments_password_required', 'yit_comments_password_required', 10 );
add_action( 'yit_comments_navigation', 'yit_comments_navigation', 10 );
add_action( 'yit_trackbacks', 'yit_trackbacks', 10 );

/* === LOOP */
add_action( 'yit_loop', 'yit_loop', 10 );
add_action( 'yit_loop_internal', 'yit_loop_internal', 10 );
add_action( 'yit_loop_blog_big', 'yit_loop_blog_big', 10 );
add_action( 'yit_loop_blog_small', 'yit_loop_blog_small', 10 );
add_action( 'yit_archives', 'yit_archives', 10 );

/* === MISC */
add_action( 'yit_searchform', 'yit_searchform', 10 );
add_action( 'yit_extra_content', 'yit_extra_content', 10 );

/* === FOOTER */
add_action( 'yit_footer', 'yit_footer', 10 );
add_action( 'yit_footer_big', 'yit_footer_big', 10 );
add_action( 'yit_copyright', 'yit_copyright', 10 );

/* === SIDEBAR */
add_action( 'yit_default_sidebar', 'yit_default_sidebar', 10 );


/* ===== THEME OPTIONS FILTER ===== */
add_filter( 'yit_admin_tree', 'yit_remove_buy_tab' );

add_filter( 'yit_admin_menu_theme_options', 'yit_remove_tab_sc' );
add_filter( 'yit_admin_submenu_theme_options', 'yit_remove_tab_sc' );

/* == BACK TO TOP == */
add_action( 'yit_after_header', 'yit_back_to_top', 0 );