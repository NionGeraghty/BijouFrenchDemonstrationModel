import { sequence } from '@sveltejs/kit/hooks';
import { Services } from './lib/server/services';

// initiate the services
export const handle = sequence(async ({ event, resolve }) => {
	event.locals.services = new Services();
	return resolve(event);
});
