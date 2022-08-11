<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import DescribeFavor from '@/Pages/Favors/Partials/DescribeFavor.vue';
    import ValueFavor from '@/Pages/Favors/Partials/ValueFavor.vue';
    import StepperHeader from '@/Components/StepperHeader.vue';
    import { watch, onUpdated, reactive, ref } from 'vue';
    import { useForm } from '@inertiajs/inertia-vue3';
    import { Inertia } from '@inertiajs/inertia'


    const props = defineProps({
        categories: { type : Object },
        // categorySelected : { type : Object, default : { sub_category : [] } },
        executionTypes : { type : Object },
        executionTypeSelected: { type: Object },
    });

    const state = reactive({ step: 1, favorUrl: '' })
    const stepHeaders = [ "Step 1", "Step 2", "Step 3"];
    let self = this;
 
    const form = useForm({
        title: '',
        description: '',
        subCategory: '',
        qualified_description: '',
        price: '',
        price_description: '',
        stock: '',
        is_unlimited : false,
        image: { type: Object },
        full_name: '',
        email: '',
        location: '',
        executionType: '',
    });


    const next = () => {        
        state.step++
    }
    
    const previous = () => {
      state.step--
    }    

    function submit() {
        
        form
            .transform((data) => ({
                ...data,
                price: parseInt(data.price),
                stock: parseInt(data.stock),
            }))
            .post(route('favors.store'), {
                preserveScroll: true,
                onSuccess: () => {       
                    state.favorUrl = `${window.location.protocol}//${window.location.host}/favor/${route().params.id}`
                    state.step++
                }
            })
    }

</script>

<template>
    <AppLayout title="Create Favor">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Favor
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="bg-white sm:p-6 shadow sm:rounded-md">
                    <div className="divide-y divide-slate-100" >                                                 
                         
                        <div class="text-gray-600">
                            <div class="container flex flex-col flex-wrap px-5 py-4 mx-auto">
                                
                                <StepperHeader :steps="stepHeaders" :currentStep="state.step" />

                                <div class="flex flex-col w-full text-center">
                                    <div class="py-6 bg-white sm:py-8 lg:py-12" v-show="state.step == 1" >
                                        <div class="px-4 mx-auto max-w-screen-2xl md:px-8">
                                        <!-- form - start -->
                                            <div class="max-w-screen-md mx-auto">
                                                <DescribeFavor 
                                                    :form="form"  
                                                    :next="next"
                                                    :categories="categories"
                                                    />
                                                    <!-- :categorySelected="categorySelected"                                                     -->
                                                
                                            </div>
                                        <!-- form - end -->
                                        </div>
                                    </div>

                                    <div class="py-6 bg-white sm:py-8 lg:py-12" v-show="state.step == 2" >
                                        <div class="px-4 mx-auto max-w-screen-2xl md:px-8">
                                        <!-- form - start -->
                                            <div class="max-w-screen-md mx-auto">
                                                <ValueFavor 
                                                    :form="form"
                                                    :executionTypes="executionTypes"  
                                                    :executionTypeSelected="executionTypeSelected"                                                    
                                                    :previous="previous"
                                                    :submitFavor="submit"
                                                    />
                                            </div>                                            
                                        <!-- form - end -->
                                        </div>
                                    </div>

                                    <div class="py-6 bg-white sm:py-8 lg:py-12" v-show="state.step == 3" >
                                        <div class="px-4 mx-auto max-w-screen-2xl md:px-8">
                                        <!-- form - start -->
                                            <span class="text-xl">Spread the Word</span>

                                            <h2>Great news, your favor is live!</h2>
                                            <p>Copy and paste the link below and share this to generate interest in your favor!</p>
                                            <div>{{state.favorUrl}}</div>
                                            
                                            
                                        </div>
                                    </div>

                                </div>
 
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
