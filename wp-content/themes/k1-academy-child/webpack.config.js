const Dotenv = require('dotenv-webpack');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
	...defaultConfig,
	plugins: [...defaultConfig.plugins, new Dotenv()],
};
