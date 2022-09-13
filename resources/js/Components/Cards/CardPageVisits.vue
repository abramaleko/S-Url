<script setup>
   defineProps({
    refer_urls: Object,
   });
</script>
<template>
  <div
    class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg"
  >
    <div class="px-4 py-3 mb-0 border-0 rounded-t">
      <div class="flex flex-wrap items-center">
        <div class="relative flex-1 flex-grow w-full max-w-full px-4">
          <h3 class="text-base font-semibold text-blueGray-700">
            Refer Urls
          </h3>
        </div>

      </div>
    </div>
    <div class="block w-full overflow-x-auto">
      <!-- Projects table -->
      <table class="items-center w-full bg-transparent border-collapse">
        <thead>
          <tr>
            <th
              class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap"
            >
              Url
            </th>
            <th
              class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap"
            >
              Visitor Count
            </th>

          </tr>
        </thead>
        <tbody>
            <tr v-for="refer_url in refer_urls ">
            <th
              class="p-4 px-6 text-xs text-left text-blue-500 align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap hover:underline"
            >
             <a :href="refer_url['referer_url'] ? refer_url['referer_url'] : '#'" target="_blank">
                {{refer_url['referer_url'] ? refer_url['referer_url'] : 'Unknown Url' }}
             </a>
            </th>
            <td
              class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap"
            >
            {{refer_url['total']}}

            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
