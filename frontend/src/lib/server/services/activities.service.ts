import { LARAVEL_API_BASE } from '$env/static/private';
import APIService from './api.service';

export class ActivitiesServices extends APIService {
	constructor() {
		super(LARAVEL_API_BASE || 'http://localhost:8000/api');
	}

	async uploadWorksheet(activityId: number, file: File) {
		const form = new FormData();
		form.append('worksheet', file);

		return this.mediaUpload(`/activities/${activityId}/worksheet`, form)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}
	async uploadAnswers(activityId: number, file: File) {
		const form = new FormData();
		form.append('answers', file);

		return this.mediaUpload(`/activities/${activityId}/answers`, form)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async patchActivity(activityId: number, input: PatchActivityInput) {
		return this.patch(`/activities/${activityId}`, input)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}
}

type PatchActivityInput = {
	title?: string;
};
