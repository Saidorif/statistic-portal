import {AirportnameService} from "../services/airportname.service";

const state = {
	airportnames: {},
	airportnamelist: [],
	message: [],
	airportname: [],
};

const getters = {
	getAirportnameList(state){
		return state.airportnamelist
	},
	getAirportnames(state){
		return state.airportnames
	},
	getMassage(state){
		return state.message
	},
	getAirportname(state){
		return state.airportname
	},
};


const actions = {
	async actionAirportnameList({commit},page){
		try {
			const airportnames =  await AirportnameService.airportnameList(page);
			await commit('setAirportnameList',airportnames.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAirportnames({commit},page){
		try {
			const airportnames =  await AirportnameService.allairportnames(page);
			await commit('setAirportnames',airportnames.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddAirportname({commit},payload){
		try {
			const airportnames =  await AirportnameService.addairportname(payload);
			await commit('setMessage',airportnames.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditAirportname({commit},id){
		try {
			const airportnames =  await AirportnameService.editairportname(id);
			await commit('setEditAirportname',airportnames.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateAirportname({commit},payload){
		try {
			const airportname =  await AirportnameService.updateairportname(payload);
			await commit('setMessage',airportname.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteAirportname({commit},id){
		try {
			const airportname =  await AirportnameService.deleteairportname(id);
			await commit('setMessage',airportname.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setAirportnameList(state, airportnamelist){
		state.airportnamelist = airportnamelist
	},
	setAirportnames(state, airportnames){
		state.airportnames = airportnames
	},
	setMessage(state, message){
		state.message = message
	},
	setEditAirportname(state, airportname){
		state.airportname = airportname
	},
};

export const airportname = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
