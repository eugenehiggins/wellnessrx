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

/**
 * Add specific fields to the tab Colors -> General
 *
 * @param array $fields
 * @return array
 */
function yit_tab_colors_general( $fields ) {

    return array_merge( $fields, array(
        100 => array(
            'id'   => 'back-top-background',
            'type' => 'colorpicker',
            'name' => __( 'Back to Top background', 'yit' ),
            'desc' => __( 'Select the color to use for Back to Top background. ', 'yit' ),
            'std'  => apply_filters( 'yit_back-top-background_std', '#ffffff' ),
            'style' => apply_filters( 'yit_back-top-background_style', array(
                'selectors' => '#back-top',
                'properties' => 'background-color'
            ) )
        )
    ) );
}
add_filter( 'yit_submenu_tabs_theme_option_colors_general', 'yit_tab_colors_general' );