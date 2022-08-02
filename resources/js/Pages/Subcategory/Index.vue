<script setup>
import { ref, onMounted, watch, computed, reactive } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    favorbonds: Object,
    categories: Object,
    subcategory_id: String,
});

const el = ref()
const paginate = reactive ({
    currentSort: 'name',
    currentSortDir: 'asc',
    gridData: [],
    dataPerPage: 25,
    currentPage: 1,
    filterDatalength: 0,
    search: ''
});

onMounted(() => {
    paginate.gridData = props.favorbonds;
    subcategoryId.value = props.subcategory_id;
    setTimeout(() => reload.value = true, 1000);
});

const reload = ref(false)
const subcategoryId = ref(null)
const form = useForm({ subcategory_id: '' });
watch(subcategoryId, (NewcategoryId) => {
    if(reload.value == true){
        form.subcategory_id = subcategoryId.value;
        form.get(route('subcategories.public'));
    }
});

const filterOption = computed(() => {
    let datos = paginate.gridData.sort((a, b) => {
        let modifier = 1;
        if (paginate.currentSortDir === "desc") modifier = -1;
        if (a[paginate.currentSort] < b[paginate.currentSort]) return -1 * modifier;
        if (a[paginate.currentSort] > b[paginate.currentSort]) return 1 * modifier;
        return 0;
    }).filter((item) => {
        let title = item.title.toLowerCase()
        let searchTitle = title.includes(paginate.search.toLowerCase());
        return searchTitle;
    });
    paginate.filterDatalength = datos.length;
    return datos;            
});

const changePage = (current, next, direction) => {
    if (direction == 'left' && paginate.currentPage == 1) {
        return;
    } else if (direction == 'right' && (((paginate.currentPage * paginate.dataPerPage) -
        paginate.dataPerPage + 1 + paginate.dataPerPage) > paginate.filterDatalength)) {
        return;
    }
    paginate.currentPage = next;
};

const display_page = (i) => {
    let from = (paginate.currentPage - 1) * paginate.dataPerPage;
    let to = paginate.currentPage * paginate.dataPerPage;

    if (i >= from && i < to) {
        return true;
    }
    return false;
};

const sort = (s) => {
    if (s === paginate.currentSort) {
        paginate.currentSortDir = paginate.currentSortDir === "asc" ? "desc" : "asc";
    }
    paginate.currentSort = s;
};

</script>

<template>
    <AppLayout title="Subcategories">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Subcategories
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="bg-white sm:p-6 shadow sm:rounded-md">
                <div class="flex">
                    <div class="flex-none w-1/4 mt-1 mr-8">
                        <select name="subcategories" id="subcategories" v-model="subcategoryId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">All subcategories</option>
                            <optgroup :label="c.name" v-for="(c,i) in categories" :key="i">
                                <option :value="sub.id" v-for="(sub,s) in c.sub_category" :key="s">{{sub.name}}</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="grow mr-8">
                        <JetInput
                            id="seach"
                            v-model="paginate.search"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="Search..."
                            autocomplete="seach"
                        />
                    </div>
                    <div class="flex-none w-1/4 ml-8 mt-4">
                        <div class="flex items-end">
                            <span v-if="paginate.filterDatalength <= paginate.dataPerPage">
                                {{ paginate.currentPage }} - {{ paginate.filterDatalength }} de {{ paginate.filterDatalength }}
                            </span>
                            <span v-else-if="paginate.currentPage==1">
                                {{ paginate.currentPage }} - {{ paginate.dataPerPage }} de {{ paginate.filterDatalength }}
                            </span>
                            <span v-else-if="((paginate.currentPage*paginate.dataPerPage) - paginate.dataPerPage+1 + paginate.dataPerPage) >
                            paginate.filterDatalength">
                                {{ (paginate.currentPage*paginate.dataPerPage) - paginate.dataPerPage+1 }} - {{ paginate.filterDatalength }}
                                de {{ paginate.filterDatalength }}
                            </span>
                            <span v-else>
                                {{ (paginate.currentPage*paginate.dataPerPage) - paginate.dataPerPage+1 }} -
                                {{ paginate.currentPage*paginate.dataPerPage }} de {{ paginate.filterDatalength }}
                            </span>
                            <button class="arrow-btn"
                                    @click="changePage(paginate.currentPage,(paginate.currentPage-1), 'left')">
                                <div class="arrow arrow-left" :class="{ disabled: (paginate.currentPage===1 ||
                                paginate.filterDatalength <= paginate.dataPerPage) }">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                </div>
                            </button> 
                            <button class="arrow-btn"
                                    @click="changePage(paginate.currentPage,(paginate.currentPage+1), 'right')">
                                <div class="arrow arrow-right"
                                        :class="{ disabled: (
                                        (paginate.currentPage*paginate.dataPerPage)-(paginate.dataPerPage-1) == paginate.filterDatalength ||
                                        ((paginate.currentPage*paginate.dataPerPage) - paginate.dataPerPage+1 + paginate.dataPerPage)
                                        > paginate.filterDatalength)}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>

                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="list-outside ...">
                    <li class="mt-4">
                        <div class="grid grid-cols-4 gap-4 pl-8 pr-8 ml-8 mr-8">
                            <div class="flex" @click="sort('name')">
                                <h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Category</h5>
                                <div v-if="paginate.currentSort == 'name'" class="ml-2 mt-1">
                                    <svg v-if="paginate.currentSortDir == 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                    <svg v-if="paginate.currentSortDir == 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex" @click="sort('title')">
                                <h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Favor</h5>
                                <div v-if="paginate.currentSort == 'title'" class="ml-2 mt-1">
                                    <svg v-if="paginate.currentSortDir == 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                    <svg v-if="paginate.currentSortDir == 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex" @click="sort('price')">
                                <h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Price</h5>
                                <div v-if="paginate.currentSort == 'price'" class="ml-2 mt-1">
                                    <svg v-if="paginate.currentSortDir == 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                    <svg v-if="paginate.currentSortDir == 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex" @click="sort('updated_at')">
                                <h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Published</h5>
                                <div v-if="paginate.currentSort == 'updated_at'" class="ml-2 mt-1">
                                    <svg v-if="paginate.currentSortDir == 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                    <svg v-if="paginate.currentSortDir == 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </li>
                    <div class="border-t border-gray-100 mt-4" />
                    <li v-for="(f,i) in filterOption" :key="i">
                        <div class="grid grid-cols-4 gap-4 pl-8 pr-8 ml-8 mr-8 mt-4" v-if="display_page(i)">
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
                                    {{ f.price }} Favor
                                </h6>
                            </a>
                            <a href="javascript:void(0);">
                                <h6 class="font-medium leading-tight text-base mt-0 mb-2">
                                    {{ f.updated_at }} 
                                </h6>
                            </a>
                        </div>
                        <div class="border-t border-gray-100 mt-4" v-if="display_page(i)" />
                    </li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>