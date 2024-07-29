<script setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import { Link, useForm } from '@inertiajs/vue3';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import { ref, onMounted } from 'vue';
    import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';
    // import { quillEditor } from 'vue3-quill';
    // import 'vue3-quill/lib/vue3-quill.css';
    import Swal2 from 'sweetalert2';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import { useAppStore } from '@/stores/index';
    import SpinnerLoading from '@/Components/SpinnerLoading.vue';
    import IconClipboardText from '@/Components/vristo/icon/icon-clipboard-text.vue';
    import IconListCheck from '@/Components/vristo/icon/icon-list-check.vue';
    import IconThumbUp from '@/Components/vristo/icon/icon-thumb-up.vue';
    import IconStar from '@/Components/vristo/icon/icon-star.vue';
    import IconTrashLines from '@/Components/vristo/icon/icon-trash-lines.vue';
    import IconSquareRotated from '@/Components/vristo/icon/icon-square-rotated.vue';
    import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
    import IconMenu from '@/Components/vristo/icon/icon-menu.vue';
    import IconSearch from '@/Components/vristo/icon/icon-search.vue';
    import IconCaretDown from '@/Components/vristo/icon/icon-caret-down.vue';
    import IconUser from '@/Components/vristo/icon/icon-user.vue';
    import IconHorizontalDots from '@/Components/vristo/icon/icon-horizontal-dots.vue';
    import IconPencilPaper from '@/Components/vristo/icon/icon-pencil-paper.vue';
    import IconRestore from '@/Components/vristo/icon/icon-restore.vue';
    import IconX from '@/Components/vristo/icon/icon-x.vue';
    const props = defineProps({
        course: {
            type: Object,
            default: () => ({}),
        }
    });

    const dataModules = ref([]);
    const dataThemes = ref([]);
    const dataContents = ref([]);

    const defaultParams = ref({
        id: null,
        title: '',
        description: '',
        descriptionText: '',
        assignee: '',
        path: '',
        tag: '',
        priority: 'low',
    });

    const selectedTab = ref('');
    const isShowTaskMenu = ref(false);
    const displayThemeModal = ref(false);
    const displayModuleModal = ref(false);
    const viewTaskModal = ref(false);

    const contentForm = useForm({
        theme_name: null,
        theme_id: null,
        id: null,
        position: null,
        description: null,
        content: null,
        is_file: null
    });

    const themeForm = useForm({
        module_name: null,
        module_id: null,
        id: null,
        position: null,
        description: null,
    });

    const moduleForm = useForm({
        course_name: null,
        course_id: null,
        id: null,
        position: null,
        description: null,
    });

    const baseUrl = assetUrl;

    const getPath = (path) => {
        return baseUrl + 'storage/'+ path;
    }

    onMounted(() => {
        dataModules.value = props.course.modules;
        moduleForm.course_name = props.course.description;
        moduleForm.course_id = props.course.id;
    });

    const themesChanged = (module = null) => {
        themeForm.module_id = module.id;
        themeForm.module_name = module.description;
        dataThemes.value = module.themes;
        isShowTaskMenu.value = false;
        selectedTab.value = module.id;
    };


    const showMessage = (msg = '', type = 'success') => {
        const toast = Swal2.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            customClass: { container: 'toast' },
        });
        toast.fire({
            icon: type,
            title: msg,
            padding: '10px 20px',
        });
    };

    const newHeight = ref(280);

    const modifiedContent = (content) => {
        // Copia el contenido original
        let modifiedContent = content;

        // Realiza la sustitución de la altura con un valor dinámico
        modifiedContent = modifiedContent.replace(/height="\d+"/g, `height="${newHeight.value}"`);
        modifiedContent = modifiedContent.replace(/width="\d+"/g, `width="100%"`);
        return modifiedContent;
    };
    const btnThemeLoading = ref(false);
    const btnContentLoading = ref(false);
    const btnModuleLoading = ref(false);

    const saveContent = () => {
        btnContentLoading.value = true;
        axios.post(route('aca_courses_module_themes_content_store'), contentForm,{
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then((response) => {
            if(response.data.success){
                let newContent = response.data.content;
                return newContent;
            }else{
                contentForm.setError('content', response.data.errorPdf);
                throw new Error('Error en el contenido PDF');
            }
        }).then((result) => {
            dataContents.value.push(result);
            contentForm.reset(
                'id',
                'position',
                'description',
                'content',
                'is_file'
            );
            setTimeout(() => {
                btnContentLoading.value = false;
            });
        }).catch(error => {
            let validationErrors = error.response.data.errors;
            if (validationErrors && validationErrors.content) {
                const contentErrors = validationErrors.content;

                for (let i = 0; i < contentErrors.length; i++) {
                    contentForm.setError('content', contentErrors[i]);
                }
            }
            if (validationErrors && validationErrors.description) {
                const descriptionErrors = validationErrors.description;

                for (let i = 0; i < descriptionErrors.length; i++) {
                    contentForm.setError('description', descriptionErrors[i]);
                }
            }
            if (validationErrors && validationErrors.position) {
                const positionErrors = validationErrors.position;

                for (let i = 0; i < positionErrors.length; i++) {
                    contentForm.setError('position', positionErrors[i]);
                }
            }
            btnContentLoading.value = false;
        });
    }

    const deleteContent = (id, index) => {
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
                return axios.delete(route('aca_courses_module_themes_content_destroy', id)).then((res) => {
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
                dataContents.value.splice(index,1);
            }
        });

    }

    const closeModalTheme = () => {
        displayThemeModal.value = false;
    }

    const openModalTheme = (data = null) => {
        if(data){
            themeForm.id = data.id;
            themeForm.position = data.position;
            themeForm.description = data.description;
    
        }
        displayThemeModal.value = true;
    }

    const viewContents = (item = null) => {
        dataContents.value = item.contents;
        contentForm.theme_name = item.description;
        contentForm.theme_id = item.id;
        setTimeout(() => {
            viewTaskModal.value = true;
        });
    };

    const saveTheme = () => {
        btnThemeLoading.value = true;
        
        let urrl = route('aca_courses_module_themes_store');
        let metthod = 'POST';

        if(themeForm.id){
            urrl = route('aca_courses_module_themes_update',themeForm.id);
            metthod = 'PUT';
        }

        axios({
            method: metthod,
            url: urrl,
            data: themeForm
        }).then((response) => {
            let newContent = response.data.theme;

            return newContent;
        }).then((result) => {
            if(themeForm.id){
                replaceItemById(themeForm.id,result)
            }else{
                dataThemes.value.push(result);
            }
            themeForm.reset(
                'id',
                'position',
                'description',
            );
            setTimeout(() => {
                btnThemeLoading.value = false;
            });
        }).catch(function (error) {
            console.log(error)
            btnThemeLoading.value = false;
        });
        displayThemeModal.value = false;
    }

    const replaceItemById = (id, newItem = null) => {
        const index = dataThemes.value.findIndex(item => item.id === id);
        if (index !== -1) {
            if(newItem){
                dataThemes.value.splice(index, 1, newItem);
            }else{
                dataThemes.value.splice(index,1);
            }
        }
    }

    const deleteTheme = (id) => {
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
                return axios.delete(route('aca_courses_module_themes_destroy', id)).then((res) => {
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
                replaceItemById(id);
            }
        });
    }

    const closeModalModule = () => {
        displayModuleModal.value = false;
    }

    const openModalModule = (data = null) => {
        if(data){
            moduleForm.id = data.id;
            moduleForm.position = data.position;
            moduleForm.description = data.description;
    
        }
        displayModuleModal.value = true;
    }

    const saveModule = () => {
        btnModuleLoading.value = true;
        
        let urrl = route('aca_courses_module_store');
        let metthod = 'POST';

        if(moduleForm.id){
            urrl = route('aca_courses_module_update', moduleForm.id);
            metthod = 'PUT';
        }

        axios({
            method: metthod,
            url: urrl,
            data: moduleForm
        }).then((response) => {
            let newContent = response.data.module;

            return newContent;
        }).then((result) => {
            if(moduleForm.id){
                replaceModuleById(moduleForm.id, result)
            }else{
                dataModules.value.push(result);
            }
            moduleForm.reset(
                'id',
                'position',
                'description',
            );
            setTimeout(() => {
                btnModuleLoading.value = false;
            });
        }).catch(function (error) {
            console.log(error)
            btnModuleLoading.value = false;
        });
        displayModuleModal.value = false;
    }

    const replaceModuleById = (id, newItem = null) => {
        const index = dataModules.value.findIndex(item => item.id === id);
        if (index !== -1) {
            if(newItem){
                dataModules.value.splice(index, 1, newItem);
            }else{
                dataModules.value.splice(index,1);
            }
        }
    }

    const deleteModule = (id) => {
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
                return axios.delete(route('aca_courses_module_destroy', id)).then((res) => {
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
                replaceModuleById(id);
            }
        });
    }

    const handleFileChangeContent = (event) => {
      const file = event.target.files[0];
      if (file && file.type === 'application/pdf') {
        contentForm.content = file;
        contentForm.clearErrors();
      } else {
        contentForm.setError({
            content: 'Solo se permiten archivos PDF.',
        });
        event.target.value = null; // Resetea el campo de entrada si el archivo no es válido
      }
    }
</script>

<template>
    <AppLayout title="Cursos">
        <Navigation :routeModule="route('aca_dashboard')" :titleModule="'Académico'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('aca_courses_list')" class="text-primary hover:underline">Cursos</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <Link :href="route('aca_courses_edit', course.id)" class="text-primary hover:underline">{{ course.description }}</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Modulos</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div>
                <div class="flex gap-5 relative sm:h-[calc(100vh_-_150px)] h-full">
                    <div
                        class="panel p-4 flex-none w-[340px] max-w-full absolute xl:relative z-10 space-y-4 xl:h-auto h-full xl:block ltr:xl:rounded-r-md ltr:rounded-r-none rtl:xl:rounded-l-md rtl:rounded-l-none hidden"
                        :class="{ '!block': isShowTaskMenu }"
                    >
                        <div class="flex flex-col h-full pb-16">
                            <div class="pb-5">
                                <div class="flex text-center items-center">
                                    <div class="shrink-0">
                                        <icon-clipboard-text />
                                    </div>
                                    <h3 class="text-lg font-semibold ltr:ml-3 rtl:mr-3">Modulos</h3>
                                </div>
                            </div>
                            <div class="h-px w-full border-b border-[#e0e6ed] dark:border-[#1b2e4b] mb-5"></div>
                            <perfect-scrollbar
                                :options="{
                                    swipeEasing: true,
                                    wheelPropagation: false,
                                }"
                                class="relative ltr:pr-3.5 rtl:pl-3.5 ltr:-mr-3.5 rtl:-ml-3.5 h-full grow"
                            >
                                <div class="space-y-1">
                                    <div v-for="(module, index) in dataModules"
                                        type="button"
                                        class="w-full flex justify-between items-center h-10 p-1 hover:bg-white-dark/10 rounded-md dark:hover:bg-[#181F32] font-medium ltr:hover:pl-3 rtl:hover:pr-3 duration-300"
                                        :class="selectedTab === module.id ? 'ltr:pl-3 rtl:pr-3 bg-gray-100 dark:bg-[#181F32] text-primary' : 'text-success'"
                                    >
                                        <div  @click="themesChanged(module)" class="flex items-center" style="cursor: pointer;">
                                            <icon-square-rotated class="fill-success shrink-0" />
                                            <div class="text-left ltr:ml-3 rtl:mr-3">{{ module.description }}</div>
                                        </div>
                                        <div class="bg-primary-light dark:bg-[#060818] rounded-md py-0.5 px-2 font-semibold whitespace-nowrap">
                                            <div class="dropdown">
                                                <Popper
                                                    :placement="'bottom-start'"
                                                    offsetDistance="0"
                                                    class="align-middle"
                                                >
                                                    <a href="javascript:;">
                                                        <icon-horizontal-dots class="rotate-90 opacity-70" />
                                                    </a>
                                                    <template #content="{ close }">
                                                        <ul @click="close()" class="whitespace-nowrap">
                                                            <li>
                                                                <a href="javascript:;" @click="openModalModule(module)">
                                                                    <icon-pencil-paper class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0" />
                                                                    Editar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" @click="deleteModule(module.id)">
                                                                    <icon-trash-lines class="ltr:mr-2 rtl:ml-2 shrink-0" />
                                                                    Eliminar
                                                                </a>
                                                            </li>
                                                            <!-- <li>
                                                                <a href="javascript:;" @click="setImportant(module)">
                                                                    <icon-star class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0" />
                                                                    <span>
                                                                        Preguntas
                                                                    </span>
                                                                </a>
                                                            </li> -->
                                                        </ul>
                                                    </template>
                                                </Popper>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </perfect-scrollbar>
                            <div class="ltr:left-0 rtl:right-0 absolute bottom-0 p-4 w-full">
                                <button class="btn btn-primary w-full" type="button" @click="openModalModule()">
                                    <icon-plus class="ltr:mr-2 rtl:ml-2 shrink-0" />
                                    Nuevo Modulo
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="overlay bg-black/60 z-[5] w-full h-full rounded-md absolute hidden"
                        :class="{ '!block xl:!hidden': isShowTaskMenu }"
                        @click="isShowTaskMenu = !isShowTaskMenu"
                    ></div>
                    <div class="panel p-0 flex-1 overflow-auto h-full">
                        <div class="flex flex-col h-full">
                            <div class="p-4 flex sm:flex-row flex-col w-full sm:items-center gap-4">
                                <div class="ltr:mr-3 rtl:ml-3 flex items-center">
                                    <button type="button" class="xl:hidden hover:text-primary block ltr:mr-3 rtl:ml-3" @click="isShowTaskMenu = !isShowTaskMenu">
                                        <icon-menu />
                                    </button>
                                    <!-- <div class="relative group flex-1">
                                        <input
                                            type="text"
                                            class="form-input peer ltr:!pr-10 rtl:!pl-10"
                                            placeholder="Search Task..."
                                            v-model="searchTask"
                                            @keyup="searchTasks()"
                                        />
                                        <div class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">
                                            <icon-search />
                                        </div>
                                    </div> -->
                                </div>
                                <div class="flex items-center justify-center sm:justify-end sm:flex-auto flex-1">
                                    <button @click="openModalTheme" type="button" class="btn btn-outline-primary">Nuevo tema</button>
                                </div>
                            </div>
                            <div class="h-px w-full border-b border-[#e0e6ed] dark:border-[#1b2e4b]"></div>
                            <template v-if="dataThemes.length">
                                <div class="table-responsive grow overflow-y-auto sm:min-h-[300px] min-h-[400px]">
                                    <table class="table-hover">
                                        <tbody>
                                            <template v-for="(theme, key) in dataThemes" :key="theme.id">
                                                <tr class="group cursor-pointer" :class="{ 'bg-white-light/30 dark:bg-[#1a2941]': theme.status === 'complete' }">
                                                    <td class="w-1 text-center text-danger" :class="{ 'text-warning': theme.contents.length > 0 }">
                                                        {{ theme.position }}
                                                    </td>
                                                    <td>
                                                        <div @click="viewContents(theme)"
                                                                class="group-hover:text-primary font-semibold text-sm text-danger"
                                                                :class="{ 'text-warning': theme.contents.length > 0 }"
                                                            >
                                                                {{ theme.description }}
                                                        </div>
                                                    </td>
                                                    
                                                    <td class="w-1">
                                                        <div class="flex items-center justify-between w-max">
                                                            
                                                            <div class="dropdown">
                                                                <Popper
                                                                    :placement="'bottom-start'"
                                                                    offsetDistance="0"
                                                                    class="align-middle"
                                                                >
                                                                    <a href="javascript:;">
                                                                        <icon-horizontal-dots class="rotate-90 opacity-70" />
                                                                    </a>
                                                                    <template #content="{ close }">
                                                                        <ul @click="close()" class="whitespace-nowrap">
                                                                            <li>
                                                                                <a href="javascript:;" @click="openModalTheme(theme)">
                                                                                    <icon-pencil-paper class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0" />
                                                                                    Editar
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:;" @click="deleteTheme(theme.id)">
                                                                                    <icon-trash-lines class="ltr:mr-2 rtl:ml-2 shrink-0" />
                                                                                    Eliminar
                                                                                </a>
                                                                            </li>
                                                                            <!-- <li>
                                                                                <a href="javascript:;" @click="setImportant(theme)">
                                                                                    <icon-star class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0" />
                                                                                    <span>
                                                                                        Preguntas
                                                                                    </span>
                                                                                </a>
                                                                            </li> -->
                                                                        </ul>
                                                                    </template>
                                                                </Popper>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </template>
                            <template v-else>
                                <div class="flex justify-center items-center sm:min-h-[300px] min-h-[400px] font-semibold text-lg h-full">No data available</div>
                            </template>
                        </div>
                    </div>

                    <TransitionRoot appear :show="displayThemeModal" as="template">
                        <Dialog as="div" @close="closeModalTheme" class="relative z-[51]">
                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                            </TransitionChild>

                            <div class="fixed inset-0 overflow-y-auto">
                                <div class="flex min-h-full items-center justify-center px-4 py-8">
                                    <TransitionChild
                                        as="template"
                                        enter="duration-300 ease-out"
                                        enter-from="opacity-0 scale-95"
                                        enter-to="opacity-100 scale-100"
                                        leave="duration-200 ease-in"
                                        leave-from="opacity-100 scale-100"
                                        leave-to="opacity-0 scale-95"
                                    >
                                        <DialogPanel class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                            <button
                                                type="button"
                                                class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                @click="closeModalTheme"
                                            >
                                                <icon-x />
                                            </button>
                                            <div class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                {{ themeForm.id ? 'Editar tema' : 'Nuevo tema' }}
                                            </div>
                                            <div class="p-5">
                                                <form @submit.prevent="saveTheme">
                                                    <div class="space-y-4">
                                                        <div class="">
                                                            <label>Posición</label>
                                                            <input v-model="themeForm.position" id="themposition" type="text" class="form-input" placeholder="Posición" />
                                                        </div>
                                                        <div class="">
                                                            <label>Descripción</label>
                                                            <textarea v-model="themeForm.description" id="themdescription" type="text" class="form-input" placeholder="Descripción" rows="4" ></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="ltr:text-right rtl:text-left flex justify-end items-center mt-8 space-x-4">
                                                        <PrimaryButton @click="saveTheme" :class="{ 'opacity-25': btnThemeLoading }" :disabled="btnThemeLoading">
                                                            <SpinnerLoading :display="btnThemeLoading" /> 
                                                            Cuardar
                                                        </PrimaryButton>
                                                        <SecondaryButton type="button" @click="closeModalTheme">Cerrar</SecondaryButton>
                                                    </div>
                                                </form>
                                            </div>
                                        </DialogPanel>
                                    </TransitionChild>
                                </div>
                            </div>
                        </Dialog>
                    </TransitionRoot>

                    <TransitionRoot appear :show="viewTaskModal" as="template">
                        <Dialog as="div" @close="viewTaskModal = false" class="relative z-[51]">
                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                            </TransitionChild>

                            <div class="fixed inset-0 overflow-y-auto">
                                <div class="flex min-h-full items-center justify-center px-4 py-8">
                                    <TransitionChild
                                        as="template"
                                        enter="duration-300 ease-out"
                                        enter-from="opacity-0 scale-95"
                                        enter-to="opacity-100 scale-100"
                                        leave="duration-200 ease-in"
                                        leave-from="opacity-100 scale-100"
                                        leave-to="opacity-0 scale-95"
                                    >
                                        <DialogPanel class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-2xl text-black dark:text-white-dark">
                                            <button
                                                type="button"
                                                class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                @click="viewTaskModal = false"
                                            >
                                                <icon-x />
                                            </button>
                                            <div class="flex items-center flex-wrap gap-2 text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                <div>{{ contentForm.theme_name }}</div>
                                            </div>
                                            <div class="p-5">
                                                <div class="space-y-5">
                                                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                                                        <div class="sm:col-span-1">
                                                            <input v-model="contentForm.position" id="conposition" type="text" class="form-input" placeholder="Posición" />
                                                            <div class="text-danger mt-1" v-if="contentForm.errors.position">{{ contentForm.errors.position }}</div>
                                                        </div>
                                                        <div class="sm:col-span-1">
                                                            <select v-model="contentForm.is_file" id="ctnSelect2" class="form-select text-white-dark" required>
                                                                <option value="">Seleccionar</option>
                                                                <option value="1">Link de archivo</option>
                                                                <option value="0">frame de vídeo</option>
                                                                <option value="2">Subir Archivo</option>
                                                            </select>
                                                            <div class="text-danger mt-1" v-if="contentForm.errors.is_file">{{ contentForm.errors.is_file }}</div>
                                                        </div>
                                                        <div class="sm:col-span-2">
                                                            <input v-model="contentForm.description" id="condescription" type="text" class="form-input" placeholder="Descripción" />
                                                            <div class="text-danger mt-1" v-if="contentForm.errors.description">{{ contentForm.errors.description }}</div>
                                                        </div>
                                                        <div v-if="contentForm.is_file == 2" class="sm:col-span-4">
                                                            <label for="ctnFile">Archivo</label>
                                                            <input @change="handleFileChangeContent" id="ctnFile" type="file" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" required />
                                                            <div class="text-danger mt-1" v-if="contentForm.errors.content">{{ contentForm.errors.content }}</div>
                                                        </div>
                                                        <div v-else class="sm:col-span-4">
                                                            <textarea v-model="contentForm.content" id="concontent" rows="3" class="form-textarea" placeholder="Contenido" quired></textarea>
                                                            <div class="text-danger mt-1" v-if="contentForm.errors.content">{{ contentForm.errors.content }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="dataContents.length > 0" class="mt-4 p-4 h-64 overflow-y-auto" >
                                                    
                                                    <ol class="relative border-s border-gray-200 dark:border-gray-700"> 
                                                        <li v-for="(conte, hy) in dataContents"class="mb-10 ms-6">
                                                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                                                <svg v-if="conte.is_file == 0" class="w-3 h-3 text-blue-800 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                                    <path d="M256 0L576 0c35.3 0 64 28.7 64 64l0 224c0 35.3-28.7 64-64 64l-320 0c-35.3 0-64-28.7-64-64l0-224c0-35.3 28.7-64 64-64zM476 106.7C471.5 100 464 96 456 96s-15.5 4-20 10.7l-56 84L362.7 169c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6l80 0 48 0 144 0c8.9 0 17-4.9 21.2-12.7s3.7-17.3-1.2-24.6l-96-144zM336 96a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM64 128l96 0 0 256 0 32c0 17.7 14.3 32 32 32l128 0c17.7 0 32-14.3 32-32l0-32 160 0 0 64c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 192c0-35.3 28.7-64 64-64zm8 64c-8.8 0-16 7.2-16 16l0 16c0 8.8 7.2 16 16 16l16 0c8.8 0 16-7.2 16-16l0-16c0-8.8-7.2-16-16-16l-16 0zm0 104c-8.8 0-16 7.2-16 16l0 16c0 8.8 7.2 16 16 16l16 0c8.8 0 16-7.2 16-16l0-16c0-8.8-7.2-16-16-16l-16 0zm0 104c-8.8 0-16 7.2-16 16l0 16c0 8.8 7.2 16 16 16l16 0c8.8 0 16-7.2 16-16l0-16c0-8.8-7.2-16-16-16l-16 0zm336 16l0 16c0 8.8 7.2 16 16 16l16 0c8.8 0 16-7.2 16-16l0-16c0-8.8-7.2-16-16-16l-16 0c-8.8 0-16 7.2-16 16z"/>
                                                                </svg>
                                                                <svg v-else class="w-3 h-3 text-blue-800 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                                                    <path d="M320 464c8.8 0 16-7.2 16-16l0-288-80 0c-17.7 0-32-14.3-32-32l0-80L64 48c-8.8 0-16 7.2-16 16l0 384c0 8.8 7.2 16 16 16l256 0zM0 64C0 28.7 28.7 0 64 0L229.5 0c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3L384 448c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64z"/>
                                                                </svg>
                                                            </span>
                                                            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                                                <div class="items-center justify-between mb-3 sm:flex">
                                                                    <a @click="deleteContent(conte.id,hy)" href="#" class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">Eliminar</a>
                                                                    <div class="text-sm font-normal text-gray-500 lex dark:text-gray-300">{{ conte.description }}</div>
                                                                </div>
                                                                <template v-if="conte.is_file == 0" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                                                    <div v-html="modifiedContent(conte.content)" class="m-0"></div>
                                                                </template>
                                                                <a v-else-if="conte.is_file == 1" :href="conte.content" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                                                    <svg class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                                                                        <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                                                                    </svg> Descargar Archivo
                                                                </a>
                                                                <a v-else :href="getPath(conte.content)" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                                                    <svg class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                                                                        <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                                                                    </svg> Descargar Archivo
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </ol>
                                                    
                                                </div>
                                                <div class="flex justify-end items-center mt-8 space-x-2">
                                                    <PrimaryButton @click="saveContent" :class="{ 'opacity-25': btnContentLoading }" :disabled="btnContentLoading">
                                                        <SpinnerLoading :display="btnContentLoading" /> 
                                                        Cuardar Contenido
                                                    </PrimaryButton>
                                                    <SecondaryButton type="button" @click="viewTaskModal = false">Cerrar</SecondaryButton>
                                                </div>
                                            </div>
                                        </DialogPanel>
                                    </TransitionChild>
                                </div>
                            </div>
                        </Dialog>
                    </TransitionRoot>

                    <TransitionRoot appear :show="displayModuleModal" as="template">
                        <Dialog as="div" @close="closeModalModule" class="relative z-[51]">
                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                            </TransitionChild>

                            <div class="fixed inset-0 overflow-y-auto">
                                <div class="flex min-h-full items-center justify-center px-4 py-8">
                                    <TransitionChild
                                        as="template"
                                        enter="duration-300 ease-out"
                                        enter-from="opacity-0 scale-95"
                                        enter-to="opacity-100 scale-100"
                                        leave="duration-200 ease-in"
                                        leave-from="opacity-100 scale-100"
                                        leave-to="opacity-0 scale-95"
                                    >
                                        <DialogPanel class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                            <button
                                                type="button"
                                                class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                @click="closeModalModule"
                                            >
                                                <icon-x />
                                            </button>
                                            <div class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                {{ moduleForm.id ? 'Editar Modulo' : 'Nuevo Modulo' }}
                                            </div>
                                            <div class="p-5">
                                                <form>
                                                    <div class="space-y-4">
                                                        <div class="">
                                                            <label>Posición</label>
                                                            <input v-model="moduleForm.position" id="modposition" type="text" class="form-input" placeholder="Posición" />
                                                        </div>
                                                        <div class="">
                                                            <label>Descripción</label>
                                                            <textarea v-model="moduleForm.description" id="moddescription" type="text" class="form-input" placeholder="Descripción" rows="4" ></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="ltr:text-right rtl:text-left flex justify-end items-center mt-8 space-x-4">
                                                        <PrimaryButton @click="saveModule" :class="{ 'opacity-25': btnModuleLoading }" :disabled="btnModuleLoading">
                                                            <SpinnerLoading :display="btnModuleLoading" /> 
                                                            Cuardar
                                                        </PrimaryButton>
                                                        <SecondaryButton type="button" @click="closeModalModule">Cerrar</SecondaryButton>
                                                    </div>
                                                </form>
                                            </div>
                                        </DialogPanel>
                                    </TransitionChild>
                                </div>
                            </div>
                        </Dialog>
                    </TransitionRoot>
                </div>
            </div>
        </div>
    </AppLayout>
</template>