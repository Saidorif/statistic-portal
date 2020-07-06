import {CustomsService} from "../services/customs.service";

const state = {
	message: [],
};

const getters = {
	getMassage(state){
		return state.message
	},
};


const actions = {
	async actionImportExcel({commit},payload){
		try {
			const exData =  await CustomsService.importExcel(payload);
			await commit('setMessage',exData.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setMessage(state, message){
		state.message = message
	},
};

export const customs = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
