<template>
    <div class="p-6 space-y-12">
        <div class="mb-4">
            <select id="divisionFilter" v-model="selectedDivision" class="p-2 border rounded">
                <option value="">Alle divisies</option>
                <option v-for="division in divisions" :key="division.id" :value="division.name">
                    {{ division.name }}
                </option>
            </select>
        </div>
        <section>
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Divisies & Teams</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="division in filteredDivisions" :key="division.id"
                    class="bg-white border rounded-2xl shadow-sm p-5 hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-gray-900">{{ division.name }}</h3>
                    <table class="w-full mt-4 text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">#</th>
                                <th class="py-2">Team</th>
                                <th class="py-2">M</th>
                                <th class="py-2">W</th>
                                <th class="py-2">G</th>
                                <th class="py-2">V</th>
                                <th class="py-2">+/-</th>
                                <th class="py-2">P</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(team, index) in division.teams" :key="team.id" class="border-b">
                                <td class="py-2">{{ index + 1 }}</td>
                                <td class="py-2">
                                    <Link :href="`/teams/${team.id}`" class="text-blue-600 hover:underline">
                                    {{ team.name }}
                                    </Link>
                                </td>
                                <td class="py-2">{{ team.matches }}</td>
                                <td class="py-2">{{ team.wins }}</td>
                                <td class="py-2">{{ team.draws }}</td>
                                <td class="py-2">{{ team.losses }}</td>
                                <td class="py-2">{{ team.goalDifference }}</td>
                                <td class="py-2">{{ team.points }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['divisions', 'matches']);

const selectedDivision = ref('');

const filteredDivisions = computed(() => {
    if (!selectedDivision.value) {
        return props.divisions;
    }
    return props.divisions.filter(
        division => division.name === selectedDivision.value
    );
});
</script>