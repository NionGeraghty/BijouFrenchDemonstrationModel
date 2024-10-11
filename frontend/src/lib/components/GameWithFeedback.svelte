<script>
	export let game;

	// Reactive feedback state
	let showTip = false;
	let showSuccess = false;

	function hideFeedback() {
		showTip = false;
		showSuccess = false;
	}

	function evaluateAnswer() {
		// Placeholder for game-specific logic (to be overwritten)
		if (!isAnswerComplete()) {
			hideFeedback();
			return;
		}

		if (isGameWon()) {
			showSuccess = true;
		} else {
			showTip = true;
		}
	}

	// Placeholder for overriding
	function isAnswerComplete() {
		return game.question.children.length === 0;
	}

	function isGameWon() {
		// Default logic
		return false;
	}
</script>

<!-- Main template for feedback -->
<div class="game">
	<div class="tip" class:visible={showTip}>This is a hint</div>
	<div class="success" class:visible={showSuccess}>Success!</div>
	<slot />
</div>

<style>
	.visible {
		display: block;
	}
</style>
