<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/*	Weaver Xtreme Theme

  This file contains the functions needed to interact with the different
  options and settings in both the core admin page, and on the sapi options from
  the Weaver Xtreme Theme Support plugin.

  Options are saved in the WP DB in one option called 'weaverx_main_settings'.

	This file includes the interface to the WP Settings API.

   Because the SAPI is quite limiting on the format of the output fields
   supported by add_settings_field, we will not use that part.

   Settings that need validation and nonce handling, we use our function weaverx_sapi_main_name() that
   generates the <input name="weaverx_main_settings[option_name]" ...> format required for
   processing by the sapi handlers. They create an array called $_POST['weaverx_main_settings']. Each
   setting in that array corresponds to a Weaver Xtreme option value, and will be passed to the
   validation function.

   We will wrap the main form (Main Options) with our functions
   weaverx_sapi_form_top() and weaverx_sapi_form_bottom() that generates required calls to sapi.

   All other forms will use submit buttons that include their own nonce definition. Other forms generally
   do not change individual settings, but take actions such as save/restore or setting a subtheme.
*/

// # RUNTIME SAPI HELPER FUNCTIONS ============================================

function weaverx_sapi_options_init() {
	/* this will initialize the SAPI stuff, must be called from the admin_init cb function .
	In reality, we really only need to register one setting - 'weaverx_main_settings_group',
	and the settings will be saved in the WP DB as 'weaverx_main_settings'. The SAPI uses
	the name param of any <input> fields to figure out where to store the input value.

	The validation will have to scan the ENTIRE list of options and lookup the kind of
	validation each parameter needs.

	NOTE: This code is here to support Legacy Weaver Xtreme Theme options settings.
	Version 2.0 does not use or call these validation functions directly, but the are needed
	to support the legacy options interface.
	*/

	register_setting('weaverx_settings_group',	/* the group name of our settings */
	apply_filters('weaverx_options','weaverx_settings'),	/* the get_option name */
	'weaverx_validate_cb');			/* a validation call back */
}

function weaverx_validate_cb($in) {
	return weaverx_validate_all_options($in);
}

/*
	================= nonce helpers =====================
*/
function weaverx_submitted($submit_name) {
	// do a nonce check for each form submit button
	// pairs 1:1 with weaverx_nonce_field
	$nonce_act = $submit_name.'_act';
	$nonce_name = $submit_name.'_nonce';

	if (isset($_POST[$submit_name])) {
		if (isset($_POST[$nonce_name]) && wp_verify_nonce($_POST[$nonce_name],$nonce_act)) {
			return true;
		} else {
			die(__('WARNING: invalid form submit detected. Probably caused by session time-out, or, rarely, a failed security check. Please contact WeaverTheme.com if you continue to receive this message.', 'weaver-xtreme' /*adm*/) . '(' . $submit_name . ')');
		}
	} else {
		return false;
	}
}

function weaverx_nonce_field($submit_name,$echo = true) {
	// pairs 1:1 with sumbitted
	// will be one for each form submit button

	return wp_nonce_field($submit_name.'_act',$submit_name.'_nonce',$echo);
}

/*
	================= Main SAPI helper functions =================
*/

function weaverx_sapi_form_top($group, $form_name='') {
	/* beginning of a form */
	$name = '';
	if ($form_name != '') $name = 'name="' . $form_name . '"';

	echo("<form action=\"options.php\" $name method=\"post\">\n");	/* <form action="options.php" method="post"> */
	settings_fields($group);		// use our one set of settings
}

function weaverx_sapi_form_bottom($form_name='end of form') {
	// customizer only, keep values, preserve values, save values, not legacy (search terms for these kinds of settings)
	$non_sapi = array(		// non-sapi elements in the db
		'weaverx_version_id', 'style_version',
		'theme_filename', 'addon_name', '_hide_theme_thumbs', 'last_option',
		'font_set_vietnamese', 'font_set_cryllic', 'font_set_greek', 'font_set_hebrew',
		'font_word_spacing_global_dec', 'font_letter_spacing_global_dec'

	);

	/*	The following code allows the SAPI to save the non-sapi values. If you don't do this here,
		then the values will be set to false, and be lost! SAPI is not tolerant of submitting a form
		that doesn't include EVERY setting for the form group. */

	foreach ($non_sapi as $name) {
?>
	<input name="<?php weaverx_sapi_main_name($name); ?>" id="<?php echo $name;?>" type="hidden" value="<?php echo weaverx_getopt($name); ?>" />
<?php
	}
	weaverx_setopt('last_option','Weaver Xtreme');	// Safety check for limited PHP $_POST variables
	echo ("</form> <!-- $form_name -->\n");
}

function weaverx_sapi_submit( $before='', $after='', $show_more_opts = false ) {
	// generate a submit button for the form
	$submit_label = __('Save Settings', 'weaver-xtreme' /*adm*/);
	echo $before;
?>
	<span style="display:inline;"><input name="save_options" type="submit" style="margin-top:10px;" class="button-primary" value="<?php echo($submit_label); ?>" />
<?php
	echo "</span>\n" . $after ;

}

function weaverx_form_submit($value) {
	weaverx_sapi_submit('</table>','<table style="margin-top:10px;">');
}

function weaverx_sapi_main_name($id, $echo=true) {
	/* generate the SAPI name for 'weaverx_settings' */
	$name = apply_filters('weaverx_options','weaverx_settings');
	if ($echo) echo $name. '[' . $id . ']';
	return $name . '[' . $id . ']';
}

/*
	============== Validation =====================
*/
function weaverx_validate_all_options($in) {
	/* validation for all options  */
	$err_msg = '';			// no error message yet

	if (empty($in)) {
		wp_die( __( 'You attempted to save options, but something has gone wrong. Please be sure you are logged in and your host is correctly configured. See the "Weaver Doesn\'t Save Settings" FAQ on weavertheme.com.' ,'weaver-xtreme') );
	}

	if (!current_user_can('edit_theme_options')) {
		wp_die( __( 'You do not have sufficient permissions to manage options for this site.' ,'weaver-xtreme') );
	}

	$wvr_last = '';


	foreach ($in as $key => $value) {
		switch ($key) {

			/* -------- integer -------- */
			case 'excerpt_length':

				if (!empty($value) && (!is_numeric($value) || !is_int((int)$value))) {
					$opt_id = str_replace('', '', $key);
					$opt_id = str_replace('_', ' ', $opt_id);
					$err_msg .= __('Option must be an integer value: ', 'weaver-xtreme' /*adm*/) . '"'. $opt_id . '" = "' . $value . '".'
						. __(' Value has been cleared to blank value', 'weaver-xtreme' /*adm*/) . '<br />';
					$in[$key] = '';
				}
				break;

			/* ---------- text ----------- */
			case 'excerpt_more_msg':
			case 'header_maxwidth':

				if (!empty($value))
					$in[$key] = weaverx_filter_textarea($value);
				break;

			case 'themename':       // can't be empty!
				if (empty($value))
					$in[$key] = 'please-give-this-a-name';
				else
					$in[$key] = weaverx_filter_textarea($value);
				break;


			/* code */
			case 'copyright':		// Alternate copyright
			case '_css_rows':
				if (!empty($value)) {
					$in[$key] = weaverx_filter_code($value);
				}
				break;


			case '_perpagewidgets':       	// Add widget areas for per page - names must be lower case
				if (!empty($value)) {
					$in[$key] = strtolower(str_ireplace(' ','',weaverx_filter_code($value)));
				}
				break;

			case '_althead_opts':
			case 'head_opts':
				if ( !empty( $value ) ) {
					$in[$key] = weaverx_filter_head( $value );
				}
				break;

			case 'wvrx_css_saved':
				if ( !empty( $value ) ) {
					$in[$key] = weaverx_filter_code( $value );
					//$in[$key] = wp_filter_post_kses( trim(stripslashes($value)) );
				}
				break;


			/* must not have <style .... </style> */
			case 'add_css':              	// Add CSS Rules to Weaver Xtreme's style rules

				if (!empty($value)) {
					$val = weaverx_filter_code($value);
					$in[$key] = $val;
					if (stripos($val,'<style') !== false || stripos($val, '</style') !== false ||
						stripos($val,'<script') !== false || stripos($val, '</script') !== false) {
						$err_msg .= __('&lt;style&gt; or &lt;script&gt; tags have been automatically stripped from your "Add CSS Rules"!', 'weaver-xtreme' /*adm*/)
						. ' ' . __('Please correct your entry.', 'weaver-xtreme' /*adm*/) . '<br />';
						$in[$key] = wp_filter_post_kses( trim(stripslashes($val)) );
					}
				}
				break;

			case '_fonts_google':
				$in[$key] = $value;
				break;

			case 'last_option':		// check for last_option...
				if (!empty($value))
					$wvr_last = $value;
				break;

			default:				/* to here, then colors, _css, or checkbox/selectors */
				$keylen = strlen($key);

				if (strrpos($key,'_css') == $keylen-4)  {	// all _css settings
					if (!empty($value)) {
						$val = weaverx_filter_code($value);
						if (stripos($val,'<style') !== false || stripos($val, '</style') !== false ||
							stripos($val,'<script') !== false || stripos($val, '</script') !== false) {
							$err_msg .= __('&lt;style&gt; or &lt;script&gt; tags have been automatically stripped from your CSS+ rules,', 'weaver-xtreme' /*adm*/)
							. ' ' . __('Please correct your entry.', 'weaver-xtreme' /*adm*/) . '<br />';
							$val = wp_filter_post_kses( trim($val) );
						}

						$in[$key] = $val;

						if (strpos($val, '{') === false || strpos($val, '}') === false) {
							$opt_id = str_replace('_css', '', $key);	// kill _css
							$opt_id = str_replace('', '', $opt_id);
							$opt_id = str_replace('_', ' ', $opt_id);
							$err_msg .= __('CSS options must be enclosed in {}\'s: ', 'weaver-xtreme' /*adm*/) . '"'. $opt_id . '" = "' . $value . '". '
							. __('Please correct your entry.', 'weaver-xtreme' /*adm*/) . '<br />';
						}
					}
					break;
				} // _css

				if (strrpos($key,'_insert') == $keylen-7) {	// all _insert settings
					if (!empty($value)) {
						$val = weaverx_filter_code($value);
						$in[$key] = $val;
						}
					break;
				} // _insert

				if (strrpos($key,'_url') == $keylen-4) {	// all _url settings
					if (!empty($value)) {
						$val = weaverx_filter_code($value);	// can't use esc_url because that forces a leading html{background-image: url(%template_directory%assets/images/addon_themes.png);}
						$in[$key] = $val;
					}
					break;
				} // _insert

				if (strrpos($key,'_dec') == $keylen-4) {
					if (!empty($value) && !is_numeric($value)) {
						$opt_id = str_replace('', '', $key);
						$opt_id = str_replace('_dec', '', $opt_id);
						$opt_id = str_replace('_', ' ', $opt_id);
						$err_msg .= __('Option must be a numeric value: ', 'weaver-xtreme' /*adm*/) . '"'. $opt_id . '" = "' . $value . '". '
							. __('Value has been cleared to blank value.', 'weaver-xtreme' /*adm*/) . '<br />';
						$in[$key] = '';
					}
					break;
				}

				if (strrpos($key,'_int') == $keylen-4 ||	// _int settings
					strrpos($key,'_X') == $keylen-2 ||
					strrpos($key,'_Y') == $keylen-2 ||
					strrpos($key,'_L') == $keylen-2 ||
					strrpos($key,'_R') == $keylen-2 ||
					strrpos($key,'_T') == $keylen-2 ||
					strrpos($key,'_B') == $keylen-2 ) {
					if (!empty($value) && (!is_numeric($value) || !is_int((int)$value))) {
						$opt_id = str_replace('', '', $key);
						$opt_id = str_replace('_int', '', $opt_id);
						$opt_id = str_replace('_', ' ', $opt_id);
						$err_msg .= __('Option must be a numeric value: ', 'weaver-xtreme' /*adm*/) . '"'. $opt_id . '" = "' . $value . '". '
							. __('Value has been cleared to blank value.', 'weaver-xtreme' /*adm*/) . '<br />';
						$in[$key] = '';
					}
					break;
				}

				if (strrpos($key,'color') == $keylen-5) {	// _bgcolor and _color (order here important - after _css, etc.)
					if (!empty($value)) {

						$val = trim(weaverx_filter_code($value));
						if (preg_match('/^#?+[0-9a-f]{3}(?:[0-9a-f]{3})?$/i', $val)) {	// hex value
							$val = strtoupper($val);		// force hex values to upper case, just to be tidy
							if ($val[0] != '#') $val = '#' . $val;
							$in[$key] = $val;
						} else if (preg_match("/^([a-zA-Z])+$/i", $val)) {	// name - all letters
							$in[$key] = $val;
						} else {		// only legal things left are rgb and rgba
							$isrgb = strpos( $val, 'rgb' );
							$ishsa = strpos( $val, 'hsl' );
							if ($isrgb === false && $ishsa === false) {
								if ( $value == ' ') {
									$in[$key] = '';
								} else {
									$err_msg .= __('Color must be a valid # hex value, rgb value, or color name (a-z): ', 'weaver-xtreme' /*adm*/) .
									'"'. $key . '" = "' . bin2hex($value) . '". ' .
									__('Value has been cleared to blank value.', 'weaver-xtreme' /*adm*/) . '<br />';
								}
								$in[$key] = '';
							} else {
								$in[$key] = $val;
							}
						}
					}
					break;
				}

				if (!empty($value) && is_string($value) && !is_numeric($value)) { $in[$key] = weaverx_filter_textarea($value); }

				break;
		}
	}

	if (false && $wvr_last != 'Weaver Xtreme') {
		$err_msg .= __('Warning - your host may be configured to limit how many input var options you are allowed to pass via PHP.
Unfortunately, this means your settings may not be saved correctly. See the "Weaver II Doesn\'t Save Settings" FAQ on weavertheme.com.<br />', 'weaver-xtreme' /*adm*/);
	}


	if (!empty($err_msg)) {
		add_settings_error('weaverx_settings', 'settings_error', $err_msg, 'error');
	} else {
		add_settings_error('weaverx_settings', 'settings_updated', __('Weaver Xtreme Settings Saved.', 'weaver-xtreme' /*adm*/), 'updated');
	}

	return $in;
}

// ========================== utils ==================================

function weaverx_end_of_section($who = '') {
	echo '<hr />';
	$name = weaverx_getopt('themename');
	if ( ! $name )
		$name = __('Please set theme name on the Advanced Options &rarr; Admin Options tab.', 'weaver-xtreme' /*adm*/);

	printf(__("%s %s | Options Version: %s | Subtheme: %s\n", 'weaver-xtreme' /*adm*/),WEAVERX_THEMENAME, WEAVERX_VERSION, weaverx_getopt('style_version'), $name);

	$last = weaverx_getopt('last_option');
	if ($last != 'Weaver Xtreme') // check for case of limited PHP $_POST values
	{
?>
<p style="color:red">
<?php _e('Possible Non-Standard Web Host Configuration detected. If your options
are not saving correctly, your host may have limited the default number of values that PHP can use for
settings. Try saving your settings again, and if this message persists, please contact your host and ask them to "Increase the PHP <em>max_input_vars</em> value for $_POST to at least 600." If that does not fix the issue,
please contact Weaver Xtreme support. Diagnostic info: last_option=', 'weaver-xtreme' /*adm*/); ?><?php echo $last;?>
</p>
<?php
	}

	if (false && !weaverx_getopt('_hide_subtheme_link')) {
?>
	<p style="max-width:90%;"><?php weaverx_site('/subthemes/'); ?><img style="max-width:95%;float:left;margin-right:10px;" src="<?php echo weaverx_relative_url('/assets/images/'); ?>theme-bar.jpg" alt="addons" />
	<?php _e('<strong>Discover more premium <br />Weaver Xtreme Subthemes</strong>', 'weaver-xtreme' /*adm*/); ?></a>
	</p>
<?php
	}
}

function weaverx_donate_button() {

	if (!weaverx_getopt_checked('_hide_donate') && !function_exists('weaverxplus_plugin_installed')) { ?>
<div style="float:right;padding-right:30px;"><small><strong><?php _e('Like Weaver X? Consider', 'weaver-xtreme' /*adm*/); ?></strong></small>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="6Y68LG9G9M82W">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
<?php }
}


function weaverx_clear_messages() {
?>
<form style="float:right;margin-right:15px;" name="clearweaverx_form" method="post">
<?php

	if (!function_exists('wvrx_ts_installed')) {
		if (!is_multisite() || (is_multisite() && current_user_can('manage_network_themes')) ) {
			echo '<div style="display:inline-block;background-color:pink;border:1px solid black;padding:3px;margin-right:4px;font-style:italic;font-size:80%;line-height:1.2;">' .
			__('Please install and activate the<br />Weaver Xtreme Theme Support Plugin.', 'weaver-xtreme') . '</div>';
		}
	}
	if (!function_exists('weaverxplus_plugin_installed')) {
		echo '<strong style="border:1px solid blue;background:yellow;padding:4px;margin:5px;">';
		weaverx_site('','//plus.weavertheme.com/',__('Weaver Xtreme Plus', 'weaver-xtreme' /*adm*/));
		echo __('Get Weaver Xtreme Plus!','weaver-xtreme' /*adm*/) . '</a> </strong>';
	}
	do_action('weaverx_check_licenses');

?>
	<span class="submit"><input type="submit" name="weaverx_clear_messages" value="<?php _e('Clear Messages', 'weaver-xtreme' /*adm*/); ?>"/></span>
	<?php weaverx_nonce_field('weaverx_clear_messages'); ?>
</form> <!-- resetweaverx_form -->
<?php
}

function weaverx_abs_file_path($http_path) {
	return untrailingslashit(ABSPATH) . parse_url($http_path,PHP_URL_PATH);
}
/*
	==================== SAVE / RESTORE THEMES AND BACKUPS ==========================
*/
function weaverx_get_save_settings($is_theme) {
	// serialize current settings
	global $weaverx_opts_cache;

	weaverx_update_options('write_backup');

	if ($is_theme) {
		$header = 'WXT-V01.00';			/* Save theme settings: 10 byte header */
		$theme_opts = array();
		$theme_opts['weaverx_base'] = $weaverx_opts_cache;
		foreach ($weaverx_opts_cache as $opt => $val) {
			if ($opt[0] == '_')
			$theme_opts['weaverx_base'][$opt] = false;
		}
		return $header . serialize($theme_opts);	/* serialize full set of options right now */
	} else {
		$header = 'WXB-V01.00';			/* Save all settings: 10 byte header */
		$theme_opts = array();
		$theme_opts['weaverx_base'] = $weaverx_opts_cache;
		return $header . serialize($theme_opts);	/* serialize full set of options right now */
	}
}

function weaverx_clear_cache_settings() {
	/* clear all settings */
	global $weaverx_opts_cache;
	foreach ($weaverx_opts_cache as $key => $value) {
		$weaverx_opts_cache[$key] = false;		// clear everything
	}
}

function weaverx_save_msg($msg) {
	echo '<div id="message" class="updated fade"><p><strong>' . $msg .
		'</strong></p></div>';
}
function weaverx_error_msg($msg) {
	echo '<div id="message" class="updated fade" style="background:#F88;"><p><strong>' . $msg .
		'</strong></p></div>';
}

//----------- need in main theme
function weaverx_check_version() {

	$version = WEAVERX_VERSION;

	$check_site = 'https://weaverxtra.wordpress.com';
	$home_site = '//weavertheme.com';
	$msg = __(' - Available at:', 'weaver-xtreme' /*adm*/) . ' ' .
	'<a href="//weavertheme.com/download/" target="_blank">WeaverTheme.com/download/</a>';

	$latest = weaverx_latest_version($check_site);     // check if newer version is available
	if ( $latest[0] != 'unavailable' && version_compare($version,$latest[0],'<') ) {
		if ( ! empty($latest[1]) ) {
			$msg = $msg . '<p>' . $latest[1] . '</p>';		}
		$saveme = WEAVERX_THEMENAME . __(' Current version: ', 'weaver-xtreme' /*adm*/) . $version . __(' Newer version: ', 'weaver-xtreme' /*adm*/) . $latest[0] .
			$msg;
			weaverx_save_msg($saveme);
	}
	return '';
}

function weaverx_latest_version($check_site) {
	$rss = fetch_feed($check_site. '/feed/');
	 if (is_wp_error($rss) ) {
		return array('unavailable', '');
	}
	$out = '';
	$items = 1;
	$num_items = $rss->get_item_quantity($items);
	if ( $num_items < 1 ) {
		$out .= 'unavailable';
		$rss->__destruct();
		unset($rss);
		return array($out, '');
	}
	$rss_items = $rss->get_items(0, $items);
	foreach ($rss_items as $item ) {
		$title = esc_attr(strip_tags($item->get_title()));
		if ( empty($title) )
			$title = 'unavailable';
		$content = esc_attr(strip_tags($item->get_content()));
	}
	if (stripos($title,'announcement') === false) {
		$blank = strpos($title,' ');    // find blank
		if ($blank < 1)     // problem
			$title = 'unavailable';
		else {
			$title = substr($title,0,$blank);
		}
	}
	$out .= $title;
	$rss->__destruct();
	unset($rss);
	return array( $out, $content );
}

function weaverx_elink( $href, $title, $label, $before='', $after='') {
	echo $before . '<a href="' . esc_url($href) . '" title="' . $title . '">' . $label . '</a>' . $after;
 }

 function weaverx_tab_title( $title, $help_link, $help_title ) {
	echo '<h3>'. $title; weaverx_help_link( $help_link, $help_title ) ; echo '</h3>';
 }

 function weaverx_2_add_fonts($fonts) {
	// this code adds all the new Google Fonts to the Legacy plugin Font picker.
	$base = array(
		array('val' => 'inherit', 'desc' => __('Inherit', 'weaver-xtreme') ),
		//'google' => __('---* Google Fonts (For All Browsers) *', 'weaver-xtreme'),
		//'sans-g' => __('--- -- Sans-Serif Google Fonts --', 'weaver-xtreme'),
		array('val' => 'open-sans', 'desc' => __('Open Sans', 'weaver-xtreme') ),
		array('val' => 'open-sans-condensed', 'desc' => __('Open Sans Condensed', 'weaver-xtreme') ),
		array('val' => 'alegreya-sans', 'desc' => __('Alegreya Sans', 'weaver-xtreme') ),
		array('val' => 'archivo-black', 'desc' => __('Archivo Black', 'weaver-xtreme') ),
		array('val' => 'arimo', 'desc' => __('Arimo', 'weaver-xtreme') ),
		array('val' => 'droid-sans', 'desc' => __('Droid Sans', 'weaver-xtreme') ),
		array('val' => 'exo-2', 'desc' => __('Exo 2', 'weaver-xtreme') ),
		array('val' => 'lato', 'desc' => __('Lato', 'weaver-xtreme') ),
		array('val' => 'roboto', 'desc' => __('Roboto', 'weaver-xtreme') ),
		array('val' => 'roboto-condensed', 'desc' => __('Roboto Condensed', 'weaver-xtreme') ),
		array('val' => 'source-sans-pro', 'desc' => __('Source Sans Pro', 'weaver-xtreme') ),

		//'serif-g' => __('--- -- Serif Google Fonts --', 'weaver-xtreme'),
		array('val' => 'alegreya', 'desc' => __('Alegreya (Serif)', 'weaver-xtreme') ),
		array('val' => 'arvo', 'desc' => __('Arvo Slab', 'weaver-xtreme') ),
		array('val' => 'droid-serif', 'desc' => __('Droid Serif', 'weaver-xtreme') ),
		array('val' => 'lora', 'desc' => __('Lora', 'weaver-xtreme') ),
		array('val' => 'roboto-slab', 'desc' => __('Roboto Slab', 'weaver-xtreme') ),
		array('val' => 'source-serif-pro', 'desc' => __('Source Serif Pro', 'weaver-xtreme') ),
		array('val' => 'tinos', 'desc' => __('Tinos', 'weaver-xtreme') ),
		array('val' => 'vollkorn', 'desc' => __('Vollkorn', 'weaver-xtreme') ),
		array('val' => 'ultra', 'desc' => __('Ultra Black', 'weaver-xtreme') ),

		//'mono-g' => __('--- -- Monospace Google Fonts --', 'weaver-xtreme'),

		array('val' => 'inconsolata', 'desc' => __('Inconsolata (Mono)', 'weaver-xtreme') ),
		array('val' => 'roboto-mono', 'desc' => __('Roboto Mono', 'weaver-xtreme') ),

		//'cursive-g' => __('--- -- "Cursive" Google Fonts --', 'weaver-xtreme') ),

		array('val' => 'handlee', 'desc' => __('Handlee (Cursive)', 'weaver-xtreme') )
	);

	if ( ! weaverx_getopt('disable_google_fonts')) {
		if (!empty($fonts))
			unset($fonts[0]);	// kill original 'default'
		return array_merge($base, $fonts);	// put the new fonts at the top
	} else {
		return $fonts;
	}


 }
 add_filter('weaverx_add_font_family','weaverx_2_add_fonts');

?>
