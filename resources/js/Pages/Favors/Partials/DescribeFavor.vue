<script setup>
    defineProps({
        categories: { type : Object },
        categorySelected : { type : Object, default : { sub_category : [] } },
        form : Object,
        next: Function
    })
</script>

<template>
    
    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="title" value="How would you title the favor (under 7 words)?" />
        <JetInput
            id="title"
            v-model="form.title"
            type="text"
            class="mt-1 block w-full"
            autofocus
            autocomplete="title"
        />
    </div>

    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="title" value="What category does this best fit in?" />
        <select name="categories" id="categories" v-model="categorySelected"
            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            <option :value="category" v-for="category in categories" :key="category.id">{{category.name}}</option>
        </select>
    </div>

    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="title" value="Which sub-category does this best fit in?" />
        <select name="subCategories" id="subCategories" v-model="form.subCategory"
            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            <option :value="subCategory.id" v-for="subCategory in categorySelected.sub_category" :key="subCategory.id">{{subCategory.name}}</option>
        </select>
    </div>
    
    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="description" value="What is your description of the Favor, the value of it, how you will deliver it, and any other details?" />
        <JetInput
            id="description"
            v-model="form.description"
            type="text"
            class="mt-1 block w-full"
            autofocus
            autocomplete="description"
        />
    </div>

    <div class="flex items-center justify-between">
        <button
            class="
            inline-flex
            items-center
            px-6
            py-2
            text-sm text-gray-800
            rounded-lg
            shadow
            outline-none
            gap-x-1
            hover:bg-gray-100
            "
        >
            <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-4 h-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 19l-7-7m0 0l7-7m-7 7h18"
            /></svg>Back
        </button>
        <button
            @click="next"
            class="
            px-6
            py-2
            text-sm text-white
            bg-indigo-500
            rounded-lg
            outline-none
            hover:bg-indigo-600
            ring-indigo-300
            "
        >
            Next
        </button>
    </div>

</template>