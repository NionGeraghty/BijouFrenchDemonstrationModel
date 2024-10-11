import { LARAVEL_API_BASE } from '$env/static/private';
import type { Cohort, Course } from '$lib/types';
import APIService from './api.service';

export class CohortsServices extends APIService {
	constructor() {
		super(LARAVEL_API_BASE || 'http://localhost:8000/api');
	}

	async getCohorts(): Promise<Cohort[]> {
		return this.get('/cohorts')
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async createCohort(input: CreateCohortInput): Promise<Cohort> {
		return this.post('/cohorts', input)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async activateCohort(cohortId: number): Promise<Cohort> {
		return this.patch(`/cohorts/${cohortId}`, { active: true })
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async deactivateCohort(cohortId: number): Promise<Cohort> {
		return this.patch(`/cohorts/${cohortId}`, { active: false })
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async increaseOrder(cohortId: number): Promise<Cohort> {
		return this.patch(`/cohorts/${cohortId}/move`, { direction: 'down' })
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async decreaseOrder(cohortId: number): Promise<Cohort> {
		return this.patch(`/cohorts/${cohortId}/move`, { direction: 'up' })
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async getActiveCourseBySlud(slug: string): Promise<Course> {
		return this.get(`/cohorts/${slug}/course`)
			.then((res) => res?.data?.data || {})
			.catch((err) => {
				throw err?.response?.data;
			});
	}
}

type CreateCohortInput = {
	title: string;
};
