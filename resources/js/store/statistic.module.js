import {StatisticService} from "../services/statistic.service";

const state = {
	statistics: {},
	statisticlist: [],
	statistic: [],
	message: [],
	mainstatistics: [],
};

const getters = {
	getStatisticList(state){
		return state.statisticlist
	},
	getStatistics(state){
		return state.statistics
	},
	getMassage(state){
		return state.message
	},
	getStatistic(state){
		return state.statistic
	},
	getMainStatistics(state){
		return state.mainstatistics
	},
};


const actions = {
	async actionStatisticList({commit},page){
		try {
			const statistics =  await StatisticService.statisticList(page);
			await commit('setStatisticList',statistics.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionMainStatistics({commit},payload){
		try {
			const statistics =  await StatisticService.mainstatistic(payload);
			await commit('setMainStatistics',statistics.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionStatistics({commit},payload){
		try {
			const statistics =  await StatisticService.allstatistics(payload);
			if(statistics.data.error){
				await commit('setMessage',statistics.data)
			}else{
				await commit('setStatistics',statistics.data.result)
			}
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddStatistic({commit},payload){
		try {
			const statistics =  await StatisticService.addstatistic(payload);
			await commit('setMessage',statistics.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditStatistic({commit},id){
		try {
			const statistics =  await StatisticService.editstatistic(id);
			await commit('setEditStatistic',statistics.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateStatistic({commit},payload){
		try {
			const statistic =  await StatisticService.updatestatistic(payload);
			await commit('setMessage',statistic.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteStatistic({commit},id){
		try {
			const statistic =  await StatisticService.deletestatistic(id);
			await commit('setMessage',statistic.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setStatisticList(state, statisticlist){
		state.statisticlist = statisticlist
	},
	setStatistics(state, statistics){
		state.statistics = statistics
	},
	setMessage(state, message){
		state.message = message
	},
	setEditStatistic(state, statistic){
		state.statistic = statistic
	},
	setMainStatistics(state, mainstatistics){
		state.mainstatistics = mainstatistics
	},
};

export const statistic = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
