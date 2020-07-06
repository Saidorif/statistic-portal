import {VedGroupService} from "../services/vedgroup.service";

const state = {
	list: {},
	message: [],
	ved: [],
};

const getters = {
	getVedList(state){
		return state.list
	},
	getMassage(state){
		return state.message
	},
	getVed(state){
		return state.ved
	},
};


const actions = {
	async actionVedList({commit},page){
		try {
			const ved =  await VedGroupService.vedlist(page);
			await commit('setVedList',ved.data.result)
			return true
		} catch (error){
			return false
		}
	},
	async actionAddVed({commit},payload){
		try {
			const ved =  await VedGroupService.addVedG(payload);
			await commit('setMessage',ved.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditVed({commit},id){
		try {
			const ved =  await VedGroupService.editVedG(id);
			await commit('setVed',ved.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateVed({commit},payload){
		try {
			const ved =  await VedGroupService.updateVedG(payload);
			await commit('setVed',ved.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteVed({commit},id){
		try {
			const ved =  await VedGroupService.deleteVedG(id);
			await commit('setVed',ved.data.result)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setVedList(state, list){
		state.list = list
	},
	setMessage(state, message){
		state.message = message
	},
	setVed(state, ved){
		state.ved = ved
	},
};

export const vedgroup = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
