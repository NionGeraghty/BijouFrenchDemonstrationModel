<script lang="ts">
	import { ChevronDown, ChevronUp } from 'lucide-svelte';
	import type { Song } from '../../types';
	import IconButton from '../ui/icon-button.svelte';
	import TextInput from './text-input.svelte';
	import ToggleableForm from './toggleable-form.svelte';
	import { filename } from '../../util';

	export let song: Song;
</script>

<div class="grid grid-cols-[4fr_1fr] row py-2 px-3">
	<div>
		<div>
			<ToggleableForm action="?/updateSongTitle" label={song.title}>
				<input type="hidden" name="songId" value={song.id} />
				<TextInput type="text" name="title" value={song.title} autofocus />
			</ToggleableForm>
		</div>

		<div class="text-sm mt-2">
			<p class="flex items-center gap-2">
				<span> MP3: </span>
				<ToggleableForm
					class="flex items-center gap-2"
					action="?/uploadMp3"
					label={song.mp3 ? filename(song.mp3) : '-'}
				>
					<input type="hidden" name="songId" value={song.id} />
					<input type="file" name="worksheet" />
				</ToggleableForm>
			</p>
			<p class="flex items-center gap-2">
				<span> Lyrics: </span>
				<ToggleableForm
					class="flex items-center gap-2"
					action="?/uploadLyrics"
					label={song.lyrics ? filename(song.lyrics) : '-'}
				>
					<input type="hidden" name="songId" value={song.id} />
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
