<script>
	export let game;
	export let next;

	// Reactive state
	$: questionButtons = [...game.questionButtons].sort(() => Math.random() - 0.5); // Bind buttons
	$: selected = undefined;
	$: showTip = false;
	$: showSuccess = false;
	$: gameWon = false;

	$: resetGameState(game);

	function resetGameState(game) {
		if (!game) return;

		questionButtons = [...game.questionButtons].sort(() => Math.random() - 0.5);

		showTip = false;
		showSuccess = false;
		gameWon = false;
	}

	// Move button between sections
	function select(button) {
		if (gameWon) return;

		selected = button;

		evaluateAnswer();
	}

	function isAnswerComplete() {
		return selected !== undefined;
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
		questionButtons = [...game.questionButtons].sort(() => Math.random() - 0.5);
		selected = undefined;
		hideFeedback();
	}

	function isGameWon() {
		return selected.dataset.answer;
	}
</script>

<div class="game">
	<p class="mb-8">Select the odd one out:</p>
	<div class="tip bg-orange-300 p-10 font-bold rounded-lg" class:visible={showTip}>
		{game.hint ? game.hint : 'Not quite right. Try again!'}
	</div>
	<div class="success bg-green-400 p-10 font-bold rounded-lg" class:visible={showSuccess}>
		Well done!
	</div>
	<slot />
	<div class="question">
		{#each questionButtons as button}
			<button class:selected={selected == button} on:click={() => select(button)}
				>{button.text}</button
			>
		{/each}
	</div>

	{#if gameWon}
		<button on:click={next} class="next">Next</button>
	{:else}
		<button on:click={resetState} class="reset">Reset</button>
	{/if}
</div>

<style>
	.question {
		display: flex;
		flex-wrap: wrap;
		gap: 20px;
		margin-top: 20px;
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
	}

	.question button {
		background-color: #47d083;
		padding: 10px;
		border-radius: 5px;
	}

	.question button.selected {
		background-color: #08688e;
		color: #fff;
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
