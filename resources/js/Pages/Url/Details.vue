<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import CardStats from '@/Components/Cards/CardStats.vue'
import SuccessAlert from '@/Components/SuccessAlert.vue';
export default {
    components: {
        AuthenticatedLayout, Head, Link, CardStats, SuccessAlert
    },
    props: {
        url: Object,
        app_url : String,
    },
    methods: {
        updateStatus() {
            this.$inertia.visit(route('update-status'), {
                method: 'POST',
                data: { status: !this.url.status, id: this.url.id },
            })

        }
    }
}

</script>

<template>
    <AuthenticatedLayout>

        <Head title="Url Details" />
        <div class="grid lg:mt-20 place-items-center">
            <div class="w-11/12 px-4 py-2 rounded-md md:shadow-md md:p-8">
                <div v-if="$page.props.flash.message" class="alert">
                    <success-alert :message="$page.props.flash.message" />
                </div>
                <div class="flex flex-wrap">
                    <Link as="button" :href="route('edit-url', url.id)" class="mr-2 text-xs hover:text-blue-500">
                    <i class="fa-solid fa-pen"></i>
                    </Link>
                    <h2 class="text-2xl font-semibold text-gray-600 ">
                        Url Details
                    </h2>
                </div>
                <div class="my-4 text-gray-500 border-b-2"></div>

                <p class="my-3 text-base text-gray-600 md:text-lg"><b>Short Url :</b> {{ url.url_key }}
                    <a :href="url.default_short_url" target="_blank">
                        <i class="text-sm text-blue-500 fas fa-external-link"></i>
                    </a>
                </p>

                <p class="mb-3 text-base text-gray-600 md:text-lg"><b>Redirect To :</b> {{ url.destination_url }}
                    <a :href="url.destination_url" target="_blank" class="pl-1">
                        <i class="text-sm text-blue-500 fas fa-external-link"></i>
                    </a>
                </p>
               <p class="mb-3 text-base text-gray-600 md:text-lg"><b>Url Type :</b> {{ url.url_type === 1 ? 'Random Url' : 'Personalized Url' }}</p>
                <p class="mb-3 text-base text-gray-600 md:text-lg"><b>Exipires On :</b> {{ url.deactivated_at }}</p>
                <!-- <div class="flex mb-4 flex-nowrap">
                    <div>
                        <p class="text-base font-bold text-gray-600 md:text-lg">Status :</p>
                    </div>
                    <div class="ml-2">
                        <label for="green-toggle" class="relative inline-flex items-center mr-5 cursor-pointer">
                            <input type="checkbox" value="" id="green-toggle" class="sr-only peer" :checked="url.status"
                                @click="updateStatus">
                            <div
                                class="md:w-11 md:h-6 w-8 h-5 bg-gray-200 rounded-full peer dark:bg-gray-700  peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                            </div>
                            <span class="ml-3 text-base text-gray-600 md:text-lg dark:text-gray-300"
                                v-text="url.status ? 'Active' : 'Disabled'">
                            </span>
                        </label>

                    </div>
                </div> -->

                <div class="mt-8 mb-4 text-gray-400 border-b-2"></div>

                <!-- url stats-->
                <div class="flex flex-wrap p-4 mt-4 rounded-md md:shadow-md md:p-12">
                    <div class="w-full px-4 lg:w-5/12 xl:w-3/12">
                        <card-stats></card-stats>
                    </div>
                    <div class="w-full px-4 lg:w-6/12 xl:w-3/12">
                        <card-stats></card-stats>
                    </div>
                    <div class="w-full px-4 lg:w-6/12 xl:w-3/12">
                        <card-stats></card-stats>
                    </div>
                    <div class="w-full px-4 lg:w-6/12 xl:w-3/12">
                        <card-stats></card-stats>
                    </div>
                </div>


            </div>



        </div>




    </AuthenticatedLayout>

</template>
