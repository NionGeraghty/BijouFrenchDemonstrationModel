<script lang="ts">
	import type { Breadcrumb } from '$lib/types';
	import Container from './container.svelte';

	export let breadcrumbs: Breadcrumb[];
</script>

<div class="border-y border-y-[#bbd8d6]">
	<Container>
		<ul class="font-light text-sm flex py-4 flex-col sm:flex-row">
			{#each breadcrumbs as breadcrumb}
				{#if breadcrumb.url}
					<li>
						<a href={breadcrumb.url}>{breadcrumb.title}</a>
					</li>
				{:else}
					<li class="text-[#08688e]">{breadcrumb.title}</li>
				{/if}
			{/each}
		</ul>
	</Container>
</div>

<style>
	li:not(:first-child)::before {
		content: '»';
		margin-left: 10px;
		margin-right: 10px;
	}
</style>
