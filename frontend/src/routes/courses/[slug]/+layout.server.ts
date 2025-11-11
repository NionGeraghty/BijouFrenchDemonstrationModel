import type { PageServerLoad } from './$types';
import { error } from '@sveltejs/kit';

export const load = (async ({ params: { slug }, locals: { services } }) => {
	try {
		const article = await services.articles.getArticleBySlug(slug);
		const course = await services.groups.getActiveCourseBySlud(slug);

		console.log({ course });

		if (!article) {
			throw error(404, 'Not Found');
		}

		return {
			article,
			course
		};
	} catch (e) {
		console.error(e);
		throw error(404, 'Not Found');
	}
}) satisfies PageServerLoad;
