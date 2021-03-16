import {FaktService} from "../services/fakt.service";

const state = {
	fakts: {},
	faktlist: [],
	message: [],
	fakt: [],
};

const getters = {
	getFaktList(state){
		return state.faktlist
	},
	getFakts(state){
		return state.fakts
	},
	getMassage(state){
		return state.message
	},
	getFakt(state){
		return state.fakt
	},
};


const actions = {
	async actionFaktList({commit},page){
		try {
			const fakts =  await FaktService.faktList(page);
			await commit('setFaktList',fakts.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionFakts({commit},payload){
		try {
			const fakts =  await FaktService.allfakts(payload);
			await commit('setFakts',fakts.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddFakt({commit},payload){
		try {
			const fakts =  await FaktService.addfakt(payload);
			await commit('setMessage',fakts.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAcceptFakt({commit},payload){
		try {
			const fakts =  await FaktService.accept(payload);
			await commit('setMessage',fakts.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionRejectFakt({commit},payload){
		try {
			const fakts =  await FaktService.reject(payload);
			await commit('setMessage',fakts.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditFakt({commit},id){
		try {
			const fakts =  await FaktService.editfakt(id);
			await commit('setEditFakt',fakts.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateFakt({commit},payload){
		try {
			const fakt =  await FaktService.updatefakt(payload);
			await commit('setMessage',fakt.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteFakt({commit},id){
		try {
			const fakt =  await FaktService.deletefakt(id);
			await commit('setMessage',fakt.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setFaktList(state, faktlist){
		state.faktlist = faktlist
	},
	setFakts(state, fakts){
		state.fakts = fakts
	},
	setMessage(state, message){
		state.message = message
	},
	setEditFakt(state, fakt){
		state.fakt = fakt
	},
};

export const faktmod = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
