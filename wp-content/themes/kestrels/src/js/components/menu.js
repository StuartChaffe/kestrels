jQuery(document).ready(function( $ ) {
	$( ".mobile-menu__nav .mobile-nav__item--parent > a" ).each(function(i) {
		const $link = $(this);
		const $submenu = $link.siblings('.mobile-nav__sub-menu');
		const submenuId = 'mobile-submenu-' + i;

		$submenu.attr('id', submenuId);

		const $toggle = $('<button>', {
			type: 'button',
			class: 'dropdown-button',
			'aria-expanded': 'false',
			'aria-controls': submenuId,
			'aria-label': 'Toggle ' + $link.text().trim() + ' submenu',
		}).append($('<span>', { 'aria-hidden': 'true', class: 'dropdown-button__icon' }));

		$link.after($toggle);
	});

	$('.dropdown-button').on('click', function() {
		const $button = $(this);
		const isActive = $button.hasClass('is-active');

		$button.toggleClass('is-active', !isActive);
		$button.attr('aria-expanded', String(!isActive));

		if (isActive) {
			$button.next('.mobile-nav__sub-menu').slideUp('normal');
		} else {
			$button.next('.mobile-nav__sub-menu').slideDown('normal');
		}
	});
});

document.addEventListener('DOMContentLoaded', function() {
	// Get all navigation links
	const navLinks = document.querySelectorAll('.site-header__nav a, .mobile-menu__nav a');

	navLinks.forEach(link => {
		link.addEventListener('click', function(e) {
			const href = this.getAttribute('href');
			const currentPath = window.location.pathname;

			// Check if link contains an anchor (#) and we're on the home page
			if (href && href.includes('#') && (currentPath === '/' || currentPath === '')) {
				const linkPath = href.split('#')[0];

				// If the link is to the current page (home) with an anchor
				if (linkPath === '' || linkPath === '/' || linkPath === window.location.origin + '/' || linkPath === window.location.origin) {
					e.preventDefault();
					// Reload the page with the anchor
					window.location.href = href;
					window.location.reload();
				}
			}
		});
	});
});
