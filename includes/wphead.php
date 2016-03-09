<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
// This file is included from functions.php. It will be loaded only when the wp_head action is called from WordPress.

if ( ! function_exists( 'weaverx_generate_wphead()' ) ) {	/* Allow child to override this */
function weaverx_generate_wphead() {
	/* this guy does ALL the work for generating theme look - it writes out the over-rides to the standard style.css */
	global $weaverx_main_options, $weaverx_cur_page_ID;

	global $post;
	$weaverx_cur_page_ID = 0;	// need this for 404 page when this is not valid
	if (is_object($post))
		$weaverx_cur_page_ID = get_the_ID();	// we're on a page now, so set the post id for the rest of the session

	printf("\n<!-- This site is using %s %s (%s) subtheme: %s -->\n",WEAVERX_THEMENAME, WEAVERX_VERSION, weaverx_getopt('style_version'), weaverx_getopt('themename'));

	do_action('weaverxplus_show_version');

	if ( weaverx_use_inline_css( weaverx_get_css_filename() )) { // generate inline CSS
		echo('<style type="text/css">'."\n");
		if (isset($_REQUEST['wp_customize']))	// don't use cached CSS from customizer
			$css = '';
		else
			$css = weaverx_getopt_default('wvrx_css_saved', '');

		if ( $css == '' || $css[0] != '/' ) {               // there isn't an entry in the DB, so do it on the fly
			require_once(get_template_directory() . '/includes/generatecss.php'); 	// include only now at runtime.
			$output = weaverx_f_open('php://output','w+');
			weaverx_output_style( $output );
		} else {
			weaverx_echo_css( $css );
		}
		echo("\n</style> <!-- end of main options style section -->\n");
	} else { // include generated file
		$vers = weaverx_getopt('style_version');
		if (!$vers)
			$vers = '1';
		else
			$vers = sprintf("%d",$vers);
		wp_enqueue_style('weaverxp-style-sheet',weaverx_get_css_url(),array('weaver-root-style-sheet'),$vers);
		wp_enqueue_style('weaverxp-style-sheet');
	}

   /* now head options */
	weaverx_echo_css( weaverx_getopt('_althead_opts') );
	weaverx_echo_css( weaverx_getopt('head_opts') );   /* let the user have the last word! */

	$per_page_code = weaverx_get_per_page_value('page-head-code');
	if (!empty($per_page_code)) {
		weaverx_echo_css($per_page_code);
	}


	if ( weaverx_is_checked_page_opt('_pp_hide_site_title') )	/* best to just do this inline */
		echo ('<style type="text/css">#site-title,#site-tagline{display:none;}#nav-header-mini{margin-top:32px!important;}</style>' . "\n");

	if ( $ppsb = weaverx_get_per_page_value( '_pp_sidebar_width' ) > 0 ) {
		require_once(get_template_directory() . '/includes/generatecss.php'); 	// include only now at runtime.
		$ppsb = weaverx_get_per_page_value( '_pp_sidebar_width' );
		echo "<style type=\"text/css\"> /* Per Page Sidebar Width */\n";
		weaverx_sidebar_style( 'echo', $ppsb );
		echo "</style>\n";
	}

	echo("\n<!-- End of Weaver Xtreme options -->\n");
}
}

?>
