<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly


$menu = apply_filters('weaverx_menu_name','secondary');

if (weaverx_getopt( 'm_secondary_hide') != 'hide' && has_nav_menu( $menu )  && !weaverx_is_checked_page_opt('_pp_hide_menus') ) {

	$class = weaverx_menu_class( 'm_secondary' );

	$left = weaverx_getopt('m_secondary_html_left');
	$right = weaverx_getopt('m_secondary_html_right');

	if ( $left ) {
		$hide = ' ' . weaverx_getopt('m_secondary_hide_left');
		$left = '<span class="wvrx-menu-html wvrx-menu-left' . $hide .'">' . do_shortcode( $left ) . '</span>';
		$left = str_replace('%','%%',$left);	// wp_nav_menu uses sprintf! This will almost always fix the issue.
	} elseif (is_customize_preview()) {
		$hide = ' ' . weaverx_getopt('m_secondary_hide_left');
		$left = '<span class="wvrx-menu-html wvrx-menu-left' . $hide .'"></span>';
	}

	if ( $right ) {
		$hide = ' ' . weaverx_getopt('m_secondary_hide_right');
		$right = '<span class="wvrx-menu-html wvrx-menu-right ' . $hide . '">' . do_shortcode( $right ) . '</span>';
		$right = str_replace('%','%%',$right);	// wp_nav_menu uses sprintf!
	} elseif (is_customize_preview()) {
		$hide = ' ' . weaverx_getopt('m_secondary_hide_right');
		$right = '<span class="wvrx-menu-html wvrx-menu-right ' . $hide . '"></span>';
	}

	$use_smart = weaverx_getopt('use_smartmenus') && function_exists('weaverxplus_plugin_installed');

	if ( $use_smart ) {							// ==================  SMART MENUS
		$hamburger = weaverx_getopt('m_secondary_hamburger');
		if ( $hamburger == '' )
			$hamburger = '<span class="genericon genericon-menu"></span>';
		$left = '<span href="" class="wvrx-menu-button">' . "{$hamburger}</span>{$left}";
	}
	$menu_class = apply_filters('weaverx_menu_class', 'weaverx-theme-menu wvrx-menu menu-hover', 'secondary');

	$align = weaverx_getopt( 'm_secondary_align' );

	if ($align == 'center') {
		$menu_class .= ' wvrx-center-menu';
	} else if ( $align == 'right' ) {
		$menu_class .= ' menu-alignright';
	} else {
		$menu_class .= ' menu-alignleft';
	}

	if ( weaverx_getopt ('m_secondary_move') )
		echo "\n\n<div id=\"nav-secondary\" class=\"menu-secondary menu-secondary-moved menu-type-standard\">\n";
	else
		echo "\n\n<div id=\"nav-secondary\" class=\"menu-secondary menu-secondary-standard menu-type-standard\">\n";

	wp_nav_menu( array(
		'fallback_cb'     => '',
		'theme_location'  => $menu,
		'menu_class'      => $menu_class,
		'container'       => 'div',
		'container_class' => 'wvrx-menu-container ' . $class,
		'items_wrap'      => $left . $right . '<div class="wvrx-menu-clear"></div><ul id="%1$s" class="%2$s">%3$s</ul><div style="clear:both;"></div>',
		'walker'		  => new weaverx_Walker_Nav_Menu()
	));

	echo "\n</div><div class='clear-menu-secondary-end' style='clear:both;'></div><!-- /.menu-secondary -->\n\n";

	if ($use_smart)
		do_action('weaverx_plus_smartmenu', 'nav-secondary', 'm_secondary');	// emit required JS to invoke smartmenu
}
?>
