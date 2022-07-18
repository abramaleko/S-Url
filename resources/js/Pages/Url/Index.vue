
<template>
    <AuthenticatedLayout>

        <Head title="New Url" />
        <div class="max-w-5xl p-4 mx-4 mt-6 rounded-md shadow-md lg:mx-auto bg-blueGray-50 lg:p-8 lg:mt-24 ">
            <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                    :style="{ width: width + '%' }" style="transition: width 2s;"> {{ width }}%</div>
            </div>

            <div id="step-1" v-if="step == 1">
                <h1 class="mt-8 text-base lg:text-xl text-semibold">Choose what type of Short Url will you be using</h1>
                <div class="flex items-center my-4">
                    <input id="url-1" type="radio" value="1" v-model="form.url_type"
                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="url-1"
                        class="block ml-2 text-sm font-medium text-gray-900 lg:text-lg dark:text-gray-300">
                        Random Url
                        <button data-tooltip-placement="right" data-tooltip-target="tooltip-light"
                            data-tooltip-style="light" type="button">
                            <i class="ml-2 text-sm text-green-500 fa-solid fa-circle-exclamation"></i>
                        </button>
                    </label>

                    <div id="tooltip-light" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Random url's have random url names also do not have statistical data
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>


                </div>

                <div class="flex items-center mb-4">
                    <input id="url-2" type="radio" value="2" v-model="form.url_type"
                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="url-2"
                        class="block ml-2 text-sm font-medium text-gray-900 lg:text-lg dark:text-gray-300">
                        Personalized Url
                        <button data-tooltip-placement="right" data-tooltip-target="tooltip-2"
                            data-tooltip-style="light" type="button">
                            <i class="ml-2 text-sm text-green-500 fa-solid fa-circle-exclamation"></i>
                        </button>
                    </label>
                    <div id="tooltip-2" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Personalized url do have custom url names also do have statistical data .
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>

                <div class="flex flex-wrap mt-12">
                    <Link :href="route('url-all')" as="button"
                        class="px-6 py-2 tracking-wide text-gray-800 bg-gray-300 rounded-md hover:bg-gray-400 hover:text-white">
                    CANCEL
                    </Link>

                    <button @click="incrementStep" type="button" :disabled="!form.url_type"
                        class="px-6 py-2 ml-4 tracking-wide text-white bg-blue-500 rounded-md hover:bg-blue-400"
                        :class="{ 'opacity-25': !form.url_type }">
                        NEXT
                    </button>

                </div>
            </div>

            <div v-if="step == 2 && form.url_type == '1'">
                <div class="flex-auto py-10 ">
                    <form @submit.prevent="submit">
                        <h6 class="mt-3 mb-6 text-sm font-bold uppercase text-blueGray-400">
                            Random Url Info
                        </h6>
                        <div class="w-full px-4 mb-6 lg:w-12/12">
                            <div class="relative w-full">
                                <label class="block mb-2 text-xs font-bold uppercase text-blueGray-600"
                                    htmlFor="short-url">
                                    Short Url
                                </label>
                                <div class="relative flex flex-wrap items-stretch w-full mb-4">
                                    <div class="flex -mr-px bg-blueGray-200">
                                        <span
                                            class="flex items-center px-3 text-sm leading-normal whitespace-no-wrap border border-r-0 rounded rounded-r-none bg-grey-lighter border-grey-light text-grey-dark">{{ app_url }}visit/</span>
                                    </div>
                                    <input type="text" v-model="form.short_url" @blur="checkUrlAvailabilty"
                                        id="short-url" disabled
                                        class="relative flex-auto flex-grow flex-shrink w-px h-10 px-3 text-sm leading-normal border-0 rounded rounded-r shadow placeholder-blueGray-300 text-blueGray-600 focus:outline-none focus:ring" />
                                    <button @click="generateUrl" type="button"
                                        class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        GENERATE URL
                                    </button>
                                </div>
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
                                    :class="{ ['border-2 border-red-500']: errors.redirect_to }" />
                            </div>
                            <p class="text-sm font-bold text-red-500" v-if="errors.redirect_to">{{ errors.redirect_to }}
                            </p>
                            <p class="pt-1 text-xs font-semibold text-gray-500" v-if="errors.redirect_to">
                                Make sure your redirect url starts with http::// or https://
                            </p>
                        </div>
                        <div class="w-full px-4 mb-6 lg:w-12/12">
                            <div class="relative w-full">
                                <label class="block mb-2 text-xs font-bold uppercase text-blueGray-600"
                                    htmlFor="custom-input-number">
                                    Expires after : (months)
                                </label>
                                <div class="relative flex flex-row w-32 h-10 mt-1 rounded-lg bg- custom-number-input">
                                    <button type="button" id="decrement" @click="decrement"
                                        class="w-20 h-full text-gray-600 bg-white rounded-l cursor-pointer focus:outline-none hover:text-white hover:bg-blue-400">
                                        <span class="m-auto text-2xl font-thin">−</span>
                                    </button>
                                    <input type="number" v-model="form.number"
                                        class="flex items-center w-full font-semibold text-center text-gray-700 bg-gray-100 border-none outline-none focus:outline-none text-md hover:text-black focus:text-black md:text-basecursor-default"
                                        min="1" />
                                    <button type="button" @click="increment"
                                        class="w-20 h-full text-gray-600 bg-white rounded-r cursor-pointer hover:text-white hover:bg-blue-400">
                                        <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap mt-12">
                            <button @click="decrementStep" type="button"
                                class="px-6 py-2 tracking-wide text-gray-800 bg-gray-300 rounded-md hover:bg-gray-400 hover:text-white">
                                Previous
                            </button>

                            <button type="submit" :disabled="form.processing || trialMax"
                                class="px-6 py-2 ml-4 tracking-wide text-white bg-blue-500 rounded-md hover:bg-blue-400"
                                :class="{ 'opacity-25': form.processing, 'cursor-not-allowed': trialMax }">
                                CREARTE URL
                            </button>

                        </div>

                    </form>
                </div>
            </div>

            <div v-if="step == 2 && form.url_type == '2'">
                <div class="flex-auto py-10 ">
                    <p class="font-bold text-red-500" v-if="trialMax">
                        You have already created 3 url's which is a maximum for the free subscription please upgrade
                        your package
                        <a href="#" class="underline">here</a>
                    </p>
                    <form @submit.prevent="submit">
                        <h6 class="mt-3 mb-6 text-sm font-bold uppercase text-blueGray-400">
                            Personalized Url Info
                        </h6>
                        <div class="w-full px-4 mb-6 lg:w-12/12">
                            <div class="relative w-full">
                                <label class="block mb-2 text-xs font-bold uppercase text-blueGray-600"
                                    htmlFor="short-url">
                                    Short Url
                                </label>
                                <div class="relative flex flex-wrap items-stretch w-full mb-4">
                                    <div class="flex -mr-px bg-blueGray-200">
                                        <span
                                            class="flex items-center px-3 text-sm leading-normal whitespace-no-wrap border border-r-0 rounded rounded-r-none bg-grey-lighter border-grey-light text-grey-dark">{{ app_url }}visit/</span>
                                    </div>
                                    <input type="text" v-model="form.short_url" @blur="checkUrlAvailabilty"
                                        id="short-url"
                                        class="relative flex-auto flex-grow flex-shrink w-px h-10 px-3 text-sm leading-normal border-0 rounded rounded-r shadow placeholder-blueGray-300 text-blueGray-600 focus:outline-none focus:ring"
                                        :class="{ ['border-2  border-red-500 focus:border-red-500']: alreadyTaken, ['border-2 border-red-500']: errors.short_url }">
                                </div>
                                <span v-if="alreadyTaken" class="block text-sm font-bold text-red-500">This url has
                                    already
                                    been choosen</span>
                                <p class="text-sm font-bold text-red-500" v-if="errors.short_url">{{ errors.short_url }}
                                </p>
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
                                    :class="{ ['border-2 border-red-500']: errors.redirect_to }" />
                            </div>
                            <p class="text-sm font-bold text-red-500" v-if="errors.redirect_to">{{ errors.redirect_to }}
                            </p>
                            <p class="pt-1 text-xs font-semibold text-gray-500" v-if="errors.redirect_to">
                                Make sure your redirect url starts with http::// or https://
                            </p>
                        </div>
                        <div class="w-full px-4 mb-6 lg:w-12/12">
                            <div class="relative w-full">
                                <label class="block mb-2 text-xs font-bold uppercase text-blueGray-600"
                                    htmlFor="custom-input-number">
                                    Expires after : (months)
                                </label>
                                <div class="relative flex flex-row w-32 h-10 mt-1 rounded-lg bg- custom-number-input">
                                    <button type="button" id="decrement" @click="decrement"
                                        class="w-20 h-full text-gray-600 bg-white rounded-l cursor-pointer focus:outline-none hover:text-white hover:bg-blue-400">
                                        <span class="m-auto text-2xl font-thin">−</span>
                                    </button>
                                    <input type="number" v-model="form.number"
                                        class="flex items-center w-full font-semibold text-center text-gray-700 bg-gray-100 border-none outline-none focus:outline-none text-md hover:text-black focus:text-black md:text-basecursor-default"
                                        min="1" />
                                    <button type="button" @click="increment"
                                        class="w-20 h-full text-gray-600 bg-white rounded-r cursor-pointer hover:text-white hover:bg-blue-400">
                                        <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                            </div>
                            <p class="py-2 text-xs font-bold text-red-500" v-show="premiumAlertForExipiry">Please
                                upgrade to premium version to set expiry to above 3 months</p>
                        </div>

                        <div class="flex flex-wrap mt-12">
                            <button @click="decrementStep" type="button"
                                class="px-6 py-2 tracking-wide text-gray-800 bg-gray-300 rounded-md hover:bg-gray-400 hover:text-white">
                                Previous
                            </button>

                            <button type="submit" :disabled="form.processing || trialMax"
                                class="px-6 py-2 ml-4 tracking-wide text-white bg-blue-500 rounded-md hover:bg-blue-400"
                                :class="{ 'opacity-25': form.processing, 'cursor-not-allowed': trialMax }">
                                CREARTE URL
                            </button>

                        </div>

                    </form>
                </div>
            </div>

        </div>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
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
    setup() {
        const form = useForm({
            short_url: null,
            redirect_to: null,
            months: null,
            url_type: null,
        })
        return { form }
    },
    props: {
        errors: Object,
        app_url: String,
        trialMax: Boolean,
        random_url: String
    },
    data() {
        return {
            alreadyTaken: false,
            step: 1,
            width: 0,
            url_length: 5,
            random_clicks: 0,
            premiumAlertForExipiry: false

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


            if (!this.form.short_url || !this.form.redirect_to || this.form.months == 0) {
                alert("Please fill all inputs before submitting");
                return false;
            }

            if (this.form.months > 3) {
                this.premiumAlertForExipiry = true;
                return false;
            }

            this.form.post(route('url-save'));

        },

        decrement(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[id="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            value--;
            target.value = value < 0 ? 1 : value;
            this.form.months = value < 0 ? 1 : value;
        },
        increment(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[id="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            value++;
            target.value = value;
            this.form.months = value < 0 ? 1 : value;
        },
        incrementStep() {
            this.step++;
            this.width = this.width + 50;
        },
        decrementStep() {
            this.step--;
            this.width = this.width - 50;
        },
        generateUrl() {
            //register the random clicks
            this.random_clicks++;

            if (this.random_clicks > 3) {
                //after 3 clicks increment the url length
                this.url_length++;
            }

            axios.get(route('random-url-generate', this.url_length))
                .then(response => {
                    this.form.short_url = response.data
                })
        }

    }
}

const decrementButtons = document.querySelectorAll(
    `button[data-action="decrement"]`
);

const incrementButtons = document.querySelectorAll(
    `button[data-action="increment"]`
);

decrementButtons.forEach(btn => {
    btn.addEventListener("click", decrement);
});

incrementButtons.forEach(btn => {
    btn.addEventListener("click", increment);
});
</script>

<style scoped>
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.custom-number-input input:focus {
    outline: none !important;
}

.custom-number-input button:focus {
    outline: none !important;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
</style>>


