<script setup>

    import StepperStep from '@/Components/StepperStep.vue';
    import { watch } from '@vue/runtime-core';

    const props = defineProps({
        currentStep : Number,
        steps: Array
    })

</script>


<template>
    <div class="flex flex-wrap mx-auto">
        <StepperStep v-for="(step, index ) in steps" :key="index" :step="step" :complete=" currentStep > index " />
    </div>
</template>