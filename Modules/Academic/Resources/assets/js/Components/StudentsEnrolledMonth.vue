<script setup>
import { ref, onMounted, computed, watch } from 'vue';
import apexchart from 'vue3-apexcharts';
import { useAppStore } from '@/stores/index';
const store = useAppStore();

const displayChart = ref(false);

const studentsChart = ref({
  months: [],
  counts: [],
  total: 0
});

const lineChartSeries = computed(() => [
  {
    name: 'Alumnos',
    data: studentsChart.value.counts,
  },
]);

const getDataStudents = () => {
  displayChart.value = true;
  axios.get(route('aca_student_registration_total')).then((response) => {
    return response.data;
  }).then((result) => {
    const months = [];
    const counts = [];
    let total = 0;

    result.students.forEach(item => {
      // Convertir el número de mes a nombre
      const monthName = getMonthName(item.month);
      months.push(monthName);
      counts.push(parseFloat(item.count));
      total += parseFloat(item.count);
    });

    studentsChart.value.months = months;
    studentsChart.value.counts = counts;
    studentsChart.value.total = total;
    displayChart.value = false;
  }).catch((error) => {
    console.error('Error al obtener los datos:', error);
    displayChart.value = false;
  });
};

const getMonthName = (month) => {
  switch (month) {
    case 1:
      return 'Ene';
    case 2:
      return 'Feb';
    case 3:
      return 'Mar';
    case 4:
      return 'Abr';
    case 5:
      return 'May';
    case 6:
      return 'Jun';
    case 7:
      return 'Jul';
    case 8:
      return 'Ago';
    case 9:
      return 'Sep';
    case 10:
      return 'Oct';
    case 11:
      return 'Nov';
    case 12:
      return 'Dic';
    default:
      return null;
  }
};

onMounted(() => {
  getDataStudents();
});

const lineChart = computed(() => {
  const isDark = store.theme === 'dark' || store.isDarkMode ? true : false;
  const isRtl = store.rtlClass === 'rtl' ? true : false;
  return {
    chart: {
      height: 300,
      type: 'line',
      toolbar: false,
    },
    colors: ['#4361ee'],
    tooltip: {
      marker: false,
      y: {
        formatter(number) {
          return number;
        },
      },
      theme: isDark ? 'dark' : 'light',
    },
    stroke: {
      width: 2,
      curve: 'smooth',
    },
    xaxis: {
      categories: studentsChart.value.months,
      axisBorder: {
        color: isDark ? '#191e3a' : '#e0e6ed',
      },
    },
    yaxis: {
      opposite: isRtl ? true : false,
      labels: {
        offsetX: isRtl ? -20 : 0,
      },
    },
    grid: {
      borderColor: isDark ? '#191e3a' : '#e0e6ed',
    },
  };
});
</script>
<template>
  <div class="panel">
    <template v-if="displayChart">
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
        <h5 class="font-semibold text-lg dark:text-white-light">Estudiantes Matriculados por Mes</h5>
        <span class="font-semibold hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-600" > TOTAL: {{ studentsChart.total }}</span>
      </div>
      <div>
        <apexchart 
          height="300" 
          :options="lineChart" 
          :series="lineChartSeries"
          class="bg-white dark:bg-black rounded-lg overflow-hidden">
        </apexchart>
      </div>
    </template>
  </div>
</template>