<script setup>
import { ref,onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
// import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    favorbonds: Object,
});

const el = ref()
const redirectFavorbonds = () => {
    console.log("redirige a favorbonds page");
};

</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="bg-white sm:p-6 shadow sm:rounded-md">
                <ul class="list-outside ...">
                    <li class="mt-4">
                        <div class="grid grid-cols-3 gap-3 pl-8 pr-8 ml-8 mr-8">
                            <div><h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Category</h5></div>
                            <div><h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Favor</h5></div>
                            <div><h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Price</h5></div>
                        </div>
                    </li>
                    <div class="border-t border-gray-100 mt-4" />
                    <li v-for="(f,i) in favorbonds" :key="i" @click="redirectFavorbonds">
                        <div class="grid grid-cols-3 gap-3 pl-8 pr-8 ml-8 mr-8 mt-4">
                            <a href="javascript:void(0);">
                                <h6 class="font-medium leading-tight text-base mt-0 mb-2">
                                    {{ f.name }} 
                                </h6>
                            </a>
                            <a href="javascript:void(0);">
                                <h6 class="font-medium leading-tight text-base mt-0 mb-2">
                                    {{ f.title }} 
                                </h6>
                            </a>
                            <a href="javascript:void(0);">
                                <h6 class="font-medium leading-tight text-base mt-0 mb-2">
                                    {{ f.price }} 
                                </h6>
                            </a>
                        </div>
                        <div class="border-t border-gray-100 mt-4" />
                    </li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>