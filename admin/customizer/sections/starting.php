<?php
/**
 * Define starting settings - Weaver Xtreme Customizer
 */

if ( ! function_exists( 'weaverx_customizer_define_starting_sections' ) ) :
/**
 * Define the sections and settings for the Speed Test panel
 * causes execution time out at: wp-includes/class-wp-customize-setting.php near line 522
 *
 */
function weaverx_customizer_define_starting_sections( $sections ) {
	$panel = 'weaverx_starting';
	$starting_sections = array();

	/**
	 * Intro
	 */
	$starting_sections['starting-intro'] = array(
		'panel'   => $panel,
		'title'   => __( 'Introduction to Weaver Xtreme', 'weaver-xtreme' ),
		'description' => __('A concise introduction to Weaver Xtreme.', 'weaver-xtreme') .
		   ' <br />(' . WEAVERX_THEMEVERSION . ')',		// don't translate theme name/version
		'options' => array(
			'starting-intro-header' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control',
					'label'   => __( 'Introduction', 'weaver-xtreme' ),
					'description'   => __(
'<p><em>Weaver Xtreme</em> allows you to customize virtually every aspect of your site.
The Customizer Options are organized as top level panels based on WHAT you want to customize, and a second level of sections
based on WHERE you want to make the customizations. Remember: <strong style="color:red;">WHAT</strong> and <strong style="color:red;">WHERE</strong>.</p>
<h4>First Level Options: WHAT to Set - Option Categories</h4>
        <p>The first level of Weaver Xtreme Customizer menus is organized around different categories of options that reflect different collections of related options. For example, all the Color settings are found on a single, top-level option panel called &quot;Colors&quot;. The other top level option panels represent similar groups of options:</p>
        <ul>
          <li><strong>&#9656; Colors</strong> - Specify all colors used on site - both text and backgroud colors. </li>
          <li><strong>&#9656; Spacing, Widths, Alignment</strong> - Set margins, padding, spacing, heights, widths, and alignment.</li>
          <li><strong>&#9656; Style</strong> -  Set borders, shadows, rounded corners, list bullet style, icons.</li>
          <li><strong>&#9656; Typography</strong> - Set font family, font size, bold, italic, default base font information.</li>
          <li><strong>&#9656; Visibility</strong> - Show or hide various elements - usually by device (phone, tablet, desktop).</li>
          <li><strong>&#9656; Layout</strong> - Specify element layout - sidebars, etc.</li>
          <li><strong>&#9656; Images</strong> -  Set borders, placement, Featured Images, Header Images, Background Images.</li>
          <li><strong>&#9656; Added Content</strong> - Define added content for extra HTML insertion areas.</li>
          <li><strong>&#9656; Custom CSS</strong> - Advanced users can specify custom CSS for the whole site or specific areas.</li>
          <li><strong>&#9656; Sidebars &amp; Widgets Content</strong> - the standard WordPress interface for widget areas and widgets.</li>
          <li><strong>&#9656; Custom Menu Content </strong>- the standard WordPress interface for defining custom menus.</li>
        </ul>
        <p>The top level Customizer menu also has two additional menus:</p>
        <ul>
          <li><strong>&#9656; Weaver Xtreme: Start Here</strong> - access to getting started help and other documentation.</li>
          <li><strong>&#9656; General Options &amp; Admin</strong> - WordPress Site Identity and Static Front page options, and other theme admin options.</li>
        </ul>
<p>The basic logic behind this organization is that it is easy to remember the different kinds of things you want to customize, like color or spacing. The next level of menus specifies <em>where</em> you want to make those changes.</p>
<h4>Second Level Options: WHERE to Set - Areas</h4>
<p>Deciding <em>what</em> you want to customize is usually an obvious decision. Finding <em>where</em> to apply those settings take a bit more understanding just how a Weaver Xtreme WordPress site is organized. </p>
<p>We\'ve tried to make this second level step as easy and consistent as possible. Almost every one of the option categories can be applied to the same set of areas. The &quot;standard&quot; set of areas include:</p>
<ul>
  <li><strong>&#9656; Wrapping Areas</strong> - the major outer areas that wrap the site\'s content. The main Wrapper Area wraps the entire site, while the Container Area wraps the page or post content and the main sidebars.</li>
  <li><strong>&#9656; Links</strong> - Not all categories apply to links, but links are treated as a single element to style.</li>
  <li><strong>&#9656; Header Area</strong> - the header area is displayed at the top of the site, and includes the site title and tagline, the primary and secondary menus, the site header image, a header widget area, and an extra area for arbitrary HTML.</li>
  <li><strong>&#9656; Menus</strong> - there are a Primary and Secondary menu available in the Header Area. Weaver Xtreme Plus also supports Extra menus that can be displayed in different locations.</li>
  <li><strong>&#9656; Info Bar</strong> - the Info Bar is displayed immediately below the Header Area, and shows navigation information, as well as other custom content.</li>
  <li><strong>&#9656; Content</strong> - the content area displays page and post content.</li>
  <li><strong>&#9656; Post Specific</strong> - the Content styling will be applied to both page and post content, but this section allows you to have specific styling for posts and blog views.</li>
  <li><strong>&#9656; Sidebars &amp; Widget Areas</strong> - styling for the various Sidebars and Widget Areas.</li>
  <li><strong>&#9656; Individual Widgets</strong> - styling for individual widgets displayed in the Widget Areas.</li>
  <li><strong>&#9656; Footer Area</strong> - the footer area at the bottom of the site. This includes a widget area and an extra custom HTML insertion area.</li>
  <li><strong>&#9656; Global Options</strong> - some of the Option Categories can include other sections that can apply to global settings. Typography, for example, allows you to specify various global options such as base font size.</li>
</ul>',

'weaver-xtreme' ),
					'type'  => 'html',
				),
			),
		),
	);

	/**
	 * Subtheme
	 */


	$starting_sections['starting-subtheme']	 = array(
		'panel'   => $panel,
		'title'   => __( 'Try a Pre-defined Subtheme', 'weaver-xtreme' ),
		'options' => array(

			'load_subtheme' => array(
				'setting' => array(
					'transport' => 'postMessage'
				),
				'control' => array(
					'control_type' => 'WeaverX_Load_WX_Subtheme',
					'label' => __( 'Predefined Weaver Xtreme Subthemes', 'weaver-xtreme' ),
					'description' => __('Get a quick start on your site by selecting on of these predefined subthemes.
Once you\'ve picked a subtheme, you can tweak it to look just like you want. The Legacy Weaver Xtreme Admin Subthemes tab
offers many additional subthemes to choose from.', 'weaver-xtreme'),
				),
			),
		)
	);



	/**
	 * Help links
	 */
	$starting_sections['starting-help'] = array(
		'panel'   => $panel,
		'title'   => __( 'Get Help using Weaver Xtreme', 'weaver-xtreme' ),
		'description' => __('Read the Weaver Xtreme Documentation', 'weaver-xtreme'),
		'options' => array(
			'starting-help-header' => array(
				'control' => array(
					'control_type' => 'WeaverX_Misc_Control',
					'label'   => __( 'Get Help', 'weaver-xtreme' ),
					'description'   => sprintf(__(
'<h3>Support Forum</h3><p>Please see our active %s <strong>Support Forum</strong></a> for online help.</p>
<h3>Theme Documentation</h3><p><strong>%s</strong><br />Complete documentation for using the Weaver Xtreme Theme.</p>
<h3>Theme Demo</h3><p>%s<strong>Weaver Xtreme Demo Site</a></strong><br />Live demo of Weaver Xtreme and Weaver Xtreme Plus features.</p>
<h3>CSS Tutorial</h3><p>Click for a short %s.</p>
<h3>Supported Fonts</h3><p>Click for demo of %s.</p>
', 'weaver-xtreme' ),
		weaverx_site('','//forum.weavertheme.com/',__('Weaver Support Forum', 'weaver-xtreme'),false),
		weaverx_help_link('help.html', __('Weaver Xtreme Help', 'weaver-xtreme' /*adm*/), __('Weaver Xtreme Theme Documentation', 'weaver-xtreme' /*adm*/), false),
		weaverx_site('','//demo.weavertheme.com/',__('Weaver Xtreme Demo Site', 'weaver-xtreme'),false),

		weaverx_help_link('css-help.html', __('Weaver CSS Help', 'weaver-xtreme'), __('CSS Tutorial', 'weaver-xtreme'), false),
		weaverx_help_link('font-demo.html', __('Examples of supported fonts', 'weaver-xtreme'), __('Font Examples', 'weaver-xtreme'), false)
		),

					'type'  => 'HTML',
				),
			),
		),
	);


/*
	<?php weaverx_help_link('font-demo.html', __('Examples of supported fonts', 'weaver-xtreme'), __('Font Examples', 'weaver-xtreme')) ?>
</h2>
<p>
<?php _e('Example of Font Families supported by Weaver Xtreme and Weaver Xtreme Plus.', 'weaver-xtreme'); ?>
</p>
*/



	/**
	 * Filter the definitions for the controls in the panel of the Customizer
	 */
	//$starting_sections = apply_filters( 'weaverx_customizer_starting_sections', $starting_sections );

	// Merge with master array
	return array_merge( $sections, $starting_sections );


}
endif;

add_filter( 'weaverx_customizer_sections', 'weaverx_customizer_define_starting_sections' );
