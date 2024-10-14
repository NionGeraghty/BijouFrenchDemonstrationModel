import { LARAVEL_API_BASE } from '$env/static/private';
import type { Course, GameAttempt } from '$lib/types';
import APIService from './api.service';

export class CoursesServices extends APIService {
	constructor() {
		super(LARAVEL_API_BASE || 'http://localhost:8000/api');
	}

	async getCourses(): Promise<Course[]> {
		return this.get('/courses')
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async getCourseById(courseId: number): Promise<Course> {
		return this.get(`/courses/${courseId}`)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async getCourseBySlug(slug: string): Promise<Course> {
		return this.get(`/courses/${slug}`)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async createCourse(input: CreateCourseInput): Promise<Course> {
		return this.post('/courses', input)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async attachToCohort(courseId: number, input: { cohort_id: number }): Promise<Course> {
		console.log('attach', courseId, input);

		return this.patch(`/courses/${courseId}`, input)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async detachFromCohort(courseId: number): Promise<Course> {
		console.log('detach', courseId);

		return this.patch(`/courses/${courseId}`, { cohort_id: null })
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async patchCourse(courseId: number, input: PatchCourseInput) {
		return this.patch(`/courses/${courseId}`, input)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async createActivity(courseId: number, input: { title: string }) {
		return this.post(`/activities/`, { title: input.title, course_id: courseId })
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async createSong(courseId: number, input: { title: string }) {
		return this.post(`/songs/`, { title: input.title, course_id: courseId })
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async logGameAttempt(input: GameAttempt) {
		console.log('logGameAttempt', input.course, input);
		try {
			this.post(`/courses/${input.course}/game-attempt`, input).then((res) => {
				console.log({ res: res?.data });

				return res?.data || [];
			});
		} catch (err) {
			console.error(err);
		}
	}
}

type PatchCourseInput = {
	title?: string;
	article_id?: number;
	access_code?: string;
};

type CreateCourseInput = {
	title: string;
};
