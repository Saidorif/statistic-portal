import ApiService from './api.service'

const StatisticInternationalCargoService = {
	statisticinternationalcargoList(){
		return ApiService.get(`/api/statisticinternationalcargo/list`)
	},
	mainstatisticinternationalcargo(data){
		return ApiService.post(`/api/statisticinternationalcargo/main`,data)
	},
	allstatisticinternationalcargos(data){
		return ApiService.post(`/api/statisticinternationalcargo?page=${data.page}`,data.items)
	},
	addstatisticinternationalcargo(data){
		return ApiService.post(`/api/statisticinternationalcargo/store`,data)
	},
	editstatisticinternationalcargo(id){
		return ApiService.get(`/api/statisticinternationalcargo/edit/${id}`)
	},
	updatestatisticinternationalcargo(data){
		return ApiService.post(`/api/statisticinternationalcargo/update/${data.id}`,data)
	},
	deletestatisticinternationalcargo(id){
		return ApiService.delete(`/api/statisticinternationalcargo/destroy/${id}`)
	},
};

export { StatisticInternationalCargoService };
