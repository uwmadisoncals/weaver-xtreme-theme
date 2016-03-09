<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* --- MULTI-SITE Control ---
  All non-checkbox options for this theme are filtered based on the 'unfiltered_html' capability,
  so non-admins and non-editors can only add safe html to the various options. It should be
  fairly safe to leave all theme options available on your Multi-site installation. If you want
  to eliminate most of the options that let users enter HTML,
  then set WVRX_MULTISITE_RESTRICT_OPTIONS to true.

  You can uncomment the define define('WVRX_MULTISITE_RESTRICT_OPTIONS', true);
  (remove the // in front) in this file, but that change will be
  overwritten when you update the theme. You can also copy the uncommented line to the wp-config.php
  file for your WP installation (anywhere before the "That's all, stop editing! Happy blogging." line),
  and the setting will then survive WP and theme updates.
*/

// define('WVRX_MULTISITE_RESTRICT_OPTIONS', true);

/* Version Information */

define ('WEAVERX_VERSION','2.0.8');
define ('WEAVERX_VERSION_ID', 100);
define ('WEAVERX_THEMENAME', 'Weaver Xtreme');
define ('WEAVERX_THEMEVERSION', WEAVERX_THEMENAME . ' ' . WEAVERX_VERSION);
define ('WEAVERX_MIN_WPVERSION','4.3');

define ('WEAVERX_DEV_MODE', false);

if ( WEAVERX_DEV_MODE )
	define ('WEAVERX_DEFAULT_THEME_FILE', 'none');
else
	define ('WEAVERX_DEFAULT_THEME_FILE', '/subthemes/plain.wxt');


/* utility definitions - should not be edited */
define ('WEAVERX_GOOGLE_FONTS', "<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,400italic|Open+Sans+Condensed:300,700|Alegreya:400,400italic,700,700italic|Alegreya+Sans:400,400italic,700,700italic|Droid+Sans:400,700|Droid+Serif:400,400italic,700,700italic|Exo+2:400,700|Lato:400,400italic,700,700italic|Lora:400,400italic,700,700italic|Arvo:400,700,400italic,700italic|Roboto:400,400italic,700,700italic|Roboto+Condensed:400,700|Roboto+Slab:400,700|Archivo+Black|Source+Sans+Pro:400,400italic,700,700italic|Source+Serif+Pro:400,700|Vollkorn:400,400italic,700,700italic|Arimo:400,700|Tinos:400,400italic,700,700italic|Roboto+Mono:400,700|Inconsolata|Handlee|Ultra&subset=latin,latin-ext' rel='stylesheet' type='text/css'>");



define ('WEAVERX_ADMIN_DIR', '/admin/admin-core');
define ('WEAVERX_DEFAULT_THEME','plain');
define ('WEAVERX_SLUG', 'weaver-xtreme');
define ('WEAVERX_MINIFY','.min');	// dev: '', production: '.min'
?>
