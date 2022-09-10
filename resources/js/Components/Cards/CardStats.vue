<template>
  <div
    class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0"
  >
    <div class="flex-auto p-4">
      <div class="flex flex-wrap">
        <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
          <h5 class="text-xs font-bold uppercase text-blueGray-400">
            {{ statSubtitle }}
          </h5>
          <span class="text-xl font-semibold text-blueGray-700">
            {{ statTitle }}
          </span>
        </div>
        <div class="relative flex-initial w-auto pl-4">
          <div
            class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white rounded-full shadow-lg"
            :class="[statIconColor]"
          >
            <i :class="[statIconName]"></i>
          </div>
        </div>
      </div>
      <p class="mt-4 text-xs text-blueGray-500">
         <span class="mr-2" :class="[statPercentColor]" v-if="statPercent">
          <i
            :class="[
              statArrow === 'up' ? `fas fa-arrow-up` : `fas fa-arrow-down`,
            ]"
          ></i>
          {{ statPercent }}%
        </span>
        <span class="whitespace-nowrap">{{ statDescripiron }}</span>
      </p>
    </div>
  </div>
</template>
<script>
export default {
  name: "card-stats",
  props: {
    statSubtitle: {
      type: String,
      default: "Traffic",
    },
    statTitle: {
      type: [String,Number],
      default: "350,897",
    },
    statArrow: {
      default: "up",
      validator: function (value) {
        // The value must match one of these strings
        return ["up", "down"].indexOf(value) !== -1;
      },
    },
    statPercent: {
      type: String,
      default: null,
    },
    // can be any of the text color utilities
    // from tailwindcss
    statPercentColor: {
      type: String,
      default: "text-emerald-500",
    },
    statDescripiron: {
      type: String,
      default: "Since last month",
    },
    statIconName: {
      type: String,
      default: "far fa-chart-bar",
    },
    // can be any of the background color utilities
    // from tailwindcss
    statIconColor: {
      type: String,
      default: "bg-red-500",
    },
  },
};
</script>
