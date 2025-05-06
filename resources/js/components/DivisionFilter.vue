<template>
    <div class="mb-4 dropdown">
        <select v-model="internalValue" class="p-2 border rounded">
            <option v-for="division in divisions" :key="division.id" :value="division.name">
                {{ division.name }}
            </option>
        </select>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: String,
    divisions: Array,
});

const emit = defineEmits(['update:modelValue']);

const internalValue = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value),
});
</script>

<style scoped></style>
