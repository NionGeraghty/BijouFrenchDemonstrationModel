<script lang="ts">
	import { onMount } from 'svelte';
	import Button from '../button.svelte';
	import { Pencil } from 'lucide-svelte';
	import IconButton from '../ui/icon-button.svelte';

	export let action: string;
	export let label: string;
	export let enctype: string = 'multipart/form-data';

	let classes = '';
	export { classes as class };

	let formElement: HTMLFormElement;

	onMount(() => {
		formElement.reset();
	});

	let editing = false;
</script>

<form method="POST" {action} bind:this={formElement} {enctype} class={classes}>
	{#if editing}
		<slot />
		<Button classes="">Save</Button>
		<Button
			variant="outline"
			classes=""
			on:click={(e) => {
				e.preventDefault();
				formElement.reset();
				editing = false;
			}}>Cancel</Button
		>
	{:else}
		{label}
		<IconButton
			classes=""
			on:click={(e) => {
				e.preventDefault();
				editing = true;
			}}><Pencil class="w-4 h-4" /></IconButton
		>
	{/if}
</form>
