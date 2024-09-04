<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});
</script>
<template>
    <button
        :type="type"
        :disabled="disabled"
        :style="disabled ? 'cursor: not-allowed': ''"
        class="btn btn-primary uppercase text-xs"
    >
        <slot />
    </button>
</template>
