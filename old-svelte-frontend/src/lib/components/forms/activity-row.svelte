<script lang="ts">
	import { ChevronDown, ChevronUp } from 'lucide-svelte';
	import type { Activity } from '../../types';
	import IconButton from '../ui/icon-button.svelte';
	import TextInput from './text-input.svelte';
	import ToggleableForm from './toggleable-form.svelte';
	import { filename } from '../../util';

	export let activity: Activity;
</script>

<div class="grid grid-cols-[4fr_1fr] row py-2 px-3">
	<div>
		<div>
			<ToggleableForm action="?/updateActivityTitle" label={activity.title}>
				<input type="hidden" name="activityId" value={activity.id} />
				<TextInput type="text" name="title" value={activity.title} autofocus />
			</ToggleableForm>
		</div>

		<div class="text-sm mt-2">
			<p class="flex items-center gap-2">
				<span> Worksheet: </span>
				<ToggleableForm
					class="flex items-center gap-2"
					action="?/uploadWorksheet"
					label={activity.worksheet ? filename(activity.worksheet) : '-'}
				>
					<input type="hidden" name="activityId" value={activity.id} />
					<input type="file" name="worksheet" />
				</ToggleableForm>
			</p>
			<p class="flex items-center gap-2">
				<span> Answers: </span>
				<ToggleableForm
					class="flex items-center gap-2"
					action="?/uploadAnswers"
					label={activity.answers ? filename(activity.answers) : '-'}
				>
					<input type="hidden" name="activityId" value={activity.id} />
					<input type="file" name="answers" />
				</ToggleableForm>
			</p>
		</div>
	</div>

	<div>
		<IconButton>
			<ChevronUp />
		</IconButton>
		<IconButton>
			<ChevronDown />
		</IconButton>
	</div>
</div>

<style>
	.row:nth-child(odd) {
		background-color: #00000004;
	}
</style>
