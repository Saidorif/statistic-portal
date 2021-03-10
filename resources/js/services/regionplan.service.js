import ApiService from './api.service'

const RegionPlanService = {
	regionplanList(){
		return ApiService.get(`/api/regionplan/list`)
	},
	allregionplans(page){
		return ApiService.post(`/api/regionplan?page=${page}`)
	},
	addregionplan(data){
		return ApiService.post(`/api/regionplan/store`,data)
	},
	editregionplan(id){
		return ApiService.get(`/api/regionplan/edit/${id}`)
	},
	updateregionplan(data){
		return ApiService.post(`/api/regionplan/update/${data.id}`,data)
	},
	deleteregionplan(id){
		return ApiService.delete(`/api/regionplan/destroy/${id}`)
	},
};

export { RegionPlanService };
