import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)
import {TokenService} from './services/storage.service'
import {ability} from "./store/store";
import store from "./store/store";

// Dashboard component
import Dashboard from './components/admin/Dashboard'
import Admin from './components/admin/layouts/Admin'
import Login from './components/auth/login'
import Profile from './components/admin/user/Profile'

// Employee
import Employee from './components/admin/employee/Employee'
import AddEmployee from './components/admin/employee/AddEmployee'
import EditEmployee from './components/admin/employee/EditEmployee'

// Region
import Region from './components/admin/region/Region'
import AddRegion from './components/admin/region/AddRegion'
import EditRegion from './components/admin/region/EditRegion'

// Bus
import Bus from './components/admin/bus/Bus'
import AddBus from './components/admin/bus/AddBus'
import EditBus from './components/admin/bus/EditBus'

// Role
import Role from './components/admin/role/Role'
import AddRole from './components/admin/role/AddRole'
import EditRole from './components/admin/role/EditRole'
import Permission from './components/admin/permission/Permission'

// Position
import Position from './components/admin/position/Position'
import AddPosition from './components/admin/position/AddPosition'
import EditPosition from './components/admin/position/EditPosition'

// controller
import Conts from './components/admin/conts/Conts'
import AddConts from './components/admin/conts/AddConts'
import EditConts from './components/admin/conts/EditConts'

// action
import Action from './components/admin/action/Action'
import AddAction from './components/admin/action/AddAction'
import EditAction from './components/admin/action/EditAction'

// country
import Country from './components/admin/country/Country'


// VedGroup
import VedGroup from './components/admin/vedgroup/VedGroup'
import EditVedGroup from './components/admin/vedgroup/EditVedGroup'
import AddVedGroup from './components/admin/vedgroup/AddVedGroup'

// Customs
import Customs from './components/admin/customs/Customs'
import EditCustoms from './components/admin/customs/EditCustoms'
import AddCustoms from './components/admin/customs/AddCustoms'

// Customs
import ReportByCountry from './components/admin/reports/ReportByCountry'
import ReportByProduct from './components/admin/reports/ReportByProduct'
import ShowReportByProduct from './components/admin/reports/ShowReportByProduct'

// NotFound
import NotFound from './components/NotFound/NotFound'
const router = new Router({
	mode: 'history',
	base: process.env.BASE_URL,
	linkActiveClass: 'active',
	routes: [
		// public components
		{
			path:'/crm',
			name:'crm',
			redirect:'/crm/dashboard',
			meta:{
				requiredAuth:true
			},
			component:Admin,
			children:[
				{
					path:'dashboard',
					component:Dashboard,
					// meta:{
					// 	action:'index',
					// 	subject:'IndexController'
					// }
				},
				{
					path:'profile',
					component:Profile,
				},
				{
					path:'employee',
					component:Employee,
				},
				{
					path:'employee/add',
					component:AddEmployee,
				},
				{
					path:'employee/edit/:employeeId',
					component:EditEmployee,
				},
				{
					path:'role',
					component:Role,
				},
				{
					path:'role/add',
					component:AddRole,
				},
				{
					path:'role/edit/:roleId',
					component:EditRole,
				},
				{
					path:'role/:roleId',
					component:Permission,
				},
				{
					path:'position',
					component:Position,
				},
				{
					path:'position/add',
					component:AddPosition,
				},
				{
					path:'position/edit/:positionId',
					component:EditPosition,
				},
				{
					path:'region',
					component:Region,
				},
				{
					path:'region/add',
					component:AddRegion,
				},
				{
					path:'region/edit/:regionId',
					component:EditRegion,
				},
				{
					path:'bus',
					component:Bus,
				},
				{
					path:'bus/add',
					component:AddBus,
				},
				{
					path:'bus/edit/:busId',
					component:EditBus,
				},
				{
					path:'conts',
					component:Conts,
				},
				{
					path:'conts/add',
					component:AddConts,
				},
				{
					path:'conts/edit/:contId',
					component:EditConts,
				},
				{
					path:'action',
					component:Action,
				},
				{
					path:'action/add',
					component:AddAction,
				},
				{
					path:'action/edit/:actionId',
					component:EditAction,
				},
				{
					path:'country',
					component:Country,
				},
				{
					path:'vedgroup',
					component:VedGroup,
				},
				{
					path:'vedgroup/edit/:vedgroupId',
					component:EditVedGroup,
				},
				{
					path:'vedgroup/add',
					component:AddVedGroup,
				},
				{
					path:'customs-import-export',
					component:Customs,
				},
				{
					path:'customs-import-export/edit/:customsId',
					component:EditCustoms,
				},
				{
					path:'customs-import-export/add',
					component:AddCustoms,
				},
				{
					path:'report-by-country',
					component:ReportByCountry,
				},
				{
					path:'report-by-product',
					component:ReportByProduct,
				},
				{
					path:'report-by-product/show/:dataId',
					component:ShowReportByProduct,
				},
			]
		},
		{
			path:'/',
			name:'login',
			components:{
				default:Login,
			},
		},
		{
			path:'*',
			name:'notfound',
			components:{
				default:NotFound,
			},
		}
	]
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiredAuth)) {
  	const loggedIn = TokenService.getToken();
    if (!loggedIn || loggedIn == 'undefined'){
      next({
        path: '/',
        query: { redirect: to.fullPath }
      })
    } else {
    // 	if (TokenService.getCurrentUser().role.name != 'admin') {
		 	// const checkPerm = to.matched.some(route => {
			 //    return ability.can(route.meta.action, route.meta.subject)
		  // 	})
		  // 	if (!checkPerm) {
			 //    return next('/notfound')
		  // 	}
    // 	}
      	next()
    }
  } else {
    next()
  }
})

export default router;
