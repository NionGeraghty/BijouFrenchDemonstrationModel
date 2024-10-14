export async function POST({ request, locals }) {
	const body = await request.json();

	// if the data doesn't have a nonce generate one 24 chars
	if (!body.nonce) {
		body.nonce = Array.from({ length: 24 }, () => Math.floor(Math.random() * 24).toString(24)).join(
			''
		);
	}

	// Perform actions to save/sync the data (e.g., update a database)
	console.log('Received data:', body);

	await locals.services.courses.logGameAttempt(body);

	return new Response(JSON.stringify({ success: true, nonce: body.nonce }), { status: 200 });
}
