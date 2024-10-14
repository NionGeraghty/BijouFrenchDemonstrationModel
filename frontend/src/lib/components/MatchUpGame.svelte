<script>
	export let game;
	export let next;

	// Reactive state
	$: questions = [...game.questions];
	$: answers = [...game.answers];
	$: moved = questions.map((question) => false);

	$: showTip = false;
	$: showSuccess = false;
	$: gameWon = false;
	$: selected = undefined;

	$: resetGameState(game);

	function resetGameState(game) {
		console.log('here', game);
		if (!game) return; // Prevent errors if `game` is null or undefined

		questions = [...game.questions];
		answers = [...game.answers];
		moved = questions.map((question) => false);
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

	function resetOne(button) {
		moved = moved.map((item) => {
			if (item === button) {
				return false;
			}

			return item;
		});
		answers = [...answers, button];
		hideFeedback();
	}

	// Move button between sections
	function move(to) {
		if (gameWon) return;

		answers = answers.filter((b) => b !== selected);

		moved = moved.map((item, i) => {
			if (to.dataset.answer === i) {
				return selected;
			}

			return item;
		});

		selected = undefined;
		evaluateAnswer();
	}

	function isAnswerComplete() {
		return answers.length === 0;
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
		questions = [...game.questions];
		answers = [...game.answers];
		moved = questions.map((question) => false);
		selected = undefined;

		hideFeedback();
	}

	function isGameWon() {
		// each moved item should match the answer
		return moved.every((button, i) => button.dataset.answer == i);
	}
</script>

<div class="game w-full">
	<p class="mb-4">Match the following answers to the right question:</p>
	<div class="tip bg-orange-300 p-10 font-bold rounded-lg" class:visible={showTip}>
		{game.hint ? game.hint : 'Not quite right. Try again!'}
	</div>
	<div class="success bg-green-400 p-10 font-bold rounded-lg" class:visible={showSuccess}>
		Well done!
	</div>
	<slot />
	<div class="answers">
		{#each answers as button}
			<div>
				<button class:selected={button === selected} on:click={() => select(button)}
					>{button.text}</button
				>
			</div>
		{/each}
	</div>

	<div class="question">
		{#each questions as button, i}
			<div>
				<p>
					{button.text}
				</p>
				{#if moved[i]}
					<button on:click={() => resetOne(moved[i])}>{moved[i].text}</button>
				{:else}
					<button class="select" class:visible={selected} on:click={() => move(button)}
						>Select</button
					>
				{/if}
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
		flex-direction: column;
	}

	.question p {
		font-weight: bold;
	}

	.answers {
		display: flex;
		flex-wrap: wrap;
		gap: 20px;
	}

	.answers button.selected {
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
