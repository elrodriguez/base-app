<script setup>
import { ref, onMounted, computed, watch } from 'vue';

const displayTable= ref(false);
const products = ref([]);


const getDataMinimumStock = () => {
    displayTable.value = true;
    axios({
        method: 'get',
        url: route('sales_dashboard_minimum_stock'),
    }).then((response) => {
        products.value = response.data.products;
        return true;
    }).then(()=>{
        displayTable.value = false;
    });
}

onMounted(()=>{
    getDataMinimumStock();
});
</script>

<template>
    <div v-if="products.length > 0" class="panel h-full">
        <template v-if="displayTable">
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
            <div class="flex items-center justify-between dark:text-white-light mb-5">
                <h5 class="font-semibold text-lg">PRODUCTOS POR AGOTARSE</h5>
                <div class="ltr:ml-auto rtl:mr-auto">
                    
                </div>
            </div>
            <div>
                <div class="space-y-6" style="overflow-y: auto; height: 400px;scrollbar-width: thin;">
                    <div v-for="(produc, inx) in products" class="flex">
                        <img :src="produc.image" class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" alt="avatar">
                        <div class="px-3 flex-1">
                            <div>{{ produc.description }}</div>
                            <div class="text-xs text-white-dark dark:text-gray-500">{{ produc.interne }}</div>
                        </div>
                        <span class="text-success text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre">{{ produc.stock }}</span>
                        
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>