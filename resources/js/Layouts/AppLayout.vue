<script setup>
import { ref,onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm, usePage } from '@inertiajs/inertia-vue3';

const el = ref()

onMounted(() => {
    setTimeout(() => verifyloggedIn(), 5000);
    if(usePage().props.value.user){
        console.log("Dark mode: " + usePage().props.value.user.theme);
    }
})

defineProps({
    title: String,
});

const form = useForm({
    _method: 'POST',
    checkedCategories: [],
    email: ''
});

const loggedIn = ref(null);

const verifyloggedIn = () => {
    /** Show register modal if variable client is false */
    if(!localStorage.client){
        loggedIn.value = (usePage().props.value.user == null) ? false : true;
    }
};

const registerClient = () => {
    form.post(route('client.store'),{
        errorBag: 'registerClient',
        preserveScroll: true,
        onSuccess: () => {
            console.log("sucess registration");
            closeModal();
            localStorage.client = true;
        },
    });
};

const closeModal = () => {
    loggedIn.value = true;
    form.reset();
};

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <JetBanner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('public.index')">
                                    <JetApplicationMark class="block h-9 w-auto" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <JetNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </JetNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative flex" v-if="!$page.props.user">
                               <JetDropdownLink :href="route('support.show')">
                                    Customer Support
                                </JetDropdownLink>

                                <JetDropdownLink :href="route('register.create')">
                                    Sign up
                                </JetDropdownLink>

                                <JetDropdownLink :href="route('login')">
                                    Sign in
                                </JetDropdownLink>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <JetDropdown v-if="$page.props.user" align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ $page.props.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <JetDropdownLink :href="route('support.show')">
                                            Customer Support
                                        </JetDropdownLink>

                                        <JetDropdownLink :href="route('profile.show')">
                                            Profile
                                        </JetDropdownLink>

                                        <JetDropdownLink :href="route('categories.index')">
                                            Categories
                                        </JetDropdownLink>

                                        <div class="border-t border-gray-100" />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <JetDropdownLink as="button">
                                                Log Out
                                            </JetDropdownLink>
                                        </form>
                                    </template>
                                </JetDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition" @click="showingNavigationDropdown = ! showingNavigationDropdown">
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <JetResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </JetResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div v-if="$page.props.user" class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">
                                    {{ $page.props.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">
                                    {{ $page.props.user.email }}
                                </div>
                            </div>
                        </div>

                        <div v-if="$page.props.user" class="mt-3 space-y-1">

                            <JetResponsiveNavLink :href="route('support.show')" :active="route().current('profile.show')">
                                Customer Support
                            </JetResponsiveNavLink>

                            <JetResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                                Profile
                            </JetResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <JetResponsiveNavLink as="button">
                                    Log Out
                                </JetResponsiveNavLink>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200" />

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <JetResponsiveNavLink :active="route().current('teams.show')">
                                    Team Settings
                                </JetResponsiveNavLink>

                                <JetResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams">
                                    Create New Team
                                </JetResponsiveNavLink>

                                <div class="border-t border-gray-200" />

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Switch Teams
                                </div>

                                <template>
                                    <form>
                                        <JetResponsiveNavLink as="button">
                                            <div class="flex items-center">
                                                <svg
                                                   
                                                    class="mr-2 h-5 w-5 text-green-400"
                                                    fill="none"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                ><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                <div> team.name 1</div>
                                            </div>
                                        </JetResponsiveNavLink>
                                    </form>
                                    <form>
                                        <JetResponsiveNavLink as="button">
                                            <div class="flex items-center">
                                                <svg
                                                   
                                                    class="mr-2 h-5 w-5 text-green-400"
                                                    fill="none"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                ><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                <div> team.name 2 </div>
                                            </div>
                                        </JetResponsiveNavLink>
                                    </form>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>

        <!-- modal login -->
        <JetDialogModal :show="loggedIn == false">

            <template #title>
                Favorbonds
            </template>

            <template #content>
                <div class="flex pr-4 pl-4">
                    <p class="text-center">
                        <!-- <Link :href="route('login')" :data="{ redirect_to: 'url_parametro' }">xx</Link> <br>  
                        <Link :href="route('login', { redirect_to: 'url_parametro' })">logtest</Link>       <br>            -->
                        <Link :href="route('login')" class="text-sm text-gray-700 underline">Log in</Link>
                         or enter your email to continue viewing FavorBonds and so much more.
                    </p>
                </div>
                <form @submit.prevent="registerClient">
                    <div class="flex items-center justify-end sm:px-6 ">
                        <div class="grid md:grid-cols-2 md:gap-6 mt-6">
                            <div class="relative z-0 w-full mb-4 group">
                                <JetInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    autocomplete="email"
                                    placeholder="Enter your mail"
                                />
                                <JetInputError :message="form.errors.email" class="mt-2" />
                            </div>
                            <div class="relative z-0 w-full mb-8 group mt-2">
                                <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save
                                </JetButton>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <p>
                            By clicking Continue you agree to FavorBond Terms & Conditions and Privacy Policies.
                        </p>
                    </div>
                </form>
            </template>
        </JetDialogModal>
    </div>
</template>
