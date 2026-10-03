( function () {
	'use strict';

	var login = document.getElementById( 'login' );
	var navigation = document.getElementById( 'nav' );
	var backToSite = document.getElementById( 'backtoblog' );
	var wrapper;

	if ( ! login || ! navigation || ! backToSite ) {
		return;
	}

	if ( navigation.parentNode !== login || backToSite.parentNode !== login ) {
		return;
	}

	if ( login.querySelector( '.sll-login-links' ) ) {
		return;
	}

	wrapper = document.createElement( 'div' );
	wrapper.className = 'sll-login-links';

	login.insertBefore( wrapper, navigation );
	wrapper.appendChild( navigation );
	wrapper.appendChild( backToSite );
}() );
