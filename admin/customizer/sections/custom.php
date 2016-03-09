<?php


if ( ! function_exists( 'weaverx_customizer_define_custom_sections' ) ) :
/**
 * Define the sections and settings for the Custom CSS panel
 */

function weaverx_customizer_define_custom_sections( $sections ) {
	$panel = 'weaverx_custom';
	$custom_sections = array();

	$custom_sections['custom-help'] = array(
		'panel'   => $panel,
		'title'   => __( 'Help for Custom CSS', 'weaver-xtreme' ),

		'options' => array(

			'custom-help-heading' => weaverx_cz_group_title( __( 'Introductory Help for Custom CSS', 'weaver-xtreme' ),
				__( 'These Custom CSS sections allow you to add custom CSS for different sections without needing to know the id or class for the section. You should simply enter normal CSS rules enclosed by braces <em>{selector:value;}</em>. You don not need to enter any id or class name. There are other helpful features to this custom CSS feature explained in the Help Documentation. See the link on the desktop <em>Appearance &rarr; Weaver Xtreme Admin &rarr; Theme Help</em> panel. Note that these Custom CSS rules are a very advanced feature of Weaver Xtreme, and most people will not need them. They do allow web designers to build highly customized sites.', 'weaver-xtreme' )),

		),
	);


	/**
	 * Global Site Custom CSS
	 */
	$custom_sections['custom-global'] = array(
		'panel'   => $panel,
		'title'   => __( 'Global Custom CSS', 'weaver-xtreme' ),
		'description' => "Set Custom CSS definitions that apply to entire site. Global Custom CSS is live updated, but won't display properly until you've completed a valid CSS rule.",
		'options' => array(

			'add_css'     => array(
				'setting' => array( 'sanitize_callback' => 'weaverx_cz_sanitize_css', 'transport' => 'postMessage',	'default' => ''
				),
				'control' => array(
					'control_type' => 'WeaverX_Textarea_Control',
					'label'   => __( 'Global Custom CSS', 'weaver-xtreme' ),
					'description'   => __( 'You can add arbitrary CSS rules here. These rules will come after other CSS stylesheets included for your site, and can be used to override default CSS rules, or to add new CSS rules for other plugins or content. Note that unlike the per-area Custom CSS rules found on other sections of this panel, the CSS rules you add here must be complete, including the class or id selector.', 'weaver-xtreme' ),
					'type'  => 'textarea',
					'input_attrs' => array(
						'rows' => '12',
						'placeholder' => __('.selector {font-size:150%;font-weight:bold;} /* for example */', 'weaver-xtreme'),
					),
				),
			),


		),
	);

	/**
	 * Wrapping
	 */
	$custom_sections['custom-wrapping'] = array(
		'panel'   => $panel,
		'title'   => __( 'Wrapping Areas', 'weaver-xtreme' ),
		'description' => "Set Custom CSS for the Wrapper and Container Areas.",
		'options' => array(

			'body_bgcolor_css'    	=> weaverx_cz_css(__( '&lt;body&gt; Custom CSS', 'weaver-xtreme' ),
										__( 'Custom CSS for the &lt;body&gt; tag.', 'weaver-xtreme' )),
			'wrapper_bgcolor_css'	=> weaverx_cz_css(__( 'Wrapper Custom CSS', 'weaver-xtreme' )),

			'wrapper_add_class' 	=> weaverx_cz_add_class(__( 'Wrapper: Add Classes', 'weaver-xtreme' )),

			'container_bgcolor_css' => weaverx_cz_css(__( 'Container Custom CSS', 'weaver-xtreme' )),

			'container_add_class'	=> weaverx_cz_add_class(__( 'Container: Add Classes', 'weaver-xtreme' )),

		),
	);

	/**
	 * Links
	 */
	$custom_sections['custom-links'] = array(
		'panel'   => $panel,
		'title'   => __( 'Links', 'weaver-xtreme' ),
		'description' => "Set Custom CSS for Links.",
		'options' => array(

			'link_color_css'     		=> weaverx_cz_css(__( 'Standard Links Custom CSS', 'weaver-xtreme' ),
											__( 'Custom CSS for standard Links.', 'weaver-xtreme' )),
			'link_hover_color_css'     => weaverx_cz_css(__( 'Standard Links Hover Custom CSS', 'weaver-xtreme' )),

			'ibarlink_color_css'		=> weaverx_cz_css(__( 'Info Bar Links Custom CSS', 'weaver-xtreme' ),
											__( 'Custom CSS for for links in Info Bar.', 'weaver-xtreme' )),
			'ibarlink_hover_color_css'	=> weaverx_cz_css(__( 'Info Bar Links Hover Custom CSS', 'weaver-xtreme' )),

			'contentlink_color_css'     => weaverx_cz_css(__( 'Content Links Custom CSS', 'weaver-xtreme' ),
											__( 'Custom CSS for for links in content area.', 'weaver-xtreme' )),
			'contentlink_hover_color_css'=> weaverx_cz_css(__( 'Content Links Hover Custom CSS', 'weaver-xtreme' )),

			'post_title_hover_color'    => weaverx_cz_css(__( 'Post Title Hover Custom CSS', 'weaver-xtreme' ),
											__( 'The Post Title is really a link.', 'weaver-xtreme' )),

			'ilink_color_css'    		=> weaverx_cz_css(__( 'Post Meta Info Line Links Custom CSS', 'weaver-xtreme' ),
											__( 'Custom CSS for for links in Post Meta Info Lines.', 'weaver-xtreme' )),
			'ilink_hover_color_css'     => weaverx_cz_css(__( 'Post Meta Info Line Links Hover Custom CSS', 'weaver-xtreme' )),

			'wlink_color_css'     		=> weaverx_cz_css(__( 'Individual Widget Links Custom CSS', 'weaver-xtreme' ),
											__( 'Custom CSS for for links in widgets.', 'weaver-xtreme' )),
			'wlink_hover_color_css'     => weaverx_cz_css(__( 'Individual Widget Links Hover Custom CSS', 'weaver-xtreme' )),

			'footerlink_color_css'		=> weaverx_cz_css(__( 'Footer Area Links Custom CSS', 'weaver-xtreme' ),
											__( 'Custom CSS for for links in Footer Area.', 'weaver-xtreme' )),
			'footerlink_hover_color_css'=> weaverx_cz_css(__( 'Footer Area Links Hover Custom CSS', 'weaver-xtreme' )),
		),
	);



	/**
	 * Site Header
	 */
	$custom_sections['custom-header'] = array(
		'panel'   => $panel,
		'title'   => __( 'Header Area', 'weaver-xtreme' ),
		'options' => array(

			'header_bgcolor_css'     	=> weaverx_cz_css(__( 'Header Area Custom CSS', 'weaver-xtreme' )),
			'header_add_class' 			=> weaverx_cz_add_class(__( 'Header Area: Add Classes', 'weaver-xtreme' )),

			'site_title_bgcolor_css'    => weaverx_cz_css(__( 'Site Title Custom CSS', 'weaver-xtreme' )),
			'site_title_add_class' 		=> weaverx_cz_add_class(__( 'Site Title: Add Classes', 'weaver-xtreme' )),

			'tagline_bgcolor_css'     	=> weaverx_cz_css(__( 'Site Tagline Custom CSS', 'weaver-xtreme' )),

			'title_tagline_bgcolor_css'	=> weaverx_cz_css(__( 'Site Title/Tagline Area Custom CSS', 'weaver-xtreme' )),

			'header_sb_bgcolor_css'     => weaverx_cz_css(__( 'Header Area Widget Area Custom CSS', 'weaver-xtreme' )),
			'header_sb_add_class' 		=> weaverx_cz_add_class(__( 'Header Widget Area: Add Classes', 'weaver-xtreme' )),

			'header_html_bgcolor_css'  	=> weaverx_cz_css(__( 'Header Area HTML Area Custom CSS', 'weaver-xtreme' )),
			'header_html_add_class' 	=> weaverx_cz_add_class(__( 'Header HTML Area: Add Classes', 'weaver-xtreme' )),

			'header_image_add_class' 	=> weaverx_cz_add_class(__( 'Header Image: Add Classes', 'weaver-xtreme' )),
		),
	);


	/**
	 * Main Menu
	 */
	$custom_sections['custom-menus'] = array(
		'panel'   => $panel,
		'title'   => __( 'Menus', 'weaver-xtreme' ),
		'description' => __( 'Set custom for Menus.', 'weaver-xtreme' ),
		'options' => array(
			'custom-mm-heading' => weaverx_cz_group_title(__( 'Primary Menu', 'weaver-xtreme' )),

			'm_primary_bgcolor_css'     => weaverx_cz_css(__( 'Primary Menu Bar Custom CSS', 'weaver-xtreme' )),

			'm_primary_add_class' 		=> weaverx_cz_add_class(__( 'Primary Menu Bar: Add Classes', 'weaver-xtreme' )),

			'm_primary_link_bgcolor_css'	=> weaverx_cz_css(__( 'Primary Menu Bar Link Custom CSS', 'weaver-xtreme' )),

			'm_primary_hover_bgcolor_css'	=> weaverx_cz_css(__( 'Primary Menu Bar Link Hover Custom CSS', 'weaver-xtreme' )),

			'm_primary_sub_bgcolor_css'     => weaverx_cz_css(__( 'Primary Sub-Menu Custom CSS', 'weaver-xtreme' )),

			'm_primary_sub_hover_bgcolor_css'     => weaverx_cz_css(__( 'Primary Sub-Menu Hover Custom CSS', 'weaver-xtreme' )),

			'custom-sm-line1' => weaverx_cz_line(),

			// --- secondary

			'custom-sm-heading' => weaverx_cz_group_title( __( 'Secondary Menu', 'weaver-xtreme' ),
				__('You must define a Secondary Menu from the Custom Menus Content menu.', 'weaver-xtreme')	),

			'm_secondary_bgcolor_css'     => weaverx_cz_css(__( 'Secondary Menu Bar Custom CSS', 'weaver-xtreme' )),

			'm_secondary_add_class' 	=> weaverx_cz_add_class(__( 'Secondary Menu Bar: Add Classes', 'weaver-xtreme' )),

			'm_secondary_link_bgcolor_css'     => weaverx_cz_css(__( 'Secondary Menu Bar Link Custom CSS', 'weaver-xtreme' )),

			'm_secondary_hover_bgcolor_css'     => weaverx_cz_css(__( 'Secondary Menu Bar Link Hover Custom CSS', 'weaver-xtreme' )),

			'm_secondary_sub_bgcolor_css'     => weaverx_cz_css(__( 'Secondary Sub-Menu Custom CSS', 'weaver-xtreme' )),

			'm_secondary_sub_hover_bgcolor_css'     => weaverx_cz_css(__( 'Secondary Sub-Menu Hover Custom CSS', 'weaver-xtreme' )),


			'custom-minim-line1' => weaverx_cz_line(),
			// mini-menu

			'custom-minim-heading' => weaverx_cz_group_title( __( 'Header Mini Menu', 'weaver-xtreme' ),
				__('You must define a Header Menu from the Custom Menus Content menu.', 'weaver-xtreme')),

			'm_header_mini_bgcolor_css'     => weaverx_cz_css(__( 'Header Mini Menu Custom CSS', 'weaver-xtreme' ),
				__('Custom CSS for full Mini Menu "bar".', 'weaver-xtreme')),
			'm_header_mini_hover_color_css'     => weaverx_cz_css(__( 'Mini Menu Links Hover Custom CSS', 'weaver-xtreme' ),
					__( 'Custom CSS for for link hover items in Mini Menu.', 'weaver-xtreme' )),




			'custom-allm-line1' => weaverx_cz_line(),

			'custom-allmenus-heading' => weaverx_cz_group_title( __( 'Custom For All Menus', 'weaver-xtreme' ),
				__('These options specify current page attributes for all menus.', 'weaver-xtreme')),

			'menubar_curpage_bgcolor_css'     => weaverx_cz_css(__( 'Current Page', 'weaver-xtreme' )),

		),
	);

	if (weaverx_cz_is_plus()) {
		$new_opts = array(

			'custom-xm-line1' => weaverx_cz_line(),

			'custom-xm-heading' => weaverx_cz_group_title( __( 'Extra Menu', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON ),

			'm_extra_bgcolor_css'     => weaverx_cz_css(__( 'Extra Menu Bar Custom CSS', 'weaver-xtreme' )),

			'm_extra_add_class' 	=> weaverx_cz_add_class(__( 'Extra Menu Bar: Add Classes', 'weaver-xtreme' )),

			'm_extra_link_bgcolor_css'     => weaverx_cz_css(__( 'Extra Menu Bar Link Custom CSS', 'weaver-xtreme' )),

			'm_extra_hover_bgcolor_css'     => weaverx_cz_css(__( 'Extra Menu Bar Link Hover Custom CSS', 'weaver-xtreme' )),

			'm_extra_sub_bgcolor_css'     => weaverx_cz_css(__( 'Extra Sub-Menu Custom CSS', 'weaver-xtreme' )),

			'm_extra_sub_hover_bgcolor_css'     => weaverx_cz_css(__( 'Extra Sub-Menu Hover Custom CSS', 'weaver-xtreme' )),

		);

	} else {
		$new_opts = weaverx_cz_add_plus_message('spacing_menus', __('Extra Menu', 'weaver-xtreme'),
			__('Add extra menus with <strong>Weaver Xtreme Plus</strong>.', 'weaver-xtreme'));
	}
	// add stub or extra menu options
	$custom_sections['custom-menus']['options'] = array_merge( $custom_sections['custom-menus']['options'],  $new_opts);


	/**
	 * Info Bar
	 */
	$custom_sections['custom-info-bar'] = array(
		'panel'   => $panel,
		'title'   => __( 'Info Bar', 'weaver-xtreme' ),
		'description' => __('Info Bar with breadcrumbs and paged navigation displayed under Primary Menu.', 'weaver-xtreme'),
		'options' => array(
			'custom-info-bar-heading' => weaverx_cz_heading( __( 'Info Bar', 'weaver-xtreme' )),

			'infobar_bgcolor_css'	=> weaverx_cz_css(__( 'Info Bar Custom CSS', 'weaver-xtreme' )),

			'infobar_bgcolor_css' 	=> weaverx_cz_css(__( 'Info Bar Custom CSS', 'weaver-xtreme' )),

			'infobar_add_class'		=> weaverx_cz_add_class(__( 'Info Bar: Add Classes', 'weaver-xtreme' )),
		)
	);

	/**
	 * Content
	 */
	$custom_sections['custom-content'] = array(
		'panel'   => $panel,
		'title'   => __( 'Content', 'weaver-xtreme' ),
		'description' => __('custom for general page and post content.', 'weaver-xtreme'),
		'options' => array(
		'custom-content-heading' => weaverx_cz_heading( __( 'General Content', 'weaver-xtreme' )),

		'content_bgcolor_css'     	=> weaverx_cz_css(__( 'Content Custom CSS', 'weaver-xtreme' )),

		'content_add_class' 		=> weaverx_cz_add_class(__( 'Content: Add Classes', 'weaver-xtreme' )),

		'page_title_bgcolor_css'    => weaverx_cz_css(__( 'Page Title Custom CSS', 'weaver-xtreme' )),

		'archive_title_bgcolor_css'	=> weaverx_cz_css(__( 'Archive Page Title Custom CSS', 'weaver-xtreme' )),

		'content_h_bgcolor_css'     => weaverx_cz_css(__( 'Content H headings Custom CSS', 'weaver-xtreme' )),

		'editor_bgcolor_css'     	=> weaverx_cz_css(__( 'Tiny MCE Editor Background color', 'weaver-xtreme' )),	// really a no-op...

		'search_bgcolor_css'     	=> weaverx_cz_css(__( 'Search Box Custom CSS', 'weaver-xtreme' )),

		'hr_color_css'     			=> weaverx_cz_css(__( '&lt;HR&gt; Custom CSS', 'weaver-xtreme' )),

		'comment_headings_color_css' => weaverx_cz_css(__( 'Comment Headings Custom CSS', 'weaver-xtreme' )),

		'comment_content_bgcolor_css' => weaverx_cz_css(__( 'Comment Content Custom CSS', 'weaver-xtreme' )),

		'comment_submit_bgcolor_css' => weaverx_cz_css(__( 'Comment Submit Button Custom CSS', 'weaver-xtreme' )),

		'content-image-css'			=> weaverx_cz_heading( __('Images', 'weaver-xtreme'),
				__('Custom CSS for Images is found on "Images : Global Image Settings".', 'weaver-xtreme')),

		),
	);

	/**
	 * Post Specific
	 */
	$custom_sections['custom-post-specific'] = array(
		'panel'   => $panel,
		'title'   => __( 'Post Specific', 'weaver-xtreme' ),
		'description' => __('Post Specific custom - override Content custom.', 'weaver-xtreme'),
		'options' => array(

		'custom-postspecific-heading' => weaverx_cz_heading( __( 'Post Specific', 'weaver-xtreme' )),

		'post_bgcolor_css'     		=> weaverx_cz_css(__( 'Post Area Custom CSS', 'weaver-xtreme' )),

		'post_add_class' 			=> weaverx_cz_add_class(__( 'Post Area: Add Classes', 'weaver-xtreme' )),

		'stickypost_bgcolor_css'  	=> weaverx_cz_css(__( 'Sticky Posts Custom CSS', 'weaver-xtreme' )),

		'post_title_bgcolor_css'  	=> weaverx_cz_css(__( 'Post Title BG Custom CSS', 'weaver-xtreme' )),

		'post_title_color_css'  	=> weaverx_cz_css(__( 'Post Title Text Custom CSS', 'weaver-xtreme' ),
										__('Remember the Post Title is a link. The Hover Custom CSS found on Links menu.', 'weaver-xtreme')),

		'post_info_top_bgcolor_css'	=> weaverx_cz_css(__( 'Posts Top Meta Info Line Custom CSS', 'weaver-xtreme' )),

		'post_info_bottom_bgcolor_css' => weaverx_cz_css(__( 'Posts Bottom Meta Info Line Custom CSS', 'weaver-xtreme' )),

		'post_author_bgcolor_css' 	=> weaverx_cz_css(__( 'Author Bio Custom CSS', 'weaver-xtreme' )),

		),
	);


	/**
	 * Sidebars
	 */
	$custom_sections['custom-sidebars'] = array(
		'panel'   => $panel,
		'title'   => __( 'Sidebars &amp; Widget Areas', 'weaver-xtreme' ),
		'description' => __('Main Sidebars and Widget areas. Header and Footer areas options under Header and Footer panels.', 'weaver-xtreme'),
		'options' => array(

			'custom-primary-widget-heading' => weaverx_cz_group_title( __( 'Primary Widget Area', 'weaver-xtreme' )),

			'primary_bgcolor_css'	=> weaverx_cz_css(__( 'Primary Widget Area Custom CSS', 'weaver-xtreme' )),

			'primary_add_class' 	=> weaverx_cz_add_class(__( 'Primary Widget Area: Add Classes', 'weaver-xtreme' )),


			'custom-secondary-widget-heading' => weaverx_cz_group_title( __( 'Secondary Widget Area', 'weaver-xtreme' )),

			'secondary_bgcolor_css'	=> weaverx_cz_css(__( 'Secondary Widget Area Custom CSS', 'weaver-xtreme' )),

			'secondary_add_class' 	=> weaverx_cz_add_class(__( 'Secondary Widget Area: Add Classes', 'weaver-xtreme' )),


			'custom-top-widget-heading' => weaverx_cz_group_title( __( 'Top Widget Areas', 'weaver-xtreme' ),
				__('Properties for all Top Widget areas (Sitewide, Pages, Blog, Archive).', 'weaver-xtreme')),

			'top_bgcolor_css' 	=> weaverx_cz_css(__( 'Top Widget Areas Custom CSS', 'weaver-xtreme' )),

			'top_add_class' 	=> weaverx_cz_add_class(__( 'Top Widget Areas: Add Classes', 'weaver-xtreme' )),


			'custom-bottom-widget-heading' => weaverx_cz_group_title( __( 'Bottom Widget Areas', 'weaver-xtreme' ),
				__('Properties for all Bottom Widget areas (Sitewide, Pages, Blog, Archive).', 'weaver-xtreme') ),

			'bottom_bgcolor_css'	=> weaverx_cz_css(__( 'Bottom Widget Areas Custom CSS', 'weaver-xtreme' )),

			'bottom_add_class' 		=> weaverx_cz_add_class(__( 'Bottom Widget Areas: Add Classes', 'weaver-xtreme' )),
		),
	);

	/**
	 * Widgets
	 */
	$custom_sections['custom-widgets'] = array(
		'panel'   => $panel,
		'title'   => __( 'Individual Widgets', 'weaver-xtreme' ),
		'options' => array(
		'custom-widgets-heading' => weaverx_cz_heading( __( 'Individual Widgets', 'weaver-xtreme' )),

		'widget_bgcolor_css'   		=> weaverx_cz_css(__( 'Individual Widget Custom CSS', 'weaver-xtreme' )),

		'widget_add_class' 			=> weaverx_cz_add_class(__( 'Individual Widget: Add Classes', 'weaver-xtreme' )),

		'widget_title_bgcolor_css'	=> weaverx_cz_css(__( 'Individual Widget Title Custom CSS', 'weaver-xtreme' )),


		),
	);


	/**
	 * Footer
	 */
	$custom_sections['custom-footer'] = array(
		'panel'   => $panel,
		'title'   => __( 'Footer Area', 'weaver-xtreme' ),
		'options' => array(

			'footer_bgcolor_css'   	=> weaverx_cz_css(__( 'Footer Area Custom CSS', 'weaver-xtreme' )),

			'footer_add_class' 		=> weaverx_cz_add_class(__( 'Footer Area: Add Classes', 'weaver-xtreme' )),

			'footer_sb_bgcolor_css'	=> weaverx_cz_css(__( 'Footer Area Widget Area Custom CSS', 'weaver-xtreme' )),

			'footer_sb_add_class' 	=> weaverx_cz_add_class(__( 'Footer Widget Area: Add Classes', 'weaver-xtreme' )),

			'footer_html_bgcolor_css' => weaverx_cz_css(__( 'Footer Area HTML Area Custom CSS', 'weaver-xtreme' )),

			'footer_html_class' 	=> weaverx_cz_add_class(__( 'Footer HTML Area: Add Classes', 'weaver-xtreme' )),

		),
	);


	/**
	 * Filter the definitions for the controls in the Color Scheme panel of the Customizer.
	 *
	 * @since 1.3.0.
	 *
	 * @param array    $custom_sections    The array of definitions.
	 */
	$custom_sections = apply_filters( 'weaverx_customizer_custom_sections', $custom_sections );

	// Merge with master array
	return array_merge( $sections, $custom_sections );


}
endif;


add_filter( 'weaverx_customizer_sections', 'weaverx_customizer_define_custom_sections' );
