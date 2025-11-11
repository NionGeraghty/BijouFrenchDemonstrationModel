import axios from 'axios';

abstract class APIService {
	protected baseURL: string;
	protected headers: any = {};

	constructor(baseURL: string) {
		this.baseURL = baseURL;
	}

	async getWithoutBase(url: string, config = {}): Promise<any> {
		return axios({
			method: 'get',
			url: url,
			...config
		});
	}

	async get(url: string, config = {}): Promise<any> {
		return axios({
			method: 'get',
			url: this.baseURL + url,
			...config
		});
	}

	async post(url: string, data = {}, config = {}): Promise<any> {
		return axios({
			method: 'post',
			url: this.baseURL + url,
			data,
			...config
		});
	}

	async put(url: string, data = {}, config = {}): Promise<any> {
		return axios({
			method: 'put',
			url: this.baseURL + url,
			data,
			...config
		});
	}

	async patch(url: string, data = {}, config = {}): Promise<any> {
		return axios({
			method: 'patch',
			url: this.baseURL + url,
			data,
			...config
		});
	}

	async delete(url: string, data?: any, config = {}): Promise<any> {
		return axios({
			method: 'delete',
			url: this.baseURL + url,
			data: data,
			...config
		});
	}

	async mediaUpload(url: string, data = {}, config = {}): Promise<any> {
		return axios({
			method: 'post',
			url: this.baseURL + url,
			data,
			...config
		});
	}

	request(config = {}) {
		return axios(config);
	}
}

export default APIService;
