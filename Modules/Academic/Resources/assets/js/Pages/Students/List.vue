<script setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import { useForm, router, Link  } from '@inertiajs/vue3';
    import Pagination from '@/Components/Pagination.vue';
    import Keypad from '@/Components/Keypad.vue';
    import Swal2 from 'sweetalert2';
    import { ConfigProvider, Dropdown, Menu, MenuItem, Button } from 'ant-design-vue';
    import IconBox from '@/Components/vristo/icon/icon-box.vue';
    import IconUserPlus from '@/Components/vristo/icon/icon-user-plus.vue';
    import IconSearch from '@/Components/vristo/icon/icon-search.vue';

    import { useAppStore } from '@/stores/index';
    const store = useAppStore();

    const props = defineProps({
        students: {
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


</script>

<template>
    <AppLayout title="Estudiantes">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Estudiantes</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl">Estudiantes</h2>
                <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                    <div class="flex gap-3">
                        <div>
                            <Link :href="route('aca_students_create')" type="button" class="btn btn-primary">
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
                            @keyup.enter="form.get(route('aca_students_list'))"
                        />
                        <div class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">
                            <icon-search class="mx-auto" />
                        </div>
                    </div>
                </div>
            </div>
            <template v-if="students.data && students.data.length > 0">
                <ConfigProvider>
                    <div class="mt-5 p-0 border-0 overflow-hidden">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div v-for="(student, index) in students.data">
                                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex justify-end px-4 pt-4">
                                        <div class="dropdown">
                                            <Popper :placement="store.rtlClass === 'rtl' ? 'top-start' : 'top-end'" offsetDistance="0" class="align-middle">
                                                <button type="button" class="btn p-0 rounded-none border-0 shadow-none dropdown-toggle text-black dark:text-white-dark hover:text-primary dark:hover:text-primary">
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                                    </svg>
                                                </button>
                                                <template #content="{ close }">
                                                    <ul @click="close()" class="whitespace-nowrap">
                                                        <li>
                                                            <Link :href="route('aca_students_edit',student.id)" type="Button">
                                                                Editar
                                                            </Link>
                                                        </li>
                                                        <li v-can="'aca_estudiante_cobrar'">
                                                            <Link :href="route('aca_student_invoice',student.id)" type="Button" class="text-warning">
                                                                Cobrar
                                                            </Link>
                                                        </li>
                                                    </ul>
                                                </template>
                                            </Popper>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center pb-10">
                                        <template v-if="student.people_image">
                                            <img :src="student.people_image" style="width: 96px; height: 96px;" class="mb-3 rounded-full shadow-lg" :alt="student.full_name"/>
                                        </template>
                                        <template v-else>
                                            <img :src="'https://ui-avatars.com/api/?name='+student.full_name+'&size=96&rounded=true'" class="w-24 h-24 mb-3 rounded-full shadow-lg" :alt="student.full_name"/>
                                        </template>
                                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ student.number }}</h5>
                                        <span class="text-sm text-gray-500 dark:text-gray-400 p-2">{{ student.full_name }}</span>
                                        <div class="flex mt-4 space-x-3 mb-2 md:mt-6">
                                            <Link :href="route('aca_students_registrations_create',student.id)" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Matriculas</Link>
                                            <Link v-can="'aca_estudiante_certificados_crear'" :href="route('aca_students_certificates_create',student.id)" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Certificados</Link>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div>
                            <Pagination :data="students" />
                        </div>
                    </div>
                </ConfigProvider>
            </template>

            <template v-else>
                <div class="flex items-center p-4 mb-4 text-gray-800 border-t-2 border-gray-300 bg-white dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800" role="alert">
                    <span class="font-medium">Aun la tabla esta vacía</span> puede registrar datos.
                </div>
            </template>
        </div>
        
    </AppLayout>
</template>
