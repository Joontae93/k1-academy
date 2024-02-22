import React from '@wordpress/element';
import {
	useBlockProps,
	InspectorControls,
	RichText,
} from '@wordpress/block-editor';
import {
	PanelBody,
	PanelRow,
	SelectControl,
	TextControl,
} from '@wordpress/components';
import * as icon from './icon-set';

export default function EditComponent( {
	attributes,
	setAttributes,
	isSelected,
} ) {
	const { background, color, icon, link, text } = attributes;
	const blockProps = useBlockProps( {
		style: {
			background: background,
			color: color,
		},
		className: 'k1-icon',
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title="Icon" initialOpen={ true }>
					<PanelRow>
						<div style={ { width: '100%' } }>
							<SelectControl
								label="K1 Icon"
								value={ icon }
								options={ [
									{ label: 'Academy', value: 'academy' },
									{ label: 'Finance', value: 'finance' },
									{ label: 'HR', value: 'hr' },
									{ label: 'Justice', value: 'justice' },
									{ label: 'Marcom', value: 'marcom' },
									{ label: 'Spark', value: 'spark' },
									{ label: 'Staffing', value: 'staffing' },
									{ label: 'Strategy', value: 'strategy' },
									{ label: 'Web Dev', value: 'webDev' },
								] }
								onChange={ ( icon ) =>
									setAttributes( { icon: icon } )
								}
							/>
							<TextControl
								className="k1-icon__link-box"
								label="icon link:"
								value={ link }
								onChange={ ( link ) =>
									setAttributes( { link } )
								}
							/>
						</div>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<div className="k1-icon__container">{ getIcon( icon ) }</div>
				<RichText
					className="k1-icon__text"
					value={ text }
					placeholder="Icon Text"
					onChange={ ( text ) => setAttributes( { text } ) }
					tag="span"
				/>
			</div>
		</>
	);
}

export function getIcon( iconName ) {
	switch ( iconName ) {
		case 'academy':
			return icon.academy;
		case 'finance':
			return icon.finance;
		case 'hr':
			return icon.hr;
		case 'justice':
			return icon.justice;
		case 'marcom':
			return icon.marcom;
		case 'spark':
			return icon.sparkMono;
		case 'staffing':
			return icon.staffing;
		case 'strategy':
			return icon.strategy;
		case 'webDev':
			return icon.webDev;
	}
}
