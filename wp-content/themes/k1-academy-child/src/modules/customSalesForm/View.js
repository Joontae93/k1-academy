import { querySelector, getElById, getFormVal } from '../utilities';

class FormView {
	#jsNotice = getElById('jsNotice');
	#formContainer = getElById('custom-sales-form');
	#courseContainer = querySelector('.the-courses');
	constructor() {
		if (!this.#jsNotice) return;
		this.#jsNotice.innerHTML = '';
	}
	// _addHandlerCourseSelect() {
	// 	document.addEventListener('click', (ev) => {
	// 		console.log(ev.target);
	// 	});
	// }
	/**
	 * Listen for `submit` event and passes the value of `getFormData()` to the callback function
	 * @param {function} handler the callback function to fire
	 * @return {json} user-submitted form data from `getFormData()`
	 */
	addHandlerSubmit(handler) {
		this.#formContainer.addEventListener('submit', (ev) => {
			ev.preventDefault();
			handler(this.getFormData());
			// handler(this._getFormDatav2());
		});
	}
	showCourses(courses) {
		courses.forEach((course) => {
			const courseDisplay = `
			<div class="course">
				<input type="checkbox" value="${course.id}" name="${course.name}" id="${course.name}"><label>${course.name}</label>
			</div>
			`;
			this.#courseContainer.insertAdjacentHTML('afterbegin', courseDisplay);
		});
	}
	/** Callback onSubmit()
	 * @return {json} obj of data
	 */
	getFormData() {
		const form = {
			user: {},
			org: {
				employees: {},
				volunteers: {},
				get total() {
					return this.employees.ft + this.employees.pt + this.volunteers;
				},
			},
			courses: {
				ids: [],
			},
		};
		// get Form Data
		form.user.firstName = getFormVal('user-first-name');
		form.user.lastName = getFormVal('user-last-name');
		form.user.email = getFormVal('user-email');
		form.org.type = getFormVal('org-type');
		form.org.name = getFormVal('org-name');
		form.org.employees.ft = getFormVal('employee--full');
		form.org.employees.pt = getFormVal('employee--part');
		form.org.volunteers = getFormVal('volunteers');
		const theCourses = querySelector('.course', true);

		theCourses.forEach((el) => {
			const courseName = el.querySelector('label').textContent;
			const courseID = getElById(courseName);
			if (courseID.checked) form.courses.ids.push(+courseID.value);
		});
		return form;
	}
	_getFormDatav2() {
		const data = [...new FormData(this.#formContainer)];
		return data;
	}
	checkout(id) {
		window.location.href = `https://academy.kingdomone.co/checkout/?=${id}`;
	}
}
export default new FormView();
