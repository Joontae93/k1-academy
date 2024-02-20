import React from '@wordpress/element';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, PanelRow, SelectControl } from '@wordpress/components';
import * as icon from './icon-set';

export default function EditComponent( { attributes, setAttributes } ) {
	const { background, color, icon } = attributes;
	const blockProps = useBlockProps();

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
									{ label: 'finance', value: 'finance' },
									{ label: 'hr', value: 'hr' },
									{ label: 'justice', value: 'justice' },
									{ label: 'marcom', value: 'marcom' },
									{ label: 'spark', value: 'spark' },
									{ label: 'staffing', value: 'staffing' },
									{ label: 'strategy', value: 'strategy' },
									{ label: 'webDev', value: 'webDev' },
								] }
								onChange={ ( icon ) =>
									setAttributes( { icon: icon } )
								}
							/>
						</div>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			<div
				{ ...blockProps }
				style={ {
					backgroundColor: background,
					color: color,
				} }
			>
				{ getIcon( icon ) }
			</div>
		</>
	);
}

function getIcon( iconName ) {
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
