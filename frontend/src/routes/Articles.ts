import { STRAPI_API_BASE } from '$env/static/private';
import { compile } from 'mdsvex';
import type { Article } from '../types';

export const find = async (slug: string) => {
	// fetch from api
	const response = await fetch(`${STRAPI_API_BASE}/articles`, {
		method: 'GET',
		headers: {
			contentType: 'application/json'
		}
	});
	const responseJson = await response.json();

	const article = (responseJson.data as Article[]).find((article) => article.slug === slug);
	if (article) {
		article.text = (await compile(article.text))?.code ?? '';
	}
	// console.log(data);
	if (responseJson.data) {
		return (responseJson.data as Article[]).find((article) => article.slug === slug);
	}

	return undefined;
};
