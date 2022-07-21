<script setup>
import { ref,onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

defineEmits(['editCreditCard'])

const el = ref()
const CreditCardList = ref([]);
const confirmingCardDeletion = ref(false);
const passwordInput = ref(null);
const IndexCard = ref(null);

const formP = useForm({
    id:'',
    password: '',
});

onMounted(() => {
    getCreditCardList();    
})

const getCreditCardList = () => {
    axios.get(route('creditcard.index')).then(response => {
        CreditCardList.value = response.data
    })
};

const confirmDeleteCreditCard = (data,index) => {
    formP.id = data.id;
    IndexCard.value = index;
    confirmingCardDeletion.value = true;
    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteCreditCard = () => {
    formP.delete(route('creditcard.destroy'), {
        preserveScroll: true,
        onSuccess: (d) => {
            CreditCardList.value.splice(IndexCard.value,1);            
            closeModal();
        },
        onError: () => passwordInput.value.focus(),
        onFinish: () => formP.reset(),
    });
};

const closeModal = () => {
    confirmingCardDeletion.value = false;
    formP.reset();
};

</script>

<template>
    <table class="rounded-t-lg mt-5 min-w-full mx-auto">
        <thead class="border-b">
            <tr>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Name</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Credit card</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Expire date</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="border-b text-center">
            <tr v-for="(c,i) in CreditCardList" :key="i" class="border-b">
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-left">
                    {{c.full_name}}
                    <span v-if="c.default_payment == 1" 
                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                        Default
                    </span>
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-left">{{c.card_number}}</td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-left">{{c.exp_date}}</td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <div class="flex">
                        <a href="javascript:void(0);" title="Edit" @click="$emit('editCreditCard',c)">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <a href="javascript:void(0);" title="Delete" @click="confirmDeleteCreditCard(c,i)">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <JetActionMessage :on="formP.recentlySuccessful" class="mr-3">
        Deleted.
    </JetActionMessage>
    <!-- Delete Account Confirmation Modal -->
    <JetDialogModal :show="confirmingCardDeletion" @close="closeModal">
        <template #title>
            Delete Credit Card
        </template>

        <template #content>
            Are you sure you want to delete your credit card? when you delete you will not be able to buy more favorbonds
            <input type="hidden" v-model="formP.id">
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







