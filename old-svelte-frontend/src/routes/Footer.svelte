<script>
	import Container from '$lib/components/ui/container.svelte';
</script>

<div class="py-6 bg-[#7EB1C2] text-white/80">
	<Container>
		<div class="flex flex-col sm:flex-row justify-between items-center">
			<img alt="Bijou French" src="/flag-logo.png" width="250" height="110" />

			<nav class="sm:pt-0 pt-4">
				<h2 class="uppercase tracking-widest mb-2">Navigate</h2>
				<ul class="color-[#08688e] text-sm">
					<li>
						<a class="" href="/"> Home </a>
					</li>
					<li>
						<a class="" href="/courses"> Courses </a>
					</li>
					<li>
						<a class="" href="/about-bijou-french"> About Bijou French </a>
					</li>
					<li>
						<a class="" href="/about-sue"> About Sue </a>
					</li>
					<!-- <li>
						<a class="" href="/login"> Login</a>
					</li> -->
				</ul>
			</nav>
		</div>
	</Container>
</div>
<div class="bg-[#08688e] text-white/50 text-sm py-2">
	<Container>
		<p>
			© Copyright {new Date().getFullYear()} Susannah Backley trading as Bijou French
		</p>
	</Container>
</div>
