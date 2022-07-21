<script setup>
import { ref,onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import JetSectionTitle from '@/Jetstream/SectionTitle.vue';

const el = ref()

const form = useForm({
    first_name:'',
    last_name:'',
    email_address:'',
    phone_number:'',
    shipping_address:'',
    billing_address:''
});
</script>

<template>
    <JetFormSection>
        <template #title>
            Billing Information
        </template>

        <template #description>
            Update your account's billing information.
        </template>

        <template #form>
            <!-- first_name -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="first_name" value="First name" />
                <JetInput
                    id="first_name"
                    v-model="form.first_name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="first_name"
                />
                <JetInputError :message="form.errors.first_name" class="mt-2" />
            </div>
            <!-- last_name -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="last_name" value="Last name" />
                <JetInput
                    id="last_name"
                    v-model="form.last_name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="last_name"
                />
                <JetInputError :message="form.errors.last_name" class="mt-2" />
            </div>
            <!-- email_address -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="email_address" value="Email address" />
                <JetInput
                    id="email_address"
                    v-model="form.email_address"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="email_address"
                />
                <JetInputError :message="form.errors.email_address" class="mt-2" />
            </div>
            <!-- phone_number -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="phone_number" value="Phone number" />
                <JetInput
                    id="phone_number"
                    v-model="form.phone_number"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="phone_number"
                />
                <JetInputError :message="form.errors.phone_number" class="mt-2" />
            </div>
            <!-- shipping_address -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="shipping_address" value="Shipping address" />
                <JetInput
                    id="shipping_address"
                    v-model="form.shipping_address"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="shipping_address"
                />
                <JetInputError :message="form.errors.shipping_address" class="mt-2" />
            </div>
            <!-- billing_address -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="billing_address" value="Billing address" />
                <JetInput
                    id="billing_address"
                    v-model="form.billing_address"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="billing_address"
                />
                <JetInputError :message="form.errors.billing_address" class="mt-2" />
            </div>   
        </template>

        <template #actions>
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </JetActionMessage>

            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>
    </JetFormSection>
</template>