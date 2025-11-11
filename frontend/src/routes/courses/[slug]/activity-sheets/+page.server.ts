import type { PageServerLoad } from './$types';

export const load = (async ({ params: { slug }, locals: { services } }) => {
	const course = await services.groups.getActiveCourseBySlud(slug);

	return {
		course
	};
}) satisfies PageServerLoad;
