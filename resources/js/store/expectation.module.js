import {ExpectationService} from "../services/expectation.service";

const state = {
	expectations: {},
	expectationlist: [],
	message: [],
	expectation: [],
};

const getters = {
	getExpectationList(state){
		return state.expectationlist
	},
	getExpectations(state){
		return state.expectations
	},
	getMassage(state){
		return state.message
	},
	getExpectation(state){
		return state.expectation
	},
};


const actions = {
	async actionExpectationList({commit},page){
		try {
			const expectations =  await ExpectationService.expectationList(page);
			await commit('setExpectationList',expectations.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionExpectations({commit},page){
		try {
			const expectations =  await ExpectationService.allexpectations(page);
			await commit('setExpectations',expectations.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionAddExpectation({commit},payload){
		try {
			const expectations =  await ExpectationService.addexpectation(payload);
			await commit('setMessage',expectations.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionEditExpectation({commit},id){
		try {
			const expectations =  await ExpectationService.editexpectation(id);
			await commit('setEditExpectation',expectations.data.result)
			return true
		} catch (error) {
			return false
		}
	},
	async actionUpdateExpectation({commit},payload){
		try {
			const expectation =  await ExpectationService.updateexpectation(payload);
			await commit('setMessage',expectation.data)
			return true
		} catch (error) {
			return false
		}
	},
	async actionDeleteExpectation({commit},id){
		try {
			const expectation =  await ExpectationService.deleteexpectation(id);
			await commit('setMessage',expectation.data)
			return true
		} catch (error) {
			return false
		}
	},
};

const mutations = {
	setExpectationList(state, expectationlist){
		state.expectationlist = expectationlist
	},
	setExpectations(state, expectations){
		state.expectations = expectations
	},
	setMessage(state, message){
		state.message = message
	},
	setEditExpectation(state, expectation){
		state.expectation = expectation
	},
};

export const expectation = {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}
