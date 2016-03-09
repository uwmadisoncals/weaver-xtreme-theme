<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly

$menu = apply_filters('weaverx_menu_name','primary');

if (weaverx_getopt( 'm_primary_hide') != 'hide'
	&& !weaverx_is_checked_page_opt('_pp_hide_menus') ) {

	$use_smart = weaverx_getopt('use_smartmenus') && function_exists('weaverxplus_plugin_installed');

	weaverx_clear_both('menu-primary');

	$class = weaverx_menu_class( 'm_primary' );

	$align = weaverx_getopt( 'm_primary_align' );

	$left = weaverx_getopt('m_primary_html_left');
	$right = weaverx_getopt('m_primary_html_right');

	if ( $left ) {
		$hide = ' ' . weaverx_getopt('m_primary_hide_left');
		$left = '<span class="wvrx-menu-html wvrx-menu-left' . $hide .'">' . do_shortcode( $left ) . '</span>';
		$left = str_replace('%','%%',$left);	// wp_nav_menu uses sprintf! This will almost always fix the issue.
	} elseif (is_customize_preview()) {
		$hide = ' ' . weaverx_getopt('m_primary_hide_left');
		$left = '<span class="wvrx-menu-html wvrx-menu-left' . $hide .'"></span>';
	}


	if ( $right ) {
		$hide = ' ' . weaverx_getopt('m_primary_hide_right');
		$right = '<span class="wvrx-menu-html wvrx-menu-right ' . $hide . '">' . do_shortcode( $right ) . '</span>';
		$right = str_replace('%','%%',$right);	// wp_nav_menu uses sprintf!
	} elseif (is_customize_preview()) {
		$hide = ' ' . weaverx_getopt('m_primary_hide_right');
		$right = '<span class="wvrx-menu-html wvrx-menu-right ' . $hide . '"></span>';
	}


	if ( $use_smart ) {							// ==================  SMART MENUS (make any changes in default menu version, too)
		$hamburger = weaverx_getopt('m_primary_hamburger');
		if ( $hamburger == '' )
			$hamburger = '<span class="genericon genericon-menu"></span>';
		$left = '<span href="" class="wvrx-menu-button">' . "{$hamburger}</span>{$left}";
	}

	$menu_class = apply_filters('weaverx_menu_class', 'weaverx-theme-menu wvrx-menu menu-hover', 'primary');

	if ($align == 'center') {
		$menu_class .= ' wvrx-center-menu';
	} else if ( $align == 'right' ) {
		$menu_class .= ' menu-alignright';
	} else {
		$menu_class .= ' menu-alignleft';
	}

	if ( weaverx_getopt ('m_primary_move') )
		echo "\n\n<div id=\"nav-primary\" class=\"menu-primary menu-primary-moved menu-type-standard\">\n";
	else
		echo "\n\n<div id=\"nav-primary\" class=\"menu-primary menu-primary-standard menu-type-standard\">\n";

	$args = array(
		'fallback_cb' 	  => 'weaverx_page_menu',
		'theme_location'  => $menu,
		'menu_class'      => $menu_class,
		'container'       => 'div',
		'container_class' => 'wvrx-menu-container ' . $class,
		'items_wrap'      => $left . $right .
				'<div class="wvrx-menu-clear"></div><ul id="%1$s" class="%2$s">%3$s</ul><div style="clear:both;"></div>'
	);

	$locations = get_nav_menu_locations();
	if ( isset( $locations[ $menu ] ) ) {
		$the_menu = wp_get_nav_menu_object( $locations[ $menu ] );
		if ( ! empty( $the_menu )) {
			$args['fallback_cb'] = '';
			$args['walker'] = new weaverx_Walker_Nav_Menu();
		}
	}

	wp_nav_menu( $args );

	echo "</div><div class='clear-menu-primary-end' style='clear:both;'></div><!-- /.menu-primary -->\n\n";

	if ($use_smart)
		do_action('weaverx_plus_smartmenu', 'nav-primary', 'm_primary');	// emit required JS to invoke smartmenu
}
?>
