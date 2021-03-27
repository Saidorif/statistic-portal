import {TenderService} from "../services/tender.service";

const state = {
	tenders: [],
	tenderbyregions: {},
	message: [],
	regions: [],
};

const getters = {
	getTenders(state){
		return state.tenders
	},
	getTenderByRegions(state){
		return state.tenderbyregions
	},
	getMassage(state){
		return state.message
	},
	getTenderRegionList(state){
		return state.regions
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
	async actionTenderByRegions({commit},payload){
		try {
			const tenders =  await TenderService.tenderbyRegion(payload);
			await commit('setTenderByRegions',tenders.data.result)
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
	setTenderByRegions(state, tenderbyregions){
		state.tenderbyregions = tenderbyregions
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
