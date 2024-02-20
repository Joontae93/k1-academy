import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import block from './block.json';
import { icon } from '../block-icon';

registerBlockType( block.name, {
	title: block.title,
	icon: {
		src: icon,
		background: 'white',
	},
	description: block.description,
	edit: () => {
		const blockProps = useBlockProps();
		return (
			<div { ...blockProps }>
				<InnerBlocks />
			</div>
		);
	},
	save: () => {
		const blockProps = useBlockProps.save( {
			className: 'container',
		} );
		return (
			<div { ...blockProps }>
				<InnerBlocks.Content />
			</div>
		);
	},
} );
