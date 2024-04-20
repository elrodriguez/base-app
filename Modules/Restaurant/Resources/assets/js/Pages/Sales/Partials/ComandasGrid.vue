<script setup>
    import { Link, useForm, router } from '@inertiajs/vue3';
    import { Dropdown, ListGroup, ListGroupItem, Radio } from 'flowbite-vue'
    import { onBeforeMount, ref } from 'vue';

    const props = defineProps({
        comandas: {
            type: Object,
            default: () => ({}),
        }
    });
    const xassetUrl = assetUrl;

    const salesData = ref([]);

    const closeEditions = (id, index) => {
        axios.get(route('res_sales_find_reset', id)).then((res) => {
            salesData.value[index].details = res.data.sale.details   
        }).then(() => {
            salesData.value[index].edit = !salesData.value[index].edit
        });
    }


    onBeforeMount(() => {
        for(let i = 0; i < props.comandas.length; i++){
            salesData.value.push({
                id: props.comandas[i].id,
                edit: false,
                details: props.comandas[i].details,
            });
        }
    });

</script>
<template>
    <div v-if="comandas.length > 0" class="grid grid-cols-6 ">
        <div v-for="(sale, index) in comandas" class="col-span-6 md:col-span-3 lg:col-span-2">
            <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">{{ sale.correlative }}</h5>
                    <Dropdown placement="left" text="Editar" >
                        <ListGroup>
                            <ListGroupItem @click="salesData[index].edit = !salesData[index].edit">
                                Comandas
                            </ListGroupItem>
                            <ListGroupItem>
                                Cancelar
                            </ListGroupItem>
                        </ListGroup>
                    </Dropdown>
                </div>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li v-for="(detail, key) in sale.details" class="py-3 sm:py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" :src="xassetUrl+'storage/'+detail.comanda.image" alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ detail.comanda.name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ detail.comanda.description }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{ detail.quantity }}
                                </div>
                            </div>
                            <div class="mt-2">
                                <ul class="items-center w-full text-sm font-medium text-gray-900 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <li class="w-full !m-0 pl-3 flex border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <Radio
                                            v-model="salesData[index].details[key].preparation_status"
                                            label="Pendiente"
                                            name="radio-horizontal"
                                            value="pendiente"
                                        />
                                    </li>
                                    <li class="w-full !m-0 pl-3 flex border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <Radio
                                            v-model="salesData[index].details[key].preparation_status"
                                            label="Listo"
                                            name="radio-horizontal"
                                            value="listo"
                                        />
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div v-if="salesData[index].edit" class="flex items-center justify-between">
                    <a href="#" @click="closeEditions(sale.id, index)" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Cerrar Edición</a>
                    <a href="#" class="text-purple-700 hover:text-white border border-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-4 py-2 text-center me-2 mb-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-200 dark:bg-gray-800 dark:text-blue-400" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">Enhorabuena!</span> No quedan pedidos pendientes.
        </div>
    </div>
</template>