import axios from 'axios'
import {TokenService} from "./storage.service"
import store from "./../store/store"

const ApiService = {
	// Stores the 401 interceptor position so that it can be later ejected when needed
	_401interceptor: null,

	init(baseURL){
		axios.defaults.baseURL = baseURL;
	},

	setHeader() {
		axios.defaults.headers.common["Authorization"] = `Bearer ${TokenService.getToken()}`
	},

	removeHeader() {
		axios.defaults.headers.common = {}
	},

	get(resource, config = {}) {
		return axios.get(resource, config);
	},

	post(resource, data) {
		return axios.post(resource, data);
	},
	put(resource, data) {
		return axios.put(resource, data);
	},
	delete(resource){
		return axios.delete(resource);
	},
	fileSend(resource, data){
		return axios.post(resource, data,{headers: {'Content-Type': 'multipart/form-data'}});
	},

	/**
	 * Perform a custom Axios request.
	 *
	 * data is an object containing the following properties:
	 *  - method
	 *  - url
	 *  - data ... request payload
	 *  - auth (optional)
	 *    - username
	 *    - password
	 **/
	customRequest(data) {
		return axios(data);
	},

	mount401Interceptor(){
		this._401interceptor = axios.interceptors.response.use(
			(response) => {
				return response
			},
			async (error) => {
				if (error.request.status === 401){
					store.dispatch('logout');
					throw error
				}

				// If error was not 401 just reject as is
				throw error
			}
		)
	},

	unmount401Interceptor() {
		// Eject the interceptor
		axios.interceptors.response.eject(this._401interceptor)
	}
};

export default ApiService;