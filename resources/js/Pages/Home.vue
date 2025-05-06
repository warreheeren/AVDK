<template>
    <div class="p-6">
        <div class="main-container">
            <div class="sidebar">
                <DivisionFilter :divisions="props.divisions" v-model="selectedDivision" />
            </div>
            <div class="content">
                <!-- Date filter -->
                <DateFilter :uniqueMatchDates="uniqueMatchDates" :selectedDate="selectedDate"
                    @update:selectedDate="selectedDate = $event" />

                <!-- Last Played Games section -->
                <LastPlayedGames :matches="filteredMatches" :division="filteredDivisions[0]" />

                <!-- Standings section -->
                <section>
                    <div class="stand">
                        <div v-for="division in filteredDivisions" :key="division.id"
                            class="bg-white border rounded-2xl shadow-sm p-5 hover:shadow-md transition">
                            <p class="font-semibold text-gray-900">Tussenstand: {{ division.name }}</p>

                            <!-- Rankings table -->
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
                                    <tr v-for="(team, index) in calculatedStandings(division)" :key="team.id"
                                        class="border-b">
                                        <td class="py-2">{{ index + 1 }}</td>
                                        <td class="py-2">
                                            <div class="flex items-center">
                                                <img :src="team.logo" alt="Team Logo" class="w-6 h-6 mr-2" />
                                                <Link :href="`/teams/${team.id}`" class="text-blue-600 hover:underline">
                                                {{ team.name }}
                                                </Link>
                                            </div>
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
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import DivisionFilter from '../Components/DivisionFilter.vue';
import LastPlayedGames from '@/Components/LastPlayedGames.vue';
import DateFilter from '../Components/DateFilter.vue';

// Props passed from parent
const props = defineProps(['divisions', 'matches']);

// Selected division from the filter
const selectedDivision = ref(props.divisions[0]?.name || '');

// Selected date for the filter
const selectedDate = ref('2025-05-06'); // Default to current date

// Compute unique match dates from the matches
const uniqueMatchDates = computed(() => {
    const dates = props.matches
        .map(m => new Date(m.match_date).toISOString().split('T')[0]);
    return [...new Set(dates)].sort((a, b) => new Date(b) - new Date(a)); // Sort descending
});

// Filtered divisions based on selected division
const filteredDivisions = computed(() => {
    if (!selectedDivision.value) return props.divisions;
    return props.divisions.filter(division => division.name === selectedDivision.value);
});

// Filtered matches based on selected division and selected date
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

// Function to calculate standings for a division
const calculatedStandings = (division) => {
    const teamStats = {};

    // Initialize stats for each team in the division
    division.teams.forEach(team => {
        teamStats[team.id] = {
            id: team.id,
            name: team.name,
            logo: team.logo,
            matches: 0,
            wins: 0,
            draws: 0,
            losses: 0,
            goalDifference: 0,
            points: 0
        };
    });

    // Calculate stats based on filtered matches
    filteredMatches.value.forEach(match => {
        const homeTeamId = match.home_team.id;
        const awayTeamId = match.away_team.id;
        const homeGoals = match.home_goals || 0;
        const awayGoals = match.away_goals || 0;

        // Update home team stats
        if (teamStats[homeTeamId]) {
            teamStats[homeTeamId].matches += 1;
            teamStats[homeTeamId].goalDifference += homeGoals - awayGoals;
            if (homeGoals > awayGoals) {
                teamStats[homeTeamId].wins += 1;
                teamStats[homeTeamId].points += 3;
            } else if (homeGoals === awayGoals) {
                teamStats[homeTeamId].draws += 1;
                teamStats[homeTeamId].points += 1;
            } else {
                teamStats[homeTeamId].losses += 1;
            }
        }

        // Update away team stats
        if (teamStats[awayTeamId]) {
            teamStats[awayTeamId].matches += 1;
            teamStats[awayTeamId].goalDifference += awayGoals - homeGoals;
            if (awayGoals > homeGoals) {
                teamStats[awayTeamId].wins += 1;
                teamStats[awayTeamId].points += 3;
            } else if (awayGoals === homeGoals) {
                teamStats[awayTeamId].draws += 1;
                teamStats[awayTeamId].points += 1;
            } else {
                teamStats[awayTeamId].losses += 1;
            }
        }
    });

    // Convert to array and sort by points (descending), then goal difference
    return Object.values(teamStats).sort((a, b) => {
        if (b.points !== a.points) return b.points - a.points;
        return b.goalDifference - a.goalDifference;
    });
};
</script>

<style scoped>
/* Main container with centered content */
.main-container {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    max-width: 1200px;
    margin: 0 auto;
    padding: 1.5rem;
}

.sidebar {
    margin-left: -250px;
    width: 300px;
    flex-shrink: 0;
}

.content {
    flex: 1;
    max-width: 700px;
    display: flex;
    flex-direction: column;
}

/* Styling for the ranking and last played games sections */
.bg-white {
    background-color: #fff;
}

.border {
    border: 1px solid #e5e7eb;
}

.rounded-2xl {
    border-radius: 1rem;
}

.shadow-sm {
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.shadow-md {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.p-5 {
    padding: 1.25rem;
}

.text-gray-900 {
    color: #1f2937;
}

.text-blue-600 {
    color: #2563eb;
}

.font-semibold {
    font-weight: 600;
}

.hover\:underline:hover {
    text-decoration: underline;
}

.w-full {
    width: 100%;
}

.mt-4 {
    margin-top: 1rem;
}

.mt-6 {
    margin-top: 1.5rem;
}

.text-left {
    text-align: left;
}

.border-b {
    border-bottom: 1px solid #e5e7eb;
}

.py-2 {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}

.mr-2 {
    margin-right: 0.5rem;
}

.flex {
    display: flex;
}

.items-center {
    align-items: center;
}

.stand {
    margin: 0 auto;
    max-width: 700px;
}
</style>
