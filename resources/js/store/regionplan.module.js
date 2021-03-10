import {RegionPlanService} from "../services/regionplan.service";

const state = {
	regionplans: {},
	regionplanlist: [],
	message: [],
	regionplan: [],
};

const getters = {
	getRegionPlanList(state){
		return state.regionplanlist
	},
	getRegionPlans(state){
		return state.regionplans
	},
	getMassage(state){
		return state.message
	},
	getRegionPlan(state){
		return state.regionplan
	},
};


const actions = {
	async actionRegionPlanList({commit},page){
		try {
			const regions =  await RegionPlanService.regionplanList(page);
			await commit('setRegionPLanList',regions.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionRegionPlans({commit},page){
		try {
			const regions =  await RegionPlanService.allregionplans(page);
			await commit('setRegionPLan',regions.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddRegionPlan({commit},payload){
		try {
			const regions =  await RegionPlanService.addregionplan(payload);
			await commit('setMessage',regions.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditRegionPlan({commit},id){
		try {
			const regions =  await RegionPlanService.editregionplan(id);
			await commit('setEditRegionP',regions.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateRegionPlan({commit},payload){
		try {
			const region =  await RegionPlanService.updateregionplan(payload);
			await commit('setMessage',region.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteRegionPlan({commit},id){
		try {
			const region =  await RegionPlanService.deleteregionplan(id);
			await commit('setMessage',region.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setRegionPlanList(state, regionplanlist){
		state.regionplanlist = regionplanlist
	},
	setRegionPLan(state, regionplans){
		state.regionplans = regionplans
	},
	setMessage(state, message){
		state.message = message
	},
	setEditRegionP(state, regionplan){
		state.regionplan = regionplan
	},
};

export const regionplan = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
