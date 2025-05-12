<template>
    <div class="p-6">
        <div class="main-container">
            <div class="sidebar">
                <DivisionFilter :divisions="props.divisions" v-model="selectedDivision" />
            </div>
            <div class="content">
                <DateFilter :uniqueMatchDates="uniqueMatchDates" :selectedDate="selectedDate"
                    @update:selectedDate="selectedDate = $event" />

                <LastPlayedGames :matches="filteredMatches" :division="filteredDivisions[0]" />
            </div>

            <!-- Standings Section -->
            <div class="standings">
                <section>
                    <div class="stand">
                        <div v-for="division in filteredDivisions" :key="division.id"
                            class="bg-white border rounded-2xl shadow-lg p-5 hover:shadow-xl transition">
                            <p class="font-semibold text-gray-900 text-lg">Tussenstand: {{ division.name }}</p>

                            <table class="w-full mt-6 text-left">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="py-3 px-2 text-sm text-gray-600 w-4"></th>
                                        <th class="py-3 px-2 text-sm text-gray-600 text-right">#</th>
                                        <th class="py-3 px-4 text-sm text-gray-600">Team</th>
                                        <th class="py-3 px-4 text-sm text-gray-600">M</th>
                                        <th class="py-3 px-4 text-sm text-gray-600">W</th>
                                        <th class="py-3 px-4 text-sm text-gray-600">G</th>
                                        <th class="py-3 px-4 text-sm text-gray-600">V</th>
                                        <th class="py-3 px-4 text-sm text-gray-600">+/-</th>
                                        <th class="py-3 px-4 text-sm text-gray-600">P</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(team, index) in props.standings[division.id] || []" :key="team.id"
                                        class="border-b transition-all hover:bg-gray-50">
                                        <td class="py-3 px-2 w-6 h-6 text-center">
                                            <template v-if="index === 0">
                                                <img src="https://www.avkempen.be/assets/images/trophies/beker-kempen-trophy.svg"
                                                    alt="Trophy" class="mx-auto" />
                                            </template>
                                            <template
                                                v-else-if="index >= (props.standings[division.id]?.length || 0) - 2">
                                                <span class="text-red-600 font-bold ">|</span>
                                            </template>
                                        </td>
                                        <td class="py-3 px-2 text-right">
                                            {{ index + 1 }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center space-x-2">
                                                <img :src="team.logo" alt="Team Logo" class="w-6 h-7 " />
                                                <Link :href="`/teams/${team.id}`" class="team-name hover:underline">
                                                {{ team.name }}
                                                </Link>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">{{ team.matches }}</td>
                                        <td class="py-3 px-4">{{ team.wins }}</td>
                                        <td class="py-3 px-4">{{ team.draws }}</td>
                                        <td class="py-3 px-4">{{ team.losses }}</td>
                                        <td class="py-3 px-4">{{ team.goal_difference }}</td>
                                        <td class="py-3 px-4">{{ team.points }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import DivisionFilter from '../components/DivisionFilter.vue';
import LastPlayedGames from '@/components/LastPlayedGames.vue';
import DateFilter from '../components/DateFilter.vue';
import { usePoll } from '@inertiajs/vue3';
usePoll(2000);

const props = defineProps({
    divisions: Array,
    matches: Array,
    standings: Object,
});
const selectedDivision = ref(props.divisions[0]?.name || '');
const selectedDate = ref('2025-05-06');

const uniqueMatchDates = computed(() => {
    if (!selectedDivision.value) return [];

    const now = new Date();

    const allDates = props.matches
        .filter(match =>
            match.home_team.division?.name === selectedDivision.value ||
            match.away_team.division?.name === selectedDivision.value
        )
        .map(m => new Date(m.match_date).toISOString().split('T')[0]);

    const pastDates = [...new Set(allDates.filter(d => new Date(d) <= now))];
    const futureDates = [...new Set(allDates.filter(d => new Date(d) > now))].sort((a, b) => new Date(a) - new Date(b));

    if (futureDates.length > 0) {
        pastDates.push(futureDates[0]);
    }

    return [...new Set(pastDates)].sort((a, b) => new Date(b) - new Date(a));
});


const filteredDivisions = computed(() => {
    if (!selectedDivision.value) return props.divisions;
    return props.divisions.filter(division => division.name === selectedDivision.value);
});

const filteredMatches = computed(() => {
    if (!selectedDivision.value) return props.matches;

    let matches = props.matches.filter(match =>
        match.home_team.division?.name === selectedDivision.value ||
        match.away_team.division?.name === selectedDivision.value
    );

    if (selectedDate.value) {
        matches = matches.filter(match => {
            const matchDate = new Date(match.match_date).toISOString().split('T')[0];
            return matchDate === selectedDate.value;
        });
    }

    return matches;
});
</script>

<style scoped>
.main-container {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin: 0 auto;
    padding: 1.5rem;
    flex-wrap: wrap;
}

.sidebar {
    width: 100%;
    max-width: 300px;
    flex-shrink: 0;
}

.content {
    flex: 1;
    max-width: 700px;
    display: flex;
    flex-direction: column;
}

.standings {
    flex: 1;
    max-width: 700px;
}

.border {
    border: 1px solid #e5e7eb;
}

.rounded-2xl {
    border-radius: 1rem;
}

.shadow-lg {
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.shadow-xl {
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.p-5 {
    padding: 1.25rem;
}

.font-semibold {
    font-weight: 600;
}

.mt-6 {
    margin-top: 1.5rem;
}


.border-b {
    border-bottom: 1px solid #e5e7eb;
}

.py-3 {
    padding-top: 1rem;
    padding-bottom: 1rem;
}

.px-4 {
    padding-left: 1rem;
    padding-right: 1rem;
}

.space-x-2 {
    margin-right: 0.5rem;
}

.hover\:underline:hover {
    text-decoration: underline;
}

.team-name {
    font-size: 1rem;
    font-weight: 500;
}

.bg-gray-100 {
    background-color: #f3f4f6;
}

.hover\:bg-gray-50:hover {
    background-color: #f9fafb;
}

.text-sm {
    font-size: 0.875rem;
}


@media (max-width: 768px) {
    .main-container {
        flex-direction: column;
        align-items: center;
    }

    .sidebar {
        max-width: 100%;
    }

    .content {
        max-width: 100%;
    }

    .standings {
        max-width: 100%;
    }
}
</style>
