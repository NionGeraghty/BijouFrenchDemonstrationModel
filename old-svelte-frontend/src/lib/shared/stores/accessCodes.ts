import { browser } from '$app/environment';

import { writable } from 'svelte/store';

const defaultValue: Record<number, string> = {};

const initialValue = browser
	? JSON.parse(window.localStorage.getItem('accessCodes') || '{}')
	: defaultValue;

export const accessCodes = writable<Record<number, string>>(initialValue);

accessCodes.subscribe((value: Record<number, string>) => {
	if (browser) {
		window.localStorage.setItem('accessCodes', JSON.stringify(value));
	}
});
