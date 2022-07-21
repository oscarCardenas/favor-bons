<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetCheckbox from '@/Jetstream/Checkbox.vue';

const el = ref()
const emit = defineEmits(['toBack'])

const form = useForm({
    _method: 'POST',
    full_name:'',
    card_number:'',
    exp_date:'',
    cvc: '',
    default_payment: ''
});

const Back = () => {
    emit('toBack');
    form.reset()
};

const storeCreditCardInformation = () => {
    form.post(route('creditcard.store'), {
        errorBag: 'storeCreditCardInformation',
        preserveScroll: true,
        onSuccess: () => {
            Back();
        }
    });
};

</script>

<template>
    <form @submit.prevent="storeCreditCardInformation">
        <!-- full_name -->
        <div class="col-span-6 sm:col-span-4 mt-8">
            <JetLabel for="full_name" value="Full Name" />
            <JetInput
                id="full_name"
                v-model="form.full_name"
                type="text"
                class="mt-1 block w-full"
                autocomplete="full_name"
            />
            <JetInputError :message="form.errors.full_name" class="mt-2" />
        </div>

        <!-- card_number -->
        <div class="col-span-6 sm:col-span-4 mt-8">
            <JetLabel for="card_number" value="Card Number" />
            <JetInput
                id="card_number"
                v-model="form.card_number"
                type="text"
                class="mt-1 block w-full"
            />
            <JetInputError :message="form.errors.card_number" class="mt-2" />                
        </div>

        <!-- exp_date -->
        <div class="col-span-6 sm:col-span-4 mt-8">
            <JetLabel for="exp_date" value="Expire Date" />
            <JetInput
                id="exp_date"
                v-model="form.exp_date"
                type="text"
                class="mt-1 block w-full"
            />
            <JetInputError :message="form.errors.exp_date" class="mt-2" />                
        </div>

        <!-- cvc -->
        <div class="col-span-6 sm:col-span-4 mt-8">
            <JetLabel for="cvc" value="CVC" />
            <JetInput
                id="cvc"
                v-model="form.cvc"
                type="password"
                class="mt-1 block w-full"
            />
            <JetInputError :message="form.errors.cvc" class="mt-2" />                
        </div>


        <div class="col-span-6 sm:col-span-4 mt-8">
            <label class="flex items-center">
                <JetCheckbox v-model="form.default_payment" name="default_payment" :checked="form.default_payment == 1"/>
                <span class="ml-2 text-sm text-gray-600">
                    Set as default payment method.
                </span>
            </label>
            <JetInputError :message="form.errors.default_payment" class="mt-2" />                
        </div>

        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </JetActionMessage>
            <JetButton class="bg-gray-300 hover:bg-gray-400 ml-2 mr-2" @click="Back">
                Back
            </JetButton>
            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </div>
    </form>
</template>
