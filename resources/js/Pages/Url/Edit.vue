
<template>
    <AuthenticatedLayout>

        <Head title="Edit Url" />

        <div class="mx-2 lg:mx-12 bg-blueGray-100">
            <div class="mt-6 mb-6 break-words bg-white border-0 rounded-lg shadow-lg lg:mt-20">
                <div class="px-6 py-6 mb-0 bg-white rounded-t">
                     <h6 class="text-xl font-bold text-blueGray-700">Edit Url</h6>
                </div>
            </div>
            <div class="flex-auto px-4 py-10 pt-0 lg:px-10">

            <success-alert v-if="$page.props.flash.message" :message="$page.props.flash.message" />
                <form @submit.prevent="submit">
                    <h6 class="mt-3 mb-6 text-sm font-bold uppercase text-blueGray-400">
                        Url Info
                    </h6>
                    <div class="w-full px-4 mb-6 lg:w-12/12">
                        <div class="relative w-full">
                            <label class="block mb-2 text-xs font-bold uppercase text-blueGray-600" htmlFor="short-url">
                                Short Url
                            </label>
                            <div class="relative flex flex-wrap items-stretch w-full mb-4">
                                <div class="flex -mr-px bg-blueGray-200">
                                    <span
                                        class="flex items-center px-3 text-sm leading-normal whitespace-no-wrap border border-r-0 rounded rounded-r-none bg-grey-lighter border-grey-light text-grey-dark">{{app_url}}url/</span>
                                </div>
                                <input type="text" v-model="form.short_url" @blur="checkUrlAvailabilty" id="short-url"
                                    class="relative flex-auto flex-grow flex-shrink w-px h-10 px-3 text-sm leading-normal border-0 rounded rounded-r shadow placeholder-blueGray-300 text-blueGray-600 focus:outline-none focus:ring"
                                    :class="{ ['border-2  border-red-500 focus:border-red-500']: alreadyTaken, ['border-2 border-red-500'] : errors.short_url }">
                            </div>
                            <span v-if="alreadyTaken" class="block text-sm font-bold text-red-500">This url has already
                                been choosen</span>
                           <p class="text-sm font-bold text-red-500" v-if="errors.short_url">{{ errors.short_url }}</p>
                        </div>
                    </div>

                    <div class="w-full px-4 mb-6 lg:w-12/12">
                        <div class="relative w-full">
                            <label class="block mb-2 text-xs font-bold uppercase text-blueGray-600"
                                htmlFor="grid-password">
                                Redirected url
                            </label>
                            <input type="text" v-model="form.redirect_to"
                                class="w-full px-3 py-3 text-sm transition-all duration-150 ease-linear bg-white border-0 rounded shadow placeholder-blueGray-300 text-blueGray-600 focus:outline-none focus:ring"
                                :class="{['border-2 border-red-500'] : errors.redirect_to}" />
                        </div>
                         <p class="text-sm font-bold text-red-500" v-if="errors.redirect_to">{{ errors.redirect_to }}</p>
                         <p class="pt-1 text-xs font-semibold text-gray-500" v-if="errors.redirect_to">
                            Make sure your redirect url starts with http::// or https://
                         </p>
                    </div>

                    <div class="w-full px-4 mb-6 lg:w-12/12">
                         <Link :href="route('url-details',url.id)" as="button"
                            class="px-4 py-3 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear rounded shadow outline-none bg-blueGray-500 hover:shadow-md focus:outline-none hover:bg-blueGray-400"
                            >
                            CANCEL
                        </Link>

                        <button type="submit" :disabled="form.processing"
                            class="px-4 py-3 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear bg-green-500 rounded shadow outline-none active:bg-emerald-600 hover:shadow-md focus:outline-none hover:bg-green-400"
                            :class="{ 'opacity-25' : form.processing}">
                            Update URL
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link , useForm  } from '@inertiajs/inertia-vue3';
import SuccessAlert from '@/Components/SuccessAlert.vue';
import axios from 'axios';

export default {
    name: "register-url",
    components: {
        AuthenticatedLayout,
        Link,
        Head,
        SuccessAlert,
    },
    setup(props) {
        const form = useForm({
            short_url: props.url.short_url,
            redirect_to: props.url.redirect_to,
        })
        return { form }
    },
    props: {
        errors: Object,
        app_url : String,
        url: Object,
    },
    data() {
        return {
            alreadyTaken: false,
        }
    },
    methods: {
        //check if the url has not been taken
        checkUrlAvailabilty() {
            axios
                .post(route('url-check-availabilty'), {
                     url: this.form.short_url,
                      })
                .then(response => {
                    if (response.data) {
                        //set the url to be already taken
                        this.alreadyTaken = response.data;
                    }
                })
                .catch(error => {
                    console.log(error)
                })

        },
        submit() {

            if (!this.form.short_url || !this.form.redirect_to) {
                alert("Please fill all inputs before submitting");
                return false;
            }

            this.form.post(route('update-url',this.url.id));
        }
    }

}
</script>

