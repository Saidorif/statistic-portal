import ApiService from './api.service'
import { TokenService } from './storage.service'
import axios from 'axios'

const TenderService = {
	tenderAll(date){
		return ApiService.post(`/api/tender?page=${date.page}`,date.items)
	},
	tenderRegions(){
		return ApiService.get(`/api/tender/regions`)
	}
};

export { TenderService };
