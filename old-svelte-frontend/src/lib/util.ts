import { PUBLIC_ASSETS_URL } from '$env/static/public';
import type { ClassValue } from 'clsx';
import clsx from 'clsx';
import { twMerge } from 'tailwind-merge';

export const cn = (...inputs: ClassValue[]) => twMerge(clsx(...inputs));

export const asset = (path: string) => {
	return `${PUBLIC_ASSETS_URL}${path}`;
	// return `${path}`;
};

export const wait = (ms: number) => new Promise((resolve) => setTimeout(resolve, ms));

export const filename = (path: string) => {
	const parts = path.split('/');
	return parts[parts.length - 1];
};
