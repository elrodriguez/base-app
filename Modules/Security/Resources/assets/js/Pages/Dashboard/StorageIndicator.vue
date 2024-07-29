<script setup>

import { ref, onMounted, computed, watch } from 'vue';
import apexchart from 'vue3-apexcharts';

const displayDiskBusy = ref(false);
const donutChartSeries = ref([]);
const diskBusy = ref({
  freeGB: null,
  busyGB: null,
  busyPercentage: null,
  series: []
});


const getData = () => {
  displayDiskBusy.value = true;
  axios.get(route('security_storage_indicator')).then((response) => {
    return response.data;
  }).then((result) => {
    diskBusy.value = {
      freeGB: result.disc_space,
      busyGB: result.totalSize.GB,
      busyPercentage: ((parseFloat(result.totalSize.GB) / parseFloat(result.disc_space)) * 100),
      series: [
        parseFloat(result.imageSize.GB),
        parseFloat(result.pdfSize.GB),
        parseFloat(result.otherSize.GB)
      ]
    };
    //displayDiskBusy.value = false;
  }).catch((error) => {
    console.error('Error al obtener los datos:', error);
    displayDiskBusy.value = false;
  });
};

onMounted(() => {
    getData();
});

watch(diskBusy, (newSeries) => {
  donutChartSeries.value = newSeries.series;
  displayDiskBusy.value = false;
});

const donutChart = computed(() => {
  return {
    chart: {
      height: 300,
      type: 'donut',
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    stroke: {
      show: false,
    },
    labels: ['imagen', 'pdf', 'otros'],
    colors: ['#4361ee', '#514C44', '#e2a03f'],
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
        },
      },
    ],
    plotOptions: {
      pie: {
          donut: {
              size: '65%',
              background: 'transparent',
              labels: {
                  show: true,
                  name: {
                      show: true,
                      fontSize: '29px',
                      offsetY: -10,
                  },
                  value: {
                      show: true,
                      fontSize: '26px',
                      color: undefined,
                      offsetY: 16,
                      formatter: (val) => {
                          return val;
                      },
                  },
                  total: {
                      show: true,
                      label: 'Total',
                      color: '#888ea8',
                      fontSize: '29px',
                      formatter: (w) => {
                          return w.globals.seriesTotals.reduce(function (a, b) {
                              return a + b;
                          }, 0).toFixed(2);
                      },
                  },
              },
          },
      },
  },
    legend: {
      position: 'top',
    },
  };
});



</script>
<template>
    <div class="panel h-full">
        <template v-if="displayDiskBusy">
          <div class="flex items-center justify-between">
              <div>
                  <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
                  <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
              </div>
              <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
          </div>
        </template>
        <template v-else>
          <div class="flex items-center justify-between mb-5">
              <h5 class="font-semibold text-lg dark:text-white-light">Disco Duro</h5>
              <span class="font-semibold hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-600" > {{ diskBusy.freeGB }} GB</span>
          </div>
          <div class="flex items-center justify-center">
            <apexchart 
              height="460"
              :options="donutChart" 
              :series="donutChartSeries" 
              class="bg-white dark:bg-black rounded-lg overflow-hidden" >
              <div class="min-h-[460px] grid place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                  <span
                      class="animate-spin border-2 border-black dark:border-white !border-l-transparent rounded-full w-5 h-5 inline-flex"
                  ></span>
              </div>
            </apexchart>
          </div>
          <div class="space-y-1">
            <span :class="diskBusy.busyPercentage > 70.5 ? 'bg-danger' : 'text-primary'">usado {{ parseFloat(diskBusy.busyGB).toFixed(2) }} GB de {{ diskBusy.freeGB }} GB (100%)</span>
            <div class="w-full h-6 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                <div :style="`width: ${diskBusy.busyPercentage}%;`" class="h-6 rounded-full text-center text-white flex justify-between items-center px-2 text-xs"
                  :class="diskBusy.busyPercentage > 70.5 ? 'bg-danger' : 'bg-success' "
                >
                  <span v-if="diskBusy.busyPercentage > 10.5">{{ diskBusy.busyPercentage.toFixed(2) }}%</span>
                </div>
            </div>
            <small class="ltr:text-right rtl:text-left w-full not-italic text-xs text-[#777] block before:w-3 before:h-[1px] before:bg-[#777] before:inline-block before:opacity-50 before:relative before:-top-1 ltr:before:mr-1 rtl:before:ml-1">Porcentaje de uso</small>
          </div>
        </template>
    </div>
</template>