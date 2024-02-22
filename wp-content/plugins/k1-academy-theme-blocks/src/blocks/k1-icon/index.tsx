import React from '@wordpress/element';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import EditComponent, { getIcon } from './Edit';
import block from './block.json';
import './index.scss';
import { icon } from '../block-icon';

registerBlockType( block.name, {
	title: block.title,
	edit: EditComponent,
	save: ( { attributes } ) => {
		const { background, color, icon, link, text } = attributes;
		const blockProps = useBlockProps.save( {
			style: {
				background: background,
				color: color,
			},
			className: 'k1-icon',
		} );
		return (
			<div { ...blockProps }>
				<a href={ link } className="k1-icon__link">
					<div className="k1-icon__container">
						{ getIcon( icon ) }
					</div>
					<span className="k1-icon__text">
						<RichText.Content value={ text } />
					</span>
				</a>
			</div>
		);
	},
	icon: {
		src: icon,
		background: 'white',
	},
} );
