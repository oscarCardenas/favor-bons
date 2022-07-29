<script>
    import { ref, onMounted } from 'vue';
    import { computed, reactive } from "vue";
    import AppLayout from '@/Layouts/AppLayout.vue';

    export default {
        props: {
            favorbonds: Object,
            categories: Object,
            id: String
        },
        components:{
            AppLayout
        },
        data() {
            return {
                currentSort: "name",
                currentSortDir: "asc",
                gridData: [],
                dataPerPage: 25,
                currentPage: 1,
                filterDatalength: 0,
                search: '',
                categoryId: 0
            };
        },
        mounted() {
            this.gridData = this.favorbonds;
            console.log("param route: ");
            console.log(this);
        },
        watch:{
            categoryId(){
                console.log("cambio " + this.categoryId);
            }
        },
        computed: {
            filterOption: function () {
                let datos = this.gridData.sort((a, b) => {
                    let modifier = 1;
                    if (this.currentSortDir === "desc") modifier = -1;
                    if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                    if (a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                    return 0;
                }).filter((item) => {

                    let title = item.title.toLowerCase()
                    let searchTitle = title.includes(this.search.toLowerCase());

                    return searchTitle;
                });
                this.filterDatalength = datos.length;
                return datos;
            },
        },
        methods: {
            changePage(current, next, direction) {
                if (direction == 'left' && this.currentPage == 1) {
                    return;
                } else if (direction == 'right' && (((this.currentPage * this.dataPerPage) -
                    this.dataPerPage + 1 + this.dataPerPage) > this.filterDatalength)) {
                    return;
                }
                this.currentPage = next;
            },
            display_page(i) {
                let from = (this.currentPage - 1) * this.dataPerPage;
                let to = this.currentPage * this.dataPerPage;
                if (i >= from && i < to) {
                    return true;
                }
                return false;
            },
            sort: function (s) {
                if (s === this.currentSort) {
                    this.currentSortDir = this.currentSortDir === "asc" ? "desc" : "asc";
                }
                this.currentSort = s;
            }
        }
    };
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
                <div class="flex">
                    <div class="flex-none w-1/4">
                        <label></label>
                        <select name="categories" id="categories" v-model="categoryId">
                            <option value="0" selected>All categories</option>
                            <option v-for="(c, i) in categories" :value="c.id" :key="i">{{c.name}}</option>
                        </select>
                    </div>
                    <div class="grow">
                        <JetInput
                            id="seach"
                            v-model="search"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="Search..."
                            autocomplete="seach"
                        />
                    </div>
                    <div class="flex-none w-1/4 ml-8 mt-4">
                        <div class="flex items-end">
                            <span v-if="filterDatalength <= dataPerPage">
                                {{ currentPage }} - {{ filterDatalength }} de {{ filterDatalength }}
                            </span>
                            <span v-else-if="currentPage==1">
                                {{ currentPage }} - {{ dataPerPage }} de {{ filterDatalength }}
                            </span>
                            <span v-else-if="((currentPage*dataPerPage) - dataPerPage+1 + dataPerPage) >
                            filterDatalength">
                                {{ (currentPage*dataPerPage) - dataPerPage+1 }} - {{ filterDatalength }}
                                de {{ filterDatalength }}
                            </span>
                            <span v-else>
                                {{ (currentPage*dataPerPage) - dataPerPage+1 }} -
                                {{ currentPage*dataPerPage }} de {{ filterDatalength }}
                            </span>
                            <button class="arrow-btn"
                                    @click="changePage(currentPage,(currentPage-1), 'left')">
                                <div class="arrow arrow-left" :class="{ disabled: (currentPage===1 ||
                                filterDatalength <= dataPerPage) }">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                </div>
                            </button> 
                            <button class="arrow-btn"
                                    @click="changePage(currentPage,(currentPage+1), 'right')">
                                <div class="arrow arrow-right"
                                        :class="{ disabled: (
                                        (currentPage*dataPerPage)-(dataPerPage-1) == filterDatalength ||
                                        ((currentPage*dataPerPage) - dataPerPage+1 + dataPerPage)
                                        > filterDatalength)}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>

                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="list-outside">
                    <li class="mt-4">
                        <div class="grid grid-cols-4 gap-4 pl-8 pr-8 ml-8 mr-8">
                            <div class="flex" @click="sort('name')">
                                <h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Category</h5>
                                <div v-if="currentSort == 'name'" class="ml-2 mt-1">
                                    <svg v-if="currentSortDir == 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                    <svg v-if="currentSortDir == 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex" @click="sort('title')">
                                <h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Favor</h5>
                                <div v-if="currentSort == 'title'" class="ml-2 mt-1">
                                    <svg v-if="currentSortDir == 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                    <svg v-if="currentSortDir == 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex" @click="sort('price')">
                                <h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Price</h5>
                                <div v-if="currentSort == 'price'" class="ml-2 mt-1">
                                    <svg v-if="currentSortDir == 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                    <svg v-if="currentSortDir == 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex" @click="sort('updated_at')">
                                <h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Published</h5>
                                <div v-if="currentSort == 'updated_at'" class="ml-2 mt-1">
                                    <svg v-if="currentSortDir == 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                    <svg v-if="currentSortDir == 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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