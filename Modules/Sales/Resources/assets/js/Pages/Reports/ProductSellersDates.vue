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

const astUrl = assetUrl;
const props = defineProps({
    sellers: {
        type: Object,
        default: () => ({})
    }
});

const form = useForm({
    user_id: null,
    date: null
});


const date3 = ref('');

const products = ref([]);

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

const productsellerstable = () => {
    form.processing = true;
    form.date = date3.value;
    axios({
        method: 'post',
        url: route('report_product_sellers_table'),
        data: form
    }).then((res) => {
        if(res.data.products.length > 0){
            products.value = res.data.products;
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
                <span>Reporte de productos por vendedores y fechas</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div class="panel p-0">
                <div class="w-full p-5">
                    <div class="grid grid-cols-6 items-center gap-4">
                        <div class="col-span-6 sm:col-span-2">
                            <select v-model="form.user_id" id="stablishment" class="form-select">
                                <template v-for="(seller, index) in sellers" :key="index">
                                    <option :value="seller.id">{{ seller.name }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-1">
                            <flat-pickr v-model="date3" class="form-input" :config="rangeCalendar"></flat-pickr>
                        </div>
                        <div class="col-span-6 sm:col-span-1 text-right">
                            <SuccessButton @click="productsellerstable" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
                                <svg v-show="form.processing" aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                </svg>
                                Buscar
                            </SuccessButton>
                        </div>
                        <div class="col-span-6 sm:col-span-2 text-right">
                            
                            <Keypad>
                                <template #botones>
                                    <Link :href="route('reports')" class="btn btn-info text-xs uppercase">Ir al Listado</Link>
                                    
                                </template>
                            </Keypad>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr class="border-b-0">
                                <th class="text-center">Fecha Venta</th>
                                <th class="ltr:rounded-l-md rtl:rounded-r-md">Producto</th>
                                <th class="text-center">Pricio</th>
                                <th class="text-center" >Cantidad</th>
                                <th class="text-center" >Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(product, ind) in products">
                                <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                    <td class="text-center">{{ product.sale_date }}</td>
                                    <td class="min-w-[150px] text-black dark:text-white">
                                        <div class="flex">
                                            <img v-if="product.image=='img/imagen-no-disponible.jpg'"
                                                :src="product.image"
                                                class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover"
                                                :alt="product.interne"
                                            />
                                            <img v-else
                                                :src="product.image"
                                                class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover"
                                                :alt="product.interne"
                                            />
                                            <p class="whitespace-nowrap">
                                                {{ product.product_name }}
                                                <span class="text-primary block text-xs">
                                                    {{ product.product_code }}
                                                </span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="text-right" >{{ product.product_price }}</td>
                                    <td class="text-right" >{{ product.total_quantity }}</td>
                                    <td class="text-right" >{{ product.total_amount }}</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>