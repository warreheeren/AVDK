<template>
    <div class="add-event-container">
        <h1 class="title">Add Event for: {{ game.name }}</h1>

        <form @submit.prevent="submitForm" class="event-form">
            <div class="form-group">
                <label for="team_id" class="form-label">Select Team:</label>
                <select v-model="form.team_id" required class="form-select">
                    <option value="">Select Team</option>
                    <option v-for="(team, key) in teams" :key="key" :value="team.id">
                        {{ team.name }}
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="event_type" class="form-label">Event Type:</label>
                <input type="text" v-model="form.event_type" required class="form-input" />
            </div>

            <div class="form-group">
                <label for="minute" class="form-label">Minute:</label>
                <input type="number" v-model="form.minute" required class="form-input" />
            </div>

            <div class="form-group">
                <label for="player_name" class="form-label">Player Name:</label>
                <input type="text" v-model="form.player_name" class="form-input" />
            </div>

            <div class="form-group">
                <label for="player_in_name" class="form-label">Player In Name:</label>
                <input type="text" v-model="form.player_in_name" class="form-input" />
            </div>

            <div class="form-group">
                <label for="player_out_name" class="form-label">Player Out Name:</label>
                <input type="text" v-model="form.player_out_name" class="form-input" />
            </div>

            <button type="submit" class="submit-btn">Add Event</button>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
    props: {
        game: Object,
        teams: Object,
        addEventUrl: String,
    },
    setup(props) {
        const form = useForm({
            game_id: props.game.id,
            team_id: null,
            event_type: '',
            minute: null,
            player_name: '',
            player_in_name: '',
            player_out_name: '',
        });


        function submitForm() {
            form.post(props.addEventUrl);
        }

        return {
            form,
            teams: props.teams,
            game: props.game,
            submitForm
        };
    },
};
</script>

<style scoped>
.add-event-container {
    max-width: 600px;
    margin: 3rem auto;
    padding: 20px;
    background-color: #f9fafb;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.title {
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

.event-form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 15px;
}

.form-label {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.form-input,
.form-select {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border-radius: 8px;
    border: 1px solid #ddd;
    background-color: #fff;
    color: #333;
}

.form-input:focus,
.form-select:focus {
    outline: none;
    border-color: #3182ce;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
}

.submit-btn {
    padding: 10px 20px;
    font-size: 1rem;
    font-weight: 600;
    color: white;
    background-color: #3182ce;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.submit-btn:hover {
    background-color: #2b6cb0;
}

.submit-btn:disabled {
    background-color: #e2e8f0;
    cursor: not-allowed;
}

.submit-btn:focus {
    outline: none;
}

.text-red-500 {
    color: #f56565;
}
</style>
