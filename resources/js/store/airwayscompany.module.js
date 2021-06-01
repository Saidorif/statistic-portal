import {AirwaysCompanyService} from "../services/airwayscompany.service";

const state = {
	airwayscompanys: {},
	airwayscompanylist: [],
	message: [],
	airwayscompany: [],
};

const getters = {
	getAirwaysCompanyList(state){
		return state.airwayscompanylist
	},
	getAirwaysCompanys(state){
		return state.airwayscompanys
	},
	getMassage(state){
		return state.message
	},
	getAirwaysCompany(state){
		return state.airwayscompany
	},
};


const actions = {
	async actionAirwaysCompanyList({commit},page){
		try {
			const airwayscompanys =  await AirwaysCompanyService.airwayscompanyList(page);
			await commit('setAirwaysCompanyList',airwayscompanys.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAirwaysCompanys({commit},page){
		try {
			const airwayscompanys =  await AirwaysCompanyService.allairwayscompanys(page);
			await commit('setAirwaysCompanys',airwayscompanys.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddAirwaysCompany({commit},payload){
		try {
			const airwayscompanys =  await AirwaysCompanyService.addairwayscompany(payload);
			await commit('setMessage',airwayscompanys.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditAirwaysCompany({commit},id){
		try {
			const airwayscompanys =  await AirwaysCompanyService.editairwayscompany(id);
			await commit('setEditAirwaysCompany',airwayscompanys.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateAirwaysCompany({commit},payload){
		try {
			const airwayscompany =  await AirwaysCompanyService.updateairwayscompany(payload);
			await commit('setMessage',airwayscompany.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteAirwaysCompany({commit},id){
		try {
			const airwayscompany =  await AirwaysCompanyService.deleteairwayscompany(id);
			await commit('setMessage',airwayscompany.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setAirwaysCompanyList(state, airwayscompanylist){
		state.airwayscompanylist = airwayscompanylist
	},
	setAirwaysCompanys(state, airwayscompanys){
		state.airwayscompanys = airwayscompanys
	},
	setMessage(state, message){
		state.message = message
	},
	setEditAirwaysCompany(state, airwayscompany){
		state.airwayscompany = airwayscompany
	},
};

export const airwayscompany = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
