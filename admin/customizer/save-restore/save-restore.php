<?php

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WeaverX_Save_WX_Settings' ) ) :
/**
 * Class WeaverX_Save_Settings
 *
 * Save Weaver Xtreme Settings
 *
 */
class WeaverX_Save_WX_Settings extends WP_Customize_Control {

	public $description = '';
	public $code;

	public function render_content() {

		$a_pro = (weaverx_cz_is_plus()) ? '-plus' : '';

		echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		if ( '' !== $this->description) {
			echo '<span class="description customize-control-description">' . $this->description . '</span>';
		}

		echo '<span class="description customize-control-description">';
		echo '<h3>' . __('Weaver Xtreme Theme - Free version', 'weaver-xtreme') . '</h3><p>';
		_e('<strong>Save all</strong> current core <em>Weaver Xtreme Theme</em> settings to file on your computer.
(Full settings backup, including those marked with &diams;. Does <strong>NOT</strong> include Weaver Xtreme Plus settings.) <em>File:</em>', 'weaver-xtreme' /*adm*/); ?>
<strong>weaverx-backup-settings<?php echo $a_pro;?>.wxb</strong><br /><br />

		<input type="button" class="button" name="wvrx_save_all" value="<?php esc_attr_e( 'Save ALL Weaver Xtreme Settings', 'weaver-xtreme' ); ?>" />
		<br/><br />

<?php _e('<strong><em>Save only theme related</em></strong> current settings to file on your computer. <em>File: </em>', 'weaver-xtreme'); ?>
	<strong>weaverx-theme-settings<?php echo $a_pro;?>.wxt</strong><br /><br />
		<input type="button" class="button" name="wvrx_save" value="<?php esc_attr_e( 'Save THEME RELATED Settings', 'weaver-xtreme' ); ?>" />
		<br />

<?php
if (weaverx_cz_is_plus()) {
	echo '<br /><br /><hr /><h3>' . __('Weaver Xtreme Plus', 'weaver-xtreme') . WEAVERX_PLUS_ICON . '</h3><p>';
_e('Note: The previous download settings will include <em>Weaver Xtreme Plus</em> settings values (if <em>Weaver Xtreme Plus</em> is installed) along with the free version settings.
The previous Save buttons do <em>not</em> include advanced <em>Weaver Xtreme Plus</em> options like shortcodes or SmartMenu settings.', 'weaver-xtreme' /*adm*/)
. '</p>';

	echo '<p>';
	_e('<strong>Save ALL Settings</strong> - Basic Weaver Xtreme, X-Plus, X-Plus Shortcodes, including &diams;, &star;, and &starf;.', 'weaver-xtreme' /*adm*/)?>
</p><p><strong>File: weaverx-settings-(timestamp).wxall</strong></p>

		<input type="button" class="button" name="wvrx_save_xplus" value="<?php esc_attr_e( 'Save ALL Settings, including Xtreme Plus', 'weaver-xtreme' ); ?>" />
<?php
	}

	}

	static public function process_save( $wp_customize )
	{
		if ( current_user_can( 'edit_theme_options' ) ) {
			if ( isset( $_REQUEST['wvrx_save'] ) ) {
				self::_save_settings( $wp_customize, $_REQUEST['wvrx_save'], 'wxt' );
			}
			if ( isset( $_REQUEST['wvrx_save_all'] ) ) {
				self::_save_settings( $wp_customize, $_REQUEST['wvrx_save_all'], 'wxb' );
			}
			if ( isset( $_REQUEST['wvrx_save_xplus'] ) ) {
				self::_save_settings( $wp_customize, $_REQUEST['wvrx_save_xplus'], 'wxall' );
			}

		}
	}

	static private function _weaverx_filter_strip_default( $var ) {
		if (!is_string($var) )
			return true;
		return strlen( $var ) && $var != 'default';
	}


	static private function _save_settings( $wp_customize, $request, $ext )
	{
		if (headers_sent()) {
			@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
			wp_die(__('Headers Sent: The headers have been sent by another plugin - there may be a plugin conflict.', 'weaver-xtreme' /*adm*/));
		}

		if ( ! wp_verify_nonce( $request, 'wvrx-settings-saving' ) ) {
			return;
		}

		if ( $ext == 'wxall') {
			$time = date('Y-m-d-Hi');

			$fn = 'weaverx-settings-' . $time . '.wxall';

			$weaverx_opts = get_option( apply_filters('weaverx_options','weaverx_settings') ,array());
			$weaverxplus_opts = get_option('weaverxplus_settings' ,array());

			$weaverx_opts = array_filter( $weaverx_opts,  'self::_weaverx_filter_strip_default' );
			$weaverxplus_opts = array_filter( $weaverxplus_opts,  'self::_weaverx_filter_strip_default' );

			$save = array();

			$save['header'] = 'WVRX-PLUS1';		// format
			$save['ext'] = $ext;				// the extension
			$save['weaverx'] = $weaverx_opts;
			$save['weaverxplus'] = $weaverxplus_opts;
			$weaverx_settings = $save;

		} else {	// free version save

			$base = 'weaverx-settings';
			$a_pro = (function_exists('weaverxplus_plugin_installed')) ? '-plus' : '';

			$fn = $base . $a_pro . '.' . $ext;

			$weaverx_opts = get_option( apply_filters('weaverx_options','weaverx_settings') ,array());
			$weaverx_header = '';

			$weaverx_save = array();

			// @@@@@@@  $weaverx_opts['style_version'] = '1';

			$weaverx_opts = array_filter( $weaverx_opts,  'self::_weaverx_filter_strip_default' );

			unset( $weaverx_opts['wvrx_css_saved'] );

			$weaverx_save['weaverx_base'] = $weaverx_opts;

			$a_pro = (function_exists('weaverxplus_plugin_installed')) ? '-plus' : '';

			if ($ext == 'wxt') {
				$weaverx_header .= 'WXT-V01.00';
				$weaverx_fn = 'weaverx-theme-settings' . $a_pro . '.wxt';
				foreach ($weaverx_opts as $opt => $val) {
					if ($opt[0] == '_')
						$weaverx_save['weaverx_base'][$opt] = false;
				}
			} else {
				$weaverx_header .= 'WXB-V01.00';			/* Save all settings: 10 byte header */
				$weaverx_fn = 'weaverx-backup-settings' . $a_pro . '.wxb';
			}

			$weaverx_settings = $weaverx_header . serialize($weaverx_save);	/* serialize full set of options right now */
		}

		// Set the download headers.
		header( 'Content-disposition: attachment; filename=' . $fn );
		header( 'Content-Type: application/octet-stream; charset=' . $charset );

		// Serialize the export data.
		echo serialize( $weaverx_settings );

		// Start the download.
		die();
	}

	static public function enqueue_scripts()
	{
		// Register
		wp_register_style( 'wvrx-sr-css', get_template_directory_uri().'/admin/customizer/save-restore/save-restore'.WEAVERX_MINIFY.'.css', array(), WEAVERX_VERSION );
		wp_register_script( 'wvrx-sr-js', get_template_directory_uri().'/admin/customizer/save-restore/save-restore'.WEAVERX_MINIFY.'.js', array( 'jquery' ), WEAVERX_VERSION, true );

		// Localize
		wp_localize_script( 'wvrx-sr-js', 'WVRXl10n', array(
			'emptyImport'	=> __( 'Please choose a file to import.', 'weaver-xtreme' )
		));

		// Config
		wp_localize_script( 'wvrx-sr-js', 'WVRXConfig', array(
			'customizerURL'	  => admin_url( 'customize.php' ),
			'exportNonce'	  => wp_create_nonce( 'wvrx-settings-saving' )
		));

		// Enqueue
		wp_enqueue_style( 'wvrx-sr-css' );
		wp_enqueue_script( 'wvrx-sr-js' );
	}

}
endif;




if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WeaverX_Restore_WX_Settings' ) ) :

class WeaverX_Restore_WX_Settings extends WP_Customize_Control {

	public $description = '';
	public $code;
	static private $wvrx_error = '';
	/**

	 */
	public function render_content() {

		echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		if ( '' !== $this->description) {
			echo '<span class="description customize-control-description">' . $this->description . '</span>';
		}
?>
	<div class="wvrx-settings-restore-controls">
	<input type="file" name="wvrx-settings-restore-file" class="wvrx-settings-restore-file" />

	<?php wp_nonce_field( 'wvrx_restore', 'wvrx-settings-restore' ); ?>
</div>
<div class="wvrx-uploading"><?php _e( 'Uploading...', 'weaver-xtreme' ); ?></div>
<input type="button" class="button" name="wvrx_restore" value="<?php esc_attr_e( 'Upload theme/backup/wxall settings', 'weaver-xtreme' ); ?>" />
<?php
	if (weaverx_cz_is_plus()) {
		echo '<p>&nbsp;</p><hr /><p>';
		_e('<strong>Additional <em>Weaver Xtreme Plus</em></strong> restore options area available on the <em>Appearance &rarr; +Xtreme Plus</em> menu.',
		   'weaver-xtreme');
		echo '</p>';
	}

	}

	static public function process_restore( $wp_customize )
	{
		if ( current_user_can( 'edit_theme_options' ) ) {
			if ( isset( $_REQUEST['wvrx-settings-restore'] ) ) {
				self::_restore( $wp_customize );
			}

		}
	}

	static private function _restore( $wp_customize )
	{
		// Make sure we have a valid nonce.
		if ( ! wp_verify_nonce( $_REQUEST['wvrx-settings-restore'], 'wvrx_restore' ) ) {
			unset($_POST['wvrx-settings-restore']);
			unset($_REQUEST['wvrx-settings-restore']);
			return;
		}
		unset($_POST['wvrx-settings-restore']);
		unset($_REQUEST['wvrx-settings-restore']);

		// Make sure WordPress upload support is loaded.
		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}


		// Setup global vars.
		global $wp_customize;

		// upload theme from users computer
		// they've supplied and uploaded a file

		$ok = true;     // no errors so far

		if (isset($_FILES['wvrx-settings-restore-file']['name']))
			$filename = $_FILES['wvrx-settings-restore-file']['name'];
		else
			$filename = "";

		if (isset($_FILES['wvrx-settings-restore-file']['tmp_name'])) {
			$openname = $_FILES['wvrx-settings-restore-file']['tmp_name'];
		} else {
			$openname = "";
		}

		//Check the file extension
		$check_file = strtolower($filename);
		$pat = '.';				// PHP version strict checking bug...
		$end = explode($pat, $check_file);
		$ext_check = end($end);

		if ($filename == "") {
			return;
		}

		if ($ok && $ext_check != 'wxt' && $ext_check != 'wxb' && $ext_check != 'wxall'){
			self::$wvrx_error = __('Theme files must have .wxt, .wxb, or .wxall extension.', 'weaver-xtreme' /*adm*/) . '<br />';
			return;
		}

		if (!weaverx_f_exists($openname)) {
			self::$wvrx_error = __('Sorry, there was a problem uploading your file.
You may need to check your folder permissions or other server settings.', 'weaver-xtreme' /*adm*/) . __('Trying to use file', 'weaver-xtreme' /*adm*/) . $openname ;
			return;
		}


		// Get the upload data.
		$contents  = weaverx_f_get_contents( $openname );


		// Remove the uploaded file.
		unlink( $openname );
		unset($FILES);

		if (!self::reset_options($contents, $ext_check))
			return;

		// we will now redirect to the customizer so all settings are reloaded
		wp_redirect( home_url('/wp-admin/customize.php?return=%2Fwp-admin%2Fthemes.php%3Fpage%3DWeaverX') );


		//weaverx_alert( __('Weaver Xtreme theme options reset to uploaded theme.', 'weaver-xtreme' /*adm*/) );
		//unset($_POST['wvrx-settings-restore']);
		//unset($_REQUEST['wvrx-settings-restore']);


	}

	static public function reset_options($contents, $ext) {

		if ($ext == 'wxall') {

			$version = weaverx_getopt('weaverx_version_id');	// get something to force load opts_cache
			weaverx_delete_all_options();
			$restore = array();
			$restore = unserialize($contents);
			$opts = $restore['weaverx'];			// fetch base opts
			//if (isset($opts['fonts_added']) ) {
			//	$opts['fonts_added'] = serialize($opts['fonts_added']);
			//}
			foreach ($opts as $key => $val) {
				weaverx_setopt($key, $val, false);	// overwrite with saved values
			}

			weaverx_setopt('weaverx_version_id',$version); // keep version, force save of db
			weaverx_setopt('wvrx_css_saved','');
			weaverx_setopt('last_option','Weaver Xtreme');

			weaverxplus_clear_opts();
			$opts = $restore['weaverxplus'];		// fetch plus opts
			foreach ($opts as $key => $val) {
				weaverxplus_setopt($key, $val, false);	// overwrite with saved values
			}
			weaverxplus_update_opts();
			weaverx_save_opts('xplus',true);

		} else {

			if (substr($contents,0,10) == 'WXT-V01.00')
				$type = 'theme';
			else if (substr($contents,0,10) == 'WXB-V01.00')
				$type = 'backup';
			else {
				$val = substr($contents,0,10);
				self::$wvrx_error = __("Wrong theme file format version", 'weaver-xtreme' /*adm*/) . ':' . $val;
				return false; 	/* simple check for one of ours */
			}

			$restore = array();
			$restore = unserialize(substr($contents,10));

			if (!$restore) {
				self::$wvrx_error = __("Unserialize failed", 'weaver-xtreme' /*adm*/);
				return false;
			}

			$version = weaverx_getopt('weaverx_version_id');	// get something to force load


			$new_cache = array();
			global $weaverx_opts_cache;
			if ($type == 'theme') {
				// need to clear some settings
				// first, pickup the per-site settings that aren't theme related...


				foreach ($weaverx_opts_cache as $key => $val) {
					if (isset($key[0]) && $key[0] == '_')	// these are non-theme specific settings
						$new_cache[$key] = $val;	// keep
				}
				$opts = $restore['weaverx_base'];	// fetch base opts

				foreach ($opts as $key => $val) {
					if (isset($key[0]) && $key[0] != '_')
						$new_cache[$key] = $val;	// and add rest from restore
				}

			} else if ($type == 'backup') {

				$opts = $restore['weaverx_base'];	// fetch base opts
				foreach ($opts as $key => $val) {
					$new_cache[$key] = $val;	// overwrite with saved values
				}
			}
			$new_cache['weaverx_version_id'] = $version;
			$new_cache['wvrx_css_saved'] = '';
			$new_cache['last_option'] = 'Weaver Xtreme';

			$new_cache['style_date'] = date('Y-m-d-H:i:s');

			delete_option('weaverx_settings');

			update_option('weaverx_settings',$new_cache);

			$save_dir = weaverx_f_uploads_base_dir() . 'weaverx-subthemes';
			$usename = 'style-weaverxt.css';
			$filename = $save_dir . '/'. $usename;
			@unlink($filename);

			$weaverx_opts_cache = $new_cache;

			if (weaverx_f_file_access_available()) {	// and now is the time to update the style file
				require_once(get_template_directory() . '/includes/generatecss.php');
				weaverx_fwrite_current_css();
			}
		}

		return true;
	}



	static public function enqueue_scripts()
	{
		// Register
		wp_register_style( 'wvrx-css', dirname( __FILE__ ) . 'save-restore.css', array(), WEAVERX_VERSION );
		wp_register_script( 'wvrx-js', dirname( __FILE__ ) . 'save-restore.js', array( 'jquery' ), WEAVERX_VERSION, true );

		// Localize
		wp_localize_script( 'wvrx-js', 'WVRXl10n', array(
			'emptyImport'	=> __( 'Please choose a file to import.', 'weaver-xtreme' )
		));

		// Config
		wp_localize_script( 'wvrx-js', 'WVRXConfig', array(
			'customizerURL'	  => admin_url( 'customize.php' ),
			'exportNonce'	  => wp_create_nonce( 'wvrx-settings-saving' )
		));

		// Enqueue
		wp_enqueue_style( 'wvrx-css' );
		wp_enqueue_script( 'wvrx-js' );
	}

	static public function controls_print_scripts()
	{

		if ( self::$wvrx_error ) {
			echo '<script> alert("' . self::$wvrx_error . '"); </script>';
		}
	}

}


endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WeaverX_Load_WX_Subtheme' ) ) :

class WeaverX_Load_WX_Subtheme extends WP_Customize_Control {

	public $description = '';
	public $code;
	static private $wvrx_error = '';
	/**

	 */
	public function render_content() {

		echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		if ( '' !== $this->description) {
			echo '<span class="description customize-control-description">' . $this->description . '</span>';
		}
		$theme_dir = trailingslashit(WP_CONTENT_DIR) . 'themes/' . get_template() . '/subthemes/';
		$theme_list = array(
			'ajax', 		'antique-ivory', 	'appalachian-spring', 	'black-and-white',
			'blank', 		'blue', 			'full-width-dark', 		'full-width-light',
			'ivory-drive', 	'kitchen-sink', 	'magazine', 			'pioneer',
			'plain', 		'plain-full-width',	'suburban',				'tan-and-gray',
			'the-grays',	'transparent-dark',	'transparent-light',	'xenic'
		);

?>
	<div class="wvrx-settings-load-subtheme">
		<input type="button" class="button" name="wvrx_select_subtheme" value="<?php esc_attr_e( 'Set to Selected Subtheme', 'weaver-xtreme' ); ?>" />
		<p class="description customize-control-description"><strong>Click "Set to Selected Subtheme" to pick new selected subtheme.</strong> Selecting a subtheme will <em>reset</em> all existing theme settings. Site settings (&diams;) will not be changed.</p>
<?php
	$thumbs = weaverx_relative_url('/subthemes/');

	foreach ($theme_list as $addon) {
		$name = ucwords(str_replace('-',' ',$addon));
?>
	<div style="float:left; width:130px;font-size:80%;">
		<label><input type="radio" name="subtheme_picked"
<?php	    echo 'value="' . $addon . '" /><strong>' . $name . '</strong><br />';
		if (!weaverx_getopt('_hide_theme_thumbs')) {
			echo '<img style="border: 1px solid gray; margin: 5px 0px 7px 0px;" src="' . esc_url($thumbs . $addon . '.jpg') . '" width="120px"  alt="thumb" /></label></div>' . "\n";
		} else {
			echo "</label></div>\n";
		}
	}

	wp_nonce_field( 'wvrx_select_subtheme', 'wvrx-upload-subtheme' ); ?>
</div>
<div class="wvrx-uploading"><?php _e( 'Uploading...', 'weaver-xtreme' ); ?></div>
<input type="button" class="button" name="wvrx_select_subtheme" value="<?php esc_attr_e( 'Set to Selected Subtheme', 'weaver-xtreme' ); ?>" />

<p style="font-weight:bold;">
	<?php	_e( 'Please remember: these subthemes are only starting points!
You can use the Customizer to change virtually any part of these subthemes.
You can change colors, sidebar layouts, font family and sizes, borders, spacing - really, everything.' ,'weaver-xtreme');
	?>
	</p>
<?php

	}

	static public function process_load_theme( $wp_customize )
	{
		if ( current_user_can( 'edit_theme_options' ) ) {
			if ( isset( $_REQUEST['wvrx-upload-subtheme'] ) ) {
				self::_load_theme( $wp_customize );
			}

		}
	}

	static private function _load_theme( $wp_customize )
	{
		// Make sure we have a valid nonce.
		if ( ! wp_verify_nonce( $_REQUEST['wvrx-upload-subtheme'], 'wvrx_select_subtheme' ) ) {
			unset($_POST['wvrx-upload-subtheme']);
			unset($_REQUEST['wvrx-upload-subtheme']);
			weaverx_alert('invalid nonce upload');
			return;
		}
		unset($_POST['wvrx-upload-subtheme']);
		unset($_REQUEST['wvrx-upload-subtheme']);
		if (!isset($_POST['subtheme_picked'])) {
			weaverx_alert('Please select a subtheme to upload.');
			return;
		}
		$theme = weaverx_filter_textarea($_POST['subtheme_picked']);

		$filename = get_template_directory() . '/subthemes/' . $theme . '.wxt';

		if ( ! weaverx_f_exists( $filename ) ) {
			weaverx_alert(__('Sorry, unable to upload the subtheme.', 'weaver-xtreme'));
			return false;
		}

		$contents = weaverx_f_get_contents($filename);	// use either real (pro) or file (standard) version of function

		if (empty($contents)) return false;



		// Setup global vars.
		global $wp_customize;

		// upload theme from users computer
		// they've supplied and uploaded a file

		$ok = true;     // no errors so far


		if (!self::reset_options($contents))
			return;

		wp_redirect( home_url('/wp-admin/customize.php?return=%2Fwp-admin%2Fthemes.php%3Fpage%3DWeaverX') );

		//weaverx_alert( __('Weaver Xtreme uploaded subtheme ', 'weaver-xtreme' /*adm*/) . ucwords(str_replace('-',' ',$theme) ) );
	}

	static public function reset_options($contents) {

		if (substr($contents,0,10) == 'WXT-V01.00')
			$type = 'theme';
		else if (substr($contents,0,10) == 'WXB-V01.00')
			$type = 'backup';
		else {
			$val = substr($contents,0,10);
			self::$wvrx_error = __("Wrong theme file format version", 'weaver-xtreme' /*adm*/) . ':' . $val;
			return false; 	/* simple check for one of ours */
		}

		$restore = array();
		$restore = unserialize(substr($contents,10));

		if (!$restore) {
			self::$wvrx_error = __("Unserialize failed", 'weaver-xtreme' /*adm*/);
			return false;
		}

		$version = weaverx_getopt('weaverx_version_id');	// get something to force load

		$new_cache = array();
		global $weaverx_opts_cache;
		if ($type == 'theme') {
			// need to clear some settings
			// first, pickup the per-site settings that aren't theme related...


			foreach ($weaverx_opts_cache as $key => $val) {
				if (isset($key[0]) && $key[0] == '_')	// these are non-theme specific settings
					$new_cache[$key] = $val;	// keep
			}
			$opts = $restore['weaverx_base'];	// fetch base opts

			foreach ($opts as $key => $val) {
				if (isset($key[0]) && $key[0] != '_')
					$new_cache[$key] = $val;	// and add rest from restore
			}

		} else if ($type == 'backup') {

			$opts = $restore['weaverx_base'];	// fetch base opts
			foreach ($opts as $key => $val) {
				$new_cache[$key] = $val;	// overwrite with saved values
			}
		}
		$new_cache['weaverx_version_id'] = $version;
		$new_cache['wvrx_css_saved'] = '';
		$new_cache['last_option'] = 'Weaver Xtreme';

		$new_cache['style_date'] = date('Y-m-d-H:i:s');

		delete_option('weaverx_settings');

		update_option('weaverx_settings',$new_cache);

		$save_dir = weaverx_f_uploads_base_dir() . 'weaverx-subthemes';
		$usename = 'style-weaverxt.css';
		$filename = $save_dir . '/'. $usename;
		@unlink($filename);

		$weaverx_opts_cache = $new_cache;

		if (weaverx_f_file_access_available()) {	// and now is the time to update the style file
			require_once(get_template_directory() . '/includes/generatecss.php');
			weaverx_fwrite_current_css();
		}

		return true;
	}



	static public function enqueue_scripts()
	{
		// Register
		wp_register_style( 'wvrx-css', dirname( __FILE__ ) . 'save-restore.css', array(), WEAVERX_VERSION );
		wp_register_script( 'wvrx-js', dirname( __FILE__ ) . 'save-restore.js', array( 'jquery' ), WEAVERX_VERSION, true );

		// Localize
		wp_localize_script( 'wvrx-js', 'WVRXl10n', array(
			'emptyImport'	=> __( 'Please choose a file to import.', 'weaver-xtreme' )
		));

		// Config
		wp_localize_script( 'wvrx-js', 'WVRXConfig', array(
			'customizerURL'	  => admin_url( 'customize.php' ),
			'exportNonce'	  => wp_create_nonce( 'wvrx-settings-saving' )
		));

		// Enqueue
		wp_enqueue_style( 'wvrx-css' );
		wp_enqueue_script( 'wvrx-js' );
	}

	static public function controls_print_scripts()
	{

		if ( self::$wvrx_error ) {
			echo '<script> alert("' . self::$wvrx_error . '"); </script>';
		}
	}

}


endif;
?>
