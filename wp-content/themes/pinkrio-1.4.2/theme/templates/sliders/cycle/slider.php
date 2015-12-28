<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
$thumbs = ''; 
$slider_type = yit_slide_get( 'slider_type' );
$height = yit_slide_get('height');
$height = empty( $height ) ? 485 : $height;
?>
 
<!-- START SLIDER -->
<div id="slider-<?php echo $current_slider ?>"<?php yit_slider_class('slider_cycle group') ?> style="height:<?php echo $height ?>px;"> 
    <ul class="slider">
        <?php if( !yit_is_empty() ): ?>
            <?php while( yit_have_slide() ) : 
                      $paths = wp_upload_dir();
                          
                      $image_url = yit_slide_get( 'image_url' );
                      $image_path = str_replace( $paths['baseurl'], $paths['basedir'], $image_url );     
                      $image_path = str_replace( site_url(), ABSPATH, $image_path );                    
                      $background_color = yit_slide_get( 'background_color' );   
                      
                      $title_color   = yit_light_or_dark( $background_color, yit_slide_get( 'dark_color' ), yit_slide_get( 'light_color' ) );
                      $content_color = yit_light_or_dark( $background_color, yit_slide_get( 'dark_color' ), yit_slide_get( 'light_color' ) );
                      
                      if( file_exists( $image_path ) ):     
                          list($width, $height, $type, $attr) = getimagesize($image_path);
                          if( $width > 960 ): ?>
                              <li>
                                <div class="slide-holder" style="background: <?php echo $background_color ?> url('<?php echo $image_url ?>') no-repeat center center" style="height:<?php echo $height ?>px;">
                                    <div class="slide-content-holder inner" style="height:<?php echo $height ?>px;">
                                        <?php if( yit_slide_get( 'title' ) || yit_slide_get( 'content' ) ): ?>
                                            <div class="slide-content-holder-content" style="position: absolute; <?php echo yit_slide_get_style( yit_slide_get( 'position_text' ) ) ?>">
                                                <?php if( yit_slide_get( 'title' ) ): ?><div class="slide-title"><h2 style="color:<?php echo $title_color ?>"><?php echo yit_decode_title( yit_slide_get( 'title' ) ) ?></h2></div><?php endif ?>
                                                <?php if( yit_slide_get( 'content' ) ): ?><div class="slide-content" style="color:<?php echo $content_color ?>"><?php echo yit_decode_title( yit_slide_get( 'content' ) ) ?></div><?php endif ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                              </li>
                          <?php else: ?>
                              <li>
                                <div class="slide-holder" style="background: <?php echo  ! empty( $background_color ) ? yit_slide_the( 'background_color' ) : 'transparent' ?>">
                                    <div class="slide-content-holder inner">
                                        <?php if( yit_slide_get( 'title' ) || yit_slide_get( 'content' ) ): ?>
                                            <div class="slide-content-holder-content" style="position: absolute; <?php echo yit_slide_get_style( yit_slide_get( 'position_text' ) ) ?>">
                                                <?php if( yit_slide_get( 'title' ) ): ?><div class="slide-title"><h2 style="color:<?php echo $title_color ?>"><?php yit_slide_the( 'title' ) ?></h2></div><?php endif ?>
                                                <?php if( yit_slide_get( 'content' ) ): ?><div class="slide-content" style="color:<?php echo $content_color ?>"><?php yit_slide_the( 'content' ) ?></div><?php endif ?>
                                            </div>
                                        <?php endif; ?>
                                            
                                        <div style="position: absolute; <?php echo yit_slide_get_style( yit_slide_get( 'position_image' ) ) ?>">
                                            <?php yit_slide_the( 'featured-content', array( 'container' => false) ) ?>
                                        </div>
                                    </div>
                                </div>
                              </li>
                    <?php endif; ?>
                <?php endif ?>
            <?php endwhile; ?>
        <?php else: ?>
                              <li>
                                <div class="slide-holder" style="background: #CBCACA">
                                    <div class="slide-content-holder inner"></div>
                                </div>
                              </li>
        <?php endif ?>
    </ul>                     

    <?php if( yit_slide_get( 'enable_widget_area' ) ):
        global $wp_registered_sidebars;         
        
        $sidebar = sanitize_title( yit_slide_get( 'sidebar' ) );       
    
        // yit widget area columns                      
        $sidebars = wp_get_sidebars_widgets();
        $cols = 0;  
        if ( ! empty( $sidebars[$sidebar] ) ) {           
            foreach ( $sidebars[$sidebar] as $widget ) {
                $cols++;
                if ( preg_match( '/yit_text_quote/', $widget ) )
                    $cols++;    
            }
            
            switch ( $cols ) {
                case 1 : $yit_class = 'only-one'; break;
                case 2 : $yit_class = 'two-fourth'; break;
                case 3 : $yit_class = 'one-third'; break;
                default : $yit_class = 'one-fourth'; break;
            }
            
            $widget_class = "yit-widget widget col1_$cols $yit_class col";
            $wp_registered_sidebars[$sidebar]['before_widget'] = '<div id="%1$s" class="' . $widget_class . ' %2$s">';
            //yit_debug( $wp_registered_sidebars[$sidebar] );
    ?>
        <div id="yit-widget-area" class="group">
            <div class="yit-widget-content inner group">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar ) ) ?>
            </div>
        </div>
    <?php } endif ?>
</div>
        
    <script type="text/javascript">
        jQuery(document).ready(function($){
            
            var     yit_slider_cycle_fx = 'easing',
                    yit_slider_cycle_speed = <?php echo yit_slide_get('speed') * 1000 ?>,
                    yit_slider_cycle_timeout = <?php echo yit_slide_get('interval') * 1000 ?>,
                    yit_slider_cycle_directionNav = <?php yit_slide_the('directionNav', array( 'bool' => true )) ?>,
                    yit_slider_cycle_directionNavHide = <?php yit_slide_the('directionNavHide', array( 'bool' => true )) ?>, 
                    yit_slider_cycle_autoplay = <?php yit_slide_the('autoplay', array( 'bool' => true )) ?>;
                    
            var yit_widget_area_position = function(){
                $('#yit-widget-area').css({ top: 33 - $('#yit-widget-area').height() });
            };
            $(window).resize(yit_widget_area_position);
            yit_widget_area_position();
            
            if( $.browser.msie && parseInt($.browser.version.substr(0,1),10) <= '8' ) {
                $('#slider-<?php echo $current_slider ?> ul.slider').anythingSlider({
                     expand              : true,
                     startStopped        : false,
                     buildArrows         : yit_slider_cycle_directionNav,
                     buildNavigation     : false,
                     buildStartStop      : false,
                     delay               : yit_slider_cycle_timeout,
                     animationTime       : yit_slider_cycle_speed,
                     easing              : yit_slider_cycle_fx,
                     autoPlay            : yit_slider_cycle_autoplay ? true : false,
                     pauseOnHover        : true, 
                     toggleArrows        : false,
                     resizeContents      : true
                });
            } else {
                $('#slider-<?php echo $current_slider ?> ul.slider').anythingSlider({
                     expand              : true,
                     startStopped        : false,
                     buildArrows         : yit_slider_cycle_directionNav,
                     buildNavigation     : false,
                     buildStartStop      : false,
                     delay               : yit_slider_cycle_timeout,
                     animationTime       : yit_slider_cycle_speed,
                     easing              : yit_slider_cycle_fx,
                     autoPlay            : yit_slider_cycle_autoplay ? true : false,
                     pauseOnHover        : true, 
                     toggleArrows        : yit_slider_cycle_directionNavHide ? true : false,
                     onSlideComplete     : function(slider){},
                     resizeContents      : true,
                     onSlideBegin        : function(slider) {
//                        var div = $(".activePage  .slide-content-holder-content")



//                         $(".slide-content-holder > div")
//                            .fadeTo( 300, 0);
                     },
                     onSlideComplete     : function(slider) {

//                        var div = $(".activePage  .slide-content-holder-content");
//                        div.show("slide", { direction: "left" }, 1000);


//                         var margin = parseInt($(".activePage .slide-content-holder > div").css('margin-left').replace(/[^-\d\.]/g, ''),10);
//                         $(".activePage .slide-content-holder > div").css('margin-left', (margin+1500) + 'px');
//                         $(".activePage .slide-content-holder > div").animate({"left": "-=1500px", "opacity" : "1"}, "slow");
                     }
                });
                
            }
        });
   </script>