import { LARAVEL_API_BASE } from '$env/static/private';
import APIService from './api.service';

export class SongsServices extends APIService {
	constructor() {
		super(LARAVEL_API_BASE || 'http://localhost:8000/api');
	}

	async uploadMp3(songId: number, file: File) {
		const form = new FormData();
		form.append('mp3', file);

		return this.mediaUpload(`/songs/${songId}/mp3`, form)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}
	async uploadLyrics(songId: number, file: File) {
		const form = new FormData();
		form.append('lyrics', file);

		return this.mediaUpload(`/songs/${songId}/lyrics`, form)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}

	async patchSong(songId: number, input: PatchSongInput) {
		return this.patch(`/songs/${songId}`, input)
			.then((res) => res?.data?.data || [])
			.catch((err) => {
				throw err?.response?.data;
			});
	}
}

type PatchSongInput = {
	title?: string;
};
