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

$var['posts_per_page'] = -1;
yit_get_model( 'portfolio' )->shortcode_atts = $var;
yit_set_portfolio_loop( $portfolio );

$postsPerRow = (yit_get_sidebar_layout() != 'sidebar-no') ? 4 : 6;
$thumbSize   = (yit_get_sidebar_layout() != 'sidebar-no') ? 'section_portfolio_sidebar' : 'section_portfolio';
$i = 0;
$item_selected = 0;

?>
<div class="section portfolio">
    <?php if( !empty( $title ) ) { yit_string( '<h3 class="title">', $title, '</h3>' ); } ?>
    <?php if( !empty( $description ) ) { yit_string( '<p class="description">', $description, '</p>' ); } ?>
    
	<?php if( ! yit_is_portfolio_empty() ): ?>
		
		<?php if( $show_featured == "1" || $show_featured == 'yes' ): ?>
		<?php while( yit_have_works() ) : ?>
			<?php if( yit_work_get( 'is_sticky' ) ): ?>
			<div <?php post_class( 'work group portfolio-sticky portfolio-full-description' ) ?>>
				<?php
			    	$item_selected = $image_id  = yit_work_get( 'item_id' );
					$image_url = yit_work_get( 'image_url' );
					
					$post_permalink = yit_work_permalink( $image_id );
					
					$terms = yit_work_get( 'terms' );
					$categories = yit_work_get('categories');
					
					$str_categories = '';
					if( !empty($terms) ) foreach( $terms as $name){ $str_categories .= "<a href='". yit_term_link($name) ."'>{$categories[$name]}</a>, "; }
				?>
				
				<?php if ( ! empty( $image_url ) ) : ?>
					<div class="work-thumbnail">
						<a class="thumb"><?php echo wp_get_attachment_image( $image_id, $thumbSize ); ?></a>
						
						<?php if( $show_overlay == 1 || $show_overlay == 'yes' ): ?>
						<div class="work-overlay">
							<h3><a href="<?php echo $post_permalink; ?>"><?php echo yit_work_the('title') ?></a></h3>
							
							<?php if( !empty($terms) && ($show_categories=="1" || $show_categories == "yes") ): ?>
							<p class="work-overlay-categories"><img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/categories.png" alt="<?php _e('Categories', 'yit') ?>" /> in: <?php echo substr($str_categories, 0, strlen($str_categories)-2) ?></p>
							<?php endif ?>
						</div>
						<?php endif ?>
					</div>
				<?php endif ?>
								
				<div class="work-description">
					<h2><a href="<?php echo $post_permalink; ?>"><?php yit_work_the('title') ?></a></h2>
					
					<?php if( !empty($terms) && ($show_categories==1 || $show_categories == "yes") ): ?>
					<p class="work-categories">in: <?php echo substr($str_categories, 0, strlen($str_categories)-2) ?></p>
					<?php endif ?>
					
					<?php echo yit_content( yit_work_get( 'content' ), $featured_excerpt_length ); ?>
	                <?php if( $show_readmore == 1 || $show_readmore  == 'yes' ) :  ?>
						<a href="<?php echo $post_permalink; ?>" class="read-more"><?php echo $readmore_text ?></a>
					<?php endif ?>
					
				</div>
			</div>
			<div class="clear"></div>
			<?php break; ?>
			<?php endif; ?>
		<?php endwhile ?>
		<?php endif ?>


		<div class="portfolio-projects">
			<?php yit_set_portfolio_loop( $portfolio ); ?>
		    <?php while( yit_have_works() ) : if( yit_work_get( 'item_id' ) != $item_selected ): ?>
		    	<?php
		    		$image_id  = yit_work_get( 'item_id' );
					$video_url = yit_work_get( 'video_url' );
		    		
					$show_title_hover = $show_title_hover == 1 || $show_title_hover == "yes";
					$lightbox = $show_lightbox_hover == "1" || $show_lightbox_hover == "yes";
					$detail   = $show_detail_hover == "1" || $show_detail_hover == "yes";
					$both     = $detail && $lightbox;

					$post_permalink = yit_work_permalink( $image_id );
					$class = "";
					if( $both ) {
						if( $video_url ) {
							list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
							if( $video_type == 'youtube' ) {
								$image_permalink = 'http://www.youtube.com/v/' . $video_id . '?width=640&height=480&iframe=true';
							} else if( $video_type == 'vimeo') {
								$image_permalink = 'http://player.vimeo.com/video/' . $video_id;
							}
						} else {
							$image_permalink = yit_work_get( 'image_url' );
						}
						$class = $video_url ? 'video' : 'img';
					} elseif( $lightbox ) {
						if( $video_url ) {
							$class = "related_video";
							list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
							if( $video_type == 'youtube' ) {
								$image_permalink = 'http://www.youtube.com/v/' . $video_id . '?width=640&height=480&iframe=true';
							} else if( $video_type == 'vimeo') {
								$image_permalink = 'http://player.vimeo.com/video/' . $video_id;
							}
						} else {
							$class = "related_proj";
							$image_permalink = yit_work_get( 'image_url' );
						}
					} elseif( $detail ) { 
						$class = "related_detail";
					} elseif( $show_title_hover ) {
						$class = "related_title";
					}
					
		    	?>
				<div class="<?php if( ($i % $postsPerRow == 0) ): ?>related_project_first <?php endif ?><?php if( (++$i % $postsPerRow == 0) ): ?>related_project_last <?php endif ?>related_project">
					<?php if( $both ): ?><div class="overlay_a related_img">
			        <div class="overlay_wrapper"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc_related' ); ?>
						<div class="overlay">
					        <a class="overlay_<?php echo $class ?>" href="<?php echo $image_permalink ?>" rel="lightbox" title=""></a>
					        <a class="overlay_project" href="<?php echo $post_permalink ?>"></a>
					        <?php if($show_title_hover) : ?>
					            <span class="overlay_title"><?php yit_work_the( 'title' ) ?></span>
					        <?php endif ?>
						</div>
			        </div></div>
					<?php else: ?>
					<a title="<?php if($show_title_hover) yit_work_the('title') ?>" href="<?php echo $lightbox ? $image_permalink : $post_permalink ?>" class="related_img <?php echo $class ?>"<?php if($class): ?> rel="lightbox"<?php endif ?>>
						<?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc_related' ); ?>
					</a>
					<?php endif ?>
					<?php if( $show_title == "1" || $show_title == 'yes' ): ?><h4><a href="<?php echo $post_permalink ?>"><?php yit_work_the('title') ?></a></h4><?php endif ?>
					<?php if( $show_excerpt == "1" || $show_excerpt == 'yes' ): ?><?php echo yit_content( yit_work_get( 'content' ), $excerpt_length, '', '[...]') ?><?php endif ?>
				</div>
				<?php if( $i == $items ) break; ?>
			<?php endif; endwhile ?>
		</div>
	<?php endif ?>
</div>
<div class="clear"></div>
