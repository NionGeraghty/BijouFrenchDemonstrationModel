import type { PageServerLoad } from './$types';
import { error } from '@sveltejs/kit';

export const load = (async ({ params: { slug }, locals: { services } }) => {
	try {
		const article = await services.articles.getArticleBySlug(slug);

		if (!article) {
			throw error(404, 'Not Found');
		}

		return {
			article
		};
	} catch (e) {
		console.error(e);
		throw error(404, 'Not Found');
	}
}) satisfies PageServerLoad;
