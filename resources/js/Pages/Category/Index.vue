<script setup>
import { ref, onMounted, watch, computed, reactive } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Jetstream/Modal.vue';

const props = defineProps({
    categories: Object,
});

const el = ref()
const confirmingCardDeletion = ref(false);
const passwordInput = ref(null);
const maxWidth = ref('2xl');
const showModalEdit = ref(false);

const paginate = reactive ({
    currentSort: 'name',
    currentSortDir: 'asc',
    gridData: [],
    dataPerPage: 10,
    currentPage: 1,
    filterDatalength: 0,
    search: ''
});

onMounted(() => {
    manejoRespuesta()
});

const manejoRespuesta = () => {
    paginate.gridData = props.categories;
};

const form = useForm({ 
    id: '', 
    name: '', 
    description: '' 
});

const formP = useForm({
    id:'',
    password: '',
});

const Back = () => {
    form.reset()
    showModalEdit.value = false;
};

const confirmDelete = (d) => {
    formP.id = d.id;
    confirmingCardDeletion.value = true;
    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteCard = () => {
    formP.delete(route('categories.destroy'), {
        preserveScroll: true,
        onSuccess: (d) => {
            closeModal();
            manejoRespuesta();
        },
        onError: () => passwordInput.value.focus(),
        onFinish: () => formP.password = ''
    });
};

const closeModal = () => {
    confirmingCardDeletion.value = false;
    formP.reset();
};

const closeModalEdit = () => {
    form.reset();
};

const Create = (d) => {
    form.id = '';
    form.name = '';
    form.description = '';
    showModalEdit.value = true;
}

const Edit = (d) => {
    form.id = d.id;
    form.name = d.name;
    form.description = d.description;
    showModalEdit.value = true;
}

const store = () => {
    if(form.id > 0){
        form.put(route('categories.update'), {
            errorBag: 'store',
            preserveScroll: true,
            onSuccess: () => {
                manejoRespuesta();
                Back();
            }
        });
    }else{        
        form.post(route('categories.store'), {
            errorBag: 'store',
            preserveScroll: true,
            onSuccess: () => {
                manejoRespuesta();
                Back();
            }
        });
    }
};

const filterOption = computed(() => {
    let datos = paginate.gridData.sort((a, b) => {
        let modifier = 1;
        if (paginate.currentSortDir === "desc") modifier = -1;
        if (a[paginate.currentSort] < b[paginate.currentSort]) return -1 * modifier;
        if (a[paginate.currentSort] > b[paginate.currentSort]) return 1 * modifier;
        return 0;
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
    <AppLayout title="Categories">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="bg-white sm:p-6 shadow sm:rounded-md">
                <div class="flex">
                    <div class="flex-none w-1/3 mt-1 mr-8">
                        <JetButton @click="Create">
                            New
                        </JetButton>
                    </div>
                    <div class="grow mr-8"></div>
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
                        <div class="flex">
                            <div class="flex-none w-3/4 mt-1 mr-8 ml-8 pl-8">
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
                            </div>
                            <div class="flex-none w-1/4 ml-8 mt-4">
                                <div class="flex">
                                    <h5 class="font-medium font-bold leading-tight text-xl mt-0 mb-2">Actions</h5>
                                </div>
                            </div>
                        </div>
                    </li>
                    <div class="border-t border-gray-100 mt-4" />
                    <div v-if="filterOption.length == 0">
                        <div class="grid grid-cols-1 gap-1 pl-8 pr-8 ml-8 mr-8 mt-4 place-items-center">
                            Sorry, no records found
                        </div>
                    </div>
                    <div v-else>
                        <li v-for="(f,i) in filterOption" :key="i">
                            <div class="flex" v-if="display_page(i)">
                                <div class="flex-none w-3/4 mt-6 mr-8 ml-8 pl-8">
                                    <div class="flex">
                                        <h6 class="font-medium leading-tight text-base mt-0 mb-2">
                                            {{ f.name }} 
                                        </h6>
                                    </div>
                                </div>
                                <div class="flex-none w-1/4 ml-8 mt-4">
                                    <div class="flex">
                                        <a href="javascript:void(0);" title="Edit" @click="Edit(f)">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </a>
                                        <a :href="route('subcategories.index', { category_id: f.id })" title="Subcategories">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                                        </a> 
                                        <a href="javascript:void(0);" title="Delete" @click="confirmDelete(f)">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t border-gray-100 mt-4" v-if="display_page(i)" />
                        </li>
                    </div>
                </ul>
            </div>
        </div>
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
                        @keyup.enter="deleteCard"
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
                    @click="deleteCard"
                >
                    Delete
                </JetDangerButton>
            </template>
        </JetDialogModal>
        <!-- modal form categories --> 
        <Modal :show="showModalEdit" :max-width="maxWidth" :closeable="false" @close="closeModalEdit">
            <form @submit.prevent="store">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg" v-if="form.id > 0">Update Category</h3>
                        <h3 class="text-lg" v-else>Create Category</h3>
                        <div class="mt-2">
                            <input type="hidden" v-model="form.id">
                            <div class="mt-4">
                                <JetLabel for="name" value="Name" />
                                <JetInput
                                    ref="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-3/4"
                                    placeholder="Name"
                                />

                                <JetInputError :message="form.errors.name" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <JetLabel for="description" value="Description" />
                                <textarea 
                                    v-model="form.description" 
                                    id="description" 
                                    rows="4"
                                    class="w-full block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Description"
                                ></textarea>
                                <JetInputError :message="form.errors.description" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
                    <JetButton class="bg-gray-300 hover:bg-gray-400 ml-2 mr-2" @click="Back">
                        Back
                    </JetButton>
                    <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </JetButton>
                </div>
            </form>
    </Modal>
    </AppLayout>
</template>