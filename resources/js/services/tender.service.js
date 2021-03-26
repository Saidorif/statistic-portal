import ApiService from './api.service'
import { TokenService } from './storage.service'
import axios from 'axios'

const TenderService = {
	tenderAll: async (userData)=>{
		const requestData = {
			method: 'post',
			url: 'http://tender.loc/api/login',
			data: {
				email: 'mirxan@mail.ru',
				password: 'secret'
			}
		};

		const response = await ApiService.customRequest(requestData);
		TokenService.saveTender(response.data.token);

		const tenderData = {
	        method: 'post',
	        url: 'http://tender.loc/api/integration/get-directions',
	        dataType: 'json',
	        headers: {'Authorization': `Bearer ${TokenService.getTender()}`},
	    };

		const tenders = await ApiService.customRequest(tenderData);
	
		return tenders;
	},
};

export { TenderService };
