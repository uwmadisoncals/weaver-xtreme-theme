( function( $ ) {

	var WVRXsr = {

		init: function()
		{
			$( 'input[name=wvrx_save]' ).on( 'click', WVRXsr._export );
			$( 'input[name=wvrx_save_all]' ).on( 'click', WVRXsr._exportall );
			$( 'input[name=wvrx_restore]' ).on( 'click', WVRXsr._import );
			$( 'input[name=wvrx_save_xplus]' ).on( 'click', WVRXsr._exportxplus );
			$( 'input[name=wvrx_select_subtheme]' ).on( 'click', WVRXsr._loadtheme );
		},

		_export: function()
		{
			window.location.href = WVRXConfig.customizerURL + '?wvrx_save=' + WVRXConfig.exportNonce;
		},

		_exportall: function()
		{
			window.location.href = WVRXConfig.customizerURL + '?wvrx_save_all=' + WVRXConfig.exportNonce;
		},

		_exportxplus: function()
		{
			window.location.href = WVRXConfig.customizerURL + '?wvrx_save_xplus=' + WVRXConfig.exportNonce;
		},

		_import: function()
		{
			var win			= $( window ),
				body		= $( 'body' ),
				form		= $( '<form class="wvrx-form" method="POST" enctype="multipart/form-data" ></form>' ),
				controls	= $( '.wvrx-settings-restore-controls' ),
				file		= $( 'input[name=wvrx-settings-restore-file]' ),
				message		= $( '.wvrx-uploading' );

			if ( '' == file.val() ) {
				alert( WVRXl10n.emptyImport );
			}
			else {
				win.off( 'beforeunload' );
				body.append( form );
				form.append( controls );
				message.show();
				form.submit();
			}
		},

		_loadtheme: function()
		{
			var win			= $( window ),
				body		= $( 'body' ),
				form		= $( '<form class="wvrx-form-subtheme" method="POST" enctype="multipart/form-data" ></form>' ),
				controls	= $( '.wvrx-settings-load-subtheme' ),
				message		= $( '.wvrx-uploading' );


				win.off( 'beforeunload' );
				body.append( form );
				form.append( controls );
				message.show();
				form.submit();

		}

	};

	$( WVRXsr.init );

})( jQuery );
