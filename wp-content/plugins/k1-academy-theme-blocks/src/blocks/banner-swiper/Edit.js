// Gutenberg
import React, { useState, useEffect, useRef } from '@wordpress/element';
import { useBlockProps } from '@wordpress/block-editor';
import apiFetch from '@wordpress/api-fetch';
import { Spinner } from '@wordpress/components';
import { initSwiper } from './swiper';

export default function Edit() {
	const blockProps = useBlockProps();
	const [ slides, setSlides ] = useState( null );
	const [ errorMessage, setErrorMessage ] = useState( null );
	const swiper = useRef( null );

	useEffect( () => {
		apiFetch( {
			path: '/k1academy/v1/homepage-slides',
		} )
			.then( ( slides ) => {
				setSlides( slides );
			} )
			.catch( ( err ) => {
				setErrorMessage( err.message );
			} );
	}, [] );

	useEffect( () => {
		if ( slides && swiper ) {
			initSwiper( swiper.current );
		}
	}, [ swiper, slides ] );

	if ( ! slides && ! errorMessage ) return <Spinner />;
	if ( errorMessage ) {
		return (
			<div className="alert alert-danger" { ...blockProps }>
				<p>{ errorMessage }</p>
			</div>
		);
	}
	if ( slides ) {
		return (
			<div
				class="swiper"
				{ ...blockProps }
				id="homepage-banner-swiper"
				ref={ swiper }
			>
				<div className="swiper-wrapper">
					{ slides.map( ( slide ) => {
						return (
							<div className="swiper-slide" key={ slide.id }>
								<img
									src={ slide.image.src }
									alt={ slide.image.alt || slide.title }
									srcSet={ slide.image.srcSet }
									loading="lazy"
								/>
							</div>
						);
					} ) }
				</div>
				<div className="swiper-pagination homepage-swiper-pagination" />
				<div className="autoplay-progress">
					<svg viewBox="0 0 48 48">
						<circle cx="24" cy="24" r="20" />
					</svg>
				</div>
			</div>
		);
	}
}
