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
    :type="type" 
    class="btn btn-outline-success text-xs uppercase">
    <slot />
    </button>
</template>