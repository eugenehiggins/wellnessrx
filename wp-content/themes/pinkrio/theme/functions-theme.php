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
 * Theme setup file
 */

/**
 * Set up all theme data.
 * 
 * @return void
 * @since 1.0.0
 */
function yit_setup_theme() {    
    //Content width. WP require it. So give to WordPress what is of WordPress
    if( !isset( $content_width ) ) { $content_width = yit_get_option( 'container-width' ); }
    
    //This theme have a CSS file for the editor TinyMCE
    add_editor_style( 'css/editor-style.css' );
    
    //This theme support post thumbnails
    add_theme_support( 'post-thumbnails' );
    
    //This theme uses the menues
    add_theme_support( 'menus' );
    
    //Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // The height and width of your custom header. You can hook into the theme's own filters to change these values.
    // Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
    define( 'HEADER_IMAGE_WIDTH', apply_filters( 'yiw_header_image_width', 1170 ) );
    define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'yiw_header_image_height', 410 ) );     
    
    // Don't support text inside the header image.
    if ( ! defined( 'NO_HEADER_TEXT' ) )
        define( 'NO_HEADER_TEXT', true );
    
    //This theme support custom header
    add_theme_support( 'custom-header' );
    
    //This theme support custom backgrounds
    add_theme_support( 'custom-backgrounds' );
    
    //This theme support post formats
    add_theme_support( 'post-formats', apply_filters( 'yit_post_formats_support', array( 'gallery', 'audio', 'video' ) ) );
    
    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be 940 pixels wide by 198 pixels tall.
    // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
    //set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );    
    $image_sizes = array(
        'blog_big'     => array( 816, 282, true ),
        'blog_small'   => array( 205, 185, true ),
        'blog_thumb'   => array( 55, 55, true ),
        'section_blog' => array( 581, 155, true ),
        'section_blog_sidebar' => array( 386, 155, true ),
        'thumb-testimonial' => array( 94, 94, true ),
        'thumb_portfolio_fulldesc_related' => array( 175, 175, true ),
        'thumb_portfolio_bigimage' => array( 770, 368, true ),
        'thumb_portfolio_filterable' => array( 260, 168, true ),
        'thumb_portfolio_fulldesc' => array( 700, 345, true ),
        'section_portfolio' => array( 573, 285, true ),
        'section_portfolio_sidebar' => array( 385, 192, true ),
        'thumb_portfolio_fulldesc_related' => array( 175, 175, true ),
        'thumb_portfolio_3cols' => array( 365, 192, true ),
        'accordion_thumb' => array( 158, 176, true ),
        'featured_project_thumb' => array( 320, 154, true ),
    );
    
    apply_filters( 'yit_add_image_size', $image_sizes );
    
    foreach ( $image_sizes as $id_size => $size )               
        add_image_size( $id_size, apply_filters( 'yit_' . $id_size . '_width', $size[0] ), apply_filters( 'yit_' . $id_size . '_height', $size[1] ), $size[2] );
    
    //Set localization and load language file
    $locale = get_locale();
    $locale_file = YIT_THEME_PATH . "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );
    
    //Register menus
    register_nav_menus(
        array(
            'nav' => __( 'Main navigation', 'yit' )
        )
    );
    
    //Register sidebars
    register_sidebar( yit_sidebar_args( 'Default Sidebar' ) );
    register_sidebar( yit_sidebar_args( 'Header Sidebar' ) );
    register_sidebar( yit_sidebar_args( 'Blog Sidebar' ) );
    register_sidebar( yit_sidebar_args( '404 Sidebar' ) );
    
    //User definded sidebars
    do_action( 'yit_register_sidebars' );
    
    //Register custom sidebars
    $sidebars = maybe_unserialize( yit_get_option( 'custom-sidebars' ) );
    if( is_array( $sidebars ) && ! empty( $sidebars ) ) {
        foreach( $sidebars as $sidebar ) {
            register_sidebar( yit_sidebar_args( $sidebar, '', 'widget', apply_filters( 'yit_custom_sidebar_title_wrap', 'h3' ) ) );
        }
    }
    
    //Footer sidebars
    for( $i = 1; $i <= yit_get_option( 'footer-rows', 0 ); $i++ ) {
        register_sidebar( yit_sidebar_args( "Footer Row $i", sprintf(  __( "The widget area #%d used in Footer section", 'yit' ), $i ), 'widget', apply_filters( 'yit_footer_sidebar_' . $i . '_wrap', 'h3' ) ) );
    }   
}

wp_oembed_add_provider( '#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true );

if( !function_exists( 'yit_comment' ) ) {
    /**
     * Print comments
     * 
     * @param object $comment
     * @param array $args
     * @param int $depth
     * @return string
     * @since 1.0.0
     */
    function yit_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        
        if( isset($GLOBALS['count']) ) $GLOBALS['count']++;
        else $GLOBALS['count'] = 1; 
        
        switch ( $comment->comment_type ) :
            case 'pingback'  :
            case 'trackback' :
        ?>
        <li class="post pingback">
            <p><?php _e( 'Pingback:', 'yit' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'yit'), ' ' ); ?></p>
        <?php
                break;
            
            default:
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-container">
                <div class="comment-author vcard">
                    <?php echo get_avatar( $comment, 75 ); ?>
                    <?php printf( __( '%s ', 'yit' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                </div><!-- .comment-author .vcard -->
                
                <div class="comment-meta commentmetadata">
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em class="moderation"><?php _e( 'Your comment is awaiting moderation.', 'yit' ); ?></em>
                        <br />
                    <?php endif; ?>
                    
                    <div class="intro">
                        <div class="commentDate">
                          <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <?php
                                /* translators: 1: date, 2: time */
                                printf( __( '%1$s at %2$s', 'yit' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'yit' ), ' ' );
                            ?>
                        </div>
    
                        <div class="commentNumber">#&nbsp;<?php echo $GLOBALS['count'] ?></div>
                    </div>
                        
                    <div class="comment-body"><?php comment_text(); ?></div>
                    
                    
                    <div class="reply group">
                        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div><!-- .reply -->
                </div><!-- .comment-meta .commentmetadata -->
            </div><!-- #comment-##  -->
    
        <?php
                break;
        endswitch;
    }
}

/**
 * Remove Buy tab in the panel
 * 
 * @param array $tree
 * @return array
 * @since 1.0.0
 */
function yit_remove_buy_tab( $tree ) {
    if( isset( $tree['buy'] ) )
        { unset( $tree['buy'] ); }
    
    return $tree;
}

/**
 * Remove Shortcode tab in the Theme Options
 * 
 * @param array $tree
 * @return array
 * @since 1.0.0
 */
function yit_remove_tab_sc( $tree ) {
    if( isset( $tree['shortcodes'] ) )
        { unset( $tree['shortcodes'] ); }
    
    return $tree;
}

/**
 * Add a back to top button
 *
 */
function yit_back_to_top() {
    if ( yit_get_option('back-top') ) {
        echo '<div id="back-top"><a href="#top">' . __('Back to top', 'yit') . '</a></div>';
    }
}