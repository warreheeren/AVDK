<template>
    <div class="mt-50 flex items-center justify-center">
        <div
            class="login-container bg-white/90 backdrop-blur-md p-10 rounded-xl shadow-2xl w-full max-w-md border border-gray-100">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-8 tracking-tight">Admin login</h2>
            <form @submit.prevent="submit">
                <div class="form-group mb-5">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" v-model="form.email" id="email"
                        class="mt-2 w-full px-4 py-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition duration-300"
                        required />
                    <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                </div>
                <div class="form-group mb-7">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <input type="password" v-model="form.password" id="password"
                        class="mt-2 w-full px-4 py-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition duration-300"
                        required />
                    <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                </div>
                <button type="submit"
                    class="w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 cursor-pointer">
                    Login
                </button>

                <p v-if="errorMessage" class="error mt-5 text-center text-red-500 font-medium">{{ errorMessage }}</p>
            </form>
        </div>
    </div>
</template>


<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage()

const form = useForm({
    _token: page.props.csrf,
    email: '',
    password: '',
});

function submit() {
    form.post('/login');
}
const errorMessage = computed(() => usePage().props.errorMessage);
</script>

<style scoped></style>
