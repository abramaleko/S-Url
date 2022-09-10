<template>
  <div
    class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg"
  >
    <div class="px-4 py-3 mb-0 bg-transparent rounded-t">
      <div class="flex flex-wrap items-center">
        <div class="relative flex-1 flex-grow w-full max-w-full">
          <h6 class="mb-1 text-xs font-semibold uppercase text-blueGray-400">
            Devices
          </h6>
          <h2 class="text-xl font-semibold text-blueGray-700">
            Most devices Used
          </h2>
        </div>
      </div>
    </div>
    <div class="flex-auto p-4">
      <div class="relative h-350-px">
        <canvas id="pie-chart"></canvas>
      </div>
    </div>
  </div>
</template>
<script>
import Chart from 'chart.js/auto';
export default{
    props:{
        stats: Object,
    },
    mounted() {
       this.$nextTick(function(){
        var config={
             type: 'doughnut',
             data: {
                labels: this.stats['labels'],
                datasets: [{
                    label: 'My First Dataset',
                    data: this.stats['device_count'] ,
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
             },
          };
         var ctx = document.getElementById("pie-chart").getContext("2d");
         window.myLine = new Chart(ctx, config);

       });
    }
};

</script>
