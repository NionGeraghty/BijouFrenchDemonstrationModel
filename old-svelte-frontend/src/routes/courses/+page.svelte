<script lang="ts">
	import Container from '$lib/components/ui/container.svelte';
	import Banner from '$lib/components/ui/banner.svelte';
	import Breadcrumbs from '$lib/components/ui/breadcrumbs.svelte';

	const crumbs = [
		{
			title: 'Home',
			url: '/'
		},
		{
			title: 'Courses',
			url: '/courses'
		}
	];
</script>

<div class="flex flex-col flex-1">
	<Banner>Courses</Banner>
	<Breadcrumbs breadcrumbs={crumbs} />
	<div class="bg-pink-100 py-10 flex-1">
		<Container>
			<div class="flex flex-col sm:flex-row items-center justify-around py-10">
				<a class="mb-6 block" href="/courses/mini-bijou">
					<img src="/level-1-300x300.png" alt="Mini Bijou" />
					<span>Mini Bijou</span>
				</a>
				<a class="mb-6 block" href="/courses/petit-bijou">
					<img src="/level-2-300x300.png" alt="Petit Bijou" />
					<span>Petit Bijou</span>
				</a>
				<!-- <a class="mb-6 block" href="/courses/top-bijou">
					<img src="/level-3-300x300.png" alt="Top Bijou" />
					<span>Top Bijou</span>
				</a> -->
			</div>
		</Container>
	</div>
</div>

<style>
	a img {
		max-width: 140px;
		margin-bottom: 20px;
		display: block;
	}

	a {
		text-align: center;
		font-size: 24px;
		display: block;
	}
	a span {
		font-weight: bold;
	}
</style>
