<template>
    <div class="p-6 space-y-6">
        <div v-if="loading" class="text-center">
            <p>Teamgegevens worden geladen...</p>
        </div>

        <div v-if="error" class="text-center text-red-600">
            <p>Er is een fout opgetreden bij het laden van de teamgegevens. Probeer het later opnieuw.</p>
        </div>

        <div v-if="team && !loading && !error">
            <div class="flex items-center space-x-4">
                <img :src="team.logo" alt="Team logo" class="w-20 h-20 object-cover rounded" />
                <div>
                    <h1 class="text-3xl font-bold">{{ team.name || 'Onbekend team' }}</h1>
                    <p class="text-gray-600">{{ team.division?.name || 'Geen divisie' }}</p>
                </div>
            </div>

            <div v-if="matches && matches.length > 0">
                <h2 class="text-2xl font-semibold mb-2">Wedstrijden</h2>
                <ul class="space-y-2">
                    <li v-for="match in matches" :key="match.id" class="border p-4 rounded">
                        <a :href="`/matches/${match.id}`" class="hover:underline text-blue-600">
                            {{ match.home_team?.name || 'Onbekend team' }}
                            {{ match.home_score }} - {{ match.away_score }}
                            {{ match.away_team?.name || 'Onbekend team' }}
                            ({{ match.match_date || 'Onbekende datum' }})
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps(['team', 'matches']);

const loading = ref(true);
const error = ref(false);

onMounted(() => {
    if (!props.team || !props.matches) {
        error.value = true;
        loading.value = false;
    } else {
        loading.value = false;
    }
});
</script>
