<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * @package WordPress
 * @subpackage weaverx
 */

if ( has_nav_menu('header-mini')) {     // weaverx_getopt( 'm_header_mini_hide') != 'hide' &&

	$class = weaverx_menu_class( 'm_header_mini' );

	echo "\n\n<div id=\"nav-header-mini\" class=\"menu-horizontal {$class}\">\n";
	// echo '<span style="display:inline;float:left;color:yellow;padding-top:.2em;">LEFT</span>';
	wp_nav_menu( array(
		'fallback_cb'     => '',
		'theme_location'  => 'header-mini',
		'menu_class'      => 'wvrx-header-mini-menu',
		'container'       => 'div',
		'container_class' => ''
	));
	// echo '<span style="display:inline;float:right;">RIGHT</span>';
	weaverx_clear_both('header-mini');
	echo "\n</div><!-- /#nav-header-mini -->\n";
	weaverx_clear_both('nav-header-mini');
}
?>
