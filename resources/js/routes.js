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
import AvtoDashboard from './components/admin/avto/Dashboard'

// Employee
import Employee from './components/admin/employee/Employee'
import AddEmployee from './components/admin/employee/AddEmployee'
import EditEmployee from './components/admin/employee/EditEmployee'

// Tender
import Tender from './components/admin/avto/tender/Tender'
import TenderByRegion from './components/admin/avto/tender/TenderByRegion'

// RegionPlan
import RegionPlan from './components/admin/avto/regionplan/RegionPlan'
import AddRegionPlan from './components/admin/avto/regionplan/AddRegionPlan'
import EditRegionPlan from './components/admin/avto/regionplan/EditRegionPlan'

// Statistic
import StatisticAll from './components/admin/avto/statistic/StatisticAll'
import Statistic from './components/admin/avto/statistic/Statistic'
import AddStatistic from './components/admin/avto/statistic/AddStatistic'
import EditStatistic from './components/admin/avto/statistic/EditStatistic'

// StatisticInternationalCargo
import StatisticInternationalCargo from './components/admin/avto/statisticinternationalcargo/StatisticInternationalCargo'
import AddStatisticInternationalCargo from './components/admin/avto/statisticinternationalcargo/AddStatisticInternationalCargo'
import EditStatisticInternationalCargo from './components/admin/avto/statisticinternationalcargo/EditStatisticInternationalCargo'

// StatisticInternationalMoney
import StatisticInternationalMoney from './components/admin/avto/statisticinternationalmoney/StatisticInternationalMoney'
import AddStatisticInternationalMoney from './components/admin/avto/statisticinternationalmoney/AddStatisticInternationalMoney'
import EditStatisticInternationalMoney from './components/admin/avto/statisticinternationalmoney/EditStatisticInternationalMoney'

// Fakt
import Fakt from './components/admin/avto/regionplan/fakt/Fakt'
import AddFakt from './components/admin/avto/regionplan/fakt/AddFakt'
import EditFakt from './components/admin/avto/regionplan/fakt/EditFakt'
import ShowFakt from './components/admin/avto/regionplan/fakt/ShowFakt'
// expectation
import Expectation from './components/admin/avto/regionplan/expectation/Expectation'
import AddExpectation from './components/admin/avto/regionplan/expectation/AddExpectation'
import EditExpectation from './components/admin/avto/regionplan/expectation/EditExpectation'

// expectation moderator
import ExpectationMod from './components/admin/avto/expectationmoderator/expectation/ExpectationMod'
import AddExpectationMod from './components/admin/avto/expectationmoderator/expectation/AddExpectationMod'
import EditExpectationMod from './components/admin/avto/expectationmoderator/expectation/EditExpectationMod'

// fakt moderator
import FaktMod from './components/admin/avto/expectationmoderator/fakt/FaktMod'
import AddFaktMod from './components/admin/avto/expectationmoderator/fakt/AddFaktMod'
import EditFaktMod from './components/admin/avto/expectationmoderator/fakt/EditFaktMod'
import ShowFaktMod from './components/admin/avto/expectationmoderator/fakt/ShowFaktMod'

// Confirmfakt
import Confirmfakt from './components/admin/avto/confirmfakt/Confirmfakt'
import AddConfirmfakt from './components/admin/avto/confirmfakt/AddConfirmfakt'
import EditConfirmfakt from './components/admin/avto/confirmfakt/EditConfirmfakt'

// Station
import Station from './components/admin/avto/station/Station'
import AddStation from './components/admin/avto/station/AddStation'
import EditStation from './components/admin/avto/station/EditStation'

// Region
import Region from './components/admin/region/Region'
import AddRegion from './components/admin/region/AddRegion'
import EditRegion from './components/admin/region/EditRegion'

// Offer
import Offerbuilding from './components/admin/avto/offerbuilding/Offerbuilding'
import AddOfferbuilding from './components/admin/avto/offerbuilding/AddOfferbuilding'
import EditOfferbuilding from './components/admin/avto/offerbuilding/EditOfferbuilding'

// Offer
import ConfirmOfferbuilding from './components/admin/avto/confirmofferbuilding/ConfirmOfferbuilding'
import AddConfirmOfferbuilding from './components/admin/avto/confirmofferbuilding/AddConfirmOfferbuilding'
import EditConfirmOfferbuilding from './components/admin/avto/confirmofferbuilding/EditConfirmOfferbuilding'

// Area
import Area from './components/admin/area/Area'
import AddArea from './components/admin/area/AddArea'
import EditArea from './components/admin/area/EditArea'

// Airportinfo
import Airportinfo from './components/admin/airportinfo/Airportinfo'
import AddAirportinfo from './components/admin/airportinfo/AddAirportinfo'
import EditAirportinfo from './components/admin/airportinfo/EditAirportinfo'

// Airportinfo
import Airportexpect from './components/admin/airportexpect/Airportexpect'
import AddAirportexpect from './components/admin/airportexpect/AddAirportexpect'
import EditAirportexpect from './components/admin/airportexpect/EditAirportexpect'

// Airportinfo
import Airportname from './components/admin/airportname/Airportname'
import AddAirportname from './components/admin/airportname/AddAirportname'
import EditAirportname from './components/admin/airportname/EditAirportname'

// reconstruction
import Reconstruction from './components/admin/avto/reconstruction/Reconstruction'
import AddReconstruction from './components/admin/avto/reconstruction/AddReconstruction'
import EditReconstruction from './components/admin/avto/reconstruction/EditReconstruction'

// confirm-reconstruction
import ConfirmReconstruction from './components/admin/avto/confirmreconstruction/ConfirmReconstruction'
import AddConfirmReconstruction from './components/admin/avto/confirmreconstruction/AddConfirmReconstruction'
import EditConfirmReconstruction from './components/admin/avto/confirmreconstruction/EditConfirmReconstruction'

// Bus
import Bus from './components/admin/avto/bus/Bus'
import AddBus from './components/admin/avto/bus/AddBus'
import EditBus from './components/admin/avto/bus/EditBus'

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
					path:'avto',
					component:AvtoDashboard,
				},
				{
					path:'tender',
					component:Tender,
				},
				{
					path:'tender/byregion/:tenderId',
					component:TenderByRegion,
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
					path:'area',
					component:Area,
				},
				{
					path:'area/add',
					component:AddArea,
				},
				{
					path:'area/edit/:areaId',
					component:EditArea,
				},
				{
					path:'airportinfo',
					component:Airportinfo,
				},
				{
					path:'airportinfo/add',
					component:AddAirportinfo,
				},
				{
					path:'airportinfo/edit/:airportinfoId',
					component:EditAirportinfo,
				},
				{
					path:'airportinfo/:airportinfoId/airportexpect',
					component:Airportexpect,
				},
				{
					path:'airportinfo/:airportinfoId/airportexpect/add',
					component:AddAirportexpect,
				},
				{
					path:'airportinfo/:airportinfoId/edit/:airportexpectId',
					component:EditAirportexpect,
				},
				{
					path:'airportname',
					component:Airportname,
				},
				{
					path:'airportname/add',
					component:AddAirportname,
				},
				{
					path:'airportname/edit/:airportnameId',
					component:EditAirportname,
				},
				{
					path:'reconstruction',
					component:Reconstruction,
				},
				{
					path:'reconstruction/add',
					component:AddReconstruction,
				},
				{
					path:'reconstruction/edit/:reconstructionId',
					component:EditReconstruction,
				},
				{
					path:'confirm-reconstruction',
					component:ConfirmReconstruction,
				},
				{
					path:'confirm-reconstruction/add',
					component:AddConfirmReconstruction,
				},
				{
					path:'confirm-reconstruction/edit/:reconstructionId',
					component:EditConfirmReconstruction,
				},
				{
					path:'offerbuilding',
					component:Offerbuilding,
				},
				{
					path:'offerbuilding/add',
					component:AddOfferbuilding,
				},
				{
					path:'offerbuilding/edit/:offerbuildingId',
					component:EditOfferbuilding,
				},
				{
					path:'confirm-offerbuilding',
					component:ConfirmOfferbuilding,
				},
				{
					path:'confirm-offerbuilding/add',
					component:AddConfirmOfferbuilding,
				},
				{
					path:'confirm-offerbuilding/edit/:offerbuildingId',
					component:EditConfirmOfferbuilding,
				},
				{
					path:'expec-mod/:expId',
					component:ExpectationMod,
				},
				{
					path:'expec-mod/:expId/add',
					component:AddExpectationMod,
				},
				{
					path:'expec-mod/:expId/edit/:expectationId',
					component:EditExpectationMod,
				},
				{
					path:'regionplan/expectation/:expectregionId',
					component:Expectation,
				},
				{
					path:'regionplan/expectation/:expectregionId/add',
					component:AddExpectation,
				},
				{
					path:'regionplan/expectation/:expectregionId/edit/:expectationId',
					component:EditExpectation,
				},
				{
					path:'expec-mod/fakt/:faktregionId',
					component:FaktMod,
				},
				{
					path:'expec-mod/fakt/:faktregionId/add',
					component:AddFaktMod,
				},
				{
					path:'expec-mod/fakt/:faktregionId/edit/:FaktId',
					component:EditFaktMod,
				},
				{
					path:'expec-mod/fakt/:faktregionId/show/:FaktId',
					component:ShowFaktMod,
				},
				{
					path:'regionplan/fakt/:faktregionId',
					component:Fakt,
				},
				{
					path:'regionplan/fakt/:faktregionId/add',
					component:AddFakt,
				},
				{
					path:'regionplan/fakt/:faktregionId/edit/:FaktId',
					component:EditFakt,
				},
				{
					path:'regionplan/fakt/:faktregionId/show/:FaktId',
					component:ShowFakt,
				},
				{
					path:'confirmfakt',
					component:Confirmfakt,
				},
				{
					path:'confirmfakt/add',
					component:AddConfirmfakt,
				},
				{
					path:'confirmfakt/edit/:confirmfaktId',
					component:EditConfirmfakt,
				},
				{
					path:'station',
					component:Station,
				},
				{
					path:'station/add',
					component:AddStation,
				},
				{
					path:'station/edit/:stationId',
					component:EditStation,
				},
				{
					path:'regionplan',
					component:RegionPlan,
				},
				{
					path:'regionplan/add',
					component:AddRegionPlan,
				},
				{
					path:'regionplan/edit/:regionplanId',
					component:EditRegionPlan,
				},
				{
					path:'statistic/all',
					component:StatisticAll,
				},
				{
					path:'statistic',
					component:Statistic,
				},
				{
					path:'statistic/add',
					component:AddStatistic,
				},
				{
					path:'statistic/edit/:statisticId',
					component:EditStatistic,
				},
				{
					path:'statisticinternationalcargo',
					component:StatisticInternationalCargo,
				},
				{
					path:'statisticinternationalcargo/add',
					component:AddStatisticInternationalCargo,
				},
				{
					path:'statisticinternationalcargo/edit/:statisticinternationalcargoId',
					component:EditStatisticInternationalCargo,
				},
				{
					path:'statisticinternationalmoney',
					component:StatisticInternationalMoney,
				},
				{
					path:'statisticinternationalmoney/add',
					component:AddStatisticInternationalMoney,
				},
				{
					path:'statisticinternationalmoney/edit/:statisticinternationalmoneyId',
					component:EditStatisticInternationalMoney,
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
