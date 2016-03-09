<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/*
	Weaver Xtreme Admin - Uses yetii JavaScript to build tabs.
	Tabs include:
	Weaver Xtreme Themes		(in atw-subthemes.php)
	Main Options		(in this file)
	Advanced Options	(in wvr_advancedopts.php)
	Save/Restore Themes	(in atw-subthemes.php)
	Snippets		(in atw-help.php)
	CSS Help		ditto
	Help			ditto

*  __ added - 12/10/14
/*
	========================= Weaver Xtreme Admin Tab - Main Options ==============
*/
function weaverx_do_admin() {
/* theme admin page */

/* This generates the startup script calls, etc, for the admin page */
	global $weaverx_opts_cache, $weaverx_main_options, $weaverx_main_opts_list;

	if (!current_user_can('edit_theme_options'))
		wp_die(__('No permission to access that page.', 'weaver-xtreme' /*adm*/));

	weaverx_admin_page_process_options();	// Process non-sapi options

	echo('<div class="wrap">');
?>
<div style="float:left;"><h2><?php echo WEAVERX_THEMEVERSION; ?> Options
<?php if (function_exists('weaverxplus_plugin_installed')) {
	echo '<span style="font-size:smaller;"> - ' .  __('Plus', 'weaver-xtreme' /*adm*/) .
'</span><span style="font-size:small;"> ('; echo WEAVER_XPLUS_VERSION; echo ')</span>';
	}?>

<?php if (is_child_theme()) echo " &mdash; " . wp_get_theme(); ?>


</h2>
	<a name="top_main" id="top_main"></a></div>
<?php weaverx_donate_button();
	//weaverx_check_theme();
	weaverx_clear_messages();

	weaverx_check_version();           // check version RSS

	weaverx_clear_both();
	$site_url = get_admin_url();
	$site_url = str_replace('http://', '//', $site_url);
	$site_url = str_replace('https://', '//', $site_url);
	//$site_url = '';
	$ret_url = str_replace('/','%2F', $site_url);
	$customizer_link = $site_url . '/customize.php?return=' . $ret_url .  'themes.php%3Fpage%3DWeaverX';

	if (!weaverx_getopt('_disable_customizer')) {
?>
<a href="<?php echo $customizer_link; ?>" title="Switch to Customizer" style="text-decoration:none;font-weight:bold; border:1px solid blue;padding-left:5px; padding-right:5px; background-color:yellow;">Switch to Customizer</a>
<?php } ?>

<div id="tabwrap">
  <div id="taba-admin" class='yetii'>
	<ul id="taba-admin-nav" class='yetii'>
	<?php
	weaverx_elink( '#tab_help', __('Table of Content links to Weaver Xtreme Help files', 'weaver-xtreme' /*adm*/), __('Theme Help', 'weaver-xtreme' /*adm*/), $before='<li>', $after='</li>');


	weaverx_elink( '#tab_themes', __('Select from pre-defined subthemes', 'weaver-xtreme' /*adm*/), __('Weaver Xtreme Subthemes', 'weaver-xtreme' /*adm*/), $before='<li>', $after='</li>');

	weaverx_elink( '#tab_main', __('Main options for most theme elements: site appearance, layout, header, menus, content, footer, fonts, more', 'weaver-xtreme' /*adm*/), __('Main Options', 'weaver-xtreme' /*adm*/), $before='<li>', $after='</li>');

	if (has_action('weaverx_admin_advancedopts'))
		weaverx_elink( '#tab_advanced', __('Advanced options: HTML, code, CSS insertion; page templates, background images, SEO, site options', 'weaver-xtreme' /*adm*/), __('Advanced Options', 'weaver-xtreme' /*adm*/), $before='<li>', $after='</li>');

	weaverx_elink( '#tab_pro', __('Weaver Xtreme Theme Add-ons', 'weaver-xtreme' /*adm*/), __('Add-ons', 'weaver-xtreme' /*adm*/), $before='<li>', $after='</li>');

	weaverx_elink( '#tab_saverestore', __('Save and Restore theme settings', 'weaver-xtreme' /*adm*/), __('Save/Restore', 'weaver-xtreme' /*adm*/), $before='<li>', $after='</li>');


	?>
	</ul>

<?php //  list is order specific - above and below must match ?>

	<div id="tab_help" class="tab" >
	<?php weaverx_admin_help(); ?>
	</div>


	<div id="tab_themes" class="tab" >
	<?php 	do_weaverx_admin_subthemes(); ?>
	</div>

<?php


	  // ====================== Begin the big form here =====================
	weaverx_sapi_form_top('weaverx_settings_group','weaverx_options_form');
?>
	<div id="tab_main" class="tab" >
<?php do_weaverx_admin_mainopts(); ?>
	</div>

	<?php if (has_action('weaverx_admin_advancedopts')) { ?>

	<div id="tab_advanced" class="tab" >
<?php do_weaverx_admin_advancedopts(); ?>
	</div>
<?php
	}


	weaverx_sapi_form_bottom();		// end of SAPI opts here. Can't cross <div>s! Non-sapi forms follow
	// ===================== end of big form  =====================
?>

	  <div id="tab_pro" class="tab" >
<?php weaverx_admin_pro(); ?>
	  </div>

	<div id="tab_saverestore" class="tab" >
	<?php do_weaverx_admin_saverestore(); ?>
	</div>

   </div> <!-- #tab-saverestore -->
</div> <!-- #tabwrap -->

<?php   weaverx_end_of_section('Options'); ?>

<script type="text/javascript">
	var tabberAdmin = new Yetii({
	id: 'taba-admin',
	tabclass: 'tab',
	persist: true
	});
</script>

<?php
}	/* end weaverx_do_admin */

/*
	================= process settings when enter admin pages ================
*/
function weaverx_admin_page_process_options() {
	/* Process all options - called upon entry to options forms */

	// Most options are handled by the SAPI filter.

	settings_errors('weaverx_settings');			// display results from SAPI save settings

	$processed = false;

	if (function_exists('wvrx_ts_installed')) {
		$processed = weaverx_process_options_themes(); 	            // >>>> Weaver Xtreme Themes Tab
	}

	do_action('weaverx_child_process_options');	// let the child theme do something
	do_action('weaverxplus_admin','process_options');
	do_action('weaverx_process_license_options');



	/* this tab has the most individual forms and submit commands */

	/* ====================================================== */

	if (  !$processed && isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		add_settings_error('weaverx_settings', 'settings_updated', __('Saved', 'weaver-xtreme' /*adm*/), 'updated');
		$vers = weaverx_getopt('style_version');
		weaverx_setopt('style_version', $vers + 1 );
	}

	 weaverx_save_opts('Weaver Xtreme Admin');			/* FINALLY - SAVE ALL OPTIONS AND UPDATE CURRENT CSS FILE */

}

function weaverx_admin_admin() {
?>
<div class="atw-option-header"><span style="color:black; padding:.2em;" class="dashicons dashicons-admin-generic"></span>
<?php _e('Basic Administrative Options', 'weaver-xtreme' /*adm*/); ?>
<?php weaverx_help_link('help.html#AdminOptions','Help for Admin Options'); ?></div>

<p>
<?php _e('These options control some administrative options and appearance features.', 'weaver-xtreme' /*adm*/); ?>
</p>

<br />

<label><input type="checkbox" name="<?php weaverx_sapi_main_name('_disable_customizer'); ?>" id="disable_customizer" <?php checked(weaverx_getopt_checked( '_disable_customizer' )); ?> />
	<?php _e('<strong>Disable Weaver Xtreme Customizer Interface</strong> - If you have a slow host or slow computer, checking this option will disable loading the Weaver Xtreme Customizer interface. &diams;', 'weaver-xtreme' /*adm*/); ?>
	</label><br /><br />

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name('_hide_donate'); ?>" id="hide_donate" <?php checked(weaverx_getopt_checked( '_hide_donate' )); ?> />
	<?php _e('I\'ve Donated - <small>Thank you for donating to the Weaver Xtreme theme.
This will hide the Donate button. Purchasing Weaver Xtreme Plus also hides the Donate button.</small> &diams;', 'weaver-xtreme' /*adm*/); ?>
	</label><br /><br />

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name('_hide_editor_style'); ?>" id="_hide_editor_style" <?php checked(weaverx_getopt_checked( '_hide_editor_style' )); ?> />
<?php _e('Disable Page/Post Editor Styling - <small>Checking this box will disable the Weaver Xtreme subtheme based styling in the Page/Post editor.
If you have a theme using transparent backgrounds, this option will likely improve the Post/Page editor visibility. &diams;</small>', 'weaver-xtreme' /*adm*/); ?></label><br />

	<label><input type="checkbox" name="<?php weaverx_sapi_main_name('_hide_auto_css_rules'); ?>" id="hide_auto_css_rules" <?php checked(weaverx_getopt_checked( '_hide_auto_css_rules' )); ?> />
<?php _e('Don\'t auto-display CSS rules - <small>Checking this box will disable the auto-display of Main Option elements that have CSS settings.</small> &diams;', 'weaver-xtreme' /*adm*/); ?></label><br />

	<input name="<?php weaverx_sapi_main_name('_css_rows'); ?>" id="css_rows" type="text" style="width:30px;height:20px;" class="regular-text" value="<?php weaverx_esc_textarea(weaverx_getopt('_css_rows')); ?>" />
<?php _e('lines - Set CSS+ text box height - <small>You can increase the default height of the CSS+ input area (1 to 25 lines).</small> &diams;', 'weaver-xtreme' /*adm*/); ?>
<br />
 <br />
 <h3 class="atw-option-subheader"><?php _e('Per Page and Per Post Option Panels by Roles<', 'weaver-xtreme' /*adm*/); ?>/h3>
 <p>
<?php _e('Single site Administrator and Multi-Site Super Administrator will always have the Per Page and Per Post options panel displayed.
You may selectively disable these options for other User Roles using the check boxes below.', 'weaver-xtreme' /*adm*/); ?>
 </p>


	<label><input type="checkbox" name="<?php weaverx_sapi_main_name('_hide_mu_admin_per'); ?>" id="_hide_mu_admin_per" <?php checked(weaverx_getopt_checked( '_hide_mu_admin_per' )); ?> />
	<?php _e('Hide Per Page/Post Options for MultiSite Admins', 'weaver-xtreme' /*adm*/); ?></label> &diams;<br />
	   <label><input type="checkbox" name="<?php weaverx_sapi_main_name('_hide_editor_per'); ?>" id="_hide_editor_per" <?php checked(weaverx_getopt_checked( '_hide_editor_per' )); ?> />
	<?php _e('Hide Per Page/Post Options for Editors', 'weaver-xtreme' /*adm*/); ?></label> &diams;<br />
	   <label><input type="checkbox" name="<?php weaverx_sapi_main_name('_hide_author_per'); ?>" id="_hide_author_per" <?php checked(weaverx_getopt_checked( '_hide_author_per' )); ?> />
	<?php _e('Hide Per Page/Post Options for Authors and Contributors', 'weaver-xtreme' /*adm*/); ?></label> &diams;<br />
	<br />
	<label><input type="checkbox" name="<?php weaverx_sapi_main_name('_show_per_post_all'); ?>" id="_hide_author_per" <?php checked(weaverx_getopt_checked( '_show_per_post_all' )); ?> />
	<?php _e('Show Per Post Options for Custom Post Types &diams; - <small>Shows the Per Post options box on "Custom Post Type Editor" admin pages', 'weaver-xtreme' /*adm*/); ?></small>
	</label>
<br />
<br /><br />
	<div class="atw-option-subheader"><?php _e('Theme Name and Description', 'weaver-xtreme' /*adm*/); ?></div>
<p>
<?php _e('You can change the name and description of your current settings if you would like to create a new theme
theme file for sharing with others, or for you own identification.', 'weaver-xtreme' /*adm*/); ?>
</p>
<?php _e('Theme Name:', 'weaver-xtreme' /*adm*/); ?> <input name="<?php weaverx_sapi_main_name('themename'); ?>" id="themename" value="<?php echo weaverx_getopt('themename'); ?>" />
	<br />
	<?php _e('Description:', 'weaver-xtreme' /*adm*/); ?>&nbsp;&nbsp;&nbsp;
	<?php weaverx_textarea(weaverx_getopt('theme_description'), 'theme_description', 2, __('Describe the theme','weaver-xtreme' /*adm*/),'width:65%;'); ?>
<br />
<br />
 <h3 class="atw-option-subheader"><?php _e('Subtheme Notes', 'weaver-xtreme' /*adm*/); ?></h3>
 <p>
<?php _e('This box may be used to keep notes and instructions about settings made for a custom subtheme.
It will be saved in the both \'.wxt\' and \'.wxb\' settings files.', 'weaver-xtreme' /*adm*/); ?>
 </p>
 <?php
	weaverx_textarea(weaverx_getopt('subtheme_notes'), 'subtheme_notes', 2, __('Notes about theme','weaver-xtreme' /*adm*/), 'width:75%;');

	do_action('weaverxplus_admin','admin_options');

}
/* ^^^^^ end weaverx_admin_page_process_options ^^^^^^ */

// ============================= link functions to the Theme Support Plugin =============

function do_weaverx_admin_saverestore() {
	if (!has_action('weaverx_admin_saverestore')) {
		echo '<br /><h2>';
		echo sprintf(__('Please install the %s plugin to enable Legacy <em>Save/Restore</em>.', 'weaver-xtreme'),
				'<a href="//wordpress.org/plugins/weaverx-theme-support" target="_blank">Weaver Xtreme Theme Support</a>');
		echo '</h3><p>';
		_e('The <em>Weaver Xtreme Theme Support Plugin</em> provides the full set of theme Save/Restore options.
Please open the <em>Appearance &rarr; Recommended Plugins</em> menu or go to WordPress.com to install this plugin.', 'weaver-xtreme');
		echo '</p>';
		//$t_dir = weaverx_relative_url('') . 'assets/images/core-subthemes.jpg';
		//echo '<img style="margin-left:5%;" src="' . $t_dir . '" />';
	}
	else
		do_action('weaverx_admin_saverestore');
}

function do_weaverx_admin_subthemes() {
	if (!has_action('weaverx_admin_subthemes')) {
		echo '<br /><h2>';
		echo sprintf(__('Please install the %s plugin to enable <em>Weaver Xtreme Subthemes</em>.', 'weaver-xtreme'),
				'<a href="//wordpress.org/plugins/weaverx-theme-support" target="_blank">Weaver Xtreme Theme Support</a>');
		echo '</h3><p>';
		_e('The <em>Weaver Xtreme Theme Support Plugin</em> provides a full set of theme options, including pre-defined subthemes, and the complete legacy
options interface which gives you even more ways to customize your site design.
Please open the <em>Appearance &rarr; Recommended Plugins</em> menu or go to WordPress.com to install this plugin.', 'weaver-xtreme');
		echo '</p>';
		$t_dir = weaverx_relative_url('') . 'assets/images/core-subthemes.jpg';
		echo '<img style="margin-left:5%;" src="' . $t_dir . '" />';
	}
	else
		do_action('weaverx_admin_subthemes');
}

function do_weaverx_admin_mainopts() {
	if (!has_action('weaverx_admin_mainopts')) {
		echo '<br /><h2>';
		echo sprintf(__('Please install the %s plugin to enable <em>Main and Advanced Options</em>.', 'weaver-xtreme'),
				'<a href="//wordpress.org/plugins/weaverx-theme-support" target="_blank">Weaver Xtreme Theme Support</a>');
		echo '</h3><p>';
		_e('The <em>Weaver Xtreme Theme Support Plugin</em> provides a full set of theme options, including pre-defined subthemes, and the complete legacy
options interface which gives you even more ways to customize your site design.
Please open the <em>Appearance &rarr; Recommended Plugins</em> menu or go to WordPress.com to install this plugin.', 'weaver-xtreme');
		echo '</p>';
		$t_dir = weaverx_relative_url('') . 'assets/images/legacy-options.jpg';
		echo '<img style="margin-left:5%;" src="' . $t_dir . '" />';
	}
	else
		do_action('weaverx_admin_mainopts');
}

function do_weaverx_admin_advancedopts() {
	if (!has_action('weaverx_admin_advancedopts')) {
		?>
		<h2>Install Weaver Theme Support to view Advanced Options</h2>
		<?php
	}
	else
		do_action('weaverx_admin_advancedopts');
}

// ===================================== include other stuff ==========================

//require_once( get_template_directory().WEAVERX_ADMIN_DIR.'/lib-admin.php' );
//++++++++ require_once( get_template_directory().WEAVERX_ADMIN_DIR.'/lib-admin-part2.php' );

//++++++ require_once( get_template_directory().WEAVERX_ADMIN_DIR.'/admin-subthemes.php' );
//++++++ require_once( get_template_directory().WEAVERX_ADMIN_DIR.'/admin-mainopts.php' );
//++++++ require_once( get_template_directory().WEAVERX_ADMIN_DIR.'/admin-advancedopts.php' );
require_once( get_template_directory().WEAVERX_ADMIN_DIR.'/admin-plus.php' );
require_once( get_template_directory().WEAVERX_ADMIN_DIR.'/admin-help.php' );
?>
