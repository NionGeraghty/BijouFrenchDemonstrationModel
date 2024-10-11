<script lang="ts">
	import { asset } from '$lib/util';
	import type { PageData } from './$types';
	import { accessCodes } from '$lib/shared/stores/accessCodes';

	export let data: PageData;

	// does this course require a code?
	const requiresCode = data.course.access_code !== null;
	let codeInput = $accessCodes[data.course.id] || '';

	// if the user enters a code, save it to localStorage
	$: if (codeInput) {
		accessCodes.set({ ...$accessCodes, [data.course.id]: codeInput });
	}

	$: unlocked =
		!requiresCode ||
		($accessCodes[data.course.id] || '').toLowerCase() ===
			(data.course.access_code || '').toLowerCase();
</script>

{#if unlocked}
	<ul class="posts pt-10 pb-16">
		{#each data.course.activities as activity, i}
			<li class="flex pb-4 flex-col md:flex-row items-start">
				<p class="md:flex-[0_0_400px]">
					Week {i + 1}: {activity.title}
				</p>
				{#if activity.worksheet}
					<a
						class="mx-5 md:block whitespace-nowrap text-blue-primary hover:underline"
						href={`https://admin.bijoufrench.boost.dev/api/activities/${activity.id}/worksheet`}
						>Activity Sheet</a
					>
				{/if}
				{#if activity.answers}
					<a
						class="mx-5 md:block whitespace-nowrap text-blue-primary hover:underline"
						href={`https://admin.bijoufrench.boost.dev/api/activities/${activity.id}/answers`}
						>Answers</a
					>
				{/if}
			</li>
		{/each}
	</ul>
{:else}
	<p class="text-center mt-10">This course requires an access code.</p>
	<p>Please enter your code below</p>
	<input
		type="text"
		class="p-2"
		bind:value={codeInput}
		on:input={() => accessCodes.set({ ...$accessCodes, [data.course.id]: codeInput })}
	/>
{/if}

<style>
	input {
		border: 1px solid #666;
		border-radius: 4px;
		margin-top: 10px;
		margin-bottom: 80px;
	}
</style>
