
<template>
    <AuthenticatedLayout>

        <Head title="New Url" />

        <div class="mx-2 lg:mx-12 bg-blueGray-100">
            <div class="mt-6 mb-6 break-words bg-white border-0 rounded-lg shadow-lg lg:mt-20">
                <div class="px-6 py-6 mb-0 bg-white rounded-t">
                    <div class="flex justify-between text-center">
                        <h6 class="text-xl font-bold text-blueGray-700">New Url</h6>
                        <Link :href="route('url-all')"
                            class="px-4 py-3 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear rounded shadow outline-none bg-emerald-500 active:bg-emerald-600 hover:shadow-md focus:outline-none hover:bg-emerald-400">
                            View Url's
                        </Link>
                    </div>
                </div>
            </div>
            <div class="flex-auto px-4 py-10 pt-0 lg:px-10">
                <p class="font-bold text-red-500" v-if="trialMax">
                    You have already created 3 url's which is a maximum for the free subscription please upgrade your package
                    <a href="#" class="underline">here</a>
                </p>
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
                        <div class="relative w-full">
                             <label class="block mb-2 text-xs font-bold uppercase text-blueGray-600"
                                htmlFor="custom-input-number">
                                    Expires after : (months)
                                </label>
                                  <div class="relative flex flex-row w-32 h-10 mt-1 rounded-lg bg- custom-number-input">
                                    <button type="button" id="decrement" @click="decrement" class="w-20 h-full text-gray-600 bg-white rounded-l cursor-pointer focus:outline-none hover:text-white hover:bg-blue-400">
                                    <span class="m-auto text-2xl font-thin">−</span>
                                    </button>
                                    <input type="number" v-model="form.number"  class="flex items-center w-full font-semibold text-center text-gray-700 bg-gray-100 border-none outline-none focus:outline-none text-md hover:text-black focus:text-black md:text-basecursor-default"  min="1" />
                                <button type="button" @click="increment" class="w-20 h-full text-gray-600 bg-white rounded-r cursor-pointer hover:text-white hover:bg-blue-400">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                </button>
                                </div>
                        </div>
                    </div>

                    <div class="w-full px-4 my-6 lg:w-12/12">
                        <button type="submit" :disabled="form.processing || trialMax"
                            class="px-4 py-3 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear bg-blue-500 rounded shadow outline-none active:bg-emerald-600 hover:shadow-md focus:outline-none hover:bg-blue-400"
                            :class="{ 'opacity-25' : form.processing, 'cursor-not-allowed' : trialMax} ">
                            CREARTE URL
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
    setup() {
        const form = useForm({
            short_url: null,
            redirect_to: null,
            months: null,
        })
        return { form }
    },
    props: {
        errors: Object,
        app_url : String,
        trialMax : Boolean,
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


            if (!this.form.short_url || !this.form.redirect_to || this.form.months == 0) {
                alert("Please fill all inputs before submitting");
                return false;
            }

            if (this.form.months > 3) {
              alert("Please upgrade to the premium version");
              return false;
            }

            this.form.post(route('url-save'),{
                        onFinish: () => this.form.reset(),
            });

        },

        decrement(e) {
        const btn = e.target.parentNode.parentElement.querySelector(
        'button[id="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        value--;
        target.value = value < 0 ? 1 : value;
        this.form.months=value < 0 ? 1 : value;
       },
      increment(e) {
        const btn = e.target.parentNode.parentElement.querySelector(
        'button[id="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        value++;
        target.value = value;
        this.form.months=value < 0 ? 1 : value;
      },

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


