<script setup>
    defineProps({
        executionTypes: { type : Object },    
        executionTypeSelected: { type: Object },
        form : Object,
        next: Function,
        previous: Function
    })
</script>

<template>
    
    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="qualified_description" value="Why are you qualified to offer this favor?" />
        <JetInput
            id="qualified_description"
            v-model="form.qualified_description"
            type="text"
            class="mt-1 block w-full"
            autofocus
            autocomplete="qualified_description"
        />
    </div>

    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="price" value="How many FavorBonds should this favor cost? For an estimate, use $100 equal 1 FavorBond, but providing a discount off this attract interest" />
        <JetInput
            id="price"
            v-model="form.price"
            type="number"
            class="mt-1 block w-full"
            autofocus
            autocomplete="price"
        />
    </div>

    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="price_description" value="How did you calculate the value of this favor" />
        <JetInput
            id="price_description"
            v-model="form.price_description"
            type="number"
            class="mt-1 block w-full"
            autofocus
            autocomplete="price_description"
        />
    </div>

    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="conduced" value="How will the favor be conducted (phone, virtual call, FaceTime, in-person)?" />
        <select name="executionTypes" id="executionTypes" v-model="categorySelected"
            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            <option :value="executionType" v-for="executionType in executionTypes" :key="executionType.id">{{executionType.name}}</option>
        </select>
    </div>

    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="stock" value="How many of the favor are you offering?" />
        <JetInput
            id="stock"
            v-model="form.stock"
            type="number"
            class="mt-1 block w-full"
            autofocus
            autocomplete="stock"
        />
    </div>

    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="image" value="Do you want to post an image for the favor? *optional" />
        <JetInput
            id="image"
            @input="form.image = $event.target.files[0]"
            type="file"
            class="mt-1 block w-full"
            autofocus
            autocomplete="image"
        />
    </div>

    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="stock" value="Confirm Your Full Name" />
        <JetInput
            id="fullname"
            v-model="form.fullname"
            type="text"
            class="mt-1 block w-full"
            autofocus
            autocomplete="fullname"
        />
    </div>

    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="email" value="Confirm Your Email" />
        <JetInput
            id="email"
            v-model="form.email"
            type="text"
            class="mt-1 block w-full"
            autofocus
            autocomplete="email"
        />
    </div>

    <div class="flex flex-col mb-4">
        <JetLabel class="inline-flex" for="location" value="Confirm Your Location (City, State, Country)" />
        <JetInput
            id="location"
            v-model="form.location"
            type="text"
            class="mt-1 block w-full"
            autofocus
            autocomplete="location"
        />
    </div>

    <div class="flex items-center justify-between">
        <button
            @click="previous"
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