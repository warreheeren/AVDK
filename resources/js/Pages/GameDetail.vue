<template>
  <div>
    <GameDetailCard :game="game" :divisions="divisions" />
  </div>
</template>

<script>
import GameDetailCard from '@/components/GameDetailCard.vue';

export default {
  components: {
    GameDetailCard,
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
  },
};
</script>
