<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link,useForm, router } from '@inertiajs/vue3';
import Keypad from '@/Components/Keypad.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Select } from 'ant-design-vue';
import { faFaceSmile } from "@fortawesome/free-solid-svg-icons";
import InputLabel from '@/Components/InputLabel.vue';
// const props = defineProps({
//     resmenu: {
//         type: Object,
//         default: () => ({}),
//     },
// });

import { ref, watch } from 'vue';

const options = ref([
  {
    value: 'a1',
    label: 'a1',
  },
  {
    value: 'a2',
    label: 'a2',
  },
  {
    value: 'a3',
    label: 'a3',
  },
]);
const value = ref([]);

const handleChange = (value) => {
  console.log(`selected ${value}`);
};

watch(value, () => {
  console.log('value', value.value);
});

const xhttp =  assetUrl;

const form = useForm({
    client_id: null
});

const saveSale = () => {

}

</script>
<template>
    <AppLayout title="Institución">
        <div class="max-w-screen-2xl  mx-auto p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <nav class="flex px-4 py-3 border border-stroke text-gray-700 mb-4 bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <Link :href="route('dashboard')" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Inicio
                        </Link>
                    </li>
                    <li>
                        <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <!-- <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Productos</a> -->
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Restaurante</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Vender</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 bg-white sm:rounded-tl-md sm:rounded-tr-md sm:p-6 shadow dark:bg-gray-800 ">
                    <div class="grid grid-cols-6">
                        <div class="col-span-3 sm:col-span-2">
                            <InputLabel for="client_id" value="Cliente *" class="mb-1" />
                            <Select
                                id="client_id"
                                v-model:value="value"
                                class="w-full"
                                :options="options"
                                @change="handleChange"
                                >
                                <template #suffixIcon>
                                    <font-awesome-icon :icon="faFaceSmile" />
                                </template>
                            </Select>
                            <InputError :message="form.errors.client_id" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md dark:bg-gray-700">
                    <Keypad>
                        <template #botones>
                            <PrimaryButton @click="saveSale()">
                                Imprimir
                            </PrimaryButton>
                            <Link :href="route('res_menu_list')"  class="ml-2 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Ir al Listado</Link>
                        </template>
                    </Keypad>
                </div>
            </div>
        </div>
        
    </AppLayout>
</template>

  