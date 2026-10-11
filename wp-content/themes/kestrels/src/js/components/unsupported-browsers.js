'use strict';

(function () {

	const ua = window.navigator.userAgent;
	const msie = ua.indexOf('MSIE ');
	const trident = ua.indexOf('Trident/');
	const browserAlert = document.querySelector('.unsupported-browser');

	if ((msie > 0 || trident > 0) && browserAlert) {
		browserAlert.setAttribute('style', 'display: block;');
	}

}());
