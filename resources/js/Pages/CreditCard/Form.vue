<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetCheckbox from '@/Jetstream/Checkbox.vue';

const el = ref()
const emit = defineEmits(['toBack'])

const props = defineProps({
    Action: String,
    cardData: Object,
});

const form = useForm({
    id: '',
    full_name:'',
    card_number:'',
    exp_date:'',
    cvc: '',
    default_payment: ''
});

onMounted(() => {
    setData(props.cardData);
})

const setData = (data) => {
    if(props.Action != 'create'){
        form.id = data.id;
        form.full_name = data.full_name;
        form.exp_date = data.exp_date;
        form.default_payment = data.default_payment;
    }
};

const Back = () => {
    emit('toBack');
    form.reset()
};

const storeCreditCardInformation = () => {
    if(props.Action == 'create'){
        form.post(route('creditcard.store'), {
            errorBag: 'storeCreditCardInformation',
            preserveScroll: true,
            onSuccess: () => {
                Back();
            }
        });
    }else{
        form.put(route('creditcard.update'), {
            errorBag: 'storeCreditCardInformation',
            preserveScroll: true,
            onSuccess: () => {
                Back();
            }
        });
    }
};
</script>

<template>
    <form @submit.prevent="storeCreditCardInformation">
            <div class="grid grid-cols-6 gap-6">
                <!-- full_name -->
                <div class="col-span-6 sm:col-span-4">
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
                <div class="col-span-6 sm:col-span-4" v-if="props.Action == 'create'">
                    <JetLabel for="card_number" value="Card Number" />
                    <JetInput
                        id="card_number"
                        v-model="form.card_number"
                        maxlength="16"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.card_number" class="mt-2" /> 
                </div>
                <!-- exp_date -->
                <div class="col-span-6 sm:col-span-4">
                    <JetLabel for="exp_date" value="Expire Date" />
                    <Datepicker v-model="form.exp_date" monthPicker autoApply />
                    <JetInputError :message="form.errors.exp_date" class="mt-2" />    
                </div>
                <!-- cvc -->
                <div class="col-span-6 sm:col-span-4" v-if="props.Action == 'create'">
                    <JetLabel for="cvc" value="CVC" />
                    <JetInput
                        id="cvc"
                        v-model="form.cvc"
                        maxlength="3"
                        type="password"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.cvc" class="mt-2" />       
                </div>
                <!-- default_payment -->
                <div class="col-span-6 sm:col-span-4 mb-6">
                    <label class="flex items-center">
                        <JetCheckbox v-model="form.default_payment" name="default_payment" :checked="form.default_payment == 1"/>
                        <span class="ml-2 text-sm text-gray-600">
                            Set as default payment method.
                        </span>
                    </label>
                    <JetInputError :message="form.errors.default_payment" class="mt-2" />    
                </div>

            </div>

        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
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
