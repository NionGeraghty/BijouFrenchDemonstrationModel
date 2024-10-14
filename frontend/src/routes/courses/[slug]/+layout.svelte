<script lang="ts">
	import Banner from '$lib/components/ui/banner.svelte';
	import Breadcrumbs from '$lib/components/ui/breadcrumbs.svelte';
	import Container from '$lib/components/ui/container.svelte';

	import type { PageData } from './$types';

	export let data: PageData;

	const slug = `/courses/${data.article.slug}`;

	const crumbs = [
		{
			title: 'Home',
			url: '/'
		},
		{
			title: 'Courses',
			url: '/courses'
		},
		{
			title: data.article.title,
			url: slug
		}
	];
</script>

<Banner>{data.article.title}</Banner>
<Breadcrumbs breadcrumbs={crumbs} />

<div class="bg-pink-100 flex-1">
	<Container>
		<div class="flex flex-col md:flex-row justify-between items-stretch">
			<div class="pr-10 order-[2]">
				<slot />
			</div>
			<div class="order-[1] md:order-[3] pt-10">
				<div class="sticky top-2 flex flex-col items-center pb-10">
					<a class="mb-4 block" href={`${slug}/activity-sheets`}>
						<img src="/activity-sheets.png" alt="Activity Sheets" />
					</a>
					<a class="mb-4 block" href={`${slug}/songs`}>
						<img src="/songs.png" alt="Songs" />
					</a>

					{#if data.course.games_active}
						<a class="mb-4 block" href={`${slug}/games`}>
							<img src="/games.png" alt="Games" />
						</a>
					{/if}
				</div>
			</div>
		</div>
	</Container>
</div>
