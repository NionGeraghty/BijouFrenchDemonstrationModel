/** @type {import('tailwindcss').Config} */
export default {
	content: ['./src/**/*.{html,js,svelte,ts}'],
	theme: {
		extend: {
			fontFamily: {
				montserrat: ['Montserrat', 'sans-serif']
			},
			colors: {
				pink: {
					100: '#FEF4F3'
				},
				blue: {
					primary: '#08688e'
				},
				red: {
					primary: '#DB5C54'
				}
			}
		}
	},
	plugins: []
};
