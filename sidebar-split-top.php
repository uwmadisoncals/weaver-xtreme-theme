<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The Left Split Sidebar if on top
 *
 * @package WordPress
 * @subpackage Weaver X
 * @since Weaver Xtreme 1.0
 */

	$l_area_left = 'l-sb-left-split-top';

	if ( weaverx_getopt('primary_smartmargin') || weaverx_getopt('secondary_smartmargin') ) {
		$l_area_left .= '-rm';
	}

	$class = $l_area_left . ' m-full s-full ' . weaverx_area_class('primary', 'pad', '', 'margin-bottom');

	if ( weaverx_has_widgetarea('primary-widget-area') ) {
		weaverx_put_widgetarea( 'primary-widget-area', $class);
	}
	else if ( !weaverx_has_widgetarea('secondary-widget-area') )
		weaverx_no_sidebars( $class );
?>
