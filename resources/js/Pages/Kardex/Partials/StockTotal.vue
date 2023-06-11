<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

const dataStock = useForm({
  stock_old: '',
  stock_sales: '',
  stock_today: '',
  stock_input: '',
  local: {}
});

const hasData = ref(false);

onMounted(async () => {
  try {
    const response = await axios.get(route('generalstock'));
    const { data } = response;
    if (data && data.local && data.local.description) {
      dataStock.stock_old = data.stock_old;
      dataStock.stock_sales = data.stock_sales;
      dataStock.stock_today = data.stock_today;
      dataStock.stock_input = data.stock_input;
      dataStock.local = data.local;
      hasData.value = true;
    }
  } catch (error) {
    console.error(error);
  }
});
</script>

<template>
  <div>
    <p v-if="hasData" class="dark:text-white">
      {{ dataStock.local.description }}
      <strong> CALZADOS HOY:</strong>
      Inicio día -> {{ dataStock.stock_old }}/ Ingresos -> {{ dataStock.stock_input }}/ Vendidos -> {{ dataStock.stock_sales }}/ Actual -> {{ dataStock.stock_today }}
    </p>
  </div>
</template>
