import ApiService from './api.service'

const AviaDirectionService = {
	aviadirectionList(){
		return ApiService.get(`/api/aviadirection/list`)
	},
	allaviadirections(page){
		return ApiService.post(`/api/aviadirection?page=${page}`)
	},
	addaviadirection(data){
		return ApiService.post(`/api/aviadirection/store`,data)
	},
	editaviadirection(id){
		return ApiService.get(`/api/aviadirection/edit/${id}`)
	},
	updateaviadirection(data){
		return ApiService.post(`/api/aviadirection/update/${data.id}`,data)
	},
	deleteaviadirection(id){
		return ApiService.delete(`/api/aviadirection/destroy/${id}`)
	},
};

export { AviaDirectionService };
