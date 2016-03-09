<?php
/* Display per page and per post options.
 *
 *  __ added - 12/10/14
 */

if ( !defined('ABSPATH')) exit; // Exit if accessed directly
// Admin panel that gets added to the page edit page for per page options

if ( ! ( function_exists( 'wvrx_ts_installed' ) ||
		function_exists( 'weaverxplus_plugin_installed' ) ) ) {

	add_action('admin_menu', 'weaverx_add_page_fields');

	function weaverx_add_page_fields() {
		add_meta_box('page-box', __('Weaver Xtreme Options For This Page (Per Page Options)', 'weaver-xtreme' /*adm*/),
					 'weaverx_page_extras', 'page', 'normal', 'high');
		add_meta_box('post-box', __('Weaver Xtreme Options For This Post (Per Post Options)', 'weaver-xtreme' /*adm*/),
					 'weaverx_page_extras', 'post', 'normal', 'high');
	}

	function weaverx_page_extras() {
		echo '<p>';
_e('<em>Weaver Xtreme</em> supports a complete set of Per Page and Per Post options if you install either
the <a href="https://wordpress.org/plugins/weaverx-theme-support/" target="_blank" alt="Weaver X Theme Support">
Weaver X Theme Support</a> free plugin, or the <a href="//plus.weavertheme.com/" target="_blank" alt="Weaver Xtreme">
Weaver Xtreme Plus</a> premium plugin.', 'weaver-xtreme' /*adm*/);
		echo '</p><p>';
_e('These options include, among others, the ability to hide header images, titles, footers, as well as per page
   and per post widget area options. These options allow you to give special pages or posts highly customized layouts.', 'weaver-xtreme' /*adm*/);
		echo '</p>';
	}
}
?>
