import ApiService from './api.service'

const AirportinfoService = {
	airportinfoList(){
		return ApiService.get(`/api/airportinfo/list`)
	},
	allairportinfos(page){
		return ApiService.post(`/api/airportinfo?page=${page}`)
	},
	addairportinfo(data){
		return ApiService.post(`/api/airportinfo/store`,data)
	},
	editairportinfo(id){
		return ApiService.get(`/api/airportinfo/edit/${id}`)
	},
	updateairportinfo(data){
		return ApiService.post(`/api/airportinfo/update/${data.id}`,data)
	},
	deleteairportinfo(id){
		return ApiService.delete(`/api/airportinfo/destroy/${id}`)
	},
	deleteplanetype(id){
		return ApiService.delete(`/api/airportinfo/destroy-plane-type/${id}`)
	},
	deleteaviacity(id){
		return ApiService.delete(`/api/airportinfo/destroy-avia-city/${id}`)
	},
	deleteairportcode(id){
		return ApiService.delete(`/api/airportinfo/destroy-airport-code/${id}`)
	},
	deleteairportway(id){
		return ApiService.delete(`/api/airportinfo/destroy-airport-way/${id}`)
	},
	deleteairportrecon(id){
		return ApiService.delete(`/api/airportinfo/destroy-airport-recon/${id}`)
	},
};

export { AirportinfoService };
