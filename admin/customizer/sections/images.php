<?php

if ( ! function_exists( 'weaverx_customizer_define_image_sections' ) ) :
/**
 * Define the sections and settings for the Images panel
 */
function weaverx_customizer_define_image_sections( $sections ) {
	global $wp_customize;

	$panel = 'weaverx_images';
	$image_sections = array();


	$wp_customize->get_section('header_image')->priority   		= 20000;
	$wp_customize->get_section('header_image')->title    		= __('Header Banner Images (WP Settings)', 'weaver-xtreme');
	$wp_customize->get_section('header_image')->panel   		= $panel;

	$wp_customize->get_section('background_image')->priority   	= 20100;
	$wp_customize->get_section('background_image')->title    	= __('Site BG Image (WP Settings)', 'weaver-xtreme');
	$wp_customize->get_section('background_image')->panel   	= $panel;
	/**
	 * General
	 */
	$image_sections['images-global'] = array(
		'panel'   => $panel,
		'title'   => __( 'Global Image Settings', 'weaver-xtreme' ),
		'description' => 'Set Image options for Site Wrapper &amp; Container. Use Colors to set colors.',
		'options' => array(
			'images-heading-global' => weaverx_cz_group_title( __( 'Global Image Settings', 'weaver-xtreme' ),
				__( 'These settings control images in both the Container (including content and sidebars) and Footer Areas. They do not include the Header Area.', 'weaver-xtreme' )),

			'media_lib_border_color' => weaverx_cz_coloropt(
				'media_lib_border_color',
				__('Image Border Color', 'weaver-xtreme'),
				__('Border color for images in Container and Footer.', 'weaver-xtreme')
			),


			'media_lib_border_int'     => array(
				'setting' => array(	'sanitize_callback' => 'absint', 'transport' => 'postMessage', 'default' => 0	),
				'control' => array(
					'control_type' => 'WeaverX_Range_Control',
					'label'   => __( 'Image Border Width (px)', 'weaver-xtreme' ),
					'description' => __( 'Border width for images in Container and Footer. There will be <strong>no</strong> borders unless you set this value above 0px.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  =>  50,
						'step' => 1,
					),
				),
			),

			'show_img_shadows'=> array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage'
				),
				'control' => array(
					'label' => __( 'Add Image Shadow', 'weaver-xtreme' ),
					'description' => __( 'Add a shadow to images in Container and Footer. Add custom CSS for custom shadow.', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'restrict_img_border'=> array(
				'setting' => array(
					'sanitize_callback' => 'absint',
					'transport' => 'refresh'
				),
				'control' => array(
					'label' => __( 'Restrict Borders to Media Library', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __( 'For Container and Footer, restrict border and shadows to images from Media Library. Manually entered &lt;img&gt; HTML without Media Library classes will not have borders.', 'weaver-xtreme' ),
					'type'  => 'checkbox',
				),
			),

			'media_lib_border_color_css'     => weaverx_cz_css(__( 'Custom CSS for Images.', 'weaver-xtreme' ),
					__('Note: this custom CSS will live-update for ALL images, even if the above Restrict Borders is checked.
The normal site view will respect the Restrict Borders setting.','weaver-xtreme')),


			'caption_color' => weaverx_cz_coloropt(
				'caption_color',
				__('Caption Text Color', 'weaver-xtreme'),
				__('Color of captions - e.g., below media images.', 'weaver-xtreme')
			),


			'caption_color_css'  =>   weaverx_cz_css(__( 'Custom CSS for Captions.', 'weaver-xtreme' )),


		),
	);


	/**
	 * Site Header
	 */
	$image_sections['images-header'] = array(
		'panel'   => $panel,
		'title'   => __( 'Header Area', 'weaver-xtreme' ),
		'options' => array(
		'images-heading-header' => weaverx_cz_heading( __( 'Site Header', 'weaver-xtreme' )),

		'header_image_max_width_dec'     => array(
				'setting' => array(	'sanitize_callback' => 'absint', 'transport' => 'postMessage', 'default' => 100.0	),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Maximum Image Width (%)', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON,
					'description' => __( 'Maximum width of Header Image. Can be useful to change Header Image alignment.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => .5,
					),
				),
			),

		'header_actual_size' => weaverx_cz_checkbox( __( 'Use Actual Image Size', 'weaver-xtreme' ),
			__( 'Check to use actual header image size. (Default: theme width)', 'weaver-xtreme' ), 'plus'),

		'header_image_align' => weaverx_cz_select_plus(
				__( 'Align Header Image', 'weaver-xtreme' ),
				__( 'How to align header image - meaningful only when Max Width or Actual Size set.', 'weaver-xtreme' ),
				'weaverx_cz_choices_align',	'float-left', 'postMessage'
			),


		'link_site_image' => weaverx_cz_checkbox_refresh( __( 'Header Image Links to Site', 'weaver-xtreme' ),
			__( 'Check to add a link to site home page for Header Image. Note: If used with <em>Move Title/Tagline over Image</em>, parts of the header image will not be clickable.', 'weaver-xtreme')),

		'header_image_height_int'     => array(
				'setting' => array(	'sanitize_callback' => 'absint', 'transport' => 'refresh', 'default' => 188	),
				'control' => array(
					'control_type' => 'WeaverX_Range_Control',
					'label'   => __( 'Suggested Header Image Height (px)', 'weaver-xtreme' ) . WEAVERX_REFRESH_ICON,
					'description' => __( 'Change the suggested height of the Header Image. Standard size is 188. This height is only a suggestion, and only affects the clipping window on the Customizer <em>Images &rarr; Header Banner Images<em> panel after you refresh the whole Customize interface. Header images will always be responsively sized. (Default header image width: theme width)', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 10,
						'max'  => 600,
						'step' => 1,
					),
				),
			),

		'images-heading-srch' => weaverx_cz_heading(
				__( 'Search Box Icon', 'weaver-xtreme' ),
				__( 'The icon used in search boxes can be changed in the <em>Colors &rarr; Content</em> section.', 'weaver-xtreme' )
			),

		'images-heading-altimg' => weaverx_cz_heading(
				__( 'Alternate Header Images', 'weaver-xtreme' ),
				__( 'You can specify alternate header images using the <em>Featured Image Location</em> option on the <em>Images</em> panel, as well as Per Page and Per Post options.', 'weaver-xtreme' )
			),

			'images-heading-logo-html' => weaverx_cz_heading( __( 'Site Logo/HTML', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON,
				__( 'The site Logo/HTML is being deprecated. It is still accessible from the traditional Appearance settings interface.', 'weaver-xtreme' )),
		),
	);


	/**
	 * Content
	 */
	$image_sections['images-content'] = array(
		'panel'   => $panel,
		'title'   => __( 'Content', 'weaver-xtreme' ),
		'description' => __('Images on page and post content.', 'weaver-xtreme'),
		'options' => array(

			'images-content-heading' => weaverx_cz_heading( __( 'General Image Settings', 'weaver-xtreme' ),
				__( 'General image settings found on the <em>Global Image Settings</em> panel.', 'weaver-xtreme' )),

			'images-content-FI' => weaverx_cz_group_title( __( 'Featured Image - Pages', 'weaver-xtreme' ),
					__( 'Display of Page Featured Images', 'weaver-xtreme' )),

			'page_fi_location' => weaverx_cz_select(
				__( 'Featured Image Location', 'weaver-xtreme' ),
				__( 'Where to display Featured Image for Pages', 'weaver-xtreme' ),
				'weaverx_cz_choices_fi_location',	'content-top', 'refresh'
			),

			'page_fi_align' => weaverx_cz_select(
				__( 'Align Featured Image', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_fi_align',	'fi-alignleft', 'refresh'
			),

			'page_fi_hide' => weaverx_cz_select(
				__( 'Hide Featured Image', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),


			'page_fi_size' => weaverx_cz_select(
				__( 'Page Featured Image Size', 'weaver-xtreme' ),
				__( 'Media Library Image Size for Featured Image on pages. (Header uses full size).', 'weaver-xtreme' ),
				'weaverx_cz_choices_fi_size',	'thumbnail', 'refresh'
			),

			'page_fi_width'     => array(
				'setting' => array(	'sanitize_callback' => 'absint', 'transport' => 'refresh', 'default' => 0	),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Featured Image Width (%)', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON,
					'description' => __( 'Width of Featured Image on Pages. Max Width in %, overrides FI Size selection. Set to 0 to avoid overriding above Featured Image Size setting.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  =>  100,
						'step' => 0.5,
					),
				),
			),
		),
	);

	/**
	 * Post Specific
	 */
	$image_sections['images-post-specific'] = array(
		'panel'   => $panel,
		'title'   => __( 'Post Specific', 'weaver-xtreme' ),
		'description' => __('Post Specific Images - override Content Images.', 'weaver-xtreme'),
		'options' => array(
			'images-postspecific-heading' => weaverx_cz_heading( __( 'General Image Settings', 'weaver-xtreme' ),
				__( 'General image settings found on the <em>Site Wrapper &amp; Container</em> panel.', 'weaver-xtreme' )),


			'post_avatar_int'     => array(
				'setting' => array(	'sanitize_callback' => 'absint', 'transport' => 'postMessage', 'default' => 28	),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Author Avatar Size (px)', 'weaver-xtreme' ),
					'description' => __( 'Size of Author Avatar in px - only for Post Info line. (Default: 28px)', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 10,
						'max'  => 60,
						'step' => 1,
					),
				),
			),

			'images-content-FI-full' => weaverx_cz_group_title( __( 'Featured Image - Full Blog Posts', 'weaver-xtreme' ),
				__( 'Display of Post Featured Images when Post is displayed as a Full Post.', 'weaver-xtreme' )),

			'post_full_fi_location' => weaverx_cz_select(
				__( 'Featured Image Location - Full Post', 'weaver-xtreme' ),
				__( 'Where to display Featured Image.', 'weaver-xtreme' ),
				'weaverx_cz_choices_fi_location',	'content-top', 'refresh'
			),

			'post_full_fi_align' => weaverx_cz_select(
				__( 'Align Featured Image - Full Post', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_fi_align',	'fi-alignleft', 'refresh'
			),

			'post_full_fi_hide' => weaverx_cz_select(
				__( 'Hide Featured Image - Full Post', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'post_full_fi_size' => weaverx_cz_select(
				__( 'Page Featured Image Size - Full Post', 'weaver-xtreme' ),
				__( 'Media Library Image Size for Featured Image. (Header uses full size).', 'weaver-xtreme' ),
				'weaverx_cz_choices_fi_size',	'thumbnail', 'refresh'
			),



			'post_full_fi_width'     => array(
				'setting' => array(	'sanitize_callback' => 'absint', 'transport' => 'refresh', 'default' => 0	),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Featured Image Width (%) - Full Post', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON,
					'description' => __( 'Width of Featured Image. Max Width in %, overrides FI Size selection. Set to 0 to avoid overriding above Featured Image Size setting.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  =>  100,
						'step' => 0.5,
					),
				),
			),


			'images-content-FI-excerpt' => weaverx_cz_group_title( __( 'Featured Image - Excerpt Posts', 'weaver-xtreme' ),
				__( 'Display of Post Featured Images when Post is displayed as an Excerpt.', 'weaver-xtreme' )),

			'post_excerpt_fi_location' => weaverx_cz_select(
				__( 'Featured Image Location - Excerpt', 'weaver-xtreme' ),
				__( 'Where to display Featured Image.', 'weaver-xtreme' ),
				'weaverx_cz_choices_fi_location',	'content-top', 'refresh'
			),


			'post_excerpt_fi_align' => weaverx_cz_select(
				__( 'Align Featured Image - Excerpt', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_fi_align',	'fi-alignleft', 'refresh'
			),

			'post_excerpt_fi_hide' => weaverx_cz_select(
				__( 'Hide Featured Image - Excerpt', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'post_excerpt_fi_size' => weaverx_cz_select(
				__( 'Page Featured Image Size - Excerpt', 'weaver-xtreme' ),
				__( 'Media Library Image Size for Featured Image. (Header uses full size).', 'weaver-xtreme' ),
				'weaverx_cz_choices_fi_size',	'thumbnail', 'refresh'
			),


			'post_excerpt_fi_width'     => array(
				'setting' => array(	'sanitize_callback' => 'absint', 'transport' => 'refresh', 'default' => 0	),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Featured Image Width (%) - Excerpt', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON,
					'description' => __( 'Width of Featured Image. Max Width in %, overrides FI Size selection. Set to 0 to avoid overriding above Featured Image Size setting.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  =>  100,
						'step' => 0.5,
					),
				),
			),


			'images-content-FI-single' => weaverx_cz_group_title( __( 'Featured Image - Single Page', 'weaver-xtreme' ),
				__( 'Display of Post Featured Images when Post is displayed on the Single Page.', 'weaver-xtreme' )),

			'post_fi_location' => weaverx_cz_select(
				__( 'Featured Image Location - Single Page', 'weaver-xtreme' ),
				__( 'Where to display Featured Image.', 'weaver-xtreme' ),
				'weaverx_cz_choices_fi_location',	'content-top', 'refresh'
			),

			'post_fi_align' => weaverx_cz_select(
				__( 'Align Featured Image - Single Page', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_fi_align',	'fi-alignleft', 'refresh'
			),

			'post_fi_hide' => weaverx_cz_select(
				__( 'Hide Featured Image - Single Page', 'weaver-xtreme' ),
				'',
				'weaverx_cz_choices_hide',	'hide-none', 'refresh'
			),

			'post_fi_size' => weaverx_cz_select(
				__( 'Page Featured Image Size - Single Page', 'weaver-xtreme' ),
				__( 'Media Library Image Size for Featured Image. (Header uses full size).', 'weaver-xtreme' ),
				'weaverx_cz_choices_fi_size',	'thumbnail', 'refresh'
			),

			'post_fi_width'     => array(
				'setting' => array(	'sanitize_callback' => 'absint', 'transport' => 'refresh', 'default' => 0	),
				'control' => array(
					'control_type' => WEAVERX_PLUS_RANGE_CONTROL,
					'label'   => __( 'Featured Image Width (%) - Single Page', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON . WEAVERX_REFRESH_ICON,
					'description' => __( 'Width of Featured Image. Max Width in %, overrides FI Size selection. Set to 0 to avoid overriding above Featured Image Size setting.', 'weaver-xtreme' ),
					'type'  => 'range',
					'input_attrs' => array(
						'min'  => 0,
						'max'  =>  100,
						'step' => 0.5,
					),
				),
			),

		),
	);


	/**
	 * Footer
	 */
	$image_sections['images-footer'] = array(
		'panel'   => $panel,
		'title'   => __( 'Footer Area', 'weaver-xtreme' ),
		'options' => array(

		),
	);

	/**
	 * Background Images
	 */

	$image_sections['images-background'] = array(
		'panel'   => $panel,
		'title'   => __( 'Background', 'weaver-xtreme' ),
		'options' => array(
			'_bg_fullsite_url' => array(
			'setting' => array(
				'transport' => 'postMessage',
				'sanitize_callback' => 'esc_url_raw'
			),
			'control' => array(
				'control_type' => WEAVERX_PLUS_IMAGE_CONTROL,
				'label' => __( 'Full Screen Site BG Image', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON ,
				'description' => __('Full screen centered auto-sized BG image. &diams;', 'weaver-xtreme'),
				//'type'  => 'checkbox',
			),
			),

			'images-background-css-help' => array(
				'setting' => array(
				),
				'control' => array(
					'control_type' => WEAVERX_PLUS_MISC_CONTROL,
					'label'   => __( 'Additional CSS for BG Images', 'weaver-xtreme' ) . WEAVERX_PLUS_ICON,
					'type'  => 'HTML',
					'description' => '<small>' .
					__('Use the <em>Additional CSS</em> option to specify additional background CSS options, each ending with a semi-colon (;).
Valid options include: background-position, background-size, background-origin, background-clip, and background-attachment. Useful example: <code>background-size: 100% auto;</code> - makes bg image full width of container, height depends on container. See this <a href="http://www.w3schools.com/cssref/css3_pr_background.asp" title="background CSS" target="_blank">W3 Schools page</a> for more information about background styling.' ,
					   'weaver-xtreme') . '</small>'
				),
			),

		),
	);
if (true) {

	$new_opts = weaverx_cz_add_image('body', __('Site BG Image', 'weaver-xtreme'),
		__('Background image for entire site (body)', 'weaver-xtreme'));
	$image_sections['images-background']['options'] = array_merge( $image_sections['images-background']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_image('wrapper', __('Wrapper BG Image', 'weaver-xtreme'),
		__('Background image for outer wrapper (#wrapper)', 'weaver-xtreme'));
	$image_sections['images-background']['options'] = array_merge( $image_sections['images-background']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_image('header', __('Header BG Image', 'weaver-xtreme'),
		__('Background image for header (#header)', 'weaver-xtreme'));
	$image_sections['images-background']['options'] = array_merge( $image_sections['images-background']['options'],  $new_opts);


	$new_opts = weaverx_cz_add_image('container', __('Container BG Image', 'weaver-xtreme'),
		__('Background image for Container - (#container)', 'weaver-xtreme'));
	$image_sections['images-background']['options'] = array_merge( $image_sections['images-background']['options'],  $new_opts);


	$new_opts = weaverx_cz_add_image('content', __('Content BG Image', 'weaver-xtreme'),
		__('Background image for Content - wraps page/post area (#content)', 'weaver-xtreme'));
	$image_sections['images-background']['options'] = array_merge( $image_sections['images-background']['options'],  $new_opts);


	$new_opts = weaverx_cz_add_image('page', __('Page content BG Image', 'weaver-xtreme'),
		__('Background image for Page content area (#content .page)', 'weaver-xtreme'));
	$image_sections['images-background']['options'] = array_merge( $image_sections['images-background']['options'],  $new_opts);


	$new_opts = weaverx_cz_add_image('post', __('Post BG Image', 'weaver-xtreme'),
		__('Background image for Post content area (#content .post)', 'weaver-xtreme'));
	$image_sections['images-background']['options'] = array_merge( $image_sections['images-background']['options'],  $new_opts);


	$new_opts = weaverx_cz_add_image('widgets_primary', __('Primary Sidebar Area BG Image', 'weaver-xtreme'),
		__('Background image for primary widget area (#primary-widget-area)', 'weaver-xtreme'));
	$image_sections['images-background']['options'] = array_merge( $image_sections['images-background']['options'],  $new_opts);


	$new_opts = weaverx_cz_add_image('widgets_secondary', __('Secondary Sidebar Areas BG Image', 'weaver-xtreme'),
		__('Background image for secondary widget areas (#secondary-widget-area)', 'weaver-xtreme'));
	$image_sections['images-background']['options'] = array_merge( $image_sections['images-background']['options'],  $new_opts);

	$new_opts = weaverx_cz_add_image('footer', __('Footer BG Image', 'weaver-xtreme'),
		__('Background image for Footer area (#colophon)', 'weaver-xtreme'));
	$image_sections['images-background']['options'] = array_merge( $image_sections['images-background']['options'],  $new_opts);

}


	/**
	 * Filter the definitions for the controls in the Color Scheme panel of the Customizer.
	 *
	 * @since 1.3.0.
	 *
	 * @param array    $image_sections    The array of definitions.
	 */
	$image_sections = apply_filters( 'weaverx_customizer_image_sections', $image_sections );

	// Merge with master array
	return array_merge( $sections, $image_sections );


}
endif;

add_filter( 'weaverx_customizer_sections', 'weaverx_customizer_define_image_sections' );
?>
