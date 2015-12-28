<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
$thumbs = ''; 
$slider_type = yit_slide_get( 'slider_type' );  
?>
 
 		<!-- BEGIN NIVO SLIDER -->
 		<div id="slider-<?php echo $current_slider ?>"<?php yit_slider_class() ?> style="width: <?php yit_slide_the( 'width_' . $slider_type ); ?>px; height: <?php yit_slide_the( 'height_' . $slider_type ); ?>px;">
		  <ul class="slides">
		    <?php
            while( yit_have_slide() ) : ?>
                <li>
                	<?php yit_slide_the( 'featured-content', array(
	                    'container' => false
	                )); ?>             
                        
                    <?php if( trim( yit_slide_get( 'clean-content' ) ) ): ?>
                    <div class="slider-caption caption-<?php yit_slide_the( 'caption_position' ) ?>">
                            <h2><?php yit_slide_the( 'title' ) ?></h2>
                            <h4><?php yit_slide_the( 'subtitle' ) ?></h4>
                            <?php yit_slide_the( 'content' ) ?>
                    </div>
                    <?php endif ?>
	            </li>
            <?php endwhile; ?>
		  </ul>
		</div>
        
 
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#slider-<?php echo $current_slider ?>.flexslider img.attachment-full').css('width', '<?php yit_slide_the( 'width_' . $slider_type ); ?>px').css('height', '<?php yit_slide_the( 'height_' . $slider_type ); ?>px');
			    
			    var flex_caption_hide = function(slider) {     //console.log(slider);
                    var currSlideElement = slider;
                    var caption_speed = <?php echo yit_slide_get('caption_speed') * 1000; ?>;
                    var width = parseInt( $('.slider-caption', currSlideElement).outerWidth() );
                    var height = parseInt( $('.slider-caption', currSlideElement).outerHeight() );
                    
                    $('.caption-top', currSlideElement).animate({top:height*-1}, caption_speed);
                    $('.caption-bottom', currSlideElement).animate({bottom:height*-1}, caption_speed);
                    $('.caption-left', currSlideElement).animate({left:width*-1}, caption_speed);
                    $('.caption-right', currSlideElement).animate({right:width*-1}, caption_speed);
                };
			    
			    var flex_caption_show = function(slider) {      
                    var nextSlideElement = slider;
                    var caption_speed = <?php echo yit_slide_get('caption_speed') * 1000; ?>;
                    
                    $('.caption-top', nextSlideElement).animate({top:0}, caption_speed);
                    $('.caption-bottom', nextSlideElement).animate({bottom:0}, caption_speed);
                    $('.caption-left', nextSlideElement).animate({left:0}, caption_speed);
                    $('.caption-right', nextSlideElement).animate({right:0}, caption_speed);
                };
			    
			    $('#slider-<?php echo $current_slider ?>.flexslider').flexslider({
			        animation: '<?php yit_slide_the( 'effect_' . $slider_type ); ?>',
			        slideshowSpeed: <?php echo yit_slide_get('interval') * 1000 ?>,
			        animationSpeed: <?php echo yit_slide_get('speed') * 1000 ?>,
			        pauseOnAction: false,
			        controlNav: <?php if(yit_slide_get('controlnav')!='') {
	                            echo yit_slide_get('controlnav');
    			        }else {
    			            echo 'false';
    			        } ?>,
			        directionNav: true,
			        touch: false,
                    start   : flex_caption_show,
                    before  : flex_caption_hide,
                    after   : flex_caption_show
			    });
            });
        </script>