<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import Keypad from '@/Components/Keypad.vue';
import { ref, onMounted } from 'vue';
import SuccessButton from '@/Components/SuccessButton.vue';
import flatPickr from 'vue-flatpickr-component';
import { Spanish } from "flatpickr/dist/l10n/es.js"
import 'flatpickr/dist/flatpickr.css';
import Swal from 'sweetalert2';

import IconEye from '@/Components/vristo/icon/icon-eye.vue';

const form = useForm({
    stablishment_id: null,
    date: null
});


const date3 = ref('');

const resumen = ref({
    sales: {
        documents: [],
        total: 0.00,
        show: false
    },
    purchases: {
        documents: [],
        total: 0.00,
        show: false
    },
    expenses: {
        details: [],
        total: 0.00,
        show: false
    },
    result: 0.00
});

onMounted(()=>{
    // Obtener la fecha actual
    const currentDate = new Date();

    // Formatear la fecha en el formato deseado
    const startDate = currentDate.toISOString().slice(0, 10);
    const endDate = new Date(currentDate.getTime() + 5 * 24 * 60 * 60 * 1000).toISOString().slice(0, 10);

    // Asignar el rango de fechas a la variable date3
    date3.value = `${startDate} to ${endDate}`;
})

const rangeCalendar = ref({
    dateFormat: 'Y-m-d',
    mode: 'range',
    position: 'auto right',
    locale: Spanish
});

const salesExpensesData = () => {
    form.processing = true;
    form.date = date3.value;
    axios({
        method: 'post',
        url: route('report_sales_expenses_data'),
        data: form
    }).then((res) => {
        if(res.data.sales){
            resumen.value.sales.documents = res.data.sales.documents;
            resumen.value.sales.total = res.data.sales.total;
            resumen.value.purchases.documents = res.data.purchases.documents;
            resumen.value.purchases.total = res.data.purchases.total;
            resumen.value.expenses.details = res.data.expenses.details;
            resumen.value.expenses.total = res.data.expenses.total;
            resumen.value.result = res.data.result
        }else{
            showMessage('No se encontraron resultados para la consulta.');
        }
        form.processing = false;
    });
}

const showMessage = (msg = '', type = 'success') => {
    const toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        customClass: { container: 'toast' },
    });
    toast.fire({
        icon: type,
        title: msg,
        padding: '10px 20px',
    });
};

</script>
<template>
    <AppLayout title="Reportes">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('reports')" class="text-primary hover:underline">Reportes</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Registro de ventas e ingresos por periodo</span>
            </li>
        </Navigation>
        <div class="mt-5 space-y-5">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex space-x-4">
                    <flat-pickr v-model="date3" class="form-input" :config="rangeCalendar"></flat-pickr>
                    <SuccessButton @click="salesExpensesData" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
                        <svg v-show="form.processing" aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                        </svg>
                        Buscar
                    </SuccessButton>
                </div>
                <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                    <Keypad>
                        <template #botones>
                            <Link :href="route('reports')" class="btn btn-info text-xs uppercase">Ir al Listado</Link>
                        </template>
                    </Keypad>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6 text-white">
                <div class="space-y-6">
                </div>
            </div>
        </div>
    </AppLayout>
</template>