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

$has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yit_get_option( 'blog-show-featured' ) ) || ( is_single() && ! yit_get_option( 'blog-show-featured-single' ) ) ) ? false : true; ?>
                       
<div id="post-<?php the_ID(); ?>" <?php post_class( 'hentry-post group blog-small' ); ?>>     
    <!-- post featured & title -->
    <div class="<?php if ( ! $has_thumbnail ) echo 'without ' ?>thumbnail">
        <!-- post title -->
        <?php 
        $link = get_permalink();
        
        if( get_the_title() == '' )
            { $title = __( '(this post does not have a title)', 'yit' ); }
        else
            { $title = get_the_title(); }
        
        if ( is_single() )
            { yit_string( "<h1 class=\"post-title\"><a href=\"$link\">", $title, "</a></h1>" ); } 
        else
            { yit_string( "<h2 class=\"post-title\"><a href=\"$link\">", $title, "</a></h2>" ); }
        ?>
        
        <!-- post meta -->
        <?php if ( get_post_type() == 'post' ) : ?>
        <div class="meta group">
            <?php if( yit_get_option( 'blog-show-date' ) ) : ?><p class="date"><?php echo get_the_date() ?></p><?php endif; ?>
            <?php if( yit_get_option( 'blog-show-author' ) ) : ?><p class="author"><span><?php _e( 'by', 'yit' ) ?> <?php the_author_posts_link() ?></span></p><?php endif; ?>
            <?php if( yit_get_option( 'blog-show-categories' ) ) : ?><p class="categories"><span>In: <?php the_category( ', ' ) ?></span></p><?php endif; ?>
            <?php if( yit_get_option( 'blog-show-comments' ) ) : ?><p class="comments"><span><?php comments_popup_link( __( 'No comments', 'yit' ), __( '1 comment', 'yit' ), __( '% comments', 'yit' ) ); ?></span></p><?php endif ?>
            <?php edit_post_link( __( 'Edit', 'yit' ), '<p class="edit-link">', '</p>' ); ?>
        </div>
        <?php endif ?>
        
        <!-- post featured -->
        <div class="image-wrap">
            <?php if ( $has_thumbnail ) the_post_thumbnail( 'blog_small' ); ?>
            
            <?php if( get_post_format() != '' ) : ?><span class="post-format <?php echo get_post_format() ?>"><?php _e( ucfirst( get_post_format() ), 'yit' ) ?></span><?php endif ?>
        </div>
    </div>
    
    <!-- post content -->
    <div class="the-content<?php if( is_single() ) echo ' single'; ?> group"><?php 
        
        if ( is_category() || is_archive() || is_search() )
            { the_excerpt(); }
        else
            { the_content( yit_get_option('blog-read-more-text') ); }
    ?></div>
    
    <?php wp_link_pages(); ?>

	<?php
    if( is_single() ) {
       if( yit_get_option( 'blog-show-tags' ) ) {
	       the_tags( '<p class="list-tags">Tags: ', ', ', '</p>' );
       }
       if( is_paged() ) { previous_post_link(); echo ' | '; next_post_link(); }
    }
    ?>    
</div> 