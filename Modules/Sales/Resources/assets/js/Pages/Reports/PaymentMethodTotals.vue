<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import Keypad from '@/Components/Keypad.vue';
import TextInput from '@/Components/TextInput.vue';
import Swal from "sweetalert2";
import { ref } from 'vue'
import Navigation from '@/Components/vristo/layout/Navigation.vue';


const refLoading = ref(false);

const props = defineProps({
    locals: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    local_id: 0,
    start: new Date().toISOString().substr(0, 10),
    end: new Date().toISOString().substr(0, 10)
});

const formData = useForm({
    payments:[],
    total:0
});

const getTotals = () => {
    refLoading.value = true;
    if (form.start && form.end && form.start > form.end) {
        showMessage('La fecha de inicio no puede ser mayor a la fecha de término');
    } else {
        
        axios.post(route('data_payment_method_totals'), form ).then((res) => {
            if(Object.entries(res).length > 0){
                formData.payments   = res.data.payments;
                formData.total      = res.data.total;
            } else {
                showMessage('No se encontró producto');
            }
            refLoading.value = false;
        });
    }
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
    <AppLayout title="Reporte">

        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('reports')" class="text-primary hover:underline">Reportes</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Reporte Totales de método de pago</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div class="grid grid-cols-6 items-center gap-4">
                <div class="col-span-6 sm:col-span-2">
                    <select @change="getTotals()" v-model="form.local_id" id="stablishment" class="form-select">
                        <option value="0">Seleccionar Tienda</option> 
                        <template v-for="(establishment, index) in props.locals" :key="index">
                            <option :value="establishment.id">{{ establishment.description }}</option>
                        </template>
                    </select>
                </div>
                <div class="col-span-6 sm:col-span-1">
                    <TextInput
                        id="start"
                        v-model="form.start"
                        type="date"
                        @change="getTotals()"
                    />
                </div>
                <div class="col-span-6  sm:col-span-1">
                    <TextInput
                        id="end"
                        v-model="form.end"
                        type="date"
                        @change="getTotals()"
                    />
                </div>
                <div class="col-span-6 sm:col-span-2 text-right">
                    <Keypad>
                        <template #botones>
                            <Link :href="route('reports')" class="inline-block px-6 py-2.5 bg-blue-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Ir al Listado</Link>
                        </template>
                    </Keypad>
                </div>
            </div>
            
            <div class="mt-5">
                <div class="grid grid-cols-3 gap-4">
                    <div v-for="item in formData.payments" class="panel h-full">
                        <div class="flex items-center justify-between dark:text-white-light mb-4">
                            <h5 class="font-semibold text-lg">{{ item.description }}</h5>
                        </div>
                        <div class="text-[#e95f2b] text-3xl font-bold my-4">
                            <span class="ltr:mr-2 rtl:ml-2"> S/. {{ item.amount }}</span>
                            <span class="text-black text-sm dark:text-white-light ltr:mr-1 rtl:ml-1">ventas </span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-success inline">
                                <path opacity="0.5" d="M22 7L14.6203 14.3347C13.6227 15.3263 13.1238 15.822 12.5051 15.822C11.8864 15.8219 11.3876 15.326 10.3902 14.3342L10.1509 14.0962C9.15254 13.1035 8.65338 12.6071 8.03422 12.6074C7.41506 12.6076 6.91626 13.1043 5.91867 14.0977L2 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M22.0001 12.5458V7H16.418" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </AppLayout>
</template>