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

global $post;
$vars = yit_portfolio_query_vars();

// change the pagination links
add_filter( 'get_pagenum_link', create_function( '$link', 'return preg_replace( "/\/page\/([0-9]+)/", "/$1", $link );' ) );

get_header();
do_action( 'yit_before_primary' );

$next_work = yit_next_work(); 
$prev_work = yit_previous_work();
?>                              

<script>
jQuery(document).ready(function($){
	$('.sidebar').remove();
	
	if( !$('#primary').hasClass('sidebar-no') ) {
		$('#primary').removeClass().addClass('sidebar-no');
	}
	
});
</script>

<!-- START PRIMARY -->
<div id="primary" class="sidebar-no">
    <div class="inner group">
        <?php do_action( 'yit_before_content' ) ?>
        <!-- START CONTENT -->
        <div id="content-page" class="content group">          
        
		<?php
		if( !isset( $vars->post_id ) ) : yit_portfolio($post->post_name); 
		else :
		?>
        
            <div class="clear"></div>
            <div class="posts">
                <?php             
                	$i = 0;         
                    $item_id = $vars->item['item_id'];
                    $title = is_null( get_the_title() ) ? __( '(this post has no title)', 'yit' ) : get_the_title();
                    $video = $vars->item['video_url'];
                    
                    $date_format  = yit_get_option( 'portfolio_date_format', get_option('date_format') );
                    $skills_label = isset( $vars->item['skills_label'] ) && ! empty( $vars->item['skills_label'] ) ? $vars->item['skills_label'] : __('Skills', 'yit');
                    $skills       = isset( $vars->item['skills'] ) && ! empty( $vars->item['skills'] ) ? $vars->item['skills'] : '';
                ?>        
                
                <div id="post-<?php echo $item_id ?>" class="hentry-post group portfolio-post internal-post">
                	
					<div id="portfolio" class="portfolio-full-description">
					<?php 
							$item_selected = $item_id;
					
					      	$video_url = $vars->item[ 'video_url' ];
					        $image_url = $vars->item[ 'image' ];
					        $image_id  = $vars->item[ 'item_id' ];
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
							
							$customer = $vars->item['customer'];
							$year = $vars->item['year'];
							$skills_label = $vars->item['skills_label'] ? $vars->item['skills_label'] : __('Skills', 'yit');
							$skills = $vars->item['skills'];
							
							$extra_images = isset( $vars->item['extra-images'] ) ? $vars->item['extra-images'] : array();
					?>     
							<div class="fulldescription_title gallery-filters">
							    <h1><?php echo $vars->item[ 'title' ] ?></h1>
					
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
					                        <?php if ( empty( $extra_images ) ) : ?>   
                                                <a class="thumb"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc' ); ?></a>
                                            <?php else : array_unshift( $extra_images, $image_id ); ?>
                                                <div class="extra-images-slider flexslider">
                                                    <ul class="slides">
                                                        <?php foreach ( $extra_images as $image_id ) : ?>
                                                        <li><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc' ); ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                                <script type="text/javascript">
                                                    jQuery(document).ready(function($){
                                                        $('.extra-images-slider').flexslider({});    
                                                    });
                                                </script>
                                            <?php endif; ?>
					                    <?php endif ?>
					                </div>
								<?php endif ?>
								
					            <div class="work-description">
					                <?php the_content(); ?>
					
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
					
					<div class="clear"></div>
					<?php if( yit_work_get('display_related') ): $i=0; ?>
					<h3><?php echo yit_portfolio_get_setting( 'other_projects_label', $vars->post_id ) ?></h3>
					<div class="portfolio-full-description-related-projects">
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
                </div>      
            
            </div>
        <?php endif ?>
        </div>
        <!-- END CONTENT -->
        <?php do_action( 'yit_after_content' ) ?>
        
        <?php //do_action( 'yit_before_sidebar' ) ?>
        <?php //get_sidebar() ?>
        <?php //do_action( 'yit_after_sidebar' ) ?>
    </div>
</div>
<!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>