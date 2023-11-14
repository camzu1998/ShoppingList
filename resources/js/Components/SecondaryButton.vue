<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
    bg: {
        type: String,
        default: 'gray',
    },
});
</script>

<template>
    <button
        :type="type"
        :class="`bg-${bg}-600 text-${bg}-900 hover:bg-${bg}-50 focus:ring-2 focus:ring-${bg}-900`"
        class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm focus:outline-none disabled:opacity-25 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
