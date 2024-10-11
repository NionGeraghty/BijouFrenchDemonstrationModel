<script lang="ts">
	import Button from '../button.svelte';
	import TextInput from './text-input.svelte';

	export let title: string;
</script>

<form method="POST" action="/dashboard?/newCohort">
	<label for="title" class="block">
		<span>Title</span>
		<TextInput id="title" name="title" bind:value={title} />
	</label>
	<Button classes="mt-2">confirm</Button>
</form>
