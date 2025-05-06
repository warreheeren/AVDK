<template>
    <div class="last-played-games">
        <h2 class="text-xl font-semibold mb-4">{{ division?.name || 'Unknown Division' }}</h2>

        <ul v-if="matches.length">
            <li v-for="match in matches" :key="match.id" class="match-item">
                <div class="team">
                    <img :src="match.home_team.logo" alt="Home Team Logo" class="team-logo" />
                    <span class="team-name">{{ match.home_team.name }}</span>
                </div>

                <div class="score">
                    <span class="score-number">{{ match.home_score }}</span>
                    <span class="separator">-</span>
                    <span class="score-number">{{ match.away_score }}</span>
                </div>

                <div class="team">
                    <img :src="match.away_team.logo" alt="Away Team Logo" class="team-logo" />
                    <span class="team-name">{{ match.away_team.name }}</span>
                </div>
            </li>
        </ul>

        <p v-else class="text-gray-500">Er zijn geen wedstrijden op deze datum.</p>
    </div>
</template>

<script>
export default {
    props: {
        matches: {
            type: Array,
            required: true,
        },
        division: {
            type: Object,
            required: true,
        }
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
    width: 30px;
    height: 30px;
    object-fit: cover;
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
</style>
