<template>
  <div class="min-h-screen flex items-center justify-center">
    <div class="login-container bg-white/90 backdrop-blur-md p-10 rounded-xl shadow-2xl w-full max-w-md border border-gray-100">
      <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-8 tracking-tight">Welcome Back</h2>
      <form @submit.prevent="submit">
        <div class="form-group mb-5">
          <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
          <input
            type="email"
            v-model="form.email"
            id="email"
            class="mt-2 w-full px-4 py-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition duration-300"
            required
          />
          <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
        </div>
        <div class="form-group mb-7">
          <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
          <input
            type="password"
            v-model="form.password"
            id="password"
            class="mt-2 w-full px-4 py-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition duration-300"
            required
          />
          <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
        </div>
        <button
          type="submit"
          class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-3 px-4 rounded-lg hover:from-indigo-600 hover:to-purple-700 transition duration-300 transform hover:scale-105"
        >
          Sign In
        </button>

        <p v-if="errorMessage" class="error mt-5 text-center text-red-500 font-medium">{{ errorMessage }}</p>
      </form>
    </div>
  </div>
</template>


<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const form = useForm({
  email: '',
  password: '',
});

function submit() {
  form.post('/login');
}
const errorMessage = computed(() => usePage().props.errorMessage);
</script>

<style scoped>
</style>
