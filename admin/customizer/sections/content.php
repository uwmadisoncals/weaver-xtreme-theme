<?php

if ( ! function_exists( 'weaverx_customizer_define_content_sections' ) ) :
/**
 * Define the sections and settings for the Content panel
 */
function weaverx_customizer_define_content_sections( $sections ) {
	global $wp_customize;
	$panel = 'weaverx_content';
	$content_sections = array();

		// <head> section

	$content_sections['content-head'] = array(
		'panel'   => $panel,
		'title'   => __( 'Site &lt;HEAD&gt; Section', 'weaver-xtreme' ),

		'options' => array(

			'content-headsec-heading' => weaverx_cz_heading( __( 'Introductory Help for &lt;HEAD&gt; Section', 'weaver-xtreme' ),
				__( 'This panel allows you to add HTML to the &lt;HEAD&gt; Section of every page on your site.<br /><br />
PLEASE NOTE: Only minimal validation is made on the field values, so be careful not to use invalid code. Invalid code is usually harmless, but it can make your site display incorrectly. If your site looks broken after make changes here, please double check that what you entered uses valid HTML or CSS rules.', 'weaver-xtreme' )),

			'head_opts' => weaverx_cz_textarea(__( '&lt;HEAD&gt; Section Content', 'weaver-xtreme' ),
					/* $description = */ __(
					'This input area allows you to enter allowed HTML head elements to the &lt;head&gt; section, including &lt;title&gt;, &lt;base&gt;, &lt;link&gt;, &lt;meta&gt;, &lt;script&gt;, and &lt;style&gt;.
Code entered into this box is included right before the &lt;/head&gt; HTML tag on each page of your site.
We recommend using dedicated WordPress plugins to add things like ad tracking, SEO tags, Facebook code, and so on.
<small>Note: You can add CSS Rules using the "Custom CSS Rules" option on the Main Options tab.', 'weaver-xtreme' ),
					/* $rows = */ '4', /* $placeholder = */ __('Any HTML allowed in <head>.', 'weaver-xtreme'),
					/*$refresh = */ 'refresh', /*$plus = */false),



			'_althead_opts' => weaverx_cz_textarea(__( '&lt;HEAD&gt; Section (Advanced Alternative - &diams;)', 'weaver-xtreme' ),
				__(
					'Same as normal &lt;HEAD&gt; box above, but works like other &diams; options - it survives changing
the subtheme from the Weaver Xtreme Subthemes tab, and is saved only on a full backup Save.
This option is not commonly used, and is intended for more advanced Weaver Xtreme users.', 'weaver-xtreme' ),
				'4', __('Any HTML allowed in <head>.', 'weaver-xtreme'),
				'refresh', false),


			'content-headsec-line1' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control', 'type'  => 'line',
				),
			),

			'_phpactions' => weaverx_cz_textarea(
				__( 'Actions and Filters (&diams;)', 'weaver-xtreme' ),
				__(
					'<strong>This Option for Advanced Users!</strong> You can add arbitrary PHP code here. This option is intended to allow
you to add WordPress Actions and Filters that can affect the Visitor View of your site. This PHP code is executed at the very
beginning of the theme\'s header.php template file before any HTML is emitted, but after much of WordPress is loaded, so you
can\'t create filters or actions for all WordPress functions.
Do NOT bracket the code with &lt;?php and ?&gt; at the beginning and end.
If your code doesn\'t seem to do anything, you probably have a PHP error. See the Help file for more technical details.', 'weaver-xtreme' ),
				'4', __('/* PHP code - typically to define WP actions or filters */', 'weaver-xtreme'),
				'refresh', true, 'weaverx_cz_sanitize_code'),

		),
	);



	/**
	 * Site Header
	 */
	$content_sections['content-header'] = array(
		'panel'   => $panel,
		'title'   => __( 'Site Header Area', 'weaver-xtreme' ),
		'options' => array(

			'header_html_text'     =>  weaverx_cz_html_textarea(__( 'Header HTML Content', 'weaver-xtreme' ),
				__( 'Add arbitrary HTML to Header Area (in &lt;div id="header-html"&gt;)', 'weaver-xtreme' ),
				'4'),

		),
	);


	/**
	 * Main Menu
	 */
	$content_sections['content-menus'] = array(
		'panel'   => $panel,
		'title'   => __( 'Menus', 'weaver-xtreme' ),
		'description' => __( 'Set content for Menus.', 'weaver-xtreme' ),
		'options' => array(
			'content-mm-heading' => weaverx_cz_group_title( __( 'Primary Menu', 'weaver-xtreme' )),

			'm_primary_html_left' =>  weaverx_cz_textarea(__( 'Left HTML', 'weaver-xtreme' ),
				__( 'Add HTML to menu bar. Works best with Centered Menu. You can adjust color and top/bottom spacing on the respective panels. (&diams;)', 'weaver-xtreme' ),
				'1', __('Any HTML, including shortcodes.', 'weaver-xtreme'),
				'postMessage', true),


			'm_primary_html_right' =>  weaverx_cz_textarea(__( 'Right HTML', 'weaver-xtreme' ),
				'',
				'1', __('Any HTML, including shortcodes.', 'weaver-xtreme'),
				'postMessage', true),


			'content-sm-heading' => weaverx_cz_group_title( __( 'Secondary Menu', 'weaver-xtreme' ),
				__('You must define a Secondary Menu from the Custom Menus Content menu.', 'weaver-xtreme')),

			'm_secondary_html_left' =>  weaverx_cz_textarea(__( 'Left HTML', 'weaver-xtreme' ),
				__( 'Add HTML to menu bar. Works best with Centered Menu. You can adjust color and top/bottom spacing on the respective panels. (&diams;)', 'weaver-xtreme' ),
				'1', __('Any HTML, including shortcodes.', 'weaver-xtreme'),
				'postMessage', true),


			'm_secondary_html_right' =>  weaverx_cz_textarea(__( 'Right HTML', 'weaver-xtreme' ),
				'',
				'1', __('Any HTML, including shortcodes.', 'weaver-xtreme'),
				'postMessage', true),



			'content-xm-heading' => weaverx_cz_group_title( __( 'Extra Menu', 'weaver-xtreme' )),

			'm_extra_html_left' =>  weaverx_cz_textarea(__( 'Left HTML', 'weaver-xtreme' ),
				__( 'Add HTML to menu bar. Works best with Centered Menu. You can adjust color and top/bottom spacing on the respective panels. (&diams;)', 'weaver-xtreme' ),
				'1', __('Any HTML, including shortcodes.', 'weaver-xtreme'),
				'postMessage', true),


			'm_extra_html_right' =>  weaverx_cz_textarea(__( 'Right HTML', 'weaver-xtreme' ),
				'',
				'1', __('Any HTML, including shortcodes.', 'weaver-xtreme'),
				'postMessage', true),


		),
	);



	/**
	 * Post Specific
	 */
	$content_sections['content-post-specific'] = array(
		'panel'   => $panel,
		'title'   => __( 'Post Specific', 'weaver-xtreme' ),
		'description' => __('Post Specific Content - override Content Content.', 'weaver-xtreme'),
		'options' => array(

			'excerpt_more_msg' => weaverx_cz_html_textarea(__( '"Continue reading" Message', 'weaver-xtreme' ),
				__( 'Change default <em>Continue reading &rarr;</em> message for excerpts. You can include HTML (e.g., &lt;img>).', 'weaver-xtreme' ),
				'1'),

			'content-post-meta' => weaverx_cz_group_title( __( 'Custom Post Info Lines', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON,
				__( 'Replace Info Lines with custom info line templates. Advanced options: see help file.', 'weaver-xtreme' )),

			'custom_posted_on' => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_html', 'transport' => 'refresh',	'default' => ''
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_TEXTAREA_CONTROL,
					'label'   => __( 'Top Post Info Line', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description'   => __( 'Custom template for top post info line.(&star;Plus)', 'weaver-xtreme' ),
					'type'  => 'textarea',
					'input_attrs' => array(
						'rows' => '1',
						'placeholder' => __('Please see help file for info line template info.', 'weaver-xtreme'),
					),
				),
			),

			'custom_posted_in' => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_html', 'transport' => 'refresh',	'default' => ''
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_TEXTAREA_CONTROL,
					'label'   => __( 'Bottom Post Info Line', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description'   => __( 'Custom template for bottom post info line.(&star;Plus)', 'weaver-xtreme' ),
					'type'  => 'textarea',
					'input_attrs' => array(
						'rows' => '1',
						'placeholder' => __('Please see help file for info line template info.', 'weaver-xtreme'),
					),
				),
			),

			'custom_posted_on_single' => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_html', 'transport' => 'refresh',	'default' => ''
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_TEXTAREA_CONTROL,
					'label'   => __( 'Top Post Info Line (Single)', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description'   => __( 'Custom template for top post info line on single pages.(&star;Plus)', 'weaver-xtreme' ),
					'type'  => 'textarea',
					'input_attrs' => array(
						'rows' => '1',
						'placeholder' => __('Please see help file for info line template info.', 'weaver-xtreme'),
					),
				),
			),

			'custom_posted_in_single' => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_html', 'transport' => 'refresh',	'default' => ''
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_TEXTAREA_CONTROL,
					'label'   => __( 'Bottom Post Info Line (Single)', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description'   => __( 'Custom template for bottom post info line on single pages.(&star;Plus)', 'weaver-xtreme' ),
					'type'  => 'textarea',
					'input_attrs' => array(
						'rows' => '1',
						'placeholder' => __('Please see help file for info line template info.', 'weaver-xtreme'),
					),
				),
			),


		),
	);


	/**
	 * Sidebars
	 */
	$content_sections['content-sidebars'] = array(
		'panel'   => $panel,
		'title'   => __( 'Sidebars & Widget Areas', 'weaver-xtreme' ),
		'options' => array(
			'content-widgetarea-heading' => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_html', 'transport' => 'refresh',
					'default' => ''
				),
				'control' => array(
					//'control_type' => 'WeaverX_Misc_Control',
					'label'   => __( 'Define Per Page Extra Widget Areas', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description'   => __( 'You may define extra widget areas that can then be used in the <em>Per Page</em> settings, or in the <em>Weaver Xtreme Plus</em> [widget_area] shortcode.
Enter a list of one or more widget area names separated by commas.
Your names should include only letters, numbers, or underscores - no spaces or other special characters.
The widgets areas will then appear on the Appearance->Widgets menus.
They can be included on individual pages by adding the name you define here to the "Weaver Xtreme Options For This Page" box on the Edit Page screen. (&diams;)', 'weaver-xtreme' ),
					'type'  => 'text',
				),
			),




		),
	);



	/**
	 * Footer
	 */
	$content_sections['content-footer'] = array(
		'panel'   => $panel,
		'title'   => __( 'Footer Area', 'weaver-xtreme' ),
		'options' => array(

			'footer_html_text' => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_filter_code', 'transport' => 'postMessage',
					'default' => ''
				),
				'control' => array(
					'control_type' => 'WeaverX_Textarea_Control',
					'label'   => __( 'Footer HTML Content', 'weaver-xtreme' ),
					'description' => __( 'Add arbitrary HTML to Footer Area (in &lt;div id="footer-html"&gt;)', 'weaver-xtreme' ),
					'type'  => 'textarea',
					'input_attrs' => array(
						'rows' => '3',
						'placeholder' => __('<!-- Add HTML Here -->', 'weaver-xtreme'),
					),
				),
			),

			'copyright' => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_filter_code', 'transport' => 'postMessage',
					'default' => ''
				),
				'control' => array(
					'control_type' => 'WeaverX_Textarea_Control',
					'label'   => __( '&copy; Site Copyright', 'weaver-xtreme' ) ,
					'description' => __( 'If you fill this in, the default copyright notice in the footer will be replaced with the text here. It will not automatically update from year to year. Use &amp;copy; to display &copy;. You can use other HTML and shortcodes as well.
Use <em>&amp;nbsp;</em> to hide the copyright notice. &diams;', 'weaver-xtreme' ),
					'type'  => 'textarea',
					'input_attrs' => array(
						'rows' => '2',
						'placeholder' => __('<!-- Add HTML Here -->', 'weaver-xtreme'),
					),
				),
			),

		),
	);

	/**
	 * Injection areas
	 */
	$content_sections['content-injection'] = array(
		'panel'   => $panel,
		'title'   => __( 'HTML Injection Areas', 'weaver-xtreme' ),
		'description'   => __( 'HTML Injection Areas. The injection areas include Prewrapper and Postfooter for all versions of the theme. Weaver Xtreme Plus also includes Preheader, Header Top, Container Top, Content Top, Page Content Bottom, Post-Post Content, Pre-Comments, Post-Comments, Pre-Footer, Primary Sidebar Top, Fixed Browser Top, and Fixed Browser Bottom. <em>Note:</em> unlike most other options, the HTML Injections area options provide all relevant associated options: content, color, custom CSS, and visibility.', 'weaver-xtreme' ),
		'options' => array(
		),
	);

	$new_opts = weaverx_cz_add_injection('prewrapper', __('Prewrapper Injection Area', 'weaver-xtreme'),
		__('This code will be inserted just before the #wrapper and #branding &lt;div&gt;s, before any other site content.(Area ID: #inject_prewrapper)	', 'weaver-xtreme'), 'standard');
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('postfooter', __('Post Footer Injection Area', 'weaver-xtreme'),
		__('This code will be inserted just after the footer #colophon &lt;div&gt;, outside the #wrapper div.(Area ID: #inject_postfooter)', 'weaver-xtreme'), 'standard');
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	// X Plus Injection

	$new_opts = weaverx_cz_add_injection('preheader', __('Preheader Injection Area', 'weaver-xtreme'),
		__('This code will be inserted just before the #header &lt;div&gt;. It will have the same width as the #wrapper area. This area may require extra styling to eliminate unwanted margins. (Area ID: #inject_preheader) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('header', __('Header Top Injection Area', 'weaver-xtreme'),
		__('This code will be inserted at the top of the #header &lt;div&gt;, before the top menu. It will have the same width as the header area. (Area ID: #inject_header) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('postheader', __('Post Header', 'weaver-xtreme'),
		__('This code will be inserted between the #header &lt;div&gt; and the #container &lt;div&gt;. It will have the same width as the #wrapper area. (Area ID: #inject_postheader) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('container_top', __('Container Top', 'weaver-xtreme'),
		__('This code will be inserted inside the #container &lt;div&gt; that wraps content, including before the top widget areas. It will have the same width as the container area. (Area ID: #inject_container_top) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('precontent', __('Content Top', 'weaver-xtreme'),
		__('This code will be inserted inside the #content div that wraps content. It will have the same width as the container area. (Area ID: #inject_precontent) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('pagecontentbottom', __('Page Content Bottom', 'weaver-xtreme'),
		__('This code will be at the bottom of page (including post single page view and page with posts) content. It will have the same width as the content area. (Area ID: #inject_pagecontentbottom) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);
	$new_opts = weaverx_cz_add_injection('postpostcontent', __('Post-Post Content', 'weaver-xtreme'),
		__('This code will be inserted after the content area of each post (not page). (Area class: .inject_postpostcontent) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('precomments', __('Pre-Comments', 'weaver-xtreme'),
		__('This code will be inserted just before the #comments div where comments are displayed. If comments
are open for the page, this area will include the class <em>.precomments-comments</em>, if closed <em>.precomments-nocomments</em>. (Area ID: #inject_precomments) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('postcomments', __('Post-Comments', 'weaver-xtreme'),
		__('This code will be inserted right after the #comments div where comments are displayed. If comments
are open for the page, this area will include the class <em>.postcomments-comments</em>, if closed <em>.postcomments-nocomments</em>. (Area ID: #inject_postcomments) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('prefooter', __('Pre-Footer', 'weaver-xtreme'),
		__('This code will be inserted just before the footer #colophon div. (Area ID: #inject_prefooter) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('presidebar', __('Primary Sidebar Top', 'weaver-xtreme'),
		__('This code will be inserted inside the primary sidebar area at the top. Not shown if no primary sidebar defined. (Area ID: #inject_presidebar) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('fixedtop', __('Fixed Browser Top', 'weaver-xtreme'),
		__('This code will be inserted in a fixed location at the top of the (non-IE8) desktop browser window. It will have the same width as the Wrapper Area. <em>You will need to add a Top Margin to the Wrapper Area.</em> Do not make this area too tall! (Area ID: #inject_fixedtop) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_injection('fixedbottom', __('Fixed Browser Bottom', 'weaver-xtreme'),
		__('This code will be inserted in a fixed location at the bottom of the (non-IE8) desktop browser window. It will have the same width as the Wrapper Area. <em>You will need to add a Bottom Margin to the Wrapper Area.</em> Do not make this area too tall! (Area ID: #inject_fixedbottom) (&star;Plus)', 'weaver-xtreme'));
	$content_sections['content-injection']['options'] = array_merge( $content_sections['content-injection']['options'],  $new_opts);



	/**
	 * Filter the definitions for the controls in the Color Scheme panel of the Customizer.
	 *
	 * @since 1.3.0.
	 *
	 * @param array    $content_sections    The array of definitions.
	 */
	$content_sections = apply_filters( 'weaverx_customizer_content_sections', $content_sections );

	// Merge with master array
	return array_merge( $sections, $content_sections );


}
endif;

add_filter( 'weaverx_customizer_sections', 'weaverx_customizer_define_content_sections' );

function weaverx_cz_add_injection($root, $label = '', $description = '' , $version = 'XPlus' ) {
	$opt = array();

	if ($version == 'XPlus') $label .= WEAVERX_PLUS_ICON;
	$opt[$root . '-heading'] = weaverx_cz_group_title( $label );

	if ($description) {
		$opt[$root . '-desc'] = array(
		'control' => array( 'control_type' => 'WeaverX_Misc_Control',
		'description'   => $description,
		'type'  => 'text'));
	}

	if ($version != 'XPlus' || weaverx_cz_is_plus()) {

	$opt["{$root}_insert"]  = array(
		'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_html', 'transport' => 'postMessage',	'default' => ''
		),
		'control' => array(
			'control_type' => 'WeaverX_Textarea_Control',
			'label'   => __( 'HTML', 'weaver-xtreme' ),		// . WEAVERX_REFRESH_ICON,
			'type'  => 'textarea',
			'input_attrs' => array(
				'rows' => '3',
				'placeholder' => __('Any HTML, including shortcodes.', 'weaver-xtreme'),
			),
		),
	);

	$opt["inject_{$root}_bgcolor"] = array (
		'setting' => array(
			'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
			'transport' => 'postMessage',
			'default' => weaverx_cz_getopt("inject_{$root}_bgcolor"),
		),
		'control' => array(
			'control_type' => WEAVERX_COLOR_CONTROL,
			'label'        => __('BG Color', 'weaver-xtreme'),
			'description'  => ''
				),
	);


	$opt["inject_{$root}_bgcolor_css"]  =  weaverx_cz_css(__( 'Custom CSS', 'weaver-xtreme' ));


	$opt["inject_add_class_{$root}"]  = array(
		'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_html', 'transport' => 'refresh',	'default' => ''
		),
		'control' => array(
			'control_type' => WEAVERX_PLUS_TEXT_CONTROL,
			'label'   => __( 'Add Classes', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
			'description'   => __( 'Space separated class names to add to this area (<em>Advanced option</em>) (&starf;Plus)', 'weaver-xtreme' ),
			'type'  => 'text',
			'input_attrs' => array(
			),
		),
	);
	$opt["hide_front_{$root}"]  = weaverx_cz_checkbox_refresh(
		__( 'Hide on front page', 'weaver-xtreme' ),
		__('If you check this box, then the code from this area will not be displayed on the front (home) page.', 'weaver-xtreme')
	);

	$opt["hide_rest_{$root}"]  = weaverx_cz_checkbox_refresh(
		__( 'Hide on non-front pages', 'weaver-xtreme' ),
		__('If you check this box, then the code from this area will not be displayed on non-front pages.', 'weaver-xtreme')
	);


	} // is plus
	$opt[$root . '-line-break'] = array(
		'control' => array( 'control_type' => 'WeaverX_Misc_Control',
		'label'   => '',
		'type'  => 'line'));



	return $opt;

}
?>
