<script setup>

    const props = defineProps({        
        step: String,
        complete: Boolean
    })

</script>

<template>
    <a
        class="
        inline-flex
        items-center
        justify-center
        w-1/2
        py-3
        font-medium
        leading-none
        tracking-wider
        border-b-2 
        sm:px-6 sm:w-auto sm:justify-start
        title-font        
        " 
        :class="{ 
            'border-gray-200' : !complete,
            'hover:text-gray-900' : !complete,
            'text-indigo-500' : complete,
            'bg-gray-100' : complete,
            'border-indigo-500' : complete,
            'rounded-t' : complete,
            }"
        > {{step}}
    </a>
    
</template>