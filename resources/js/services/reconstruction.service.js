import ApiService from './api.service'

const ReconstructionService = {
	reconstructionList(){
		return ApiService.get(`/api/reconstruction/list`)
	},
	reconstructionFind(data){
		return ApiService.post(`/api/reconstruction/find`,data)
	},
	allreconstructions(page){
		return ApiService.post(`/api/reconstruction?page=${page}`)
	},
	addreconstruction(data){
		return ApiService.post(`/api/reconstruction/store`,data)
	},
	editreconstruction(id){
		return ApiService.get(`/api/reconstruction/edit/${id}`)
	},
	updatereconstruction(data){
		return ApiService.post(`/api/reconstruction/update/${data.id}`,data)
	},
	deletereconstruction(id){
		return ApiService.delete(`/api/reconstruction/destroy/${id}`)
	},
	accept(data){
		return ApiService.post(`/api/reconstruction/accept`,data)
	},
	reject(data){
		return ApiService.post(`/api/reconstruction/reject`,data)
	},
};

export { ReconstructionService };
