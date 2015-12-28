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
 
do_action( 'yit_before_logo' ) ?>
<!-- START LOGO -->
<div id="logo" class="group">
    <?php
    /**
     * @see yit_logo
     */
    do_action( 'yit_logo' ) ?> 
</div>
<!-- END LOGO -->
<?php do_action( 'yit_after_logo' ) ?>
<div id="sidebar-header" class="group">
    <?php get_sidebar( 'header' ) ?>
</div>
<div class="clearer"></div>
<hr />
<!-- START MAIN NAVIGATION -->
<?php
/**
 * @see yit_main_navigation
 */
do_action( 'yit_main_navigation') ?>
<!-- END MAIN NAVIGATION -->
<div id="header-shadow"></div>
<div id="menu-shadow"></div>