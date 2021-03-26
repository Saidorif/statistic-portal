import ApiService from './api.service'

const OfferbuildingService = {
	offerbuildingList(){
		return ApiService.get(`/api/offerbuilding/list`)
	},
	allofferbuildings(page){
		return ApiService.post(`/api/offerbuilding?page=${page}`)
	},
	addofferbuilding(data){
		return ApiService.post(`/api/offerbuilding/store`,data)
	},
	editofferbuilding(id){
		return ApiService.get(`/api/offerbuilding/edit/${id}`)
	},
	updateofferbuilding(data){
		return ApiService.post(`/api/offerbuilding/update/${data.id}`,data)
	},
	deleteofferbuilding(id){
		return ApiService.delete(`/api/offerbuilding/destroy/${id}`)
	},
	accept(data){
		return ApiService.post(`/api/offerbuilding/accept`,data)
	},
	reject(data){
		return ApiService.post(`/api/offerbuilding/reject`,data)
	},
};

export { OfferbuildingService };
