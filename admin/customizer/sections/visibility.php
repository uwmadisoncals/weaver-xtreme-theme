<?php

if ( ! function_exists( 'weaverx_customizer_define_visibility_sections' ) ) :
/**
 * Define the sections and settings for the Visibility panel
 */

function weaverx_customizer_define_visibility_sections( $sections ) {
	$panel = 'weaverx_visibility';
	$visibility_sections = array();

	/**
	 * General
	 */
	$visibility_sections['visibility-global-vis'] = array(
		'panel'   => $panel,
		'title'   => __( 'Global Visibility', 'weaver-xtreme' ),
		'description' => 'Set global visibility attributes.',
		'options' => array(

			'hide_tooltip' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'refresh'
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_CHECKBOX_CONTROL,
					'label' => __( 'Hide Menu/Link Tool Tips', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __( 'Hide the tool tip pop up over all menus and links.)', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),



		),
	);


	/**
	 * Site Header
	 */
	$visibility_sections['visibility-header'] = array(
		'panel'   => $panel,
		'title'   => __( 'Header Area', 'weaver-xtreme' ),
		'options' => array(
		// Hide Site Title option

			'header_hide' => weaverx_cz_select(
				__( 'Hide Header Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'hide_site_title' => weaverx_cz_select(
				__( 'Hide Site Title', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'hide_site_tagline' => weaverx_cz_select(
				__( 'Hide Tagline', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'hide_header_image' => weaverx_cz_select(
				__( 'Hide Header Image', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'hide_header_image_front' => weaverx_cz_checkbox_refresh(
				__( 'Hide Header Image on Front Page', 'weaver-xtreme' )
			),

			'header_sb_hide' => weaverx_cz_select(
				__( 'Hide Header Widget Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),
			'header_html_hide' => weaverx_cz_select(
				__( 'Hide Header HTML Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),
			'header_search_hide' => weaverx_cz_select(
				__( 'Hide Search box on Header', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),



		),
	);

	/**
	 * Main Menu
	 */
	$visibility_sections['visibility-menus'] = array(
		'panel'   => $panel,
		'title'   => __( 'Menus', 'weaver-xtreme' ),
		'description' => __( 'Set visibility for Menus.', 'weaver-xtreme' ),
		'options' => array(

			'visibility-mm-heading' => weaverx_cz_group_title(
				__( 'Primary Menu', 'weaver-xtreme' )
			),

			'm_primary_hide' => weaverx_cz_select(
				__( 'Hide Primary Menu', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),


			'm_primary_hide_arrows' => weaverx_cz_checkbox_refresh(
				__( 'Hide Primary Menu Arrows', 'weaver-xtreme' ),
				''
			),

			'm_primary_hide_left' => weaverx_cz_select_plus(
				__( 'Hide Primary Menu Left HTML', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'm_primary_hide_right' => weaverx_cz_select_plus(
				__( 'Hide Primary Menu Right HTML', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'menu_nohome' => weaverx_cz_checkbox_refresh(
				__( 'No Home Menu Item', 'weaver-xtreme' ),
				__( "Don't automatically add Home menu item for home page (as defined in Settings->Reading)", 'weaver-xtreme' )
			),

			'visibility-pm-line1' => weaverx_cz_line(),


			'visibility-sm-heading' => weaverx_cz_group_title(
				__( 'Secondary Menu', 'weaver-xtreme' )
			),

			'm_secondary_hide' => weaverx_cz_select(
				__( 'Hide Secondary Menu', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),


			'm_secondary_hide_arrows' => weaverx_cz_checkbox_refresh(
				__( 'Hide Secondary Menu Arrows', 'weaver-xtreme' )
			),

			'm_secondary_hide_left' => weaverx_cz_select_plus(
				__( 'Hide Secondary Menu Left HTML', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'm_secondary_hide_right' => weaverx_cz_select_plus(
				__( 'Hide Secondary Menu Right HTML', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'viz-pm-line2' => weaverx_cz_line(),

			'visibility-minim-heading' => weaverx_cz_group_title( __( 'Header Mini Menu', 'weaver-xtreme' ),
				__('You must define a Header Menu from the Custom Menus Content menu.', 'weaver-xtreme')),

			'm_header_mini_hide' => weaverx_cz_select(
				__( 'Hide Header Mini Menu', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),


		),
	);

	if (weaverx_cz_is_plus()) {
		$new_opts = array(

			'spacing-xm-line1' => weaverx_cz_line(),

			'visibility-xm-heading' => weaverx_cz_group_title(
				__( 'Extra Menu', 'weaver-xtreme' )
			),

			'm_extra_hide' => weaverx_cz_select(
				__( 'Hide Extra Menu', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),


			'm_extra_hide_arrows' => weaverx_cz_checkbox_refresh(
				__( 'Hide Extra Menu Arrows', 'weaver-xtreme' )
			),

			'm_extra_hide_left' => weaverx_cz_select_plus(
				__( 'Hide Extra Menu Left HTML', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'm_extra_hide_right' => weaverx_cz_select_plus(
				__( 'Hide Extra Menu Right HTML', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),
		);

	} else {
		$new_opts = weaverx_cz_add_plus_message('spacing_menus', __('Extra Menu', 'weaver-xtreme'),
			__('Add extra menus with <strong>Weaver Xtreme Plus</strong>.', 'weaver-xtreme'));
	}
	// add stub or extra menu options
	$visibility_sections['visibility-menus']['options'] = array_merge( $visibility_sections['visibility-menus']['options'],  $new_opts);


	/**
	 * Info Bar
	 */
	$visibility_sections['visibility-info-bar'] = array(
		'panel'   => $panel,
		'title'   => __( 'Info Bar', 'weaver-xtreme' ),
		'description' => __('Info Bar with breadcrumbs and paged navigation displayed under Primary Menu.', 'weaver-xtreme'),
		'options' => array(

			'infobar_hide' => weaverx_cz_select(
				__( 'Hide Info Bar', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'info_hide_breadcrumbs' => weaverx_cz_checkbox_refresh(
				__( 'Hide Breadcrumbs', 'weaver-xtreme' ),
				__( 'Do not display the Breadcrumbs on the Infobar', 'weaver-xtreme' )
			),


			'info_hide_pagenav' => weaverx_cz_checkbox_refresh(
				__( 'Hide Page Navigation', 'weaver-xtreme' ),
				__( 'Do not display the numbered Page navigation on the Infobar', 'weaver-xtreme' )
			),


			'info_search' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
				),
				'control' => array(
					'label' => __( 'Show Search Box', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __( 'Include a Search box on the right.', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'type'  => 'checkbox',
				),
			),

			'info_addlogin' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
				),
				'control' => array(
					'label' => __( 'Show Log In', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __( 'Include a simple Log In link on the right.', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'type'  => 'checkbox',
				),
			),

			'info_home_label' =>  weaverx_cz_textarea(__( 'Breadcrumb for Home', 'weaver-xtreme' ),
				__( 'This lets you change the breadcrumb label for your home page. (Default: Home)', 'weaver-xtreme' ),
				'1', '',
				'refresh', false),



		),
	);

	/**
	 * Content
	 */
	$visibility_sections['visibility-content'] = array(
		'panel'   => $panel,
		'title'   => __( 'Content', 'weaver-xtreme' ),
		'description' => __('visibility for general page and post content.', 'weaver-xtreme'),
		'options' => array(
			'visibility-content-comments-heading' => weaverx_cz_group_title( __( 'Comments', 'weaver-xtreme' ),
				__('Visibility settings for Comments area.', 'weaver-xtreme')),


			'hide_old_comments' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'refresh'
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_CHECKBOX_CONTROL,
					'label' => __( 'Hide Old Comments When Closed', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __( 'Hide previous comments after closing comments for page or post. (Default: show old comments after closing.)', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),
			'form_allowed_tags' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'refresh'
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_CHECKBOX_CONTROL,
					'label' => __( 'Show Allowed HTML', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __( 'Show the allowed HTML tags below comment input box.', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),
			'hide_comment_bubble' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'refresh'
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_CHECKBOX_CONTROL,
					'label' => __( 'Hide Comment Title Icon', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __( 'Hide the comment icon (bubble) before the Comments title.', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'hide_comment_hr' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'refresh'
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_CHECKBOX_CONTROL,
					'label' => __( 'Hide Separator Above Comments', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __( 'Hide the (&lt;hr&gt;) separator line above the Comments area.', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'visibility-content-comments-note' => weaverx_cz_heading( __( 'Hiding/Enabling Page and Post Comments', 'weaver-xtreme' ),
				__('Controlling "Reply/Leave a Comment" visibility for pages and posts is <strong>not</strong> a theme function. It is controlled by WordPress on the <em>Settings &rarr; Discussion</em> menu.', 'weaver-xtreme')),

		),
	);

	/**
	 * Post Specific
	 */
	$visibility_sections['visibility-post-specific'] = array(
		'panel'   => $panel,
		'title'   => __( 'Post Specific', 'weaver-xtreme' ),
		'description' => __('Post Specific visibility - override Content visibility.', 'weaver-xtreme'),
		'options' => array(



			'visibility-posts-metax-heading' => weaverx_cz_group_title( __( 'Post Meta Info Lines', 'weaver-xtreme' )),

			'post_info_hide_top' => weaverx_cz_checkbox_refresh(
				__( 'Hide top post meta info line', 'weaver-xtreme' ),
				__( 'Hide entire top info line (posted on, by) of post.', 'weaver-xtreme' )
			),


			'post_info_hide_bottom' => weaverx_cz_checkbox_refresh(
				__( 'Hide bottom post meta info line', 'weaver-xtreme' ),
				__( 'Hide entire bottom info line (posted in, comments) of post.', 'weaver-xtreme' )
			),


			'show_post_bubble' => weaverx_cz_checkbox_refresh(
				__( 'Show Comment Bubble', 'weaver-xtreme' ) ,
				__( 'Show comment bubble with link to comments on the post info line.', 'weaver-xtreme' )
			),


			'show_post_avatar' => weaverx_cz_select(
				__( 'Show Author Avatar', 'weaver-xtreme' ),
				__( 'Show author avatar on the post info line (also can be set per post with post editor).', 'weaver-xtreme' ),
				'weaverx_cz_choices_hide',	'hide', 'refresh'
			),



			'visibility-posts-note-meta-heading' => weaverx_cz_heading( __( 'NOTE:', 'weaver-xtreme' ),
				__( 'Hiding any meta info item will force using Icons instead of text descriptions.', 'weaver-xtreme' )),

			'post_hide_date' => weaverx_cz_checkbox_refresh(
				__( 'Hide Post Date', 'weaver-xtreme' )
			),


			'post_hide_author' => weaverx_cz_checkbox_refresh(
				__( 'Hide Post Author', 'weaver-xtreme' )
			),


			'post_hide_categories' => weaverx_cz_checkbox_refresh(
				__( 'Hide Post Categories', 'weaver-xtreme' )
			),


			'post_hide_tags' => weaverx_cz_checkbox_refresh(
				__( 'Hide Post Tags', 'weaver-xtreme' )
			),


			'hide_permalink' => weaverx_cz_checkbox_refresh(
				__( 'Hide Permalink', 'weaver-xtreme' )
			),

			'hide_singleton_category' => weaverx_cz_checkbox_refresh(
				__( 'Hide Category if Only One', 'weaver-xtreme' ),
				__( "If there is only one overall category defined (Uncategorized), don't show Category of post.", 'weaver-xtreme' )
			),


			'post_hide_single_author' => weaverx_cz_checkbox_refresh(
				__( 'Hide Author for Single Author Site', 'weaver-xtreme' ),
				__( "Hide author information if site has only a single author.", 'weaver-xtreme' )
			),


			'visibility-posts-nav-heading' => weaverx_cz_group_title( __( 'Post Navigation', 'weaver-xtreme' )),

			'visibility-posts-misc-heading' => weaverx_cz_group_title( __( 'Other Post Visibility Options', 'weaver-xtreme' )),

			'hide_post_format_icon' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_CHECKBOX_CONTROL,
					'label' => __( 'Hide Post Format Icons', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description' => __( 'Hide the icons for posts with Post Format specified.', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'show_comments_closed' => weaverx_cz_checkbox_refresh(
				__( 'Show "Comments are closed"', 'weaver-xtreme' ),
				__( 'If comments are off, and no comments have been made, show the <em>Comments are closed.</em> message.', 'weaver-xtreme' )
			),


			'hide_author_bio' => weaverx_cz_checkbox_refresh(
				__( 'Hide Author Bio', 'weaver-xtreme' ),
				__( 'Hide display of author bio box on Author Archive and Single Post page views.', 'weaver-xtreme' )
			),


		),
	);


	/**
	 * Sidebars
	 */
	$visibility_sections['visibility-sidebars'] = array(
		'panel'   => $panel,
		'title'   => __( 'Sidebars &amp; Widget Areas', 'weaver-xtreme' ),
		'description' => __('Main Sidebars and Widget areas. Header and Footer areas options under Header and Footer panels.', 'weaver-xtreme'),
		'options' => array(
			'visibility-primary-widget-heading' => weaverx_cz_group_title( __( 'Primary Widget Area', 'weaver-xtreme' )),

			'primary_hide' => weaverx_cz_select(
				__( 'Hide Primary Widget Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),




			'visibility-secondary-widget-heading' => weaverx_cz_group_title( __( 'Secondary Widget Area', 'weaver-xtreme' )),

			'secondary_hide' => weaverx_cz_select(
				__( 'Hide Secondary Widget Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),


			'visibility-top-widget-heading' => weaverx_cz_group_title( __( 'Top Widget Areas', 'weaver-xtreme' ),
				__('Properties for all Top Widget areas (Sitewide, Pages, Blog, Archive).', 'weaver-xtreme')),

			'top_hide' => weaverx_cz_select(
				__( 'Hide Top Widget Areas', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),




			'visibility-bottom-widget-heading' => weaverx_cz_group_title( __( 'Bottom Widget Areas', 'weaver-xtreme' ),
				__('Properties for all Bottom Widget areas (Sitewide, Pages, Blog, Archive).', 'weaver-xtreme')),

			'bottom_hide' => weaverx_cz_select(
				__( 'Hide Bottom Widget Areas', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

		),

	);


	/**
	 * Widgets
	 */
	$visibility_sections['visibility-widgets'] = array(
		'panel'   => $panel,
		'title'   => __( 'Individual Widgets', 'weaver-xtreme' ),
		'options' => array(

		),
	);


	/**
	 * Footer
	 */
	$visibility_sections['visibility-footer'] = array(
		'panel'   => $panel,
		'title'   => __( 'Footer Area', 'weaver-xtreme' ),
		'options' => array(

			'footer_hide' => weaverx_cz_select(
				__( 'Hide Footer Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),
			'footer_sb_hide' => weaverx_cz_select(
				__( 'Hide Footer Widget Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),
			'footer_html_hide' => weaverx_cz_select(
				__( 'Hide Footer HTML Area', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),


			'_hide_poweredby' => weaverx_cz_checkbox_refresh(
				__( 'Hide Powered By tag', 'weaver-xtreme' ),
				__( 'Hide the "Proudly powered by" notice in the footer. &diams;', 'weaver-xtreme' )
			),



		),
	);

	/**
	 * Filter the definitions for the controls in the Color Scheme panel of the Customizer.
	 *
	 * @since 1.3.0.
	 *
	 * @param array    $visibility_sections    The array of definitions.
	 */
	$visibility_sections = apply_filters( 'weaverx_customizer_visibility_sections', $visibility_sections );

	// Merge with master array
	return array_merge( $sections, $visibility_sections );


}
endif;

add_filter( 'weaverx_customizer_sections', 'weaverx_customizer_define_visibility_sections' );
