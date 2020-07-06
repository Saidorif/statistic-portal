import ApiService from './api.service'

const VedGroupService = {
	vedlist(data){
		return ApiService.post(`/api/codegroup`, data)
	},
	addVedG(data){
		return ApiService.post(`/api/codegroup/store`,data)
	},
	editVedG(id){
		return ApiService.get(`/api/codegroup/edit/${id}`)
	},
	updateVedG(data){
		return ApiService.post(`/api/codegroup/update/${data.id}`,data)
	},
	deleteVedG(id){
		return ApiService.delete(`/api/codegroup/destroy/${id}`)
	},
};

export { VedGroupService };
