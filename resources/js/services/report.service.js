import ApiService from './api.service'

const ReportService = {
	reportByCountryListService(data){
		return ApiService.post(`/api/report/first`,data)
	},
	reportByProductListService(){
		return ApiService.get(`/api/report/second`)
	},
	// importExcelList(data){
	// 	return ApiService.post(`/api/impexp?page=`+ data.page)
	// },
};

export { ReportService };
