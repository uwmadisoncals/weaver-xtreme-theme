<?php
// ============================== Recommended Plugins =========================
/**
 * Add plugin automation file
 */

require_once( get_template_directory() . WEAVERX_ADMIN_DIR . '/class-tgm-plugin-activation.php' );


add_action( 'tgmpa_register', 'weaverx_install_tgm_plugins' );

function weaverx_install_tgm_plugins() {
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     => __("Weaver Xtreme Theme Support (ESSENTIAL for full theme functionality)", 'weaver-xtreme' /*adm*/), // The plugin name
			'slug'     => 'weaverx-theme-support', // The plugin slug (typically the folder name)
			'required' => false
		),

		array(
			'name'     => __('Weaver Show Posts (shortcode to show selected posts)', 'weaver-xtreme' /*adm*/), // The plugin name
			'slug'     => 'show-posts', // The plugin slug (typically the folder name)
			'required' => false
		),

		array(
			'name'     => __('WP Edit (enhanced content editor)', 'weaver-xtreme' /*adm*/), // The plugin name
			'slug'     => 'wp-edit', // The plugin slug (typically the folder name)
			'required' => false
		),

	);



	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */

	$config = array(
		'default_path'     => '', // Default absolute path to pre-packaged plugins
		'menu'             => 'install-weaverx-addons', // Menu slug
		'has_notices'      => true, // Show admin notices or not
		'is_automatic'     => true, // Automatically activate plugins after installation or not
		'message'          =>
		__('<p>The following plugins are recommended for an optimal Weaver Xtreme theme experience.</p>
<p>The <em><strong>Weaver Xtreme Theme Support</strong></em> plugin provides Per Page and Per Post options (this functionality is
<strong><em>essential</em></strong> for full theme capability, but is required by WordPress.org to be supported as a plugin.
This plugin also includes several shortcodes that help you customize your content for desktop or mobile device appearance.</p>
<p>The <em><strong>Weaver Show Posts</strong></em> plugin provides [show_posts] shortcode which allows you to display
any number of posts on pages, selected by filtering conditions, in the header, the footer, or in sidebars.</p>
<p><em><strong>WP Edit</strong></em> provides enhanced page and post editing, including Manual Excerpts. </p>', 'weaver-xtreme' /*adm*/),
			// Message to output right before the plugins table
		'strings'          => array(
			'page_title'                      => __( 'The <em>Weaver Xtreme</em> Theme Recommended Plugins', 'weaver-xtreme' ),
			'menu_title'                      => __( '<small>&times;Recommended Plugins</small>', 'weaver-xtreme' ),
			'installing'                      => __( 'Installing Plugin: %s', 'weaver-xtreme' ), // %1$s = plugin name
			'oops'                            => __( 'Something went wrong with the plugin API.', 'weaver-xtreme' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'weaver-xtreme' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'  => _n_noop( 'The <em>Weaver Xtreme Theme</em> recommends this plugin, %1$s, to enhance your theme experience.', 'The <em>Weaver Xtreme Theme</em> recommends these plugins, %1$s,  to enhance your theme experience.', 'weaver-xtreme' ), // %1$s = plugin name(s)
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'weaver-xtreme' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'weaver-xtreme' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended' => _n_noop( 'Please activate this recommended plugin, %1$s, to enhance your <em>Weaver Xtreme Theme</em> experience.', 'Please activate these recommended plugins, %1$s, to enhance your <em>Weaver Xtreme Theme</em> experience.', 'weaver-xtreme' ), // %1$s = plugin name(s)
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'weaver-xtreme' ), // %1$s = plugin name(s)
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with Weaver X: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'weaver-xtreme'), // %1$s = plugin name(s)
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'weaver-xtreme'), // %1$s = plugin name(s)
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' , 'weaver-xtreme'),
			'activate_link'                   => _n_noop( 'Open Plugins Admin Page to Activate', 'Open Plugins Admin Page to Activate' , 'weaver-xtreme'),
			'return'                          => __( 'Return to Required Plugins Installer', 'weaver-xtreme' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'weaver-xtreme' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', 'weaver-xtreme' ) // %1$s = dashboard link
		)
	);

	tgmpa( $plugins, $config );
}

//--

?>
