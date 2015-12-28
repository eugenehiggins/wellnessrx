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
 
global $wp_query, $post, $more;

$blog_type = yit_get_option( 'blog-type' );

if( is_single() )
    { $blog_type = 'big'; }

if( is_category() || is_tag() ) {
    if( is_category() ) {
        echo do_shortcode( category_description() );
    } elseif( is_tag() ) {
        echo do_shortcode( tag_description() );
    }

    echo '<div class="clear"></div>';
}

if( have_posts() ) : 

    if ( is_category() ) :
        if( yit_get_option( 'show-title-categories' ) ) : ?>
            <h3><?php echo apply_filters( 'yit_archive_category_title', sprintf( yit_get_option( 'page-categories-title' ), single_cat_title( '', false ) ) ) ?></h3>
        <?php endif ?>
        
    <?php elseif( is_archive() ) :
        if( yit_get_option( 'show-title-archives' ) ) :
            if( is_tag() ) : ?>
                <h3><?php echo apply_filters( 'yit_archive_tag_title',      sprintf( yit_get_option( 'page-archives-title' ), single_tag_title( '', false ) ) ) ?></h3>
                
                <?php elseif( is_day() ) : ?>
                <h3><?php echo apply_filters( 'yit_archive_day_title',      sprintf( yit_get_option( 'page-archives-title' ), get_the_time( apply_filters( 'yit_daily_archive_date_format', __( 'F jS, Y', 'yit' ) ) ) ) ) ?></h3>
                
                <?php elseif( is_month() ) : ?>
                <h3><?php echo apply_filters( 'yit_archive_month_title',    sprintf( yit_get_option( 'page-archives-title' ), get_the_time( apply_filters( 'yit_montly_archive_date_format', __( 'F Y', 'yit' ) ) ) ) ) ?></h3>
                
                <?php elseif( is_year() ) : ?>
                <h3><?php echo apply_filters( 'yit_archive_year_title',     sprintf( yit_get_option( 'page-archives-title' ), get_the_time( apply_filters( 'yit_yearly_archive_date_format', __( 'Y', 'yit' ) ) ) ) ) ?></h3>
                
                <?php elseif( is_author() ) : ?>
                <h3><?php echo apply_filters( 'yit_archive_author_title', __( 'Author archive', 'yit' ) ) ?></h3>
            <?php
            endif;
        endif;
        ?>
        
    <?php elseif( is_search() ) :
        if( yit_get_option( 'show-title-searches' ) ) : ?>
            <h3><?php echo apply_filters( 'yit_archive_search_title',   sprintf( yit_get_option( 'page-searches-title' ), yit_string( '<span>', get_search_query() , '</span>', false ) ) ) ?></h3>
        <?php endif ?>
    
    
    <?php elseif( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) : ?>
    <h3><?php echo apply_filters( 'yit_archive_blog_title', __( 'Blog Archive', 'yit' ) ) ?></h3>
    
    <?php
    endif;
    
    while (have_posts()) : the_post();
        if( !is_single() )
            { $more = 0; }
        
        do_action( 'yit_loop_blog_' . $blog_type );
    endwhile ?>
<?php else : //There aren't posts ?>
<div id="post-0" class="post error404 not-found group">
	<h1 class="entry-title"><?php _e( 'Not Found', 'yit' ); ?></h1>
	<div class="entry-content">
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'yit' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</div>
<?php
endif;

wp_reset_postdata();

if( function_exists( 'yit_pagination' ) ) : yit_pagination(); else : ?> 
<div class="navigation group">
    <div class="alignleft"><?php next_posts_link( __( 'Next &raquo;', 'yit' ) ) ?></div>
    <div class="alignright"><?php previous_posts_link( __( '&laquo; Back', 'yit' ) ) ?></div>
</div>
<?php endif ?>