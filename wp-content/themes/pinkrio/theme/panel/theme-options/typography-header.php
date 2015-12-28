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

function yit_tab_typography_header( $items ) {
    return array_merge( $items, array(
        19 => array(
            'id' => 'header-widget-title',
            'type' => 'typography',
            'name' => __( 'Widget title', 'yit' ),
            'desc' => __( 'Select the color of the widget title in the header. (Default #1d1d1d)', 'yit' ),
            'std'  => apply_filters( 'yit_header-widget-title_std', array(
                'size'   => 18,
                'unit'   => 'px',
                'family' => 'Rokkitt',
                'style'  => 'regular',
                'color'  => '#1d1d1d' 
            ) ),
            'style' => array(
            	'selectors' => '#sidebar-header .widget h3',
            	'properties' => 'font-size, font-family, color, font-style, font-weight'
			)
        ),
        20 => array(
            'id' => 'header-widget-text',
            'type' => 'typography',
            'name' => __( 'Widget text', 'yit' ),
            'desc' => __( 'Select the color of the widget text in the header. (Default #1d1d1d)', 'yit' ),
            'std'  => apply_filters( 'yit_header-widget-text_std', array(
                'size'   => 13,
                'unit'   => 'px',
                'family' => 'Rokkitt',
                'style'  => 'regular',
                'color'  => '#939191' 
            ) ),
            'style' => array(
            	'selectors' => '#sidebar-header .widget p, #sidebar-header .widget div, #sidebar-header .widget li, #sidebar-header .widget blockquote',
            	'properties' => 'font-size, font-family, color, font-style, font-weight'
			)
        ),
    ) );
}
add_filter( 'yit_submenu_tabs_theme_option_typography_header', 'yit_tab_typography_header' );