<template>
    <div class="last-played-games">
        <h2 class="text-xl font-semibold mb-4">{{ division?.name || 'Unknown Division' }}</h2>

        <ul v-if="matches.length">
            <li v-for="match in matches" :key="match.id" class="match-item">
                <Link :href="`/games/${match.id}`" class="flex justify-center w-full no-underline text-inherit">
                <div class="team">
                    <img :src="match.home_team.logo" alt="Home Team Logo" class="team-logo" />
                    <span class="team-name">{{ match.home_team.name }}</span>
                </div>

                <div class="score">
                    <template
                        v-if="isFutureMatch(match.match_date) && match.home_score === null && match.away_score === null">
                        <span class="text-gray-600">{{ formatTime(match.match_date) }}</span>
                    </template>
                    <template v-else-if="match.home_score === null && match.away_score === null">
                        <span class="text-gray-600"> {{ formatTime(match.match_date) }}</span>
                    </template>
                    <template v-else>
                        <span class="score-number">{{ match.home_score }}</span>
                        <span class="separator">-</span>
                        <span class="score-number">{{ match.away_score }}</span>
                    </template>
                </div>
                <div class="team">
                    <img :src="match.away_team.logo" alt="Away Team Logo" class="team-logo" />
                    <span class="team-name">{{ match.away_team.name }}</span>
                </div>
                </Link>
            </li>
        </ul>
        <p v-else class="text-gray-500">Er zijn geen wedstrijden op deze datum.</p>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import { usePoll } from '@inertiajs/vue3';
usePoll(2000);
export default {
    components: { Link },
    props: {
        matches: {
            type: Array,
            required: true,
        },
        division: {
            type: Object,
            required: true,
        }
    },
    methods: {
        isFutureMatch(date) {
            const hasScore = this.matches.some(match => match.home_score !== null || match.away_score !== null);
            if (hasScore) {
                return false;
            }
            return new Date(date) > new Date();
        },
        formatTime(date) {
            return new Date(date).toLocaleTimeString('nl-NL', {
                weekday: 'short',
                hour: '2-digit',
                minute: '2-digit',
            });
        },
    }

};
</script>

<style scoped>
.last-played-games {
    padding: 1rem;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    margin-bottom: 1rem;
}

.last-played-games ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.last-played-games li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    padding: 8px;
    background-color: #f8f8f8;
    border-radius: 8px;
}

.team {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 30%;
}

.team-logo {
    height: 30px;
    margin-bottom: 4px;
}

.team-name {
    font-size: 0.875rem;
    color: #333;
}

.score {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    width: 30%;
}

.score-number {
    font-size: 1rem;
    font-weight: 600;
    margin: 0 4px;
}

.separator {
    font-size: 1rem;
    font-weight: 700;
    margin: 0 4px;
}

.text-gray-500 {
    color: #a0aec0;
}

.last-played-games li:hover {
    background-color: rgb(233, 233, 233);
    transition: background-color 0.2s;
}

@media (max-width: 1280px) {
    .last-played-games {
        margin-bottom: 0;
    }
}

@media (max-width: 768px) {

    .score {
        font-size: 12px;
    }

    .team span {
        font-size: 12px;
    }

    .score-number {
        font-size: 12px;
    }
}
</style>
