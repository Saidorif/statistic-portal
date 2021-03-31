import {StatisticInternationalCargoService} from "../services/statisticinternationalcargo.service";

const state = {
	statisticinternationalcargos: {},
	statisticinternationalcargolist: [],
	statisticinternationalcargo: [],
	message: [],
	mainstatisticinternationalcargos: [],
};

const getters = {
	getStatisticInternationalCargoList(state){
		return state.statisticinternationalcargolist
	},
	getStatisticInternationalCargos(state){
		return state.statisticinternationalcargos
	},
	getMassage(state){
		return state.message
	},
	getStatisticInternationalCargo(state){
		return state.statisticinternationalcargo
	},
	getMainStatisticInternationalCargos(state){
		return state.mainstatisticinternationalcargos
	},
};


const actions = {
	async actionStatisticInternationalCargoList({commit},page){
		try {
			const statisticinternationalcargos =  await StatisticInternationalCargoService.statisticinternationalcargoList(page);
			await commit('setStatisticInternationalCargoList',statisticinternationalcargos.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionMainStatisticInternationalCargos({commit},payload){
		try {
			const statisticinternationalcargos =  await StatisticInternationalCargoService.mainstatisticinternationalcargo(payload);
			await commit('setMainStatisticInternationalCargos',statisticinternationalcargos.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionStatisticInternationalCargos({commit},payload){
		try {
			const statisticinternationalcargos =  await StatisticInternationalCargoService.allstatisticinternationalcargos(payload);
			if(statisticinternationalcargos.data.error){
				await commit('setMessage',statisticinternationalcargos.data)
			}else{
				await commit('setStatisticInternationalCargos',statisticinternationalcargos.data.result)
			}
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddStatisticInternationalCargo({commit},payload){
		try {
			const statisticinternationalcargos =  await StatisticInternationalCargoService.addstatisticinternationalcargo(payload);
			await commit('setMessage',statisticinternationalcargos.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditStatisticInternationalCargo({commit},id){
		try {
			const statisticinternationalcargos =  await StatisticInternationalCargoService.editstatisticinternationalcargo(id);
			await commit('setEditStatisticInternationalCargo',statisticinternationalcargos.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateStatisticInternationalCargo({commit},payload){
		try {
			const statisticinternationalcargo =  await StatisticInternationalCargoService.updatestatisticinternationalcargo(payload);
			await commit('setMessage',statisticinternationalcargo.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteStatisticInternationalCargo({commit},id){
		try {
			const statisticinternationalcargo =  await StatisticInternationalCargoService.deletestatisticinternationalcargo(id);
			await commit('setMessage',statisticinternationalcargo.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setStatisticInternationalCargoList(state, statisticinternationalcargolist){
		state.statisticinternationalcargolist = statisticinternationalcargolist
	},
	setStatisticInternationalCargos(state, statisticinternationalcargos){
		state.statisticinternationalcargos = statisticinternationalcargos
	},
	setMessage(state, message){
		state.message = message
	},
	setEditStatisticInternationalCargo(state, statisticinternationalcargo){
		state.statisticinternationalcargo = statisticinternationalcargo
	},
	setMainStatisticInternationalCargos(state, mainstatisticinternationalcargos){
		state.mainstatisticinternationalcargos = mainstatisticinternationalcargos
	},
};

export const statisticinternationalcargo = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
