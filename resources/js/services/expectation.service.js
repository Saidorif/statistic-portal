import ApiService from './api.service'

const ExpectationService = {
	expectationList(){
		return ApiService.get(`/api/expectation/list`)
	},
	allexpectations(page){
		return ApiService.post(`/api/expectation?page=${page}`)
	},
	addexpectation(data){
		return ApiService.post(`/api/expectation/store`,data)
	},
	editexpectation(id){
		return ApiService.get(`/api/expectation/edit/${id}`)
	},
	updateexpectation(data){
		return ApiService.post(`/api/expectation/update/${data.id}`,data)
	},
	deleteexpectation(id){
		return ApiService.delete(`/api/expectation/destroy/${id}`)
	},
};

export { ExpectationService };
