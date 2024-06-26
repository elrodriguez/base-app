<script setup>
    import { useForm, Link } from "@inertiajs/vue3"
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import Pagination from '@/Components/Pagination.vue';
    import { faTrashAlt, faPencilAlt } from "@fortawesome/free-solid-svg-icons";
    import Keypad from '@/Components/Keypad.vue';
    import swal from "sweetalert";

    const props = defineProps({
        permissions: {
            type: Object,
            default: () => ({})
        },
        filters: {
            type: Object,
            default: () => ({})
        }
    });

    const form = useForm({
        search: props.filters.search,
    });

    const formDelete = useForm({})

    const destroyPermission = (id) => {
        swal({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                formDelete.delete(route("permissions.destroy", id),{
                    onSuccess: () => {
                        swal('Permiso eliminado con éxito');
                    }
                });
            }
        });
    }
</script>

<template>
    <AppLayout title="Permisos">
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="col-span-6 p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="flex items-center justify-between pb-4 bg-white dark:bg-gray-900">
                        <form @submit.prevent="form.get(route('permissions.index'))">
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input v-model="form.search" type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar rol">
                            </div>
                        </form>
                        <div class="text-right">
                            <Keypad>
                                <template #botones>
                                    <Link :href="route('permissions.create')" class="inline-block px-6 py-2.5 bg-blue-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Nuevo</Link>
                                </template>
                            </Keypad>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-gray-700 uppercase bg-gray-100 dark:text-gray-400">
                                <tr class="border">
                                    <th scope="col" class="px-6 py-4 border">
                                        Acciones
                                    </th>
                                    <th scope="col" class="px-6 py-4">
                                        <div class="flex items-center">
                                            Nombre
                                            <a :href="route('permissions.index', {sort:'name',sort_order: filters.sort_order})">
                                                <img style="max-width: 12px;height: auto;" class="svg-img" src="/icons-svg/clasificar.svg" alt="Descripción de la imagen">
                                            </a>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(permission, index) in permissions.data" :key="permission.id" class="bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="border px-6 py-4">
                                        <a :href="route('permissions.edit',permission.id)" class="mr-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <font-awesome-icon :icon="faPencilAlt" />
                                        </a>
                                        <button @click="destroyPermission(permission.id)" type="button" class="mr-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                            <font-awesome-icon :icon="faTrashAlt" />
                                        </button>
                                    </td>
                                    <td class="border px-6 py-4">
                                        {{ permission.name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <Pagination :data="permissions" />
                </div>

            </div>
        </div>
    </AppLayout>
</template>