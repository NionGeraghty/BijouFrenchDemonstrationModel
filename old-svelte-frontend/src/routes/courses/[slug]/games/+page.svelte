<script lang="ts">
	import { asset } from '$lib/util';
	import type { PageData } from './$types';
	import { accessCodes } from '$lib/shared/stores/accessCodes';
	import OrderTheWords from '$lib/components/OrderTheWords.svelte';
	import OddOneOut from '$lib/components/OddOneOut.svelte';
	import CategoryGame from '$lib/components/CategoryGame.svelte';
	import MatchUpGame from '$lib/components/MatchUpGame.svelte';

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
	const categoryGames = data.course.category_games ? data.course.category_games : ([] as any[]);
	const matchUpGames = data.course.match_up_games ? data.course.match_up_games : ([] as any[]);

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

	const categoryGamesData = categoryGames.map((game) => {
		const items = game.fields.game
			.split('\n')
			.map((item) => {
				try {
					const [text, category] = item.split(':');
					return { text: text.trim(), dataset: { category: category.trim() } };
				} catch (e) {
					console.error('Error parsing category game item', e);
					return null;
				}
			})
			.filter((item) => item !== null);
		return {
			type: 'category-game',
			hint: game.fields.hint,
			questionButtons: items
		};
	});

	const matchUpGamesData = matchUpGames.map((game) => {
		const items = game.fields.game.split('\n');

		const questions: any = [];
		const answers: any = [];

		items.forEach((item, i) => {
			try {
				const [text, match] = item.split(':');
				questions.push({ text: text.trim(), dataset: { answer: i } });
				answers.push({ text: match.trim(), dataset: { answer: i } });
			} catch (e) {
				console.error('Error parsing match up game item', e);
				return null;
			}
		});

		// randomize the order of the answers
		answers.sort(() => Math.random() - 0.5);

		return {
			type: 'match-up-game',
			hint: game.fields.hint,
			questions,
			answers
		};
	});

	let currentGameIndex = 0;
	const nextGame = async () => {
		// update the completedAt timestamp
		attemptData.timestamps[currentGameIndex].completedAt = new Date().toISOString();

		if (currentGameIndex < games.length - 1) {
			currentGameIndex += 1;
			// update the startedAt timestamp
			attemptData.timestamps[currentGameIndex].startedAt = new Date().toISOString();
		} else {
			currentGameIndex = null;
			// all done. update the completedAt timestamp
			attemptData.completedAt = new Date().toISOString();
		}

		// sync the game data
		await syncGameData();
	};

	let games = [
		...reorderGamesData,
		...oddOneOutGamesData,
		...categoryGamesData,
		...matchUpGamesData
	];

	async function syncGameData() {
		try {
			const response = await fetch('/api/game', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(attemptData)
			});
			const result = await response.json();
			// if result has a nonce and we dont have it saved then add it to the attemptData
			if (result.nonce && !attemptData.nonce) {
				attemptData.nonce = result.nonce;
			}
			console.log('Sync successful:', result);
		} catch (error) {
			console.error('Failed to sync data:', error);
		}
	}

	// attempt data
	$: attemptData = {
		name: undefined,
		startedAt: undefined,
		completedAt: undefined,
		nonce: undefined,
		course: data.slug,
		timestamps: games.map((game) => ({
			type: game.type,
			startedAt: undefined,
			completedAt: undefined
		}))
	};

	$: nameInput = '';

	const startGames = async (name) => {
		attemptData.name = name;
		attemptData.startedAt = new Date().toISOString();
		attemptData.timestamps[0].startedAt = new Date().toISOString();
		await syncGameData();
	};

	// only the current game
	$: currentGame = games[currentGameIndex];
</script>

{#if unlocked}
	<div class="mt-10">
		{#if !attemptData.name}
			<p>Enter your name to begin</p>
			<form
				on:submit={() => {
					startGames(nameInput);
				}}
			>
				<input type="text" bind:value={nameInput} minlength="2" />
				<button class="game-start"> Start </button>
			</form>
		{:else if currentGame && currentGame.type === 'order-the-words'}
			<OrderTheWords game={currentGame} next={nextGame} />
		{:else if currentGame && currentGame.type === 'odd-one-out'}
			<OddOneOut game={currentGame} next={nextGame} />
		{:else if currentGame && currentGame.type === 'category-game'}
			<CategoryGame game={currentGame} next={nextGame} />
		{:else if currentGame && currentGame.type === 'match-up-game'}
			<MatchUpGame game={currentGame} next={nextGame} />
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
		padding: 6px;
	}

	.game-start {
		display: block;
		margin-top: 20px;
		background-color: #08688e;
		color: #fff;
		padding: 10px;
		border-radius: 5px;
	}
</style>
