<script>
	import { page } from '$app/stores';

	import { cn } from '$lib/util';
	import { beforeNavigate } from '$app/navigation';
	import { signOut } from '@auth/sveltekit/client';
	import Container from '$lib/components/ui/container.svelte';

	// are we on the homepage?
	$: isHome = $page.url.pathname === '/';

	// toggle the mobile menu
	let menuOpen = false;
	const toggleMenu = () => {
		menuOpen = !menuOpen;
	};

	beforeNavigate(() => {
		menuOpen = false;
	});
</script>

<div class="absolute top-0 left-0 w-full pt-6">
	<Container>
		<div class="flex flex-wrap justify-between items-center text-white">
			<a href="/">
				<img
					class={cn('  max-w-[50vw]', {
						'max-h-[67px] w-[initial]': !isHome
					})}
					src="/flag-logo.png"
					width="250"
					alt="Bijou French"
					height="110"
				/>
			</a>
			<div class="block lg:hidden pr-6 absolute right-3 top-5">
				<button
					class="border px-2 py-2 border-blue-primary text-blue-primary bg-white"
					on:click={toggleMenu}
				>
					Menu
				</button>
			</div>
			<nav
				class={cn('lg:block', {
					'text-black': isHome
				})}
			>
				<button class="fixed top-3 hidden right-3 border px-2 py-2 border-white text-white">
					Cancel
				</button>
				<ul
					class={cn('hidden lg:flex menu', {
						'flex-col flex p-4 pt-20 fixed bg-blue-primary top-0 left-0 w-full h-full z-10 text-4xl text-white font-bold text-center':
							menuOpen
						// 'flex-row': !menuOpen
					})}
				>
					<li>
						<a class="px-3" href="/"> Home </a>
					</li>
					<li>
						<a class="px-3" href="/courses"> Courses </a>
					</li>
					<li>
						<a class="px-3" href="/about-bijou-french"> About Bijou French </a>
					</li>
					<li>
						<a class="px-3" href="/about-sue"> About Sue </a>
					</li>
					{#if $page.data.session}
						<li>
							<a
								class="px-3"
								href="/"
								on:click={(e) => {
									e.preventDefault();
									signOut();
								}}
							>
								Sign out
							</a>
						</li>
					{/if}
				</ul>
			</nav>
		</div>
	</Container>
</div>

<style>
	.menu.fixed li {
		margin-bottom: 30px;
	}
</style>
