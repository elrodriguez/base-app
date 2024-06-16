<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import { useForm, router, Link  } from '@inertiajs/vue3';
    import { faTrashAlt, faPencilAlt, faPrint, faCashRegister, faFileExcel, faMoneyBill1Wave} from "@fortawesome/free-solid-svg-icons";
    import Pagination from '@/Components/Pagination.vue';
    import { Dropdown } from 'flowbite-vue'
    import IconSearch from '@/Components/vristo/icon/icon-search.vue';
    import swal from 'sweetalert2';
    import IconBox from '@/Components/vristo/icon/icon-box.vue';
    import IconUserPlus from '@/Components/vristo/icon/icon-user-plus.vue';

    const props = defineProps({
        teachers: {
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


    const destroyTeacher = (id) => {
        swal.fire({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Eliminar!',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return axios.delete(route('aca_teachers_destroy', id)).then((res) => {
                    if (!res.data.success) {
                        swal.showValidationMessage(res.data.message)
                    }
                    return res
                });
            },
            allowOutsideClick: () => !swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                swal.fire({
                    title: 'Enhorabuena',
                    text: 'Se Eliminó correctamente',
                    icon: 'success',
                });
                router.visit(route('aca_teachers_list'), { replace: true, method: 'get' });
            }
        });
    }
</script>

<template>
    <AppLayout title="Docentes">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Docentes</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl">Docentes</h2>
                <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                    <div class="flex gap-3">
                        <div>
                            <Link :href="route('aca_teachers_create')" type="button" class="btn btn-primary">
                                <icon-user-plus class="ltr:mr-2 rtl:ml-2" />
                                Nuevo
                            </Link>
                        </div>
                    </div>

                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Buscar"
                            class="form-input py-2 ltr:pr-11 rtl:pl-11 peer"
                            v-model="form.search"
                            @keyup.enter="form.get(route('aca_teachers_list'))"
                        />
                        <div class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">
                            <icon-search class="mx-auto" />
                        </div>
                    </div>
                </div>
            </div>

            <template v-if="teachers.data && teachers.data.length > 0">
                <div class="mt-5 p-0 border-0 overflow-hidden">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div v-for="(teacher, index) in teachers.data">
                                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex justify-end px-4 pt-4">
                                        <dropdown>
                                            <template #trigger="{ toggle }">
                                                <button class="dropdown-button inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button" @click="toggle">
                                                    <span class="sr-only">Open dropdown</span>
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                                    </svg>
                                                </button>
                                            </template>
                                            <div class="dropdown-div z-10 absolute text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                <ul class="py-2">
                                                    <li>
                                                        <Link :href="route('aca_teachers_edit',teacher.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Editar</Link>
                                                    </li>
                                                    <li>
                                                        <a @click="destroyTeacher(teacher.id)" href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Eliminar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </dropdown>
                                    </div>
                                    
                                    <div class="flex flex-col items-center pb-10">
                                        <template v-if="teacher.people_image">
                                            <img :src="teacher.people_image" style="width: 96px; height: 96px;" class="mb-3 rounded-full shadow-lg" :alt="teacher.full_name"/>
                                        </template>
                                        <template v-else>
                                            <img :src="'https://ui-avatars.com/api/?name='+teacher.full_name+'&size=96&rounded=true'" class="w-24 h-24 mb-3 rounded-full shadow-lg" :alt="teacher.full_name"/>
                                        </template>
                                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ teacher.number }}</h5>
                                        <span class="text-sm text-gray-500 dark:text-gray-400 p-2">{{ teacher.full_name }}</span>
                                        <div class="flex mt-4 space-x-3 mb-2 md:mt-6">
                                            <Link :href="route('aca_teachers_resume',teacher.id)" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Currículum</Link>
                                            <!-- <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Ver detalles</a> -->
                                        </div>
                                    </div>
                                </div>
                        </div> 
                    </div>
                    <div>
                        <Pagination :data="teachers" />
                    </div>
                </div>
                </template>
                
                <template v-else>
                    <div class="mt-5">
                        <div
                            class="
                                h-16
                                relative
                                flex
                                items-center
                                border
                                p-3.5
                                rounded
                                before:inline-block before:absolute before:top-1/2
                                ltr:before:right-0
                                rtl:before:left-0 rtl:before:rotate-180
                                before:-mt-2 before:border-r-8 before:border-t-8 before:border-b-8 before:border-t-transparent before:border-b-transparent before:border-r-inherit
                                text-danger
                                bg-danger-light
                                border-danger
                                ltr:border-r-[64px]
                                rtl:border-l-[64px]
                                dark:bg-danger-dark-light
                            "
                            >
                            <span class="absolute ltr:-right-11 rtl:-left-11 inset-y-0 text-white w-6 h-6 m-auto">
                                <icon-box />
                            </span>
                            <span class="ltr:pr-2 rtl:pl-2">
                                <strong class="ltr:mr-1 rtl:ml-1">Tabla vacía!</strong>No existen registros para mostrar.
                            </span>
                        </div>
                    </div>
                </template>
            
        </div>
    </AppLayout>
</template>
