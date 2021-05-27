import ApiService from './api.service'

const AirportexpectService = {
	airportexpectList(){
		return ApiService.get(`/api/airportexpect/list`)
	},
	allairportexpects(page){
		return ApiService.post(`/api/airportexpect?page=${page}`)
	},
	addairportexpect(data){
		return ApiService.post(`/api/airportexpect/store`,data)
	},
	editairportexpect(id){
		return ApiService.get(`/api/airportexpect/edit/${id}`)
	},
	updateairportexpect(data){
		return ApiService.post(`/api/airportexpect/update/${data.id}`,data)
	},
	deleteairportexpect(id){
		return ApiService.delete(`/api/airportexpect/destroy/${id}`)
	},
};

export { AirportexpectService };
