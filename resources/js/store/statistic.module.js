import {StatisticService} from "../services/statistic.service";

const state = {
	statistics: {},
	statisticlist: [],
	message: [],
	statistic: [],
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
	async actionStatistics({commit},page){
		try {
			const statistics =  await StatisticService.allstatistics(page);
			await commit('setStatistics',statistics.data.result)
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
	async actionDeletestatistic({commit},id){
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
};

export const statistic = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
