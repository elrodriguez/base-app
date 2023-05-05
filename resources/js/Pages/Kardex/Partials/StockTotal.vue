<script setup>
import { useForm } from '@inertiajs/vue3';

const dataStock = useForm({
    stock_old: '',
    stock_sales: '',
    stock_today: '',
    stock_input: '',
    local: {}
});

axios.get(route('generalstock')).then( (res) => {
    dataStock.stock_old = res.data.stock_old
    dataStock.stock_sales = res.data.stock_sales
    dataStock.stock_today = res.data.stock_today
    dataStock.stock_input = res.data.stock_input
    dataStock.local = res.data.local
});

</script>
<template>
    <p>{{ dataStock.local.description }}<strong> CALZADOS HOY:</strong> Inicio día->{{ dataStock.stock_old  }}/ Ingresos ->{{ dataStock.stock_input }}/ Vendidos->{{ dataStock.stock_sales }}/ Actual->{{ dataStock.stock_today  }}</p>
</template>