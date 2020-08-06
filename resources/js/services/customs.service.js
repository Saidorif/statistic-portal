import ApiService from './api.service'

const CustomsService = {
	// importExcel(data){
	// 	return ApiService.post(`/api/impexp/upload`,data)
	// },
	importExcel(data){
		return ApiService.fileSend(`/api/impexp/excel-upload`,data)
	},
	importExcelList(data){
		return ApiService.post(`/api/impexp?page=`+ data.page, data.filter)
	},
	customsAddService(data){
		return ApiService.post(`/api/impexp/store`, data)
	},
	editCustomsService(data){
		return ApiService.get(`/api/impexp/edit/${data.id}`,data)
	},
	updateCustomsService(data){
		return ApiService.post(`/api/impexp/update/${data.id}`,data)
	},
};

export { CustomsService };
