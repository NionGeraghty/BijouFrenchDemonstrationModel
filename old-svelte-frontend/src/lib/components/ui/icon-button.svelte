<script>
	import { cn } from '$lib/util';

	export let classes = '';
</script>

<button
	on:click
	class={cn('hover:bg-black/10 hover:opacity-100 opacity-60 text-red p-1  rounded-sm ', classes)}
>
	<slot />
</button>
