<template>
    <div class="mb-4 dropdown">
        <ul class="division-list">
            <li v-for="division in divisions" :key="division.id" class="division-item"
                :class="{ 'selected': internalValue === division.name }" @click="selectDivision(division.name)">
                <img class="avdk-icon" src="https://www.avkempen.be/assets/images/logo.png" /> {{ division.name }}
            </li>
        </ul>
    </div>
</template>

<script>
import { computed } from 'vue';

export default {
    props: {
        modelValue: {
            type: String,
            required: false,
        },
        divisions: {
            type: Array,
            required: true,
        },
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
        const internalValue = computed({
            get: () => props.modelValue,
            set: (value) => emit('update:modelValue', value),
        });

        const selectDivision = (value) => {
            internalValue.value = value;
        };

        return {
            internalValue,
            selectDivision,
        };
    },
};
</script>

<style scoped>
.avdk-icon {
    width: 24px;
    height: 24px;
    margin-right: 0.5rem;
}

.dropdown {
    padding: 1rem;
    background-color: white;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    border-radius: 0.5rem;
}

.division-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.division-item {
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    cursor: pointer;
    border-radius: 0.25rem;
    transition: background-color 0.2s;
    font-size: 0.85rem;
}

.division-item:hover {
    background-color: #f3f4f6;
}

.division-item.selected {
    background-color: #e5e7eb;
    font-weight: 600;
}

.icon {
    margin-right: 0.5rem;
}
</style>
