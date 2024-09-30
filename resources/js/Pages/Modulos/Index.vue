<script setup>
    import { useForm, Link, router } from "@inertiajs/vue3"
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import IconPencil from "@/Components/vristo/icon/icon-pencil.vue";
    import IconTrashLines from "@/Components/vristo/icon/icon-trash-lines.vue";
    import IconMenuAuthentication from "@/Components/vristo/icon/menu/icon-menu-authentication.vue";
    import Keypad from '@/Components/Keypad.vue';
    import Swal2 from "sweetalert2";
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import { ref } from 'vue';

    defineProps({
        modulos: {
            type: Object,
            default: () => ({})
        }
    });

    const destroyModulo = (id) => {
        Swal2.fire({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Eliminar!',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            padding: '2em',
            customClass: 'sweet-alerts',
            preConfirm: () => {
                return axios.delete(route('modulos.destroy', id)).then((res) => {
                    if (!res.data.success) {
                        Swal2.showValidationMessage(res.data.message)
                    }
                    return res
                });
            },
            allowOutsideClick: () => !Swal2.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal2.fire({
                    title: 'Enhorabuena',
                    text: 'Se Eliminó correctamente',
                    icon: 'success',
                    padding: '2em',
                    customClass: 'sweet-alerts',
                });
                router.visit(route('modulos.index'), { 
                  replace: false,
                  preserveState: true,
                  preserveScroll: true,
                  method: 'get' 
                });
            }
        });
    }
</script>
<template>
    <AppLayout title="Categorias">
        <Navigation :routeModule="route('security_dashboard')" :titleModule="'Configuraciones'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Modulos</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div class="panel p-0">
                <div class="w-full p-4">

                    <div class="grid grid-cols-3">
                        <div class="col-span-3 sm:col-span-1">
                            <h4>MODULOS DEL SISTEMA</h4>
                        </div>
                        <div class="col-span-3 sm:col-span-2">
                            <Keypad>
                                <template #botones>
                                    <Link v-can="'clientes_nuevo'" :href="route('modulos.create')" class="flex items-center justify-center inline-block px-6 py-2.5 bg-blue-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                        Nuevo
                                    </Link>
                                </template>
                            </Keypad>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                
                                <th class="text-center w-16">Acción</th>
                                <th class="text-center w-40">Código</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="modulo in modulos" :key="modulo.id">
                                <tr>
                                   
                                    <td class="p-3 border-b border-[#ebedf2] dark:border-[#191e3a] text-center text-white-dark">
                                        <div class="flex gap-4 items-center justify-center">
                                            <div>
                                                <Link :href="route('modulos.edit', modulo.identifier)" type="button" v-tippy:edit class="btn btn-sm btn-outline-success">
                                                    <icon-pencil class="w-4 h-4" />
                                                </Link>
                                                <tippy target="edit">Edit</tippy>
                                            </div>
                                            <div>
                                                <Link :href="route('modulos_permissions', modulo.identifier)"  type="button" v-tippy:permissions class="btn btn-sm btn-outline-primary">
                                                    <icon-menu-authentication class="w-4 h-4" />
                                                </Link>
                                                <tippy target="permissions">Permisos</tippy>
                                            </div>
                                            <div>
                                                <button @click="destroyModulo(modulo.identifier)"  type="button" v-tippy:delete class="btn btn-sm btn-outline-danger">
                                                    <icon-trash-lines class="w-4 h-4" />
                                                </button>
                                                <tippy target="delete">Delete</tippy>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ modulo.identifier }}</td>
                                    <td class="whitespace-nowrap">{{ modulo.description }}</td>
                                    <td class="whitespace-nowrap">
                                    <span  class="badge"
                                        :class="{
                                        'bg-success': modulo.status === 1,
                                        'bg-danger': modulo.status === 0,
                                        }"
                                    >
                                        {{ modulo.status ? 'Activo' : 'Inactivo' }}
                                    </span>
                                    </td>
                                
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout >
</template>