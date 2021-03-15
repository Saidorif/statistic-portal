import ApiService from './api.service'

const FaktService = {
	faktList(){
		return ApiService.get(`/api/fakt/list`)
	},
	allfakts(date){
		return ApiService.post(`/api/fakt?page=${date.page}`,date)
	},
	addfakt(data){
		return ApiService.post(`/api/fakt/store`,data)
	},
	editfakt(id){
		return ApiService.get(`/api/fakt/edit/${id}`)
	},
	updatefakt(data){
		return ApiService.post(`/api/fakt/update/${data.id}`,data)
	},
	deletefakt(id){
		return ApiService.delete(`/api/fakt/destroy/${id}`)
	},
	accept(data){
		return ApiService.post(`/api/fakt/accept`,data)
	},
	reject(data){
		return ApiService.post(`/api/fakt/reject`,data)
	},
};

export { FaktService };
