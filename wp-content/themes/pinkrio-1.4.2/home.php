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

/*
Template Name: Home
*/


if( is_posts_page() || is_home() )
    { get_template_part( 'blog' ); die; }

get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="inner group">
        <?php do_action( 'yit_before_content' ) ?>
        <!-- START CONTENT -->
        <div id="content-home" class="content group">
        <?php
        $show_title      = yit_get_post_meta( get_the_ID(), '_show-title' );
        $show_breadcrumb = yit_get_post_meta( get_the_ID(), '_show-breadcrumb' );
        $tag_title       = apply_filters( 'yit_page_title_tag', 'h2' );
        
        do_action( 'yit_before_breadcrumb' );
        if( $show_breadcrumb )
            { yit_breadcrumb( apply_filters( 'yit_breadcrumb_delimiter', '&raquo;' ) ); }
        
        do_action( 'yit_before_page_title' );
        if( $show_title )
            { yit_string( '<' . $tag_title . '>', get_the_title(), '</' . $tag_title . '>' ); }
        
        do_action( 'yit_loop_page' );
        
        comments_template();
        ?>
        </div>
        <!-- END CONTENT -->
        <?php do_action( 'yit_after_content' ) ?>
        
        <?php get_sidebar() ?>
        
        <?php do_action( 'yit_after_sidebar' ) ?>
        
        <!-- START EXTRA CONTENT -->
        <?php do_action( 'yit_extra_content' ) ?>
        <!-- END EXTRA CONTENT -->

    </div>
</div>
<!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>