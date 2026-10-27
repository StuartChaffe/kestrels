import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation'; // button styles only — the buttons are wired up below

// Flag slides that are fully in view so the rest can be dimmed. Swiper's own
// watchSlidesProgress misses by a fraction of a pixel with auto-width slides,
// so check against the target translate with a 1px tolerance. The target is
// worked out from progress because Swiper emits 'progress' before it updates
// swiper.translate when sliding. Slide positions are summed from their widths
// because slidesGrid is shifted when centeredSlides is on.
function markSlidesInView(swiper) {
	const min = swiper.minTranslate();
	const translate = min + swiper.progress * (swiper.maxTranslate() - min);
	let left = translate;
	swiper.slides.forEach((slide, i) => {
		const width = swiper.slidesSizesGrid[i];
		slide.classList.toggle('is-in-view', left >= -1 && left + width <= swiper.size + 1);
		left += width + swiper.params.spaceBetween;
	});
}

document.addEventListener('DOMContentLoaded', () => {

	document.querySelectorAll('.image-gallery__swiper').forEach(el => {
		// Loop mode needs enough slides either side of the centred one, which a
		// short gallery of mixed widths doesn't have — so repeat the set until it does
		const wrapper = el.querySelector('.swiper-wrapper');
		const originals = [...wrapper.children];
		while (originals.length > 1 && wrapper.children.length < 10) {
			originals.forEach(slide => {
				const clone = slide.cloneNode(true);
				clone.setAttribute('aria-hidden', 'true');
				wrapper.appendChild(clone);
			});
		}

		const swiper = new Swiper(el, {
			slidesPerView: 'auto', // slide width comes from each image's aspect ratio
			spaceBetween: 10, // keep in sync with --gallery-gap in image-gallery.scss
			breakpoints: {
				800: { spaceBetween: 15 }, // the 'medium' breakpoint (50em)
			},
			centeredSlides: true, // keep the focused image in the middle, with the neighbours either side
			loop: true, // carry on from the last image back to the first
			slideToClickedSlide: true, // click a peeking image to bring it into view
			on: {
				init: markSlidesInView,
				progress: markSlidesInView,
				resize: markSlidesInView,
			},
		});

		// Swiper's slidePrev() skips slides when looping centred, variable-width
		// slides, so step by index instead (slideToLoop handles the loop wrap)
		const step = by => swiper.slideToLoop((swiper.realIndex + by + swiper.slides.length) % swiper.slides.length);
		el.querySelector('.swiper-button-prev').addEventListener('click', () => step(-1));
		el.querySelector('.swiper-button-next').addEventListener('click', () => step(1));

		// Expose half the gallery's height so a content block can overhang it into the next block
		const gallery = el.closest('.image-gallery');
		const block = el.closest('.content-block');
		if (gallery && block) {
			new ResizeObserver(() => {
				const overhang = `${gallery.offsetHeight / 2}px`;
				block.style.setProperty('--gallery-overhang', overhang);
				block.nextElementSibling?.style.setProperty('--gallery-overhang', overhang);
			}).observe(gallery);
		}
	});

});
