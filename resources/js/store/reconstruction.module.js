import {ReconstructionService} from "../services/reconstruction.service";

const state = {
	reconstructions: {},
	reconstructionlist: [],
	message: [],
	reconstruction: [],
	reconstructionFindList: [],
};

const getters = {
	getReconstructionList(state){
		return state.reconstructionlist
	},
	getReconstructions(state){
		return state.reconstructions
	},
	getMassage(state){
		return state.message
	},
	getReconstruction(state){
		return state.reconstruction
	},
	getReconstructionFindList(state){
		return state.reconstructionFindList
	},
};


const actions = {
	async actionReconstructionList({commit},page){
		try {
			const reconstructions =  await ReconstructionService.reconstructionList(page);
			await commit('setReconstructionList',reconstructions.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionReconstructionFind({commit},payload){
		try {
			const reconstructions =  await ReconstructionService.reconstructionFind(payload);
			await commit('setReconstructionFind',reconstructions.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionReconstructions({commit},page){
		try {
			const reconstructions =  await ReconstructionService.allreconstructions(page);
			await commit('setReconstructions',reconstructions.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddReconstruction({commit},payload){
		try {
			const reconstructions =  await ReconstructionService.addreconstruction(payload);
			await commit('setMessage',reconstructions.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditReconstruction({commit},id){
		try {
			const reconstructions =  await ReconstructionService.editreconstruction(id);
			await commit('setEditReconstruction',reconstructions.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateReconstruction({commit},payload){
		try {
			const reconstruction =  await ReconstructionService.updatereconstruction(payload);
			await commit('setMessage',reconstruction.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteReconstruction({commit},id){
		try {
			const reconstruction =  await ReconstructionService.deletereconstruction(id);
			await commit('setMessage',reconstruction.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setReconstructionList(state, reconstructionlist){
		state.reconstructionlist = reconstructionlist
	},
	setReconstructions(state, reconstructions){
		state.reconstructions = reconstructions
	},
	setMessage(state, message){
		state.message = message
	},
	setEditReconstruction(state, reconstruction){
		state.reconstruction = reconstruction
	},
	setReconstructionFind(state, reconstructionFindList){
		state.reconstructionFindList = reconstructionFindList
	},
};

export const reconstruction = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
