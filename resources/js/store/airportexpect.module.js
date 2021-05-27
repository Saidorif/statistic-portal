import {AirportexpectService} from "../services/airportexpect.service";

const state = {
	airportexpects: {},
	airportexpectlist: [],
	message: [],
	airportexpect: [],
};

const getters = {
	getAirportexpectList(state){
		return state.airportexpectlist
	},
	getAirportexpects(state){
		return state.airportexpects
	},
	getMassage(state){
		return state.message
	},
	getAirportexpect(state){
		return state.airportexpect
	},
};


const actions = {
	async actionAirportexpectList({commit},page){
		try {
			const items =  await AirportexpectService.airportexpectList(page);
			await commit('setAirportexpectList',items.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAirportexpects({commit},page){
		try {
			const items =  await AirportexpectService.allairportexpects(page);
			await commit('setAirportexpects',items.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddAirportexpect({commit},payload){
		try {
			const items =  await AirportexpectService.addairportexpect(payload);
			await commit('setMessage',items.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditAirportexpect({commit},id){
		try {
			const items =  await AirportexpectService.editairportexpect(id);
			await commit('setEditAirportexpect',items.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateAirportexpect({commit},payload){
		try {
			const items =  await AirportexpectService.updateairportexpect(payload);
			await commit('setMessage',items.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteAirportexpect({commit},id){
		try {
			const items =  await AirportexpectService.deleteairportexpect(id);
			await commit('setMessage',items.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setAirportexpectList(state, airportexpectlist){
		state.airportexpectlist = airportexpectlist
	},
	setAirportexpects(state, airportexpects){
		state.airportexpects = airportexpects
	},
	setMessage(state, message){
		state.message = message
	},
	setEditAirportexpect(state, airportexpect){
		state.airportexpect = airportexpect
	},
};

export const airportexpect = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
