import {CountryService} from "../services/country.service";

const state = {
	countries: {},
	message: [],
};

const getters = {
	getActions(state){
		return state.countries
	},
	getMassage(state){
		return state.message
	},
};


const actions = {
	async actionCountries({commit},payload){
		try {
			const countries =  await CountryService.countries(payload);
			await commit('setCountries',countries.data.result)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setCountries(state, countries){
		state.countries = countries
	},
	setMessage(state, message){
		state.message = message
	},
};

export const country = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
