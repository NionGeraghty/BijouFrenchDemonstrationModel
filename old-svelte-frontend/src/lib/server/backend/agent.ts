import { LARAVEL_API_BASE } from '$env/static/private';

export const authenticate = async (email: string, password: string) => {
	const formData = new FormData();
	formData.append('email', email);
	formData.append('password', password);
	formData.append('device_name', 'web');

	return await request('/token', {
		method: 'POST',
		body: formData
	});
};

export const courses = {
	all: async () => {
		return await request('/courses', {
			method: 'GET',
			headers: {
				contentType: 'application/json'
			}
		});
	}
};

const request = async (route: string, opts: RequestInit) => {
	const data = {
		...opts
	};

	return await fetch(`${LARAVEL_API_BASE}${route}`, data);
};
