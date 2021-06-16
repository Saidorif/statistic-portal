import ApiService from './api.service'

const AirwaysinfoService = {
	airwaysinfoList(){
		return ApiService.get(`/api/airwaysinfo/list`)
	},
	allairwaysinfos(page){
		return ApiService.post(`/api/airwaysinfo?page=${page}`)
	},
	addairwaysinfo(data){
		return ApiService.post(`/api/airwaysinfo/store`,data)
	},
	editairwaysinfo(id){
		return ApiService.get(`/api/airwaysinfo/edit/${id}`)
	},
	updateairwaysinfo(data){
		return ApiService.post(`/api/airwaysinfo/update/${data.id}`,data)
	},
	deleteairwaysinfo(id){
		return ApiService.delete(`/api/airwaysinfo/destroy/${id}`)
	},
	// ************
	// deleteplanetype(id){
	// 	return ApiService.delete(`/api/airwaysinfo/destroy-plane-type/${id}`)
	// },
	// deleteaviacity(id){
	// 	return ApiService.delete(`/api/airwaysinfo/destroy-avia-city/${id}`)
	// },
	deleteairwayscode(id){
		return ApiService.delete(`/api/airwaysinfo/destroy-airwaysinfo-code/${id}`)
	},
	// deleteairwaysway(id){
	// 	return ApiService.delete(`/api/airwaysinfo/destroy-airwaysinfo-way/${id}`)
	// },
	// deleteAirwaysrecon(id){
	// 	return ApiService.delete(`/api/airwaysinfo/destroy-airwaysinfo-recon/${id}`)
	// },
	// ************
};

export { AirwaysinfoService };
