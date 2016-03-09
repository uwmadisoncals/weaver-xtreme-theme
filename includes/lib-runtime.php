<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* Weaver Xtreme - runtime utils
 *
 *  __ added - 12/11/14
 * needed both at admin time and runtime
 */

// # CONTENTS

// # OPTIONS
// # PER PAGE OPTIONS
// # WIDGET AREA OPTIONS
// # HTML CODE AREAS
// # RUNTIME SAPI HELPER FUNCTIONS
// # PAGE WITH POSTS
// # FILTERS
// # MISC
// # OTHER UTILS

// # Weaver Xtreme Globals ==============================================================
$weaverx_opts_cache = false;	// internal cache for all settings
$weaverx_cur_page_ID = false;	// the ID of the current page
$weaverx_cur_post_count = 0;	// to keep track of even/odd
$weaverx_cur_template = '';	// current page template - set in functions.php setup
$weaverx_header = array();	    // as of WP 3.4
$weaverx_sticky = false;

// # OPTIONS ==============================================================

function weaverx_getopt($opt) {
	global $weaverx_opts_cache;

	weaverx_opt_cache();
	/*
	if ($opt == 'wrapper_bgcolor')
		echo "<h2>wrapper_bgcolor: {$weaverx_opts_cache['wrapper_bgcolor']}</h2>"; */

	if (!isset($weaverx_opts_cache[$opt])) {	// handles changes to data structure
		return false;
	}
	return $weaverx_opts_cache[$opt];
}

function weaverx_getopt_array($opt) {
	$val = weaverx_getopt($opt);
	if (!$val)
		return array();
	return unserialize($val);
}


function weaverx_getopt_default( $opt, $default=false ) {
	$val = weaverx_getopt( $opt);
	if ( (!$val && strlen($val) == 0) || $val == 'default' )
		return $default;
	else
		return $val;
}

function weaverx_getopt_checked($opt) {
	global $weaverx_opts_cache;
	weaverx_opt_cache();

	if (!isset($weaverx_opts_cache[$opt])) {	// handles changes to data structure
		return false;
	}
	if (!$weaverx_opts_cache[$opt]) return false;
	return true;
}

function weaverx_opt_cache() {
	// load the options cache - only weaverx_settings in basic version
	global $weaverx_opts_cache;

	if (!$weaverx_opts_cache) {
		$weaverx_opts_cache = apply_filters('weaverx_switch_theme',
			get_option(apply_filters('weaverx_options','weaverx_settings') ,array()));	// start with the default
		//weaverx_alert('Options Loaded');
	}
}

function weaverx_clear_opt_cache($who = 'unknown') {
	global $weaverx_opts_cache;
	$weaverx_opts_cache = false;
	//weaverx_alert('Cache cleared:' . $who);
}

function weaverx_setopt($opt, $val, $save = true) {
	global $weaverx_opts_cache;
	weaverx_opt_cache();

	$weaverx_opts_cache[$opt] = $val;
	if ($save)
		weaverx_wpupdate_option('weaverx_settings',$weaverx_opts_cache);
}

function weaverx_setopt_array($opt, $val, $save = true) {
	weaverx_setopt( $opt, serialize($val), $save );
}

function weaverx_delete_all_options() {
	weaverx_clear_opt_cache('weaverx_delete_all_options');

	if (current_user_can( 'manage_options' ))
		delete_option( apply_filters('weaverx_options','weaverx_settings') );
}

function weaverx_wpupdate_option( $name, $opts ) {
	if (current_user_can( 'manage_options' )) {
		$compressed = array_filter( $opts, 'weaverx_optlen'); // filter out all null options (strlen == 0)
		$option = apply_filters('weaverx_options',$name);
		update_option($option, $compressed);
	}
}

function weaverx_optlen( $opt ) {
	if ( ! is_array($opt) )     // opts can contain arrays
		return strlen( $opt );
	else
		return 1;
}

function weaverx_update_options($id) {
	global $weaverx_opts_cache;
	if (!$weaverx_opts_cache)
		$weaverx_opts_cache = get_option( apply_filters('weaverx_options','weaverx_settings') ,array());
	weaverx_wpupdate_option('weaverx_settings',$weaverx_opts_cache);
}


function weaverx_save_opts($who='', $bump = true) {
	// Save options
	// Here's the strategy. Using weaverx_getopt always loads the cache if it hasn't been.
	// Using weaverx_setopt will save the cache to the database by default
	// So we take advantage of this by bumping the style version, and using weaverx_setopt,
	// which saves to the database

	//$vers = weaverx_getopt('style_version');
	if ($who == 'customizer') {				// really need to refresh the cache
		weaverx_clear_opt_cache($who);
		$old = weaverx_getopt('style_date'); // and reload the cache
	}

	if ($bump) {
		//$vers = $vers ? $vers + 1 : 1;	// bump or init

		// put the CSS into the DB
		require_once(get_template_directory() . '/includes/generatecss.php');
		unset( $GLOBALS['wvrx_css_saved'] );
		$GLOBALS['wvrx_css_saved'] = '';
		weaverx_f_write('wvrx_css_saved', '/* -wvrx_css- */');
		weaverx_output_style('wvrx_css_saved');
		weaverx_setopt('wvrx_css_saved', $GLOBALS['wvrx_css_saved'] );
		unset( $GLOBALS['wvrx_css_saved'] );
	}

	weaverx_setopt('style_date', date('Y-m-d-H:i:s'), $bump);

	//weaverx_setopt('style_version',$vers, $bump);	// update options, style version

	if (weaverx_f_file_access_available()) {	// and now is the time to update the style file
		require_once(get_template_directory() . '/includes/generatecss.php');
		weaverx_fwrite_current_css();
	}
}

function weaverx_e_opt($opt,$str) {
	if (weaverx_getopt_checked($opt))
		echo $str;
}

function weaverx_e_notopt($opt,$str) {
	if (!weaverx_getopt_checked($opt))
		echo $str;
}



// # PER PAGE OPTIONS =========================================================
function weaverx_get_per_page_value($name) {
	global $weaverx_cur_page_ID;
	return get_post_meta($weaverx_cur_page_ID,$name,true);
	//return get_post_meta(get_the_ID(),$name,true);

}

function weaverx_get_per_post_value($meta_name) {
	return get_post_meta(get_the_ID(),$meta_name,true);  // retrieve meta value
}

function weaverx_is_checked_post_opt($meta_name) {
	// the standard is to check options to hide things
	$val = get_post_meta(get_the_ID(),$meta_name,true);  // retrieve meta value
	if (!empty($val)) return true;		// value exists - 'on'
	return false;
}

function weaverx_is_checked_page_opt($meta_name) {
	// the standard is to check options to hide things
	global $weaverx_cur_page_ID;

	$val = get_post_meta($weaverx_cur_page_ID,$meta_name,true);  // retrieve meta value
	if (!empty($val)) return true;		// value exists - 'on'
	return false;
}

function weaverx_page_posts_error($info='') {
	echo('<h2 style="color:red;">' . __('WARNING: error defining Custom Field on Page with Posts.', 'weaver-xtreme' /*adm*/) . '</h2>');
	if (strlen($info) > 0) echo('More info: '.$info.'<br />');
}




// # PAGE WITH POSTS ==============================================================

function weaverx_get_page() {
	/* get the current posts display number
	  needed for when Page with Posts is front page
	*/
	$paged = get_query_var('paged');
	if (!isset($paged) || empty($paged)) {
		$paged = 1;
	}
	$page = get_query_var( 'page' );
	if ( $page > 1)
		$paged = $page;
	return $paged;
}

function weaverx_setup_post_args($args) {
   /* setup WP_Query arg list */

	$cats = weaverx_get_page_categories();
	if (!empty($cats)) $args['cat'] = $cats;

	$tags = weaverx_get_page_tags();
	if (!empty($tags)) $args['tag'] = $tags;

	$onepost = weaverx_get_page_onepost();
	if (!empty($onepost)) $args['name'] = $onepost;

	$orderby = weaverx_get_page_orderby();
	if (!empty($orderby)) $args['orderby'] = $orderby;

	$order = weaverx_get_page_order();
	if (!empty($order)) $args['order'] = $order;

	$author_name = weaverx_get_page_author();
	if (!empty($author_name)) {
		$nosp = str_replace(' ', '', $author_name);
		$id_list=str_replace(',','',$nosp);
		if (is_numeric($id_list)) {
			$args['author'] = $author_name;
		} else {
			$args['author_name'] = $author_name;
		}
	}

	$posts_per_page = weaverx_get_page_posts_per();
	if (!empty($posts_per_page)) $args['posts_per_page'] = $posts_per_page;

	$post_type = weaverx_get_per_page_value('_pp_post_type');
	if ($post_type)
		$args['post_type'] = $post_type;

	if (weaverx_is_checked_page_opt('_pp_hide_sticky')) $args['ignore_sticky_posts'] = true;

	return $args;
}

function weaverx_get_page_categories() {
	$cats = weaverx_get_per_page_value('_pp_category');
	if (empty($cats)) return '';
	// now convert slugs to ids
	return weaverx_cat_slugs_to_ids($cats);
}

function weaverx_cat_slugs_to_ids($cats) {
	if (empty($cats)) return '';

	// now convert slugs to numbers
	$cats = str_replace(' ','',$cats);
	$clist = explode(',',$cats);	// break into a list
	$cat_list = '';
	foreach ($clist as $slug) {
	$neg = 1;	// not negative
		if ($slug[0] == '-') {
			$slug = substr($slug,1);	// zap the -
			$neg = -1;
		}
		if (strlen($slug) > 0 && is_numeric($slug)) { // allow both slug and id
			$cat_id = $neg * (int)$slug;
			if ($cat_list == '') $cat_list = strval($cat_id);
			else $cat_list .= ','.strval($cat_id);
		} else {
			$cur_cat = get_category_by_slug($slug);
			if (is_object($cur_cat)) {
				$cat_id = $neg * (int)$cur_cat->cat_ID;
				if ($cat_list == '') $cat_list = strval($cat_id);
				else $cat_list .= ','.strval($cat_id);
			}
		}
	}
	if (empty($cat_list)) $cat_list='99999999';
	return $cat_list;
}

function weaverx_get_page_tags() {
	$tags = weaverx_get_per_page_value('_pp_tag');
	if (empty($tags)) return '';
	return str_replace(' ','',$tags);
}

function weaverx_get_page_onepost() {
	$the_post = weaverx_get_per_page_value('_pp_onepost');
	if (empty($the_post)) return '';
	return $the_post;
}

function weaverx_get_page_orderby() {
	$orderby = weaverx_get_per_page_value('_pp_orderby');
	if (empty($orderby)) return '';

	if ($orderby == 'author' || $orderby == 'date' || $orderby == 'title' || $orderby == 'rand')
		return $orderby;
	weaverx_page_posts_error(__('orderby must be author, date, title, or rand. You used: ', 'weaver-xtreme' /*adm*/). $orderby);
	return '';
}

function weaverx_get_page_order() {
	$order = weaverx_get_per_page_value('_pp_sort_order');
	if (empty($order)) return '';
	if ($order == 'ASC' || $order == 'DESC')
		return $order;
	weaverx_page_posts_error(__('order value must be ASC or DESC. You used: ', 'weaver-xtreme' /*adm*/). $order);
	return '';
}

function weaverx_get_page_posts_per() {
	$ppp = weaverx_get_per_page_value('_pp_posts_per_page');
	if (empty($ppp)) return '';
	// now convert slugs to numbers
	return $ppp;
}

function weaverx_get_page_author() {
	$author = weaverx_get_per_page_value('_pp_author');
	if (empty($author)) return '';
	return $author;
}


// # FILTERS ==============================================================

//  ============ validation filters ===============

function weaverx_filter_textarea( $text ) {
	// virtually all option text input from Weaver Xtreme can be code, and thus must not be
	// content filtered. Treat like code for now....
	return weaverx_filter_code($text);
}

function weaverx_esc_textarea($text, $echo=true) {
	if ( current_user_can('unfiltered_html') )
		$out = esc_textarea($text);
	else
		$out = esc_textarea(stripslashes($text));
	if ($echo)
		echo $out;
	else
		return $out;
}

function weaverx_filter_head( $text ) {

	$allowed_head_tags = array(
		'title' => array(),
		'style' => array( 'media' => true, 'scoped' => true, 'type' => true ),
		'meta' => array( 'charset' => true, 'content' => true, 'http-equiv' => true, 'name' => true,
						'scheme' => true, 'property'=> true ),
		'link' => array( 'href' => true, 'rel' => true, 'type' => true, 'title' => true, 'media' => true, 'id' => true, 'class' => true  ),
		'script' => array( 'async' => true, 'charset' => true, 'defer' => true, 'src' => true, 'type' => true  ),
		'noscript' => array(),
		'base' => array( 'href' => true, 'target' => true )
		);

	// restrict head code to valid stuff for <head>

	$noslash = trim(stripslashes($text));

	if ($noslash == '') return '';

	if ( current_user_can('unfiltered_html') ) {
		if (strpos( $noslash, '<script') !== false)
			return wp_check_invalid_utf8( $noslash );	// stop <script>s from being broken
		return wp_kses( $noslash, $allowed_head_tags);
	} else {
		return ''; // wp_filter_post_kses() handles slashes
	}
}

function weaverx_filter_code( $text ) {

	// Much option input from Weaver Xtreme can be code, and thus must not be
	// content filtered - at least for admins. The utf8 check is about the extent of it, although even
	// that is more restrictive than the standard text widget uses.
	// Note: this check also works OK for simple checkboxes/radio buttons/selections,
	// so it is ok to blindly pass those options in here, too.
	//$noslash = trim(stripslashes($text));
	$trimmed = trim($text);

	if ($trimmed == ' ') return '';

	if ( current_user_can('unfiltered_html') ) {
		return wp_check_invalid_utf8( $trimmed );
	} else {
		return wp_filter_post_kses( $trimmed ); // wp_filter_post_kses() handles slashes
	}
}

function weaverx_echo_css( $css ) {
	if ( is_multisite() ) {
		// non-superadmins have some filtering on CSS - this will fix it.
		//$css = stripslashes($css);
		$css = str_replace( array('&lt;','&gt;'), array('<','>'), $css);
	}
	echo $css;
}

// # MISC ==============================================================
function weaverx_header_widget_area( $where_now ) {	// header.php support
	// 'top' => 'Top of Header'
	// 'after_header' => 'After Header Image'
	// 'after_html' => 'After HTML Block'
	// 'after_menu' => 'After Main Menu'

	$sb_position = weaverx_getopt_default('header_sb_position', 'top');
	if ( $sb_position == $where_now && weaverx_has_widgetarea('header-widget-area') ) {
		$p_class = weaverx_area_class('header_sb', 'notpad', '-none', 'margin-none');
		//weaverx_clear_both('header_sb');
		weaverx_put_widgetarea('header-widget-area', $p_class, 'header');
		if (weaverx_getopt('header_sb_align') == 'float-right')
			weaverx_clear_both('header-widget-area');
	}
}

function weaverx_add_ie_scripts() {
	echo '<!--[if lt IE 9]>
<script src="' . esc_url(get_template_directory_uri()) . '/assets/js/html5.js" type="text/javascript"></script>
<script src="' . esc_url(get_template_directory_uri()) . '/assets/js/respond.min.js" type="text/javascript"></script>
<![endif]-->';
}

function weaverx_media_lib_button($fillin = '') {
?>
&nbsp;&larr;&nbsp;<a style='text-decoration:none;' title="<?php _e('Select image from Media Library. Click \'Insert into Post\' to paste url here.', 'weaver-xtreme' /*adm*/); ?>" alt="media" href="javascript:weaverx_media_lib('<?php echo $fillin;?>');" ><span style="font-size:16px;margin-top:2px;" class="dashicons dashicons-format-image"></span></a>
<?php
}


function weaverx_site($sub='', $site = '//weavertheme.com', $title = '', $echo = true) {
	if ($site == '') $site = '//weavertheme.com';
	if ($title == '') $title = $site;
	$link = '<a href="' . esc_url($site . $sub) . '" target="_blank" title="' . $title . '" rel="nofollow">';
	if ($echo)
		echo $link;
	else
		return $link;
}



function weaverx_post_count_clear() {
	global $weaverx_cur_post_count;
	$weaverx_cur_post_count = 0;
}



function weaverx_post_count_bump() {
	global $weaverx_cur_post_count;
	$weaverx_cur_post_count++;
}



function weaverx_post_count() {
	global $weaverx_cur_post_count;
	return $weaverx_cur_post_count;
}


function weaverx_archive_loop( $type ) {
	// output loop for archive-like pages.

	$num_cols = weaverx_getopt('blog_cols');
	$archive_cols = weaverx_getopt('archive_cols');

	if (!$num_cols || $num_cols > 3) $num_cols = 1;

	if (!$archive_cols)
		$num_cols = 1;

	$masonry_wrap = false;	// need this for one-column posts
	$col = 0;

	weaverx_post_count_clear();
	echo ("<div class=\"wvrx-posts\">\n");		// needed here, and all post loops to make content-n-col work with :nth-of-type

	if ($archive_cols && weaverx_masonry('begin-posts'))	// wrap all posts
		$num_cols = 1;		// force to 1 cols

	while ( have_posts() ) {
		the_post();
		weaverx_post_count_bump();

		if ($archive_cols) weaverx_masonry('begin-post');	// wrap each post
		switch ($num_cols) {
			case 1:
				get_template_part( 'templates/content', get_post_format() );
				break;

			case 2:
				$col++;
				echo ('<div class="content-2-col">' . "\n");
				get_template_part( 'templates/content', get_post_format() );
				echo ("</div> <!-- content-2-col -->\n");
				break;

			case 3:
				$col++;
				echo ('<div class="content-3-col">' . "\n");
				get_template_part( 'templates/content', get_post_format() );
				echo ("</div> <!-- content-3-col -->\n");
				break;

			default:
				get_template_part( 'templates/content', get_post_format() );
		}   // end switch num cols
		if ($archive_cols) weaverx_masonry('end-post');

	}	// end while have posts
	if ($archive_cols)
		weaverx_masonry('end-posts');
	echo ("</div> <!-- .wvrx-posts -->\n");

}

function weaverx_post_class($hidecount = false) {
	global $weaverx_cur_post_count;
	global $weaverx_sticky;

	if ($weaverx_sticky)	// For page with posts - re-ordering sticky posts
		$postclass = 'post-area sticky ';
	else
		$postclass = 'post-area  ';

	if ($weaverx_cur_post_count != 0 && !$hidecount)
		$postclass .= 'post-' . (($weaverx_cur_post_count % 2) ? 'odd' : 'even') . ' post-order-' . $weaverx_cur_post_count
	 .  ' ';

	return $postclass . weaverx_area_class('post', 'pad', '-tb', 'margin-bottom' );
}



function weaverx_use_inline_css($css_file) {
	return weaverx_getopt_checked('_inline_style') || !weaverx_f_file_access_available()
		|| !weaverx_f_exists($css_file) || isset($_REQUEST['wp_customize']);
											// also force inline from customizer
}



function weaverx_allow_multisite() {
	// return true if it is allowed to use on MultiSite

	$restrict =  (defined('WVRX_MULTISITE_RESTRICT_OPTIONS')) ? WVRX_MULTISITE_RESTRICT_OPTIONS : false;

	return ((!is_multisite() && current_user_can('install_themes'))
	|| (is_multisite() && current_user_can('manage_network_themes'))
	|| !$restrict);
}



function weaverx_help_link($link, $info, $alt_label = '', $echo = true) {
	/*. '<img class="entry-cat-img" src="' . esc_url($t_dir . 'assets/images/help-1.png') . '" style="position:relative; top:4px; padding-left:4px;" title="Click for help" alt="Click for help" /> */

	$t_dir = weaverx_relative_url('') . 'help/' . $link;

	$alt_trans = $link;

	$hash = strpos($alt_trans, '#');
	if ( $hash !== false ) {
		$alt_trans = substr( $alt_trans, 0, $hash ); // kill off any # anchor
	}

	$locale = apply_filters('theme_locale', get_locale(), 'weaver-xtreme');
//weaverx_alert('ALT TRANS:' . WP_LANG_DIR . '/weaver-xtreme/' . $locale . '_' . $alt_trans );

	if ( weaverx_f_exists(WP_LANG_DIR . '/weaver-xtreme/' . $locale . '_' . $alt_trans ) ) {	// works for default installation
		$t_dir = content_url() . '/languages/weaver-xtreme/' . $locale . '_' . $link;
	}

	if ( !$alt_label )
		$alt_label = '<span style="color:red; vertical-align: middle; margin-left:.25em;" class="dashicons dashicons-editor-help"></span>';

	$out =  '<a style="text-decoration:none;" href="' . esc_url($t_dir) . '" target="_blank" title="' . $info . '">'
		. $alt_label . '</a>';
	if ($echo)
		echo $out;
	else
		return $out;
}



function weaverx_html_br() {
	echo ' <br /> ';
}



function weaverx_compact_post() {
	return weaverx_getopt('compact_post_formats') || weaverx_is_checked_page_opt('_pp_pwp_compact');
}



function weaverx_get_first_post_image($content='') {
	if (has_post_thumbnail()) {
		$img = wp_get_attachment_image_src( get_post_thumbnail_id( ), 'medium' );
		return '<img class="format-image-img" src="' . esc_url($img[0]) . '" "alt="post image" />';
	}

	if ($content == '')
		$content = do_shortcode(apply_filters( 'the_content', get_the_content('')));	// pick up wp 3.6 post format meta image
	if (preg_match('/<img[^>]+>/i',$content, $images)) {	// grab <img>s
		$src = '';
		if (preg_match('/src="([^"]*)"/', $images[0], $srcs)) {
			$src = $srcs[0];
		} else if (preg_match("/src='([^']*)'/", $images[0], $srcs)) {
			$src = $srcs[0];
		}
		return '<img class="format-image-img" ' . $src . 'alt="post image" />';
	} else {
		return '';
	}
}



function weaverx_compact_link($check = '') {
	if ($check == 'check' && !weaverx_is_checked_post_opt('_pp_post_add_link'))
		return;

	$link_img =  weaverx_relative_url('') . 'assets/images/expand.png';
?>
	<div><a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute( 'echo=1' ); ?>" rel="bookmark">
<img src="<?php echo esc_url($link_img); ?>" /></a></div>
<?php
}



if (!function_exists('weaverx_breadcrumb')) {
function weaverx_breadcrumb($echo = true, $pwp = '' ) {
/* Breadcrumbs
 * Credit: Dimox
 *	http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 */
	$wrap = 'breadcrumbs';
	$bc = '';

	$containerBefore = '<span id="' . $wrap . '">';
	$containerAfter = '</span>';
	$containerCrumb = '<span class="crumbs">';
	$containerCrumbEnd = '</span>';
	$delimiter = '&rarr;'; //' &raquo; ';

	$baseLink = '';
	$hierarchy = '';
	$currentLocation = '';
	$currentBefore = '<span class="bcur-page">';
	$currentAfter = '</span>';
	$currentLocationLink = '';
	$crumbPagination = '';

	if ( weaverx_getopt('menu_nohome')) {
		$name = weaverx_getopt('info_home_label') ? weaverx_getopt('info_home_label') : esc_attr( get_bloginfo( 'name', 'display' ) );
	} else {
		$name = weaverx_getopt('info_home_label') ? weaverx_getopt('info_home_label') : __('Home','weaver-xtreme'); //text for the 'Home' link
	}


	global $post;

	if ( $pwp ) {
		$name = $pwp;
	}

	$bc = '';
	// Output the Base Link
	if ( is_front_page() ) {
		$bc .= $currentBefore . $name . $currentAfter;
	} else {
		$home = home_url('/');
		$baseLink =  '<a href="' . esc_url($home) . '">' . $name . '</a>';
		$bc .= $baseLink;
	}

	// Define Category Hierarchy Crumbs for Category Archive
	if ( is_category() ) {
		global $wp_query;
		if (is_object($wp_query->get_queried_object())) {
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) {
				$hierarchy = ( $delimiter . __( 'Categories','weaver-xtreme') . ' ' . get_category_parents( $parentCat, TRUE, $delimiter ) );
			} else {
				$hierarchy = $delimiter . __( 'Categories','weaver-xtreme') . ' ';
			}
		} else {
			$hierarchy = '';
		}
		// Set $currentLocation to the current category
		$currentLocation = single_cat_title( '' , FALSE );

	}
	// Define Crumbs for Day/Year/Month Date-based Archives
	elseif ( is_date() ) {
		// Define Year/Month Hierarchy Crumbs for Day Archive
		if  ( is_day() ) {
			$date_string = '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ' . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ';
			$date_string .= $delimiter . ' ';
			$currentLocation = get_the_time('d');
		}
		// Define Year Hierarchy Crumb for Month Archive
		elseif ( is_month() ) {
			$date_string = '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ';
			$date_string .= $delimiter . ' ';
			$currentLocation = get_the_time('F');
		}
		// Set CurrentLocation for Year Archive
		elseif ( is_year() ) {
			$date_string = '';
			$currentLocation = get_the_time('Y');
		}
		$hierarchy = $delimiter . __( 'Published','weaver-xtreme') . ' ' . $date_string ;
	}
	// Define Category Hierarchy Crumbs for Single Posts
	elseif ( is_single() && !is_attachment() ) {
		$cats = get_the_category();
		if ($cats)
			$cur_cat = $cats[0];
		else
			$cur_cat = '';
		if ($cats) {
			foreach ($cats as $cat) {
				$children = get_categories( array ('parent' => $cat->term_id ));
				if (count($children) == 0) {
					$cur_cat = $cat;
					break;
				}
			}
		}
		if ($cur_cat) {
			$hierarchy = $delimiter . get_category_parents( $cur_cat, TRUE, $delimiter );
		} else {
			$hierarchy = $delimiter . '';
		}
			// Note: get_the_title() is filtered to output a
			// default title if none is specified
			$currentLocation = get_the_title();
	}
	// Define Category and Parent Post Crumbs for Post Attachments
	elseif ( is_attachment() ) {
		$parent = get_post($post->post_parent);
		$cat_parents = '';
		if ( get_the_category($parent->ID) ) {
			$cat = get_the_category($parent->ID);
			$cat = $cat ? $cat[0] : '';
			$cat_parents = get_category_parents( $cat, TRUE, $delimiter );
		}
		$hierarchy = $delimiter . $cat_parents . '<a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a> ' . $delimiter;
		// Note: Titles are forced for attachments; the
		// filename will be used if none is specified
		$currentLocation = get_the_title();
	}
	// Define Current Location for Parent Pages
	elseif ( ! is_front_page() && is_page() && ! $post->post_parent ) {
		$hierarchy = $delimiter;
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title();
	}
	// Define Parent Page Hierarchy Crumbs for Child Pages
	elseif ( ! is_front_page() && is_page() && $post->post_parent ) {
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
			//$page = get_page($parent_id);
			$page = get_post($parent_id);
			$breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
			$parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach ($breadcrumbs as $crumb) {
			$hierarchy = $hierarchy . $delimiter . $crumb;
		}
		$hierarchy = $hierarchy . $delimiter;
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title();
	}
	// Define current location for Search Results page
	elseif ( is_search() ) {
		$hierarchy = $delimiter . __('Search Results','weaver-xtreme') . ' ';
		$currentLocation = get_search_query();
	}
	// Define current location for Tag Archives
	elseif ( is_tag() ) {
		$hierarchy = $delimiter . __( 'Tags','weaver-xtreme') . ' ';
		$currentLocation = single_tag_title( '' , FALSE );
	}
	// Define current location for Author Archives
	elseif ( is_author() ) {
		$hierarchy = $delimiter . __( 'Author','weaver-xtreme') . ' ';
		$currentLocation = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
	}
	// Define current location for 404 Error page
	elseif ( is_404() ) {
		$hierarchy = $delimiter . __( '404','weaver-xtreme') . ' ';
		$currentLocation = __( 'Page not found','weaver-xtreme');
	}
	// Define current location for Post Format Archives
	elseif ( get_post_format() && ! is_home() ) {
		$hierarchy = $delimiter . __( 'Post Formats','weaver-xtreme') . ' ';
		$currentLocation = get_post_format_string( get_post_format() ) . 's';
	} else {
		global $weavrex_pwp_title;
		if ( isset( $GLOBALS['weaverx_pwp_title'] ) ) {
			$currentLocation = $delimiter . $GLOBALS['weaverx_pwp_title'];
		}

	}

// Build the Current Location Link markup
	$currentLocationLink = $currentBefore . $currentLocation . $currentAfter;

// Define breadcrumb pagination

// Define pagination for paged Archive pages
	if ( get_query_var('paged') && ! function_exists( 'wp_paginate' ) ) {
		$crumbPagination = ' - ' . __('Page','weaver-xtreme') . ' ' . get_query_var('paged');
	}

 // Define pagination for Paged Posts and Pages
	if ( get_query_var('page') ) {
		$crumbPagination = ' - ' . __('Page','weaver-xtreme') . ' ' . get_query_var('page') . ' ';
	}

// Output the resulting Breadcrumbs

	$bc .= $hierarchy; // Output Hierarchy
	$bc .= $currentLocationLink; // Output Current Location
	$bc .= $crumbPagination; // Output page number, if Post or Page is paginated

	if (is_rtl()) {
		$list = explode($delimiter,$bc);	// split on the arrow
		$list = array_reverse($list);
		$larrow = '&larr;';
		$bc = implode($larrow,$list);
	}
	// Wrap crumbs
	$bc = $containerBefore . $containerCrumb . $bc . $containerCrumbEnd . $containerAfter;

	if ($echo) echo $bc;
	else return $bc;
	return '';
}
}

if (!function_exists('weaverx_get_paginate_archive_page_links')) {
function weaverx_get_paginate_archive_page_links( $type = 'plain', $endsize = 1, $midsize = 1 ) {
/**
 * Paginate Archive Index Page Links
 *
 * Code based on codex examples
 */
	global $wp_query, $wp_rewrite;

	if ( isset( $wp_query->query_vars['paged'] )) {
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	} else {
		$current = 1;
	}

	// Sanitize input argument values
	if ( ! in_array( $type, array( 'plain', 'list', 'array' ) ) ) $type = 'plain';
	$endsize = (int) $endsize;
	$midsize = (int) $midsize;

	$big = 999999999;	// from codex - an unlikely number, then str_replace. Makes archive no permalinks work

	if (is_search()) { // works for search on non-permalinks...
		$base = '%_%';
	} else {
		$base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
	}

	// Setup argument array for paginate_links()
	$pagination = array(
		'base' =>  $base,
		'format' => '?paged=%#%',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => false,
		'end_size' => $endsize,
		'mid_size' => $midsize,
		'type' => $type,
		'prev_text' => '&lt;&lt;',
		'next_text' => '&gt;&gt;'
	);

	if ( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

	return paginate_links( $pagination );
}
}



// # MENU ==============================================================
class weaverx_Walker_Nav_Menu extends Walker {
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	/**
	 * Starts the list before the elements are added.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * Start the element output.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filter the CSS class(es) applied to a menu item's list item element.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$megamenu = strpos($class_names, 'mega-menu') !== false && function_exists('weaverxplus_plugin_installed');
		if ( $megamenu )
			$class_names = str_replace('mega-menu', '' , $class_names);	// have to move it down

		/**
		 * Filter the ID applied to a menu item's list item element.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filter the HTML attributes applied to a menu item's anchor element.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		$aclass = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				if ( $attr === 'href' && $value === '#' && weaverx_getopt('placeholder_cursor')) {
					$aclass = ' style="cursor:' . weaverx_getopt('placeholder_cursor') .';"';
				}
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}


		$item_output = $args->before;
		$item_output .= "<a{$attributes}{$aclass}>";
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . do_shortcode(apply_filters( 'the_title', $item->title, $item->ID )) . $args->link_after;
		$item_output .= "</a>";
		$item_output .= $args->after;

		if ( $megamenu ) {
			$desc = ! empty($item->description) ? $item->description :
					__('Please enter MegaMenu content to Description.', 'weaver-xtreme');
			$item_output .= '<ul class="mega-menu"><li>' . do_shortcode($desc) . '</li></ul>';
		}

		/**
		 * Filter a menu item's starting output.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

} // Walker_Nav_Menu


// # OTHER UTILS ==============================================================

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function weaverx_render_title() {
?>
<title><?php wp_title(); ?></title> <!-- pre-4.1 compatibility -->
<?php
	}
	add_action( 'wp_head', 'weaverx_render_title' );
}

function weaverx_debug_comment($msg) {
	echo "\n<!-- *************************::: {$msg} ::: ********************** -->\n";
}

function weaverx_get_css_filename() {
	$updir = wp_upload_dir();
	return trailingslashit($updir['basedir']) . 'weaverx-subthemes/style-weaverxt.css';
}

function weaverx_get_css_url() {
	$updir = wp_upload_dir();
	// make relative for https: - doesn't work right...
	// return parse_url(trailingslashit($updir['baseurl']) . 'weaverx-subthemes/style-weaverxt.css',PHP_URL_PATH);
	$path = trailingslashit($updir['baseurl']) . 'weaverx-subthemes/style-weaverxt.css';
	if (is_ssl()) $path = str_replace('http:','https:',$path);
	return $path;
}


function weaverx_get_footer($who) {
	get_footer( $who );
}
//--

function weaverx_generate_id() {
	if ( !isset($GLOBALS['wvrx_gen_id']) )
		$GLOBALS['wvrx_gen_id'] = 1;
	else
		$GLOBALS['wvrx_gen_id']++;
	return $GLOBALS['wvrx_gen_id'];
}
//--

function weaverx_clear_both( $class = '' ) {
	if ( $class )
		echo '<div class="clear-' . $class . '" style="clear:both;"></div>';
	else
		echo '<div style="clear:both;"></div>';
}

function weaverx_relative_url($subpath){
	// generate a relative URL from the site's root
	return parse_url(trailingslashit(get_template_directory_uri()) . $subpath,PHP_URL_PATH);
}

function weaverx_filter_css($css) {
	// filter user added CSS for root relative file paths

	if (strpos($css, '%template_directory%') !== false)
		$css = str_replace('%template_directory%',
			parse_url(trailingslashit(get_template_directory_uri()),PHP_URL_PATH) ,
			$css);
	if (strpos($css, '%stylesheet_directory%') !== false)
		$css = str_replace('%stylesheet_directory%',
			parse_url(trailingslashit(get_stylesheet_directory_uri()),PHP_URL_PATH) ,
			$css);
	if (strpos($css, '%addon_directory%') !== false)
		$css = str_replace('%addon_directory%' ,
			parse_url(trailingslashit(weaverx_f_uploads_base_url()) . 'weaverx-subthemes/addon-subthemes/',PHP_URL_PATH),
			$css);

	return $css;
}
add_filter('weaverx_css','weaverx_filter_css');

// =============================== transient options =============================
if (!function_exists('weaverx_globals')) {
function weaverx_globals($glb='aspen_temp_opts') {
	return isset($GLOBALS[$glb]) ? $GLOBALS[$glb] : '';
}
}

if (!function_exists('weaverx_t_set')) {
function weaverx_t_set($opt, $val) {
	$GLOBALS['aspen_temp_opts'][$opt] = $val;
}
}

if (!function_exists('weaverx_t_get')) {
function weaverx_t_get( $opt ) {
	return isset($GLOBALS['aspen_temp_opts'][$opt]) ? $GLOBALS['aspen_temp_opts'][$opt] : '';
}
}

if (!function_exists('weaverx_t_clear')) {
function weaverx_t_clear($opt) {
	unset($GLOBALS['aspen_temp_opts'][$opt]);
}
}

if (!function_exists('weaverx_t_clear_all')) {
function weaverx_t_clear_all() {
	unset($GLOBALS['aspen_temp_opts']);
}
}

// # MASONRY ==============================================================

function weaverx_masonry($act = false) {
	global $weaverx_cur_template;

	$is_pt = false;

	if (strpos($weaverx_cur_template,'paget-posts.php') !== false) {
		$is_pt = true;
	}
	if (is_singular() && ! $is_pt) {	// don't emit anything for non-blog pages
		return false;
	}

	$usem = weaverx_get_per_page_value('_pp_pwp_masonry');	// per page to override...
	if ($usem < 2)
		$usem = weaverx_getopt('masonry_cols');
	if ($usem < 2) {
		return false;
	}
	switch ($act) {
		case 'begin-posts':	// wrap all posts
			echo '<div id="blog-posts" class="cf">';
			break;
		case 'begin-post' :	// wrap one post
			if (weaverx_is_checked_post_opt('_pp_masonry_span2')) {	// span 2 columns
				$usem .= '-span-2';
			}
			echo '<div class="cf blog-post blog-post-cols-' . $usem . '">';	// for masonry
			break;
		case 'end-post':	// end of one post
			echo "</div> <!-- .blog-post -->\n";
			break;
		case 'end-posts':	// end of all posts
			echo '</div> <!-- #blog-posts -->' . "\n";
			break;
		case 'invoke-code':
?>
<script type='text/javascript'>
jQuery(function(){var $container=jQuery('#blog-posts');$container.imagesLoaded(function(){
$container.masonry({itemSelector:'.blog-post'});});});
jQuery(window).resize(function(){jQuery('#blog-posts').masonry({itemSelector:'.blog-post'});});
</script>
<?php
			break;

		case 'enqueue-script':
			wp_enqueue_script('jquery-masonry',null,array('jquery'),null,true);

			break;
	}	// end switch
	return true;
}

require_once( get_template_directory() . '/includes/fileio.php' );
?>
