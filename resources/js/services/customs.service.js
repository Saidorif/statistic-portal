import ApiService from './api.service'

const CustomsService = {
	// importExcel(data){
	// 	return ApiService.post(`/api/impexp/upload`,data)
	// },
	importExcel(data){
		return ApiService.fileSend(`/api/impexp/excel-upload`,data)
	},
	importExcelList(data){
		return ApiService.post(`/api/impexp?page=`+ data.page)
	},
};

export { CustomsService };
