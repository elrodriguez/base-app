<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: {
        type: [String, null, Number],
        required: true,
    },
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        step="any"
        class="form-input"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
        autocomplete="off"
    />
</template>
