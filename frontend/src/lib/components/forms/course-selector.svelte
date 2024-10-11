<script lang="ts">
	import Button from '../button.svelte';

	type Option = {
		value: number;
		label: string;
	};

	export let options: Option[];
	export let current: Option = {
		value: -1,
		label: 'Select a course'
	};

	export let cohortId: number;

	let selectedId: number;

	$: changed = selectedId != undefined && selectedId != current?.value;
</script>

<form method="POST" action="/dashboard?/selectCourse">
	<select bind:value={selectedId} name="courseId">
		<option value="-1">Select a course</option>

		{#if current.value != -1}
			<option value={current.value} selected>
				{current.label}
			</option>
		{/if}

		{#each options as option}
			<option value={option.value}>{option.label}</option>
		{/each}
	</select>

	<input type="hidden" name="cohortId" value={cohortId} />
	<input type="hidden" name="originalCourseId" value={current?.value} />

	{#if changed}
		<Button>Save</Button>
		<button on:click={() => (selectedId = current.value)}>Reset</button>
	{/if}
</form>

<style>
	select {
		padding: 10px;
	}
</style>
