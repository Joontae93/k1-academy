import Swiper from 'swiper';
import { A11y, Navigation } from 'swiper/modules';
import 'swiper/scss';
import 'swiper/scss/navigation';
import 'swiper/scss/a11y';
import './index.scss';
import { SwiperOptions } from 'swiper/types/swiper-options';

export function initCourseSwiper( el?: HTMLElement, id?: string ) {
	const swiperOptions = {
		modules: [ Navigation, A11y ],
		spaceBetween: 20,
		slidesPerView: 4,
		slidesPerGroup: 4,
		navigation: {
			nextEl: `${
				id && `.swiper-button-${ id }-next`
			} .swiper-button-next`,
			prevEl: `${
				id && `.swiper-button-${ id }-prev`
			} .swiper-button-prev`,
		},
	} as SwiperOptions;
	const swiperEl =
		el || document.querySelectorAll( '.k1-block-courses-swiper' )!;
	if ( ! swiperEl ) {
		return;
	}
	if ( swiperEl instanceof NodeList ) {
		if ( swiperEl.length === 0 ) {
			return;
		}
		swiperEl.forEach( ( el ) => {
			initCourseSwiper( el as HTMLElement );
		} );
	}
	const swiper = new Swiper( swiperEl as HTMLElement, swiperOptions );
}
document.addEventListener( 'DOMContentLoaded', () => {
	initCourseSwiper();
} );
