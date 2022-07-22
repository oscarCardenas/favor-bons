<script setup>
import { ref,onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import JetSectionTitle from '@/Jetstream/SectionTitle.vue';
import BillingAddresIndex from '@/Pages/BillingAddres/Index.vue';
import BillingAddresForm from '@/Pages/BillingAddres/Form.vue';

const el = ref()
const ShowList = ref(true);
const Action = ref(null);
const Billing = ref({});

const editBillingAddres = (d) => {
    Billing.value = d;
    Action.value = 'edit';
    ShowList.value = false;
};

const createCreditCard = (d) => {
    Action.value = 'create';
    ShowList.value = false;
}

const toBack = () => {
    Action.value = '';
    ShowList.value = true;
};
</script>

<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <JetSectionTitle>
            <template #title>
                Billing Information
            </template>
            <template #description>
                Update your account's billing information.
            </template>
        </JetSectionTitle>
        
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                <div v-if="ShowList" class="flex items-center justify-end py-3 text-right">
                    <JetButton @click="createCreditCard">
                        New
                    </JetButton>
                </div>
                <div class="grid">
                    <div class="mt-5 md:mt-0 md:col-span-2" v-if="ShowList">
                        <BillingAddresIndex @editBillingAddres="editBillingAddres" />
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2" v-else>
                        <BillingAddresForm :Action="Action" :Billing="Billing" @toBack="toBack" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
