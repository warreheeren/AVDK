<template>
    <div class="date-filter">
        <select id="matchDate" v-model="localSelectedDate" class="p-2 border rounded">
            <option v-for="date in uniqueMatchDates" :key="date" :value="date">
                {{ formatDate(date) }}
            </option>
        </select>
    </div>
</template>

<script>
export default {
    props: {
        uniqueMatchDates: {
            type: Array,
            required: true
        },
        selectedDate: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            localSelectedDate: this.selectedDate
        };
    },
    watch: {
        localSelectedDate(newVal) {
            this.$emit('update:selectedDate', newVal);
        },
        selectedDate(newVal) {
            this.localSelectedDate = newVal;
        },
        uniqueMatchDates: {
            handler(newDates) {
                if (newDates.length > 0 && !newDates.includes(this.localSelectedDate)) {
                    this.localSelectedDate = newDates[0];
                    this.$emit('update:selectedDate', newDates[0]);
                }
            },
            immediate: true
        }
    },
    methods: {
        formatDate(date) {
            const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            return new Date(date).toLocaleDateString('nl-NL', options);
        }
    }
};
</script>


<style scoped>
option {
    text-align: center;
}

.date-filter {
    margin-bottom: 1rem;
    display: flex;
    justify-content: center;
}

.date-filter label {
    margin-right: 0.5rem;
}

select {
    height: 50px;
    padding: 0.5rem 2rem;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    background-color: #fff;
    font-size: 1rem;
    color: #000;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'%3e%3cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1rem;
    width: 100%;
    max-width: 700px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

@media (max-width: 1544px) {
    select {
        max-width: 100%;
    }
}
</style>
