<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
$thumbs = ''; 
$portfolio_type = yit_work_get( 'portfolio_type' );

$item_selected = null;
?>
<script>
jQuery(document).ready(function($){
	$('.sidebar').remove();
	
	if( !$('#primary').hasClass('sidebar-no') ) {
		$('#primary').removeClass().addClass('sidebar-no');
	}
	
});
</script>

<div id="portfolio" class="portfolio-<?php echo $portfolio_type ?>">
<?php while ( yit_have_works() ) :                 
        $next_work = yit_next_work(); 
        $prev_work = yit_previous_work();
        
		$item_selected = yit_work_get( 'item_id' );

      	$video_url = yit_work_get( 'video_url' );
        $image_url = yit_work_get( 'image_url' );
        $image_id  = yit_work_get( 'item_id' );
        list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $image_id, 'thumb_portfolio_fulldesc' );
                                
        $post_permalink = yit_work_permalink( $image_id );
		$click_event = yit_get_option( 'thumbnail-portfolios', 'lightbox' );
		
        $class = '';
        if ( ! empty( $video_url ) ) {
                                	
                                    
			list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
			if( $video_type == 'youtube' ) {
				$video_url = 'http://www.youtube.com/v/' . $video_id . '?width=640&height=480&iframe=true';
			} else if( $video_type == 'vimeo') {
				$video_url = 'http://player.vimeo.com/video/' . $video_id;
			}
									
            $thumb = $video_url;
            $class = 'video';
        } else {
            $thumb = $image_url;
            $class = 'img';
        }
		
		$customer = yit_work_get('customer');
		$year = yit_work_get('year');
		$skills_label = yit_work_get('skills_label') ? yit_work_get('skills_label') : __('Skills', 'yit');
		$skills = yit_work_get('skills');
?>     
		<div class="fulldescription_title gallery-filters">
		    <h1><?php yit_work_the( 'title' ) ?></h1>
		    
		    <div style="text-align:right;">
			    <?php if ( ! empty( $prev_work ) ) : ?><a href="<?php echo $prev_work ?>"><?php _e( '<< Previous', 'yit' ) ?></a> - <?php endif; ?>
			    <?php if ( ! empty( $next_work ) ) : ?><a href="<?php echo $next_work ?>"><?php _e( 'Next >>', 'yit' ) ?></a><?php endif; ?>
			</div>
		</div>
		<div <?php post_class( 'work group' ) ?>>
			<?php if ( ! empty( $image_url ) || ! empty( $video_url ) ) : ?>
                <div class="work-thumbnail">
					<?php if( $video_url ): ?>
                        <div class="post_video <?php echo $video_type ?>">
                            <?php echo do_shortcode( "[$video_type video_id=\"$video_id\" width=\"100%\" height=\"100%\"]" ); ?>
                        </div>
					<?php else: ?>
                    <a class="thumb"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc' ); ?></a>
                    <?php endif ?>
                </div>
			<?php endif ?>
			
            <div class="work-description">
                <?php echo yit_content( yit_work_get( 'content' ), 1000 ) ?>

				<div class="clear"></div>
                <?php if( $skills || $year || $customer ): ?>
                    <div class="work-skillsdate">
                        <?php if( ! empty( $skills ) ): ?><p class="skills"><span class="label"><?php echo $skills_label ?>:</span> <?php echo $skills ?></p><?php endif ?>
                        <?php if( ! empty( $customer ) ): ?><p class="workdate"><span class="label"><?php echo _e('Customer', 'yit') ?>:</span> <?php echo $customer ?></p><?php endif ?>
                        <?php if( ! empty( $year ) ): ?><p class="workdate"><span class="label"><?php echo _e('Year', 'yit') ?>:</span> <?php echo $year ?></p><?php endif ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="clear"></div>
		</div>
<?php break; ?>
<?php endwhile ?>

<div class="clear"></div>
<?php if( yit_work_get('display_related') ): $i=0; ?>
<h3><?php yit_work_the('other_projects_label') ?></h3>
<div class="portfolio-<?php echo $portfolio_type ?>-related-projects">
	
	<?php
		$vars = yit_portfolio_query_vars();
		$var['posts_per_page'] = yit_work_get('detail_nitems') ? yit_work_get('detail_nitems') : -1;
		yit_get_model( 'portfolio' )->shortcode_atts = $var;
		yit_set_portfolio_loop( $vars->post_id * 1 );
	?>
	
	<?php while( yit_have_works() ) : ?>
		<?php list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( yit_work_get( 'item_id' ), 'thumb_portfolio_fulldesc_related' ); ?>
		<?php $post_permalink = yit_work_permalink( yit_work_get( 'item_id' ) ); ?>
		<?php $title = yit_work_get( 'title' ) ?>
		<div class="<?php if( (++$i % 6 == 0) ): ?>related_project_last <?php endif ?>related_project">
			<a class="related_proj related_img" href="<?php echo $post_permalink ?>" title="<?php echo $title ?>"><?php echo wp_get_attachment_image( yit_work_get( 'item_id' ), 'thumb_portfolio_fulldesc_related' ); ?></a>
			<h4><a href="<?php echo $post_permalink ?>"><?php echo $title ?></a></h4>
		</div>
	<?php endwhile ?>
</div>
					



<?php endif ?>
</div>
<div class="clear"></div>