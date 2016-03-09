<?php
/**
 * Define topography settings - Weaver Xtreme Customizer
 */

if ( ! function_exists( 'weaverx_customizer_define_typography_sections' ) ) :
/**
 * Define the sections and settings for the General panel
 */
function weaverx_customizer_define_typography_sections( $sections ) {
	$panel = 'weaverx_typography';
	$typography_sections = array();

	/**
	 * Global
	 */
	$typography_sections['typo-global'] = array(
		'panel'   => $panel,
		'title'   => __('Global Typography Options', 'weaver-xtreme'),
		'description' => __('Set base font values: Base font size, base line height, and more. The Font Size options for other areas are all derived from these base sizes.', 'weaver-xtreme'),
		'options' => array(


			'site_fontsize_int'     => array(
				'setting' => array( 'sanitize_callback' => 'absint', 'transport' => 'postMessage',	'default' => 16
				),
				'control' => array(
					'control_type' => 'WeaverX_Range_Control',
					'label'   => __( 'Site Base Font Size (px)', 'weaver-xtreme' ),
					'description'   => __( "Base font size of standard text. This value determines the default medium font size. Note that visitors can change their browser's font size, so final font size can vary, as expected. Default is 16px.", 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 2,
						'max'  => 50,
						'step' => 1,
					),
				),
			),

			'site_line_height_dec'     => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_float', 'transport' => 'postMessage',	'default' => 1.5
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Site Base Line Height', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON,
					'description'   => __( 'Set the Base line-height. Line heights for various font sizes based on this multiplier. (Default: 1.5 - no units)', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => .1,
						'max'  => 10.,
						'step' => .1,
					),
				),
			),

			'site_fontsize_tablet_int'     => array(
				'setting' => array( 'sanitize_callback' => 'absint', 'transport' => 'refresh',	'default' => 16
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Site Base Font Size - Small Tablets (px)', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description'   => __( 'Small Tablet base font size of standard text. (Default medium font size: 16px)', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 2,
						'max'  => 50,
						'step' => 1,
					),
				),
			),
			'site_fontsize_phone_int'     => array(
				'setting' => array( 'sanitize_callback' => 'absint', 'transport' => 'refresh',	'default' => 16
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Site Base Font Size - Phones (px)', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description'   => __( 'Phone base font size of standard text. (Default medium font size: 16px)', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 2,
						'max'  => 50,
						'step' => 1,
					),
				),
			),

			'custom_fontsize_a'     => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_float', 'transport' => 'refresh',	'default' => 1.0
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Custom Font Size A (em)', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description'   => __( 'Font Size for Custom Font Size A on the Font Size selection options.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => .5,
						'max'  => 20,
						'step' => .5,
					),
				),
			),

			'custom_fontsize_b'     => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_float', 'transport' => 'refresh',	'default' => 1.0
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Custom Font Size B (em)', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description'   => __( 'Font Size for Custom Font Size B on the Font Size selection options.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => .5,
						'max'  => 20,
						'step' => .5,
					),
				),
			),

			'font_letter_spacing_global_dec'     => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_float', 'transport' => 'postMessage',	'default' => 0.0
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Character Spacing (em)', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON,
					'description'   => __( 'Add extra spacing between characters. (Default: 0)', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => -.1,
						'max'  => .25,
						'step' => .0025,
					),
				),
			),

			'font_word_spacing_global_dec'     => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_float', 'transport' => 'postMessage',	'default' => 0.0
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Word Spacing (em)', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON,
					'description'   => __( 'Add extra spacing between words. (Default: 0)', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => -.5,
						'max'  => 1.0,
						'step' => .05,
					),
				),
			),

			'typo-google-font-opts' => weaverx_cz_group_title(__('Integrated Google Fonts', 'weaver-xtreme'),
				__('Weaver Xtreme integrates a selected set of Google Font families. You can disable them, or add differenet language support in this section.', 'weaver-xtreme')),

			'disable_google_fonts' => weaverx_cz_checkbox_refresh(
				__('Disable Google Font Integration', 'weaver-xtreme'),
				__('<strong>ADVANCED OPTION!</strong> <em>Be sure you understand the consequences of this option.</em> By disabling Google Font Integration, the Google Fonts definitions will <strong>not</strong> be loaded for your site, and the options will not be displayed on Font Family options subsequently. <strong style="color:red;font-weight:bold;">Please note:</strong> Any previously selected Google Font Families will revert to generic serif, sans, mono, and script fonts. Google Font Families WILL be displayed in the Customizer options until you manually refresh the Customizer page.', 'weaver-xtreme')
			),

			'typo-lang-intro' => weaverx_cz_heading(__('Google Font Language Character Sets', 'weaver-xtreme'),
				__('By default, integrated Google Fonts will include the <em>Latin Extended</em> character set. If you need a Crylic, Greek, Hebrew, or Vietnamese character set, these are currently supported by Google Fonts for <em>some</em> font families.
Google Fonts not supported for these character sets, and character sets for most other world languages will be displayed
using the default browser serif and sans fonts.', 'weaver-xtreme') ),

			'font_set_cryllic' => weaverx_cz_checkbox_refresh(
				__('Cryllic', 'weaver-xtreme'),
				__('Add Cryllic character set to Open Sans, Open Sans Condensed, Roboto (all), Arimo, and Tinos font families.', 'weaver-xtreme')
			),

			'font_set_greek' => weaverx_cz_checkbox_refresh(
				__('Greek', 'weaver-xtreme'),
				__('Add Greek character set to Open Sans, Open Sans Condensed, Roboto (all), Arimo, and Tinos font families.', 'weaver-xtreme')
			),

			'font_set_hebrew' => weaverx_cz_checkbox_refresh(
				__('Hebrew', 'weaver-xtreme'),
				__('Add Hebrew character set to Arimo and Tinos font families.', 'weaver-xtreme')
			),

			'font_set_vietnamese' => weaverx_cz_checkbox_refresh(
				__('Greek', 'weaver-xtreme'),
				__('Add Greek character set to Open Sans, Open Sans Condensed, Roboto (all), Source Sans Pro, Alegreya Sans, Arimo, and Tinos font families.', 'weaver-xtreme')
			),


			'typo-intro' => weaverx_cz_group_title(__('Using Font Families', 'weaver-xtreme'),
				__('<em>Weaver Xtreme</em> includes support for over 30 font family choices: 16 <strong>Web Safe</strong> fonts, and the remaining from a carefully selected set of <strong>Google Fonts</strong>.
The <strong>Google Fonts</strong> will be displayed the same on every browser, <em>including</em> Android and iOS devices.
The <strong>Web Safe</strong> will be displayed as specified for most modern browsers, but will likely revert to
one of the three basic fonts supported by Android devices, or a limited set for iOS devices. <em>We highly recommend selecting <strong>Google Fonts</strong> for your site.</em><br/>
You can also add more Google Fonts, other free fonts, and even premium fonts using <em>Weaver Xtreme Plus</em>.<br />
You can see a demonstration of <em>Weaver Xtreme\'s</em> fonts here: ', 'weaver-xtreme') .
weaverx_help_link('font-demo.html', __('Examples of supported fonts', 'weaver-xtreme'), __('Font Examples', 'weaver-xtreme'), false)
			),



			'typo-font-family-note' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control',
					'label'   => __( 'Add Font Families', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON,
					'description' => sprintf(__(
						'<p>The <strong>%s</strong> allows you add additional free fonts from
	<a href="//www.google.com/webfonts" target="_blank" title="Google Web Fonts"><strong>Google Web Fonts</strong></a>,
    <a href="//www.fontsquirrel.com" target="_blank" title="Font Squirrel"><strong>Font Squirrel</strong></a>,
    or virtually any other free or commercial font source directly to all the
    <em>Font Family</em> selectors found in various text options.</p>
	<p>To define Font Families, please "Save &amp; Publish" options you may have set on this Optimizer, then click to open the
	<strong>%s</strong>, and open the <em>Fonts &amp; Custom</em> tab.
	Be sure to <em>Save Settings</em> before leaving the Legacy Weaver Xtreme Admin panel.</p>',
						'weaver-xtreme'),
						weaverx_cz_get_admin_page(__('Weaver Xtreme Plus Font Control Panel', 'weaver-xtreme')),
						weaverx_cz_get_admin_page(__('Weaver Xtreme Plus Font Control Panel', 'weaver-xtreme'))),
					'type'  => 'HTML',
				),
			),



		),
	);

	/**
	 * General
	 */
	$typography_sections['typo-wrapping'] = array(
		'panel'   => $panel,
		'title'   => __( 'Wrapping Areas', 'weaver-xtreme' ),
		'description' => __('Set font and other typography attributes. Add new fonts from the <em>Appearance &rarr; Weaver Xtreme Admin &rarr; Main Options &rarr; Fonts &amp; Custom</em> panel. Use Site Colors to set colors.', 'weaver-xtreme'),
		'options' => array(
			'typo-heading-global' => array(

			),
		),
	);

	$new_opts = weaverx_cz_add_fonts('wrapper', __('Site Wrapper &amp; Container Fonts', 'weaver-xtreme'),
		__('Default (wrapper) typography for site. Set font attributes here that will apply to the entire site. To override other items, set typography for individual items on other panels. (The inherited default Font Family is Open Sans.)', 'weaver-xtreme'), 'postMessage');
	$typography_sections['typo-wrapping']['options'] = array_merge( $typography_sections['typo-wrapping']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('container', __('Container Fonts', 'weaver-xtreme'),
						 __('Container typography for site. Wraps content and sidebars.', 'weaver-xtreme'), 'postMessage');
	$typography_sections['typo-wrapping']['options'] = array_merge( $typography_sections['typo-wrapping']['options'],  $new_opts);

	/**
	 * Links
	 */
	$typography_sections['typo-links'] = array(
		'panel'   => $panel,
		'title'   => __( 'Links', 'weaver-xtreme' ),
		'options' => array(
		),
	);

	$new_opts = weaverx_cz_add_link_fonts('link', __('Global Links', 'weaver-xtreme'),
		__('Global default for link typography (not including menus and titles). Set Bold, Italic, and Underline by setting those options for specific areas rather than globally to have more control.', 'weaver-xtreme'));
	$typography_sections['typo-links']['options'] = array_merge( $typography_sections['typo-links']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_link_fonts('ibarlink', __('Info Bar Links', 'weaver-xtreme'),
		__('<small>Typography for links in Info Bar (uses Standard Link colors if left inherit).', 'weaver-xtreme'));
	$typography_sections['typo-links']['options'] = array_merge( $typography_sections['typo-links']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_link_fonts('contentlink', __('Content Links', 'weaver-xtreme'),
		__('<small>Typography for links in Content (uses Standard Link colors if left inherit).', 'weaver-xtreme'));
	$typography_sections['typo-links']['options'] = array_merge( $typography_sections['typo-links']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_link_fonts('ilink', __('Post Meta Info Links', 'weaver-xtreme'),
		__('<small>Typography for links in post meta information top and bottom lines. (uses Standard Link colors if left inherit).', 'weaver-xtreme'));
	$typography_sections['typo-links']['options'] = array_merge( $typography_sections['typo-links']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_link_fonts('wlink', __('Individual Widget Links', 'weaver-xtreme'),
		__('Typography for links in widgets (uses Standard Link colors if inherit).', 'weaver-xtreme'));
	$typography_sections['typo-links']['options'] = array_merge( $typography_sections['typo-links']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_link_fonts('footerlink', __('Footer Area Links', 'weaver-xtreme'),
		__('Typography for links in Footer (Uses Standard Link colors if left inherit).', 'weaver-xtreme'));
	$typography_sections['typo-links']['options'] = array_merge( $typography_sections['typo-links']['options'],  $new_opts);

	/**
	 * Site Header
	 */
	$typography_sections['typo-header'] = array(
		'panel'   => $panel,
		'title'   => __( 'Header Area', 'weaver-xtreme' ),
		'options' => array(
		),
	);
	$new_opts = weaverx_cz_add_fonts('header', __('Header Area', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-header']['options'] = array_merge( $typography_sections['typo-header']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('site_title', __('Site Title', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-header']['options'] = array_merge( $typography_sections['typo-header']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('tagline', __('Site Tagline', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-header']['options'] = array_merge( $typography_sections['typo-header']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('header_sb', __('Header Widget Area', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-header']['options'] = array_merge( $typography_sections['typo-header']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('header_html', __('Header HTML', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-header']['options'] = array_merge( $typography_sections['typo-header']['options'],  $new_opts);



	/**
	 * Main Menu
	 */
	$typography_sections['typo-menus'] = array(
		'panel'   => $panel,
		'title'   => __( 'Menus', 'weaver-xtreme' ),
		'description' => __( 'Set typography for Menus.', 'weaver-xtreme' ),
		'options' => array(

		),
	);

	$new_opts = weaverx_cz_add_fonts('m_primary', __('Primary Menu', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-menus']['options'] = array_merge( $typography_sections['typo-menus']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('m_secondary', __('Secondary Menu', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-menus']['options'] = array_merge( $typography_sections['typo-menus']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('m_header_mini', __('Header Mini Menu', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-menus']['options'] = array_merge( $typography_sections['typo-menus']['options'],  $new_opts);

	// current page

	$cur_page = array(
		'typo-am-line1' => weaverx_cz_line(),

		'typo-allmenus-heading' => weaverx_cz_group_title( __( 'Typography For All Menus', 'weaver-xtreme' ),
			__('These options specify current page attributes for all menus.', 'weaver-xtreme')),

		'menubar_curpage_bold' => array(
			'setting' => array(
			),
			'control' => array(
				'label' => __( 'Bold Current Page', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
				'description' => __('Bold Face Current Page and ancestors.', 'weaver-xtreme'),
				'type'  => 'checkbox',
			),
		),
		'menubar_curpage_em' => array(
			'setting' => array(
			),
			'control' => array(
				'label' => __( 'Italic Current Page', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
				'description' => __('Italic Current Page and ancestors.', 'weaver-xtreme'),
				'type'  => 'checkbox',
			),
		),
		'menubar_curpage_noancestors' => array(
			'setting' => array(
			),
			'control' => array(
				'label' => __( 'Do Not Highlight Ancestors', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
				'description' => __('Highlight Current Page only - do not also highlight ancestor items.', 'weaver-xtreme'),
				'type'  => 'checkbox',
			),
		),




	);
	$typography_sections['typo-menus']['options'] = array_merge( $typography_sections['typo-menus']['options'],  $cur_page);


	if (weaverx_cz_is_plus()) {
		$new_opts = weaverx_cz_add_fonts('m_extra', __('Extra Menu', 'weaver-xtreme'), '', 'postMessage');
	} else {
		$new_opts = weaverx_cz_add_plus_message('typo_menus', __('Extra Menu', 'weaver-xtreme'),
			__('Add extra menus with <strong>Weaver Xtreme Plus</strong>.', 'weaver-xtreme'));
	}
	$typography_sections['typo-menus']['options'] = array_merge( $typography_sections['typo-menus']['options'],  $new_opts);



	/**
	 * Info Bar
	 */
	$typography_sections['typo-info-bar'] = array(
		'panel'   => $panel,
		'title'   => __( 'Info Bar', 'weaver-xtreme' ),
		'description' => __('Info Bar with breadcrumbs and paged navigation displayed under Primary Menu.', 'weaver-xtreme'),
		'options' => array(

			// options added below
		),
	);

	$new_opts = weaverx_cz_add_fonts('info_bar', __('Info Bar', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-info-bar']['options'] = array_merge( $typography_sections['typo-info-bar']['options'],  $new_opts);

	/**
	 * Content
	 */
	$typography_sections['typo-content'] = array(
		'panel'   => $panel,
		'title'   => __( 'Content', 'weaver-xtreme' ),
		'description' => __('Typography for general page and post content.', 'weaver-xtreme'),
		'options' => array(
			// options added below
		),
	);

	$new_opts = weaverx_cz_add_fonts('content', __('Content Area', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-content']['options'] = array_merge( $typography_sections['typo-content']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('page_title', __('Page Title', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-content']['options'] = array_merge( $typography_sections['typo-content']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('archive_title', __('Archive Pages Title', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-content']['options'] = array_merge( $typography_sections['typo-content']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('content_h', __('Content Headings', 'weaver-xtreme'),
		__('Headings (&lt;h1&gt;-&lt;h6&gt;) in page and post content.', 'weaver-xtreme'), 'refresh', 'normal');
	$typography_sections['typo-content']['options'] = array_merge( $typography_sections['typo-content']['options'],  $new_opts);



	/**
	 * Post Specific
	 */
	$typography_sections['typo-post-specific'] = array(
		'panel'   => $panel,
		'title'   => __( 'Post Specific', 'weaver-xtreme' ),
		'description' => __('Post Specific Typography - override Content Typography.', 'weaver-xtreme'),
		'options' => array(

		),
	);

	$new_opts = weaverx_cz_add_fonts('post', __('Post Area', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-post-specific']['options'] = array_merge( $typography_sections['typo-post-specific']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('post_title', __('Post Title', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-post-specific']['options'] = array_merge( $typography_sections['typo-post-specific']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('post_info_top', __('Top Post Info Line', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-post-specific']['options'] = array_merge( $typography_sections['typo-post-specific']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('post_info_bottom', __('Bottom Post Info Line', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-post-specific']['options'] = array_merge( $typography_sections['typo-post-specific']['options'],  $new_opts);


	/**
	 * Sidebars
	 */
	$typography_sections['typo-sidebars'] = array(
		'panel'   => $panel,
		'title'   => __( 'Sidebars &amp; Widget Areas', 'weaver-xtreme' ),
		'description' => __('Main Sidebars and Widget areas. Header and Footer areas options under Header and Footer panels.', 'weaver-xtreme'),
		'options' => array(

		),
	);

	$new_opts = weaverx_cz_add_fonts('primary', __('Primary Area', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-sidebars']['options'] = array_merge( $typography_sections['typo-sidebars']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('secondary', __('Secondary Area', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-sidebars']['options'] = array_merge( $typography_sections['typo-sidebars']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('top', __('Top Widget Areas', 'weaver-xtreme'),
		__('Properties for all Top Widget areas (Sitewide, Pages, Blog, Archive).', 'weaver-xtreme'), 'postMessage');
	$typography_sections['typo-sidebars']['options'] = array_merge( $typography_sections['typo-sidebars']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('bottom', __('Bottom Widget Areas', 'weaver-xtreme'),
		__('Typography for all Bottom Widget areas (Sitewide, Pages, Blog, Archive).', 'weaver-xtreme'), 'postMessage');
	$typography_sections['typo-sidebars']['options'] = array_merge( $typography_sections['typo-sidebars']['options'],  $new_opts);

	/**
	 * Widgets
	 */
	$typography_sections['typo-widgets'] = array(
		'panel'   => $panel,
		'title'   => __( 'Individual Widgets', 'weaver-xtreme' ),
		'options' => array(
		),
	);

	$new_opts = weaverx_cz_add_fonts('widget', __('Individual Widgets', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-widgets']['options'] = array_merge( $typography_sections['typo-widgets']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('widget_title', __('Individual Widgets Title', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-widgets']['options'] = array_merge( $typography_sections['typo-widgets']['options'],  $new_opts);

	/**
	 * Footer
	 */
	$typography_sections['typo-footer'] = array(
		'panel'   => $panel,
		'title'   => __( 'Footer Area', 'weaver-xtreme' ),
		'options' => array(

		),
	);

	$new_opts = weaverx_cz_add_fonts('footer', __('Footer Area', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-footer']['options'] = array_merge( $typography_sections['typo-footer']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('footer_sb', __('Footer Widget Area', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-footer']['options'] = array_merge( $typography_sections['typo-footer']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_fonts('footer_html', __('Footer HTML', 'weaver-xtreme'), '', 'postMessage');
	$typography_sections['typo-footer']['options'] = array_merge( $typography_sections['typo-footer']['options'],  $new_opts);

	/**
	 * Filter the definitions for the controls in the Color Scheme panel of the Customizer.
	 *
	 * @since 1.3.0.
	 *
	 * @param array    $typography_sections    The array of definitions.
	 */
	$typography_sections = apply_filters( 'weaverx_customizer_typography_sections', $typography_sections );

	// Merge with master array
	return array_merge( $sections, $typography_sections );


}
endif;

add_filter( 'weaverx_customizer_sections', 'weaverx_customizer_define_typography_sections' );

?>
