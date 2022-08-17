<template>
  <!-- Header -->
  <div class="relative pt-12 pb-32 bg-emerald-600 md:pt-32">
    <div class="w-full px-4 mx-auto md:px-10">
      <div>
        <!-- Card stats -->
        <div class="flex flex-wrap">
          <div class="w-full px-4 lg:w-2/6">
            <card-stats
              statSubtitle="Url Clicks"
              :statTitle="total_visits"
              :statDescripiron="'Average of ' + average_clicks + ' clicks per day' "
              statIconName="fa-solid fa-computer-mouse"
              statIconColor="bg-teal-500"
            />
          </div>
          <div class="w-full px-4 lg:w-2/6">
            <card-stats
              statSubtitle="Devices"
              :statTitle="most_used"
              statDescripiron="Most have used this device to view your link"
              statIconName="fas fa-chart-pie"
              statIconColor="bg-orange-500"
            />
          </div>
          <div class="w-full px-4 lg:w-2/6">
            <card-stats
              statSubtitle="PERFORMANCE"
              statTitle="49,65%"
              statArrow="up"
              statPercent="12"
              statPercentColor="text-emerald-500"
              statDescripiron="Since last month"
              statIconName="fas fa-percent"
              statIconColor="bg-emerald-500"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CardStats from "@/Components/Cards/CardStats.vue";

export default {
  components: {
    CardStats,
  },
  props: {
    total_visits : [Number, String],
    average_clicks : [Number, String],
    most_used : String,
  },
};
</script>
