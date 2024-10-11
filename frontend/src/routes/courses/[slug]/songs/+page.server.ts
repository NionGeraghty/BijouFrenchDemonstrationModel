import type { PageServerLoad } from './$types';

export const load = (async ({ params: { slug }, locals: { services } }) => {
	const course = await services.cohorts.getActiveCourseBySlud(slug);

	return {
		course
	};
}) satisfies PageServerLoad;
