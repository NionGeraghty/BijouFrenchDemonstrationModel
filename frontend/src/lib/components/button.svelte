<script>
	import { cn } from '$lib/util';

	export let classes = '';
	export let variant = 'primary';
</script>

<button
	on:click
	class={cn(
		'border p-2 px-4 w-[140px] rounded-sm ',
		{
			'bg-blue-primary text-white': variant === 'primary',
			'bg-transparent border border-gray-700 opacity-60 hover:opacity-100': variant === 'outline'
		},
		classes
	)}
>
	<slot />
</button>
