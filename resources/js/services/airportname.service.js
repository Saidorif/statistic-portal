import ApiService from './api.service'

const AirportnameService = {
	airportnameList(){
		return ApiService.get(`/api/airportname/list`)
	},
	allairportnames(page){
		return ApiService.post(`/api/airportname?page=${page}`)
	},
	addairportname(data){
		return ApiService.post(`/api/airportname/store`,data)
	},
	editairportname(id){
		return ApiService.get(`/api/airportname/edit/${id}`)
	},
	updateairportname(data){
		return ApiService.post(`/api/airportname/update/${data.id}`,data)
	},
	deleteairportname(id){
		return ApiService.delete(`/api/airportname/destroy/${id}`)
	},
};

export { AirportnameService };
