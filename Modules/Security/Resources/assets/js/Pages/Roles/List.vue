<script setup>
    import { useForm, Link } from "@inertiajs/vue3"
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import Pagination from '@/Components/Pagination.vue';
    import { faTrashAlt, faPencilAlt } from "@fortawesome/free-solid-svg-icons";
    import Keypad from '@/Components/Keypad.vue';
    import swal from "sweetalert";
    import Navigation from '@/Components/vristo/layout/Navigation.vue';

    const props = defineProps({
        roles: {
            type: Object,
            default: () => ({}),
        },
        filters: {
            type: Object,
            default: () => ({}),
        }
    });

    const form = useForm({
        search: props.filters.search,
    });

    const formDelete = useForm({})

    const destroyRol = (id) => {
        swal({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                formDelete.delete(route("roles.destroy", id),{
                    onSuccess: () => {
                        swal('Rol eliminada con éxito');
                    }
                });
            }
        });
    }
</script>

<template>
    <AppLayout title="Roles">
       <Navigation :routeModule="route('security_dashboard')" :titleModule="'Configuraciones'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Roles</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div class="panel p-0">
                <div class="w-full p-4">
                    <div class="grid grid-cols-3">
                        <div class="col-span-3 sm:col-span-1">
                            <form @submit.prevent="form.get(route('roles.index'))">
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <input v-model="form.search" type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar rol">
                                </div>
                            </form>
                        </div>
                        <div class="col-span-3 sm:col-span-2">
                            <Keypad>
                                <template #botones>
                                    <Link :href="route('roles.create')" class="inline-block px-6 py-2.5 bg-blue-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Nuevo</Link>
                                </template>
                            </Keypad>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="">
                        <thead class="">
                            <tr>
                                <th scope="col" class="text-center">
                                    Acciones
                                </th>
                                <th scope="col">
                                    Nombre
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(role, index) in roles.data" :key="role.id" >
                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <Link :href="route('roles.edit',role.id)" class="btn btn-success">
                                            <font-awesome-icon :icon="faPencilAlt" />
                                        </Link>
                                        <button @click="destroyRol(role.id)" type="button" class="btn btn-danger">
                                            <font-awesome-icon :icon="faTrashAlt" />
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    {{ role.name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <Pagination :data="roles" />
            </div>
        </div>
    </AppLayout>
</template>