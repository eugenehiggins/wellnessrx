<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
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
$footer_rows    = yit_get_option( 'footer-rows' );
$footer_columns = yit_get_option( 'footer-columns' );
?>
<!-- START FOOTER -->
<div id="footer">
    <?php for( $i = 1; $i <= $footer_rows; $i++ ) : ?>
    <?php do_action( 'yit_before_footer_row_' . $i ) ?>
    <div class="inner group footer-row-<?php echo $i ?> footer-columns-<?php echo $footer_columns ?>">
        <?php dynamic_sidebar( 'Footer Row ' . $i ) ?>
    </div>
    <?php do_action( 'yit_after_footer_row_' . $i ) ?>
    <?php endfor ?>
</div>
<!-- END FOOTER -->