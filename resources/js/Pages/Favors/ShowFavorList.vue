<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import FavorsListItem from '@/Components/FavorsListItem.vue';    

    const props = defineProps({
        favorList: Array
    });

</script>

<template>
    <AppLayout title="My Favors">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Favors
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                
                <div class="bg-white sm:p-6 shadow sm:rounded-md">
                    <div className="divide-y divide-slate-100" >
                        <a :href="route('favors.create')" class="h-10 px-6 font-semibold rounded-md bg-black text-white">
                            Create Favors
                        </a>
                    </div>
                </div>

                <div class="bg-white sm:p-6 shadow sm:rounded-md">
                    <div className="divide-y divide-slate-100" >
                        <FavorsListItem v-for="favor in favorList" :key="favor.id"  :favor="favor" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
