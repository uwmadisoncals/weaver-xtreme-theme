<?php
/**
 * Customizer Support for Weaver Xtreme
 *
 * Panel, Section, and control definition structures inspired by Make theme
 * Some custom Customizer control classes inspired by
 */

if (!weaverx_getopt('_disable_customizer')) {

	add_action( 'customize_register', 'weaverx_add_customizer_content' );
	add_action( 'customize_controls_enqueue_scripts','weaverx_enqueue_customizer_scripts');
	add_action( 'customize_preview_init', 'weaverx_customizer_preview_script' );

	add_action( 'customize_register', 'WeaverX_Save_WX_Settings::process_save', 999999 );
	add_action( 'customize_register', 'WeaverX_Restore_WX_Settings::process_restore', 999999 );
	add_action( 'customize_register', 'WeaverX_Load_WX_Subtheme::process_load_theme', 999999 );





function weaverx_add_customizer_content( $wp_customize ) {

	// Failsafe is safe
	if ( ! isset( $wp_customize ) ) {
		return;
	}

	weaverx_cz_cache_opts();		// we want to get the existing options before filtered.

	$path = trailingslashit( get_template_directory() ) . 'admin/customizer/';

	// Inlcude the Alpha Color Picker control file.
	require_once( dirname( __FILE__ ) . '/alpha-color-picker/alpha-color-picker.php' );
	require_once( dirname( __FILE__ ) . '/save-restore/save-restore.php' );
	require_once( dirname( __FILE__ ) . '/lib-controls.php' );

	weaverx_customizer_add_panels( $wp_customize );
	weaverx_customizer_add_sections( $wp_customize );
	weaverx_customizer_set_transport( $wp_customize );

	weaverx_clear_opt_cache('customizer');
}



add_action( 'customize_register', 'weaverx_cz_customize_order', 20 );

function weaverx_cz_customize_order($wp_customize) {

	// Re-prioritize and rename the Widgets panel
	if ( ! isset( $wp_customize->get_panel( 'widgets' )->priority ) )
		$wp_customize->add_panel( 'widgets' );

	$wp_customize->get_panel( 'widgets' )->priority 	= 11900;
	$wp_customize->get_panel( 'widgets' )->title 		= __( 'Active Widget Areas', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON;

	// Re-prioritize and rename the Menus panel
	if ( ! isset( $wp_customize->get_panel( 'nav_menus' )->priority ) )
		$wp_customize->add_panel( 'nav_menus' );

	$wp_customize->get_panel( 'nav_menus' )->priority 	= 11910;
	$wp_customize->get_panel( 'nav_menus' )->title 		= __( 'Custom Menus Content', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON;

	// Move and rename Background Color control to Global section of Color panel
	$wp_customize->get_control( 'background_color' )->section =  'weaverx_color-wrapping';
	$wp_customize->get_control( 'background_color' )->label = __( 'Site Background Color - WP Value', 'weaver-xtreme' );
	$wp_customize->get_control( 'background_color' )->description = __('WordPress default Site BG color. Weaver Xtreme Theme version option below is the preferred value to use.', 'weaver-xtreme');

}


function weaverx_customize_preview_js() {

	// @@@ possibly add Loading message....

	WeaverX_Restore_WX_Settings::controls_print_scripts();

	$cur_vers = weaverx_wp_version();

	if (version_compare($cur_vers, '4.4', '<')) {
		$msgpost = __('The Site Preview window will refresh <em>much</em> faster after you update to WordPress 4.4.','weaver-xtreme');

		$content = "<script>jQuery('#customize-info').append('<div style=\"text-align: center;border-bottom: solid 1px #eee;display: block; font-size: 100%;padding: 9px 0;color: white;background: #298cba;\"> {$msgpost}</div>');</script>";
		echo $content;
	}
}
add_action('customize_controls_print_footer_scripts', 'weaverx_customize_preview_js');

/*
 * Customizer scripts
 */
function weaverx_enqueue_customizer_scripts(){

	// Styles
	wp_enqueue_style(
		'weaverx-customizer-jquery-ui',
		get_template_directory_uri() . '/admin/customizer/css/jquery-ui/jquery-ui-1.10.4.custom.css',
		array(),
		'1.10.4'
	);
	wp_enqueue_style(
		'weaverx-customizer-chosen',
		get_template_directory_uri() . '/admin/customizer/css/chosen/chosen.css',
		array(),
		'1.3.0'
	);

//define('CUSTOMIZER_MENU','Customizer-Menu-9');
define('CUSTOMIZER_MENU','customizer-menu');


	wp_enqueue_style(
		'weaverx-customizer-menu',
		get_template_directory_uri() . "/admin/customizer/css/" . CUSTOMIZER_MENU .WEAVERX_MINIFY.".css",
		array(),
		WEAVERX_VERSION
	);


	wp_enqueue_style(
		'weaverx-customizer-sections',
		get_template_directory_uri() . "/admin/customizer/css/customizer-sections".WEAVERX_MINIFY.".css",
		array( 'weaverx-customizer-jquery-ui', 'weaverx-customizer-chosen' ),
		WEAVERX_VERSION
	);


	// stylesheet for customizer

	wp_enqueue_style( 'dashicons' );

	// Scripts

	wp_enqueue_script(
		'weaverx-customizer-chosen',
		get_template_directory_uri() . '/admin/customizer/js/chosen.jquery.js',
		array( 'jquery', 'customize-controls' ),
		'1.3.0',
		true
	);

	wp_enqueue_script(
		'weaverx-customizer-menu',
		get_template_directory_uri() . '/admin/customizer/js/' . CUSTOMIZER_MENU .  WEAVERX_MINIFY . '.js',
		array( ),
		WEAVERX_VERSION,
		true
	);

	$cur_vers = weaverx_wp_version();

	if (version_compare($cur_vers, '4.4', '<'))
		$wp_vers = '4.3';
	else
		$wp_vers = '4.4';


	$local = array(
		'wp_vers' => $wp_vers,
		'starting' => __('Start Here', 'weaver-xtreme'),
		'intro' => __('Theme Introduction', 'weaver-xtreme'),
		'subtheme' => __('Select Subthemes', 'weaver-xtreme'),
		'help' => __('Theme Help', 'weaver-xtreme'),

		'general' => __('General Options, Admin', 'weaver-xtreme'),
		'tagline' => __('Site Identity', 'weaver-xtreme'),
		'front_page' => __('Static Front Page', 'weaver-xtreme'),
		'general_admin' => __('Admin', 'weaver-xtreme'),
		'save_settings' => __('Save Settings', 'weaver-xtreme'),
		'restore_settings' => __('Restore Settings', 'weaver-xtreme'),
		'general_saverestore' => __('Legacy Xtreme Admin', 'weaver-xtreme'),


		'site_colors' => __('Colors', 'weaver-xtreme'),
		'wrapping' => __('Wrapping Areas', 'weaver-xtreme'),
		'links' => __('Links', 'weaver-xtreme'),
		'header' => __('Header Area', 'weaver-xtreme'),
		'menus' => __('Menus', 'weaver-xtreme'),
		'info_bar' => __('Info Bar', 'weaver-xtreme'),
		'content' => __('Content', 'weaver-xtreme'),
		'post_specific' => __('Post Specific', 'weaver-xtreme'),
		'sidebars' => __('Sidebars & Widget Areas', 'weaver-xtreme'),
		'widgets' => __('Individual Widgets', 'weaver-xtreme'),
		'footer' => __('Footer Area', 'weaver-xtreme'),

		'spacing' => __('Spacing, Widths,+', 'weaver-xtreme'),
		'fullwidth' => __('Full Width', 'weaver-xtreme'),


		'style' => __('Style - Borders, etc.', 'weaver-xtreme'),
		'global' => __('Global Options', 'weaver-xtreme'),

		'typography' => __('Typography', 'weaver-xtreme'),

		'visibility' => __('Visibility', 'weaver-xtreme'),
		'global_vis' => __('Global Visibility', 'weaver-xtreme'),

		'layout' => __('Layout', 'weaver-xtreme'),

		'images' => __('Images', 'weaver-xtreme'),
		'background' => __('Background', 'weaver-xtreme'),
		'header_image' => __('WP Header Image', 'weaver-xtreme'),
		'background_image' => __('WP Background', 'weaver-xtreme'),

		'added_content' => __('Added Content', 'weaver-xtreme'),
		'head_sec' => __('HEAD Section', 'weaver-xtreme'),
		'injection' => __('HTML Injection Areas', 'weaver-xtreme'),

		'custom' => __('Custom CSS', 'weaver-xtreme'),
		'help_custom' => __('Custom CSS Help', 'weaver-xtreme'),
		'global_css' => __('Global Custom CSS', 'weaver-xtreme'),

		'what' => __('<em>- WHAT -</em>', 'weaver-xtreme'),
		'where' => __('<em>- WHERE -</em>', 'weaver-xtreme'),

		'sb_widg_content' => __('Active Widget Areas','weaver-xtreme'),
		'custom_menus' => __('Custom Menus Content','weaver-xtreme'),
		'global_spacing' => __('Global Spacing','weaver-xtreme'),
		'global_admin' => __('Administration','weaver-xtreme'),
		'global_opts' => __('Global Options','weaver-xtreme'),
		'wp_settings' => __('WordPress Settings','weaver-xtreme'),
		'html_inject' => __('HTML Injection Areas', 'weaver-xtreme'),

		'loadingMsg'	=> __('Please wait. Customizer Loading...', 'weaver-xtreme'),
		'helpURL' 	=> 	get_template_directory_uri() . '/help/help.html#get-started',
		'cust_help'	=>	__('Weaver Xtreme Customizer Help','weaver-xtreme')
	);

	wp_localize_script('weaverx-customizer-menu', 'wvrxCM', $local );


	wp_enqueue_script(
		'weaverx-customizer-sections',
		get_template_directory_uri() . '/admin/customizer/js/customizer-sections' . WEAVERX_MINIFY . '.js',
		array( 'jquery','customize-controls', 'weaverx-customizer-chosen' ),
		WEAVERX_VERSION,
		true
	);


	// Save/Restore scripts
	WeaverX_Save_WX_Settings::enqueue_scripts();
	// WeaverX_Restore_WX_Settings::enqueue_scripts();

}


add_action('customize_save', 'weaverx_cz_save');

function weaverx_cz_save($class) {
	//weaverx_save_opts('customizer', true);	// have to save things - generate css setting and file, for example.
}

add_action('customize_save_after', 'weaverx_cz_save_after');

function weaverx_cz_save_after($class) {
	weaverx_save_opts('customizer', true);	// have to save things - generate css setting and file, for example.
}

if ( ! function_exists( 'weaverx_customizer_get_panels' ) ) :
/**
 * Return an array of panel definitions.
 *
 * @since  1.3.0.

 * @return array    The array of panel definitions.
 */
function weaverx_customizer_get_panels() {
	$panels = array(

		'starting'		=> array( 'title' => __( 'Weaver Xtreme: Start Here', 'weaver-xtreme' ), 'priority' => 10100,
				'description'    => __( "How to get started with Weaver Xtreme." , 'weaver-xtreme' )),

		'general'           => array( 'title' => __( 'General Options &amp; Admin', 'weaver-xtreme' ), 'priority' => 10200,
				'description'    => __( "General settings: Site Identity, Static Front Page, Admin Options, Help" , 'weaver-xtreme' )),

		'site-colors'      	=> array( 'title' => __( 'Colors', 'weaver-xtreme' ), 'priority' => 10300,
				'description'    => __( "Specify all colors used on site - both text and backgroud colors. <strong>TIP:</strong> Clicking <em>Default</em> on the color picker will restore the original color set when you loaded the Customizer." , 'weaver-xtreme' )),

		'spacing'       	 	=> array( 'title' => __( 'Spacing, Widths, Alignment', 'weaver-xtreme' ), 'priority' => 10400,
				'description'    => __( "Set margins, padding, spacing, heights, and widths." , 'weaver-xtreme' ) ),

		'style'        		=> array( 'title' => __( 'Style (borders, etc.)', 'weaver-xtreme' ), 'priority' => 10500,
				'description'    => __( "Style: borders, shadows, rounded corners, list bullet style, icons. (Important note: using rounded corners usually requires specifying a BG color or border.)" , 'weaver-xtreme' ) ),

		'typography'        => array( 'title' => __( 'Typography', 'weaver-xtreme' ), 'priority' => 10600,
				'description'    => __( "Typography: font family, font size, bold, italic." , 'weaver-xtreme' )),

		'visibility'       	 => array( 'title' => __( 'Visibility', 'weaver-xtreme' ), 'priority' => 10700,
				'description'    => __( "Specify visibility - hide various elements on various devices (desktop, tablets, phones)." , 'weaver-xtreme' )  ),

		'layout'       	 		=> array( 'title' => __( 'Layout', 'weaver-xtreme' ), 'priority' => 10800,
				'description'    => __( "Specify element layout - sidebars, etc." , 'weaver-xtreme' )  ),

		'images'			=> array( 'title' => __( 'Images', 'weaver-xtreme' ), 'priority' => 10900,
				'description'    => __( "Image Options: borders, placement, Featured Images, Header Images, Background Images." , 'weaver-xtreme' )  ),

		'content'			=> array( 'title' => __( 'Added Content (HTML Areas...)', 'weaver-xtreme' ), 'priority' => 11000,
				'description'    => __( "Specify added content: Define added content for HTML areas." , 'weaver-xtreme' )  ),


		'custom'			=> array( 'title' => __( 'Custom CSS', 'weaver-xtreme' ), 'priority' => 11100,
				'description'    => __( 'Define Custom CSS rules for whole site or specific areas. Add HTML to several "injection areas" - useful for ads or custom third party scripts. <em>Weaver Xtreme Plus</em> also allows you to define PHP code for WP filters or actions.' , 'weaver-xtreme' )  ),

		// ultimate want to add per page/post options here, but can't do it beause can't get current page or post ID to make controls selectively
		// display, or in fact access the custom options on a per page/post basis.

		//'per_page' => apply_filters('weaverx_add_per_page_customizer',array()),

		//'per_post' => apply_filters('weaverx_add_per_post_customizer',array()),

	);

	/**
	 * Filter the array of panel definitions for the Customizer.
	 *
	 * @since 1.3.0.
	 *
	 * @param array    $panels    The array of panel definitions.
	 */
	return $panels;
}
endif;

if ( ! function_exists( 'weaverx_customizer_add_panels' ) ) :
/**
 * Register Customizer panels
 */
function weaverx_customizer_add_panels( $wp_customize ) {
	$theme_prefix = 'weaverx_';

	// Get panel definitions
	$panels = weaverx_customizer_get_panels();

	// Add panels
	foreach ( $panels as $panel => $data ) {
		// Add panel
		if (!empty($data))
			$wp_customize->add_panel( $theme_prefix . $panel, $data );
	}


}
endif;

if ( ! function_exists( 'weaverx_customizer_get_sections' ) ) :
/**
 * Return the master array of Customizer sections
 *
 * @since  1.3.0.
 *
 * @return array    The master array of Customizer sections
 */
function weaverx_customizer_get_sections() {
	/**
	 * Filter the array of section definitions for the Customizer.
	 *
	 * This filter is used to compile a master array of section definitions for each
	 * panel in the Customizer.
	 *
	 * @since 1.3.0.
	 *
	 * @param array    $sections    The array of section definitions.
	 */
	$sections = apply_filters( 'weaverx_customizer_sections', array() );
	return $sections;
}
endif;

if ( ! function_exists( 'weaverx_customizer_add_sections' ) ) :
/**
 * Add sections and controls to the customizer.
 *
 * Hooked to 'customize_register' via weaverx_customizer_init().
 *
 * @since  1.0.0.
 *
 * @param  WP_Customize_Manager    $wp_customize    Theme Customizer object.
 * @return void
 */
function weaverx_customizer_add_sections( $wp_customize ) {
	$theme_prefix = 'weaverx_';
	$default_path = get_template_directory() . '/admin/customizer/sections';
	$panels       = weaverx_customizer_get_panels();



	// Load section definition files
	foreach ( $panels as $panel => $data ) {
		$file = trailingslashit( $default_path ) . $panel . '.php';
		if ( file_exists( $file ) ) {
			require_once( $file );
		}
	}

	// Compile the section definitions
	$sections = weaverx_customizer_get_sections();

	// Register each section and add its options
	$priority = array();
	foreach ( $sections as $section => $data ) {
		// Get the non-prefixed ID of the current section's panel
		$panel = ( isset( $data['panel'] ) ) ? str_replace( $theme_prefix, '', $data['panel'] ) : 'none';

		// Store the options
		if ( isset( $data['options'] ) ) {
			$options = $data['options'];
			unset( $data['options'] );
		}

		// Determine the priority
		if ( ! isset( $data['priority'] ) ) {
			$panel_priority = ( 'none' !== $panel && isset( $panels[ $panel ]['priority'] ) ) ? $panels[ $panel ]['priority'] : 1000;

			// Create a separate priority counter for each panel, and one for sections without a panel
			if ( ! isset( $priority[ $panel ] ) ) {
				$priority[ $panel ] = new weaverx_cz_Prioritizer( $panel_priority, 10 );
			}

			$data['priority'] = $priority[ $panel ]->add();
		}

		// Register section
		$wp_customize->add_section( $theme_prefix . $section, $data );

		// Add options to the section
		if ( isset( $options ) ) {
			weaverx_customizer_add_section_options( $theme_prefix . $section, $options );
			unset( $options );
		}
	}
}
endif;

function weaverx_cz_settings_name($id) {

	$theme_opts = 'weaverx_settings'; //apply_filters('weaverx_options','weaverx_settingszzz');
	return $theme_opts . '['. $id . ']';

	//return $id;
}

if ( ! function_exists( 'weaverx_customizer_add_section_options' ) ) :
/**
 * Register settings and controls for a section.
 */
function weaverx_customizer_add_section_options( $section, $args, $initial_priority = 100 ) {
	global $wp_customize;

	$priority = new weaverx_cz_Prioritizer( $initial_priority, 5 );
	$theme_prefix = 'weaverx_';

	foreach ( $args as $setting_id => $option ) {
		if ( isset( $option['setting'] ) ) {
			$defaults = array(
				'type'                 => 'option', // 'option', // 'theme_mod',  //
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => false,
				'transport'            => 'refresh',
				'sanitize_callback'    => WEAVERX_DEFAULT_SANITIZE,
				'sanitize_js_callback' => '',
			);
			$setting = wp_parse_args( $option['setting'], $defaults );

			// Add the setting arguments in array to add_setting call so Theme Check can verify the presence of sanitize_callback

			// until a couple versions after the upgraded WP Customize Setting class, we will use our own sub-class to be sure
			// the preview doesn't take forever to render. The new version seems to fix the speed issue.
			$cur_vers = weaverx_wp_version();

			//$class_setting = 'WeaverX_Customize_Setting';

			if (version_compare($cur_vers, '4.4', '<')) {
				$class_setting = 'WeaverX_Customize_Setting';
			} else {
				$class_setting = 'WP_Customize_Setting';
			}

			$wp_customize->add_setting( new $class_setting( $wp_customize, weaverx_cz_settings_name( $setting_id ),
				array(
				'type'                 => $setting['type'],
				'capability'           => $setting['capability'],
				'theme_supports'       => $setting['theme_supports'],
				'default'              => $setting['default'],
				'transport'            => $setting['transport'],
				'sanitize_callback'    => $setting['sanitize_callback'],
				'sanitize_js_callback' => $setting['sanitize_js_callback'],
			) ));

			//$wp_customize->add_setting( weaverx_cz_settings_name( $setting_id ),
			//		$usesetting);
		}

		// Add control
		if ( isset( $option['control'] ) ) {
			$control_id = $theme_prefix . $setting_id;

			$defaults = array(
				'section'  => $section,
				'priority' => $priority->add(),
				'settings'   => weaverx_cz_settings_name( $setting_id ),
			);

			if ( ! isset( $option['setting'] ) ) {
				unset( $defaults['settings'] );
			}

			$control = wp_parse_args( $option['control'], $defaults );

			// Check for a specialized control class - create new instance
			if ( isset( $control['control_type'] ) ) {
				$class = $control['control_type'];
				if ( class_exists( $class ) ) {
					unset( $control['control_type'] );

					// Dynamically generate a new class instance
					$class_instance = new $class( $wp_customize, $control_id, $control );
					$wp_customize->add_control( $class_instance );
				} else {
					if ( WEAVERX_DEV_MODE ) {
						echo '<h2>MISSING CLASS DEFINITON: '. $class . '</h2>';
					}
				}
			} else {
				$wp_customize->add_control( $control_id, $control );
			}
		}
	}

	return $priority->get();
}
endif;

if ( ! function_exists( 'weaverx_customizer_set_transport' ) ) :
/**
 * Add postMessage support for certain built-in settings in the Theme Customizer.
 *
 * Allows these settings to update asynchronously in the Preview pane.
 */
function weaverx_customizer_set_transport( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
endif;

if ( ! function_exists( 'weaverx_customizer_preview_script' ) ) :
/**
 * Enqueue customizer preview script
 *
 * Hooked to 'customize_preview_init' via weaverx_customizer_init()
 *
 */
function weaverx_customizer_preview_script() {

	wp_enqueue_script(
		'weaverx_cz-customizer-preview',
		get_template_directory_uri() . '/admin/customizer/js/customizer-preview' . WEAVERX_MINIFY . '.js',
		array( 'customize-preview' ),
		WEAVERX_VERSION,
		true
	);

	$date = getdate();
	$year = $date['year'];
	$cp = weaverx_getopt('copyright');		// so can restore default from customizer
	if (!$cp) {
		$cp = '&copy;' . $year . ' - <a href="' . esc_url(home_url( '/' )) . '" title="' .  esc_attr( get_bloginfo( 'name', 'display' ) ) .
			 '" rel="home">' . esc_attr( get_bloginfo( 'name', 'display' ) )  . '</a>';
	}

	$local = array(
		'copyright' => $cp,
		'more_msg' => __( 'Continue reading &rarr;','weaver-xtreme')
	);
	wp_localize_script('weaverx_cz-customizer-preview', 'wvrxPRE', $local );
}
endif;

// lib

function weaverx_cz_is_plus() {
	if (function_exists('weaverxplus_plugin_installed')) {
		return true;
	} else {
		return false ;
	}
}
function weaverx_cz_cache_opts() {
	if (!isset($GLOBALS['weaverx_cz_cache']))
		$GLOBALS['weaverx_cz_cache'] = array();

	$opts = get_option('weaverx_settings' ,array());

	if (!isset($opts['themename'])) {
		$opts = weaverx_cz_getdefaults();
	}

	$GLOBALS['weaverx_cz_cache'] = $opts;
}

function weaverx_cz_getdefaults() {

	$filename = apply_filters('weaverx_default_subtheme', get_template_directory() . WEAVERX_DEFAULT_THEME_FILE );

	if ( ! weaverx_f_exists( $filename ) )
		return array();

	$contents = weaverx_f_get_contents($filename);	// use either real (pro) or file (standard) version of function

	if (empty($contents)) return array();

	if (substr($contents,0,10) != 'WXT-V01.00')
		return array();

	$restore = array();
	$restore = unserialize(substr($contents,10));

	$ret = array();
	$opts = $restore['weaverx_base'];	// fetch base opts
	foreach ($opts as $opt => $val) {
		$ret[$opt] = $val;
	}
	return $ret;
}

function weaverx_cz_getopt($opt) {
	if (!isset($GLOBALS['weaverx_cz_cache'][$opt])) {	// handles changes to data structure
		return '';
	}
	$val = $GLOBALS['weaverx_cz_cache'][$opt];
	return $val ? $val : '';
}


//----------------------- customizer defines
define('WEAVERX_COLOR_CONTROL', 'Customize_Alpha_Color_Control'); //'WP_Customize_Color_Control');
define('WEAVERX_COLOR_TRANSPORT', 'postMessage'); // 'postMessage');
define('WEAVERX_SELECT_CONTROL', 'WeaverX_Select_Control');


define('WEAVERX_REFRESH_ICON', ' &#8635;');	// add "recycle" icon for options that refresh instead of postMessage

	$cur_vers = weaverx_wp_version();

	if (version_compare($cur_vers, '4.4', '<')) {	// simply takes too long in 4.3 to call all the sanitizers
		define('WEAVERX_DEFAULT_SANITIZE', null);
		define('WEAVERX_CZ_SANITIZE_COLOR', null);
		define('WEAVERX_CHOICE_SANITIZE', '_nosan');

	} else {
		define('WEAVERX_DEFAULT_SANITIZE', 'weaverx_default_sanitize');
		define('WEAVERX_CZ_SANITIZE_COLOR', 'weaverx_cz_sanitize_color');
		define('WEAVERX_CHOICE_SANITIZE', '_sanitize');
	}



if (weaverx_cz_is_plus()) {

define('WEAVERX_PLUS_ICON', ' &#8901;+&#8901;');
define('WEAVERX_PLUS_COLOR_CONTROL', WEAVERX_COLOR_CONTROL);

define('WEAVERX_PLUS_SELECT_CONTROL', 'WeaverX_Select_Control');
define('WEAVERX_PLUS_CHECKBOX_CONTROL', null);
define('WEAVERX_PLUS_TEXT_CONTROL', null);
define('WEAVERX_PLUS_TEXTAREA_CONTROL', 'WeaverX_Textarea_Control');

define('WEAVERX_PLUS_RANGE_CONTROL', 'WeaverX_Range_Control');
define('WEAVERX_PLUS_IMAGE_CONTROL', 'WP_Customize_Image_Control');
define('WEAVERX_PLUS_MISC_CONTROL', 'WeaverX_Misc_Control');


} else {	// plus not active

define('WEAVERX_PLUS_ICON', ' ( WX+ )');
define('WEAVERX_PLUS_COLOR_CONTROL', 'WeaverX_XPlus_Control');
define('WEAVERX_PLUS_SELECT_CONTROL', 'WeaverX_XPlus_Control');
define('WEAVERX_PLUS_CHECKBOX_CONTROL', 'WeaverX_XPlus_Control');
define('WEAVERX_PLUS_TEXT_CONTROL', 'WeaverX_XPlus_Control');
define('WEAVERX_PLUS_TEXTAREA_CONTROL', 'WeaverX_XPlus_Control');
define('WEAVERX_PLUS_RANGE_CONTROL', 'WeaverX_XPlus_Control');
define('WEAVERX_PLUS_IMAGE_CONTROL', 'WeaverX_XPlus_Control');
define('WEAVERX_PLUS_MISC_CONTROL', 'WeaverX_XPlus_Control');
}

} // disable customizer?
?>
