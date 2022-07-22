<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetCheckbox from '@/Jetstream/Checkbox.vue';

const el = ref()
const emit = defineEmits(['toBack'])

const props = defineProps({
    Action: String,
    Billing: Object,
});

const form = useForm({
    id: '',
    first_name: '',
    last_name: '',
    email_address: '',
    phone_number: '',
    shipping_address: '',
    billing_address: '',
    default_billing: ''
});

onMounted(() => {
    setData(props.Billing);
})

const setData = (data) => {    
    if(props.Action != 'create'){
        form.id = data.id;
        form.first_name = data.first_name;
        form.last_name = data.last_name;
        form.email_address = data.email_address;
        form.phone_number = data.phone_number;
        form.shipping_address = data.shipping_address;
        form.billing_address = data.billing_address;
        form.default_billing = data.default_billing;
    }
};

const Back = () => {
    emit('toBack');
    form.reset()
};

const storeBillingInformation = () => {
    if(props.Action == 'create'){
        form.post(route('billing.store'), {
            errorBag: 'storeBillingInformation',
            preserveScroll: true,
            onSuccess: () => {
                Back();
            }
        });
    }else{
        form.put(route('billing.update'), {
            errorBag: 'storeBillingInformation',
            preserveScroll: true,
            onSuccess: () => {
                Back();
            }
        });
    }
};
</script>

<template>
    <form @submit.prevent="storeBillingInformation">
            <div class="grid grid-cols-6 gap-6">
                <!-- first_name -->
                <div class="col-span-6 sm:col-span-4">
                    <JetLabel for="first_name" value="First name" />
                    <JetInput
                        id="first_name"
                        v-model="form.first_name"
                        maxlength="30"
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
                        maxlength="30"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.last_name" class="mt-2" /> 
                </div>
                <!-- email_address -->
                <div class="col-span-6 sm:col-span-4">
                    <JetLabel for="email_address" value="Email addres" />
                    <JetInput
                        id="email_address"
                        v-model="form.email_address"
                        maxlength="30"
                        type="email"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.email_address" class="mt-2" />    
                </div>
                <!-- phone_number -->
                <div class="col-span-6 sm:col-span-4">
                    <JetLabel for="phone_number" value="Phone number" />
                    <JetInput
                        id="phone_number"
                        v-model="form.phone_number"
                        maxlength="30"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.phone_number" class="mt-2" />    
                </div>
                <!-- shipping_address -->
                <div class="col-span-6 sm:col-span-4">
                    <JetLabel for="shipping_address" value="Shipping address" />
                    <JetInput
                        id="shipping_address"
                        v-model="form.shipping_address"
                        maxlength="60"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.shipping_address" class="mt-2" />    
                </div>
                <!-- billing_address -->
                <div class="col-span-6 sm:col-span-4">
                    <JetLabel for="billing_address" value="Billing address" />
                    <JetInput
                        id="billing_address"
                        v-model="form.billing_address"
                        maxlength="60"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.billing_address" class="mt-2" />    
                </div>
                <!-- default_billing -->
                <div class="col-span-6 sm:col-span-4 mb-6">
                    <label class="flex items-center">
                        <JetCheckbox v-model="form.default_billing" name="default_billing" :checked="form.default_billing == 1"/>
                        <span class="ml-2 text-sm text-gray-600">
                            Set as default payment method.
                        </span>
                    </label>
                    <JetInputError :message="form.errors.default_billing" class="mt-2" />    
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
