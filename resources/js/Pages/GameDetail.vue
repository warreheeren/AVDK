<template>
    <div v-if="match && match.home_team && match.away_team" class="p-6 space-y-6">
        <h1 class="text-3xl font-bold">
            {{ match.home_team.name }} vs {{ match.away_team.name }}
        </h1>
        <div class="text-xl">
            <span>{{ match.home_score }} - {{ match.away_score }}</span>
        </div>
        <p class="text-gray-600">Datum: {{ match.match_date }}</p>
        <p class="text-gray-600">Locatie: {{ match.location }}</p>
    </div>

    <div v-else class="p-6 text-red-600">
        Wedstrijdgegevens niet beschikbaar.
    </div>
</template>

<script setup>
defineProps({ match: Object });
</script>
