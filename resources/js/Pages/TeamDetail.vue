<template>
    <div class="container">
        <div class="header-team flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img :src="team.logo" alt="Team Logo" class="team-logo w-15 h-20" />
                <div>
                    <h1 class="team-name">{{ team.name }}</h1>
                    <p class="text-gray-500">{{ division.name }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="location">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <p>{{ team.address }}</p>
            </div>
        </div>
        <div class="detail-team">
            <p class="mb-8 font-bold">Statistieken</p>
            <div class="flex justify-between gap-4">
                <svg width="100" height="100" viewBox="0 0 36 36" class="circular-chart green">
                    <path class="circle-bg" d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831" />

                    <path class="circle" :stroke-dasharray="`${percentage}, 100`" d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <text x="18" y="18" class="percentage">{{ totalPoints }}</text>
                    <text x="18" y="24" class="label">/{{ maxPoints }} ptn</text>
                </svg>
                <div class="flex gap-2 items-end">
                    <div v-for="(match, index) in matches.slice(-5)" :key="match.id">
                        <div class="lastGamesWin" v-if="match.result === 'win'">
                            {{ match.result.substring(0, 1).toUpperCase() }}
                        </div>
                        <div class="lastGamesDraw" v-else-if="match.result === 'draw'">
                            {{ match.result.substring(0, 1).toUpperCase() }}
                        </div>
                        <div class="lastGamesLoss" v-else-if="match.result === 'loss'">
                            {{ match.result.substring(0, 1).toUpperCase() }}
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="flex justify-center gap-4 mt-6">
                    <div class="flex flex-col card">
                        <p class="font-semibold text-sm mb-5">Wedstrijden</p>
                        <p class=" text-2xl mb-2">{{ matches.length }}</p>
                        <p class="text-gray-500 text-xs">Gespeeld</p>
                    </div>
                    <div class="flex flex-col card">
                        <p class="font-semibold text-sm mb-5">Winst</p>
                        <p class=" text-2xl mb-2">{{matches.filter(match => match.result ===
                            'win').length}}</p>
                        <p class="text-gray-500 text-xs">Gewonnen</p>
                    </div>
                    <div class="flex flex-col card">
                        <p class="font-semibold text-sm mb-5">Goals voor</p>
                        <p class=" text-2xl mb-2">{{ goalsFor }}</p>
                        <p class="text-gray-500 text-xs">Gemaakt</p>
                    </div>
                    <div class="flex flex-col card">
                        <p class="font-semibold text-sm mb-5">Goals tegen</p>
                        <p class=" text-2xl mb-2">{{ goalsAgainst }}</p>
                        <p class="text-gray-500 text-xs">Geïncasseerd</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'GameDetail',
    props: {
        team: Object,
        matches: Array,
        division: Object,
    },
    computed: {
        totalPoints() {
            return this.matches.reduce((sum, match) => {
                if (match.result === 'win') return sum + 3;
                if (match.result === 'draw') return sum + 1;
                return sum;
            }, 0);
        },
        maxPoints() {
            return this.matches.length * 3;
        },
        percentage() {
            if (this.maxPoints === 0) return 0;
            return ((this.totalPoints / this.maxPoints) * 100).toFixed(2);
        },
        matchesWithStats() {
            return this.matches.map(match => {
                const isHome = match.home_team_id === this.team.id;

                return {
                    ...match,
                    goals_for: isHome ? match.home_score : match.away_score,
                    goalsAgainst: isHome ? match.away_score : match.home_score,
                };
            });
        },
        goalsFor() {
            return this.matchesWithStats.reduce((sum, match) => sum + match.goals_for, 0);
        },
        goalsAgainst() {
            return this.matchesWithStats.reduce((sum, match) => sum + match.goalsAgainst, 0);
        }
    },
}

</script>
<style scoped>
.card {
    padding: 1.25rem 1.5rem;
    background-color: #f8f8f8;
    border-radius: 1rem;
    width: 200px;
    height: 140px;
}

.container {
    display: flex;
    flex-direction: column;
    margin: 0 auto;
    max-width: 1400px;
}

.header-team {
    padding: 3rem 2rem;
    margin-top: 3rem;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.team-name {
    font-size: larger;
}

.location {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background-color: rgb(231, 231, 231);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.location i {
    color: rgb(107, 114, 128);
}

.detail-team {
    padding: 1.5rem;
    margin-top: 1rem;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    max-width: 800px;
}

.circular-chart {
    display: block;
    max-width: 150px;
    max-height: 150px;
}

.circle-bg {
    fill: none;
    stroke: #ebebeb;
    stroke-width: 3.8;
}

.circle {
    fill: none;
    stroke-width: 2.8;
    stroke: #00c853;
    transition: stroke-dasharray 0.6s ease;
}

.percentage {
    fill: #00c853;
    font-size: 9px;
    font-weight: bold;
    text-anchor: middle;
}

.label {
    fill: #666;
    font-size: 4px;
    font-weight: 500;
    text-anchor: middle;
}

.lastGamesWin {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background-color: rgb(98, 202, 0);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: white;
}

.lastGamesDraw {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background-color: rgb(255, 184, 31);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: white;
}

.lastGamesLoss {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background-color: rgb(255, 83, 83);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: white;
}
</style>
