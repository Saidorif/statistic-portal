import ApiService from './api.service'

const CountryService = {
	country(data){
		return ApiService.post(`/api/country?page=`+data.page, data.items)
	},
};

export { CountryService };
