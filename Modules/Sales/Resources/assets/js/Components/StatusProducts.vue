<script setup>
import { ref, onMounted, computed, watch } from 'vue';
import IconDownland from '@/Components/vristo/icon/icon-download.vue'
import { 
    faCashRegister,
    faCalendar,
    faPlus
} from "@fortawesome/free-solid-svg-icons";

const displayTable= ref(false);
const dataStock = ref({
    total: 0,
    stock_old: '',
    stock_sales: '',
    stock_today: '',
    stock_input: '',
    local: {},
    stock_sales_p: '',
    stock_today_p: '',
    stock_input_p: '',
});


const hasData = ref(false);

onMounted(async () => {
    try {
        hasData.value = true;
        axios.get(route('generalstock')).then((response) => {
            const { data } = response;
            if (data && data.local && data.local.description) {
                dataStock.value.stock_old = data.stock_old;
                dataStock.value.stock_sales = data.stock_sales;
                dataStock.value.stock_today = data.stock_today;
                dataStock.value.stock_input = data.stock_input;
                dataStock.value.stock_input_p = ((parseFloat(data.stock_input) / parseFloat(data.stock_old)) * 100).toFixed(2);
                dataStock.value.stock_sales_p = ((parseFloat(data.stock_sales) / parseFloat(data.stock_old)) * 100).toFixed(2);
                dataStock.value.stock_today_p = ((parseFloat(data.stock_today)  / parseFloat(data.stock_old)) * 100).toFixed(2);
                dataStock.value.local = data.local;
                dataStock.value.total = data.total;
            }
            hasData.value = false;
        });
        
    } catch (error) {
        console.error(error);
    }
});
</script>

<template>
    <div class="panel h-full">
        <template v-if="hasData">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
          </div>
        </template>
        <template v-else>
            <div class="flex items-center dark:text-white-light mb-5">
                <h5 class="font-semibold text-lg">TOTAL DE PRODUCTOS</h5>
                <div class="ltr:ml-auto rtl:mr-auto">
                    
                </div>
            </div>
            <div class="space-y-9">
                <div class="flex items-center">
                    <div class="w-9 h-9 ltr:mr-3 rtl:ml-3">
                        <div class="bg-danger-light dark:bg-danger text-danger dark:text-danger-light rounded-full w-9 h-9 grid place-content-center">
                            <font-awesome-icon :icon="faCalendar" class="w-5 h-5" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex font-semibold text-white-dark mb-2">
                            <h6>Stock Inicio día</h6>
                            <p class="ltr:ml-auto rtl:mr-auto">{{ dataStock.stock_old }}</p>
                        </div>
                        <div class="text-xs text-white-dark dark:text-gray-500">LOCAL: {{ dataStock.local.description }}</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-9 h-9 ltr:mr-3 rtl:ml-3">
                        <div class="bg-info-light dark:bg-info text-info dark:text-info-light rounded-full w-9 h-9 grid place-content-center">
                            <icon-downland class="w-5 h-5" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex font-semibold text-white-dark mb-2">
                            <h6>Ingresos</h6>
                            <p class="ltr:ml-auto rtl:mr-auto">{{ dataStock.stock_input }}</p>
                        </div>
                        <div class="w-full h-2.5 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
                            <div :style="`width: ${dataStock.stock_input_p}%;`" class="bg-info h-2.5 rounded-full rounded-bl-full text-center text-white text-xs"></div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-9 h-9 ltr:mr-3 rtl:ml-3">
                        <div class="bg-success-light dark:bg-success text-success dark:text-success-light rounded-full w-9 h-9 grid place-content-center">
                            <font-awesome-icon :icon="faCashRegister" class="w-5 h-5" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex font-semibold text-white-dark mb-2">
                            <h6>Vendidos</h6>
                            <p class="ltr:ml-auto rtl:mr-auto">{{ dataStock.stock_sales }}</p>
                        </div>
                        <div class="w-full h-2.5 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
                            <div :style="`width: ${dataStock.stock_sales_p}%;`" class="bg-success h-2.5 rounded-full rounded-bl-full text-center text-white text-xs"></div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-9 h-9 ltr:mr-3 rtl:ml-3">
                        <div class="bg-success-light dark:bg-success text-success dark:text-success-light rounded-full w-9 h-9 grid place-content-center">
                            <font-awesome-icon :icon="faPlus" class="w-5 h-5" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex font-semibold text-white-dark mb-2">
                            <h6>TOTAL</h6>
                            <p class="ltr:ml-auto rtl:mr-auto">{{ dataStock.stock_today }}</p>
                        </div>
                        <div class="text-xs text-white-dark dark:text-gray-500">Total actual del local: {{ dataStock.local.description }}</div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="bg-[#888ea8] rounded-md shadow px-4 py-2.5 dark:bg-[#060818]">
                    <span class="flex justify-center items-center mb-4">
                        <p class="text-xl font-black text-white dark:text-white">TOTAL GENERAL</p>
                    </span>
                    <div class="btn w-full py-1 text-base shadow-none border-0 bg-[#e3e4eb] dark:bg-black text-[#515365] dark:text-[#bfc9d4]">
                        <p class="text-4xl font-black text-gray-900 dark:text-white">{{ dataStock.total }}</p>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>