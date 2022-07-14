<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    categories: Object, 
});

const form = useForm({
    _method: 'POST',
    checkedCategories: [],
    email: ''
});

const loggedIn = ref(null);

onMounted(() => {
    setTimeout(() => verifyloggedIn(), 2000);
})

const verifyloggedIn = () => {
    /** Show register modal if variable client is false */
    if(!localStorage.client){
        loggedIn.value = (usePage().props.value.user == null) ? false : true;
    }
};

const registerClient = () => {
    form.post(route('client.store'),{
        errorBag: 'registerClient',
        preserveScroll: true,
        onSuccess: () => {
            console.log("sucess registration");
            closeModal();
            localStorage.client = true;
        },
    });
};

const closeModal = () => {
    loggedIn.value = true;
    form.reset();
};
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

                        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                            
                            <div class="mt-8 dark:bg-gray-800">

                                <div v-for="(c,i) in categories" :key="i" class="mt-8 p-6 bg-white border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                    <a href="#">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{ c.name }}
                                        </h5>
                                    </a>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                    <a href="#" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Read more
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </div>
                            
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- modal login -->
        <JetDialogModal :show="loggedIn == false">
        <!-- :closeable="false" -->
            <template #title>
                Favorbonds
            </template>

            <template #content>
                <p>
                    <Link :href="route('login')" class="text-sm text-gray-700 underline">
                        Log in
                    </Link>,
                    <Link :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                        Register
                    </Link>
                    or enter your email to continue viewing FavorBonds and so much more.
                </p>
                <p>
                    Categories of Favors Interested In (select all that apply)
                </p>
                <form @submit.prevent="registerClient">
                    <div class="grid grid-rows-4 grid-flow-col gap-4 mt-6">
                        <div class="flex items-center" v-for="(c,i) in categories" :key="i">
                            <input type="checkbox" :id="'category'+c.id" :value="c.id" v-model="form.checkedCategories" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label :for="'category'+c.id" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ c.name}}
                            </label>
                        </div>
                    </div> 

                    <div class="flex items-center justify-end sm:px-6 ">
                        <div class="grid md:grid-cols-2 md:gap-6 mt-6">
                            <div class="relative z-0 w-full mb-4 group">
                                <JetInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    autocomplete="email"
                                    placeholder="Enter your mail"
                                />
                                <JetInputError :message="form.errors.email" class="mt-2" />
                            </div>
                            <div class="relative z-0 w-full mb-8 group mt-2">
                                <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save
                                </JetButton>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <p>
                            By clicking Continue you agree to FavorBond Terms & Conditions and Privacy Policies.
                        </p>
                    </div>
                </form>
            </template>
        </JetDialogModal>
    </AppLayout>


</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>
