<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly

if (!function_exists('weaverx_get_default_settings')) {

function weaverx_get_default_settings() {
	// This function loads the settings for the default theme. None of the settings are saved, so this meets
	// the WP theme requirements of not touching the DB until the user clicks something.


	global $weaverx_opts_cache;
	$weaverx_opts_cache = array();

	$filename = apply_filters('weaverx_default_subtheme', get_template_directory() . WEAVERX_DEFAULT_THEME_FILE );

	if ( ! weaverx_f_exists( $filename ) )
		return false;

	$contents = weaverx_f_get_contents($filename);	// use either real (pro) or file (standard) version of function

	if (empty($contents)) return false;

	if (substr($contents,0,10) != 'WXT-V01.00')
		return false;

	$restore = array();
	$restore = unserialize(substr($contents,10));


	$opts = $restore['weaverx_base'];	// fetch base opts
	foreach ($opts as $opt => $val) {
		$weaverx_opts_cache[$opt] = $val;
	}
}
}
?>
