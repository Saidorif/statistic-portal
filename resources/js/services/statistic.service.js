import ApiService from './api.service'

const StatisticService = {
	statisticList(){
		return ApiService.get(`/api/statistic/list`)
	},
	allstatistics(page){
		return ApiService.post(`/api/statistic?page=${page}`)
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
