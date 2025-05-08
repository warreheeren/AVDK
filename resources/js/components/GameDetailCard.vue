<template>
    <div class="game-detail">
        <div class="card-header flex justify-between items-center">
            <Link :href="'/'" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 cursor-pointer" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            <button class="cursor-pointer">Terug</button>
            </Link>
            <div class="flex items-center">
                <img class="avdk-icon" src="https://www.avkempen.be/assets/images/logo.png" />
                <p class="division-name" v-if="division">{{ division.name }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white-500 cursor-pointer" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 9v4m0 4h.01M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20z"></path>
            </svg>
        </div>

        <div class="w-full border-t border-gray-200 mb-4"></div>

        <div class="flex items-center justify-center mb-2 flex-wrap text-center">
            <div class="flex items-center mb-2 mr-4">
                <img src="https://www.avkempen.be/assets/images/stadium.svg" alt="Stadium Icon"
                    class="w-4 h-4 inline-block mr-1 stadium-logo" />
                <p class="text-gray-500 text-sm"> {{ game.location }}</p>
            </div>
            <div class="flex items-center mb-2 ml-5">
                <i class="fa-solid fa-calendar-minus calendar-logo"></i>
                <p class="text-gray-500 text-sm"> {{ formatDate(game.match_date) }}</p>
            </div>
        </div>

        <hr class="w-full border-t border-gray-200 mb-4" />

        <div class="game-container">
            <div class="team home-team">
                <img :src="homeTeamLogo" alt="Home Team Logo" class="team-logo" />
                <p class="team-short">{{ getShortName(game.home_team.name) }}</p>
            </div>

            <div class="score">
                <span class="score-number">{{ game.home_score }}</span>
                <span class="separator">-</span>
                <span class="score-number">{{ game.away_score }}</span>
            </div>

            <div class="team away-team">
                <img :src="awayTeamLogo" alt="Away Team Logo" class="team-logo" />
                <p class="team-short">{{ getShortName(game.away_team.name) }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: { Link },
    props: {
        game: {
            type: Object,
            required: true,
        },
        divisions: {
            type: Array,
            required: true,
        },
    },
    computed: {
        division() {
            return this.divisions.find(
                division => division.id === this.game.division_id
            );
        },
        homeTeamLogo() {
            if (this.game.home_team.logo && this.game.home_team.logo.startsWith('https')) {
                return this.game.home_team.logo;
            }
            return `/${this.game.home_team.logo}`;
        },
        awayTeamLogo() {
            if (this.game.away_team.logo && this.game.away_team.logo.startsWith('https')) {
                return this.game.away_team.logo;
            }
            return `/${this.game.away_team.logo}`;
        }
    },
    methods: {
        formatDate(date) {
            const daysOfWeek = ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'];
            const d = new Date(date);

            const dayOfWeek = daysOfWeek[d.getDay()];
            const day = String(d.getDate()).padStart(2, '0');
            const month = String(d.getMonth() + 1).padStart(2, '0');

            return `${dayOfWeek} ${day}/${month}`;
        },
        getShortName(name) {
            return name.split(' ').slice(0, 2).join(' ');
        }
    },
};
</script>

<style scoped>
.calendar-logo {
    font-size: 0.75rem;
}

.stadium-logo {
    height: 0.75rem;
}

.card-header {
    padding: 1.25rem;
}

.avdk-icon {
    width: 24px;
    height: 24px;
    margin-right: 0.5rem;
}

.division-name {
    font-size: 1rem;
    font-weight: 600;
}

.game-detail {
    background-color: #fff;
    border-radius: 12px;
    max-width: 1000px;
    margin: 3rem auto 1rem auto;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

i {
    color: #4b5563;
    margin-right: 0.5rem;
}

button {
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
}

svg {
    border-radius: 50%;
    padding: 0.5rem;
    background-color: #f3f4f6;
    margin-right: 0.5rem;
    transition: background-color 0.3s;
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4b5563;
}

.game-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem;
    gap: 20px;
    flex-wrap: wrap;
}

.team {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    flex: 1;
}

.team-short {
    font-weight: 500;
}

.team-logo {
    height: 50px;
    margin: 0.5rem 0;
}

.score {
    display: flex;
    align-items: center;
    font-size: 1.5rem;
    font-weight: bold;
    gap: 0.5rem;
    min-width: 80px;
    justify-content: center;
}

@media (max-width: 768px) {
    .game-container {
        flex-direction: column;
        align-items: center;
    }

    .score {
        margin: 1rem 0;
    }
}
</style>
