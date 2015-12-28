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
    'post_type' => 'services',
    'posts_per_page' => $items,
);

$services = get_posts( $args );
$postsPerRow = (yit_get_sidebar_layout() != 'sidebar-no') ? 4 : 6;
$i = 0;

if( !empty($services) ) :
    global $wp_query, $post, $more;
    ?>
    <div class="section services">
        <?php if( !empty( $title ) ) { yit_string( '<h3 class="title">', $title, '</h3>' ); } ?>
        <?php if( !empty( $description ) ) { yit_string( '<p class="description">', $description, '</p>' ); } ?>

        <?php foreach( $services as $service ) : setup_postdata( $service ); ?>
            <div class="<?php if( ( $i % $postsPerRow == 0 ) ): ?>related_project_first <?php endif ?><?php if( ( ++$i % $postsPerRow == 0 ) ): ?>related_project_last <?php endif ?>related_project">
                <a title="<?php if($show_title_hover == 'yes' || $show_title_hover == '1'): ?><?php the_title() ?><?php endif ?>" href="<?php echo get_permalink( $service->ID ) ?>" class="related_img<?php if($show_detail_hover == 'yes' || $show_detail_hover == '1' ): ?> related_detail<?php elseif($show_title_hover == 'yes' || $show_title_hover == '1' ): ?> related_title<?php endif ?>">
                    <?php echo has_post_thumbnail( $service->ID ) ? get_the_post_thumbnail( $service->ID, 'thumb_portfolio_fulldesc_related' ) : '<img src="' . YIT_CORE_ASSETS_URL . '/images/no-featured-175.jpg" title="' . __( '(this post does not have a featured image)', 'yit' ) . '" alt="no featured image" />' ?>
                </a>
                <?php if( $show_title == "1" || $show_title == 'yes' ): ?><h4><a href="<?php echo get_permalink( $service->ID ) ?>"><?php echo $service->post_title ?></a></h4><?php endif ?>
                <?php if( $show_excerpt == "1" || $show_excerpt == 'yes' ): ?><?php echo yit_content( 'content', $excerpt_length ) ?><?php endif ?>
            </div>
            <?php $i; endforeach ?>
        <div class="clear"></div>
    </div>
<?php
endif;

wp_reset_query();