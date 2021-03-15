import ApiService from './api.service'

const ConfirmfaktService = {
	confirmfaktList(){
		return ApiService.get(`/api/confirmfakt/list`)
	},
	allconfirmfakts(page){
		return ApiService.post(`/api/confirmfakt?page=${page}`)
	},
	addconfirmfakt(data){
		return ApiService.post(`/api/confirmfakt/store`,data)
	},
	editconfirmfakt(id){
		return ApiService.get(`/api/confirmfakt/edit/${id}`)
	},
	updateconfirmfakt(data){
		return ApiService.post(`/api/confirmfakt/update/${data.id}`,data)
	},
	deleteconfirmfakt(id){
		return ApiService.delete(`/api/confirmfakt/destroy/${id}`)
	},
};

export { ConfirmfaktService };
