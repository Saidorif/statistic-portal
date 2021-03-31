import ApiService from './api.service'
import { TokenService } from './storage.service'
import axios from 'axios'

const TenderService = {
	tenderAll(data){
		return ApiService.post(`/api/tender`,data)
	},
	tenderbyRegion(data){
		return ApiService.post(`/api/tenderByRegion?page=${data.page}`,data.items)
	},
	tenderRegions(){
		return ApiService.get(`/api/tender/regions`)
	}
};

export { TenderService };
