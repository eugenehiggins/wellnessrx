<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
$thumbs = ''; 
$portfolio_type = yit_work_get( 'portfolio_type' );  
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
      	$video_url = yit_work_get( 'video_url' );
        $image_url = yit_work_get( 'image_url' );
        $image_id  = yit_work_get( 'item_id' );
        list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $image_id, 'thumb_portfolio_bigimage' );
                                
        $post_permalink = yit_work_permalink( $image_id );
		
		
        
        if ( ! empty( $video_url ) ) {
                                	
			list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
			if( $video_type == 'youtube' ) {
				$video_url = 'http://www.youtube.com/embed/' . $video_id . '?width=640&height=480&iframe=true';
			} else if( $video_type == 'vimeo') {
				$video_url = 'http://player.vimeo.com/video/' . $video_id;
			}
									
            $thumb = $video_url;
        } else {
            $thumb = $image_url;
        }

		
		$both = 0; $class = '';
		$lightbox = yit_work_get( 'event_lightbox' );
		$details  = yit_work_get( 'event_details' );
		$title    = yit_work_get( 'event_title' );
		if( $lightbox && $details ) {
			$both  = 1;
			$class = $video_url ? 'video' : 'img';
		} elseif( $lightbox ) {
			$class = $video_url ? 'video' : 'img';
		} elseif( $details ) {
			$class = 'project';
		} elseif( $title /* && yit_work_get( 'title' ) */) {
			$class = 'onlytitle';
		}
		
		
		$customer = yit_work_get('customer');
		$year = yit_work_get('year');
		$skills_label = yit_work_get('skills_label') ? yit_work_get('skills_label') : __('Skills', 'yit');
		$skills = yit_work_get('skills');
?>     
		
		<div <?php post_class( 'work group' ) ?>>
			<?php if ( ! empty( $image_url ) ) : ?>
                <div class="work-thumbnail">                                                                                                                           

                    <?php if ( $both ) : ?>
                        <div class="nozoom"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_bigimage' ); ?>
							<div class="overlay">
		                        <a class="overlay_<?php echo$class ?>" href="<?php echo $thumb ?>" rel="lightbox" title="<?php if($title) yit_work_the( 'title' ) ?>"></a>
		                        <a class="overlay_project" href="<?php echo $post_permalink ?>"></a>
		                        <?php if($title) : ?>
		                        <span class="overlay_title"><?php yit_work_the( 'title' ) ?></span>
		                        <?php endif ?>
							</div>
                        </div>

                    <?php elseif ( $lightbox ) : ?>
                        <a class="thumb <?php echo $class ?>" href="<?php echo $thumb ?>" rel="lightbox" title="<?php if($title) yit_work_the( 'title' ) ?>"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_bigimage' ); ?></a>
                    <?php elseif ( $details ) : ?>
                        <a class="thumb <?php echo $class ?>" href="<?php echo $post_permalink ?>" title="<?php if($title) yit_work_the( 'title' ) ?>"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_bigimage' ); ?></a>
                    <?php else : ?>
                        <a class="thumb <?php echo $class ?>" title="<?php if($title) yit_work_the( 'title' ) ?>"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_bigimage' ); ?></a>
                    <?php endif ?>

                </div>
			<?php endif ?>
			
            <div class="work-description">
                <h3><?php yit_work_the( 'title' ) ?></h3>
                <?php echo yit_content( yit_work_get( 'content' ), yit_work_get( 'excerpt_length' ) ) ?>
                <div class="clear"></div>
                
                            
                <?php if( $skills || $year || $customer ): ?>
                    <div class="work-skillsdate">
                        <?php if( ! empty( $skills ) ): ?><p class="skills"><span class="label"><?php echo $skills_label ?>:</span> <?php echo $skills ?></p><?php endif ?>
                        <?php if( ! empty( $customer ) ): ?><p class="workdate"><span class="label"><?php echo _e('Customer', 'yit') ?>:</span> <?php echo $customer ?></p><?php endif ?>
                        <?php if( ! empty( $year ) ): ?><p class="workdate"><span class="label"><?php echo _e('Year', 'yit') ?>:</span> <?php echo $year ?></p><?php endif ?>
                    </div>
                <?php endif ?>
                
                <?php echo yit_sc_more_link( "<a class='read-more' href='{$post_permalink}'>" . yit_work_get( 'read_more_text' ) . "</a>", yit_work_get( 'read_more_text' ), $post_permalink ) ?>
            </div>
            <div class="clear"></div>
		</div>

<?php endwhile ?>

<?php yit_portfolio_pagination() ?>

</div>
<div class="clear"></div>