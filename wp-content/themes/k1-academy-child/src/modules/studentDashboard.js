import { querySelector } from './utilities';

export function dashboardControl() {
	const navItems = querySelector('.llms-sd-item', true);
	navItems.forEach((el, i) => {
		if (el.children.length < 1) return;
		el.children[1].style.display = 'none';
	});
}
