import {AviaDirectionService} from "../services/aviadirection.service";

const state = {
	aviadirections: {},
	aviadirectionlist: [],
	message: [],
	aviadirection: [],
};

const getters = {
	getAviaDirectionList(state){
		return state.aviadirectionlist
	},
	getAviaDirections(state){
		return state.aviadirections
	},
	getMassage(state){
		return state.message
	},
	getAviaDirection(state){
		return state.aviadirection
	},
};


const actions = {
	async actionAviaDirectionList({commit},page){
		try {
			const items =  await AviaDirectionService.aviadirectionList(page);
			await commit('setAviaDirectionList',items.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAviaDirections({commit},page){
		try {
			const items =  await AviaDirectionService.allaviadirections(page);
			await commit('setAviaDirections',items.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddAviaDirection({commit},payload){
		try {
			const items =  await AviaDirectionService.addaviadirection(payload);
			await commit('setMessage',items.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditAviaDirection({commit},id){
		try {
			const items =  await AviaDirectionService.editaviadirection(id);
			await commit('setEditAviaDirection',items.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateAviaDirection({commit},payload){
		try {
			const items =  await AviaDirectionService.updateaviadirection(payload);
			await commit('setMessage',items.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteAviaDirection({commit},id){
		try {
			const items =  await AviaDirectionService.deleteaviadirection(id);
			await commit('setMessage',items.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setAviaDirectionList(state, aviadirectionlist){
		state.aviadirectionlist = aviadirectionlist
	},
	setAviaDirections(state, aviadirections){
		state.aviadirections = aviadirections
	},
	setMessage(state, message){
		state.message = message
	},
	setEditAviaDirection(state, aviadirection){
		state.aviadirection = aviadirection
	},
};

export const aviadirection = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
