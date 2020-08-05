import ApiService from './api.service'

const ReportService = {
	reportByCountryListService(){
		return ApiService.get(`/api/report/first`)
	},
	reportByProductListService(){
		return ApiService.get(`/api/report/second`)
	},
	// importExcelList(data){
	// 	return ApiService.post(`/api/impexp?page=`+ data.page)
	// },
};

export { ReportService };
