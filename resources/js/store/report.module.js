import {ReportService} from "../services/report.service";

const state = {
	message: [],
	reportByCoutryList: [],
	reportByProductList: [],
};

const getters = {
	getMassage(state){
		return state.message
	},
	getReportByCoutryList(state){
		return state.reportByCoutryList
	},
	getReportByProductList(state){
		return state.reportByProductList
	},
};


const actions = {
	async ActionReportByCoutryList({commit}){
		try {
			const reportByCoutryList =  await ReportService.reportByCountryListService();
			await commit('setReportByCoutryList',reportByCoutryList.data)
			return true
		} catch (error) {
			return false
		}
	},
	async ActionReportByProductList({commit}){
		try {
			const reportByCoutryList =  await ReportService.reportByProductListService();
			await commit('setReportByProductList',reportByCoutryList.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setMessage(state, message){
		state.message = message
	},
	setReportByCoutryList(state, reportByCoutryList){
		state.reportByCoutryList = reportByCoutryList
	},
	setReportByProductList(state, product){
		state.reportByProductList = product
	},
};

export const report = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
