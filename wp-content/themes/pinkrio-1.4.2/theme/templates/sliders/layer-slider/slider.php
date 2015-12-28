<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
$slider_type = yit_slide_get( 'slider_type' );
$slider = yit_slide_get( 'layer_slider_layer-slider' );
?>
 
<!-- START SLIDER -->
<div id="slider-<?php echo $current_slider ?>"<?php yit_slider_class() ?>> 
    <div class="shadowWrapper">
        <?php layerslider( $slider ); ?>
        <div class="shadow-left"></div>
        <div class="shadow-right"></div>
    </div>
</div>
<!-- END SLIDER -->