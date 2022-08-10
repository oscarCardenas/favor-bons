<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import JetInputError from '@/Jetstream/InputError.vue';

defineProps({
    categories: Object, 
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    interest_categories: [],
    terms: false,
});

const submit = () => {
    form.post(route('register.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <JetAuthenticationCard class="wrapper">


        <!-- <JetValidationErrors class="mb-4" /> -->

        <!-- <pre>
            {{ categories }}
        </pre> -->

        <form @submit.prevent="submit">
            <div>
                 <JetAuthenticationCardLogo />
                <JetLabel for="name" value="Name" />
                <JetInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full focus:ring-borderInput"
                    autofocus
                    autocomplete="name"
                />
                <JetInputError :message="form.errors.name" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <JetLabel for="email" value="Email" />
                <JetInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full focus:ring-borderInput"
                />
                <JetInputError :message="form.errors.email" class="mt-2" />
            </div>

            <div class="mt-4">
                <JetLabel for="password" value="Password" />
                <JetInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full focus:ring-borderInput"
                    autocomplete="new-password"
                />
                <JetInputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="mt-4">
                <JetLabel for="password_confirmation" value="Confirm Password" />
                <JetInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full focus:ring-borderInput"
                    autocomplete="new-password"
                />
                <JetInputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <div class="mt-4">
                <JetLabel for="interest_categories" value="Interest categories" class="mb-3 mt-6"/>
                <div class="grid grid-cols-2 gap-2">
                    <div class="flex items-center" v-for="(c,i) in categories" :key="i">
                        <input type="checkbox" :id="'category'+c.id" :value="c.id" v-model="form.interest_categories" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label :for="'category'+c.id" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ c.name}}
                        </label>
                    </div>
                </div>
                <JetInputError :message="form.errors.interest_categories" class="mt-2" />
            </div>

            <div class="mt-4">
                <JetLabel for="terms">
                    <div class="flex items-center">
                        <JetCheckbox id="terms" v-model:checked="form.terms" name="terms" />
                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                    <JetInputError :message="form.errors.terms" class="mt-2" />
                </JetLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <JetButton class="ml-4 primaryButton" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </JetButton>
            </div>
        </form>
    </JetAuthenticationCard>
</template>
