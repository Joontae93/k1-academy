import Swiper from 'swiper';
import { Pagination, A11y, Autoplay } from 'swiper/modules';
import 'swiper/scss';
import 'swiper/scss/pagination';
import 'swiper/scss/a11y';
import 'swiper/scss/autoplay';
import './index.scss';

export function initSwiper( el?: HTMLElement ) {
	const swiperEl = el || document.getElementById( 'homepage-banner-swiper' )!;
	if ( ! swiperEl ) {
		return;
	}
	const progressCircle = document.querySelector( '.autoplay-progress svg' );
	const swiper = new Swiper( swiperEl, {
		modules: [ Pagination, A11y, Autoplay ],
		// loop: true,
		autoplay: {
			delay: 5 * 1000,
			disableOnInteraction: true,
		},
		spaceBetween: 0,
		// centeredSlides: true,
		// centeredSlidesBounds: true,
		// centerInsufficientSlides: true,
		// slidesPerView: 'auto',
		// slidesPerGroup: 1,
		pagination: {
			el: '.homepage-swiper-pagination',
			clickable: true,
		},
		on: {
			autoplayTimeLeft( s, time, progress ) {
				progressCircle.style.setProperty( '--progress', 1 - progress );
			},
		},
	} );
}
document.addEventListener( 'DOMContentLoaded', () => {
	initSwiper();
} );
