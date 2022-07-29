<script setup>
import { ref } from 'vue';
import { computed, reactive } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    favorbonds: Object,
    id: String,
});

const el = ref()
const myValue = ref(null);
const myOptions = ref([
    {id: 1, text: "value 1"},
    {id: 2, text: "value 2"},
    {id: 3, text: "value 3"},
]);

const state = reactive({
    search: null,
    array: [
        { id: 1, title: "Thanos", content: "123" },
        { id: 2, title: "Deadpool", content: "456" },
        { id: 3, title: "Batman", content: "789" },
    ],
});

const filter = computed(() => {
    if (state.search) {
        //console.log('check2a')
        return state.array.filter((item) => {
            return state.search
                .toLowerCase()
                .split(" ")
                .every((v) => item.title.toLowerCase().includes(v));
        });
    } else {
        console.log("check2b");
        return state.array;
    }
});

</script>

<template>
    <AppLayout title="Categories">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="bg-white sm:p-6 shadow sm:rounded-md">

                <!-- <div class="flex mt-8 mb-8">

                    <div class="grid grid-cols-3">
                        <div class="flex">
                            <v-select 
                                :options="myOptions" 
                                v-model="myValue" 
                                label="text" 
                                placeholder="select..." 
                                :reduce="(option) => option.id"
                            ></v-select>
                        </div>
                        <div>
                            <input class="search-field textfield-closed" type="text" placeholder="Search" v-model="state.search" />
                        </div>
                        <div>
                            <p>{{ state.array }}</p>
                        </div>

                        <br>
                        <h4>Value: {{ myValue }}</h4>

                    </div>

                </div> -->

                <ul class="list-outside ...">
                    <li class="mt-4">
                        <div class="grid grid-cols-3 gap-3 pl-8 pr-8 ml-8 mr-8">
                            <div><h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Category</h5></div>
                            <div><h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Favor</h5></div>
                            <div><h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Price</h5></div>
                        </div>
                    </li>
                    <div class="border-t border-gray-100 mt-4" />



                    <div v-for="(f,i) in favorbonds" :key="i" class="p-8 bg-white border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex">
                            <div class="grow">
                                <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ f.title }}
                                </h5>
                            </div>
                            <div class="flex-none w-1/6">
                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                    {{ f.price }} 
                                </p>
                            </div>
                            <div class="flex-none w-1/5">
                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                    {{ f.updated_at }} <br>
                                    

                                    



                                </p>
                            </div>
                        </div>
                        <div class="flex mt-1">
                            <div class="flex-none w-1/5">
                                <a href="#">
                                    <p class="font-normal text-gray-700 dark:text-gray-400">
                                        Category: {{ f.name }} 
                                    </p>
                                </a>
                            </div>
                            <div class="grow">
                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                    {{ f.description.substring(0, 100) }}...
                                </p>
                            </div>
                        </div>
                    </div>

                    <li v-for="(f,i) in favorbonds" :key="i">


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