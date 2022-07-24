<script setup>
import { ref,onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

defineEmits(['editCreditCard'])

const el = ref()
const CreditCardList = ref([]);
const confirmingCardDeletion = ref(false);
const passwordInput = ref(null);
const IndexCard = ref(null);
const IndexMsg = ref(null);

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

const SetDefaultPayment = (d,i) => {
    axios.put(route('creditcard.activate'),d).then(response => {
        IndexMsg.value = i
        setTimeout(() => reloadList(response.data), 100);
    })
}

const reloadList = (data) => {
    CreditCardList.value = data
    IndexMsg.value = null
}

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
    <!-- <table class="rounded-t-lg mt-5 min-w-full mx-auto">
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
                        <a v-if="c.default_payment != 1" href="javascript:void(0);" title="Set as default payment method" @click="SetDefaultPayment(c,i)">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                        </a>
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
    </table> -->

    <div v-for="(c,i) in CreditCardList" :key="i" class="mt-8 p-6 bg-white border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="grid grid-cols-2 gap-2">
            <div class="flex items-center text-left">
                <a href="javascript:void(0);">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        **** **** **** {{ c.card_number }} 
                    </h5>
                </a>
            </div>
            <div class="flex items-center justify-end text-right">
                <a v-if="c.default_payment != 1" href="javascript:void(0);" title="Set as default payment" @click="SetDefaultPayment(c,i)">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                </a>
                <a href="javascript:void(0);" title="Edit" @click="$emit('editCreditCard',c)">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </a>
                <a href="javascript:void(0);" title="Delete" @click="confirmDeleteCreditCard(c,i)">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="flex items-center text-left">
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Expire date: {{ c.mont}}/{{ c.year}}
                </p>
            </div>
            <div class="flex items-center justify-end text-right">
                <span v-if="c.default_payment == 1" class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-300">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    default payment
                </span>
            </div>
        </div>
    </div>

    <JetActionMessage :on="IndexMsg != null" class="mr-3 mt-3">
        Changed.
    </JetActionMessage>

    <JetActionMessage :on="formP.recentlySuccessful" class="mr-3 mt-3">
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







