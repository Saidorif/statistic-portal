import ApiService from './api.service'

const StatisticService = {
	statisticList(){
		return ApiService.get(`/api/statistic/list`)
	},
	mainstatistic(data){
		return ApiService.post(`/api/statistic/main`,data)
	},
	allstatistics(data){
		return ApiService.post(`/api/statistic?page=${data.page}`,data.items)
	},
	addstatistic(data){
		return ApiService.post(`/api/statistic/store`,data)
	},
	editstatistic(id){
		return ApiService.get(`/api/statistic/edit/${id}`)
	},
	updatestatistic(data){
		return ApiService.post(`/api/statistic/update/${data.id}`,data)
	},
	deletestatistic(id){
		return ApiService.delete(`/api/statistic/destroy/${id}`)
	},
};

export { StatisticService };
