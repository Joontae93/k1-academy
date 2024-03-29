const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );

const THEME_NAME = 'k1-academy-child';
const THEME_DIR = `/wp-content/themes/${ THEME_NAME }`;

/**
 * For index.ts (located `~/src/js/folder-name/index.ts)`)
 * Array of strings modeled after folder names (e.g. 'about-choctaw')
 *
 * !Be sure to import page scss in these files!
 */
const appNames = [];

/**
 * For SCSS files (no leading `_`)
 * Array of strings modeled after scss names (e.g. 'we-are-choctaw')
 *  */
const styleSheets = []; // for scss only

module.exports = {
	...defaultConfig,
	...{
		entry: () => {
			return {
				// Define custom entry points here
				global: `.${ THEME_DIR }/src/index.js`,
				...addEntries( appNames, 'pages' ),
				...addEntries( styleSheets, 'styles' ),
			};
		},

		output: {
			path: __dirname + `${ THEME_DIR }/build`,
			filename: `[name].js`,
		},
	},
};

/**
 * Helper function to add entries to the entries object. It takes an array of strings in either kebab-case or snake_case and returns an object with the key as the entry name and the value as the path to the entry file.
 * @param {array} array - Array of strings
 * @param {string} type - The type of entry. Either 'pages' or 'styles'
 */
function addEntries( array, type ) {
	if ( ! Array.isArray( array ) ) {
		throw new Error( `Expecting an array, received ${ typeof array }!` );
	}
	if ( 0 >= array.length ) {
		return {};
	}
	const entries = {};
	array.forEach( ( asset ) => {
		const assetOutput = snakeToCamel( asset );
		if ( type === 'styles' ) {
			entries[
				`pages/${ assetOutput }`
			] = `.${ THEME_DIR }/src/styles/pages/${ asset }.scss`;
		} else if ( type === 'pages' ) {
			entries[
				`pages/${ assetOutput }`
			] = `.${ THEME_DIR }/src/js/${ asset }/index.ts`;
		} else {
			throw new Error(
				`Invalid type! Expected "styles" or "pages", received "${ type }"`
			);
		}
	} );
	return entries;
}
function snakeToCamel( str ) {
	return str.replace( /([-_][a-z])/g, ( group ) =>
		group.toUpperCase().replace( '-', '' ).replace( '_', '' )
	);
}
