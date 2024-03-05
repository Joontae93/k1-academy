import { registerBlockType } from '@wordpress/blocks';
import './index.scss';
import block from './block.json';
import Edit from './Edit';
import { icon } from '../block-icon';

registerBlockType( block.name, {
	title: block.title,
	icon: {
		src: icon,
		background: 'white',
	},
	description: block.description,
	edit: Edit,
	save: () => null,
} );
