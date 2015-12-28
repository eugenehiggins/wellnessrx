<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yourinspirationthemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$args = array(
    'post_type' => 'post',
    'posts_per_page' => $items,
);

if( isset( $category ) && !empty( $category ) ) {
	$args['category_name'] = $category;
}

$size_thumbnail = yit_get_sidebar_layout() != 'sidebar-no' ? 'section_blog_sidebar' : 'section_blog';
$blog = new WP_Query( $args );
$post_number = 0;
if( $blog->have_posts() ) :
    global $wp_query, $post, $more;
    ?>
    <div class="section blog">
    <?php
    if( !empty( $title ) ) { yit_string( '<h3 class="title">', $title, '</h3>' ); }
    if( !empty( $description ) ) { yit_string( '<p class="description">', $description, '</p>' ); }
    
    $i = $sticked = $already_tsicked = 0;
    while( $blog->have_posts() ) : $blog->the_post();
        $more = 0;
        
        if( $i == 0 && is_sticky() && ( $show_featured == 'yes' || $show_featured == '1' ) ) :
            $sticked = 1;
    ?>
        <div <?php post_class( 'hentry-post sticky' ) ?>>
            <div class="thumbnail">
                <div class="image-wrap">
                    <?php 
                    echo ( has_post_thumbnail() )  ? get_the_post_thumbnail( get_the_ID(), $size_thumbnail ) : '<img src="' . YIT_CORE_ASSETS_URL . '/images/no-featured.jpg" title="' . __( '(this post does not have a featured image)', 'yit' ) . '" alt="" ?>' ?>
                </div>
                
                <?php if( ( $show_title == '1' || $show_title == 'yes' ) || ( $show_date == '1' || $show_date == 'yes' ) || ( $show_comments == '1' || $show_comments == 'yes' ) ) : ?>
                <div class="meta group">
                    <?php if( $show_title == '1' || $show_title == 'yes' ) { the_title( '<h4><a href="' . get_permalink() . '" title="' . get_the_title() . '">', '</a></h4>' ); } ?>
                    <?php if( $show_date == '1' || $show_date == 'yes' ) : ?><p class="date"><img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/clock.png" title="<?php _e( 'Date', 'yit' ) ?>" alt="<?php _e( 'Date', 'yit' ) ?>" /><?php echo get_the_date( get_option( 'date_format', 'F j, Y' ) ) ?></p><?php endif ?>
                    <?php if( $show_comments == '1' || $show_comments == 'yes' ) : ?><p class="comments"><img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/comments-small.png" title="<?php _e( 'Comments', 'yit' ) ?>" alt="<?php _e( 'Comments', 'yit' ) ?>" /><span><?php comments_popup_link( __( 'No comments', 'yit' ), __( '1 comment', 'yit' ), __( '% comments', 'yit' ) ); ?></span></p><?php endif ?>
                </div>
                <?php endif ?>
            </div>
            
            <div class="the-content">
                <?php
                if( $show_excerpt == '1' || $show_excerpt == 'yes' ) {
                    if( $show_readmore == '1' || $show_readmore  == 'yes' )
                        { the_content( $readmore_text ); }
                    else
                        { echo yit_content( 'content', $excerpt_length ); }
                }
                ?>
            </div>
        
        </div>
        <div class="clear"></div>
        <?php
            $i++;
            continue;
        endif;
        
		
        if( $i == 1 && $sticked ) {
            yit_string( '<h4 class="other-articles">', $other_posts_label , '</h4>' );
        }
		
        if( $i != 0 || !$sticked ) :
            if( $i == 0 )
                { echo '<div id="section-blog-not-sticky">'; }                    
        ?>
        
		<?php 
			$post_classes = (( $post_number % 3) ? 'hentry-post' : 'hentry-post first');
		?>
        <div <?php post_class( $post_classes )?>>
            <div class="meta group">
                <?php if( $show_title == '1' || $show_title == 'yes' ) { the_title( '<h4><a href="' . get_permalink() . '" title="' . get_the_title() . '">', '</a></h4>' ); } ?>
                <?php if( $show_date == '1' || $show_date == 'yes' ) : ?><p class="date"><?php echo get_the_date( get_option( 'date_format', 'F j, Y' ) ) ?></p><?php endif ?>
                <?php if( $show_comments == '1' || $show_comments == 'yes' ) : ?><p class="comments"><span><?php comments_popup_link( __( 'No comments', 'yit' ), __( '1 comment', 'yit' ), __( '% comments', 'yit' ) ); ?></span></p><?php endif ?>
            </div>
        </div>
        <?php
            if( $i == 0 )
                { echo '</div>'; }        
        endif;
        
        $i++;
		$post_number++;
        
    endwhile ?>
    <div class="clear"></div>
    </div>
    <?php
endif;

wp_reset_query();