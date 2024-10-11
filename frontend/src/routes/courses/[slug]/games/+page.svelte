<script lang="ts">
	import { asset } from '$lib/util';
	import type { PageData } from './$types';
	import { accessCodes } from '$lib/shared/stores/accessCodes';
	import OrderTheWords from '$lib/components/OrderTheWords.svelte';
	import OddOneOut from '$lib/components/OddOneOut.svelte';

	export let data: PageData;

	// does this course require a code?
	const requiresCode = data.course.access_code !== null;
	let codeInput = $accessCodes[data.course.id] || '';

	// if the user enters a code, save it to localStorage
	$: if (codeInput) {
		accessCodes.set({ ...$accessCodes, [data.course.id]: codeInput });
	}

	$: unlocked =
		!requiresCode ||
		($accessCodes[data.course.id] || '').toLowerCase() ===
			(data.course.access_code || '').toLowerCase();

	const reorderGames = data.course.reorder_games ? data.course.reorder_games : ([] as any[]);
	const oddOneOutGames = data.course.odd_one_out_games
		? data.course.odd_one_out_games
		: ([] as any[]);

	const reorderGamesData = reorderGames.map((game) => {
		const solution = game.fields.solution.split(' ').map((word: string) => word.trim());
		const question = game.fields.question.split(' ').map((word: string) => word.trim());
		return {
			type: 'order-the-words',
			hint: game.fields.hint,
			questionButtons: question.map((word) => {
				return { text: word, dataset: { answer: solution.indexOf(word) } };
			})
		};
	});

	const oddOneOutGamesData = oddOneOutGames.map((game) => {
		const solution = game.fields.solution;
		const question = game.fields.question.split('\n').map((word: string) => word.trim());
		return {
			type: 'odd-one-out',
			hint: game.fields.hint,

			questionButtons: question.map((word) => {
				return { text: word, dataset: { answer: solution === word } };
			})
		};
	});

	let currentGameIndex = 0;
	const nextGame = () => {
		if (currentGameIndex < games.length - 1) {
			currentGameIndex += 1;
		} else {
			currentGameIndex = null;
		}
	};

	let games = [
		// {
		// 	type: 'order-the-words',
		// 	questionButtons: [
		// 		{ text: 'one', dataset: { answer: 0 } },
		// 		{ text: 'two', dataset: { answer: 1 } },
		// 		{ text: 'three', dataset: { answer: 2 } }
		// 	]
		// }
		...reorderGamesData,
		...oddOneOutGamesData
	];

	// only the current game
	$: currentGame = games[currentGameIndex];
</script>

{#if unlocked}
	<div class="mt-10">
		{#if currentGame && currentGame.type === 'order-the-words'}
			<OrderTheWords game={currentGame} next={nextGame} />
		{:else if currentGame && currentGame.type === 'odd-one-out'}
			<OddOneOut game={currentGame} next={nextGame} />
		{:else}
			<p>All games complete. Well done!</p>
		{/if}
	</div>
{:else}
	<p class="text-center mt-10">This course requires an access code.</p>
	<p>Please enter your code below</p>
	<input
		type="text"
		class="p-2"
		bind:value={codeInput}
		on:input={() => accessCodes.set({ ...$accessCodes, [data.course.id]: codeInput })}
	/>
{/if}

<style>
	input {
		border: 1px solid #666;
		border-radius: 4px;
		margin-top: 10px;
		margin-bottom: 80px;
	}
</style>
