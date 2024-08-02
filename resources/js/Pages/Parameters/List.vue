<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { faGears } from "@fortawesome/free-solid-svg-icons";
    import Pagination from '@/Components/Pagination.vue';
    import Keypad from '@/Components/Keypad.vue';
    import { Link, router, useForm } from '@inertiajs/vue3';
    import { Dropdown, Menu, MenuItem, Input, Select, Textarea, message } from 'ant-design-vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';

    const props = defineProps({
        parameters: {
            type: Object,
            default: () => ({}),
        },
        filters: {
            type: Object,
            default: () => ({}),
        },
    });
    const form = useForm({
        search: props.filters.search,
    });

    const updateDefaultValue = (id, value) => {
        axios.get(route('parameters_update_default_value',[id,value])).then(()=>{
            message.success('Se actualizó correctamente');
        });
    }
</script>

<template>
    <AppLayout title="Parametros">
        <Navigation >
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Configuraciones</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Parametros</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">
                <!-- ====== Table One Start -->
                <div class="panel p-0">
                    <div class="w-full p-4">
                        <div class="grid grid-cols-3">
                            <div class="col-span-3 sm:col-span-1">
                                <form @submit.prevent="form.get(route('parameters'))">
                                <label for="table-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                        </div>
                                        <input v-model="form.search" type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar por cliente">
                                    </div>
                                </form>
                            </div>
                            <div class="col-span-3 sm:col-span-2">
                                <Keypad>
                                    <template #botones>
                                        <Link :href="route('parameters_create')" class="inline-block px-6 py-2.5 bg-blue-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Nuevo</Link>
                                    </template>
                                </Keypad>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr >
                                    <th class="text-center">
                                        Acciones
                                    </th>
                                    <th>
                                        Código
                                    </th>
                                    <th>
                                        Descripción
                                    </th>
                                    <th>
                                        Valor
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(parameter, index) in parameters" :key="parameter.id" >
                                    <td>
                                        <Dropdown :placement="'bottomLeft'" arrow>
                                            <button class="border py-1.5 px-2 dropdown-button inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm" type="button">
                                                <font-awesome-icon :icon="faGears" />
                                            </button>
                                            <template #overlay>
                                            <Menu>
                                                <MenuItem>
                                                    <Link :href="route('parameters_edit',parameter.id)" type="Link">Editar</Link>
                                                </MenuItem>
                                                <MenuItem>
                                                    <a href="javascript:;">Eliminar</a>
                                                </MenuItem>
                                            </Menu>
                                            </template>
                                        </Dropdown>
                                    </td>
                                    <td>
                                        <pre>{{ parameter.parameter_code }}</pre>
                                    </td>
                                    <td>
                                        {{ parameter.description }}
                                    </td>
                                    <td>
                                        <template v-if="parameter.control_type == 'in'">
                                            <Input 
                                                v-model:value="parameter.value_default"
                                                @pressEnter="updateDefaultValue(parameter.id, parameter.value_default)"
                                            />
                                            <small>presionar enter para guardar cambios</small>
                                        </template>
                                        <template v-else-if="parameter.control_type == 'sq'">
                                            <Select
                                                v-model:value="parameter.value_default"
                                                style="width: 100%"
                                                :options="JSON.parse(parameter.json_query_data).map((obj) => ({value: obj.id, label:obj.description}))"
                                                @change="updateDefaultValue(parameter.id, parameter.value_default)"
                                            />
                                        </template>
                                        <template v-else-if="parameter.control_type == 'sa'">
                                            <Select
                                                v-model:value="parameter.value_default"
                                                style="width: 100%"
                                                :options="JSON.parse(parameter.json_query_data)"
                                                @change="updateDefaultValue(parameter.id, parameter.value_default)"
                                            />
                                        </template>
                                        <template v-else-if="parameter.control_type == 'tx'">
                                            <Textarea
                                                v-model:value="parameter.value_default"
                                                style="width: 100%"
                                                show-count 
                                                :maxlength="5000"
                                                @change="updateDefaultValue(parameter.id, parameter.value_default)"
                                                >
                                            </Textarea>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </AppLayout>
</template>