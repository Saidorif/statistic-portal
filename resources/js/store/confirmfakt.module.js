import {ConfirmfaktService} from "../services/confirmfakt.service";

const state = {
	confirmfakts: {},
	confirmfaktlist: [],
	message: [],
	confirmfakt: [],
};

const getters = {
	getConfirmfaktList(state){
		return state.confirmfaktlist
	},
	getConfirmfakts(state){
		return state.confirmfakts
	},
	getMassage(state){
		return state.message
	},
	getConfirmfakt(state){
		return state.confirmfakt
	},
};


const actions = {
	async actionConfirmfaktList({commit},page){
		try {
			const confirmfakts =  await ConfirmfaktService.confirmfaktList(page);
			await commit('setConfirmfaktList',confirmfakts.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionConfirmfakts({commit},page){
		try {
			const confirmfakts =  await ConfirmfaktService.allconfirmfakts(page);
			await commit('setConfirmfakts',regions.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddConfirmfakt({commit},payload){
		try {
			const confirmfakts =  await ConfirmfaktService.addconfirmfakt(payload);
			await commit('setMessage',confirmfakts.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditConfirmfakt({commit},id){
		try {
			const confirmfakts =  await ConfirmfaktService.editconfirmfakt(id);
			await commit('setEditConfirmfakt',regions.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateConfirmfakt({commit},payload){
		try {
			const confirmfakt =  await ConfirmfaktService.updateconfirmfakt(payload);
			await commit('setMessage',region.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteConfirmfakt({commit},id){
		try {
			const confirmfakt =  await ConfirmfaktService.deleteconfirmfakt(id);
			await commit('setMessage',confirmfakt.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setConfirmfaktList(state, confirmfaktlist){
		state.confirmfaktlist = confirmfaktlist
	},
	setConfirmfakts(state, confirmfakts){
		state.confirmfakts = confirmfakts
	},
	setMessage(state, message){
		state.message = message
	},
	setEditConfirmfakt(state, confirmfakt){
		state.confirmfakt = confirmfakt
	},
};

export const confirmfakt = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
