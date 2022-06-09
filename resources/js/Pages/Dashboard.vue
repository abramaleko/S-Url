<script>
import AuthLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import HeaderStats from '@/Components/HeaderStats.vue';

import CardLineChart from "@/Components/Cards/CardLineChart.vue";
import CardBarChart from "@/Components/Cards/CardBarChart.vue";
import CardPageVisits from "@/Components/Cards/CardPageVisits.vue";
import CardSocialTraffic from "@/Components/Cards/CardSocialTraffic.vue";
export default {
  name: "dashboard-page",
  components: {
    Head,
    AuthLayout,
    HeaderStats,
    CardLineChart,
    CardBarChart,
    CardPageVisits,
    CardSocialTraffic,
  },
};
</script>

<template>
    <Head title="Dashboard" />
    <AuthLayout>
        <HeaderStats/>

    <div class="w-full px-4 mx-auto -m-24 md:px-10">
    <div>
    <div class="flex flex-wrap">
      <div class="w-full px-4 mb-12 xl:w-8/12 xl:mb-0">
        <card-line-chart />
      </div>
      <div class="w-full px-4 xl:w-4/12">
        <card-bar-chart />
      </div>
    </div>
    <div class="flex flex-wrap mt-4">
      <div class="w-full px-4 mb-12 xl:w-8/12 xl:mb-0">
        <card-page-visits />
      </div>
      <div class="w-full px-4 xl:w-4/12">
        <card-social-traffic />
      </div>
    </div>
  </div>
  </div>
    </AuthLayout>
</template>
