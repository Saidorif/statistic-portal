import ApiService from './api.service'

const AirwaysCompanyService = {
	airwayscompanyList(){
		return ApiService.get(`/api/airwayscompany/list`)
	},
	allairwayscompanys(page){
		return ApiService.post(`/api/airwayscompany?page=${page}`)
	},
	addairwayscompany(data){
		return ApiService.post(`/api/airwayscompany/store`,data)
	},
	editairwayscompany(id){
		return ApiService.get(`/api/airwayscompany/edit/${id}`)
	},
	updateairwayscompany(data){
		return ApiService.post(`/api/airwayscompany/update/${data.id}`,data)
	},
	deleteairwayscompany(id){
		return ApiService.delete(`/api/airwayscompany/destroy/${id}`)
	},
};

export { AirwaysCompanyService };
