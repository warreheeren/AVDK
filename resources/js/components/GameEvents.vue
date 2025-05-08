<template>
    <div class="card my-6">
        <div class="flex items-center justify-center header-title">
            <img src="https://www.avkempen.be/assets/images/game-events/no-game-events-ball.svg" class="w-5">
            <h2 class="card-title">Gebeurtenissen</h2>
        </div>
        <hr class="text-gray-200">
        <div class="p-6">
            <div class="relative">
                <ul class="space-y-6">
                    <li v-for="event in sortedEvents" :key="event.id" class="relative flex items-center justify-center">
                        <div v-if="event.minute === 45"
                            class="relative text-center font-bold text-xl text-gray-700 z-10 w-full">
                            <div class="flex items-center justify-center">
                                <span class="flex-grow border-t border-gray-200"></span>
                                <span class="px-4 flex items-center">
                                    <img src="https://www.avkempen.be/assets/images/game-events/whistle.svg"
                                        class="w-4 mr-2">
                                    RST
                                </span>
                                <span class="flex-grow border-t border-gray-200"></span>
                            </div>
                        </div>
                        <div v-else class="flex items-center w-full">
                            <div class="w-1/2 pr-4 flex justify-end items-center"
                                :class="{ 'invisible': event.team_id !== homeTeamId }">
                                <span v-if="event.team_id === homeTeamId" class="event-details flex items-center">
                                    <span v-if="event.event_type === 'goal'">
                                        {{ event.player_name }}
                                    </span>
                                    <span v-else-if="event.event_type === 'substitution'">
                                        {{ event.player_out_name }} → {{ event.player_in_name }}
                                    </span>
                                    <span v-else-if="event.event_type === 'yellow_card'">
                                        {{ event.player_name }}
                                    </span>
                                    <span v-else-if="event.event_type === 'red_card'">
                                        {{ event.player_name }}
                                    </span>
                                    <span class="event-icon mx-2">
                                        <img v-if="event.event_type === 'goal'"
                                            src="https://www.avkempen.be/assets/images/game-events/ball.svg" alt="Goal"
                                            class="icon" />
                                        <i v-else-if="event.event_type === 'substitution'"
                                            class=" fa-solid fa-repeat text-green-500"></i>
                                        <img v-else-if="event.event_type === 'yellow_card'"
                                            src="https://www.avkempen.be/assets/images/game-events/yellow-card.png"
                                            alt="Yellow Card" class="icon" />
                                        <img v-else-if="event.event_type === 'red_card'"
                                            src="https://www.avkempen.be/assets/images/game-events/red-card.png"
                                            alt="Red Card" class="icon" />
                                    </span>
                                </span>
                            </div>
                            <div class="minute-container z-10">
                                <div class="minute">
                                    <span class="minute-text">{{ event.minute }}'</span>
                                </div>
                            </div>
                            <div class="w-1/2 pl-4 flex justify-start items-center"
                                :class="{ 'invisible': event.team_id !== awayTeamId }">
                                <span v-if="event.team_id === awayTeamId" class="event-details flex items-center">
                                    <span class="event-icon mx-2">
                                        <img v-if="event.event_type === 'goal'"
                                            src="https://www.avkempen.be/assets/images/game-events/ball.svg" alt="Goal"
                                            class="icon" />
                                        <i v-else-if="event.event_type === 'substitution'"
                                            class="fa-solid fa-repeat text-green-500"></i>
                                        <img v-else-if="event.event_type === 'yellow_card'"
                                            src="https://www.avkempen.be/assets/images/game-events/yellow-card.png"
                                            alt="Yellow Card" class="icon" />
                                        <img v-else-if="event.event_type === 'red_card'"
                                            src="https://www.avkempen.be/assets/images/game-events/red-card.png"
                                            alt="Red Card" class="icon" />
                                    </span>
                                    <span v-if="event.event_type === 'goal'">
                                        {{ event.player_name }}
                                    </span>
                                    <span v-else-if="event.event_type === 'substitution'">
                                        {{ event.player_out_name }} → {{ event.player_in_name }}
                                    </span>
                                    <span v-else-if="event.event_type === 'yellow_card'">
                                        {{ event.player_name }}
                                    </span>
                                    <span v-else-if="event.event_type === 'red_card'">
                                        {{ event.player_name }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <p v-if="!sortedEvents.length" class="text-gray-500 text-center">Geen gebeurtenissen beschikbaar.</p>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const fakeEvent45 = {
    id: 'fake-45',
    minute: 45,
    event_type: 'halftime',
    team_id: null,
    player_name: null,
    player_out_name: null,
    player_in_name: null,
    score: null
};

const props = defineProps({
    events: {
        type: Array,
        required: true,
    },
    game: {
        type: Object,
        required: true,
    }
});

const homeTeamId = computed(() => props.game?.home_team_id || null);
const awayTeamId = computed(() => props.game?.away_team_id || null);

const sortedEvents = computed(() => {
    if (!props.events || !props.events.length) return [fakeEvent45];
    return [...props.events, fakeEvent45].sort((a, b) => a.minute - b.minute);
});
</script>

<style scoped>
.header-title {
    height: 5rem;
}

.card {
    background-color: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    max-width: 1000px;
    margin: 0 auto;
    margin-bottom: 3rem;
}

.card-title {
    font-size: 1rem;
    font-weight: 600;
    text-align: center;
    padding: 0.5rem;
    color: #1f2937;
}

.minute-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.minute {
    position: relative;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f0f0;
    border-radius: 50%;
}

.event-icon {
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon {
    height: 20px;
}

.fa-solid {
    font-size: 20px;
}

.minute-text {
    font-size: 0.75rem;
    font-weight: bold;
}

.event-details {
    font-size: 1rem;
}

.invisible {
    visibility: hidden;
}

span {
    font-size: 0.85rem;
}
</style>