<script>
 import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
 import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
  components: {
      AuthenticatedLayout,Head,Link,
  },
  props:{
      urls: Object,
  },
  methods:{
      deleteUrl(id){
         if (confirm('Are you sure you want to delete this record')) {
            Inertia.delete(route('url-delete',id));
         }
      },
     counter(index=0)
    {
      return index + 1 ;
    }

  }

}

</script>

<template>
  <AuthenticatedLayout>
      <Head title="All Url's"/>
        <!-- component -->
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">


<section class="py-1 bg-blueGray-50">
<div class="w-full px-4 mx-auto mt-10 mb-12 lg:mt-20 xl:mb-0">
  <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg ">
    <div class="px-4 py-3 mb-0 border-0 rounded-t">
      <div class="flex flex-wrap items-center py-2">
        <div class="relative flex-1 flex-grow w-full max-w-full px-4">
          <h3 class="text-base font-semibold text-blueGray-700">Page Visits</h3>
        </div>
        <!-- <div class="relative flex-1 flex-grow w-full max-w-full px-4 text-right">
          <button class="px-3 py-3 mb-1 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear bg-indigo-500 rounded outline-none active:bg-indigo-600 focus:outline-none" type="button">See all</button>
        </div> -->
      </div>
    </div>

    <div class="block w-full overflow-x-auto">
      <table class="items-center w-full overflow-x-auto bg-transparent border-collapse ">
        <thead>
          <tr>
            <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                          S/N
            </th>
            <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                    Short-Url
             </th>
          <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                         Expires On
             </th>
          <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">

          </th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="(url,index) in urls" :key="url.id" class="hover:bg-gray-50">
            <th class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700 ">
               {{counter(index)}}
            </th>
            <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap ">
             {{url.url_key}}
            </td>
            <td class="p-4 px-6 text-xs border-t-0 border-l-0 border-r-0 align-center whitespace-nowrap">
              {{url.deactivated_at}}
            </td>
            <td class="flex p-4 text-sm">
               <Link :href="route('url-details',url.id)" as="button" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-400 hover:underline">
                 View
               </Link>

               <button type="button" @click="deleteUrl(url.id)" class="px-4 py-2 ml-4 text-white bg-red-500 rounded hover:underline hover:bg-red-400">
                 Delete
               </button>

            </td>
          </tr>
        </tbody>

      </table>
    </div>
  </div>
</div>
</section>
  </AuthenticatedLayout>
</template>
