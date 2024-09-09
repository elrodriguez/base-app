<script setup>
    import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
    import { ref, onMounted } from 'vue';
    const summaryData = ref([]);
    const displayData = ref(null);

    onMounted(async () => {
        getSalesSummary('day');
    });

    const getSalesSummary = (per) =>{
        try {
            displayData.value = true;
            axios.post(route('sales_dashboard_total_summary'),{period: per}).then((response) => {
                summaryData.value = response.data;
               
                displayData.value = false;
            });
            
        } catch (error) {
            console.error(error);
        }
    }

    const calculatePercentage = (part, total) => {
        if (total === 0) {
            return 0; // Evitar la división por cero
        }
        return ((part / total) * 100).toFixed(2); // Redondear a dos decimales
    }
</script>
<template>
    <div v-if="displayData" class="panel">
        <div class="flex items-center dark:text-white-light mb-5">
            <h5 class="font-semibold text-lg">Resumen</h5>
            <div class="dropdown ltr:ml-auto rtl:mr-auto">
                <Popper :placement="'bottom-start'" offsetDistance="0" class="align-middle">
                    <button type="button" class="shadow-[0_0_2px_0_#012951] rounded p-1 text-primary hover:text-white-light hover:bg-[#1937cc] place-content-center ltr:mr-2 rtl:ml-2">
                        <icon-plus />
                    </button>
                    <template #content="{ close }">
                        <ul @click="close()">
                            <li>
                                <a @click="getSalesSummary('day')" href="javascript:;">Día</a>
                            </li>
                            <li>
                                <a @click="getSalesSummary('week')" href="javascript:;">Semana</a>
                            </li>
                            <li>
                                <a @click="getSalesSummary('month')" href="javascript:;">Mes</a>
                            </li>
                        </ul>
                    </template>
                </Popper>
            </div>
        </div>
        <div class="space-y-9">
            <div class="flex items-center justify-between">
                <div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
                </div>
                <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
            </div>
            <div class="flex items-center justify-between pt-4">
                <div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
                </div>
                <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
            </div>
            <div class="flex items-center justify-between pt-4">
                <div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
                </div>
                <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
            </div>
            <div class="flex items-center justify-between pt-4">
                <div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
                </div>
                <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
            </div>
        </div>
    </div>
    <div v-else class="panel">
        <div class="flex items-center dark:text-white-light mb-5">
            <h5 class="font-semibold text-lg">Resumen</h5>
            <div class="dropdown ltr:ml-auto rtl:mr-auto">
                <Popper :placement="'bottom-start'" offsetDistance="0" class="align-middle">
                    <button type="button" class="shadow-[0_0_2px_0_#012951] rounded p-1 text-primary hover:text-white-light hover:bg-[#1937cc] place-content-center ltr:mr-2 rtl:ml-2">
                        <icon-plus />
                    </button>
                    <template #content="{ close }">
                        <ul @click="close()">
                            <li>
                                <a @click="getSalesSummary('day')" href="javascript:;">Día</a>
                            </li>
                            <li>
                                <a @click="getSalesSummary('week')" href="javascript:;">Semana</a>
                            </li>
                            <li>
                                <a @click="getSalesSummary('month')" href="javascript:;">Mes</a>
                            </li>
                        </ul>
                    </template>
                </Popper>
            </div>
        </div>
        <div class="space-y-9">
            <template v-for="doc in summaryData.documents">
                <div v-if="doc.invoice_type_doc == '01'" class="flex items-center">
                    <div class="w-9 h-9 ltr:mr-3 rtl:ml-3">
                        <div class="bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light rounded-full w-9 h-9 grid place-content-center">
                            <span class="shrink-0 grid place-content-center text-base w-9 h-9 rounded-md bg-info-light dark:bg-info text-info dark:text-info-light">F</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex font-semibold text-white-dark mb-2">
                            <h6>FACTURAS</h6>
                            <p class="ltr:ml-auto rtl:mr-auto">S/ {{ doc.total }}</p>
                        </div>
                        <div class="rounded-full h-2 bg-dark-light dark:bg-[#1b2e4b] shadow">
                            <div class="bg-gradient-to-r from-[#7579ff] to-[#b224ef] w-full h-full rounded-full" :style="`width: ${calculatePercentage(doc.total,summaryData.total)}%`"></div>
                        </div>
                    </div>
                </div>
                <div v-if="doc.invoice_type_doc == '03'" class="flex items-center">
                    <div class="w-9 h-9 ltr:mr-3 rtl:ml-3">
                        <div class="bg-success-light dark:bg-success text-success dark:text-success-light rounded-full w-9 h-9 grid place-content-center">
                            <span class="shrink-0 grid place-content-center text-base w-9 h-9 rounded-md bg-info-light dark:bg-info text-info dark:text-info-light">B</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex font-semibold text-white-dark mb-2">
                            <h6>BOLETAS</h6>
                            <p class="ltr:ml-auto rtl:mr-auto">S/ {{ doc.total }}</p>
                        </div>
                        <div class="w-full rounded-full h-2 bg-dark-light dark:bg-[#1b2e4b] shadow">
                            <div class="bg-gradient-to-r from-[#3cba92] to-[#0ba360] w-full h-full rounded-full" :style="`width: ${calculatePercentage(doc.total,summaryData.total)}%`"></div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-for="note in summaryData.notes_sale">
                <div class="flex items-center">
                    <div class="w-9 h-9 ltr:mr-3 rtl:ml-3">
                        <div class="bg-warning-light dark:bg-warning text-warning dark:text-warning-light rounded-full w-9 h-9 grid place-content-center">
                            <span class="shrink-0 grid place-content-center text-base w-9 h-9 rounded-md bg-info-light dark:bg-info text-info dark:text-info-light">NV</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex font-semibold text-white-dark mb-2">
                            <h6>NOTAS DE VENTA</h6>
                            <p class="ltr:ml-auto rtl:mr-auto">S/ {{ note.total }}</p>
                        </div>
                        <div class="w-full rounded-full h-2 bg-dark-light dark:bg-[#1b2e4b] shadow">
                            <div class="bg-gradient-to-r from-[#f09819] to-[#ff5858] w-full h-full rounded-full" :style="`width: ${calculatePercentage(note.total,summaryData.total)}%`"></div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-if="summaryData.physical > 0">
                <div class="flex items-center">
                    <div class="w-9 h-9 ltr:mr-3 rtl:ml-3">
                        <div class="bg-warning-light dark:bg-warning text-warning dark:text-warning-light rounded-full w-9 h-9 grid place-content-center">
                            <span class="shrink-0 grid place-content-center text-base w-9 h-9 rounded-md bg-info-light dark:bg-info text-info dark:text-info-light">DF</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex font-semibold text-white-dark mb-2">
                            <h6>DOCUMENTOS FISICOS</h6>
                            <p class="ltr:ml-auto rtl:mr-auto">S/ {{ (summaryData.physical).toFixed(2) }}</p>
                        </div>
                        <div class="w-full rounded-full h-2 bg-dark-light dark:bg-[#1b2e4b] shadow">
                            <div class="bg-gradient-to-r from-[#f09819] to-[#ff5858] w-full h-full rounded-full" :style="`width: ${calculatePercentage(summaryData.physical,summaryData.total)}%`"></div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>