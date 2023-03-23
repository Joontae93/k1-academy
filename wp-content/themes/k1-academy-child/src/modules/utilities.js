/** Shorthand for Query Selector Function.
 * @param selector {string} CSS Selector. Must include class ('.') marker if needed
 * @param  [all] {boolean} optional to call querySelectorAll.
 * @return {Element} HTML Element
 * */
export function querySelector(selector, all = false) {
	return all === false
		? document.querySelector(selector)
		: document.querySelectorAll(selector);
}

export function getElById(selector) {
	return document.getElementById(selector);
}
export function getFormVal(selector) {
	return document.getElementById(selector).value;
}
/** Outputs Copyright String to `div` with ID of 'copyright'
 * @param {string} brandName - The name of the brand that claims copyright
 * @output The HTML
 */
export function myCopyright(brandName) {
	const copyright = document.getElementById('copyright');
	copyright.innerHTML = `<p>&copy; ${k1AcademyData.year} ${brandName} All Rights Reserved.`;
}

export const API_URL = `${k1AcademyData.root_url}/wp-json/llms/v1/`;

/**
 * Makes AJAX request to LMS API. Also converts `'accessPlans'` to HTML-friedly `'access-plans.'`
 * @param {string} endpoint the endpoint url to add. *Note: should not include leading '/'*
 * @param {string} method the AJAX Method (GET, POST, DELETE, UPDATE)
 * @param {boolean} returnAll if `true`, returns an Array, else only return the `data`
 * @returns {Array|Object} `data` object or an Array containing [AJAX `res`ponse, The `data`, The `method`]
 */
export async function makeRequest(
	endpoint,
	method = 'GET',
	theData = false,
	returnAll = false,
) {
	endpoint = endpoint === 'accessPlans' ? 'access-plans' : endpoint;
	try {
		const config = {
			headers: {
				'Content-Type': 'application/json',
				'X-LLMS-CONSUMER-KEY': process.env.API_KEY,
				'X-LLMS-CONSUMER-SECRET': process.env.API_SECRET,
			},
			method: `${method}`,
			timeout: 5000,
		};
		if (theData) {
			config.body = JSON.stringify(theData);
		}
		console.log(config);
		const res = await fetch(API_URL + `${endpoint}`, config);
		const data = await res.json();
		if (!res.ok) throw new Error(`${data.message} (${res.status})`);
		return returnAll ? [res, data, method] : data;
	} catch (error) {}
}
