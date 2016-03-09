<?php


function weaverx_cz_choices_hide() {
	return array(
		'hide-none' => __('Do Not Hide', 'weaver-xtreme') ,
		's-hide' => __('Hide: Phones', 'weaver-xtreme'),
		'm-hide' => __('Hide: Small Tablets', 'weaver-xtreme'),
		'm-hide s-hide' => __('Hide: Phones+Tablets', 'weaver-xtreme'),
		'l-hide' => __('Hide: Desktop', 'weaver-xtreme'),
		'l-hide m-hide' => __('Hide: Desktop+Tablets', 'weaver-xtreme'),
		'hide' => __('Hide on All Devices', 'weaver-xtreme')
	);
}
function weaverx_cz_choices_hide_sanitize($val) {
	$choices = weaverx_cz_choices_hide();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_align() {
	return array(
		'float-left' => __('Align Left', 'weaver-xtreme') ,
		'center' => __('Center', 'weaver-xtreme'),
		'float-right' => __('Align Right', 'weaver-xtreme'),
	);
}
function weaverx_cz_choices_align_sanitize($val) {
	$choices = weaverx_cz_choices_align();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_repeat() {
	return array(
		'repeat' => __('Tile', 'weaver-xtreme') ,
		'repeat-x' => __('Tile Horizontally', 'weaver-xtreme') ,
		'repeat-y' => __('Tile Vertically', 'weaver-xtreme') ,
		'no-repeat' => __('No Tiling', 'weaver-xtreme') ,
	);
}
function weaverx_cz_choices_repeat_sanitize($val) {
	$choices = weaverx_cz_choices_repeat();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_border_style() {
	return array(
		'solid' => __('Solid', 'weaver-xtreme'),
		'dotted' => __('Dotted', 'weaver-xtreme'),
		'dashed' => __('Dashed', 'weaver-xtreme'),
		'double' => __('Double', 'weaver-xtreme'),
		'groove' => __('Groove', 'weaver-xtreme'),
		'ridge' => __('Ridge', 'weaver-xtreme'),
		'inset' => __('Inset', 'weaver-xtreme'),
		'outset' => __('Outset', 'weaver-xtreme'),
	);
}
function weaverx_cz_choices_border_style_sanitize($val) {
	$choices = weaverx_cz_choices_border_style();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_nav_style() {
	return array(
		'old_new' => __('Older/Newer', 'weaver-xtreme'),
		'prev_next' => __('Previous/Next', 'weaver-xtreme'),
		'paged_left' => __('Paged - Left', 'weaver-xtreme'),
		'paged_right' => __('Paged - Right', 'weaver-xtreme'),
	);
}
function weaverx_cz_choices_nav_style_sanitize($val) {
	$choices = weaverx_cz_choices_nav_style();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_single_nav_style() {
	return array(
		'title' => __('Post Titles', 'weaver-xtreme'),
		'prev_next' => __('Previous/Next', 'weaver-xtreme'),
		'hide' => __('None - no display', 'weaver-xtreme'),
	);
}
function weaverx_cz_choices_single_nav_style_sanitize($val) {
	$choices = weaverx_cz_choices_single_nav_style();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_columns() {
	return array(
		'1' => __('1 Column', 'weaver-xtreme') ,
		'2' => __('2 Columns', 'weaver-xtreme') ,
		'3' => __('3 Columns', 'weaver-xtreme') ,
		'4' => __('4 Columns', 'weaver-xtreme') ,
	);
}
function weaverx_cz_choices_columns_sanitize($val) {
	$choices = weaverx_cz_choices_columns();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_post_columns() {
	return array(
		'1' => __('1 Column', 'weaver-xtreme'),
		'2' => __('2 Columns', 'weaver-xtreme'),
		'3' => __('3 Columns', 'weaver-xtreme')
	);
}
function weaverx_cz_choices_post_columns_sanitize($val) {
	$choices = weaverx_cz_choices_post_columns();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_masonry_columns() {
	return array(
		'0' => __('Do Not Use Masonry', 'weaver-xtreme'),
		'2' => __('2 Columns', 'weaver-xtreme'),
		'3' => __('3 Columns', 'weaver-xtreme'),
		'4' => __('4 Columns', 'weaver-xtreme'),
		'5' => __('5 Columns', 'weaver-xtreme')
	);
}
function weaverx_cz_choices_masonry_columns_sanitize($val) {
	$choices = weaverx_cz_choices_masonry_columns();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_pointer() {
	return array(
		'pointer' => __('Pointer (indicates link)', 'weaver-xtreme'),
		'context-menu' => __('Context Menu available', 'weaver-xtreme') ,
		'text' => __('Text', 'weaver-xtreme') ,
		'none' => __('No pointer', 'weaver-xtreme') ,
		'not-allowed' => __('Action not allowed', 'weaver-xtreme') ,
		'default' => __('The default cursor', 'weaver-xtreme')
	);
}
function weaverx_cz_choices_pointer_sanitize($val) {
	$choices = weaverx_cz_choices_pointer();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_align_menu() {
	return array(
		'left' => __('Align Left', 'weaver-xtreme') ,
		'center' => __('Center', 'weaver-xtreme'),
		'right' => __('Align Right', 'weaver-xtreme'),
	);
}
function weaverx_cz_choices_align_menu_sanitize($val) {
	$choices = weaverx_cz_choices_align_menu();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_fi_location() {
	return array(
		'content-top' => __('With Content - top', 'weaver-xtreme'),
		'content-bottom' => __('With Content - bottom', 'weaver-xtreme'),
		'title-before' => __('With Title', 'weaver-xtreme'),
		'header-image' => __('Header Image Replacement', 'weaver-xtreme'),
		'post-before' => __('Outside of Page/Post', 'weaver-xtreme'),
	);
}
function weaverx_cz_choices_fi_location_sanitize($val) {
	$choices = weaverx_cz_choices_fi_location();
	return (isset($choices[$val])) ? $val : '';
}


function weaverx_cz_choices_fi_size() {
	return array(
		'thumbnail' => __('Thumbnail', 'weaver-xtreme'),
		'medium' => __('Medium', 'weaver-xtreme'),
		'large' => __('Large', 'weaver-xtreme'),
		'full' => __('Full', 'weaver-xtreme'),
	);
}
function weaverx_cz_choices_fi_size_sanitize($val) {
	$choices = weaverx_cz_choices_fi_size();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_fi_align() {
	return array(
		'fi-alignleft' => __('Align Left', 'weaver-xtreme') ,
		'fi-aligncenter' => __('Center', 'weaver-xtreme'),
		'fi-alignright' => __('Align Right', 'weaver-xtreme'),
		'fi-alignnone' => __('No Align', 'weaver-xtreme'),
	);
}
function weaverx_cz_choices_fi_align_sanitize($val) {
	$choices = weaverx_cz_choices_fi_align();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_show_avatar() {
	return array(
		'hide' => __('Do Not Show', 'weaver-xtreme') ,
		'start' => __('Start of Info Line', 'weaver-xtreme') ,
		'end' => __('End of Info Line', 'weaver-xtreme') ,
	);
}
function weaverx_cz_choices_show_avatar_sanitize($val) {
	$choices = weaverx_cz_choices_show_avatar();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_post_icons() {
	return array(
		'text' => __('Text Descriptions', 'weaver-xtreme') ,
		'fonticons' => __('Font Icons', 'weaver-xtreme') ,
		'graphics' => __('Graphic Icons', 'weaver-xtreme') ,
	);
}
function weaverx_cz_choices_post_icons_sanitize($val) {
	$choices = weaverx_cz_choices_post_icons();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_font_size() {
	return array(
		'default' => __('Inherit', 'weaver-xtreme'),
		'm-font-size' => __('Medium Font', 'weaver-xtreme'),
		'xxs-font-size' => __('XX-Small Font', 'weaver-xtreme'),
		'xs-font-size' => __('X-Small Font', 'weaver-xtreme'),
		's-font-size' => __('Small Font', 'weaver-xtreme'),
		'l-font-size' => __('Large Font', 'weaver-xtreme'),
		'xl-font-size' => __('X-Large Font', 'weaver-xtreme'),
		'xxl-font-size' => __('XX-Large Font', 'weaver-xtreme'),
		'customA-font-size' => __('Custom Size A', 'weaver-xtreme'),
		'customB-font-size' => __('Custom Size B', 'weaver-xtreme')
	);
}
function weaverx_cz_choices_font_size_sanitize($val) {
	$choices = weaverx_cz_choices_font_size();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_list_bullets() {
	return array(
		'disc' => __('Filled Disc', 'weaver-xtreme'),
		'circle' => __('Circle', 'weaver-xtreme'),
		'square' => __('Square', 'weaver-xtreme'),
		'none' => __('None', 'weaver-xtreme'),
		);
}
function weaverx_cz_choices_list_bullets_sanitize($val) {
	$choices = weaverx_cz_choices_list_bullets();
	return (isset($choices[$val])) ? $val : '';
}


function weaverx_cz_choices_font_family() {

	$base = array(
		'inherit' => __('Inherit', 'weaver-xtreme'),
		);
	$google = array(
		'google' => __('---* Google Fonts (For All Browsers) *', 'weaver-xtreme'),
		'sans-g' => __('--- -- Sans-Serif Google Fonts --', 'weaver-xtreme'),
		'open-sans' => __('Open Sans', 'weaver-xtreme'),
		'open-sans-condensed' => __('Open Sans Condensed', 'weaver-xtreme'),
		'alegreya-sans' => __('Alegreya Sans', 'weaver-xtreme'),
		'archivo-black' => __('Archivo Black', 'weaver-xtreme'),
		'arimo' => __('Arimo', 'weaver-xtreme'),
		'droid-sans' => __('Droid Sans', 'weaver-xtreme'),
		'exo-2' => __('Exo 2', 'weaver-xtreme'),
		'lato' => __('Lato', 'weaver-xtreme'),
		'roboto' => __('Roboto', 'weaver-xtreme'),
		'roboto-condensed' => __('Roboto Condensed', 'weaver-xtreme'),
		'source-sans-pro' => __('Source Sans Pro', 'weaver-xtreme'),

		'serif-g' => __('--- -- Serif Google Fonts --', 'weaver-xtreme'),
		'alegreya' => __('Alegreya', 'weaver-xtreme'),
		'arvo' => __('Arvo Slab', 'weaver-xtreme'),
		'droid-serif' => __('Droid Serif', 'weaver-xtreme'),
		'lora' => __('Lora', 'weaver-xtreme'),
		'roboto-slab' => __('Roboto Slab', 'weaver-xtreme'),
		'source-serif-pro' => __('Source Serif Pro', 'weaver-xtreme'),
		'tinos' => __('Tinos', 'weaver-xtreme'),
		'vollkorn' => __('Vollkorn', 'weaver-xtreme'),
		'ultra' => __('Ultra Black', 'weaver-xtreme'),

		'mono-g' => __('--- -- Monospace Google Fonts --', 'weaver-xtreme'),

		'inconsolata' => __('Inconsolata', 'weaver-xtreme'),
		'roboto-mono' => __('Roboto Mono', 'weaver-xtreme'),

		'cursive-g' => __('--- -- "Cursive" Google Fonts --', 'weaver-xtreme'),

		'handlee' => __('Handlee', 'weaver-xtreme'),

		'blank-w' => __('--- ', 'weaver-xtreme'),

		);

	$web = array(

		'web' => __('---* Web Fonts *', 'weaver-xtreme'),
		'web-hote' => __('--- - May not match on Android/iOS -', 'weaver-xtreme'),
		'sans-w' => __('--- -- Sans-Serif Web Fonts --', 'weaver-xtreme'),


		'sans-serif' => __('Arial', 'weaver-xtreme'),
		'arialBlack' => __('Arial Black', 'weaver-xtreme'),
		'arialNarrow' => __('Arial Narrow', 'weaver-xtreme'),
		'lucidaSans' => __('Lucida Sans', 'weaver-xtreme'),
		'trebuchetMS' => __('Trebuchet MS', 'weaver-xtreme'),
		'verdana' => __('Verdana', 'weaver-xtreme'),

		'serif-w' => __('--- -- Serif Web Fonts --', 'weaver-xtreme'),

		'serif' => __('Times', 'weaver-xtreme'),
		'cambria' => __('Cambria', 'weaver-xtreme'),
		'garamond' => __('Garamond', 'weaver-xtreme'),
		'georgia' => __('Georgia', 'weaver-xtreme'),
		'lucidaBright' => __('Lucida Bright', 'weaver-xtreme'),
		'palatino' => __('Palatino', 'weaver-xtreme'),

		'mono-w' => __('--- -- Monospace Web Fonts --', 'weaver-xtreme'),

		'monospace' => __('Courier', 'weaver-xtreme'),
		'consolas' => __('Consolas', 'weaver-xtreme'),

		'cursive-w' => __('--- -- "Cursive" Web Fonts --', 'weaver-xtreme'),

		'papyrus' =>__('Papyrus', 'weaver-xtreme'),
		'comicSans' => __('Comic Sans MS', 'weaver-xtreme'),

	);

	$gfonts = weaverx_getopt_array('fonts_added');

    if ( !empty($gfonts) ) {
        foreach ($gfonts as $gfont => $val ) {
            // $gfont has slug, $val has vals
            $base[$gfont] = $val['name'] . ' (' . WEAVERX_PLUS_ICON . 'font)';
        }
    }
	if ( ! weaverx_getopt('disable_google_fonts')) {
		$base = array_merge($base, $google);
	}
	$base = array_merge($base, $web);

	return $base;
}

function weaverx_cz_choices_font_family_sanitize($val) {
	$choices = weaverx_cz_choices_font_family();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_bold_italic() {
	return array(
		'' 		=> __('Inherit', 'weaver-xtreme'),
		'on' 	=> __('On', 'weaver-xtreme'),
		'off' 	=> __('Off', 'weaver-xtreme')
	);
}
function weaverx_cz_choices_bold_italic_sanitize($val) {
	$choices = weaverx_cz_choices_bold_italic();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_sb_layout() {
	return array(
		'right' 	=> __('Sidebars on Right', 'weaver-xtreme'),
		'right-top' => __('Sidebars on Right (stack top)', 'weaver-xtreme'),
		'left' 		=> __('Sidebars on Left', 'weaver-xtreme'),
		'left-top' 	=> __('Sidebars on Left (stack top)', 'weaver-xtreme'),
		'split' 	=> __('Split - Sidebars on Right and Left', 'weaver-xtreme'),
		'split-top' => __('Split (stack top)', 'weaver-xtreme'),
		'one-column' => __('No sidebars, content only', 'weaver-xtreme')
	);
}
function weaverx_cz_choices_sb_layout_sanitize($val) {
	$choices = weaverx_cz_choices_sb_layout();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_sb_layout_default() {
	return array(
		'default' 	=> __('Sidebars on Use Default', 'weaver-xtreme'),
		'right' 	=> __('Sidebars on Right', 'weaver-xtreme'),
		'right-top' => __('Sidebars on Right (stack top)', 'weaver-xtreme'),
		'left' 		=> __('Sidebars on Left', 'weaver-xtreme'),
		'left-top' 	=> __('Sidebars on Left (stack top)', 'weaver-xtreme'),
		'split' 	=> __('Split - Sidebars on Right and Left', 'weaver-xtreme'),
		'split-top' => __('Split (stack top)', 'weaver-xtreme'),
		'one-column' => __('No sidebars, content only', 'weaver-xtreme')
	);
}
function weaverx_cz_choices_layout_default_sanitize($val) {
	$choices = weaverx_cz_choices_layout_default();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_shadow() {
	return array(
		"-0"	=>	__('No Shadow', 'weaver-xtreme'),
		"-1"	=>	__('All Sides, 1px', 'weaver-xtreme'),
		"-2"	=>	__('All Sides, 2px', 'weaver-xtreme'),
		"-3"	=>	__('All Sides, 3px', 'weaver-xtreme'),
		"-4"	=>	__('All Sides, 4px', 'weaver-xtreme'),
		"-rb"	=>	__('Right + Bottom', 'weaver-xtreme'),
		"-lb"	=>	__('Left + Bottom', 'weaver-xtreme'),
		"-tr"	=>	__('Top + Right', 'weaver-xtreme'),
		"-tl"	=>	__('Top + Left', 'weaver-xtreme'),
		"-custom"	=>	__('Custom Shadow', 'weaver-xtreme'),
	);
}
function weaverx_cz_choices_shadow_sanitize($val) {
	$choices = weaverx_cz_choices_shadow();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_rounded() {
	return array(
		"none"	=>	__('None', 'weaver-xtreme'),
		"-all"	=>	__('All Corners', 'weaver-xtreme'),
		"-left"	=>	__('Left Corners', 'weaver-xtreme'),
		"-right"	=>	__('Right Corners', 'weaver-xtreme'),
		"-top"	=>	__('Top Corners', 'weaver-xtreme'),
		"-bottom"	=>	__('Bottom Corners', 'weaver-xtreme'),
	);
}
function weaverx_cz_choices_rounded_sanitize($val) {
	$choices = weaverx_cz_choices_rounded();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_tables() {
	return array(
		'default'	=>	__('Theme Default', 'weaver-xtreme'),
		'bold'	=>	__('Bold Headings', 'weaver-xtreme'),
		'noborders'	=>	__('No Border', 'weaver-xtreme'),
		'fullwidth'	=>	__('Wide', 'weaver-xtreme'),
		'wide'	=>	__('Wide 2', 'weaver-xtreme'),
		'plain'	=>	__('Minimal', 'weaver-xtreme')
	);
}
function weaverx_cz_choices_tables_sanitize($val) {
	$choices = weaverx_cz_choices_tables();
	return (isset($choices[$val])) ? $val : '';
}

function weaverx_cz_choices_search() {
	return array(
		"black" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-black.png" />',
		"gray" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-gray.png" />',
		"light" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-light.png" />',
		"white" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-white.png" />',
		"black-bg" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-black-bg.png" />',
		"gray-bg" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-gray-bg.png" />',
		"white-bg" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-white-bg.png" />',
		"blue-bg" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-blue-bg.png" />',
		"green-bg" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-green-bg.png" />',
		"orange-bg" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-orange-bg.png" />',
		"red-bg" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-red-bg.png" />',
		"yellow-bg" => '<img style="background-color:#ccc;height:24px;width:24px;" src="/wp-content/themes/weaver-xtreme/assets/css/icons/search-yellow-bg.png" />',

	);
}
function weaverx_cz_choices_search_sanitize($val) {
	$choices = weaverx_cz_choices_search();
	return (isset($choices[$val])) ? $val : '';
}

// utility

function weaverx_cz_add_plus_message($root, $label = '', $description = '') {
	$opt = array();
	$opt[$root . '-heading'] = array(
		'control' => array( 'control_type' => 'WeaverX_Misc_Control',
		'label'   => $label . ' (Plus Feature)',
		'type'  => 'group-title'));

	if ($description) {
		$opt[$root . '-desc'] = array(
		'control' => array( 'control_type' => 'WeaverX_Misc_Control',
		'description'   => $description,
		'type'  => 'text'));
	}
	$xplus = site_url('/wp-admin/themes.php?page=WeaverX', 'relative');
	$weaversite = '//shop.weavertheme.com';
	$opt[$root . 'extra-plus'] = array(
		'control' => array( 'control_type' => 'WeaverX_Misc_Control',
		'description'   => sprintf(__('See the <a href="%s" ><em>Appearance &rarr; Weaver Xtreme Admin</em></a> panel for related settings. Get <strong><a href="%s" target="_blank">Weaver Xtreme Plus</strong></a> to add this feature.', 'weaver-xtreme'), $xplus, $weaversite),
		'type'  => 'text'));

	return $opt;
}

function weaverx_cz_get_admin_page( $link = 'default', $section = '', $target = '_self') {
	// eventually we might be able to link to a $section of the Weaver Xtreme Admin page
	if ($link == 'default') $link = __('Weaver Xtreme Admin Panel', 'weaver-xtreme');
	return '<a href="' . site_url('/wp-admin/themes.php?page=WeaverX', 'relative') . '" title="' . $link . " target=" . $target . '">' . $link . '</a>';
}

function weaverx_cz_line() {
	return array(
		'control' => array(
			'control_type' => 'WeaverX_Misc_Control', 'type'  => 'line',
		)
	);
}

// other sanitization ************************

/**
 * Sanitize a string to ensure that it is a float number.
 *
 */
function weaverx_cz_sanitize_float( $value ) {
	return floatval( $value );
}

function weaverx_default_sanitize($in) {
	// called for checkboxes, which must be okay
	return $in;
}


if ( ! function_exists( 'weaverx_cz_sanitize_text' ) ) :
/**
 * Allow only certain tags and attributes in a string.
 */
function weaverx_cz_sanitize_text( $string ) {
	$allowedtags = wp_kses_allowed_html();
	$allowedtags = wp_kses_allowed_html();
	$allowedtags['a']['target'] = true;

	// span
	$allowedtags['span'] = array();

	// Enable id, class, and style attributes for each tag
	foreach ( $allowedtags as $tag => $attributes ) {
		$allowedtags[$tag]['id']    = true;
		$allowedtags[$tag]['class'] = true;
		$allowedtags[$tag]['style'] = true;
	}

	// br (doesn't need attributes)
	$allowedtags['br'] = array();

	return wp_kses( $string, $expandedtags );;

}
endif;

if ( ! function_exists( 'weaverx_cz_sanitize_html' ) ) :
/**
 * Allow only certain tags and attributes in a string.
 */
function weaverx_cz_sanitize_html( $string ) {

	return weaverx_filter_code( $string );

}
endif;

if ( ! function_exists( 'weaverx_cz_sanitize_head_code' ) ) :
/**
 * Allow only certain tags and attributes in a string.
 */
function weaverx_cz_sanitize_head_code( $string ) {

	return weaverx_filter_code( $string );

}
endif;


if ( ! function_exists( 'weaverx_cz_sanitize_code' ) ) :
/**
 * Allow only certain tags and attributes in a string.
 */
function weaverx_cz_sanitize_code( $string ) {

	return weaverx_filter_code( $string );

}
endif;

if ( ! function_exists( 'weaverx_cz_sanitize_css' ) ) :
/**
 * Allow only certain tags and attributes in a string.
 */
function weaverx_cz_sanitize_css( $string ) {

	return weaverx_filter_code( $string );

}
endif;

function weaverx_cz_sanitize_color( $color ) {
	// sanitize color - allow rgb, rgba, color names, otherwise force to hashed hex

	/* $color_names = array(
		'AliceBlue', 'AntiqueWhite', 'Aqua', 'Aquamarine', 'Azure', 'Beige', 'Bisque', 'Black', 'BlanchedAlmond', 'Blue',
		'BlueViolet', 'Brown', 'BurlyWood', 'CadetBlue', 'Chartreuse', 'Chocolate', 'Coral', 'CornflowerBlue', 'Cornsilk', 'Crimson',
		'Cyan', 'DarkBlue', 'DarkCyan', 'DarkGoldenRod', 'DarkGray','DarkGreen', 'DarkKhaki', 'DarkMagenta', 'DarkOliveGreen', 'DarkOrange',
		'DarkOrchid', 'DarkRed', 'DarkSalmon', 'DarkSeaGreen', 'DarkSlateBlue', 'DarkSlateGray', 'DarkTurquoise', 'DarkViolet', 'DeepPink', 'DeepSkyBlue',
		'DimGray', 'DodgerBlue', 'FireBrick', 'FloralWhite', 'ForestGreen', 'Fuchsia', 'Gainsboro', 'GhostWhite', 'Gold', 'Goldenrod',
		'Gray', 'Green', 'GreenYellow', 'Honeydew', 'HotPink', 'IndianRed', 'Indigo', 'Ivory', 'Khaki', 'Lavender',
		'LavenderBlush', 'LawnGreen', 'LemonChiffon', 'LightBlue', 'LightCoral', 'LightCyan', 'LightGoldenrodYellow', 'LightGreen', 'LightGrey', 'LightPink',
		'LightSalmon', 'LightSeaGreen', 'LightSkyBlue', 'LightSlateGray', 'LightSteelBlue', 'LightYellow', 'Lime', 'LimeGreen', 'Linen', 'Magenta',
		'Maroon', 'MediumAquamarine', 'MediumBlue', 'MediumOrchid', 'MediumPurple', 'MediumSeaGreen', 'MediumSlateBlue', 'MediumSpringGreen', 'MediumTurquoise', 'MediumVioletRed',
		'MidnightBlue', 'MintCream', 'MistyRose', 'Moccasin', 'NavajoWhite', 'Navy', 'OldLace', 'Olive', 'OliveDrab', 'Orange',
		'OrangeRed', 'Orchid', 'PaleGoldenrod', 'PaleGreen', 'PaleTurquoise', 'PaleVioletRed', 'PapayaWhip', 'PeachPuff', 'Peru', 'Pink',
		'Plum', 'PowderBlue', 'Purple', 'Red', 'RosyBrown', 'RoyalBlue', 'SaddleBrown', 'Salmon', 'SandyBrown', 'SeaGreen',
		'Seashell', 'Sienna', 'Silver', 'SkyBlue', 'SlateBlue', 'SlateGray', 'Snow', 'SpringGreen', 'SteelBlue', 'Tan',
		'Teal', 'Thistle', 'Tomato', 'Turquoise', 'Violet', 'Wheat', 'White', 'WhiteSmoke', 'Yellow', 'YellowGreen'
	); */
	$color_names = array(
		'aliceblue', 'antiquewhite', 'aqua', 'aquamarine', 'azure', 'beige', 'bisque', 'black', 'blanchedalmond', 'blue',
		'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson',
		'cyan', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray','darkgreen', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange',
		'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue',
		'dimgray', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'fuchsia', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod',
		'gray', 'green', 'greenyellow', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender',
		'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgreen', 'lightgrey', 'lightpink',
		'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightsteelblue', 'lightyellow', 'lime', 'limegreen', 'linen', 'magenta',
		'maroon', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred',
		'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'navy', 'oldlace', 'olive', 'olivedrab', 'orange',
		'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink',
		'plum', 'powderblue', 'purple', 'red', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen',
		'seashell', 'sienna', 'silver', 'skyblue', 'slateblue', 'slategray', 'snow', 'springgreen', 'steelblue', 'tan',
		'teal', 'thistle', 'tomato', 'turquoise', 'violet', 'wheat', 'white', 'whitesmoke', 'yellow', 'yellowgreen', 'inherit', 'transparent'
	);

	$color = str_replace(' ', '', strtolower($color));
	if ( !$color )
		return 'inherit';

	if (strpos($color, 'rgb') === 0) {		// rgb value
		return $color;
	} else if (in_array($color, $color_names)) {	// CSS color names
		return $color;
	} else {
		// force leading #
		// 3 or 6 hex digits, or the empty string.
		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			return ($color[0] == '#') ? $color : '#' . $color;
		} else {
			return 'inherit';
		}
	}
}

// Classes ***********************************************

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WeaverX_Textarea_Control' ) ) :
class WeaverX_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';

    public function render_content() {
		if (isset($this->input_attrs['rows']))
			$rows = $this->input_attrs['rows'];
		else
			$rows = 4;
		if (isset($this->input_attrs['placeholder']))
			$placeholder = $this->input_attrs['placeholder'];
		else
			$placeholder = '';

        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php
		if ( '' !== $this->description ) {
			echo '<span class="description customize-control-description">' . $this->description . '</span>';
		}
		?>
        <textarea rows="<?php echo $rows;?>" placeholder="<?php echo esc_html($placeholder);?>" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
        <?php
    }
}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WeaverX_Misc_Control' ) ) :
/**
 * Class WeaverX_Misc_Control
 *
 * Control for adding arbitrary HTML to a Customizer section.
 *
 */
class WeaverX_Misc_Control extends WP_Customize_Control {
	/**
	 * The current setting name.
	 */
	public $settings = 'blogname';

	/**
	 * The current setting description.
	 */
	public $description = '';

	/**
	 * Render the description and title for the section.
	 *
	 */
	public function render_content() {
		switch ( $this->type ) {
			case 'group-title' :
				echo '<h4 class="weaverx-control-group-title">' . esc_html( $this->label ) . '</h4>';
				if ( '' !== $this->description ) {
					echo '<span class="description customize-control-description">' . $this->description . '</span>';
				}
				break;
			case 'heading' :
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
				if ( '' !== $this->description ) {
					echo '<span class="description customize-control-description">' . $this->description . '</span>';
				}
				break;

			case 'HTML':

				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
				if ( '' !== $this->description ) {
					echo '<span class="custom-html customize-control-html">' . weaverx_cz_sanitize_html($this->description) . '</span>';
				}
				break;

			case 'radio-icons':
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
				if ( '' !== $this->description ) {
					echo '<span class="custom-radio customize-control-description">' . $this->description . '</span>';
				}

				if ( empty( $this->choices ) )
					return;

				$name = '_customize-radio-' . $this->id;
				echo '<br />';

				foreach ( $this->choices as $value => $label ) {
					?>
					<label>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
						<?php echo weaverx_cz_sanitize_html( $label ); ?><span style="margin-right:.5em;">&nbsp;</span>
					</label>
					<?php
				}
				break;

			case 'select-fontfamily':
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
				if ( '' !== $this->description ) {
					echo '<span class="custom-html customize-control-description">' . $this->description . '</span>';
				}

				if ( empty( $this->choices ) )
					return;

				$name = '_customize-select-' . $this->id;
				echo '<br /><select>';

				foreach ( $this->choices as $value => $label ) {
					?>
					<label>
						<option value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" selected=" <?php checked( $this->value(), $value ); ?>" >
						<?php echo weaverx_cz_sanitize_code( $label ); ?></option>
					</label>
					<?php
				}
				echo '</select>';
				break;


			default:
			case 'text' :
				echo '<p class="description customize-control-description">' . weaverx_cz_sanitize_html($this->description) . '</p>';
				break;
			case 'line' :
				echo '<hr />';
				break;
		}
	}
}
endif;

// lib

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WeaverX_XPlus_Control' ) ) :
/**
 * Class WeaverX_XPlus_Control
 *
 * Only displays title and description for XPlus
 *
 */
class WeaverX_XPlus_Control extends WP_Customize_Control {

	public $description = '';

	/**
	 * Render the description and title for the section.
	 *
	 * displays special message for Weaver Plus
	 *
	 */
	public function render_content() {

		echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		if ( '' !== $this->description && $this->type != 'HTML') {
			echo '<span class="description customize-control-description">' . $this->description . '</span>';
		}
		$t_dir = weaverx_relative_url('') . 'assets/images/xplus-link.png';
		$wplus = '//shop.weavertheme.com';
		$link = "<a style='text-decoration:none;' href='{$wplus}' target='_blank'><img src='{$t_dir}' /></a>";
		$link = "<a style='text-decoration:none;font-weight:bold;font-style:italic;background-color:#FFE4B5;padding:1px 4px;' href='{$wplus}' target='_blank'>Weaver Xtreme Plus.</a>";

		echo '<span class="description customize-control-description">' .
			sprintf(__('<strong>&starf; <em>Add this setting!</em> Get %s</strong>', 'weaver-xtreme'), $link ) .
			'</span>';
	}
}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WeaverX_Select_Control' ) ) :
/**
 * Class WeaverX_Select_Control
 *
 * Specialized select control to enable disabled option support.

 *
 */
class WeaverX_Select_Control extends WP_Customize_Control {
	public $type = 'range';

	protected function render_content() {
		if ( empty( $this->choices ) )
					return;

?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>

			<select <?php $this->link(); ?>>
				<?php
				foreach ( $this->choices as $value => $label ) {
					$disabled = '';
					if (strpos($label,'---') !== false) {
						$disabled = ' disabled';
						$label = str_replace( '---', '', $label);
					}
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . $disabled .'>' . $label . '</option>';
				}
				?>
			</select>
		</label>
<?php
	}
}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WeaverX_Range_Control' ) ) :
/**
 * Class WeaverX_Range_Control
 *
 * Specialized range control to enable a slider with an accompanying number field.
 *
 * Inspired by Kirki.
 * @link https://github.com/aristath/kirki/blob/0.5/includes/controls/class-Kirki_Customize_Sliderui_Control.php
 *
 */
class WeaverX_Range_Control extends WP_Customize_Control {
	public $type = 'range';
	public $mode = 'slider';


	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-slider' );
	}


	protected function render() {
		$id    = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
		$class = 'customize-control customize-control-' . $this->type . ' customize-control-' . $this->type . '-' . $this->mode;

		?><li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
			<?php $this->render_content(); ?>
		</li><?php
	}


	protected function render_content() { ?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
			<div id="slider_<?php echo $this->id; ?>" class="weaverx-range-slider"></div>
			<input id="input_<?php echo $this->id; ?>" class="weaverx-control-range" type="number" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
		</label>
	<?php
	}
}
endif;

if ( ! class_exists( 'weaverx_cz_Prioritizer' ) ) :
/**
 * Class weaverx_cz_Prioritizer
 *
 * Increment upward from a starting number with each call to add().
 *
 */
class weaverx_cz_Prioritizer {
	/**
	 * The starting priority.
	 *
	 * @since 1.0.0.
	 *
	 * @var   int    The priority used to start the incrementor.
	 */
	var $initial_priority = 0;

	/**
	 * The amount to increment for each step.
	 *
	 * @since 1.0.0.
	 *
	 * @var   int    The amount to increment for each step.
	 */
	var $increment = 0;

	/**
	 * Holds the reference to the current priority value.
	 *
	 * @since 1.0.0.
	 *
	 * @var   int    Holds the reference to the current priority value.
	 */
	var $current_priority = 0;

	/**
	 * Set the initial properties on init.
	 *
	 * @param  int                    $initial_priority    Value to being the counter.
	 * @param  int                    $increment           Value to increment the counter by.
	 * @return weaverx_cz_Prioritizer
	 */
	function __construct( $initial_priority = 100, $increment = 100 ) {
		$this->initial_priority = absint( $initial_priority );
		$this->increment        = absint( $increment );
		$this->current_priority = $this->initial_priority;
	}

	/**
	 * Get the current value.
	 *
	 * @since  1.0.0.
	 *
	 * @return int    The current priority value.
	 */
	public function get() {
		return $this->current_priority;
	}

	/**
	 * Increment the priority.
	 *
	 * @since  1.0.0.
	 *
	 * @param  int    $increment    The value to increment by.
	 * @return void
	 */
	public function inc( $increment = 0 ) {
		if ( 0 === $increment ) {
			$increment = $this->increment;
		}
		$this->current_priority += absint( $increment );
	}

	/**
	 * Increment by the $this->increment value.
	 *
	 * @since  1.0.0.
	 *
	 * @return int    The priority value.
	 */
	public function add() {
		$priority = $this->get();
		$this->inc();
		return $priority;
	}

	/**
	 * Change the current priority and/or increment value.
	 *
	 * @since  1.3.0.
	 *
	 * @param  null|int    $new_priority     The new current priority.
	 * @param  null|int    $new_increment    The new increment value.
	 * @return void
	 */
	public function set( $new_priority = null, $new_increment = null ) {
		if ( ! is_null( $new_priority ) ) {
			$this->current_priority = absint( $new_priority );
		}
		if ( ! is_null( $new_increment ) ) {
			$this->increment = absint( $new_increment );
		}
	}

	/**
	 * Reset the counter.
	 *
	 * @since  1.0.0.
	 *
	 * @return void
	 */
	public function reboot() {
		$this->current_priority = $this->initial_priority;
	}
}
endif;

/**
 * custom Customize Setting class.
 *
 * Handles saving and sanitizing of settings - work around for O(n^2) issue in WP 4.3 and before
 *
 */
class WeaverX_Customize_Setting extends WP_Customize_Setting {
	static $cache = array();

	static $filter_added = false;


	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct($manager, $id, $args);	// set up the id_data, etc.

		if (! WeaverX_Customize_Setting::$filter_added ) {
			add_filter( 'pre_option_' . $this->id_data[ 'base' ], 'WeaverX_Customize_Setting::_preview_filter_cache'  );
			add_filter( 'option_' . $this->id_data[ 'base' ], 'WeaverX_Customize_Setting::_preview_filter_cache' );
			add_filter( 'default_option_' . $this->id_data[ 'base' ], 'WeaverX_Customize_Setting::_preview_filter_cache'  );
			WeaverX_Customize_Setting::$filter_added = true;
		}

	}

	public function preview() {
		if ( ! isset( $this->_original_value ) ) {
			$this->_original_value = $this->value();
		}
		if ( ! isset( $this->_previewed_blog_id ) ) {
			$this->_previewed_blog_id = get_current_blog_id();
		}

		switch( $this->type ) {
			case 'theme_mod' :
				add_filter( 'theme_mod_' . $this->id_data[ 'base' ], array( $this, '_preview_filter' ) );
				break;

			case 'option' :
				if (! is_array(WeaverX_Customize_Setting::$cache) ) {
					WeaverX_Customize_Setting::$cache = array();	// make it an array once
				}
				WeaverX_Customize_Setting::$cache[] = $this;
				break;
			default :
				/**
				 * Fires when the {@see WP_Customize_Setting::preview()} method is called for settings
				 * not handled as theme_mods or options.
				 *
				 * The dynamic portion of the hook name, `$this->id`, refers to the setting ID.
				 *
				 * @since 3.4.0
				 *
				 * @param WP_Customize_Setting $this {@see WP_Customize_Setting} instance.
				 */
				do_action( "customize_preview_{$this->id}", $this );

				/**
				 * Fires when the {@see WP_Customize_Setting::preview()} method is called for settings
				 * not handled as theme_mods or options.
				 *
				 * The dynamic portion of the hook name, `$this->type`, refers to the setting type.
				 *
				 * @since 4.1.0
				 *
				 * @param WP_Customize_Setting $this {@see WP_Customize_Setting} instance.
				 */
				do_action( "customize_preview_{$this->type}", $this );
		}
	}


	static function _preview_filter_cache( $original ) {
		if (!isset( WeaverX_Customize_Setting::$cache ) || empty($original) ) // nothing to do
			return $original;

		foreach ( WeaverX_Customize_Setting::$cache as $set_this ) {
			$id = $set_this->id_data['keys'][0];	// may need to fix this if value is an array.

			$undefined = new stdClass(); // symbol hack
			$post_value = $set_this->post_value( $undefined );
			if ( $undefined === $post_value ) {
				$value = $set_this->_original_value;
			} else {
				$value = $post_value;
			}

		    if ( empty( $value ) )	// if new is empty, then unset the original, too.
				unset($original[$id]);
			else
				$original[$id] = $value;
		}
		return $original;
	}
} // end WeaverX_Customize_Setting

// ++++++++++++++++++++++++++++++++  setting helpers

function weaverx_cz_select( $label, $description, $choices, $default = '', $transport = 'refresh') {
	/*
	'select' => weaverx_cz_select(
				label,
				description,
				'choices',	'deflt', 'refresh'
			),
	*/
	if ($transport == 'refresh' && $label)
		$label .= WEAVERX_REFRESH_ICON;
	if (function_exists($choices . WEAVERX_CHOICE_SANITIZE))
		$sanitize = $choices . WEAVERX_CHOICE_SANITIZE;
	else
		$sanitize = WEAVERX_DEFAULT_SANITIZE;

	return array(
		'setting' => array(
			'default' => $default,
			'sanitize_callback' => $sanitize,
			'transport' => $transport
		),
		'control' => array(
			'control_type' => WEAVERX_SELECT_CONTROL,
			'label' => $label,
			'description' => $description,
			'type'	=> 'select',
			'choices' => $choices()
		),
	);
}


function weaverx_cz_select_plus( $label, $description, $choices, $default = '', $transport = 'refresh') {
	/*
	'select_plus' => weaverx_cz_select_plus(
				label,
				description,
				'choices',	'deflt'
			),
	*/
	$label .= WEAVERX_PLUS_ICON;
	if ($transport == 'refresh')
		$label .= WEAVERX_REFRESH_ICON;
	if (function_exists($choices . '_sanitize'))
		$sanitize = $choices . '_sanitize';
	else
		$sanitize = WEAVERX_DEFAULT_SANITIZE;

	return array(
		'setting' => array(
			'default' => $default,
			'sanitize_callback' => $sanitize,
			'transport' => $transport
		),
		'control' => array(
			'control_type' => WEAVERX_PLUS_SELECT_CONTROL,
			'label' => $label,
			'description' => $description,
			'type'	=> 'select',
			'choices' => $choices()
		),
	);
}

function weaverx_cz_coloropt($opt, $label, $description = '', $transport = WEAVERX_COLOR_TRANSPORT) {
	/*
	'coloropt' => weaverx_cz_coloropt(
				'opt',
				label,
				description,
				transport
			),
	*/
	if ($transport == 'refresh')
		$label .= WEAVERX_REFRESH_ICON;
	$default = weaverx_cz_getopt($opt);
	if (!$default)
		$default = 'inherit';
	return array(
		'setting' => array(
			'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
			'transport' => $transport, 'default' => $default,
		),
		'control' => array(
			'control_type' => WEAVERX_COLOR_CONTROL,
			'label'        => $label,
			'description'  => $description
		)
	);
}

function weaverx_cz_coloropt_plus($opt, $label, $description = '', $transport = WEAVERX_COLOR_TRANSPORT) {
	/*
	'coloropt' => weaverx_cz_coloropt_plus(
				'opt',
				label,
				description,
				transport
			),
	*/
	$label .= WEAVERX_PLUS_ICON;
	if ($transport == 'refresh')
		$label .= WEAVERX_REFRESH_ICON;
	$default = weaverx_cz_getopt($opt);
	if (!$default)
		$default = 'inherit';
	return array(
		'setting' => array(
			'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
			'transport' => $transport, 'default' => $default,
		),
		'control' => array(
			'control_type' => WEAVERX_PLUS_COLOR_CONTROL,
			'label'        => $label,
			'description'  => $description
		)
	);
}

function weaverx_cz_group_title($label, $description = '') {
	/*
	'group_title' => weaverx_cz_group_title(
				label,
				description
			),
	*/
	return array(
		'control' => array(
			'control_type' => 'WeaverX_Misc_Control',
			'label'   => $label,
			'description' => $description,
			'type'  => 'group-title',
		),
	);
}

function weaverx_cz_heading($label, $description = '') {
	/*
	'heading' => weaverx_cz_heading(
				label,
				description
			),
	*/
	return array(
		'control' => array(
			'control_type' => 'WeaverX_Misc_Control',
			'label'   => $label,
			'description' => $description,
			'type'  => 'heading',
		),
	);
}

function weaverx_cz_checkbox($label, $description = '', $plus = '') {

	/*
	'checkbox' => weaverx_cz_checkbox(
				label,
				description
			),
	 */
	$cb = null;
	if ( $plus != '' ) {
		$label .= WEAVERX_PLUS_ICON;
		$cb= WEAVERX_PLUS_CHECKBOX_CONTROL;
	}
	return array(
		'setting' => array(
			'sanitize_callback' => 'absint',
			'transport' => 'postMessage'
		),
		'control' => array(
			'control_type' => $cb,
			'label' => $label,
			'description' => $description,
			'type'  => 'checkbox',
		),
	);

}

function weaverx_cz_checkbox_refresh($label, $description = '') {
	/*
	'checkbox_refresh' => weaverx_cz_checkbox_refresh(
				label,
				description
			),
	 */
	$label .= WEAVERX_REFRESH_ICON;

	return array(
		'setting' => array(
			'sanitize_callback' => 'absint',
			'transport' => 'refresh'
		),
		'control' => array(
			'label' => $label,
			'description' => $description,
			'type'  => 'checkbox',
		),
	);

}

function weaverx_cz_css($label, $description = '') {
	return array(
		'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_css', 'transport' => 'postMessage',	'default' => ''),
		'control' => array(
			'control_type' => 'WeaverX_Textarea_Control',
			'label'   => $label,
			'description' => $description,
			'type'  => 'textarea',
			'input_attrs' => array(
				'rows' => '2',
				'placeholder' => __('{font-size:150%;font-weight:bold;} /* for example */', 'weaver-xtreme'),
			)
		)
	);
}


function weaverx_cz_add_class($label, $description = '') {
	if ( $description == '')
		$description = __( 'Space separated class names to add to this area.', 'weaver-xtreme' );
	return array(
		'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_css', 'transport' => 'refresh',	'default' => '' ),
		'control' => array(
			'control_type' => WEAVERX_PLUS_TEXT_CONTROL,
			'label'   => $label . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
			'description'   => $description,
			'type'  => 'text',
			'input_attrs' => array(
				'style' => 'width:85%;'
			),
		),
	);
}

function weaverx_cz_textarea($label, $description = '', $rows = '1', $placeholder = '',
							  $transport = 'postMessage', $plus = false, $sanitize = 'weaverx_cz_sanitize_html') {
	/*
	 weaverx_cz_textarea($label,
				$description,
				$rows , $placeholder,
				$refresh, $plus),

	 */
	if ($plus)
		$control_type = WEAVERX_PLUS_TEXTAREA_CONTROL;
	else
		$control_type = 'WeaverX_Textarea_Control';
	if ($plus)
		$label .= WEAVERX_PLUS_ICON;
	if ($transport == 'refresh')
		$label .= WEAVERX_REFRESH_ICON;

	return array(
				'setting' => array( 'sanitize_callback' => $sanitize, 'transport' => $transport, 'default' => ''
				),
				'control' => array(
					'control_type' => $control_type,
					'label'   => $label,
					'description'   => $description,
					'type'  => 'textarea',
					'input_attrs' => array(
						'rows' => $rows,
						'placeholder' => $placeholder,
					),
				),
			);

}

function weaverx_cz_html_textarea($label, $description = '', $rows = '1') {
	/*
	 weaverx_cz_html_textarea($label,
				$description,
				$rows),
	 */

	return array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_html', 'transport' => 'postMessage', 'default' => ''
				),
				'control' => array(
					'control_type' => 'WeaverX_Textarea_Control',
					'label'   => $label,
					'description'   => $description,
					'type'  => 'textarea',
					'input_attrs' => array(
						'rows' => $rows,
						'placeholder' => __('Any HTML, including shortcodes.', 'weaver-xtreme'),
					),
				),
			);
}

function weaverx_cz_add_image($root, $label = '', $description = '' , $transport = 'postMessage', $version = 'XPlus' ) {
	$opt = array();

	if ($version == 'XPlus') $label .= WEAVERX_PLUS_ICON;
	if ($transport == 'refresh') $label .= WEAVERX_REFRESH_ICON;

	$opt[$root . '-heading'] = weaverx_cz_group_title( $label );


	if ($description) {
		$opt[$root . '-desc'] = array(
		'control' => array( 'control_type' => 'WeaverX_Misc_Control',
		'description'   => $description,
		'type'  => 'text'));
	}



	$opt["_bg_{$root}_url"] = array(
			'setting' => array(
				'transport' => $transport,
				'sanitize_callback' => 'esc_url_raw'
			),
			'control' => array(
				'control_type' => WEAVERX_PLUS_IMAGE_CONTROL,
				'label' => '',
				//'type'  => 'checkbox',
			),
		);

	$opt["_bg_{$root}_rpt"] = array(
			'setting' => array(
				'transport' => $transport,
				'default' => 'repeat'
			),
			'control' => array(
				'control_type' => WEAVERX_PLUS_SELECT_CONTROL,
				'label' => __('Tile BG Image', 'weaver-xtreme'),
				'type'    => 'select',
				'choices' => weaverx_cz_choices_repeat(),
			),
		);

	$opt["_bg_{$root}_rpt_css"] = array(
			'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_css', 'transport' => 'refresh',	'default' => '' ),
			'control' => array(
				'control_type' => WEAVERX_PLUS_TEXT_CONTROL,
				'label'   => __( 'Additional CSS', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
				'type'  => 'text',
			),
		);



	return $opt;

}

function weaverx_cz_add_fonts($root, $label = '', $description = '' , $transport = 'refresh', $bold = 'bold' ) {

	$opt = array();


	if ($root != 'm_primary')	// add a line except top
		$opt[$root . '-headingline'] = weaverx_cz_line();

	$glabel = $label;
	if ($transport == 'refresh')
		$glabel .= WEAVERX_REFRESH_ICON;

	$opt[$root . '-font-hdrm'] = weaverx_cz_group_title($glabel, $description);

	// Font Size
	$opt[$root . '_font_size'] = weaverx_cz_select(
		'',
		'<strong>' . __('Select Font Size for ', 'weaver-xtreme') . $label . '</strong>',
		'weaverx_cz_choices_font_size',	'', $transport
	);



	// Font Family
	/* for future - add more fonts...
	 *$opt[$root . '_font_family'] = array(
		'setting' => array(	'transport' => 'refresh', 'default' => 'sans-serif'	),
		'control' => array(
			'control_type' => 'WeaverX_Misc_Control',
			'label'   => __( 'Font Family', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
			'description'   => '',
			'type'  => 'select-fontfamily',
			'choices' => weaverx_cz_choices_font_family()
		),
	);
	*/

	$opt[$root . '_font_family'] = weaverx_cz_select(
		'',
		'<strong>' . __('Select Font Family for ', 'weaver-xtreme') . $label . '</strong>',
		'weaverx_cz_choices_font_family',	'', $transport
	);

	// Bold / Normal

	if ($root == 'tagline' || $root == 'content_h' || strpos($root, '_title') > 0) {
		if ($transport == 'refresh') {
			$opt[$root . '_normal'] =  weaverx_cz_checkbox_refresh(
				__('Normal Weight for ', 'weaver-xtreme') . $label,
				'' //'<strong>' . __('Normal Weight for ', 'weaver-xtreme') . $label . '</strong>'
			);
		} else {
			$opt[$root . '_normal'] =  weaverx_cz_checkbox(
				__('Normal Weight for ', 'weaver-xtreme') . $label,
				''// '<strong>' . __('Normal Weight for ', 'weaver-xtreme') . $label . '</strong>'
			);
		}
	} else {
		$opt[$root . '_bold'] =  weaverx_cz_select(
			'',
			'<strong>' . __('Use Bold for ', 'weaver-xtreme') . $label . '</strong>',
			'weaverx_cz_choices_bold_italic',	'', $transport
		);
	}

		// Italic
	$opt[$root . '_italic'] = weaverx_cz_select(
		'',
		'<strong>' . __('Use <em>Italic</em> for ', 'weaver-xtreme') . $label . '</strong>',
		'weaverx_cz_choices_bold_italic',	'', $transport
	);


	return $opt;

}

function weaverx_cz_add_link_fonts($root, $label = '', $description = '' , $transport = 'postMessage' ) {

	// called for: link, ibarlink, contentlink, ilink, wlink, footerlink

	$opt = array();

	$opt[$root . '-fontlink-hdm'] = weaverx_cz_group_title($label, $description);

	/* $opt[$root . '-heading'] = array(
		'control' => array( 'control_type' => 'WeaverX_Misc_Control',
		'label'   => $label,
		'type'  => 'group-title'));

	if ($description) {
		$opt[$root . '-desc'] = array(
		'control' => array( 'control_type' => 'WeaverX_Misc_Control',
		'description'   => $description,
		'type'  => 'text'));
	} */


	// Bold
	$opt[$root . '_strong'] =  weaverx_cz_select(
		'',
		'<strong>' . __('Use Bold for ', 'weaver-xtreme') . $label . '</strong>',
		'weaverx_cz_choices_bold_italic',	'', $transport
	);


		// Italic
	$opt[$root . '_em'] = weaverx_cz_select(
		'',
		'<strong>' . __('Use <em>Italic</em> for ', 'weaver-xtreme') . $label . '</strong>',
		'weaverx_cz_choices_bold_italic',	'', $transport
	);


	// UNderline

	$opt[$root . '_u'] = array(
		'setting' => array(
			'transport' => $transport
		),
		'control' => array(
			'label' => __( 'Underline', 'weaver-xtreme' ),
			'description' => '<strong>' . __('Use <u>Underline</u> for ', 'weaver-xtreme') . $label . '</strong>',
			'type'  => 'checkbox',
		),
	);

	return $opt;

}

?>
