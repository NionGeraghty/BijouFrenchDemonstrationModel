import { LARAVEL_API_BASE } from '$env/static/private';
import type { Article } from '$lib/types';
import APIService from './api.service';

export class ArticlesServices extends APIService {
	constructor() {
		super(LARAVEL_API_BASE || 'http://localhost:8000/api');
	}

	async getArticles(): Promise<Article[]> {
		return this.get('/articles')
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async getArticleBySlug(slug: string): Promise<Article> {
		return this.get(`/articles/${slug}`)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async getArticleById(id: number): Promise<Article> {
		return this.get(`/articles/${id}`)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}
}
