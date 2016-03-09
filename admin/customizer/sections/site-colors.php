<?php

if ( ! function_exists( 'weaverx_customizer_define_colorscheme_sections' ) ) :
/**
 * Define the sections and settings for the Site Colors panel
 * Customize_Alpha_Color_Control
 * WP_Customize_Color_Control
 */


function weaverx_customizer_define_colorscheme_sections( $sections ) {
	$panel = 'weaverx_site-colors';
	$colorscheme_sections = array();

	/**
	 * General
	 */
	$colorscheme_sections['color-wrapping'] = array(	// NOTE: this name needed to move WP Site Background color to here in load-customizer.php
		'panel'   => $panel,
		'title'   => __( 'Wrapping Areas', 'weaver-xtreme' ),
		'description' => 'Set colors. Use Typography to set fonts.',
		'options' => array(

			'body_bgcolor'   => weaverx_cz_coloropt('body_bgcolor',
				__( 'Site Background Color - Theme Value', 'weaver-xtreme' ),
				__('Background color that wraps entire page.', 'weaver-xtreme')),


			'fadebody_bg'=> array(
				'setting' => array(
				),
				'control' => array(
					'label' => __( 'Fade Outside BG', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __('Will fade the Outside BG color, darker at top to lighter at bottom.', 'weaver-xtreme'),
					'type'  => 'checkbox',
				),
			),

			'wrapper_color' => weaverx_cz_coloropt('wrapper_color',
				__( 'Wrapper Text Color', 'weaver-xtreme' ),
				__('<strong>Global Text Color</strong> - To override, set colors for individual areas and items.', 'weaver-xtreme') ),


			'wrapper_bgcolor' => weaverx_cz_coloropt('wrapper_bgcolor',
				__( 'Wrapper BG Color', 'weaver-xtreme' ),
				__('<strong>Background Color</strong> - wraps entire content area. To override, set BG colors for individual areas.', 'weaver-xtreme') ),

			'container_color' => weaverx_cz_coloropt('container_color',
				__( 'Container Text Color', 'weaver-xtreme' ),
				__('Container (#container div) wraps content and sidebars.', 'weaver-xtreme') ),

			'container_bgcolor' => weaverx_cz_coloropt('container_bgcolor',
				__( 'Container BG Color', 'weaver-xtreme' ) ),


			'flow_color'=> array(
				'setting' => array (
					'transport' => 'refresh'
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_CHECKBOX_CONTROL,
					'label' => __( 'Flow Color to Bottom', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description' => __('If checked, Content and Sidebar bg colors will flow to bottom of the Container (that is, equal heights). You must provide background colors for the Content and Sidebars or the default bg color will be used.', 'weaver-xtreme'),
					'type'  => 'checkbox',
				),
			),

			'color-border-heading' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control','type'  => 'line',
				),
			),


			'color-border-heading' => weaverx_cz_heading( __( 'Border Color', 'weaver-xtreme' ),
				__('Border Color option found on <em>Style &rarr; Wrapping Areas</em> panel.', 'weaver-xtreme')),


		),
	);


	/**
	 * Links
	 */
	$colorscheme_sections['color-links'] = array(
		'panel'   => $panel,
		'title'   => __( 'Links', 'weaver-xtreme' ),
		'description' => 'Set colors for links. Use Typography to set fonts.',
		'options' => array(

			'link_color' => weaverx_cz_coloropt('link_color',
				__( 'Standard Links', 'weaver-xtreme' ),
				__('Default color for links. To override for links in specific areas, set colors for individual links below.', 'weaver-xtreme'), 'refresh' ),


			'link_hover_color' => weaverx_cz_coloropt('link_hover_color',
				__('Standard Link Hover Color', 'weaver-xtreme'),
				'', 'refresh' ),


			// info bar
			'color-info-line-1' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control','type'  => 'line',
				),
			),

			'ibarlink_color' => weaverx_cz_coloropt('ibarlink_color',
				__('Info Bar Link Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'ibarlink_hover_color' => weaverx_cz_coloropt('ibarlink_hover_color',
				__('Info Bar Link Hover Color', 'weaver-xtreme'),
				'', 'refresh' ),


			'color-info-line-2' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control','type'  => 'line',
				),
			),

			// content

			'contentlink_color' => weaverx_cz_coloropt('contentlink_color',
				 __('Content Links Color', 'weaver-xtreme'),
				'', 'refresh' ),
			'contentlink_hover_color' => weaverx_cz_coloropt('contentlink_hover_color',
				__('Content Links Hover Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'color-info-line-3' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control','type'  => 'line',
				),
			),

			// post meta info bar
			'ilink_color' => weaverx_cz_coloropt('ilink_color',
				__('Post Meta Info Link Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'ilink_hover_color' => weaverx_cz_coloropt('ilink_hover_color',
				__('Post Meta Info Link Hover Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'color-info-line-4' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control','type'  => 'line',
				),
			),

			// individual widgets

			'wlink_color' => weaverx_cz_coloropt('wlink_color',
				__('Individual Widgets Link Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'wlink_hover_color' => weaverx_cz_coloropt('wlink_hover_color',
				__('Individual Widgets Link Hover Color', 'weaver-xtreme'),
				'', 'refresh' ),


			'color-info-line-5' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control','type'  => 'line',
				),
			),

			'footerlink_color' => weaverx_cz_coloropt('footerlink_color',
				__('Footer Links Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'footerlink_hover_color' => weaverx_cz_coloropt('footerlink_hover_color',
				__('Footer Links Hover Color', 'weaver-xtreme'),
				'', 'refresh' ),

		),
	);



	/**
	 * Site Header
	 */
	$colorscheme_sections['color-header'] = array(
		'panel'   => $panel,
		'title'   => __( 'Header Area', 'weaver-xtreme' ),
		'options' => array(

			'header_color' => weaverx_cz_coloropt('header_color',
				__('Header Text Color', 'weaver-xtreme'),
				'' ),

			'header_bgcolor' => weaverx_cz_coloropt('header_bgcolor',
				__('Header BG Color', 'weaver-xtreme'),
				'' ),

			'hdrarea-cline1' => weaverx_cz_line(),

			'site_title_color' => weaverx_cz_coloropt('site_title_color',
				__('Site Title Text Color', 'weaver-xtreme'),
				'' ),

			'site_title_bgcolor' => weaverx_cz_coloropt('site_title_bgcolor',
				__('Site Title BG Color', 'weaver-xtreme'),
				__('Site Title BG Color', 'weaver-xtreme') ),

			'tagline_color' => weaverx_cz_coloropt('tagline_color',
				__('Site Tagline Text Color', 'weaver-xtreme'),
				'' ),

			'tagline_bgcolor' => weaverx_cz_coloropt('tagline_bgcolor',
				__('Site Tagline BG Color', 'weaver-xtreme'),
				'' ),

			'title_tagline_bgcolor' => weaverx_cz_coloropt('title_tagline_bgcolor',
				__('Title/Tagline Area BG', 'weaver-xtreme'),
				__('BG Color for the Title, Tagline, Search, and Mini Menu area.', 'weaver-xtreme') ),

			'hdrarea-cline2' => weaverx_cz_line(),

			'header_sb_color' => weaverx_cz_coloropt('header_sb_color',
				__('Header Widget Area Text Color', 'weaver-xtreme'),
				'' ),

			'header_sb_bgcolor' => weaverx_cz_coloropt('header_sb_bgcolor',
				__('Header Widget Area BG Color', 'weaver-xtreme'),
				'' ),

			'hdrarea-cline3' => weaverx_cz_line(),

			'header_html_color' => weaverx_cz_coloropt('header_html_color',
				__('Header HTML Area Text Color', 'weaver-xtreme') ),

			'header_html_bgcolor' => weaverx_cz_coloropt('header_html_bgcolor',
				__('Header HTML Area BG Color', 'weaver-xtreme') ),

		),
	);


	/**
	 * Main Menu
	 */
	$colorscheme_sections['color-menus'] = array(
		'panel'   => $panel,
		'title'   => __( 'Menus', 'weaver-xtreme' ),
		'description' => __( 'Set text, background, and hover colors for menus.', 'weaver-xtreme' ),
		'options' => array(
			'color-mm-heading' => weaverx_cz_group_title( __( 'Primary Menu Colors', 'weaver-xtreme' )),

			'm_primary_color' => weaverx_cz_coloropt('m_primary_color',
				__('Primary Menu Bar Text Color', 'weaver-xtreme'),
				__('Text Color for Entire menu bar.', 'weaver-xtreme') ),

			'm_primary_bgcolor' => weaverx_cz_coloropt('m_primary_bgcolor',
				__('Primary Menu Bar BG Color', 'weaver-xtreme'),
				__('Background Color for Entire menu bar.', 'weaver-xtreme') ),

			'm_primary_link_bgcolor' => weaverx_cz_coloropt('m_primary_link_bgcolor',
				__('Item BG Color', 'weaver-xtreme'),
				__('Background Color for menu bar items.', 'weaver-xtreme') ),


			'm_primary_dividers_color'   => weaverx_cz_coloropt_plus(
				'm_primary_dividers_color',
				__('Dividers between menu items', 'weaver-xtreme'),
				__('Add colored dividers between menu items. Leave blank for none.', 'weaver-xtreme'),
				'refresh'
			),

			'm_primary_hover_color' => weaverx_cz_coloropt('m_primary_hover_color',
				__('Primary Menu Bar Hover Text Color', 'weaver-xtreme'),
				'', 'refresh'),

			'm_primary_hover_bgcolor' => weaverx_cz_coloropt('m_primary_hover_bgcolor',
				__('Primary Menu Bar Hover BG Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'm_primary_clickable_bgcolor' => weaverx_cz_coloropt('m_primary_clickable_bgcolor',
				__('Open Submenu Arrow BG', 'weaver-xtreme'),
				__('Clickable mobile open submenu arrow BG. Contrasting BG color required for proper user interface. <em>Not used by SmartMenus</em>. (Default: rgba(255,255,255,0.2)', 'weaver-xtreme'), 'refresh' ),


			'm_primary_html_color'   => weaverx_cz_coloropt_plus(
				'm_primary_html_color',
				__('HTML: Text Color', 'weaver-xtreme'),
				__('Text Color for Left/Right Menu Bar HTML.', 'weaver-xtreme')
			),

			'm_primary_sub_color' => weaverx_cz_coloropt('m_primary_sub_color',
				__('Primary Sub-Menu Text Color', 'weaver-xtreme'),
				'' ),

			'm_primary_sub_bgcolor' => weaverx_cz_coloropt('m_primary_sub_bgcolor',
				__('Primary Sub-Menu BG Color', 'weaver-xtreme'),
				'' ),

			'm_primary_sub_hover_color' => weaverx_cz_coloropt('m_primary_sub_hover_color',
				__('Primary Sub-Menu Hover Text Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'm_primary_sub_hover_bgcolor' => weaverx_cz_coloropt('m_primary_sub_hover_bgcolor',
				__('Primary Sub-Menu Hover BG Color', 'weaver-xtreme'),
				'', 'refresh' ),



			'color-sm-heading' => weaverx_cz_group_title( __( 'Secondary Menu Colors', 'weaver-xtreme' ),
				__('You must define a Secondary Menu from the Custom Menus Content menu.', 'weaver-xtreme')),

			'm_secondary_color' => weaverx_cz_coloropt('m_secondary_color',
				__('Secondary Menu Bar Text Color', 'weaver-xtreme'),
				__('Text Color for Entire menu bar.', 'weaver-xtreme') ),

			'm_secondary_bgcolor' => weaverx_cz_coloropt('m_secondary_bgcolor',
				__('Secondary Menu Bar BG Color', 'weaver-xtreme'),
				__('Background Color for Entire menu bar.', 'weaver-xtreme') ),

			'm_secondary_link_bgcolor' => weaverx_cz_coloropt('m_secondary_link_bgcolor',
				__('Item BG Color', 'weaver-xtreme'),
				__('Background Color for menu bar items.', 'weaver-xtreme') ),

			'm_secondary_dividers_color'   => weaverx_cz_coloropt_plus(
				'm_secondary_dividers_color',
				__('Dividers between menu items', 'weaver-xtreme'),
				__('Add colored dividers between menu items. Leave blank for none.', 'weaver-xtreme'),
				'refresh'
			),

			'm_secondary_hover_color' => weaverx_cz_coloropt('m_secondary_hover_color',
				__('Secondary Menu Bar Hover Text Color', 'weaver-xtreme'),
				'', 'refresh'),

			'm_secondary_hover_bgcolor' => weaverx_cz_coloropt('m_secondary_hover_bgcolor',
				__('Secondary Menu Bar Hover BG Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'm_secondary_clickable_bgcolor' => weaverx_cz_coloropt('m_secondary_clickable_bgcolor',
				__('Open Submenu Arrow BG', 'weaver-xtreme'),
				__('Clickable mobile open submenu arrow BG. Contrasting BG color required for proper user interface. <em>Not used by SmartMenus</em>. (Default: rgba(255,255,255,0.2)', 'weaver-xtreme'), 'refresh' ),


			'm_secondary_html_color'    => weaverx_cz_coloropt_plus(
				'm_secondary_html_color',
				__('HTML: Text Color', 'weaver-xtreme'),
				__('Text Color for Left/Right Menu Bar HTML.', 'weaver-xtreme')
			),

			'm_secondary_sub_color' => weaverx_cz_coloropt('m_secondary_sub_color',
				__('Secondary Sub-Menu Text Color', 'weaver-xtreme'),
				'' ),

			'm_secondary_sub_bgcolor' => weaverx_cz_coloropt('m_secondary_sub_bgcolor',
				__('Secondary Sub-Menu BG Color', 'weaver-xtreme'),
				'' ),

			'm_secondary_sub_hover_color' => weaverx_cz_coloropt('m_secondary_sub_hover_color',
				__('Secondary Sub-Menu Hover Text Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'm_secondary_sub_hover_bgcolor' => weaverx_cz_coloropt('m_secondary_sub_hover_bgcolor',
				__('Secondary Sub-Menu Hover BG Color', 'weaver-xtreme'),
				'', 'refresh' ),




			'color-minim-heading' => weaverx_cz_group_title( __( 'Header Mini Menu Colors', 'weaver-xtreme' ),
				__('You must define a Header Menu from the Custom Menus Content menu.', 'weaver-xtreme')),

			'm_header_mini_color' => weaverx_cz_coloropt('m_header_mini_color',
				__('Header Mini Menu Text Color', 'weaver-xtreme') ),

			'm_header_mini_bgcolor' => weaverx_cz_coloropt('m_header_mini_bgcolor',
				__('Header Mini Menu BG Color', 'weaver-xtreme') ),

			'm_header_mini_hover_color' => weaverx_cz_coloropt('m_header_mini_hover_color',
				__('Header Mini Menu Hover Text Color', 'weaver-xtreme'),
				'', 'refresh'),


			'color-allmenus-heading' => weaverx_cz_group_title( __( 'Colors For All Menus', 'weaver-xtreme' ),
				__('These options specify current page attributes for all menus.', 'weaver-xtreme')),

			'menubar_curpage_color' => weaverx_cz_coloropt('menubar_curpage_color',
				 __('Menus Current Page Text Color', 'weaver-xtreme') ),

			'menubar_curpage_bgcolor' => weaverx_cz_coloropt('menubar_curpage_bgcolor',
				__('Menus Current Page BG Color', 'weaver-xtreme') ),


			'm_retain_hover'=> array(
				'setting' => array(
				),
				'control' => array(
					'label' => __( 'Retain Menu Bar Hover BG Color', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __('Retain the menu bar item hover BG color when sub-menus are opened.', 'weaver-xtreme'),
					'type'  => 'checkbox',
				),
			),

		),
	);

	if (weaverx_cz_is_plus()) {
		$new_opts = array (
			'color-xm-heading' => weaverx_cz_group_title( __( 'Extra Menu Colors', 'weaver-xtreme' )  . WEAVERX_PLUS_ICON),

			'm_extra_color' => weaverx_cz_coloropt('m_extra_color',
				__('Extra Menu Bar Text Color', 'weaver-xtreme'),
				__('Text Color for Entire menu bar.', 'weaver-xtreme') ),

			'm_extra_bgcolor' => weaverx_cz_coloropt('m_extra_bgcolor',
				__('Extra Menu Bar BG Color', 'weaver-xtreme'),
				__('Background Color for Entire menu bar.', 'weaver-xtreme') ),

			'm_extra_link_bgcolor' => weaverx_cz_coloropt('m_extra_link_bgcolor',
				__('Item BG Color', 'weaver-xtreme'),
				__('Background Color for menu bar items.', 'weaver-xtreme') ),


			'm_extra_dividers_color'   => weaverx_cz_coloropt_plus(
				'm_extra_dividers_color',
				__('Dividers between menu items', 'weaver-xtreme'),
				__('Add colored dividers between menu items. Leave blank for none.', 'weaver-xtreme'),
				'refresh'
			),

			'm_extra_hover_color' => weaverx_cz_coloropt('m_extra_hover_color',
				__('Extra Menu Bar Hover Text Color', 'weaver-xtreme'),
				'', 'refresh'),

			'm_extra_hover_bgcolor' => weaverx_cz_coloropt('m_extra_hover_bgcolor',
				__('Extra Menu Bar Hover BG Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'm_extra_clickable_bgcolor' => weaverx_cz_coloropt('m_extra_clickable_bgcolor',
				__('Open Submenu Arrow BG', 'weaver-xtreme'),
				__('Clickable mobile open submenu arrow BG. Contrasting BG color required for proper user interface. <em>Not used by SmartMenus</em>. (Default: rgba(255,255,255,0.2)', 'weaver-xtreme'), 'refresh' ),


			'm_extra_html_color'   => weaverx_cz_coloropt_plus(
				'm_extra_html_color',
				__('HTML: Text Color', 'weaver-xtreme'),
				__('Text Color for Left/Right Menu Bar HTML.', 'weaver-xtreme')
			),

			'm_extra_sub_color' => weaverx_cz_coloropt('m_extra_sub_color',
				__('Extra Sub-Menu Text Color', 'weaver-xtreme'),
				'' ),

			'm_extra_sub_bgcolor' => weaverx_cz_coloropt('m_extra_sub_bgcolor',
				__('Extra Sub-Menu BG Color', 'weaver-xtreme'),
				'' ),

			'm_extra_sub_hover_color' => weaverx_cz_coloropt('m_extra_sub_hover_color',
				__('Extra Sub-Menu Hover Text Color', 'weaver-xtreme'),
				'', 'refresh' ),

			'm_extra_sub_hover_bgcolor' => weaverx_cz_coloropt('m_extra_sub_hover_bgcolor',
				__('Extra Sub-Menu Hover BG Color', 'weaver-xtreme'),
				'', 'refresh' ),
		);
	} else {
		$new_opts = weaverx_cz_add_plus_message('color_menus', __('Extra Menu', 'weaver-xtreme'),
			__('Add extra menus with <strong>Weaver Xtreme Plus</strong>.', 'weaver-xtreme'));
	}
	// add stub or extra menu options
	$colorscheme_sections['color-menus']['options'] = array_merge( $colorscheme_sections['color-menus']['options'],  $new_opts);

	/**
	 * Info Bar
	 */
	$colorscheme_sections['color-info-bar'] = array(
		'panel'   => $panel,
		'title'   => __( 'Info Bar', 'weaver-xtreme' ),
		'description' => __('Info Bar has breadcrumbs and paged navigation displayed under Primary Menu.', 'weaver-xtreme'),
		'options' => array(

			'infobar_color' => weaverx_cz_coloropt(
				'infobar_color',
				__('Info Bar Text Color', 'weaver-xtreme')
			),

			'infobar_bgcolor' => weaverx_cz_coloropt(
				'infobar_bgcolor',
				__('Info Bar BG Color', 'weaver-xtreme')
			),



		),
	);

	/**
	 * Content
	 */
	$colorscheme_sections['color-content'] = array(
		'panel'   => $panel,
		'title'   => __( 'Content', 'weaver-xtreme' ),
		'description' => __('Colors for general page and post content. You can override post specific colors on the <em>Post Specific Colors</em> panel.', 'weaver-xtreme'),
		'options' => array(

			'content_color' => weaverx_cz_coloropt(
				'content_color',
				__('Content Area Text Color', 'weaver-xtreme')
			),

			'content_bgcolor' => weaverx_cz_coloropt(
				'content_bgcolor',
				__('Content Area BG Color', 'weaver-xtreme')
			),

			'page_title_color' => weaverx_cz_coloropt(
				'page_title_color',
				__('Page Title Text Color', 'weaver-xtreme'),
				__('Page titles, including pages, post single pages, and archive-like pages.', 'weaver-xtreme')
			),

			'page_title_bgcolor' => weaverx_cz_coloropt(
				'page_title_bgcolor',
				__('Page Title BG Color', 'weaver-xtreme')
			),

			'archive_title_color' => weaverx_cz_coloropt(
				'archive_title_color',
				__('Archive Pages Title Text Color', 'weaver-xtreme'),
				__('Archive-like page titles: archives, categories, tags, searches.', 'weaver-xtreme')
			),

			'archive_title_bgcolor' => weaverx_cz_coloropt(
				'archive_title_bgcolor',
				__('Archive Pages Title BG Color', 'weaver-xtreme')
			),

			'content_h_color' => weaverx_cz_coloropt(
				'content_h_color',
				__('Content Headings Text Color', 'weaver-xtreme') ,
				__('Headings (&lt;h1&gt;-&lt;h6&gt;) in page and post content.', 'weaver-xtreme')
			),

			'content_h_bgcolor' => weaverx_cz_coloropt(
				'content_h_bgcolor',
				__('Content Headings BG', 'weaver-xtreme'),
				__('Headings (&lt;h1&gt;-&lt;h6&gt;) in page and post content.', 'weaver-xtreme')
			),


			'content-line1' => weaverx_cz_line(),

			'input_color' => weaverx_cz_coloropt(
				'input_color',
				__('Text Input Areas Color', 'weaver-xtreme')
			),

			'input_bgcolor' => weaverx_cz_coloropt(
				'input_bgcolor',
				__('Text Input Areas BG Color', 'weaver-xtreme')
			),

			'search_color' => weaverx_cz_coloropt(
				'search_color',
				__('Search Input Text Color', 'weaver-xtreme')
			),

			'search_bgcolor' => weaverx_cz_coloropt(
				'search_bgcolor',
				__('Search Input BG Color', 'weaver-xtreme')
			),


			'search_icon' => array(
				'setting' => array(	'sanitize_callback' => 'weaverx_cz_sanitize_html', 'transport' => 'refresh', 'default' => 'black'	),
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control',
					'label'   => __( 'Search Icon', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description'   => __( 'Search Icon used for Search boxes', 'weaver-xtreme' ),
					'type'  => 'radio-icons',
					'choices' => weaverx_cz_choices_search()
				),
			),
			'content-line1a' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control',	'type'  => 'line',
				),
			),

			'hr_color' => weaverx_cz_coloropt(
				'hr_color',
				__('&lt;HR&gt; color', 'weaver-xtreme'),
				__('Color of horizontal (&lt;hr&gt;) lines in posts and pages. Use the <em>Custom CSS &rarr; Content</em> panel to customize the style of the &lt;hr&gt;.', 'weaver-xtreme')
			),

			'content-line1b' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control',	'type'  => 'line',
				),
			),

			'comment_headings_color' => weaverx_cz_coloropt(
				'comment_headings_color',
				__('Color for headings in comment form', 'weaver-xtreme')
			),


			'comment_content_bgcolor' => weaverx_cz_coloropt(
				'comment_content_bgcolor',
				__('Comment content area BG Color', 'weaver-xtreme')
			),

			'comment_submit_bgcolor' => weaverx_cz_coloropt(
				'comment_submit_bgcolor',
				__('"Post Comment" submit button BG Color', 'weaver-xtreme')
			),

			'content-line2' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control',	'type'  => 'line',
				),
			),

			'editor_bgcolor' => weaverx_cz_coloropt(
				'editor_bgcolor',
				__('Page/Post Editor BG', 'weaver-xtreme'),
				__("Alternative Background Color to use for Page/Post editor if you're using transparent or image backgrounds.", 'weaver-xtreme'),
				'refresh'
			),


		),
	);

	/**
	 * Post Specific
	 */
	$colorscheme_sections['color-post-specific'] = array(
		'panel'   => $panel,
		'title'   => __( 'Post Specific', 'weaver-xtreme' ),
		'description' => __('Post Specific Colors - override Content colors.', 'weaver-xtreme'),
		'options' => array(
			'color-post-heading' => weaverx_cz_heading( __( 'Post Specific', 'weaver-xtreme' )),

			'post_color' => weaverx_cz_coloropt(
				'post_color',
				__('Post Area Text Color', 'weaver-xtreme')
			),

			'post_bgcolor' => weaverx_cz_coloropt(
				'post_bgcolor',
				__('Post Area BG Color', 'weaver-xtreme')
			),

			'stickypost_bgcolor' => weaverx_cz_coloropt(
				'stickypost_bgcolor',
				__('Sticky Post Area BG Color', 'weaver-xtreme')
			),

			'post_title_color' => weaverx_cz_coloropt(
				'post_title_color',
				__('Post Title Text Color', 'weaver-xtreme')
			),

			'post_title_bgcolor' => weaverx_cz_coloropt(
				'post_title_bgcolor',
				 __('Post Title BG Color', 'weaver-xtreme')
			),

			'post_title_hover_color' => weaverx_cz_coloropt(
				'post_title_hover_color',
				__('Post Title Hover Color', 'weaver-xtreme'),
				__('Color if you want the Post Title to show alternate color for hover.', 'weaver-xtreme'),
				'refresh'
			),


			'post_info_top_color' => weaverx_cz_coloropt(
				'post_info_top_color',
				__('Top Post Meta Info Text Color', 'weaver-xtreme')
			),

			'post_info_top_bgcolor' => weaverx_cz_coloropt(
				'post_info_top_bgcolor',
				__('Top Post Meta Info BG Color', 'weaver-xtreme')
			),

			'post_info_bottom_color' => weaverx_cz_coloropt(
				'post_info_bottom_color',
				__('Bottom Post Meta Info Text Color', 'weaver-xtreme')
			),


			'post_info_bottom_bgcolor' => weaverx_cz_coloropt(
				'post_info_bottom_bgcolor',
				__('Bottom Post Meta Info BG Color', 'weaver-xtreme')
			),

			'post_icons_color' => weaverx_cz_coloropt(
				'post_icons_color',
				__('Post Font Icons Color', 'weaver-xtreme'),
				__('Set Font Icon color if Font Icons on Info Lines specified on the <em>Style &rarr; Post Specific</em> panel.', 'weaver-xtreme')
			),

			'post_author_bgcolor' => weaverx_cz_coloropt(
				'post_author_bgcolor',
				__('Author Info BG Color', 'weaver-xtreme'),
				__('Background color used for Author Bio.', 'weaver-xtreme')
			),


		),
	);


	/**
	 * Sidebars
	 */
	$colorscheme_sections['color-sidebars'] = array(
		'panel'   => $panel,
		'title'   => __( 'Sidebars &amp; Widget Area', 'weaver-xtreme' ),
		'description' => __('Main Sidebars and Widget areas. Header and Footer areas options under Header and Footer panels.', 'weaver-xtreme'),
		'options' => array(

			'color-primary-widget-heading' => weaverx_cz_group_title( __( 'Primary Widget Area', 'weaver-xtreme' )),

			'primary_color'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('primary_color'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Primary Widget Area Text Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),
			'primary_bgcolor'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('primary_bgcolor'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Primary Widget Area BG Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),


			'color-secondary-widget-heading' => weaverx_cz_group_title( __( 'Secondary Widget Area', 'weaver-xtreme' )),

			'secondary_color'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('secondary_color'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Secondary Widget Area Text Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),
			'secondary_bgcolor'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('secondary_bgcolor'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Secondary Widget Area BG Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),



			'color-top-widget-heading' => weaverx_cz_group_title( __( 'Top Widget Areas', 'weaver-xtreme' ),
				__('Properties for all Top Widget areas (Sitewide, Pages, Blog, Archive).', 'weaver-xtreme')),

			'top_color'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('top_color'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Top Widget Areas Text Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),
			'top_bgcolor'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('top_bgcolor'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Top Widget Areas BG Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),


			'color-bottom-widget-heading' => weaverx_cz_group_title( __( 'Bottom Widget Areas', 'weaver-xtreme' ),
				__('Properties for all Bottom Widget areas (Sitewide, Pages, Blog, Archive).', 'weaver-xtreme')),

			'bottom_color'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('bottom_color'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Bottom Widget Areas Text Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),
			'bottom_bgcolor'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('bottom_bgcolor'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Bottom Widget Areas BG Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),
		),
	);

	/**
	 * Widgets
	 */
	$colorscheme_sections['color-widgets'] = array(
		'panel'   => $panel,
		'title'   => __( 'Individual Widgets', 'weaver-xtreme' ),
		'description' => 'Properties for individual widgets (e.g., Text, Recent Posts, etc.)',
		'options' => array(

			'widget_color'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('widget_color'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Individual Widgets Text Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),
			'widget_bgcolor'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('widget_bgcolor'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Individual Widgets BG Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),

			'widget_title_color'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('widget_title_color'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Individual Widgets Title Text Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),
			'widget_title_bgcolor'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('widget_title_bgcolor'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Individual Widgets Title BG Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),


		),
	);


	/**
	 * Footer
	 */
	$colorscheme_sections['color-footer'] = array(
		'panel'   => $panel,
		'title'   => __( 'Footer Area', 'weaver-xtreme' ),
		'options' => array(
			'footer_color'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('footer_color'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Footer Area Text Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),
			'footer_bgcolor'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('footer_bgcolor'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Footer Area BG Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),



			'footer_sb_color'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('footer_sb_color'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Footer Widget Area Text Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),
			'footer_sb_bgcolor'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('footer_sb_bgcolor'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Footer Widget Area BG Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),

			'footer_html_color'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('footer_html_color'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Footer HTML Area Text Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),
			'footer_html_bgcolor'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT, 'default' => weaverx_cz_getopt('footer_html_bgcolor'),
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __('Footer HTML Area BG Color', 'weaver-xtreme'),
					'description'  => ''
				),
			),

		),
	);

	/**
	 * Filter the definitions for the controls in the Color Scheme panel of the Customizer.
	 *
	 * @since 1.3.0.
	 *
	 * @param array    $colorscheme_sections    The array of definitions.
	 */
	$colorscheme_sections = apply_filters( 'weaverx_customizer_colorscheme_sections', $colorscheme_sections );

	// Merge with master array
	return array_merge( $sections, $colorscheme_sections );


}
endif;

add_filter( 'weaverx_customizer_sections', 'weaverx_customizer_define_colorscheme_sections' );

?>
