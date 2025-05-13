<template>
    <div class="container">
        <div class="left-section">
            <GameDetailCard :game="game" :divisions="divisions" />
            <GameEvents :events="events" :game="game" />
        </div>

        <div class="right-section">
            <h4 class="standings-title">
                {{ currentDivision?.name }}
            </h4>

            <table class="standings-table">
                <thead>
                    <tr class="table-header">
                        <th class="table-cell">#</th>
                        <th class="table-cell">Team</th>
                        <th class="table-cell">M</th>
                        <th class="table-cell">P</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(team, index) in currentDivisionStandings" :key="team.id" :class="{
                        'highlighted-row': team.id === game.home_team_id || team.id === game.away_team_id
                    }">
                        <td class="table-cell">{{ index + 1 }}</td>
                        <td class="table-cell team-cell">
                            <img :src="getTeamLogo(team.id)" alt="Team Logo" class="team-logo" />
                            <span>{{ team.name }}</span>
                        </td>
                        <td class="table-cell">{{ team.matches }}</td>
                        <td class="table-cell points">{{ team.points }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import GameDetailCard from '@/components/GameDetailCard.vue';
import GameEvents from '../components/GameEvents.vue';

export default {
    components: {
        GameDetailCard,
        GameEvents,
    },
    props: {
        game: Object,
        divisions: Array,
        events: Array,
        standings: Object,
    },
    computed: {
        currentDivisionStandings() {
            return this.standings[this.game.division_id] || [];
        },
        currentDivision() {
            return this.divisions.find(d => d.id === this.game.division_id);
        },
    },
    methods: {
        getTeamLogo(teamId) {
            const team = this.currentDivisionStandings.find(team => team.id === teamId);
            const logo = team?.logo;
            if (logo?.startsWith('https')) {
                return logo;
            }
            return logo ? `/${logo}` : '/default-logo.png';
        }
    }
};
</script>

<style scoped>
.container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    padding: 16px;
    margin: 0 auto;
}

@media (min-width: 1024px) {
    .container {
        flex-direction: row;
    }

    .left-section {
        flex: 1;
    }

    .right-section {
        width: 33.333%;
    }
}

.right-section {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    padding: 16px;
    margin-top: 3rem;
    margin-bottom: 3rem;
    height: 67vh;
    border: solid 1px #e5e7eb;
}

.standings-title {
    font-weight: bold;
    margin-bottom: 1rem;
    color: #1f2937;
}

.standings-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.table-header {
    color: #4b5563;
    text-transform: uppercase;
    font-size: 0.75rem;
    text-align: left;
}

.table-cell {
    padding: 11px;
    border-bottom: 1px solid #e5e7eb;
    color: #374151;
}

.team-cell {
    display: flex;
    align-items: center;
    gap: 8px;
}

.team-logo {
    width: 24px;
    height: 24px;
    object-fit: contain;
}

.points {
    font-weight: 600;
    color: #1f2937;
}

.highlighted-row {
    background-color: #ededed;
}

.highlighted-row:hover,
.table-cell:hover {
    background-color: #f9fafb;
}

@media (max-width: 1023px) {
    .right-section {
        width: 100%;
        margin-top: 0px;
        height: auto;
    }

    .card {
        margin-bottom: 0px;
    }
}
</style>