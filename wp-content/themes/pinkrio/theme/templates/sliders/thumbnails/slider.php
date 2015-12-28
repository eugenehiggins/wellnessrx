<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         

$thumbs = ''; 
$slider_type = yit_slide_get( 'slider_type' );

global $_wp_additional_image_sizes;
$thumb_width  = $_wp_additional_image_sizes['thumb-slider-thumbnails']['width'];
$thumb_height = $_wp_additional_image_sizes['thumb-slider-thumbnails']['height'];

?>
 
<!-- START SLIDER -->
<div id="slider-<?php echo $current_slider ?>"<?php yit_slider_class('group inner') ?>>
    <div class="showcase group">  
    <?php while( yit_have_slide() ) :  

        $thumbnail = explode( '.', basename( yit_slide_get('image_url') ) );
        $thumbnail = str_replace( basename( yit_slide_get('image_url') ), $thumbnail[0] . '-' . $thumb_width . 'x' . $thumb_height . '.' . $thumbnail[1], yit_slide_get('image_url') );
    ?>

    <div class="showcase-slide">
        <div class="showcase-content">
            <!-- If the slide contains multiple elements you should wrap them in a div with the class
            .showcase-content-wrapper. We usually wrap even if there is only one element,
            because it looks better. -->
            <div class="showcase-content-wrapper">
                <?php yit_slide_the( 'featured-content', array( 'container' => false ) ) ?>
            </div>
        </div>
        <!-- Put the caption content in a div with the class .showcase-caption -->
        <?php if ( yit_slide_get('caption') ) : ?><div class="showcase-caption"><p class=""><?php yit_slide_the('caption'); ?></p></div><?php endif; ?>

        <div class="showcase-thumbnail">
            <img src="<?php echo $thumbnail ?>" width="<?php echo $thumb_width ?>" height="<?php echo $thumb_height ?>" />
        </div>

        <!-- Put the tooltips in a div with the class .showcase-tooltips. -->
        <?php if ( yit_slide_get('tooltip_x') != '' && yit_slide_get('tooltip_y') != '' && yit_slide_get('tooltip_text') != '' ) : ?>
        <div class="showcase-tooltips">
            <!-- Each anchor in .showcase-tooltips represents a tooltip.
            The coords attribute represents the position of the tooltip. -->
            <a href="<?php echo esc_url( yit_slide_get('tooltip_url') ) ?>" coords="<?php yit_slide_the('tooltip_x') ?>,<?php yit_slide_the('tooltip_y') ?>">
                <?php if ( yit_slide_get('tooltip_image') != '' ) : ?>
                <img src="<?php yit_slide_the('tooltip_image') ?>" />
                <?php endif; ?>
                <!-- The content of the anchor-tag is displayed in the tooltip. -->
                <?php yit_slide_the('tooltip_text') ?>
            </a>
        </div>
        <?php endif; ?>
    </div>

    <?php endwhile; ?>
    </div>
</div> 
<!-- END SLIDER --> 
        
    <script type="text/javascript">
        jQuery(document).ready(function($){
        	$('#slider-<?php echo $current_slider ?>.thumbnails img.attachment-full').css('width', '<?php yit_slide_the( 'width_' . $slider_type ); ?>px').css('height', '<?php yit_slide_the( 'height_' . $slider_type ); ?>px');
            var resize_height_thumbnail = function(){
                $('.showcase-content-container, .showcase-content').height( $('.showcase-content-wrapper').height() );
            };
            $(window).resize(resize_height_thumbnail);

			$("#slider-<?php echo $current_slider ?> .showcase").awShowcase({
    	        content_width           : <?php yit_slide_the('width') ?> + 22,
    	        content_height          : <?php yit_slide_the('height') ?> + 22,		
    			show_caption            : '<?php yit_slide_the('show_caption') ?>', /* onload/onhover/show */    
				continuous              : true,
	    		buttons                 : false,
	    		auto                    : true,
	    		thumbnails              : true,           
	    		transition              : '<?php yit_slide_the('effect') ?>', /* hslide / vslide / fade */
	    		interval                : <?php echo yit_slide_get('interval') * 1000 ?>,
	    		transition_speed        : <?php echo yit_slide_get('speed') * 1000 ?>,
	    		thumbnails_position     : 'outside-last', /* outside-last/outside-first/inside-last/inside-first */
	    		thumbnails_direction    : 'horizontal', /* vertical/horizontal */
	    		thumbnails_slidex       : 1, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
	    		onload                  : function(){
                    $( window ).load(function(){
                        resize_height_thumbnail();
                    });
                }
    	    });
        });
   </script>