<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetSectionTitle from '@/Jetstream/SectionTitle.vue';

const el = ref()

onMounted(() => {
  form.theme = props.user.theme;
})

const props = defineProps({
    user: Object,
});

const form = useForm({
    theme: '',
});

const updateTheme = () => {
    form.post(route('user-theme.update'), {
        errorBag: 'themeUpdate',
        preserveScroll: true,
        onFinish: () => {
            // console.log("onFinish");
        },
        onSuccess: () => {
            // console.log("onSuccess");
        },
        onError: () => {},
    });
};
</script>

<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <JetSectionTitle>
            <template #title>
                Dark mode
            </template>
            <template #description>
                Change the theme of your application for greater comfort.
            </template>
        </JetSectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <form @submit.prevent="updateTheme">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                    <!-- :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'" -->
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <label for="default-toggle" class="inline-flex relative items-center cursor-pointer">
                                <input type="checkbox" id="default-toggle" v-model="form.theme" class="sr-only peer" @change="updateTheme" :checked="form.theme == 1">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>
                            <JetInputError :message="form.errors.theme" class="mt-2" />
                        </div>
                        <div class="col-span-12 sm:col-span-4 text-right"></div>
                        <div class="col-span-6 sm:col-span-4 text-right">
                            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                                Saved.
                            </JetActionMessage>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
