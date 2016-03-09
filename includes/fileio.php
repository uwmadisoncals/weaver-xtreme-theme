<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly

// The Weaver Xtreme WP_Filesystem interface to "duplicate" fopen, fwrite, etc.
// __ added - 12/11/14

function weaverx_f_file_access_fail($who = '') {
	static $weaverx_f_file_access_fail_sent = false;
	if ($weaverx_f_file_access_fail_sent) return;	// only show once...
	$weaverx_f_file_access_fail_sent = true;
?>
	<div class="error">
		<strong style="color:#f00; line-height:150%;"><?php _e('*** Weaver Xtreme File Access Error! ***</strong> <small style="padding-left:20px;">(But don\'t panic!)</small>
	<p>Weaver Xtreme is unable to process a file access request. You may need proper FTP credentials set in
	WordPress, or in your wp-config.php file. It is unusual to see this error. It may be displayed
	after you move to a new host.</p>
	<p>You may have to change the directory permissions on your web hosting server.</p>', 'weaver-xtreme' /*adm*/); ?>
	<?php echo '<p>' . __('Diagnostics:', 'weaver-xtreme' /*adm*/) . "{$who}</p>\n"; ?>
	</div>
<?php
	return;
}

function weaverx_f_file_access_available() {
	if (function_exists('weaverxplus_f_file_access'))
		return true;
	return false;
}

function weaverx_f_open($fn, $how) {
	// 'php://output'
	if ($fn == 'php://output' || $fn == 'echo')
		return 'echo';
	if ($fn == 'wvrx_css_saved') {
		unset( $GLOBALS['wvrx_css_saved'] );
		$GLOBALS['wvrx_css_saved'] = '';
		return $fn;
	}
	if (function_exists('weaverxplus_f_open'))
		return weaverxplus_f_open( $fn, $how );
	return false;
}

function weaverx_f_write($fn,$data) {
	if ($fn == 'echo' || $fn == 'php://output') {
		echo $data;
		return true;
	} else if ($fn == 'wvrx_css_saved') {
		$GLOBALS['wvrx_css_saved'] .= $data;
	} else if (function_exists('weaverxplus_f_write'))
		return weaverxplus_f_write( $fn, $data);
	else
		return false;
}

function weaverx_f_close($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return true;
	else if (function_exists('weaverxplus_f_close'))
		return weaverxplus_f_close( $fn );
	else
		return false;
}

function weaverx_f_delete($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return true;
	if (function_exists('weaverxplus_f_delete'))
		return weaverxplus_f_delete( $fn );
	return false;
}

function weaverx_f_is_writable($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return true;
	if (function_exists('weaverxplus_f_is_writable'))
		return weaverxplus_f_is_writable( $fn );
	return false;
}

function weaverx_f_touch($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return true;
	if (function_exists('weaverxplus_f_touch'))
		return weaverxplus_f_touch( $fn );
	return false;
}

function weaverx_f_mkdir($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return false;
	if (function_exists('weaverxplus_f_mkdir'))
		return weaverxplus_f_mkdir( $fn );
	return false;
}

function weaverx_f_exists($fn) {
	// this one must use native PHP version since it is used at theme runtime as well as admin
	if ($fn == 'php://output' || $fn == 'echo')
		return true;
	if (function_exists('weaverxplus_f_exists'))
		return weaverxplus_f_exists( $fn );
	return @file_exists($fn);
}

function weaverx_f_get_contents($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return '';
	if (function_exists('weaverxplus_f_get_contents'))
		return weaverxplus_f_get_contents( $fn );
	return implode('',file($fn));	// works if no newlines in the file...
}

// =========================== helper functions ===========================
function weaverx_alert($msg) {
	echo "<script> alert('" . esc_html($msg) . "'); </script>";
	// echo "<h1>*** $msg ***</h1>\n";
}

function weaverx_f_content_dir() {
	return trailingslashit(WP_CONTENT_DIR);
 }

function weaverx_f_plugins_dir() {
	// delivers appropriate path for using weaverx_f_ functions. WP_PLUGIN_DIR
	return trailingslashit(WP_PLUGIN_DIR);
}

function weaverx_f_themes_dir() {
	// delivers appropriate path for using weaverx_f_ functions.
	return weaverx_f_content_dir() . 'themes/';
}

function weaverx_f_wp_lang_dir() {
	// delivers appropriate path for using weaverx_f_ functions. WP_LANG_DIR
	return trailingslashit(WP_LANG_DIR);
}

function weaverx_f_uploads_base_dir() {
	// delivers appropriate path for using weaverx_f_ functions.
	$upload_dir = wp_upload_dir();
	return trailingslashit($upload_dir['basedir']);
}

function weaverx_f_uploads_base_url() {
	$wpdir = wp_upload_dir();		// get the upload directory
	return trailingslashit(trim($wpdir['baseurl']));
}

function weaverx_f_wp_filesystem_error() {
	return;
}

function weaverx_f_fail($msg) {
	weaverx_alert($msg);
	return false;
}
?>
