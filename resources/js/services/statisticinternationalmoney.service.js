import ApiService from './api.service'

const StatisticInternationalMoneyService = {
	statisticinternationalmoneyList(){
		return ApiService.get(`/api/statisticinternationalmoney/list`)
	},
	mainstatisticinternationalmoney(data){
		return ApiService.post(`/api/statisticinternationalmoney/main`,data)
	},
	allstatisticinternationalmoneys(data){
		return ApiService.post(`/api/statisticinternationalmoney?page=${data.page}`,data.items)
	},
	addstatisticinternationalmoney(data){
		return ApiService.post(`/api/statisticinternationalmoney/store`,data)
	},
	editstatisticinternationalmoney(id){
		return ApiService.get(`/api/statisticinternationalmoney/edit/${id}`)
	},
	updatestatisticinternationalmoney(data){
		return ApiService.post(`/api/statisticinternationalmoney/update/${data.id}`,data)
	},
	deletestatisticinternationalmoney(id){
		return ApiService.delete(`/api/statisticinternationalmoney/destroy/${id}`)
	},
};

export { StatisticInternationalMoneyService };
