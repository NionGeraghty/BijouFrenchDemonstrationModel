<script>
	export let game;
	export let next;

	// Reactive state
	$: questionButtons = [...game.questionButtons].sort(() => Math.random() - 0.5); // Bind buttons
	let categories = Object.entries(
		game.questionButtons.reduce((acc, button) => {
			if (!acc[button.dataset.category]) {
				acc[button.dataset.category] = [];
			}

			return acc;
		}, {})
	).sort((a, b) => a[0].localeCompare(b[0]));

	$: showTip = false;
	$: showSuccess = false;
	$: gameWon = false;
	$: selected = undefined;

	$: resetGameState(game);

	function resetGameState(game) {
		console.log('here', game);
		if (!game) return; // Prevent errors if `game` is null or undefined

		// Shuffle question buttons and reset other states
		questionButtons = [...game.questionButtons];

		showTip = false;
		showSuccess = false;
		gameWon = false;
		selected = undefined;
	}

	// selected a button
	function select(button) {
		if (gameWon) return;

		selected = button;
	}

	function addToCategory(button, category) {
		const catIndex = categories.findIndex((cat) => cat[0] === category);

		categories = categories.map((cat, i) => {
			if (i === catIndex) {
				return [cat[0], [...cat[1], button]];
			}

			return cat;
		});
	}

	function removeFromCategory(button, category) {
		if (gameWon) return;

		const catIndex = categories.findIndex((cat) => cat[0] === category);

		categories = categories.map((cat, i) => {
			if (i === catIndex) {
				return [cat[0], cat[1].filter((b) => b !== button)];
			}

			return cat;
		});

		questionButtons = [...questionButtons, button];

		// hide feedback
		hideFeedback();
	}

	// Move button between sections
	function move(category) {
		if (gameWon) return;

		questionButtons = questionButtons.filter((b) => b !== selected);

		addToCategory(selected, category);

		selected = undefined;
		evaluateAnswer();
	}

	function isAnswerComplete() {
		return questionButtons.length === 0;
	}

	function hideFeedback() {
		showTip = false;
		showSuccess = false;
	}

	function evaluateAnswer() {
		if (!isAnswerComplete()) {
			hideFeedback();
			return;
		}

		if (isGameWon()) {
			showSuccess = true;
			gameWon = true;
		} else {
			showTip = true;
		}
	}

	function resetState() {
		questionButtons = [...game.questionButtons];
		categories = Object.entries(
			game.questionButtons.reduce((acc, button) => {
				if (!acc[button.dataset.category]) {
					acc[button.dataset.category] = [];
				}

				return acc;
			}, {})
		).sort((a, b) => a[0].localeCompare(b[0]));
		hideFeedback();
	}

	function isGameWon() {
		// each category should only have buttons with the same category in dataset
		return categories.every(([key, buttons]) => {
			return buttons.every((button) => button.dataset.category === key);
		});
	}
</script>

<div class="game w-full">
	<p class="mb-8">Place the following words in the correct category:</p>
	<div class="tip bg-orange-300 p-10 font-bold rounded-lg" class:visible={showTip}>
		{game.hint ? game.hint : 'Not quite right. Try again!'}
	</div>
	<div class="success bg-green-400 p-10 font-bold rounded-lg" class:visible={showSuccess}>
		Well done!
	</div>
	<slot />
	<div class="question">
		{#each questionButtons as button}
			<button class:selected={button === selected} on:click={() => select(button)}
				>{button.text}</button
			>
		{/each}
	</div>

	<div class="answers">
		{#each categories as [key, buttons]}
			<div class="answer-container">
				<p>{key}</p>
				{#each buttons as button}
					<button on:click={() => removeFromCategory(button, key)}>{button.text}</button>
				{/each}
				<button class="select" class:visible={selected} on:click={() => move(key)}>Select</button>
			</div>
		{/each}
	</div>

	{#if gameWon}
		<button on:click={next} class="next">Next</button>
	{:else}
		<button on:click={resetState} class="reset">Reset</button>
	{/if}
</div>

<style>
	.w-full {
		width: 100vw;
		max-width: 860px;
	}

	.question {
		display: flex;
		flex-wrap: wrap;
		gap: 20px;
		margin-top: 20px;
	}

	.answers {
		display: flex;
		margin-top: 20px;
		flex-wrap: wrap;
		gap: 20px;
	}

	.answer-container {
		padding: 10px;
		display: flex;
		flex-direction: column;
		flex: 1;
		background-color: rgba(0, 0, 0, 0.05);
		min-height: 240px;
		min-width: 170px;
	}

	.answer-container p {
		padding-bottom: 6px;
		padding-left: 10px;
		border-bottom: 1px solid #aaa;
	}
	.answer-container button {
		margin-top: 8px;
	}

	.question button.selected {
		background-color: #08688e;
		color: #fff;
	}

	.next {
		margin-top: 30px;
		color: #fff;
		background: #eaad39;
		border-radius: 5px;
		font-weight: bold;
		padding: 10px 20px;
	}

	.reset {
		margin-top: 30px;
		border: 1px solid #666;
		border-radius: 5px;
		padding: 10px;
		margin-bottom: 10px;
	}

	.answers button,
	.question button {
		background-color: #47d083;
		padding: 10px;
		border-radius: 5px;
	}

	.select {
		display: none;
		margin-top: 10px;
		background-color: #08688e !important;
		color: #fff;
	}

	.select.visible {
		display: block;
	}

	.visible {
		display: block;
	}

	.tip {
		display: none;
	}

	.success {
		display: none;
	}

	.tip.visible {
		display: block;
	}

	.success.visible {
		display: block;
	}
</style>
