<script>
	import Container from '$lib/components/ui/container.svelte';
</script>

<section class="bg-pink-100 flex-1">
	<Container>
		<div class="flex flex-col lg:flex-row justify-between pt-32 lg:pt-20 items-center">
			<p class="pl-10 sm:pt-0 pt-4">
				<img src="/children.png" alt="Students" width="300" height="163" />
			</p>
			<div class="pt-6 lg:pt-20 pb-20">
				<p class="text-center lg:text-left font-semibold text-[35px] text-[#aa837e] leading-none">
					Welcome to
				</p>
				<h1
					class="text-center lg:text-left font-bold text-[70px] mt-2 tracking-tighter text-blue-primary leading-[1]"
				>
					Bijou French
				</h1>
				<h2 class="text-lg pt-10">French club for primary school children</h2>
				<ul class="list-disc pl-8 py-4">
					<li>Fun and engaging lessons in a relaxed and happy atmosphere.</li>
					<li>Action games, team activities, magic, songs, and much more…</li>
					<li>Extra resources and challenges on the website.</li>
				</ul>
				<p>Join us at Bijou French for a fun-filled French adventure!</p>
				<div class="flex justify-around pt-10 pb-6">
					<a
						class="bg-blue-primary inline-block rounded-md text-white py-2 px-4"
						href="/courses/mini-bijou">Mini Bijou</a
					>
					<a
						class="bg-blue-primary inline-block rounded-md text-white py-2 px-4"
						href="/courses/petit-bijou">Petit Bijou</a
					>
					<!-- <a
						class="bg-blue-primary inline-block rounded-md text-white py-2 px-4"
						href="/courses/top-bijou">Top Bijou</a
					> -->
				</div>
			</div>
		</div>
	</Container>
</section>
