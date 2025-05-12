<template>
    <div class="main-container">
        <div class="container">
            <div class="flex justify-between items-center mb-4">
                <h1 class="main-title">Volgende wedstrijden</h1>
                <Link href="/logout" method="post" as="button"
                    class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                Logout
                </Link>
            </div>

            <label for="division-select" class="label">Filter op divisie: </label>
            <select id="division-select" v-model="selectedDivision" class="select">
                <option value="">Alle divisies</option>
                <option v-for="division in divisions" :key="division.id" :value="division.id">
                    {{ division.name }}
                </option>
            </select>

            <div v-for="division in divisions" :key="division.id" class="division-container">
                <div v-if="(selectedDivision === '' || selectedDivision === division.id) && upcomingGames[division.id] && upcomingGames[division.id].length > 0"
                    class="card">
                    <h2 class="division-title">{{ division.name }}</h2>

                    <ul>
                        <li v-for="(game, index) in upcomingGames[division.id].slice(0, 8)" :key="game.id"
                            class="game-item">
                            <p v-if="game.home_team && game.away_team" class="game-info">
                                {{ game.home_team.name }} vs {{ game.away_team.name }}
                            </p>
                            <p v-else class="game-info">Loading team data...</p>
                            <p class="game-location">Locatie: {{ game.location }}</p>
                            <p class="game-date">Match Datum: {{ game.match_date }}</p>

                            <Link :href="`/add-event/${game.id}`" class="add-event-link">
                            Add Event
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';


export default {
    components: {
        Link,
    },
    props: {
        divisions: Array,
        upcomingGames: Object,
    },
    data() {
        return {
            selectedDivision: '',
        };
    },
};
</script>

<style scoped>
html,
body {
    height: 100%;
    margin: 0;
}

.main-container {
    margin-top: 3rem;
    margin-bottom: 3rem;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    background-color: #f8f9fa;
}

.container {
    background-color: white;
    border-radius: 8px;
    padding: 30px;
    width: 100%;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.main-title {
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
}

.label {
    font-weight: bold;
    margin-right: 10px;
}

.select {
    padding: 8px 15px;
    font-size: 16px;
    margin-bottom: 20px;
    margin-left: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.division-container {
    margin-bottom: 30px;
}

.card {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.division-title {
    font-size: 22px;
    color: #495057;
    margin-bottom: 15px;
    text-align: center;
}

ul {
    list-style-type: none;
    padding: 0;
}

.game-item {
    background-color: #e9ecef;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
}

.game-info {
    font-size: 16px;
    color: #333;
}

.game-location,
.game-date {
    font-size: 14px;
    color: #666;
}

.no-games {
    font-size: 18px;
    color: #dc3545;
    text-align: center;
    margin-top: 20px;
}

.add-event-link {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 16px;
    background-color: #198754;
    color: white;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.2s ease;
}

.add-event-link:hover {
    background-color: #157347;
}
</style>
