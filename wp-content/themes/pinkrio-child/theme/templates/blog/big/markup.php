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
                       
<div id="post-<?php the_ID(); ?>" <?php post_class( 'hentry-post group blog-big' ); ?>>     
    <!-- post featured & title -->
    <div class="<?php if ( ! $has_thumbnail ) echo 'without ' ?>thumbnail">
        <!-- post featured -->
        <div class="image-wrap">
            <?php
            if( $has_thumbnail ) {
                if( ( !is_single() || ( get_post_format() != 'video' && get_post_format() != 'gallery' ) ) ) {
                    echo '<a href="' . get_permalink() . '">';
                    the_post_thumbnail( 'blog_big' );
                    echo '</a>';
                }
            }
            
            if( is_single() ) {
                switch( get_post_format() ) {
                    case 'video':
                        $id = yit_get_post_meta( get_the_ID(), '_format_video' );
                        $type = yit_get_post_meta( get_the_ID(), '_format_video_host' );
                        
                        echo do_shortcode( '[' . $type . ' video_id="' . $id . '"]' );
                        break;  
                    case 'gallery':
                        $attachments = get_posts( array(
                        	'post_type' 	=> 'attachment',
                        	'numberposts' 	=> -1,
                        	'post_status' 	=> null,
                        	'post_parent' 	=> get_the_ID(),
                        	'post_mime_type'=> 'image',
                        	'orderby'		=> 'menu_order',
                        	'order'			=> 'ASC'
                        ) );
                        
                        if( $attachments ) {
                            $height = 0;
                            $html = '';
                                                                            
                            foreach ( $attachments as $key => $attachment ) { 
                                $image = wp_get_attachment_image_src( $attachment->ID, 'blog_big' );
                                $html .= $image[0] . PHP_EOL;
                            }
                            
                            $html = '[images_slider effect="fade" width="0" height="auto" direction="horizontal" speed="5000"]' . PHP_EOL . $html . '[/images_slider]';
                            
                            echo do_shortcode( $html );
                        }
                        break;
                }
            }
            
            if( get_post_format() != '' ) : ?><span class="post-format <?php echo get_post_format() ?>"><?php _e( ucfirst( get_post_format() ), 'yit' ) ?></span><?php endif ?>            
        </div>
        
        <?php if( yit_get_option( 'blog-show-date' ) ) : ?>
            <p class="date">
                <span class="month"><?php echo get_the_time('M') ?></span>
                <span class="day"><?php echo get_the_time('d') ?></span>
            </p>
        <?php endif; ?>
    </div>

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
        <?php if( yit_get_option( 'blog-show-author' ) ) : ?><p class="author"><span><?php _e( 'by', 'yit' ) ?> <?php the_author_posts_link() ?></span></p><?php endif; ?>
        <?php if( yit_get_option( 'blog-show-categories' ) ) : ?><p class="categories"><span>In: <?php the_category( ', ' ) ?></span></p><?php endif; ?>
        <?php if( yit_get_option( 'blog-show-comments' ) ) : ?><p class="comments"><span><?php comments_popup_link( __( 'No comments', 'yit' ), __( '1 comment', 'yit' ), __( '% comments', 'yit' ) ); ?></span></p><?php endif ?>
    </div>
    <?php endif ?>
    
    <?php if( is_single() ) : ?>
        <?php if( get_post_format( get_the_ID() ) == 'audio' ) : ?>
        <div class="soundcloud-frame">
            <?php
            $url = yit_get_post_meta( get_the_ID(), '_format_audio' );
            $iframe = ( bool ) yit_get_post_meta( get_the_ID(), '_format_audio_iframe' );
            $show_artwork = ( bool ) yit_get_post_meta( get_the_ID(), '_format_audio_artwork' );
            $show_comments = ( bool ) yit_get_post_meta( get_the_ID(), '_format_audio_comments' );
            $auto_play = ( bool ) yit_get_post_meta( get_the_ID(), '_format_audio_autoplay' );
            $color = yit_get_post_meta( get_the_ID(), '_format_audio_color' );
            
            echo do_shortcode( '[soundcloud iframe="' . $iframe . '" url="' . $url . '" show_artwork="' . $show_artwork . '" show_comments="' . $show_comments . '" auto_play="' . $auto_play . '" color="' . $color . '"]' );
            ?>
        </div>
        
        <div class="clear"></div>
        <?php endif ?>
    <?php endif ?>
    
    <!-- post content -->
    <div class="the-content<?php if( is_single() ) echo ' single'; ?> group"><?php
        if ( is_category() || is_archive() || is_search() ) {
            if( is_category() ) {
                if( yit_get_option( 'posts-categories' ) == 'excerpt' ) : the_excerpt(); else : the_content( yit_get_option( 'readmore-categories' ) ); endif;
            } elseif( is_archive() ) {
                if( yit_get_option( 'posts-archives' ) == 'excerpt' ) : the_excerpt(); else : the_content( yit_get_option( 'readmore-archives' ) ); endif;
            } elseif( is_search() ) {
                if( yit_get_option( 'posts-searches' ) == 'excerpt' ) : the_excerpt(); else : the_content( yit_get_option( 'readmore-searches' ) ); endif;
            }
        }
        else
            { the_content( yit_get_option('blog-read-more-text') ); }
        
        if( is_single() )
            { do_action( 'yit_after_post_content' ); }
    ?></div>
    
    <?php wp_link_pages(); ?>
    
    <?php edit_post_link( __( 'Edit', 'yit' ), '<p class="edit-link">', '</p>' ); ?>
    <?php if( is_single() && yit_get_option( 'blog-show-tags' ) ) { the_tags( '<p class="tags">' . __( 'Tags: ', 'yit' ), ', ', '</p>' ); } ?>
    
    <div class="clear"></div>
    
	<?php
    if( is_paged() && is_single() ) { previous_post_link(); echo ' | '; next_post_link(); }
    ?>    
</div> 
