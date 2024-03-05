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

export default function Edit( { attributes, setAttributes } ) {
	const { label, count, selectedCategoryId } = attributes;
	const [ slides, setSlides ] = useState( null );
	const [ errorMessage, setErrorMessage ] = useState( null );
	const terms = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'taxonomy', 'course_cat', {
			per_page: -1,
		} );
	} );

	const swiper = useRef( null );

	const blockProps = useBlockProps( {
		className: 'k1-block-courses-swiper swiper',
		// ref: swiper,
	} );

	useEffect( () => {
		const fetchPosts = async () => {
			const posts = await apiFetch( {
				path: `/wp/v2/course?per_page=${ count }&categories=${ selectedCategoryId }`,
			} );
			console.log( posts );
			if ( posts ) {
				setSlides( posts );
			}
		};
		fetchPosts();
	}, [ selectedCategoryId, count ] );

	return (
		<>
			<InspectorControls>
				<PanelBody
					title="Course Swiper Settings"
					style={ { width: '100%' } }
				>
					<QueryControls
						numberOfItems={ count }
						minItems={ 1 }
						maxItems={ 10 }
						onNumberOfItemsChange={ ( count ) =>
							setAttributes( { count } )
						}
						selectedCategoryId={ selectedCategoryId }
						categoriesList={ terms }
						onCategoryChange={ ( newTerm ) => {
							setAttributes( {
								selectedCategoryId: newTerm,
							} );
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
				<div { ...blockProps } id="homepage-banner-swiper">
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
				</div>
			) }
		</>
	);
}
