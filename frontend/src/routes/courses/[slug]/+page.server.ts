import type { PageServerLoad } from './$types';
import { error } from '@sveltejs/kit';

export const load: PageServerLoad = async ({ params, locals: { services } }) => {
	const { slug } = params as { slug: string };

	try {
		const course = await services.cohorts.getActiveCourseBySlud(slug);
		// if no article_id then throw
		if (!course || !course.article_id) {
			throw error(404, 'Not Found');
		}

		const article = await services.articles.getArticleById(course.article_id);

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
};
