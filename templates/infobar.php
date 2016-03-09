<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* Weaver X

Inject - injects userdefined HTML

inject-infobar - adds both the infobar and the user pre-main area. Order of these
two can be swapped easily in a child theme simply by reversing the order here

*/
if (weaverx_getopt('infobar_hide') != 'hide' && !weaverx_is_checked_page_opt('_pp_hide_page_infobar')) { // let's really not include it rather than display:none.

	$c_class = weaverx_area_class('infobar', 'not-pad', '-none', 'margin-none' );
?>

<div id="infobar" class="<?php echo $c_class;?>">
<?php
	if (!weaverx_getopt_checked('info_hide_breadcrumbs')) {
		$weaverx_crumbs = '';
		if (has_action('weaverx_breadcrumbs')) {		// allow anyone to override bradcrumbs via action
			do_action('weaverx_breadcrumbs');
		} else {
			if ( function_exists('yoast_breadcrumb') )
				$weaverx_crumbs = yoast_breadcrumb('  <span id="breadcrumbs">','</span>',false);
			if ($weaverx_crumbs)
				echo $weaverx_crumbs;
			else
				weaverx_breadcrumb();
		}
	} else {
		echo '  <span id="breadcrumbs"></span>';  // need to get area height
	}
?>
	<span class='infobar_right'>
<?php
	if (isset($GLOBALS['weaverx_page_who']))
		$pwp = $GLOBALS['weaverx_page_who'] == 'pwp';

	if ( !weaverx_getopt_checked('info_hide_pagenav') ) {
		echo ('<span id="infobar_paginate">');
		if (has_action('weaverx_paginate')) {		// allow anyone to override bradcrumbs via action
			do_action('weaverx_paginate');
		} else {
			if ( $pwp || !is_singular() ) {
				if (function_exists ('wp_pagenavi')) {
					wp_pagenavi();
				} elseif ( function_exists( 'wp_paginate' ) ) {
					wp_paginate( 'title=' );
				} else {
					echo weaverx_get_paginate_archive_page_links( 'plain', 2, 2 );
				}
			}
		}
		echo ("</span>\n");
	}

	if (weaverx_getopt('info_search')) {
		if (function_exists('weaverxplus_search_form')) {
			echo '<span id="infobar_search" style="padding-right:4px !important;display:inline-block;padding-left:20px;">';
			echo weaverxplus_search_form('',120);
			echo '</span>';
		} else {
			echo '<span id="infobar_search">';
			get_search_form();
			echo '</span>';
		}
	}

	if (weaverx_getopt_checked('info_addlogin')) {
		echo '<span id="infobar_login">';
		wp_loginout();
		echo '</span>';
	}
?>
	</span></div><div class="clear-info-bar-end" style="clear:both;">
</div><!-- #infobar -->

<?php
} // show info bar

?>
