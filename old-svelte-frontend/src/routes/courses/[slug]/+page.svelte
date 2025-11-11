<script lang="ts">
	import Article from '../../Article.svelte';

	import type { PageData } from './$types';

	export let data: PageData;
</script>

{#if data.article}
	<Article article={data.article} />
{:else}
	<p>Article not found</p>
{/if}
