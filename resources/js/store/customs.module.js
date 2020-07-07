import {CustomsService} from "../services/customs.service";

const state = {
	message: [],
	excelList: {}
};

const getters = {
	getMassage(state){
		return state.message
	},
	getExcelList(state){
		return state.excelList
	},
};


const actions = {
	async actionImportExcel({commit},payload){
		try {
			const exData =  await CustomsService.importExcel(payload);
			await commit('setMessage',exData.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionImportExcelList({commit}, payload){
		try {
			const exData =  await CustomsService.importExcelList(payload);
			await commit('setExcelList',exData.data.result)
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
	setExcelList(state, excelList){
		state.excelList = excelList
	},
};

export const customs = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
