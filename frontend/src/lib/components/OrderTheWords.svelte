<script>
	export let game;
	export let next;

	// Reactive state
	$: questionButtons = [...game.questionButtons].sort(() => Math.random() - 0.5); // Bind buttons
	$: answerButtons = [];
	$: showTip = false;
	$: showSuccess = false;
	$: gameWon = false;

	$: resetGameState(game);

	function resetGameState(game) {
		console.log('here', game);
		if (!game) return; // Prevent errors if `game` is null or undefined

		// Shuffle question buttons and reset other states
		questionButtons = [...game.questionButtons].sort(() => Math.random() - 0.5);
		answerButtons = [];
		showTip = false;
		showSuccess = false;
		gameWon = false;
	}

	// Move button between sections
	function move(button) {
		if (gameWon) return;

		if (questionButtons.includes(button)) {
			questionButtons = questionButtons.filter((b) => b !== button);
			answerButtons = [...answerButtons, button];
		} else {
			answerButtons = answerButtons.filter((b) => b !== button);
			questionButtons = [...questionButtons, button];
		}

		evaluateAnswer();
	}

	function isAnswerComplete() {
		console.log(questionButtons.length);
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
		questionButtons = [...game.questionButtons].sort(() => Math.random() - 0.5);
		answerButtons = [];
		hideFeedback();
	}

	function isGameWon() {
		console.log(answerButtons);
		return answerButtons.every((button, i) => button.dataset.answer == i);
	}
</script>

<div class="game">
	<p class="mb-8">Place the following words in the correct order:</p>
	<div class="tip bg-orange-300 p-10 font-bold rounded-lg" class:visible={showTip}>
		{game.hint ? game.hint : 'Not quite right. Try again!'}
	</div>
	<div class="success bg-green-400 p-10 font-bold rounded-lg" class:visible={showSuccess}>
		Well done!
	</div>
	<slot />
	<div class="question">
		{#each questionButtons as button}
			<button on:click={() => move(button)}>{button.text}</button>
		{/each}
	</div>

	<div class="answers">
		{#each answerButtons as button}
			<button on:click={() => move(button)}>{button.text}</button>
		{/each}
	</div>

	{#if gameWon}
		<button on:click={next} class="next">Next</button>
	{:else}
		<button on:click={resetState} class="reset">Reset</button>
	{/if}
</div>

<style>
	.answers,
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

	.answers button,
	.question button {
		background-color: #47d083;
		padding: 10px;
		border-radius: 5px;
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
