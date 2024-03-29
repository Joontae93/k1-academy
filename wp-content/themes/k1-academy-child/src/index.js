import './styles/main.scss';
import { dashboardControl } from './js/modules/studentDashboard';
import { myCopyright } from './js/modules/utilities';

function init() {
	myCopyright( 'Kingdom One' );
	dashboardControl();
	if ( window.location.pathname === '/sales/' ) customSalesApp.init();
}
init();
