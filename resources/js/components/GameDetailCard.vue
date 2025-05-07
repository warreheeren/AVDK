<template>
  <div class="game-detail">
    <div class="card-header flex justify-between items-center">
        <div class="flex items-center">
            <svg @click="goBack" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            <button class="cursor-pointer" @click="goBack">Terug</button>
        </div>
        <div class="flex items-center">
            <img class="avdk-icon" src="https://www.avkempen.be/assets/images/logo.png" />
            <p class="division-name" v-if="division">{{ division.name }}</p>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white-500 cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 9v4m0 4h.01M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20z"></path>
        </svg>
    </div>

    <div class="w-full border-t border-gray-200 mb-4"></div>

    <div class="flex items-center justify-center mb-2">
        <div class="flex items-center mb-2 mr-4">
            <img src="https://www.avkempen.be/assets/images/stadium.svg" alt="Stadium Icon" class="w-4 h-4 inline-block mr-1" />
           <p class="text-gray-500 text-sm"> {{ game.location }}</p>
        </div>
        <div class="flex items-center mb-2 ml-5">
           <i class="fa-solid fa-calendar-minus"></i>
            <p class="text-gray-500 text-sm"> {{ formatDate(game.match_date) }}</p>
        </div>
    </div>

    <hr class="w-full border-t border-gray-200 mb-4" />

    <div class="game-container">
      <div class="team home-team flex">
        <p class="team-name">{{ truncateName(game.home_team.name)}}</p>
        <img :src="game.home_team.logo" alt="Home Team Logo" class="team-logo" />
      </div>

      <div class="score">
        <span class="score-number">{{ game.home_score }}</span>
        <span class="separator">-</span>
        <span class="score-number">{{ game.away_score }}</span>
      </div>

      <div class="team away-team">
        <img :src="game.away_team.logo" alt="Away Team Logo" class="team-logo" />
        <span class="team-name">{{ truncateName(game.away_team.name) }}</span>
      </div>
    </div>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
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
  },
  methods: {
    goBack() {
      Inertia.visit('/');
    },
     truncateName(name) {
        return name.length > 15 ? name.substring(0, 10) + '.' : name;
    },
    formatDate(date) {
      const daysOfWeek = ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'];
      const d = new Date(date);

      const dayOfWeek = daysOfWeek[d.getDay()];
      const day = String(d.getDate()).padStart(2, '0');
      const month = String(d.getMonth() + 1).padStart(2, '0');

      return `${dayOfWeek} ${day}/${month}`;
    },
  },
};
</script>

<style scoped>
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
  margin-bottom: 1rem;
  max-width: 1000px;
  margin: 0 auto;
  margin-top: 3rem;
  border: 1px solid #e5e7eb;
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
  justify-content: center;
  align-items: center;
  padding: 3rem;
  gap: 20px;
}

.team {
  display: flex;
  align-items: center;
  gap: 15px;
}

.team-name {
  font-size: 1.25rem;
  font-weight: larger;
}

.team-logo {
  width: 40px;
  height: 40px;
}

.score {
  display: flex;
  align-items: center;
  font-size: 1.5rem;
}

.separator {
  margin: 0 10px;
}

.score-number {
  font-weight: bold;
  font-size: 1.25rem;
}
</style>
