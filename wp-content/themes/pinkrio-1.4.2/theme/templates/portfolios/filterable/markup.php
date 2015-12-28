<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
$thumbs = ''; 
$portfolio_type = yit_work_get( 'portfolio_type' ); 
?>




<div id="portfolio" class="portfolio-<?php echo $portfolio_type ?>">
<?php if( yit_work_get('filter_active') ): ?>
<?php
	global $post;
	
	$_active_title = !yit_get_post_meta( $post->ID, '_show-title');  
	$cats = yit_work_get('categories');
	$i = 1;
	
?>
<div class="gallery-filters">
    
    <ul class="filters gallery-categories-quicksand">
        <li class="segment-1 first"><a data-value="all" href="#"><?php _e('All', 'yit') ?></a></li>
        
        <?php if( !empty($cats) ): ?>
        <?php foreach( $cats as $cat=>$name ): ?>
         	<?php if( yit_work_items_in_category($cat) ): ?>
           		<li class="segment-<?php echo ++$i ?>"><a href="<?php echo add_query_arg('cat', $cat) ?>" data-value="<?php echo strtolower(preg_replace('/\s+/', '-', $cat)) ?>"><?php echo $name ?></a></li>
			<?php else: ?>
				<!--li class="segment-<?php echo ++$i ?>"><?php echo $name ?></li-->
			<?php endif ?>
        <?php endforeach ?>
        <?php endif ?>
    </ul>
</div>
<?php endif ?>

<div id="portfolio-gallery" class="internal_page_items internal_page_gallery">
	
<?php if( ! yit_is_portfolio_empty() ): ?>
    <ul class="gallery-wrap image-grid group">

	<?php
	
    $postsPerRow = (yit_get_sidebar_layout() != 'sidebar-no') ? 3 : 4;
    $i = 0;
	
	while ( yit_have_works() ) :  
	
        $classes = "";
        $terms = yit_work_get('terms');     	
            
        if(!empty($terms)) {
            foreach( $terms as $index=>$term) {
                $classes .= " segment-".$index;
            }
        }
	
		$isFirstInRow = ( ++$i==1 | ($i % $postsPerRow) == 1 ) ? 1 : 0;
		$isLastInRow = ( ($i % $postsPerRow) == 0 ) ? 1 : 0;
	
        $video_url = yit_work_get( 'video_url' );
        $image_url = yit_work_get( 'image_url' );
        $image_id  = yit_work_get( 'item_id' );
        list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $image_id, 'thumb_portfolio_filterable' );
	
		$post_permalink = yit_work_permalink( $image_id ); 

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
		
        if ( ! empty( $video_url ) ) {
			list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
			if( $video_type == 'youtube' ) {
				$video_url = 'http://www.youtube.com/v/' . $video_id . '?width=640&height=480&iframe=true';
			} else if( $video_type == 'vimeo') {
				$video_url = 'http://player.vimeo.com/video/' . $video_id;
			}
									
            $thumb = $video_url;
        } else {
            $thumb = $image_url;
        }
        
        $classes = array();
        
        if ( ! empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $classes[] = strtolower(preg_replace('/\s+/', '-', $term));    
            }
        }
        
        $classes[] = yit_get_sidebar_layout() != 'sidebar-no' ? 'one-third' : 'one-fourth';
        
        if ( ($i % $postsPerRow) == 0 ) $classes[] = 'last';
	?>
        <li data-id="id-<?php echo $i; ?>" class="<?php echo implode( ' ', $classes ) ?>">
            <div class="internal_page_item internal_page_item_gallery">
            	
            <?php if ( ! empty( $image_url ) ) : ?>
		        <?php if ( $both ) : ?>
			        <div class="overlay_a">
			        	<?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_filterable' ); ?>
			        	
						<div class="overlay">
					        <a class="overlay_<?php echo $class ?>" href="<?php echo $thumb ?>" rel="lightbox" title=""></a>
					        <a class="overlay_project" href="<?php echo $post_permalink ?>"></a>
					        <?php if($title) : ?>
					            <span class="overlay_title"><?php yit_work_the( 'title' ) ?></span>
					        <?php endif ?>
						</div>
			        	
			        </div>

		        <?php elseif ( $lightbox ) : ?>
			        <a class="thumb <?php echo $class ?>" href="<?php echo $thumb ?>" rel="lightbox" title="<?php if($title) yit_work_the( 'title' ) ?>"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_filterable' ); ?></a>
		        <?php elseif ( $details ) : ?>
			        <a class="thumb <?php echo $class ?>" href="<?php echo $post_permalink ?>" title="<?php if($title) yit_work_the( 'title' ) ?>"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_filterable' ); ?></a>
		        <?php else : ?>
			        <a class="thumb <?php echo $class ?>" title="<?php if($title) yit_work_the( 'title' ) ?>"><?php echo wp_get_attachment_image( $image_id, 'thumb_portfolio_filterable' ); ?></a>
		        <?php endif ?>
            <?php endif ?>  
            </div>
        </li>
<?php endwhile ?>
    </ul>
<?php else: ?>
	<p><?php _e('No elements found', 'yit')?></p>
<?php endif ?>
    <div class="clear"></div>
    
    <?php if( !yit_work_get('filter_active') ): ?><?php yit_portfolio_pagination() ?><?php endif ?>
</div>
</div>