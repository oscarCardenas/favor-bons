<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { usePage } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    categories: Object, 
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Welcome
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
                        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 underline">
                                Dashboard
                            </Link>

                            <template v-else>
                                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                                    Log in
                                </Link>

                                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                                    Register
                                </Link>
                            </template>
                        </div>

                        <div class="bg-white sm:p-6 shadow sm:rounded-md">
                            <div class="grid grid-cols-3 gap-3 pl-8 pr-8 ml-8 mr-8">
                                <div v-for="(c,i) in categories" :key="i" class="mt-8 p-6 bg-white border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                    <div class="h-80">
                                        <a href="#">
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                {{ c.name }}
                                            </h5>
                                        </a>
                                        <div class="mt-8">
                                            <p  v-for="(sub,s) in c.sub_category" :key="s" class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                <div class="flex" v-if="s < 3">
                                                    <span class="mr-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </span>
                                                    <span>
                                                        {{ sub.name }}
                                                    </span>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <a :href="route('categories.public', { category_id: c.id })" class="w-full h-12 px-6 py-3 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>


</template>