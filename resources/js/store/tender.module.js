import {TenderService} from "../services/tender.service";

const state = {
	tenders: {},
	message: [],
	regions: [],
};

const getters = {
	getTenders(state){
		return state.tenders
	},
	getMassage(state){
		return state.message
	},
	getTenderRegionList(state){
		return state.regions
	},
};


const actions = {
	async actionTenders({commit},payload){
		try {
			const tenders =  await TenderService.tenderAll(payload);
			await commit('setTenders',tenders.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionTenderRegionList({commit}){
		try {
			const tenders =  await TenderService.tenderRegions();
			await commit('setTenderRegionList',tenders.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	
};

const mutations = {
	setTenderRegionList(state, regions){
		state.regions = regions
	},
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
