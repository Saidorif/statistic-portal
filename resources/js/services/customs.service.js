import ApiService from './api.service'

const CustomsService = {
	importExcel(data){
		return ApiService.post(`/api/impexp/upload`,data)
	},
	importExcelList(data){
		return ApiService.post(`/api/impexp?page=`+ data.page)
	},
};

export { CustomsService };
