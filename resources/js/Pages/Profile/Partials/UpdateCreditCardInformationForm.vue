<script setup>
import { ref,onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    creditcard: Object,
    errors: Object,
});

const form = useForm({
    /*_method: 'POST', */
    id:'',
    full_name:'',
    card_number:'',
    exp_date:'',
    cvc:'',
    billing_address:''
});

const formP = useForm({
    password: '',
});

const el = ref()
const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

onMounted(() => {
    getCreditCardInformation();
})

const getCreditCardInformation = () => {
    console.log("getCreditCardInformation");
    axios.get("/user-creditcard").then(response => {
        if(response.data.creditcard != null){
            setData(response.data.creditcard);
        }    
    })
};

const setData = (data) => {
    form.id = data.id;
    form.full_name = data.full_name;
    form.card_number = data.card_number;
    form.exp_date = data.exp_date;
    form.cvc = data.cvc;
    form.billing_address = data.billing_address;
};

const updateCreditCardInformation = () => {
    form.post(route('user-creditcard.update'), {
        errorBag: 'updateCreditCardInformation',
        preserveScroll: true
    });
};

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteCreditCard = () => {
    formP.delete(route('user-creditcard.destroy'), {
        preserveScroll: true,
        onSuccess: (d) => {
            closeModal();
        },
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
};
</script>

<template>
    <JetFormSection @submitted="updateCreditCardInformation">
        <template #title>
            Billing Information
        </template>

        <template #description>
            Update your account's billing information.
        </template>

        <template #form>
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
            <div class="col-span-6 sm:col-span-4">
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
            <div class="col-span-6 sm:col-span-4">
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
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="cvc" value="CVC" />
                <JetInput
                    id="cvc"
                    v-model="form.cvc"
                    type="password"
                    class="mt-1 block w-full"
                />
                <JetInputError :message="form.errors.cvc" class="mt-2" />                
            </div>

            <!-- billing_address -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="billing_address" value="Billing Address" />
                <JetInput
                    id="billing_address"
                    v-model="form.billing_address"
                    type="text"
                    class="mt-1 block w-full"
                />
                <JetInputError :message="form.errors.billing_address" class="mt-2" />                
            </div>
        </template>

        <template #actions>
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </JetActionMessage>

            <JetDangerButton
                class="ml-3 mr-3"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="confirmUserDeletion"
            >
                Delete Credit Card
            </JetDangerButton>
            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </JetButton>
        </template>
    </JetFormSection>
    <!-- Delete Account Confirmation Modal -->
    <JetDialogModal :show="confirmingUserDeletion" @close="closeModal">
        <template #title>
            Delete Credit Card
        </template>

        <template #content>
            Are you sure you want to delete your credit card? when you delete you will not be able to buy more favorbonds
            <div class="mt-4">
                <JetInput
                    ref="passwordInput"
                    v-model="formP.password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Password"
                    @keyup.enter="deleteCreditCard"
                />

                <JetInputError :message="formP.errors.password" class="mt-2" />
            </div>
        </template>

        <template #footer>
            <JetSecondaryButton @click="closeModal">
                Cancel
            </JetSecondaryButton>

            <JetDangerButton
                class="ml-3"
                :class="{ 'opacity-25': formP.processing }"
                :disabled="formP.processing"
                @click="deleteCreditCard"
            >
                Delete Account
            </JetDangerButton>
        </template>
    </JetDialogModal>
</template>
