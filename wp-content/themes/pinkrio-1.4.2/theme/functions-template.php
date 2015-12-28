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
if( !function_exists( 'yit_head' ) ) {
    function yit_head() {
        yit_get_template( '/header/head.php' );
    }
}

if( !function_exists( 'yit_add_custom_styles' ) ) {
    function yit_add_custom_styles() {        
        if( yit_get_option( 'responsive-enabled' ) ) {
            yit_enqueue_style( 9994, 'responsive', YIT_CORE_ASSETS_URL . '/css/responsive.css', array(), '1.0.0', 'all' ); 
            
            yit_enqueue_style( 9995, 'max-width-1024', get_template_directory_uri() . '/css/max-width-1024.css', array(), '1.0.0', 'screen and (max-width: 1240px)', true );
            yit_enqueue_style( 9996, 'max-width-768', get_template_directory_uri() . '/css/max-width-768.css', array( 'max-width-1024' ), '1.0.0', 'screen and (max-width: 987px)', true );
            yit_enqueue_style( 9996, 'max-width-480', get_template_directory_uri() . '/css/max-width-480.css', array( 'max-width-768' ), '1.0.0', 'screen and (max-width: 480px)', true );
            yit_enqueue_style( 9996, 'max-width-320', get_template_directory_uri() . '/css/max-width-320.css', array( 'max-width-480' ), '1.0.0', 'screen and (max-width: 320px)', true );
        }
        
        global $wpdb;
        $cache_file = '/custom.css';
        if ( $wpdb->blogid != 0 ) $cache_file = str_replace( '.css', '-' . $wpdb->blogid . '.css', $cache_file );
        
        if( file_exists( YIT_CACHE_DIR . $cache_file ) )
            { yit_enqueue_style( 9999, 'cache-custom', YIT_CACHE_URL . $cache_file, array(), false, 'all', true ); }

        $custom_css = locate_template( 'custom.css' );
        $custom_css = str_replace( array( get_stylesheet_directory(), get_template_directory() ), array( get_stylesheet_directory_uri(), get_template_directory_uri() ), $custom_css );

        yit_enqueue_style( 99999, 'custom', $custom_css, array(), false, 'all', true );
    }
}

if( !function_exists( 'yit_header' ) ) {
    function yit_header() {
        yit_get_template( '/header/header.php' );
    }
}

if( !function_exists( 'yit_logo' ) ) {
    function yit_logo() {
        yit_get_template( '/header/logo.php' );
    }
}

if( !function_exists( 'yit_main_navigation' ) ) {
    function yit_main_navigation() {
        yit_get_template( '/header/main-navigation.php' );
    }
}

//if( !function_exists( 'yit_map' ) ) {
//    function yit_map() {
//        yit_get_template( '/header/map.php' );
//    }
//}

if( !function_exists( 'yit_page_meta' ) ) {
    function yit_page_meta() {
        yit_get_template( '/header/page-meta.php' );
    }
}

if( !function_exists( 'yit_slider_section' ) ) {
    function yit_slider_section() {
        yit_get_template( '/header/slider.php' );
    }
}

/* === PAGE */
if( !function_exists( 'yit_loop_page' ) ) {
    function yit_loop_page() {
        yit_get_template( '/loop/page/content.php' );
    }
}

if( !function_exists( 'yit_404' ) ) {
    function yit_404() {
        yit_get_template( '404/404.php' );
    }
}

/* === BLOG */


/* === LOOP */
if( !function_exists( 'yit_loop' ) ) {
    function yit_loop() {
        yit_get_template( '/loop/loop.php' );
    }
}

if( !function_exists( 'yit_loop_internal' ) ) {
    function yit_loop_internal() {
        yit_get_template( '/loop/loop_internal.php' );
    }
}

if( !function_exists( 'yit_loop_blog_big' ) ) {
    function yit_loop_blog_big() {
        yit_get_template( '/blog/big/markup.php' );
    }
}

if( !function_exists( 'yit_loop_blog_small' ) ) {
    function yit_loop_blog_small() {
        yit_get_template( '/blog/small/markup.php' );
    }
}

if( !function_exists( 'yit_archives' ) ) {
    function yit_archives() {
        yit_get_template( '/loop/archives.php' );
    }
}

/* === COMMENTS */
if( !function_exists( 'yit_comments' ) ) {
    function yit_comments() {
        yit_get_template( '/comments/markup.php' );
    }
}

if( !function_exists( 'yit_comments_password_required' ) ) {
    function yit_comments_password_required() {
        yit_get_template( '/comments/password-required.php' );
    }
}

if( !function_exists( 'yit_comments_navigation' ) ) {
    function yit_comments_navigation() {
        yit_get_template( '/comments/navigation.php' );
    }
}

if( !function_exists( 'yit_trackbacks' ) ) {
    function yit_trackbacks() {
        yit_get_template( '/comments/trackbacks.php' );
    }
}

/* === MISC */
if( !function_exists( 'yit_searchform' ) ) {
    function yit_searchform( $post_type ) {
        yit_get_template( '/searchform/' . $post_type . '.php' );
    }
}

if( !function_exists( 'yit_extra_content' ) ) {
    function yit_extra_content() {
        yit_get_template( '/loop/extra-content.php' );
    }
}

/* === FOOTER */
if( !function_exists( 'yit_footer' ) ) {
    function yit_footer() {
        yit_get_template( '/footer/footer.php' );
    }
}

if( !function_exists( 'yit_footer_big' ) ) {
    function yit_footer_big() {
        yit_get_template( '/footer/footer-big.php' );
    }
}

if( !function_exists( 'yit_copyright' ) ) {
    function yit_copyright() {
        yit_get_template( '/footer/copyright.php' );
    }
}

/* === SIDEBAR */
if( !function_exists( 'yit_default_sidebar' ) ) {
    function yit_default_sidebar() {
        yit_get_template( '/sidebars/default.php' );
    }
}

/* === TESTIMONIALS */
if( !function_exists( 'yit_single_testimonial' ) ) {
    function yit_single_testimonial() {
        yit_get_template( '/testimonial/testimonial.php' );
    }
}

/* === SERVICES */
if( !function_exists( 'yit_single_service' ) ) {
    function yit_single_service() {
        yit_get_template( '/services/service.php' );
    }
}