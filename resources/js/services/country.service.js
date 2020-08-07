import ApiService from './api.service'

const CountryService = {
	country(data){
		return ApiService.post(`/api/country?page=`+data.page, data.items)
	},
	countryList(){
		return ApiService.get(`/api/country/list`)
	},
};

export { CountryService };
