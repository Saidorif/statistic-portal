import {BusModelService} from "../services/bus.service";

const state = {
	busmodels: {},
	busmodellist: [],
	message: [],
	busmodel: [],
};

const getters = {
	getBusmodelList(state){
		return state.busmodellist
	},
	getBusmodels(state){
		return state.busmodels
	},
	getMassage(state){
		return state.message
	},
	getBusmodel(state){
		return state.busmodel
	},
};


const actions = {
	async actionBusmodelList({commit},page){
		try {
			const busmodels =  await BusModelService.busmodelList(page);
			await commit('setBusmodelList',busmodels.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionBusmodels({commit},page){
		try {
			const busmodels =  await BusModelService.allbusmodels(page);
			await commit('setBusmodels',busmodels.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddBusmodel({commit},payload){
		try {
			const busmodels =  await BusModelService.addbusmodel(payload);
			await commit('setMessage',busmodels.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditBusmodel({commit},id){
		try {
			const busmodels =  await BusModelService.editbusmodel(id);
			await commit('setEditBusmodel',busmodels.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateBusmodel({commit},payload){
		try {
			const busmodel =  await BusModelService.updatebusmodel(payload);
			await commit('setMessage',busmodel.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteBusmodel({commit},id){
		try {
			const busmodel =  await BusModelService.deletebusmodel(id);
			await commit('setMessage',busmodel.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setBusmodelList(state, busmodellist){
		state.busmodellist = busmodellist
	},
	setBusmodels(state, busmodels){
		state.busmodels = busmodels
	},
	setMessage(state, message){
		state.message = message
	},
	setEditBusmodel(state, busmodel){
		state.busmodel = busmodel
	},
};

export const busmodel = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
