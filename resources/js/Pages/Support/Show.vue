<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useForm,usePage } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    user: Object,
    msgsuccess: String
});

const form = useForm({
    _method: 'POST',
    name: props.user.name,
    email: props.user.email,
    message: ''
});

const storeSupport = () => {
    form.post(route('support.store'), {
        errorBag: 'storeSupport',
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Customer Support
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
                        
                        <form @submit.prevent="storeSupport">
                            <div class="flex sm:px-6 ">
                                <div class="grid md:grid-cols-2 md:gap-6 mt-6">
                                    <div class="relative z-0 w-full mb-4 group">
                                        <JetLabel for="name" value="Name" />
                                        <JetInput
                                            id="name"
                                            v-model="form.name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            placeholder="Enter your name"
                                            autocomplete="name"
                                        />
                                        <JetInputError :message="form.errors.name" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="flex sm:px-6">
                                <div class="grid md:grid-cols-2 md:gap-6 mt-6">
                                    <div class="relative z-0 w-full mb-4 group">
                                        <JetLabel for="email" value="Email" />
                                        <JetInput
                                            id="email"
                                            v-model="form.email"
                                            type="text"
                                            class="mt-1 block w-full"
                                            placeholder="Enter your Email"
                                            autocomplete="email"
                                        />
                                        <JetInputError :message="form.errors.email" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="sm:px-6">
                                <div class="mt-6">
                                    <div class="relative z-0 w-full mb-4 group">
                                        <JetLabel for="message" value="Message" />
                                        <textarea v-model="form.message" id="message" rows="4" class="w-full block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></textarea>
                                        <JetInputError :message="form.errors.message" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center sm:px-6 ">
                                <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                                    Successful delivery
                                </JetActionMessage>
                                <div class="grid md:grid-cols-2 md:gap-6 mt-6">
                                    <div class="relative z-0 w-full mb-8 group mt-2">
                                        <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Send
                                        </JetButton>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>


</template>