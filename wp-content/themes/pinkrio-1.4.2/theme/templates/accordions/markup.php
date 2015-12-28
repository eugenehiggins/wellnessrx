<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         

?>
<?php if( ! yit_is_accordion_empty() ): ?>
	<div class="accordion-container">
	<?php while( yit_have_accordion_item() ): ?>

		<h3 class="accordion-title"><span class="icon-plus-sign"></span> <?php yit_accordion_item_the('title'); ?></h3>
		<div class="accordion-item">
			<div class="accordion-item-thumb">
				<?php list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( yit_accordion_item_get('item_id'), 'accordion_thumb' ); ?>
				<img src="<?php echo $thumbnail_url ?>" alt="<?php yit_accordion_item_the('title'); ?>" width="<?php echo $thumbnail_width ?>" height="<?php echo $thumbnail_height ?>" style="width:<?php echo $thumbnail_width ?>px;" />
			</div>
			<div class="accordion-item-content" style="margin-left: <?php echo $thumbnail_width + apply_filters( 'yit_accordion_text_offset', 32 ) ?>px;">
				<h4><?php if( yit_accordion_item_get('website') ) yit_string('<a style="color:inherit" href=' . yit_accordion_item_get('website') . '>', yit_accordion_item_get('subtitle'), '</a>'); else yit_accordion_item_the('subtitle'); ?></h4>
				<?php echo yit_content(yit_accordion_item_get('content'), 1000); ?>
				<?php echo yit_content(yit_accordion_item_get('social')); ?>
			</div>
		</div>
		<div class="clear"></div>
		
	<?php endwhile ?>
	</div>
	<div class="clear"></div>
	
	<script>
	jQuery(document).ready(function($){
		
		$('.accordion-title').click(function(){
			if( !$(this).hasClass('active') ) {
				$('.accordion-title').removeClass('active').find('span').addClass('icon-plus-sign').removeClass('icon-minus-sign');
				$('.accordion-item').slideUp();
	
				$(this).toggleClass('active')
					   .find('span').removeClass('icon-plus-sign').addClass('icon-minus-sign').parent()
					   .next().slideToggle();
			}
		}).filter(':first').click();
		
	});
	</script>
<?php endif ?>