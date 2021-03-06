import ApiService from './api.service'

const BusModelService = {
	busmodelList(){
		return ApiService.get(`/api/busmodel/list`)
	},
	allbusmodels(page){
		return ApiService.post(`/api/busmodel?page=${page}`)
	},
	addbusmodel(data){
		return ApiService.post(`/api/busmodel/store`,data)
	},
	editbusmodel(id){
		return ApiService.get(`/api/busmodel/edit/${id}`)
	},
	updatebusmodel(data){
		return ApiService.post(`/api/busmodel/update/${data.id}`,data)
	},
	deletebusmodel(id){
		return ApiService.delete(`/api/busmodel/destroy/${id}`)
	},
};

export { BusModelService };
