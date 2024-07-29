<script setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import Keypad from '@/Components/Keypad.vue';
    import Pagination from '@/Components/Pagination.vue';
    import Swal2 from "sweetalert2";
    import { Link, router, useForm } from '@inertiajs/vue3';
    import { faXmark, faGears, faTrashAlt, faCheck, faSpellCheck, faDownload, faPlay, faFile, faFilm } from "@fortawesome/free-solid-svg-icons";
    import ModalLarge from '@/Components/ModalLarge.vue';
    import { ref } from 'vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import InputError from '@/Components/InputError.vue';
    import { ConfigProvider, Dropdown,Menu,MenuItem,Button } from 'ant-design-vue';
    import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
    import IconSearch from '@/Components/vristo/icon/icon-search.vue';

    const props = defineProps({
        courses: {
            type: Object,
            default: () => ({}),
        },
        institutions: {
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

    const destroyCourse = (id) => {
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
            preConfirm: () => {
                return axios.delete(route('aca_courses_destroy', id)).then((res) => {
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
                });
                router.visit(route('aca_courses_list'), {
                    replace: false, 
                    method: 'get',
                    preserveState: true,
                    preserveScroll: true,
                });
            }
        });
    }

    const destroyAgreement = (id) => {
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
                return axios.delete(route('aca_agreements_destroy', id)).then((res) => {
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
                getAgreements(formAgreement.course_id);
            }
        });
    }

    const formAgreement = useForm({
        course_id: null,
        course_name: null,
        institution_id: null,
        start_date: null,
        end_date: null,
        status: null,
        details:[]
    });

    const displayModalAgreements = ref(false);
    const arrayAgreements = ref([]);

    const openModalAgreements = (course) => {
        formAgreement.course_id = course.id;
        formAgreement.course_name = course.description;

        getAgreements(course.id);

        displayModalAgreements.value = true;
    }

    const closeModalAgreements = () => {
        displayModalAgreements.value = false;
        formAgreement.reset();
    }

    const saveAgreements = () => {
        formAgreement.progress = true;
        axios.post(route('aca_agreements_store'), formAgreement ).then((res) => {
            
            formAgreement.progress = false;
            Swal2.fire({
                title: 'Enhorabuena',
                text: 'Se registró correctamente',
                icon: 'success',
                padding: '2em',
                customClass: 'sweet-alerts',
            });
            getAgreements(formAgreement.course_id);
            formAgreement.reset('institution_id', 'start_date','end_date')
            formAgreement.clearErrors();
        }).catch(function (error) {
            if (error.response.status === 422) {
                // Obtén los errores del objeto de respuesta JSON
                const errors = error.response.data.errors;

                for (let field in errors) {
                    formAgreement.setError(field, errors[field][0]);
                }
                
            }
            formAgreement.progress = false;
        });
    }

    const getAgreements = (id) => {
        axios.get(route('aca_agreements_list', id) ).then((res) => {
            arrayAgreements.value = res.data.agreements;
        });
    }

const dataModule = ref({});

const openModalModules = (course) =>{
    dataModule.value = {
        course_id: course.id,
        name_course: course.description,
        modules: course.modules
    };
}
const baseUrl = assetUrl;

const getImage = (path) => {
    return baseUrl + 'storage/'+ path;
}

const dataModalContent = ref(null);
const selectTheme = (data) => {
    dataModalContent.value = data;
}
</script>

<template>
    <AppLayout title="Cursos">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Cursos</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl">Cursos</h2>
                <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                    <div class="flex gap-3">
                        <div>
                            <Link :href="route('aca_courses_create')" type="button" class="btn btn-primary">
                                <icon-plus class="ltr:mr-2 rtl:ml-2" />
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
                            @keyup.enter="form.get(route('aca_courses_list'))"
                        />
                        <div class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">
                            <icon-search class="mx-auto" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 panel p-0 border-0 overflow-hidden">
                <div class="table-responsive">
                    <ConfigProvider>
                        <table class="table-striped table-hover">
                            <thead>
                                <tr class="!text-center">
                                    <th>
                                        Acciones
                                    </th>
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Sector
                                    </th>
                                    <th>
                                        Tipo
                                    </th>
                                    <th>
                                        Modalidad
                                    </th>
                                    <th>
                                        Estado
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(course, index) in courses.data" :key="course.id">
                                    <tr>
                                        <td class="text-center">
                                            <Dropdown :placement="'bottomLeft'">
                                                <button class="border py-1.5 px-2 dropdown-button inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm" type="button">
                                                    <font-awesome-icon :icon="faGears" />
                                                </button>
                                                <template #overlay>
                                                <Menu>
                                                    <MenuItem>
                                                        <Link :href="route('aca_courses_edit',course.id)" class="dark:text-gray-200 dark:hover:text-white">Editar</Link>
                                                    </MenuItem>
                                                    <MenuItem>
                                                        <Link :href="route('aca_courses_information',course.id)" class="dark:text-gray-200 dark:hover:text-white">Información</Link>
                                                    </MenuItem>
                                                    <MenuItem>
                                                        <a @click="openModalAgreements(course)" href="#" class="dark:text-gray-200 dark:hover:text-white">Convenios</a>
                                                    </MenuItem>
                                                    <MenuItem>
                                                        <Link :href="route('aca_courses_module_panel',course.id)" class="dark:text-gray-200 dark:hover:text-white">Módulos</Link>
                                                    </MenuItem>
                                                    <MenuItem>
                                                        <a @click="destroyCourse(course.id)" href="#" class="text-red-700 dark:text-gray-200 dark:hover:text-white">Eliminar</a>
                                                    </MenuItem>
                                                </Menu>
                                                </template>
                                            </Dropdown>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ course.description }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ course.category.description }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ course.type_description }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <template v-if="course.modality">
                                                {{ course.modality.description }}
                                            </template>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span v-if="course.status" class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Activo</span>
                                            <span v-else class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">Inactivo</span>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <Pagination :data="courses" />
                    </ConfigProvider>
                </div>
                    
            </div>
        </div>
        
        <ModalLarge
            :onClose = "closeModalAgreements"
            :show="displayModalAgreements"
            :icon="'/img/convenio.png'"
        >
            <template #title>
                Convenio
            </template>
            <template #message>{{ formAgreement.course_name }}</template>
            <template #content>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-2">
                        <label for="institution" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">institución</label>
                        <select v-model="formAgreement.institution_id" id="institution" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option v-for="(institution) in institutions" :value="institution.id">{{ institution.name }}</option>
                        </select>
                        <InputError :message="formAgreement.errors.institution_id" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="star_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Incio</label>
                        <input v-model="formAgreement.start_date" type="date" id="star_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required>
                        <InputError :message="formAgreement.errors.start_date" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Termino</label>
                        <input v-model="formAgreement.end_date" type="date" id="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required>
                        <InputError :message="formAgreement.errors.end_date" class="mt-2" />
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="border p-4" v-for="(xagreement) in arrayAgreements">
                            <div class="flex justify-end">
                                <button @click="destroyAgreement(xagreement.id)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <font-awesome-icon :icon="faTrashAlt" />
                                </button>
                            </div>
                            <img class="h-auto max-w-full rounded-lg" :src="xagreement.institution.image" :alt="xagreement.institution.name">
                        </div>
                    </div>
                </div>
            </template>
            <template #buttons>
                <progress v-if="formAgreement.progress" :value="formAgreement.progress.percentage" max="100" class="mr-2">
                    {{ formAgreement.progress.percentage }}%
                </progress>
                <DangerButton
                    :class="{ 'opacity-25': formAgreement.processing }" :disabled="formAgreement.processing"
                    class="mr-3"
                    @click="saveAgreements()"
                >
                Guardar
            </DangerButton>
            </template>
        </ModalLarge>
    </AppLayout>
</template>
