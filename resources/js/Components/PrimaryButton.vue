<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});
</script>
<template>
    <button
        :disabled="disabled"
        :style="disabled ? 'cursor: not-allowed': ''"
        class="btn btn-primary uppercase text-xs"
    >
        <slot />
    </button>
</template>
