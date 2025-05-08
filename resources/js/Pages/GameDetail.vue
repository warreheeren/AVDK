<template>
    <div>
        <GameDetailCard :game="game" :divisions="divisions" />
        <GameEvents :events="events" :game="game" />
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
        game: {
            type: Object,
            required: true,
        },
        divisions: {
            type: Array,
            required: true,
        },
        events: {
            type: Array,
            required: true,
        }
    },
};
</script>
