import type { PageServerLoad } from './$types';

export const load = (async ({ params: { slug }, locals: { services } }) => {
	const course = await services.cohorts.getActiveCourseBySlud(slug);
	console.log('course', course.reorder_games);

	return {
		course,
		slug
	};
}) satisfies PageServerLoad;
