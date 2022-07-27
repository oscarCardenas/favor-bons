<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';

defineProps({
    policy: String,
});
</script>

<template>
    <Head title="Privacy Policy" />

    <div class="font-sans text-gray-900 antialiased">
        <div class="pt-4 bg-gray-100">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div>
                    <JetAuthenticationCardLogo />
                </div>

                <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo itaque, expedita minima fuga et minus dicta 
                    recusandae est quam inventore ratione unde accusantium provident eligendi. Atque facilis laborum fugiat quas.
                </div>
            </div>
        </div>
    </div>
</template>
