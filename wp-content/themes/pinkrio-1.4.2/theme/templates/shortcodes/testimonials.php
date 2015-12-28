<?php
	wp_reset_query();
    
    $args = array(
        'post_type' => 'testimonial'
    );
	
	$args['posts_per_page'] = (isset($items) && $items != '') ? $items : -1;
	
	$tests = new WP_Query( $args );   
    
    if( !$tests->have_posts() ) return false;
    
    //loop 
	$last = 1;	
    while( $tests->have_posts() ) : $tests->the_post();
		$fulltext = '';
		$text = (strcmp(yit_get_option('text-type-testimonials'), 'content') == 0) ? get_the_content() : get_the_excerpt();
        
		$title = (yit_get_option('link-testimonials')) ? the_title( '<a href="' . get_permalink() . '" class="name">', '</a>', false ) : the_title('<p class="name">', '</p>',false);
		$label = yit_get_post_meta( get_the_ID(), '_site-label' );
		$siteurl = yit_get_post_meta( get_the_ID(), '_site-url' );
		$website = '';
		if ($siteurl != ''):
			if ($label != ''):
				$website = '<a class="website" href="' . esc_url($siteurl) . '">' . $label . '</a>';
			else:
				$website = '<a class="website" href="' . esc_url($siteurl) . '">' . $siteurl . '</a>';
			endif;
		endif;
		?>
		<div class="testimonial two-fourth <?php echo ($last % 2) ? '' : 'last'; ?>">
	        <?php if (yit_get_option('thumbnail-testimonials') && get_the_post_thumbnail( null, 'thumb-testimonial' )) :  ?>
		        <div class="thumbnail">
		        	<?php echo get_the_post_thumbnail( null, 'thumb-testimonial' ); ?>   
		        </div>
	        <?php 
				else:
					$fulltext = '-full';					
	        	endif; ?>
			<div class="testimonial-text<?php echo $fulltext; ?>"><?php echo wpautop( $text ); ?></div>
	        <div class="testimonial-name"><?php echo $title . $website; ?></div>
        </div>
		<?php $last++;
    endwhile;
?>