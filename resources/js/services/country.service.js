import ApiService from './api.service'

const CountryService = {
	countries(data){
		return ApiService.post(`/api/controller/find`, data)
	},
};

export { CountryService };
