<script lang="ts">
	import Article from '../../Article.svelte';
	import Banner from '$lib/components/ui/banner.svelte';
	import Breadcrumbs from '$lib/components/ui/breadcrumbs.svelte';
	import type { PageData } from './$types';

	export let data: PageData;

	$: crumbs = [
		{
			title: 'Home',
			url: '/'
		},
		{
			title: data.article?.title,
			url: data.article?.slug
		}
	];
</script>

<Banner>{data.article?.title}</Banner>
<Breadcrumbs breadcrumbs={crumbs} />

{#if data.article}
	<Article article={data.article} />
{:else}
	<p>Article not found</p>
{/if}

<slot />
