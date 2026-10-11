'use strict';

/**
 * Toggle script that is useful for showing navigation, modals, etc.
 *
 * The following data attributes are supported:
 *
 * data-toggle
 * data-toggle-class
 * data-toggle-body-class
 * data-toggle-read-more (true/false)
 * data-toggle-more-text
 * data-toggle-less-text
 */

(function () {
	const elements = document.querySelectorAll('[data-toggle]');
	
	if (elements.length === 0) {
		return false;
	}
	
	elements.forEach(element => {
		const targetElement = document.querySelector(element.dataset.toggle);
	
		if (!targetElement) {
			return;
		}
		
		const bodyClass = element.dataset.toggleBodyClass;
		const readMore = element.dataset.toggleReadMore;
		const toggleClass = element.dataset.toggleClass || 'is-toggled';
		const moreText = element.dataset.toggleMoreText || 'Read more';
		const lessText = element.dataset.toggleLessText || 'Read less';

		element.addEventListener('click', () => {
			const isToggled = element.classList.contains(toggleClass);
			targetElement.classList.toggle(toggleClass);
			element.classList.toggle(toggleClass);

			if(readMore) {
				element.innerHTML = isToggled ? moreText : lessText;
			}
			
			element.setAttribute('aria-expanded', isToggled ? 'false' : 'true');
			targetElement.setAttribute('aria-hidden', isToggled ? 'true' : 'false');
			
			if (bodyClass) {
				document.body.classList.toggle(bodyClass);
			}
		}, false);
	});
}());
