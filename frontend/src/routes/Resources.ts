import { STRAPI_API_BASE } from '$env/static/private';
import type { ActivitySheet, Song } from '../types';

export const findActivitySheets = async (courseSlug: string) => {
	// fetch from api
	const response = await fetch(
		`${STRAPI_API_BASE}/activity-sheets?filters[course][$eq]=${courseSlug}&populate=*`,
		{
			method: 'GET',
			headers: {
				contentType: 'application/json'
			}
		}
	);
	const responseJson = await response.json();

	if (responseJson.data) {
		// sort by week
		const sheets = responseJson.data.sort((a: ActivitySheet, b: ActivitySheet) => {
			const aWeek = parseInt(a.week);
			const bWeek = parseInt(b.week);
			if (aWeek < bWeek) {
				return -1;
			}
			if (aWeek > bWeek) {
				return 1;
			}
			return 0;
		});
		return sheets as ActivitySheet[];
	}

	return undefined;
};

export const findSongs = async (courseSlug: string) => {
	// fetch from api
	const response = await fetch(
		`${STRAPI_API_BASE}/songs?filters[course][$eq]=${courseSlug}&populate=*`,
		{
			method: 'GET',
			headers: {
				contentType: 'application/json'
			}
		}
	);
	const responseJson = await response.json();

	if (responseJson.data) {
		// sort by rank
		const sheets = responseJson.data.sort((a: Song, b: Song) => {
			const arank = parseInt(a.rank);
			const brank = parseInt(b.rank);
			if (arank < brank) {
				return -1;
			}
			if (arank > brank) {
				return 1;
			}
			return 0;
		});
		return sheets as Song[];
	}

	return undefined;
};
