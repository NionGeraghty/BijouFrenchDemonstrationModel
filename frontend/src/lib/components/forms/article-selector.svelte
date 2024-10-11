<script lang="ts">
	import Button from '$lib/components/button.svelte';

	type Option = {
		value: number;
		label: string;
	};

	import { page } from '$app/stores';
	import type { PageData } from '../../../routes/dashboard/courses/[courseId]/$types';

	const data = $page.data as PageData;

	// export let cohortId: number;

	export let currentId: number = -1;
	const current = data.articles.find((article) => article.id === currentId);
	const notSelected = data.articles.filter((article) => article.id !== currentId);
	let selectedId: number | undefined;

	$: changed = selectedId != undefined && selectedId != currentId;
</script>

<form method="POST" action={`/dashboard/courses/${data.course.id}?/selectDescription`}>
	<select bind:value={selectedId} name="article_id">
		<option value="-1">Select an article</option>

		{#if current}
			<option value={current.id} selected>
				{current.title}
			</option>
		{/if}

		{#each notSelected as option}
			<option value={option.id}>{option.title}</option>
		{/each}
	</select>

	<input type="hidden" name="courseId" value={data.course.id} />

	{#if changed}
		<Button>Save</Button>
		<button on:click={() => (selectedId = currentId)}>Reset</button>
	{/if}
</form>

<style>
	select {
		padding: 10px;
	}
</style>
