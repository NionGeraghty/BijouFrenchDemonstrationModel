<script lang="ts">
	import type { Article } from '$lib/types';
	import Container from '$lib/components/ui/container.svelte';

	export let article: Article;
</script>

<main class="bg-pink-100 py-10">
	<Container>
		<div class="max-w-[890px] prose">
			{#if article.text}
				<div>{@html article.text}</div>
			{/if}
		</div>
	</Container>
</main>
