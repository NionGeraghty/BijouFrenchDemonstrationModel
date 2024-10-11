<script>
	import Footer from './Footer.svelte';
	import Header from './Header.svelte';
	import './styles.css';
</script>

<div class="app min-h-screen flex flex-col">
	<Header />

	<main class="flex-1 flex flex-col">
		<slot />
	</main>

	<Footer />
</div>
