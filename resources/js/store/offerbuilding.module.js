import {OfferbuildingService} from "../services/offerbuilding.service";

const state = {
	offerbuildings: {},
	offerbuildinglist: [],
	message: [],
	offerbuilding: [],
};

const getters = {
	getOfferbuildingList(state){
		return state.offerbuildinglist
	},
	getOfferbuildings(state){
		return state.offerbuildings
	},
	getMassage(state){
		return state.message
	},
	getOfferbuilding(state){
		return state.offerbuilding
	},
};


const actions = {
	async actionOfferbuildingList({commit},page){
		try {
			const items =  await OfferbuildingService.offerbuildingList(page);
			await commit('setOfferbuildingList',items.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionOfferbuildings({commit},page){
		try {
			const items =  await OfferbuildingService.allofferbuildings(page);
			await commit('setOfferbuildings',items.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddOfferbuilding({commit},payload){
		try {
			const items =  await OfferbuildingService.addofferbuilding(payload);
			await commit('setMessage',items.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditOfferbuilding({commit},id){
		try {
			const items =  await OfferbuildingService.editofferbuilding(id);
			await commit('setEditOfferbuilding',items.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateOfferbuilding({commit},payload){
		try {
			const item =  await OfferbuildingService.updateofferbuilding(payload);
			await commit('setMessage',item.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteOfferbuilding({commit},id){
		try {
			const item =  await OfferbuildingService.deleteofferbuilding(id);
			await commit('setMessage',item.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setOfferbuildingList(state, offerbuildinglist){
		state.offerbuildinglist = offerbuildinglist
	},
	setOfferbuildings(state, offerbuildings){
		state.offerbuildings = offerbuildings
	},
	setMessage(state, message){
		state.message = message
	},
	setEditOfferbuilding(state, offerbuilding){
		state.offerbuilding = offerbuilding
	},
};

export const offerbuilding = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
