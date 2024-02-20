import { makeRequest } from '../utilities';

export const state = {
	accessPlans: [],
	courses: [],
	groups: [],
	memberships: [],
};

/** Gets LMS Course Data and adds it to state.
 * @param {string} endpoint endpoint of API
 */
export async function getCourseData(endpoint) {
	const data = await makeRequest(endpoint);
	data.forEach((el) => {
		const course = {
			id: el.id,
			link: el.permalink,
			status: el.status,
			name: el.title.rendered,
		};
		state.courses.push(course);
	});
}

/**
 * Takes an array of LMS endpoints as strings and returns the data to State.
 * [LMS Rest API Documentation](https://developer.lifterlms.com/rest-api/)
 * @param {array} lmsData the terms as strings
 */
export async function getLMSData(lmsData) {
	try {
		lmsData.forEach(async (endpoint) => {
			const data = await makeRequest(endpoint);
			data.forEach((el) => {
				switch (endpoint) {
					case 'memberships':
						const membership = {
							id: el.id,
						};
						state.memberships.push(membership);

						break;
					case 'accessPlans':
						const accessPlan = {
							id: el.id,
						};
						state.accessPlans.push(accessPlan);

						break;
					case 'groups':
						const group = {
							id: el.id,
						};
						state.groups.push(group);
				}
			});
		});
	} catch (err) {
		console.error(err);
	}
}

/**
 * 1. Destructure State
 * 2.
 */
export async function createLMSAssets() {
	console.log('Creating assets...');
	const assets = Object.entries(state);
	const jsonAsset = {};
	// Convert into single JSON Asset
	assets.forEach((asset) => {
		const [endpoint, array] = asset;
	});

	// send to WP
	const course = {
		title: 'Course created via API Request',
		content: 'This is the content of the course. It is hilariously short.',
	};
	try {
		const res = await makeRequest('courses', 'POST', course, true);
		console.log(res);
	} catch (err) {
		console.error(err);
	}
}
