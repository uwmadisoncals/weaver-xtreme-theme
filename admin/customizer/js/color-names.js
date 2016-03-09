#!/usr/bin/env node
var names = [
		'body_bgcolor=body',

		'wrapper_color=#wrapper',
		'wrapper_bgcolor=#wrapper',

		'container_color=#container',
		'container_bgcolor=#container',

		'link_color=a, .wrapper a',
		'link_hover_color=a:hover, .wrapper a:hover',

		'header_color=#header',
		'header_bgcolor=#header',

		'site_title_color=.wrapper #site-title a,.site-title a',
		'site_title_bgcolor=#site-title,.site-title',

		'tagline_color=#site-tagline,.site-tagline',
		'tagline_bgcolor=#site-tagline,.site-tagline',

		'header_sb_color=#header-widget-area,.widget-area-header',
		'header_sb_bgcolor=#header-widget-area,.widget-area-header',

		'header_html_color=#header-html',
		'header_html_bgcolor=#header-html',

		'm_primary_color=.menu-primary .wvrx-menu-container,.menu-primary .wvrx-menu > li > a',
		'm_primary_bgcolor=.menu-primary .wvrx-menu-container',

		'm_secondary_color=.menu-secondary .wvrx-menu-container.menu-secondary .wvrx-menu > li > a',
		'm_secondary_bgcolor=.menu-secondary .wvrx-menu-container',

		'm_primary_hover_color=!.menu-primary .wvrx-menu > li > a:hover',
		'm_primary_hover_bgcolor=!.menu-primary .wvrx-menu > li > a:hover',

		'm_secondary_hover_color=!.menu-secondary .wvrx-menu > li > a:hover',
		'm_secondary_hover_bgcolor=!.menu-secondary .wvrx-menu > li > a:hover',

		'm_primary_sub_color=.menu-primary .wvrx-menu ul li a,.menu-primary .wvrx-menu ul.mega-menu li',
		'm_primary_sub_bgcolor=.menu-primary .wvrx-menu ul li a,.menu-primary .wvrx-menu ul.mega-menu li',

		'm_secondary_sub_color=.menu-secondary .wvrx-menu ul li a,.menu-secondary .wvrx-menu ul.mega-menu li',
		'm_secondary_sub_bgcolor=.menu-secondary .wvrx-menu ul li a,.menu-secondary .wvrx-menu ul.mega-menu li',

		'm_primary_sub_hover_color=!.menu-primary .wvrx-menu > li > a:hover',
		'm_primary_sub_hover_bgcolor=!.menu-primary .wvrx-menu > li > a:hover',

		'm_secondary_sub_hover_color=!.menu-secondary .wvrx-menu > li > a:hover',
		'm_secondary_sub_hover_bgcolor=!.menu-secondary .wvrx-menu > li > a:hover',

		'm_primary_link_bgcolor=.menu-primary .wvrx-menu > li > a',		// Item BG
		'm_secondary_link_bgcolor=.menu-secondary .wvrx-menu > li > a',

		'm_header_mini_color=#nav-header-mini a,#nav-header-mini a:visited',
		'm_header_mini_bgcolor=#nav-header-mini',

		'm_header_mini_hover_color=#nav-header-mini a:hover',

		'menubar_curpage_color=!.weaverx-theme-menu .current_page_item > a,.weaverx-theme-menu .current-menu-item > a,.weaverx-theme-menu .current-cat > a,.weaverx-theme-menu .current_page_ancestor > a,.weaverx-theme-menu .current-category-ancestor > a,.weaverx-theme-menu .current-menu-ancestor > a,.weaverx-theme-menu .current-menu-parent > a,.weaverx-theme-menu .current-category-parent > a',
		'menubar_curpage_bgcolor=!.weaverx-theme-menu .current_page_item > a,.weaverx-theme-menu .current-menu-item > a,.weaverx-theme-menu .current-cat > a,.weaverx-theme-menu .current_page_ancestor > a,.weaverx-theme-menu .current-category-ancestor > a,.weaverx-theme-menu .current-menu-ancestor > a,.weaverx-theme-menu .current-menu-parent > a,.weaverx-theme-menu .current-category-parent > a',
		'infobar_color=#infobar',
		'infobar_bgcolor=#infobar',

		'ibarlink_color=#infobar a',
		'ibarlink_hover_color=#infobar a:hover',

		'content_color=#content',
		'content_bgcolor=#content',

		'page_title_color=.page-title',
		'page_title_bgcolor=.page-title',

		'archive_title_color=.archive-title',
		'archive_title_bgcolor=.archive-title',

		'contentlink_color=.content a',
		'contentlink_hover_color=.content a:hover',

		'content_h_color=.entry-content h1,.entry-content h2,.entry-content h3,.entry-content h4,.entry-content h5,.entry-content h6',
		'content_h_bgcolor=.entry-content h1,.entry-content h2,.entry-content h3,.entry-content h4,.entry-content h5,.entry-content h6',

		'input_color=input,textarea',
		'input_bgcolor=input,textarea',

		'search_color=.search-field,#header-search .search-field:focus',
		'search_bgcolor=search-field,#header-search .search-field:focus',

		'comment_headings_color=#comments-title h3, #comments-title h4, #respond h3',

		'comment_content_bgcolor=.commentlist li.comment, #respond',
		'comment_submit_bgcolor=#respond input#submit',

		'post_color=.post-area',
		'post_bgcolor=.post-area',

		'stickypost_bgcolor=.blog .sticky',

		'post_title_color=.wrapper .post-title a,.wrapper .post-title a:visited',
		'post_title_bgcolor=.wrapper .post-title',

		'post_info_top_color=.entry-meta',
		'post_info_top_bgcolor=.entry-meta',

		'post_info_bottom_color=.entry-utility',
		'post_info_bottom_bgcolor=.entry-utility',

		'ilink_color=.wrapper .entry-meta a, .wrapper .entry-utility a',
		'ilink_hover_color=.wrapper .entry-meta a:hover,.wrapper .entry-utility a:hover',
		'post_icons_color=.entry-meta-gicons .entry-date:before,.entry-meta-gicons .by-author:before,.entry-meta-gicons .cat-links:before,.entry-meta-gicons .tag-links:before,.entry-meta-gicons .comments-link:before,.entry-meta-gicons .permalink-icon:before',

		'post_author_bgcolor=#author-info',

		'primary_color=#primary-widget-area,.widget-area-primary',
		'primary_bgcolor=#primary-widget-area,.widget-area-primary',

		'secondary_color=#secondary-widget-area,.widget-area-secondary',
		'secondary_bgcolor=#secondary-widget-area,.widget-area-secondary',

		'top_color=.widget-area-top',
		'top_bgcolor=.widget-area-top',

		'bottom_color=.widget-area-bottom',
		'bottom_bgcolor=.widget-area-bottom',

		'widget_color=.widget',
		'widget_bgcolor=.widget',

		'widget_title_color=.widget-title',
		'widget_title_bgcolor=.widget-title',

		'wlink_color=.wrapper .widget a',
		'wlink_hover_color=.wrapper .widget a:hover',

		'footer_color=#colophon',
		'footer_bgcolor=#colophon',

		'footerlink_color=.colophon a',
		'footerlink_hover_color=.colophon a:hover',

		'footer_sb_color=#footer-widget-area,.widget-area-footer',
		'footer_sb_bgcolor=#footer-widget-area,.widget-area-footer',

		'footer_html_color=#footer-html',
		'footer_html_bgcolor=#footer-html',

		'last_otpion_for_syntax',
		'dontendwithcomma'
	];
