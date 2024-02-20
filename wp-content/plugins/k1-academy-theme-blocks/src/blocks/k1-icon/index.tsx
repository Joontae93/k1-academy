import { registerBlockType } from '@wordpress/blocks';
import EditComponent from './Edit';
import block from './block.json';
import './style.scss';
import { icon } from '../block-icon';

registerBlockType( block.name, {
	title: block.title,
	edit: EditComponent,
	icon: {
		src: icon,
		background: 'white',
	},
} );
