import ApiService from './api.service'

const CustomsService = {
	importExcel(data){
		return ApiService.post(`/api/impexp/store`,data)
	},
};

export { CustomsService };
