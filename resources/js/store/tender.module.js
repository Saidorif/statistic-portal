import {TenderService} from "../services/tender.service";

const state = {
	tenders: {},
	message: [],
};

const getters = {
	getTenders(state){
		return state.tenders
	},
	getMassage(state){
		return state.message
	},
};


const actions = {
	async actionTenders({commit}){
		try {
			const tenders =  await TenderService.tenderAll();
			await commit('setTenders',tenders.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	
};

const mutations = {
	setTenders(state, tenders){
		state.tenders = tenders
	},
	setMessage(state, message){
		state.message = message
	},
};

export const tender = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
