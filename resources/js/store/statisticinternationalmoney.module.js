import {StatisticInternationalMoneyService} from "../services/statisticinternationalmoney.service";

const state = {
	statisticinternationalmoneys: {},
	statisticinternationalmoneylist: [],
	statisticinternationalmoney: [],
	message: [],
	mainstatisticinternationalmoneys: [],
};

const getters = {
	getStatisticInternationalMoneyList(state){
		return state.statisticinternationalmoneylist
	},
	getStatisticInternationalMoneys(state){
		return state.statisticinternationalmoneys
	},
	getMassage(state){
		return state.message
	},
	getStatisticInternationalMoney(state){
		return state.statisticinternationalmoney
	},
	getMainStatisticInternationalMoneys(state){
		return state.mainstatisticinternationalmoneys
	},
};


const actions = {
	async actionStatisticInternationalMoneyList({commit},page){
		try {
			const statisticinternationalmoneys =  await StatisticInternationalMoneyService.statisticinternationalmoneyList(page);
			await commit('setStatisticInternationalMoneyList',statisticinternationalmoneys.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionMainStatisticInternationalMoneys({commit},payload){
		try {
			const statisticinternationalmoneys =  await StatisticInternationalMoneyService.mainstatisticinternationalmoney(payload);
			await commit('setMainStatisticInternationalMoneys',statisticinternationalmoneys.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionStatisticInternationalMoneys({commit},payload){
		try {
			const statisticinternationalmoneys =  await StatisticInternationalMoneyService.allstatisticinternationalmoneys(payload);
			if(statisticinternationalmoneys.data.error){
				await commit('setMessage',statisticinternationalmoneys.data)
			}else{
				await commit('setStatisticInternationalMoneys',statisticinternationalmoneys.data.result)
			}
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddStatisticInternationalMoney({commit},payload){
		try {
			const statisticinternationalmoneys =  await StatisticInternationalMoneyService.addstatisticinternationalmoney(payload);
			await commit('setMessage',statisticinternationalmoneys.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditStatisticInternationalMoney({commit},id){
		try {
			const statisticinternationalmoneys =  await StatisticInternationalMoneyService.editstatisticinternationalmoney(id);
			await commit('setEditStatisticInternationalMoney',statisticinternationalmoneys.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateStatisticInternationalMoney({commit},payload){
		try {
			const statisticinternationalmoney =  await StatisticInternationalMoneyService.updatestatisticinternationalmoney(payload);
			await commit('setMessage',statisticinternationalmoney.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteStatisticInternationalMoney({commit},id){
		try {
			const statisticinternationalmoney =  await StatisticInternationalMoneyService.deletestatisticinternationalmoney(id);
			await commit('setMessage',statisticinternationalmoney.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setStatisticInternationalMoneyList(state, statisticinternationalmoneylist){
		state.statisticinternationalmoneylist = statisticinternationalmoneylist
	},
	setStatisticInternationalMoneys(state, statisticinternationalmoneys){
		state.statisticinternationalmoneys = statisticinternationalmoneys
	},
	setMessage(state, message){
		state.message = message
	},
	setEditStatisticInternationalMoney(state, statisticinternationalmoney){
		state.statisticinternationalmoney = statisticinternationalmoney
	},
	setMainStatisticInternationalMoneys(state, mainstatisticinternationalmoneys){
		state.mainstatisticinternationalmoneys = mainstatisticinternationalmoneys
	},
};

export const statisticinternationalmoney = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
