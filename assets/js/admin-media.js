( function ( $ ) {
	'use strict';

	var frame;
	var $logoId = $( '#sll-custom-logo-id' );
	var $preview = $( '#sll-logo-preview-image' );
	var $previewContainer = $( '.sll-logo-preview' );
	var $empty = $( '#sll-logo-preview-empty' );
	var $remove = $( '#sll-remove-logo' );
	var $backgroundControl = $( '#sll-background-control' );
	var $backgroundEnabled = $( '#sll-background-enabled' );
	var $backgroundColor = $( '#sll-background-color' );

	function selectedSource() {
		return $( 'input[name="sll_options[logo_source]"]:checked' ).val();
	}

	function updatePreview() {
		var url = selectedSource() === 'custom' ? $logoId.attr( 'data-custom-logo-url' ) : sllAdmin.siteLogoUrl;

		if ( url ) {
			$preview.attr( 'src', url ).prop( 'hidden', false );
			$empty.prop( 'hidden', true );
		} else {
			$preview.attr( 'src', '' ).prop( 'hidden', true );
			$empty.text( sllAdmin.noLogoText ).prop( 'hidden', false );
		}
	}

	function updateBackgroundPreview( color ) {
		var selectedColor = color || $backgroundColor.val();
		var isEnabled = $backgroundEnabled.prop( 'checked' );

		$backgroundControl.toggleClass( 'sll-background-control--disabled', ! isEnabled );
		$previewContainer.css( 'background-color', isEnabled ? selectedColor : '' );
	}

	$backgroundColor.wpColorPicker( {
		change: function ( event, ui ) {
			updateBackgroundPreview( ui.color.toString() );
		},
		clear: function () {
			updateBackgroundPreview( $backgroundColor.data( 'default-color' ) );
		}
	} );

	$( '#sll-select-logo' ).on( 'click', function ( event ) {
		event.preventDefault();

		if ( frame ) {
			frame.open();
			return;
		}

		frame = wp.media( {
			title: sllAdmin.frameTitle,
			button: { text: sllAdmin.frameButton },
			library: { type: 'image' },
			multiple: false
		} );

		frame.on( 'select', function () {
			var attachment = frame.state().get( 'selection' ).first().toJSON();
			var previewUrl = attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;

			$logoId.val( attachment.id ).attr( 'data-custom-logo-url', previewUrl );
			$( 'input[name="sll_options[logo_source]"][value="custom"]' ).prop( 'checked', true );
			$remove.prop( 'hidden', false );
			updatePreview();
		} );

		frame.open();
	} );

	$remove.on( 'click', function ( event ) {
		event.preventDefault();
		$logoId.val( '0' ).attr( 'data-custom-logo-url', '' );
		$remove.prop( 'hidden', true );
		updatePreview();
	} );

	$( '#sll-logo-source input' ).on( 'change', updatePreview );
	$backgroundEnabled.on( 'change', function () {
		updateBackgroundPreview();
	} );

	updateBackgroundPreview();
} )( jQuery );
