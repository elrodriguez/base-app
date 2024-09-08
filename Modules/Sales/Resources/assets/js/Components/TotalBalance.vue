<script setup>
    import { ref, onMounted } from 'vue';
    import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
    import IconCreditCard from '@/Components/vristo/icon/icon-credit-card.vue';

    const balanceData = ref([]);
    const hasData = ref(null);

    onMounted(async () => {
        getBalance('day');
    });

    const getBalance = (per) =>{
        try {
            hasData.value = true;
            axios.post(route('sales_dashboard_total_balance'),{period: per}).then((response) => {
                balanceData.value = response.data;
               
                hasData.value = false;
            });
            
        } catch (error) {
            console.error(error);
        }
    }
</script>
<template>
    <div v-if="hasData"
        class="panel h-[204px] overflow-hidden before:bg-[#1937cc] before:absolute before:-right-44 before:top-0 before:bottom-0 before:m-auto before:rounded-full before:w-96 before:h-96 grid grid-cols-1 content-between"
        style="background: linear-gradient(0deg, #00c6fb -227%, #005bea) !important"
    >
        <div class="flex items-start justify-between text-white-light mb-16 z-[7]">
            <h5 class="font-semibold text-lg">Total Balance</h5>

            <div class="relative text-xl whitespace-nowrap">
                <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32"></div>
                <span class="table text-[#d3d3d3] bg-[#4361ee] rounded p-1 text-xs mt-1 ltr:ml-auto rtl:mr-auto"> 
                    <div class="h-2.5 ms-2 bg-gray-300 rounded-full dark:bg-gray-600 w-24"></div>
                </span>
            </div>
        </div>
        <div class="flex items-center justify-between z-10">
            <div class="flex items-center justify-between">
                <div class="dropdown">
                    <Popper :placement="'top-start'" offsetDistance="0" class="align-middle">
                        <button type="button" class="shadow-[0_0_2px_0_#bfc9d4] rounded p-1 text-white-light hover:bg-[#1937cc] place-content-center ltr:mr-2 rtl:ml-2">
                            <icon-plus />
                        </button>
                        <template #content="{ close }">
                            <ul @click="close()" >
                                <li>
                                    <a @click="getBalance('day')" href="javascript:;">Día</a>
                                </li>
                                <li>
                                    <a @click="getBalance('week')" href="javascript:;">Semana</a>
                                </li>
                                <li>
                                    <a @click="getBalance('month')" href="javascript:;">Mes</a>
                                </li>
                            </ul>
                        </template>
                    </Popper>
                </div>
            </div>
            <span class="shadow-[0_0_2px_0_#bfc9d4] rounded p-1 text-white-light hover:bg-[#4361ee] z-10">
                <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32"></div>
            </span>
        </div>
    </div>
    <div v-else
        class="panel h-[204px] overflow-hidden before:bg-[#1937cc] before:absolute before:-right-44 before:top-0 before:bottom-0 before:m-auto before:rounded-full before:w-96 before:h-96 grid grid-cols-1 content-between"
        style="background: linear-gradient(0deg, #00c6fb -227%, #005bea) !important"
    >
        <div class="flex items-start justify-between text-white-light mb-16 z-[7]">
            <h5 class="font-semibold text-lg">Total Balance</h5>

            <div v-if="balanceData && balanceData.total_sales !== undefined" class="relative text-xl whitespace-nowrap">
                S/ {{ (balanceData.total_sales).toFixed(2) }}
                <span  v-if="balanceData && balanceData.difference !== undefined" class="table text-[#d3d3d3] bg-[#4361ee] rounded p-1 text-xs mt-1 ltr:ml-auto rtl:mr-auto"> 
                    {{ (balanceData.difference < 0 ? '' : '+') + (balanceData.difference).toFixed(2) }}
                </span>
            </div>
        </div>
        <div class="flex items-center justify-between z-10">
            <div class="flex items-center justify-between">
                <div class="dropdown">
                    <Popper :placement="'top-start'" offsetDistance="0" class="align-middle">
                        <button type="button" class="shadow-[0_0_2px_0_#bfc9d4] rounded p-1 text-white-light hover:bg-[#1937cc] place-content-center ltr:mr-2 rtl:ml-2">
                            <icon-plus />
                        </button>
                        <template #content="{ close }">
                            <ul @click="close()" >
                                <li>
                                    <a @click="getBalance('day')" href="javascript:;">Día</a>
                                </li>
                                <li>
                                    <a @click="getBalance('week')" href="javascript:;">Semana</a>
                                </li>
                                <li>
                                    <a @click="getBalance('month')" href="javascript:;">Mes</a>
                                </li>
                            </ul>
                        </template>
                    </Popper>
                </div>
            </div>
            <span class="shadow-[0_0_2px_0_#bfc9d4] rounded p-1 text-white-light hover:bg-[#4361ee] z-10">
                {{ balanceData.period == 'day' ? 'Hoy': balanceData.period == 'week' ? 'Esta semana' : 'Este mes' }}
            </span>
        </div>
    </div>
</template>