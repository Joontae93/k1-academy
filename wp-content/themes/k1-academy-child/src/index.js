import '../sass/main.scss';
import '../node_modules/core-js';
import '../node_modules/regenerator-runtime';
import { dashboardControl } from './modules/studentDashboard';
import { myCopyright } from './modules/utilities';
import { controller as customSalesApp } from './modules/customSalesForm/controller';

function init() {
	myCopyright('Kingdom One');
	dashboardControl();
	if (window.location.pathname === '/sales/') customSalesApp.init();
}
init();
