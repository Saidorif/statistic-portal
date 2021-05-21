import {AirportinfoService} from "../services/airportinfo.service";

const state = {
	airportinfos: {},
	airportinfolist: [],
	message: [],
	airportinfo: [],
};

const getters = {
	getAirportList(state){
		return state.airportinfolist
	},
	getAirports(state){
		return state.airportinfos
	},
	getMassage(state){
		return state.message
	},
	getAirport(state){
		return state.airportinfo
	},
};


const actions = {
	async actionAirportList({commit},page){
		try {
			const airportinfo =  await AirportinfoService.airportinfoList(page);
			await commit('setAirportList',airportinfo.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAirports({commit},page){
		try {
			const airportinfo =  await AirportinfoService.allairportinfos(page);
			await commit('setAirports',airportinfo.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddAirport({commit},payload){
		try {
			const airportinfo =  await AirportinfoService.addairportinfo(payload);
			await commit('setMessage',airportinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditAirport({commit},id){
		try {
			const airportinfo =  await AirportinfoService.editairportinfo(id);
			await commit('setEditAirport',airportinfo.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateAirport({commit},payload){
		try {
			const airportinfo =  await AirportinfoService.updateairportinfo(payload);
			await commit('setMessage',airportinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteAirport({commit},id){
		try {
			const airportinfo =  await AirportinfoService.deleteairportinfo(id);
			await commit('setMessage',airportinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeletePlaneType({commit},id){
		try {
			const airportinfo =  await AirportinfoService.deleteplanetype(id);
			await commit('setMessage',airportinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteAviaCity({commit},id){
		try {
			const airportinfo =  await AirportinfoService.deleteaviacity(id);
			await commit('setMessage',airportinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteAirportcode({commit},id){
		try {
			const airportinfo =  await AirportinfoService.deleteairportcode(id);
			await commit('setMessage',airportinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteAirportway({commit},id){
		try {
			const airportinfo =  await AirportinfoService.deleteairportway(id);
			await commit('setMessage',airportinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteAirportrecon({commit},id){
		try {
			const airportinfo =  await AirportinfoService.deleteairportrecon(id);
			await commit('setMessage',airportinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setAirportList(state, airportinfolist){
		state.airportinfolist = airportinfolist
	},
	setAirports(state, airportinfos){
		state.airportinfos = airportinfos
	},
	setMessage(state, message){
		state.message = message
	},
	setEditAirport(state, airportinfo){
		state.airportinfo = airportinfo
	},
};

export const airportinfo = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
