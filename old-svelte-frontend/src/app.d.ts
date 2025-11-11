// See https://kit.svelte.dev/docs/types#app

import type { Services } from './lib/server/services';

// for information about these interfaces
declare global {
	namespace App {
		// interface Error {}
		// interface Locals {}
		interface Locals {
			services: Services;
		}
		// interface PageData {}
		// interface Platform {}
	}
}

export {};
