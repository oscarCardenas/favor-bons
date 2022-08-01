<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import FavorBondsListItem from '@/Components/FavorBondsListItem.vue';    

    const props = defineProps({
        favorBonds: Array
    });

</script>

<template>
    <AppLayout title="My Favor Bonds">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Favor Bonds
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="bg-white sm:p-6 shadow sm:rounded-md">
                    <div className="divide-y divide-slate-100" >
                        <FavorBondsListItem v-for="favorBond in favorBonds" :key="favorBond.id"  :favorBond="favorBond" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
