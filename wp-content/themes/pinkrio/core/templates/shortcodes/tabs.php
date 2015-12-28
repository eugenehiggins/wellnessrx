<?php
	$html = '<div class="tabs-container">'."\n";
    $html .= '    <ul class="tabs">'."\n";
    
    for($i = 1; isset(${'tab'.$i}) && ${'tab'.$i} != ''; $i++ ) {
    	$html .= '<li><h4><a href="#tab' . $i . '" title="' . ${'tab'.$i} . '">' . ${'tab'.$i} . '</a></h4></li>'."\n";		
    }
        
    //$html .= '<li><h4><a href="#tab1" title="'.$tab1.'">'.$tab1.'</a></h4></li>'."\n";
    //$html .= '<li><h4><a href="#tab2" title="'.tab2.'">'.$tab2.'</a></h4></li>'."\n";
        
        
    
    $html .= '    </ul>'."\n";
    
    $html .= '<div class="border-box group">' . do_shortcode($content) . '</div>';
    
    $html .= '</div>'."\n";
?>

<?php echo $html; ?>