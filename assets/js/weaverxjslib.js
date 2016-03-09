/* *********************************************************************************
 * Weaver Xtreme JavaScript support Library
 *
 * Author: WeaverTheme - www.weavertheme.com
 * @version 2.0.8
 * @license GNU Lesser General Public License, http://www.gnu.org/copyleft/lesser.html
 * @author  Bruce Wampler
 *
 * Notes - this library requires jQuery to be loaded
 *  this library was cobbled together over a long period of time, so it contains a
 *  bit of a jumble of straight JavaScript and jQuery calls. So it goes. It works.
 *
 *
 ************************************************************************************* */

//Initial load of page
jQuery(document).ready(weaverxOnResize);

/* -------------------------
	weaverx_hide_css, JavaScript specialized hide table row
*/

function weaverxBrowserWidth() {
	// This is a cross-browser way to get the window width. We will use it in all script
	// tht need the width to endure consistent treatement of the width.
	var width = 768;
	if( typeof( window.innerWidth ) == 'number' ) {
		width = window.innerWidth;    //Non-IE
	} else if( document.documentElement &&
		( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
		width = document.documentElement.clientWidth; //IE 6+ in 'standards compliant mode'
	} else if ( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
		width = document.body.clientWidth;    //IE 4 compatible
	}
	return width;
}


/**
* Detect Element Resize Plugin for jQuery
*
* https://github.com/sdecima/javascript-detect-element-resize
* Sebastian Decima
*
* version: 0.5.3
* * Weaver X Mod - clean up name space: resize -> resizeX just jquery definition (4 of them)
**/

(function ( $ ) {
	var attachEvent = document.attachEvent,
		stylesCreated = false;

	var jQuery_resizeX = $.fn.resizeX;

	$.fn.resizeX = function(callback) {
		return this.each(function() {
			if(this == window)
				jQuery_resizeX.call(jQuery(this), callback);
			else
				addResizeListener(this, callback);
		});
	}

	$.fn.removeResize = function(callback) {
		return this.each(function() {
			removeResizeListener(this, callback);
		});
	}

	if (!attachEvent) {
		var requestFrame = (function(){
			var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame ||
								function(fn){ return window.setTimeout(fn, 20); };
			return function(fn){ return raf(fn); };
		})();

		var cancelFrame = (function(){
			var cancel = window.cancelAnimationFrame || window.mozCancelAnimationFrame || window.webkitCancelAnimationFrame ||
								   window.clearTimeout;
		  return function(id){ return cancel(id); };
		})();

		function resetTriggers(element){
			var triggers = element.__resizeTriggers__,
				expand = triggers.firstElementChild,
				contract = triggers.lastElementChild,
				expandChild = expand.firstElementChild;
			contract.scrollLeft = contract.scrollWidth;
			contract.scrollTop = contract.scrollHeight;
			expandChild.style.width = expand.offsetWidth + 1 + 'px';
			expandChild.style.height = expand.offsetHeight + 1 + 'px';
			expand.scrollLeft = expand.scrollWidth;
			expand.scrollTop = expand.scrollHeight;
		};

		function checkTriggers(element){
			return element.offsetWidth != element.__resizeLast__.width ||
						 element.offsetHeight != element.__resizeLast__.height;
		}

		function scrollListener(e){
			var element = this;
			resetTriggers(this);
			if (this.__resizeRAF__) cancelFrame(this.__resizeRAF__);
			this.__resizeRAF__ = requestFrame(function(){
				if (checkTriggers(element)) {
					element.__resizeLast__.width = element.offsetWidth;
					element.__resizeLast__.height = element.offsetHeight;
					element.__resizeListeners__.forEach(function(fn){
						fn.call(element, e);
					});
				}
			});
		};

		/* Detect CSS Animations support to detect element display/re-attach */
		var animation = false,
			animationstring = 'animation',
			keyframeprefix = '',
			animationstartevent = 'animationstart',
			domPrefixes = 'Webkit Moz O ms'.split(' '),
			startEvents = 'webkitAnimationStart animationstart oAnimationStart MSAnimationStart'.split(' '),
			pfx  = '';
		{
			var elm = document.createElement('fakeelement');
			if( elm.style.animationName !== undefined ) { animation = true; }

			if( animation === false ) {
				for( var i = 0; i < domPrefixes.length; i++ ) {
					if( elm.style[ domPrefixes[i] + 'AnimationName' ] !== undefined ) {
						pfx = domPrefixes[ i ];
						animationstring = pfx + 'Animation';
						keyframeprefix = '-' + pfx.toLowerCase() + '-';
						animationstartevent = startEvents[ i ];
						animation = true;
						break;
					}
				}
			}
		}

		var animationName = 'resizeanim';
		var animationKeyframes = '@' + keyframeprefix + 'keyframes ' + animationName + ' { from { opacity: 0; } to { opacity: 0; } } ';
		var animationStyle = keyframeprefix + 'animation: 1ms ' + animationName + '; ';
	}

	function createStyles() {
		if (!stylesCreated) {
			//opacity:0 works around a chrome bug https://code.google.com/p/chromium/issues/detail?id=286360
			var css = (animationKeyframes ? animationKeyframes : '') +
					'.resize-triggers { ' + (animationStyle ? animationStyle : '') + 'visibility: hidden; opacity: 0; } ' +
					'.resize-triggers, .resize-triggers > div, .contract-trigger:before { content: \" \"; display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%; overflow: hidden; } .resize-triggers > div { background: #eee; overflow: auto; } .contract-trigger:before { width: 200%; height: 200%; }',
				head = document.head || document.getElementsByTagName('head')[0],
				style = document.createElement('style');

			style.type = 'text/css';
			if (style.styleSheet) {
				style.styleSheet.cssText = css;
			} else {
				style.appendChild(document.createTextNode(css));
			}

			head.appendChild(style);
			stylesCreated = true;
		}
	}

	window.addResizeListener = function(element, fn){
		if (attachEvent) element.attachEvent('onresize', fn);
		else {
			if (!element.__resizeTriggers__) {
				if (getComputedStyle(element).position == 'static') element.style.position = 'relative';
				createStyles();
				element.__resizeLast__ = {};
				element.__resizeListeners__ = [];
				(element.__resizeTriggers__ = document.createElement('div')).className = 'resize-triggers';
				element.__resizeTriggers__.innerHTML = '<div class="expand-trigger"><div></div></div>' +
																						'<div class="contract-trigger"></div>';
				element.appendChild(element.__resizeTriggers__);
				resetTriggers(element);
				element.addEventListener('scroll', scrollListener, true);

				/* Listen for a css animation to detect element display/re-attach */
				animationstartevent && element.__resizeTriggers__.addEventListener(animationstartevent, function(e) {
					if(e.animationName == animationName)
						resetTriggers(element);
				});
			}
			element.__resizeListeners__.push(fn);
		}
	};

	window.removeResizeListener = function(element, fn){
		if (attachEvent) element.detachEvent('onresize', fn);
		else {
			element.__resizeListeners__.splice(element.__resizeListeners__.indexOf(fn), 1);
			if (!element.__resizeListeners__.length) {
					element.removeEventListener('scroll', scrollListener);
					element.__resizeTriggers__ = !element.removeChild(element.__resizeTriggers__);
			}
		}
	}
}( jQuery ));





/*! Menu Script from Sigma - v0.1.2
 * http://stephenharris.info
 * Copyright (c) 2014; * Licensed GPLv2+
 *
 * Modified by WeaverTheme
 *  This code requires the Android Drop-Down fix included in this library to handle older Android devices.
 * */

if (!Object.create) {               // IE8 shim for Object.create
	Object.create = (function(){
		function F(){}

		return function(o){
			if (arguments.length != 1) {
				throw new Error('Object.create implementation only accepts one parameter.');
			}
			F.prototype = o;
			return new F()
		}
	})()
};


(function( $, window, undefined ) {
	'use strict';

	var Menu = {
		options: {
			mobileBreakpoint: 768,              // don't change this - corresponds to small-tablet/desktop split
			hideToggle: false,                  // set to true if want a tablet sized vertical accordion menu
			toggleButtonID: 'menu-toggle-button',
			hoverClass: 'menu-hover',
			arrowClass: 'menu-arrows',
			mobileClass: 'is-mobile-menu',
			hideMobileClass: 'is-hidden',       // this shows/hides the top level menu items on the mobile view, set to not-hidden to not hide
			hasSubmenuClass: 'has-submenu',
			openSubmenuClass: 'is-open-submenu',
			toggleSubmenuClass: 'toggle-submenu'
		},

		init: function( el, options ) {
			var menu = this,
				doCallback = true, // Window resize throttle flag.
				mo;

			menu.el = $(el);
			menu.isTouch = false;
			mo = menu.options = $.extend( {}, menu.options, options );


	// Check for device touch support.
			// This code doesn't work for whatever reason - breaks iOS
			// So, we will use the force Android to mobile

			//if ('ontouchstart' in document.documentElement ) {
			//	menu.isTouch = true;
			//	menu.el.removeClass(mo.hoverClass);
			//}

			// Initialize the menu container.
			menu.initContainer();

			// Initialize the toggle button.
			menu.initToggleButton();


			menu.el.addClass(mo.arrowClass)
				.find('ul').parent().addClass(mo.hasSubmenuClass)
				.children('a').attr( 'aria-haspopup', true ).append('<span class="' + mo.toggleSubmenuClass + '"></span>'); // prepend/append
			

			// Catch click events on submenu toggle handlers.
			menu.el.on('click', '.' + mo.toggleSubmenuClass, function( e ) {
				if ( menu.el.hasClass( mo.mobileClass ) ) {
					e.preventDefault();
					menu.toggleSubmenu( this );
				}
			});

			// Initialize the mobile menu.
			menu.toggleMobile();

			// User resizeX lib to handle menu resizing

			$('#wrapper').resizeX(function() { menu.toggleMobile();});

			/* original resizer via timer

			// Throttle the resize event.
			$(window).on('resize', function() {
				if ( doCallback ) {
					doCallback = false;

					setTimeout( function() {
						menu.toggleMobile();
						doCallback = true;
					}, 150 );
				}
			});
			*/
		},

		/**
		 * Select or create a container around the menu.
		 *
		 * The menu container is used for determining the width of the menu when
		 * it's hidden as well as to provide a context for inserting a toggle
		 * button if one doesn't already exist.
		 */
		initContainer: function() {
			// Select the toggle button.
			this.container = this.el.closest('.wvrx-menu-container');

			// Automatically add a container div if one doesn't exist.
			if ( this.container.length < 1 ) {
				this.container = this.el.wrap('<div class="wvrx-menu-container"></div>').parent();
			}
		},

		/**
		 * Select or create a mobile toggle button.
		 *
		 * The mobile toggle button will show or hide the menu when it's in a
		 * mobile state.
		 */
		initToggleButton: function() {
			var menu = this,
				mo = menu.options;

			// Select the toggle button.
			menu.toggleButton = $('#' + mo.toggleButtonID );

			// Automatically insert a toggle button icon - dashicon
			if ( menu.toggleButton.length < 1 ) {
				if ( !mo.hideToggle )
					menu.toggleButton = menu.container.prepend('<div id="' + mo.toggleButtonID + '" class="menu-toggle-button genericon genericon-wvrx-menu" alt="open menu"></div>').find('#' + mo.toggleButtonID).hide();
				else
					menu.toggleButton = menu.container.find('#' + mo.toggleButtonID).hide();
			}

			// Add listener to the menu toggle button.
			menu.toggleButton.on('click', function(){
				menu.el.toggleClass(mo.hideMobileClass);
			});
		},

		/**
		 * Toggle the menu's mobile state depending on the width of the viewport.
		 *
		 */
		toggleMobile: function() {
			var mo = this.options,
				width = 0;
			width = weaverxBrowserWidth();


			// Check if viewport width is less than the mobile breakpoint setting and the mobile menu is not displayed yet.
			if ( (width < mo.mobileBreakpoint) && !this.el.hasClass(mo.mobileClass) ) {
				// Show the menu toggle button.
				this.toggleButton.show();
				//this.toggleButton.css('display', 'inline');

				// Add the mobile class to the menu element.
				this.el.addClass(mo.mobileClass).addClass(mo.hideMobileClass).removeClass(mo.hoverClass);
			}


			// Check if viewport width is greater than the mobile breakpoint setting and the mobile menu is still displayed.
			if ( width >= mo.mobileBreakpoint && this.el.hasClass(mo.mobileClass) ) {
				// Hides mobile menu toggle button
				this.toggleButton.hide();

				// Remove hide mobile class to ensure menu is never hidden in desktop view.
				this.el.removeClass(mo.hideMobileClass).removeClass(mo.mobileClass);

				// Check for lack of touch support.
				if ( ! this.isTouch ) {
					// Add the hover class and remove any left over open submenu classes.
					this.el.addClass(mo.hoverClass).find('.' + mo.openSubmenuClass).removeClass(mo.openSubmenuClass);
				}
			}
		},


		/**
		 * Toggle the visibility of a submenu.
		 *
		 * @param {object} menuItem Submenu HTML element.
		 */
		toggleSubmenu: function( menuItem ) {
			var mo = this.options,
				submenu = $(menuItem).closest('.' + mo.hasSubmenuClass);

			// Toggle the submenu open class and remove from any other submenus at the same level.
			submenu.toggleClass(mo.openSubmenuClass).parent().find('.' + mo.openSubmenuClass).not(submenu).removeClass(mo.openSubmenuClass);
		}
	};

	/**
	 * Add responsive menu support to jQuery.
	 *
	 * @param object settings The settings for this menu (options, custom class names, etc.).
	 */
	$.fn.thmfdnMenu = function( settings ) {
		return this.each(function() {
			var menu = Object.create(Menu);
			menu.init( this, settings );
		});
	};
})( jQuery, window );



/* ------------------------------------------------------
 Fix drop-down menus for Android devices

Credits: Based on:Marco Chiesi - Black Studio Touch Dropedown Menu plugin - www.blackstudio.it
	Originally partially inspired by the one from Ross McKay found here
http://snippets.webaware.com.au/snippets/make-css-drop-down-menus-work-on-touch-devices/
*/


(function($) {
	/* Detect device in use  */
	if (wvrxOpts.useSmartMenus != '0')
		return;

	var weaverx_isTouch = ("ontouchstart" in window)
		|| (navigator.MaxTouchPoints > 0)
		|| (navigator.msMaxTouchPoints > 0);
	var weaverx_isIOS5 = /iPad|iPod|iPhone/.test(navigator.platform) && "matchMedia" in window;
	var weaverx_touch_dropdown_menu_apply = weaverx_isTouch || weaverx_isIOS5; //&& ! weaverx_isIOS5;
	var selector = 'li:has(ul) > a';                    // set these to work with weaver x
	var selector_leaf = 'li li li:not(:has(ul)) > a';


	/* Apply dropdown effect on first click */
	if (weaverx_touch_dropdown_menu_apply && weaverxBrowserWidth() > 767) { // don't need if mobile menu
	$(document).ready(function(){
		$(selector).each(function() {
			var $this = $(this);

			// Fix for IE
			//$this.attr( 'aria-haspopup', true );

			// Initial setting to handle first click
			$this.data('dataNoclick', false);

			// Touch Handler
			$this.bind('touchstart', function() {

				var noclick = !($this.data('dataNoclick'));
				$(selector).each(function(){
					$(this).data('dataNoclick', false);
				});
				$this.data('dataNoclick', noclick);
				$this.focus();
			}); // end touchstart

			// Click Handler
			$this.bind('click', function(event){
				if ($this.data('dataNoclick')) {
					event.preventDefault();
				}
				$this.focus();
			}); // end click
		}); // end each

		// Fix for 3rd+ level menus not working in some circumstances
		$(selector_leaf).each(function(){
			$(this).bind('touchstart', function(){
				window.location = this.href;
			}); // end touchstart
		}); // end each

	}); // end ready
	} //end if
})(jQuery); // end self-invoked wrapper function



function weaverxOnResize() {
	// this function is called on initial window load, and again on resizes
	var width;
	if ( typeof( wvrxOpts.menuAltswitch ) == 'undefined' || wvrxOpts.menuAltswitch == null )
		wvrxOpts.menuAltswitch = 767;
	width = weaverxBrowserWidth();

	if ( width <= wvrxOpts.menuAltswitch ) {		// check for switch point for changing mobile menu
		jQuery('body').addClass("is-menu-mobile");
		jQuery('body').removeClass("is-menu-desktop");
	} else {
		jQuery('body').addClass("is-menu-desktop");
		jQuery('body').removeClass("is-menu-mobile");
	}
	if (wvrxOpts.menuAltswitch <= 767 && width > wvrxOpts.menuAltswitch ) {
		jQuery('body').removeClass("is-menu-default"); // remove class for space where needs to say full
	}
	if (width > 767 )
		jQuery('body').addClass('is-menu-default');



	var device = 'is-desktop';

	// do things when we resize
	if ( width >= 768 ) {       // on the desktop
		jQuery('body').removeClass("is-phone is-smalltablet is-mobile");
		device = 'is-desktop';
	} else if ( width > 580 ) { // small tablet
		jQuery('body').removeClass("is-phone is-desktop");
		device = 'is-smalltablet is-mobile';
	} else {                    // phone
		jQuery('body').removeClass("is-desktop is-smalltablet");
		device = 'is-phone is-mobile';
	}


	/*if ( width >= menuTrigger ) {
		jQuery('body').removeClass("menu-mobile");
		device = device + ' menu-desktop';
	} else {
		jQuery('body').removeClass("menu-desktop");
		device = device + ' menu-mobile';
	} */

	var agent = navigator.userAgent;
	if ( agent.match(/iPad/i) || agent.match( /iPhone/i ) || agent.match( /iPod/i ) ) {
		device = device + ' is-ios';
		if ( agent.match(/iPad/i) )
			device = device + ' is-ipad';
		if ( agent.match(/iPod/i) )
			device = device + ' is-ipod';
		if ( agent.match(/iPhone/i) )
			device = device + ' is-iphone';
	}

	if ( agent.match( /Android/i ) )
		device = device + ' is-android';

	if (agent.match(/Windows/i))
		device = device + ' is-windows';
	if (agent.match(/Intel Mac OS X/i))
		device = device + ' is-macos';

	jQuery('body').addClass(device);
	// jQuery('#monitor-device').html('Device:' + device);	// + ' / Agent: ' + agent);
};



// handle mobile menus...

jQuery(function($) {
	/* var triggerPrimary = '768';
	var triggerSecondary = '768';

	if ( wvrxOpts.menuPrimaryTrigger < '768')  {
		triggerPrimary = wvrxOpts.menuPrimaryTrigger;
	}
	if (wvrxOpts.menuSecondaryTrigger  < '768') {
		triggerSecondary = wvrxOpts.menuSecondaryTrigger;
	} */

	$('.wrapper').resizeX(weaverxOnResize);
	if (wvrxOpts.useSmartMenus == '0') {			// SmartMenus handled inline
		$('#nav-primary .weaverx-theme-menu').thmfdnMenu({
			toggleButtonID: 'primary-toggle-button'
		});

		$('#nav-secondary .weaverx-theme-menu').thmfdnMenu({
			toggleButtonID: 'secondary-toggle-button'
		});
	}
});
