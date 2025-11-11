<script lang="ts">
	import { cn } from '$lib/util';

	export let className: string = '';
</script>

<div class={cn('mx-auto max-w-[1200px] px-2', className)}>
	<slot />
</div>
