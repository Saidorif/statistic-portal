import {AirwaysinfoService} from "../services/airwaysinfo.service";

const state = {
	airwaysinfos: {},
	airwaysinfolist: [],
	message: [],
	airwaysinfo: [],
};

const getters = {
	getAirwaysCList(state){
		return state.airwaysinfolist
	},
	getAirwayss(state){
		return state.airwaysinfos
	},
	getMassage(state){
		return state.message
	},
	getAirways(state){
		return state.airwaysinfo
	},
};


const actions = {
	async actionAirwaysList({commit},page){
		try {
			const airwaysinfo =  await AirwaysinfoService.airwaysinfoList(page);
			await commit('setAirwaysList',airwaysinfo.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAirwayss({commit},page){
		try {
			const airwaysinfo =  await AirwaysinfoService.allairwaysinfos(page);
			await commit('setAirwayss',airwaysinfo.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddAirways({commit},payload){
		try {
			const airwaysinfo =  await AirwaysinfoService.addairwaysinfo(payload);
			await commit('setMessage',airwaysinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditAirways({commit},id){
		try {
			const airwaysinfo =  await AirwaysinfoService.editairwaysinfo(id);
			await commit('setEditAirways',airwaysinfo.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateAirways({commit},payload){
		try {
			const airwaysinfo =  await AirwaysinfoService.updateairwaysinfo(payload);
			await commit('setMessage',airwaysinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteAirways({commit},id){
		try {
			const airwaysinfo =  await AirwaysinfoService.deleteairwaysinfo(id);
			await commit('setMessage',airwaysinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteAirwayscode({commit},id){
		try {
			const airwaysinfo =  await AirwaysinfoService.deleteairwayscode(id);
			await commit('setMessage',airwaysinfo.data)
			return true
		} catch (error) {
			return false
		}
	},
	// async actionDeletePlaneType({commit},id){
	// 	try {
	// 		const airwaysinfo =  await AirwaysinfoService.deleteplanetype(id);
	// 		await commit('setMessage',airwaysinfo.data)
	// 		return true
	// 	} catch (error) {
	// 		return false
	// 	}
	// },
	// async actionDeleteAviaCity({commit},id){
	// 	try {
	// 		const airwaysinfo =  await AirwaysinfoService.deleteaviacity(id);
	// 		await commit('setMessage',airwaysinfo.data)
	// 		return true
	// 	} catch (error) {
	// 		return false
	// 	}
	// },
	// async actionDeleteAirwaysway({commit},id){
	// 	try {
	// 		const airwaysinfo =  await AirwaysinfoService.deleteAirwaysway(id);
	// 		await commit('setMessage',airwaysinfo.data)
	// 		return true
	// 	} catch (error) {
	// 		return false
	// 	}
	// },
	// async actionDeleteAirwaysrecon({commit},id){
	// 	try {
	// 		const airwaysinfo =  await AirwaysinfoService.deleteAirwaysrecon(id);
	// 		await commit('setMessage',airwaysinfo.data)
	// 		return true
	// 	} catch (error) {
	// 		return false
	// 	}
	// },
};

const mutations = {
	setAirwaysList(state, airwaysinfolist){
		state.airwaysinfolist = airwaysinfolist
	},
	setAirwayss(state, airwaysinfos){
		state.airwaysinfos = airwaysinfos
	},
	setMessage(state, message){
		state.message = message
	},
	setEditAirways(state, airwaysinfo){
		state.airwaysinfo = airwaysinfo
	},
};

export const airwaysinfo = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
