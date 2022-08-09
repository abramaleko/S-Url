<template>
    <nav
        class="relative z-10 flex flex-wrap items-center justify-between px-6 py-4 bg-white shadow-xl md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden md:w-64">
        <div
            class="flex flex-wrap items-center justify-between w-full px-0 mx-auto md:flex-col md:items-stretch md:min-h-full md:flex-nowrap">
            <!-- Toggler -->
            <button
                class="px-3 py-1 text-xl leading-none text-black bg-transparent border border-transparent border-solid rounded opacity-50 cursor-pointer md:hidden"
                type="button" v-on:click="toggleCollapseShow('bg-white m-2 py-3 px-6')">
                <i class="fas fa-bars"></i>
            </button>
            <!-- Brand -->
            <Link
                class="inline-block p-4 px-0 mr-0 text-sm font-bold text-left uppercase md:block md:pb-2 text-blueGray-600 whitespace-nowrap"
                :href="route('welcome-page')">
            <application-logo />
            </Link>
            <!-- User -->
            <ul class="flex flex-wrap items-center list-none md:hidden">
                <li class="relative inline-block">
                    <notification-dropdown />
                </li>
                <li class="relative inline-block">
                    <user-dropdown />
                </li>
            </ul>
            <!-- Collapse -->
            <div class="absolute top-0 left-0 right-0 z-40 items-center flex-1 h-auto overflow-x-hidden overflow-y-auto rounded shadow md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none"
                v-bind:class="collapseShow">
                <!-- Collapse header -->
                <div class="block pb-4 mb-4 border-b border-solid md:min-w-full md:hidden border-blueGray-200">
                    <div class="flex flex-wrap">
                        <div class="w-6/12">
                            <a class="inline-block p-4 px-0 mr-0 text-sm font-bold text-left uppercase md:block md:pb-2 text-blueGray-600 whitespace-nowrap"
                                href="/">
                                MENU
                            </a>
                        </div>
                        <div class="flex justify-end w-6/12">
                            <button type="button"
                                class="px-3 py-1 text-xl leading-none text-black bg-transparent border border-transparent border-solid rounded opacity-50 cursor-pointer md:hidden"
                                v-on:click="toggleCollapseShow('hidden')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-6 mb-4 md:hidden">
                    <div class="pt-0 mb-3">
                        <input type="text" placeholder="Search"
                            class="w-full h-12 px-3 py-2 text-base font-normal leading-snug bg-white border border-0 border-solid rounded shadow-none outline-none border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 focus:outline-none" />
                    </div>
                </form>

                <!-- Navigation -->

                <ul class="flex flex-col list-none md:flex-col md:min-w-full">
                    <li class="items-center">
                        <Link :href="route('dashboard')" class="block py-3 text-xs font-bold uppercase"
                            :class="{ 'text-emerald-500 hover:text-emerald-600 ': $page.url === '/dashboard' }">
                        <i class="mr-2 text-sm fas fa-tv" :class="{ 'opacity-75 ': $page.url === '/dashboard' }"></i>
                        Dashboard
                        </Link>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Heading -->
                <h6 class="block pt-1 pb-4 text-xs font-bold no-underline uppercase md:min-w-full text-blueGray-500">
                    Short Links
                </h6>
                <!-- Navigation -->

                <ul class="flex flex-col list-none md:flex-col md:min-w-full md:mb-4">
                    <li class="items-center">
                        <Link :href="route('url-create')" class="block py-3 text-xs font-bold uppercase"
                            :class="{ 'text-emerald-500 hover:text-emerald-600 ': $page.url === '/short-url/new' }">
                        <i class="mr-2 text-sm fas fa-clipboard-list "
                            :class="{ 'opacity-75 ': $page.url === '/short-url/new' }"></i>
                        Create Url
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link :href="route('url-all')" class="block py-3 text-xs font-bold uppercase "
                            :class="{ 'text-emerald-500 hover:text-emerald-600 ': $page.url === '/short-url/all' }">
                        <i class="mr-2 text-sm fas fa-fingerprint "
                            :class="{ 'opacity-75 ': $page.url === '/short-url/all' }"></i>
                        View Url's
                        </Link>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Heading -->
                <h6 class="block pt-1 pb-4 text-xs font-bold no-underline uppercase md:min-w-full text-blueGray-500">
                    URL Stastics
                </h6>
                <!-- Navigation -->

                <ul class="flex flex-col list-none md:flex-col md:min-w-full md:mb-4">
                    <li class="items-center">
                        <Link :href="route('stats-list')" class="block py-3 text-xs font-bold uppercase"
                            :class="{ 'text-emerald-500 hover:text-emerald-600 ': $page.url === '/short-url/stats/all' }">
                        <i class="mr-2 text-sm fas fa-newspaper "
                            :class="{ 'opacity-75 ': $page.url === '/short-url/stats/all' }"></i>
                        View Stats
                        </Link>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Heading -->
                <h6 class="block pt-1 pb-4 text-xs font-bold no-underline uppercase md:min-w-full text-blueGray-500">
                    User Profile
                </h6>
                <!-- Navigation -->
                <ul class="flex flex-col list-none md:flex-col md:min-w-full md:mb-4">
                    <li class="inline-flex">
                        <a href="https://www.creative-tim.com/learning-lab/tailwind/vue/colors/notus" target="_blank"
                            class="block mb-4 text-sm font-semibold no-underline text-blueGray-700 hover:text-blueGray-500">
                             <i class="mr-2 text-sm fas fa-user-circle text-blueGray-300"></i>
                            View Profile
                        </a>
                    </li>

                    <li class="inline-flex">
                        <a href="https://www.creative-tim.com/learning-lab/tailwind/vue/alerts/notus" target="_blank"
                            class="block mb-4 text-sm font-semibold no-underline text-blueGray-700 hover:text-blueGray-500">
                            <i class="mr-2 text-sm fa-solid fa-right-to-bracket text-blueGray-300"></i>
                            Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
); }

<script>
import NotificationDropdown from "@/components/Dropdowns/NotificationDropdown.vue";
import UserDropdown from "@/components/Dropdowns/UserDropdown.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    data() {
        return {
            collapseShow: "hidden",
        };
    },
    methods: {
        toggleCollapseShow: function (classes) {
            this.collapseShow = classes;
        },
    },
    components: {
        NotificationDropdown,
        UserDropdown,
        ApplicationLogo,
        Link,

    },
};
</script>
<style scoped>
.link-active {
    opacity: 0.75;
    --tw-text-opacity: 1;
    color: rgb(203 213 225 / var(--tw-text-opacity));
}
</style>
