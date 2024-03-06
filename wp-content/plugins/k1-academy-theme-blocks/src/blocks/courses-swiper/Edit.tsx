// Gutenberg
import React, { useState, useEffect, useRef } from '@wordpress/element';
import {
	useBlockProps,
	InspectorControls,
	RichText,
} from '@wordpress/block-editor';
import apiFetch from '@wordpress/api-fetch';
import { Spinner, QueryControls, PanelBody } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { initCourseSwiper } from './swiper';

export default function Edit( { attributes, setAttributes } ) {
	const { label, count, categoryId } = attributes;
	const [ slides, setSlides ] = useState( null );
	const [ errorMessage, setErrorMessage ] = useState( null );
	const terms = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'taxonomy', 'course_cat', {
			per_page: 12,
		} );
	} );
	const swiper = useRef( null );

	const blockProps = useBlockProps( {
		className: `k1-block-courses-swiper swiper`,
		ref: swiper,
	} );

	useEffect( () => {
		const fetchPosts = async () => {
			const posts = await apiFetch< [] >( {
				path: `/k1academy/v1/course-slides?categories=${ categoryId }`,
			} );
			if ( posts.length > 0 ) {
				setSlides( posts );
			} else {
				setErrorMessage( 'No posts found' );
			}
		};
		if ( categoryId ) {
			fetchPosts();
		}
	}, [ categoryId, count ] );

	useEffect( () => {
		if ( slides && swiper ) {
			initCourseSwiper( swiper.current );
		}
	}, [ swiper, slides ] );

	return (
		<>
			<InspectorControls>
				<PanelBody title="Course Swiper Settings">
					<QueryControls
						numberOfItems={ count }
						onNumberOfItemsChange={ ( count ) =>
							setAttributes( { count } )
						}
						maxItems={ 12 }
						selectedCategoryId={ categoryId }
						categoriesList={ terms }
						onCategoryChange={ ( categoryId ) => {
							setAttributes( { categoryId } );
						} }
					/>
				</PanelBody>
			</InspectorControls>
			<RichText
				tagName="h2"
				value={ label }
				onChange={ ( label ) => setAttributes( { label } ) }
				placeholder={ 'Courses Category...' }
			/>
			{ ! slides && ! errorMessage && <Spinner /> }
			{ errorMessage && (
				<div className="alert alert-danger" { ...blockProps }>
					<p>{ errorMessage }</p>
				</div>
			) }
			{ slides && (
				<div { ...blockProps }>
					<div className="swiper-wrapper">
						{ slides.map( ( slide ) => {
							return (
								slide.image.src && (
									<div
										className="swiper-slide"
										key={ slide.id }
									>
										<div className="swiper-slide__container">
											<img
												className="swiper-slide__image"
												src={ slide.image.src }
												alt={
													slide.image?.alt ||
													slide.title
												}
												srcSet={
													slide.image?.srcSet || ''
												}
											/>
											<div className="swiper-slide__image--overlay" />
											<h3 className="swiper-slide__title">
												{ slide.title }
											</h3>
										</div>
									</div>
								)
							);
						} ) }
					</div>
					<div className="swiper-button-prev" />
					<div className="swiper-button-next" />
				</div>
			) }
		</>
	);
}
