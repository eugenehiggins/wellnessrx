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
 
 		            <ul id="portfolio" class="<?php echo $portfolio_type; ?>">         
                        <?php
                            $i = 1;
        
                            while ( yit_have_works() ) :  
                                if($i % 3 == 0) {
                                    $classes = 'last group';
                                } elseif($i % 3 == 1) {
                                    $classes = 'first';
                                } else {
                                    $classes = '';
                                }
                                
                                $classes .= " one-third";
                                
                                $video_url = yit_work_get( 'video_url' );
                                $image_url = yit_work_get( 'image_url' );
                                $image_id  = yit_work_get( 'item_id' );
                                list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $image_id, 'thumb_portfolio_3cols' );
                                
                                $post_permalink = yit_work_permalink( $image_id ); 
                        ?>     
        
                        <li <?php yit_work_class( $classes ) ?>>
                            <?php 
                            	$class = '';
                                if ( ! empty( $video_url ) ) {
                                	
									list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
						            if( $video_type == 'youtube' ) {
						                $video_url = 'http://www.youtube.com/v/' . $video_id . '?width=640&height=480&iframe=true';
						            } else if( $video_type == 'vimeo') {
						                $video_url = 'http://player.vimeo.com/video/' . $video_id;
						            }
									
                                    $thumb = $video_url;
                                    //$class = 'video';
                                } else {
                                    $thumb = $image_url;
                                    //$class = 'img';
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

                            ?>
        
                            <?php if ( ! empty( $image_url ) ) : ?>
		                    	<?php if ( $both ) : ?>   
			                        <div class="overlay_a"><div class="overlay_wrapper"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_3cols' ); ?>
										<div class="overlay">
					                        <a class="overlay_<?php echo$class ?>" href="<?php echo $thumb ?>" rel="lightbox" title=""></a>
					                        <a class="overlay_project" href="<?php echo $post_permalink ?>"></a>
					                        <?php if($title) : ?>
					                        <span class="overlay_title"><?php yit_work_the( 'title' ) ?></span>
					                        <?php endif ?>
										</div></div>
			                        </div>
                                <?php elseif ( $lightbox ) : ?>
	                                <a class="thumb <?php echo $class ?>" href="<?php echo $thumb ?>" rel="lightbox" title="<?php if($title) yit_work_the( 'title' ) ?>"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_3cols' ); ?></a>
                                <?php elseif ( $details ) : ?>
	                                <a class="thumb <?php echo $class ?>" href="<?php echo $post_permalink ?>" title="<?php if($title) yit_work_the( 'title' ) ?>"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_3cols' ); ?></a>
						    	<?php else : ?>
	                                <a class="thumb <?php echo $class ?>" title="<?php if($title) yit_work_the( 'title' ) ?>"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_3cols' ); ?></a>
                                <?php endif ?>
                            <?php endif ?>  
        
                            <h4><a href="<?php echo $post_permalink ?>"><?php yit_work_the( 'title' ) ?></a></h4>
                            
                            <?php if( yit_work_get('enable_excerpt') ): ?>
	                            <?php echo yit_content( yit_work_get( 'content' ), yit_work_get( 'excerpt_length' ) ) ?>
                            <?php endif ?>
                            
                			<?php if(yit_work_get( 'read_more_text' ) != '') echo yit_sc_more_link( "<a class='read-more' href='{$post_permalink}'>" . yit_work_get( 'read_more_text' ) . "</a>", yit_work_get( 'read_more_text' ), $post_permalink ) ?>
                        </li>       
                        <?php $i++; endwhile ?>        
                    </ul>
                    
                    <?php yit_portfolio_pagination() ?>