<?php

if ( ! function_exists( 'weaverx_customizer_define_style_sections' ) ) :
/**
 * Define the sections and settings for the style panel
 *
 */
function weaverx_customizer_define_style_sections( $sections ) {
	$panel = 'weaverx_style';
	$style_sections = array();

define('WEAVERX_ROUNDED_TRANSPORT', 'postMessage');

	// global settings

	$style_sections['style-global'] = array(
		'panel'   => $panel,
		'title'   => __( 'Global Style Options', 'weaver-xtreme' ),
		'description' => 'Set some global settings that affect style.',
		'options' => array(

			'border_color'   => array(
				'setting' => array(
					'sanitize_callback' => WEAVERX_CZ_SANITIZE_COLOR,
					'transport' => WEAVERX_COLOR_TRANSPORT,
					'default' =>  '#222222'
				),
				'control' => array(
					'control_type' => WEAVERX_COLOR_CONTROL,
					'label'        => __( 'Border Color...', 'weaver-xtreme' ),
					'description'  => __('Color for all borders.', 'weaver-xtreme'),
				),
			),

			'border_width_int'     => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage',
					'default' => 1
				),
				'control' => array(
					'control_type' => 'WeaverX_Range_Control',
					'label'   => __( 'Border Width (px)', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
			),

			'border_style' => weaverx_cz_select_plus(
				__( 'Border Style', 'weaver-xtreme' ),
				__( 'Style of borders - width needs to be > 1 and color other than black for some styles to work correctly.', 'weaver-xtreme' ),
				'weaverx_cz_choices_border_style',	'solid', 'refresh'
			),



			'rounded_corners_radius'     => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'refresh',
					'default' => 8
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Corner Radius (px)', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description' => __( 'Controls how "round" corners are. Specify a value (5 to 15 look best) for corner radius.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
			),

			'custom_shadow'     => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_css', 'transport' => 'refresh',	'default' => ''
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_TEXTAREA_CONTROL,
					'label'   => __( 'Custom Shadow', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description'   => __( 'This defines the "Custom Shadow" shown on the <em>Add shadow</em> options. You will have to select "Custom Shadow" to use the shadow style you define here. Specify full <em>box-shadow</em> CSS rule.', 'weaver-xtreme' ),
					'type'  => 'textarea',
					'input_attrs' => array(
						'rows' => '1',
						'placeholder' => __('{box-shadow: 0 0 3px 1px rgba(0,0,0,0.25);} /* for example */', 'weaver-xtreme'),
					),
				),
			),


		),
	);

	/**
	 * General
	 */
	$style_sections['style-wrapping'] = array(
		'panel'   => $panel,
		'title'   => __( 'Wrapping Areas', 'weaver-xtreme' ),
		'description' => 'Set borders, shadows, and rounded corners for main Wrapper and Container wrapping areas.',
		'options' => array(

			'wrapper-style-genopts' => weaverx_cz_group_title( __( 'General Style Global Options', 'weaver-xtreme' ),
				__('These settings control global attributes of borders, etc.', 'weaver-xtreme')),


			'wrapper-style-heading' => weaverx_cz_group_title( __( 'Wrapper Area', 'weaver-xtreme' ),
				__('The Wrapper is the &lt;div&gt; that wraps entire site.', 'weaver-xtreme')),

			'wrapper_border'=> array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),
			'wrapper_shadow' => weaverx_cz_select(
				__( 'Add shadow', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),

			'wrapper_rounded' => weaverx_cz_select(
				__( 'Rounded corners', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),


			'container-style-heading' => weaverx_cz_group_title( __( 'Container Area', 'weaver-xtreme' ),
				__('The Container is the &lt;div&gt; that wraps site content areas, including sidebars. Does not include Header and Footer.', 'weaver-xtreme')),

			'container_border' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'container_shadow' => weaverx_cz_select(
				__( 'Add shadow', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),


			'container_rounded' => weaverx_cz_select(
				__( 'Rounded corners', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),



		),
	);


	/**
	 * Site Header
	 */
	$style_sections['style-header'] = array(
		'panel'   => $panel,
		'title'   => __( 'Header Area', 'weaver-xtreme' ),
		'options' => array(
		'style-heading-header' => weaverx_cz_group_title( __( 'Site Header Area Borders', 'weaver-xtreme' )),

		'header_border' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border to entire Header Area', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

		'header_sb_border'=> array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border to Header Widget Area', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

		'header_html_border'=> array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border to Header HTML Area', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

		'style-shadow-header' => weaverx_cz_group_title( __( 'Site Header Area Shadows', 'weaver-xtreme' )),

		'header_shadow' => weaverx_cz_select(
				__( 'Add shadow to header', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),

		'header_sb_shadow' => weaverx_cz_select(
				__( 'Add shadow to Header Widget Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),

		'header_html_shadow' => weaverx_cz_select(
				__( 'Add shadow to Header HTML Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),


			//  rounded

		'style-rounded-header' => weaverx_cz_group_title( __( 'Site Header Rounded Corners', 'weaver-xtreme' ),
			__('Note that rounded corners require borders or bg color to show, and interact with surrounding areas. You may have to set several options to get rounded corners to display.', 'weaver-xtreme')),

		'header_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to Header Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),

		'header_sb_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to Header Widget Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),
		'header_html_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to Header HTML Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),


		),
	);


	/**
	 * Main Menu
	 */
	$style_sections['style-menus'] = array(
		'panel'   => $panel,
		'title'   => __( 'Menus', 'weaver-xtreme' ),
		'description' => __( 'Set style for Menus.', 'weaver-xtreme' ),
		'options' => array(

			'style-mm-heading' => weaverx_cz_group_title(
				__( 'Primary Menu', 'weaver-xtreme' )
			),

			'm_primary_sub_border' => weaverx_cz_checkbox(
				__( 'Add border to Primary Menu bar', 'weaver-xtreme' ) ),

			'm_primary_sub_border' => weaverx_cz_checkbox(
				__( 'Add border to Sub-Menus', 'weaver-xtreme' ) ),

			'm_primary_shadow' => weaverx_cz_select(
				__( 'Add shadow to menu bar', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),

			'm_primary_sub_noshadow' => weaverx_cz_heading(
				__( 'Add Shadow to Sub-Menus', 'weaver-xtreme' ),
				__('Sub-Menus do <em>not</em> support shadows.', 'weaver-xtreme')
			),


			'm_primary_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to menu bar', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),

			'm_primary_sub_rounded' => weaverx_cz_checkbox_refresh(
				__( 'Rounded Primary Sub-Menu corners', 'weaver-xtreme' )
			),


			'style-sm-line1' => weaverx_cz_line(),

			// secondary menu

			'style-sm-heading' => weaverx_cz_group_title(
				__( 'Secondary Menu', 'weaver-xtreme' )
			),

			'm_secondary_sub_border' => weaverx_cz_checkbox(
				__( 'Add border to Secondary Menu bar', 'weaver-xtreme' ) ),

			'm_secondary_sub_border' => weaverx_cz_checkbox(
				__( 'Add border to Sub-Menus', 'weaver-xtreme' ) ),

			'm_secondary_shadow' => weaverx_cz_select(
				__( 'Add shadow to menu bar', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),

			'm_secondary_sub_noshadow' => weaverx_cz_heading(
				__( 'Add Shadow to Sub-Menus', 'weaver-xtreme' ),
				__('Sub-Menus do <em>not</em> support shadows.', 'weaver-xtreme')
			),

			'm_secondary_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to menu bar', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),

			'm_secondary_sub_rounded' => weaverx_cz_checkbox_refresh(
				__( 'Rounded Secondary Sub-Menu corners', 'weaver-xtreme' )
			),

			'style-sm-line2' => weaverx_cz_line(),

			'style-allmenus-heading' => weaverx_cz_group_title( __( 'Style For All Menus', 'weaver-xtreme' ),
				__('These options specify current page attributes for all menus.', 'weaver-xtreme')),

			'placeholder_cursor' => weaverx_cz_select(
				__( 'Placeholder Menu Hover Cursor', 'weaver-xtreme' ),
				__( 'Cursor :hover attribute for placeholder menu items (only with Custom Menu Items with URL==#).', 'weaver-xtreme' ),
				'weaverx_cz_choices_pointer',	'pointer', 'refresh'
			),




		),
	);

	if (weaverx_cz_is_plus()) {
		$new_opts = array(
			'style-xm-line1' => weaverx_cz_line(),

			// secondary menu

			'style-xm-heading' => weaverx_cz_group_title(
				__( 'Extra Menu', 'weaver-xtreme' )
			),

			'm_extra_sub_border' => weaverx_cz_checkbox(
				__( 'Add border to Extra Menu bar', 'weaver-xtreme' ) ),

			'm_extra_sub_border' => weaverx_cz_checkbox(
				__( 'Add border to Sub-Menus', 'weaver-xtreme' ) ),

			'm_extra_shadow' => weaverx_cz_select(
				__( 'Add shadow to menu bar', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),

			'm_extra_sub_noshadow' => weaverx_cz_heading(
				__( 'Add Shadow to Sub-Menus', 'weaver-xtreme' ),
				__('Sub-Menus do <em>not</em> support shadows.', 'weaver-xtreme')
			),

			'm_extra_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to menu bar', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),

			'm_extra_sub_rounded' => weaverx_cz_checkbox_refresh(
				__( 'Rounded Extra Sub-Menu corners', 'weaver-xtreme' )
			),

		);

	} else {
		$new_opts = weaverx_cz_add_plus_message('spacing_menus', __('Extra Menu', 'weaver-xtreme'),
			__('Add extra menus with <strong>Weaver Xtreme Plus</strong>.', 'weaver-xtreme'));
	}
	// add stub or extra menu options
	$style_sections['style-menus']['options'] = array_merge( $style_sections['style-menus']['options'],  $new_opts);


	/**
	 * Info Bar
	 */
	$style_sections['style-info-bar'] = array(
		'panel'   => $panel,
		'title'   => __( 'Info Bar', 'weaver-xtreme' ),
		'description' => __('Info Bar with breadcrumb and paged navigation displayed under Primary Menu.', 'weaver-xtreme'),
		'options' => array(
			'infobar_border' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border to Info Bar', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'infobar_shadow' => weaverx_cz_select(
				__( 'Add shadow to Info Bar', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),

			'infobar_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to Info Bar', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),


		),
	);

	/**
	 * Content
	 */
	$style_sections['style-content'] = array(
		'panel'   => $panel,
		'title'   => __( 'Content', 'weaver-xtreme' ),
		'description' => __('style for general page and post content.', 'weaver-xtreme'),
		'options' => array(

		'content_border' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border to Content Area', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

		'content_shadow' => weaverx_cz_select(
				__( 'Add shadow to Content Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),



		'content_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to Content Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),


		'page_title_underline_int'     => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage',
					'default' => 0
				),
				'control' => array(
					'control_type' => 'WeaverX_Range_Control',
					'label'   => __( 'Bar under Page Title (px)', 'weaver-xtreme' ),
					'description'   => __( 'Enter size in px if you want a bar under Page Titles. Leave 0 for no bar. Color matches title.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
			),

		'contentlist_bullet' => weaverx_cz_select(
				__( 'Content List Bullet Style', 'weaver-xtreme' ),
				__( 'Bullet used for Unordered Lists in Content.', 'weaver-xtreme' ),
				'weaverx_cz_choices_list_bullets',	'disc', 'postMessage'
			),

		'weaverx_tables' => weaverx_cz_select(
				__( 'Table Style', 'weaver-xtreme' ) ,
				__( 'Style used for tables in content. <span style="font-weigiht:bold;color:red;">WARNING!</span> Tables are inherently non-responsive, and <em>do not</em> work well for mobile devices. We advise you to avoid using tables.', 'weaver-xtreme' ),
				'weaverx_cz_choices_tables',	'default', 'refresh'
			),




		'show_comment_borders' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'refresh'
				),
				'control' => array(
					'label' => __( 'Show Borders on Comments', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __( 'Show Borders around comment sections - improves visual look of comments.', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),





		),
	);

	/**
	 * Post Specific
	 */
	$style_sections['style-post-specific'] = array(
		'panel'   => $panel,
		'title'   => __( 'Post Specific', 'weaver-xtreme' ),
		'description' => __('Post Specific style - override Content style.', 'weaver-xtreme'),
		'options' => array(

		'post_border' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border to Posts', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

		'post_shadow' => weaverx_cz_select(
				__( 'Add shadow to posts', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),


		'post_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to posts', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),

		'post_icons' => weaverx_cz_select(
				__( 'Text or Icons for Post Info', 'weaver-xtreme' ),
				__( 'Use Icons instead of Text descriptions in Post Meta Info. You can specify a color for the Font Icons on the <em>Color &rarr; Post Specific</em> panel.', 'weaver-xtreme' ),
				'weaverx_cz_choices_post_icons',	'text', 'refresh'
			),


		'post_title_underline_int'     => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage',
					'default' => 0
				),
				'control' => array(
					'control_type' => 'WeaverX_Range_Control',
					'label'   => __( 'Bar under Post Titles (px)', 'weaver-xtreme' ),
					'description'   => __( 'Enter size in px if you want a bar under Post Titles. Leave 0 for no bar. Color matches title.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
			),



		),
	);


	/**
	 * Sidebars
	 */
	$style_sections['style-sidebars'] = array(
		'panel'   => $panel,
		'title'   => __( 'Sidebars &amp; Widget Areas', 'weaver-xtreme' ),
		'description' => __('Style for Main Sidebars and Widget areas.', 'weaver-xtreme'),
		'options' => array(
			'style-primary-widget-heading' => weaverx_cz_group_title( __( 'Primary Widget Area', 'weaver-xtreme' )),

			'primary_border'=> array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'primary_shadow' => weaverx_cz_select(
				__( 'Add shadow', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),


			'primary_rounded' => weaverx_cz_select(
				__( 'Add rounded corners', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),





			'style-secondary-widget-heading' => weaverx_cz_group_title( __( 'Secondary Widget Area', 'weaver-xtreme' )),

			'secondary_border'=> array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'secondary_shadow' => weaverx_cz_select(
				__( 'Add shadow', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),

			'secondary_rounded' => weaverx_cz_select(
				__( 'Add rounded corners', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),





			'style-top-widget-heading' => weaverx_cz_group_title( __( 'Top Widget Areas', 'weaver-xtreme' ),
				__('Properties for all Top Widget areas (Sitewide, Pages, Blog, Archive).', 'weaver-xtreme')),

			'top_border'=> array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'top_shadow' => weaverx_cz_select(
				__( 'Add shadow', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),

			'top_rounded' => weaverx_cz_select(
				__( 'Add rounded corners', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),



			'style-bottom-widget-heading' => weaverx_cz_group_title( __( 'Bottom Widget Areas', 'weaver-xtreme' ),
				__('Properties for all Bottom Widget areas (Sitewide, Pages, Blog, Archive).', 'weaver-xtreme')),

			'bottom_border'=> array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'bottom_shadow' => weaverx_cz_select(
				__( 'Add shadow', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),



			'bottom_rounded' => weaverx_cz_select(
				__( 'Add rounded corners', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),


		),
	);

	/**
	 * Widgets
	 */
	$style_sections['style-widgets'] = array(
		'panel'   => $panel,
		'title'   => __( 'Individual Widgets', 'weaver-xtreme' ),
		'description' => __('Styling for individual widgets.', 'weaver-xtreme'),
		'options' => array(
			'widget_border'=> array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'widget_shadow' => weaverx_cz_select(
				__( 'Add shadow to Individual Widgets', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),


			'widget_rounded' => weaverx_cz_select(
				__( 'Rounded corners', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),



			'widget_title_underline_int'     => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage',
					'default' => 0
				),
				'control' => array(
					'control_type' => 'WeaverX_Range_Control',
					'label'   => __( 'Bar under Widget Titles (px)', 'weaver-xtreme' ),
					'description'   => __( 'Enter size in px if you want a bar under Widget Titles. Leave 0 for no bar. Color matches title.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
			),

			'widgetlist_bullet' => weaverx_cz_select(
				__('Widget List Bullet', 'weaver-xtreme'),
				__('Bullet used for Unordered Lists in Widget areas.', 'weaver-xtreme'),
				'weaverx_cz_choices_list_bullets',	'disc', 'postMessage'
			),




		),
	);


	/**
	 * Footer
	 */
	$style_sections['style-footer'] = array(
		'panel'   => $panel,
		'title'   => __( 'Footer Area', 'weaver-xtreme' ),
		'options' => array(
			'style-footer-heading' => weaverx_cz_group_title( __( 'Footer Borders', 'weaver-xtreme' )),

			'footer_border' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border to Footer Area', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),
			'footer_sb_border' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border to Footer Widget Area', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),
			'footer_html_border' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add border to Footer HTML Area', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			// SHADOW

			'style-footer-shadow-heading' => weaverx_cz_group_title( __( 'Footer Shadows', 'weaver-xtreme' )),

			'footer_shadow' => weaverx_cz_select(
				__( 'Add shadow to Footer Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),


			'footer_sb_shadow' => weaverx_cz_select(
				__( 'Add shadow to Footer Widget Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),

			'footer_html_shadow' => weaverx_cz_select(
				__( 'Add shadow to HTML Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_shadow',	'-0', 'postMessage'
			),


			// ROUNDED

			'style-footer-rounded-heading' => weaverx_cz_group_title( __( 'Footer Rounded Corners', 'weaver-xtreme' )),

			'footer_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to Footer Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),


			'footer_sb_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to Footer Widget Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),

			'footer_html_rounded' => weaverx_cz_select(
				__( 'Add rounded corners to Footer HTML Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_rounded',	'none', WEAVERX_ROUNDED_TRANSPORT
			),

		),
	);

	/**
	 * Filter the definitions for the controls in the Color Scheme panel of the Customizer.
	 *
	 * @since 1.3.0.
	 *
	 * @param array    $style_sections    The array of definitions.
	 */
	$style_sections = apply_filters( 'weaverx_customizer_style_sections', $style_sections );

	// Merge with master array
	return array_merge( $sections, $style_sections );


}
endif;

add_filter( 'weaverx_customizer_sections', 'weaverx_customizer_define_style_sections' );
