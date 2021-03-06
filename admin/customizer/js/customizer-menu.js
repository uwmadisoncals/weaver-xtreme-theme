//MENU Version 1.1
//Bug fixes and added resize arrow buttons for the customizer

//Below the onlclick open function for Sections, uncollapses if collapsed, switches to customize if in preview mode on small screens
function wvrxSelectOptions(optionPanel) {
	if (jQuery('.wp-full-overlay').hasClass('collapsed')) { //if customizer is collapsed, expand before loading panel. !!Check if API method exist
		jQuery('.wp-full-overlay').removeClass('collapsed');
		jQuery('.wp-full-overlay').addClass('expanded');
	};
	if (jQuery('.wp-full-overlay').hasClass('preview-only')) { //if customizer in Preview only, swicth to Customize before loading panel. !!Check if API method exist
		jQuery('.wp-full-overlay').removeClass('preview-only');
	};

	jQuery('.accordion-section.current-panel').css('width','300px');	// hack for Customizer's bad width calculation
	wp.customize.section(optionPanel).focus();   //Open the clicked section
	if (wvrxCM.wp_vers == '4.4') {
		jQuery('.accordion-section-content').css('margin-top','0px');	// Hack for WP 4.4 (at least up to Beta 4)
	}

	jQuery('#wx-jumpmenu').css('display','none');  //Close the Menu
	jQuery('.accordion-section').css('width','');	// clean the hack for Customizer's bad width calculation
};

//Below the onlclick open function for Panels, uncollapses if collapsed, switches to customize if in preview mode on small screens
function wvrxSelectPanel(tabPanel) {
	if (jQuery('.wp-full-overlay').hasClass('collapsed')) {  //if customizer is collapsed, expand before loading panel. !!Check if API method exist
		jQuery('.wp-full-overlay').removeClass('collapsed');
		jQuery('.wp-full-overlay').addClass('expanded');
	};
	if (jQuery('.wp-full-overlay').hasClass('preview-only')) { //if customizer in Preview only, swicth to Customize before loading panel. !!Check if API method exist
		jQuery('.wp-full-overlay').removeClass('preview-only');
	};

	wp.customize.panel(tabPanel).focus();   //Open the clicked panel

	jQuery('#wx-jumpmenu').css('display','none');   //Close the Menu
};

//Below the function to open jumpmenu on hover with a delay
function wvrxjumpmenuOpen(){
function wvrxOpen() {
//Check if the mouse is still over when the delay expires
	if(jQuery('#wx-jump').is(":hover")) {
	jQuery('#wx-jumpmenu').css('display','block');
	};
};
setTimeout (wvrxOpen,500);
};

function wvrxjumpmenuClose(){
//For some weird reason, if we dont delay the close, the menu closes when we move from the button to the actual menu Probably a discontinuity issue in the hover
function wvrxClose() {
	if(jQuery('#wx-jump').is(":hover") == false) {
	jQuery('#wx-jumpmenu').css('display','none');
	};
};
setTimeout (wvrxClose,700);
};

//Below the function for the buttons allowing to enlarge or reduce the width of the customizer
function wvrxGrow() {
	jQuery('.wp-full-overlay-sidebar').css('width','400px');
	jQuery('.wp-full-overlay.expanded').css('margin-left','400px');
	jQuery('#wx-resize .wx-shrink').css('display','inline');  //show the left (Shrink) arrow
	jQuery('#wx-resize .wx-grow').css('display','none');      //Hide the right (Grow) arrow
	if(jQuery('body.rtl').length ){
		jQuery('.wp-full-overlay.expanded').css('margin-left','0px');
		jQuery('.wp-full-overlay.expanded').css('margin-right','400px');
	};
};

function wvrxShrink() {
	jQuery('.wp-full-overlay-sidebar').css('width','300px');
	jQuery('.wp-full-overlay.expanded').css('margin-left','300px');
	jQuery('#wx-resize .wx-shrink').css('display','none');    //Hide the Left (Shrink) Arrow
	jQuery('#wx-resize .wx-grow').css('display','inline');    //Show the Right (Grow) Arrow
	if(jQuery('body.rtl').length ){
		jQuery('.wp-full-overlay.expanded').css('margin-left','0px');
		jQuery('.wp-full-overlay.expanded').css('margin-right','300px');
	};
};

/* function wvrxRefresh() {
	alert('refresh');
	wp.customize.preview.send( 'refresh' );
}
<!-- Refresh button --> \
<div id='wx-refresh'><span onclick=\"wvrxRefresh()\" class=\"dashicons dashicons-update\"></span></div> \

*/

//The section below adds the Menu HTML at the top of the body to place a Menu item on the Top bar

jQuery(".customize-panel-description").append(" \
<a target='_blank' href='" + wvrxCM.helpURL + "'><strong>" + wvrxCM.cust_help +"</strong></a>");

jQuery("#customize-header-actions").prepend(" \
<div id='wx-loading'>&nbsp;" + wvrxCM.loadingMsg + "</div> \
<!-- Resize buttons --> \
<div id='wx-resize'><span onclick=\"wvrxShrink()\" class=\"wx-shrink dashicons dashicons-arrow-left-alt2\"></span><span onclick=\"wvrxGrow()\" class=\"wx-grow dashicons dashicons-arrow-right-alt2\"></span></div> \
<!-- Menus --> \
<div onmouseover=\"wvrxjumpmenuOpen();\" onmouseout=\"wvrxjumpmenuClose();\" id='wx-jump'> \
<span class='dashicons dashicons-menu' style='color:#298cba;background-color:#dadada;margin:6px 10px 10px 0px;padding:6px;border:1px solid grey;font-weight:bold;border-radius:4px;'>&nbsp;</span> \
<div id='wx-jumpmenu'> \
 \
<!- +++++++++ WHERE +++++++++ -> \
 \
<li class='wx-tab-title' id='wx-where-title'>" + wvrxCM.where + " \
	<ul id='wx-where-jumpmenu'> \
		<li class='wx-tabs'>" + wvrxCM.global_opts + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> <!- +++ Global Options +++ ->\
			<ul class='wx-submenu wx-global-options'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-global');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-textcolor\"></span> " + wvrxCM.global + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-global');\" class='wx-subtab'><span class=\"dashicons dashicons-align-center\"></span> " + wvrxCM.global_spacing + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-global');\" class='wx-subtab'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.global_css + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-global-vis');\" class='wx-subtab'><span class=\"dashicons dashicons-visibility\"></span> " + wvrxCM.global_vis + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_images-global');\" class='wx-subtab'><span class=\"dashicons dashicons-format-image\"></span> " + wvrxCM.images + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_images-background');\" class='wx-subtab'><span class=\"dashicons dashicons-format-image\"></span> " + wvrxCM.background + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-head');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-code\"></span> " + wvrxCM.head_sec + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-links');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-code\"></span> " + wvrxCM.links + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-fullwidth');\" class='wx-subtab'><span class=\"dashicons dashicons-align-center\"></span> " + wvrxCM.fullwidth + "</li> \
			</ul> \
		</li> \
		<li class='wx-tabs'>" + wvrxCM.wrapping + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> <!- +++ Wrapping Areas +++ -> \
			<ul class='wx-submenu wx-wrapping'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-wrapping');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-appearance\"></span> " + wvrxCM.site_colors + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-wrapping');\" class='wx-subtab'><span class=\"dashicons dashicons-align-center\"></span> " + wvrxCM.spacing + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-wrapping');\" class='wx-subtab'><span class=\"dashicons dashicons-grid-view\"></span> " + wvrxCM.style + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-wrapping');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-textcolor\"></span> " + wvrxCM.typography + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-wrapping');\" class='wx-subtab'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.custom + "</li> \
			</ul> \
		</li> \
		<li class='wx-tabs'>" + wvrxCM.header + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> <!- +++ Header Area +++ ->\
			<ul class='wx-submenu wx-header'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-header');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-appearance\"></span> " + wvrxCM.site_colors + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-header');\" class='wx-subtab'><span class=\"dashicons dashicons-align-center\"></span> " + wvrxCM.spacing + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-header');\" class='wx-subtab'><span class=\"dashicons dashicons-grid-view\"></span> " + wvrxCM.style + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-header');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-textcolor\"></span> " + wvrxCM.typography + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-header');\" class='wx-subtab'><span class=\"dashicons dashicons-visibility\"></span> " + wvrxCM.visibility + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-header');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-table\"></span> " + wvrxCM.layout + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_images-header');\" class='wx-subtab'><span class=\"dashicons dashicons-format-image\"></span> " + wvrxCM.images + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-header');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-code\"></span> " + wvrxCM.added_content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-header');\" class='wx-subtab'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.custom + "</li> \
			</ul> \
		</li> \
		<li class='wx-tabs'>" + wvrxCM.menus + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> <!- +++ Menus +++ -> \
			<ul class='wx-submenu wx-menus'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-menus');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-appearance\"></span> " + wvrxCM.site_colors + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-menus');\" class='wx-subtab'><span class=\"dashicons dashicons-align-center\"></span> " + wvrxCM.spacing + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-menus');\" class='wx-subtab'><span class=\"dashicons dashicons-grid-view\"></span> " + wvrxCM.style + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-menus');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-textcolor\"></span> " + wvrxCM.typography + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-menus');\" class='wx-subtab'><span class=\"dashicons dashicons-visibility\"></span> " + wvrxCM.visibility + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-menus');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-table\"></span> " + wvrxCM.layout + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-menus');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-code\"></span> " + wvrxCM.added_content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-menus');\" class='wx-subtab'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.custom + "</li> \
				</ul> \
		</li> \
		<li class='wx-tabs'>" + wvrxCM.info_bar + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> <!- +++ Info Bar +++ -> \
			<ul class='wx-submenu wx-starting'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-info-bar');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-appearance\"></span> " + wvrxCM.site_colors + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-info-bar');\" class='wx-subtab'><span class=\"dashicons dashicons-align-center\"></span> " + wvrxCM.spacing + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-info-bar');\" class='wx-subtab'><span class=\"dashicons dashicons-grid-view\"></span> " + wvrxCM.style + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-info-bar');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-textcolor\"></span> " + wvrxCM.typography + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-info-bar');\" class='wx-subtab'><span class=\"dashicons dashicons-visibility\"></span> " + wvrxCM.visibility + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-info-bar');\" class='wx-subtab'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.custom + "</li> \
			</ul> \
		</li> \
		<li class='wx-tabs'>" + wvrxCM.content + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> <!- +++ Content +++ -> \
			<ul class='wx-submenu wx-content-area'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-content');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-appearance\"></span> " + wvrxCM.site_colors + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-content');\" class='wx-subtab'><span class=\"dashicons dashicons-align-center\"></span> " + wvrxCM.spacing + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-content');\" class='wx-subtab'><span class=\"dashicons dashicons-grid-view\"></span> " + wvrxCM.style + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-content');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-textcolor\"></span> " + wvrxCM.typography + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-content');\" class='wx-subtab'><span class=\"dashicons dashicons-visibility\"></span> " + wvrxCM.visibility + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-content');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-table\"></span> " + wvrxCM.layout + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_images-content');\" class='wx-subtab'><span class=\"dashicons dashicons-format-image\"></span> " + wvrxCM.images + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-content');\" class='wx-subtab'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.custom + "</li> \
			</ul> \
		</li> \
		<li class='wx-tabs'>" + wvrxCM.post_specific + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> <!- +++ Post Specific +++ -> \
			<ul class='wx-submenu wx-post-specific'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-post-specific');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-appearance\"></span> " + wvrxCM.site_colors + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-post-specific');\" class='wx-subtab'><span class=\"dashicons dashicons-align-center\"></span> " + wvrxCM.spacing + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-post-specific');\" class='wx-subtab'><span class=\"dashicons dashicons-grid-view\"></span> " + wvrxCM.style + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-post-specific');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-textcolor\"></span> " + wvrxCM.typography + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-post-specific');\" class='wx-subtab'><span class=\"dashicons dashicons-visibility\"></span> " + wvrxCM.visibility + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-post-specific');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-table\"></span> " + wvrxCM.layout + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_images-post-specific');\" class='wx-subtab'><span class=\"dashicons dashicons-format-image\"></span> " + wvrxCM.images + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-post-specific');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-code\"></span> " + wvrxCM.added_content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-post-specific');\" class='wx-subtab'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.custom + "</li> \
			</ul> \
		</li> \
		<li class='wx-tabs'>" + wvrxCM.sidebars + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> <!- +++ Sidebar & Widget Areas +++ -> \
			<ul class='wx-submenu wx-sidebars'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-sidebars');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-appearance\"></span> " + wvrxCM.site_colors + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-sidebars');\" class='wx-subtab'><span class=\"dashicons dashicons-align-center\"></span> " + wvrxCM.spacing + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-sidebars');\" class='wx-subtab'><span class=\"dashicons dashicons-grid-view\"></span> " + wvrxCM.style + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-sidebars');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-textcolor\"></span> " + wvrxCM.typography + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-sidebars');\" class='wx-subtab'><span class=\"dashicons dashicons-visibility\"></span> " + wvrxCM.visibility + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-sidebars');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-table\"></span> " + wvrxCM.layout + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-sidebars');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-code\"></span> " + wvrxCM.added_content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-sidebars');\" class='wx-subtab'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.custom + "</li> \
			</ul> \
		</li> \
		<li class='wx-tabs'>" + wvrxCM.widgets + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> <!- +++ Individual Widgets +++ -> \
			<ul class='wx-submenu wx-widgets'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-widgets');\" class='wx-subtab'><span class=\"dashicons dashicons-grid-view\"></span> " + wvrxCM.style + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-widgets');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-textcolor\"></span> " + wvrxCM.typography + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-widgets');\" class='wx-subtab'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.custom + "</li> \
			</ul> \
		</li> \
		<li class='wx-tabs'>" + wvrxCM.footer + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> <!- +++ Footer Area +++ -> \
			<ul class='wx-submenu wx-footer'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-footer');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-appearance\"></span> " + wvrxCM.site_colors + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-footer');\" class='wx-subtab'><span class=\"dashicons dashicons-align-center\"></span> " + wvrxCM.spacing + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-footer');\" class='wx-subtab'><span class=\"dashicons dashicons-grid-view\"></span> " + wvrxCM.style + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-footer');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-textcolor\"></span> " + wvrxCM.typography + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-footer');\" class='wx-subtab'><span class=\"dashicons dashicons-visibility\"></span> " + wvrxCM.visibility + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-footer');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-table\"></span> " + wvrxCM.layout + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-footer');\" class='wx-subtab'><span class=\"dashicons dashicons-editor-code\"></span> " + wvrxCM.added_content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-footer');\" class='wx-subtab'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.custom + "</li> \
			</ul> \
		</li> \
		<li onclick=\"wvrxSelectOptions('weaverx_content-injection');\" class='wx-tabs'>" + wvrxCM.html_inject + "</li> <!- +++ HTML Injection Areas +++ -> \
		<li class='wx-tabs'>" + wvrxCM.wp_settings + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span>  <!- +++ Wordpress Settings +++ -> \
			<ul class='wx-submenu wx-wordpress'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('title_tagline');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.tagline + "</li> \
				<li onclick=\"wvrxSelectOptions('static_front_page');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.front_page + "</li> \
				<li onclick=\"wvrxSelectPanel( 'widgets' );\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.sb_widg_content + "</li> \
				<li onclick=\"wvrxSelectPanel( 'nav_menus' );\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.custom_menus + "</li> \
				<li onclick=\"wvrxSelectOptions('header_image');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.header_image + "</li> \
				<li onclick=\"wvrxSelectOptions('background_image');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.background_image + "</li> \
			</ul> \
		</li> \
		<li class='wx-tabs'>" + wvrxCM.global_admin + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> <!- +++ Admin +++ ->\
			<ul class='wx-submenu wx-global'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.what + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_starting-intro');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.intro + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_starting-subtheme');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.subtheme + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_starting-help');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.help + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-help');\" class='wx-subtab'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.help_custom + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_general_admin');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.general_admin + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_general_save_settings');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.save_settings + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_general_restore_settings');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.restore_settings + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_general_saverestore');\" class='wx-subtab'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.general_saverestore + "</li> \
			</ul> \
		</li> \
	</ul> \
</li> \
 \
<!- +++++++++ WHAT +++++++++ -> \
 \
<li class='wx-tab-title' id='wx-what-title'>" + wvrxCM.what + " \
	<ul id='wx-what-jumpmenu'> \
		<!- +++ Start Here +++ -> \
		<li onclick=\"wvrxSelectPanel( 'weaverx_starting' );\"class='wx-tabs'><span class=\"dashicons dashicons-welcome-learn-more\"></span> " + wvrxCM.starting + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> \
			<ul class='wx-submenu wx-starting'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.where + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_starting-intro');\" class='wx-subtab'>" + wvrxCM.intro + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_starting-subtheme');\" class='wx-subtab'>" + wvrxCM.subtheme + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_starting-help');\" class='wx-subtab'>" + wvrxCM.help + "</li> \
			</ul> \
		</li> \
		<!- +++ General Options & Admin +++ -> \
		<li onclick=\"wvrxSelectPanel( 'weaverx_general' );\" class='wx-tabs'><span class=\"dashicons dashicons-admin-settings\"></span> " + wvrxCM.general + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> \
			<ul class='wx-submenu wx-general'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.where + "</li> \
				<li onclick=\"wvrxSelectOptions('title_tagline');\" class='wx-subtab'>" + wvrxCM.tagline + "</li> \
				<li onclick=\"wvrxSelectOptions('static_front_page');\" class='wx-subtab'>" + wvrxCM.front_page + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_general_admin');\" class='wx-subtab'>" + wvrxCM.general_admin + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_general_save_settings');\" class='wx-subtab'>" + wvrxCM.save_settings + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_general_restore_settings');\" class='wx-subtab'>" + wvrxCM.restore_settings + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_general_saverestore');\" class='wx-subtab'>" + wvrxCM.general_saverestore + "</li> \
			</ul> \
		</li> \
		<!- +++ Colors +++ -> \
		<li onclick=\"wvrxSelectPanel( 'weaverx_site-colors' );\" class='wx-tabs'><span class=\"dashicons dashicons-admin-appearance\"></span> " + wvrxCM.site_colors + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> \
			<ul class='wx-submenu wx-color'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.where + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-wrapping');\" class='wx-subtab'>" + wvrxCM.wrapping + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-links');\" class='wx-subtab'>" + wvrxCM.links + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-header');\" class='wx-subtab'>" + wvrxCM.header + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-menus');\" class='wx-subtab'>" + wvrxCM.menus + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-info-bar');\" class='wx-subtab'>" + wvrxCM.info_bar + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-content');\" class='wx-subtab'>" + wvrxCM.content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-post-specific');\" class='wx-subtab'>" + wvrxCM.post_specific + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-sidebars');\" class='wx-subtab'>" + wvrxCM.sidebars + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-widgets');\" class='wx-subtab'>" + wvrxCM.widgets + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_color-footer');\" class='wx-subtab'>" + wvrxCM.footer + "</li> \
			</ul> \
		</li> \
		<!- +++ 'Spacing, Widths,+ +++ -> \
		<li onclick=\"wvrxSelectPanel( 'weaverx_spacing' );\" class='wx-tabs'><span class=\"dashicons dashicons-align-center\"></span> " + wvrxCM.spacing + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> \
			<ul class='wx-submenu wx-spacing'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.where + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-global');\" class='wx-subtab'>" + wvrxCM.global_spacing + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-wrapping');\" class='wx-subtab'>" + wvrxCM.wrapping + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-header');\" class='wx-subtab'>" + wvrxCM.header + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-menus');\" class='wx-subtab'>" + wvrxCM.menus + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-info-bar');\" class='wx-subtab'>" + wvrxCM.info_bar + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-content');\" class='wx-subtab'>" + wvrxCM.content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-post-specific');\" class='wx-subtab'>" + wvrxCM.post_specific + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-sidebars');\" class='wx-subtab'>" + wvrxCM.sidebars + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-widgets');\" class='wx-subtab'>" + wvrxCM.widgets + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-footer');\" class='wx-subtab'>" + wvrxCM.footer + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_spacing-fullwidth');\" class='wx-subtab'>" + wvrxCM.fullwidth + "</li> \
			</ul> \
		</li> \
		<!- +++ Style - Borders, etc. +++ -> \
		<li onclick=\"wvrxSelectPanel( 'weaverx_style' );\" class='wx-tabs'><span class=\"dashicons dashicons-grid-view\"></span> " + wvrxCM.style + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> \
			<ul class='wx-submenu wx-style'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.where + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-global');\" class='wx-subtab'>" + wvrxCM.global + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-wrapping');\" class='wx-subtab'>" + wvrxCM.wrapping + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-header');\" class='wx-subtab'>" + wvrxCM.header + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-menus');\" class='wx-subtab'>" + wvrxCM.menus + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-info-bar');\" class='wx-subtab'>" + wvrxCM.info_bar + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-content');\" class='wx-subtab'>" + wvrxCM.content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-post-specific');\" class='wx-subtab'>" + wvrxCM.post_specific + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-sidebars');\" class='wx-subtab'>" + wvrxCM.sidebars + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-widgets');\" class='wx-subtab'>" + wvrxCM.widgets + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_style-footer');\" class='wx-subtab'>" + wvrxCM.footer + "</li> \
			</ul> \
		</li> \
		<!- +++ Typography +++ -> \
		<li onclick=\"wvrxSelectPanel( 'weaverx_typography' );\" class='wx-tabs'><span class=\"dashicons dashicons-editor-textcolor\"></span> " + wvrxCM.typography + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> \
			<ul class='wx-submenu wx-typo'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.where + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-global');\" class='wx-subtab'>" + wvrxCM.global + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-wrapping');\" class='wx-subtab'>" + wvrxCM.wrapping + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-header');\" class='wx-subtab'>" + wvrxCM.header + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-menus');\" class='wx-subtab'>" + wvrxCM.menus + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-info-bar');\" class='wx-subtab'>" + wvrxCM.info_bar + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-content');\" class='wx-subtab'>" + wvrxCM.content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-post-specific');\" class='wx-subtab'>" + wvrxCM.post_specific + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-sidebars');\" class='wx-subtab'>" + wvrxCM.sidebars + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-widgets');\" class='wx-subtab'>" + wvrxCM.widgets + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_typo-footer');\" class='wx-subtab'>" + wvrxCM.footer + "</li> \
			</ul> \
		</li> \
		<!- +++ Visibility +++ -> \
		<li onclick=\"wvrxSelectPanel( 'weaverx_visibility' );\" class='wx-tabs'><span class=\"dashicons dashicons-visibility\"></span> " + wvrxCM.visibility + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> \
			<ul class='wx-submenu wx-visibility'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.where + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-global-vis');\" class='wx-subtab'>" + wvrxCM.global_vis + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-header');\" class='wx-subtab'>" + wvrxCM.header + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-menus');\" class='wx-subtab'>" + wvrxCM.menus + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-info-bar');\" class='wx-subtab'>" + wvrxCM.info_bar + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-content');\" class='wx-subtab'>" + wvrxCM.content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-post-specific');\" class='wx-subtab'>" + wvrxCM.post_specific + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-sidebars');\" class='wx-subtab'>" + wvrxCM.sidebars + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_visibility-footer');\" class='wx-subtab'>" + wvrxCM.footer + "</li> \
			</ul> \
		</li> \
		<!- +++ Layout +++ -> \
		<li onclick=\"wvrxSelectPanel( 'weaverx_layout' );\" class='wx-tabs'><span class=\"dashicons dashicons-editor-table\"></span> " + wvrxCM.layout + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> \
			<ul class='wx-submenu wx-layout'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.where + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-header');\" class='wx-subtab'>" + wvrxCM.header + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-menus');\" class='wx-subtab'>" + wvrxCM.menus + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-content');\" class='wx-subtab'>" + wvrxCM.content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-post-specific');\" class='wx-subtab'>" + wvrxCM.post_specific + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-sidebars');\" class='wx-subtab'>" + wvrxCM.sidebars + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_layout-footer');\" class='wx-subtab'>" + wvrxCM.footer + "</li> \
			</ul> \
		</li> \
		<!- +++ Images +++ -> \
		<li onclick=\"wvrxSelectPanel( 'weaverx_images' );\" class='wx-tabs'><span class=\"dashicons dashicons-format-image\"></span> " + wvrxCM.images + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> \
			<ul class='wx-submenu wx-images'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.where + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_images-wrapping');\" class='wx-subtab'>" + wvrxCM.wrapping + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_images-header');\" class='wx-subtab'>" + wvrxCM.header + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_images-content');\" class='wx-subtab'>" + wvrxCM.content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_images-post-specific');\" class='wx-subtab'>" + wvrxCM.post_specific + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_images-background');\" class='wx-subtab'>" + wvrxCM.background + "</li> \
				<li onclick=\"wvrxSelectOptions('header_image');\" class='wx-subtab'>" + wvrxCM.header_image + "</li> \
				<li onclick=\"wvrxSelectOptions('background_image');\" class='wx-subtab'>" + wvrxCM.background_image + "</li> \
			</ul> \
		</li> \
		<!- +++ Added Content +++ -> \
		<li onclick=\"wvrxSelectPanel( 'weaverx_content' );\" class='wx-tabs'><span class=\"dashicons dashicons-editor-code\"></span> " + wvrxCM.added_content + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> \
			<ul class='wx-submenu wx-content'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.where + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-head');\" class='wx-subtab'>" + wvrxCM.head_sec + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-header');\" class='wx-subtab'>" + wvrxCM.header + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-menus');\" class='wx-subtab'>" + wvrxCM.menus + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-post-specific');\" class='wx-subtab'>" + wvrxCM.post_specific + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-sidebars');\" class='wx-subtab'>" + wvrxCM.sidebars + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-footer');\" class='wx-subtab'>" + wvrxCM.footer + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_content-injection');\" class='wx-subtab'>" + wvrxCM.injection + "</li> \
			</ul> \
		</li> \
		<!- +++ Custom CSS +++ -> \
		<li onclick=\"wvrxSelectPanel( 'weaverx_custom' );\" class='wx-tabs'><span style=\"color:#298cba;font-weight:bold;\">&nbsp;{&nbsp;}&nbsp;</span> " + wvrxCM.custom + "<span class=\"wx-tabarrow dashicons dashicons-arrow-right-alt2\"></span> \
			<ul class='wx-submenu wx-custom'> \
				<li class='wx-tabs wx-tab-title'>" + wvrxCM.where + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-help');\" class='wx-subtab'>" + wvrxCM.help_custom + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-global');\" class='wx-subtab'>" + wvrxCM.global + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-wrapping');\" class='wx-subtab'>" + wvrxCM.wrapping + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-links');\" class='wx-subtab'>" + wvrxCM.links + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-header');\" class='wx-subtab'>" + wvrxCM.header + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-menus');\" class='wx-subtab'>" + wvrxCM.menus + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-info-bar');\" class='wx-subtab'>" + wvrxCM.info_bar + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-content');\" class='wx-subtab'>" + wvrxCM.content + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-post-specific');\" class='wx-subtab'>" + wvrxCM.post_specific + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-sidebars');\" class='wx-subtab'>" + wvrxCM.sidebars + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-widgets');\" class='wx-subtab'>" + wvrxCM.widgets + "</li> \
				<li onclick=\"wvrxSelectOptions('weaverx_custom-footer');\" class='wx-subtab'>" + wvrxCM.footer + "</li> \
			</ul> \
		</li> \
		<!- +++ Sidebar & Widgets Content +++ -> \
		<li onclick=\"wvrxSelectPanel( 'widgets' );\" class='wx-tabs'><span class=\"dashicons dashicons-welcome-widgets-menus\"></span> " + wvrxCM.sb_widg_content + " \
		</li> \
		<!- +++ Custom Menus Content +++ -> \
		<li onclick=\"wvrxSelectPanel( 'nav_menus' );\" class='wx-tabs'><span class=\"dashicons dashicons-menu\"></span> " + wvrxCM.custom_menus + " \
		</li> \
	</ul> \
</li> \
</div> \
</div>");
//This allows people to click and drag the button to a differnt location (good in preview mode) except on touch device where it interferes with the hover/touch
jQuery(function() {
var weaverx_isTouch = ("ontouchstart" in window)
		|| (navigator.MaxTouchPoints > 0)
		|| (navigator.msMaxTouchPoints > 0);
		if( weaverx_isTouch == false ) {
		jQuery( "#wx-jump" ).draggable();
		}
});

//Moving the Preview / customize toggle button to make space for the menu icon
jQuery('.customize-controls-preview-toggle').css('left','110px');
if(jQuery('body.rtl').length ){
	jQuery('.customize-controls-preview-toggle').css('left','');
	jQuery('.customize-controls-preview-toggle').css('right','110px');
};
