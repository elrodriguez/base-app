<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import Keypad from '@/Components/Keypad.vue';
    import Pagination from '@/Components/Pagination.vue';

    import Swal2 from "sweetalert2";
    import { Link, router } from '@inertiajs/vue3';
    import { faPencilAlt, faCheck, faTrashAlt, faPlus, faArrowRight } from "@fortawesome/free-solid-svg-icons";

    let selected_id;
    const props = defineProps({
        items: {
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

    const deleteForm = useForm({});

    const destroySection = (id) => {
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
                return axios.delete(route('cms_section_destroy', id)).then((res) => {
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
                router.visit(route('cms_section_list'), { replace: true, method: 'get' });
            }
        });
    }

    const selectItem =(item, id) =>{
        
            console.log("item seleccionado: "+item);
            const elements = document.getElementsByClassName("lix");
            for (let i = 0; i < elements.length; i++) {
                const element = elements[i];
                // Limpiar el contenido de clase actual
                element.className = "";
                // Agregar la clase "lix"
                element.className = "lix";
            }
            document.getElementById(id).className = "lix bg-blue-900";
            selected_id = id;
    }

    const addItem =(id) =>{
        
        document.getElementById("listDestino").insertAdjacentHTML("beforeend", document.getElementById(id).innerHTML);
}


</script>

<template>
    <AppLayout title="Resumen">
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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">CMS</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Secciones</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Items</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">
                <!-- ====== Table One Start -->
                <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
         
                    
 <div class="max-w-full overflow-x-auto">

        <div class="flex">
        <div class="w-full px-4">
            <div class="bg-white p-4 shadow-md rounded-lg">
            <h2 class="text-lg font-medium">Items Disponibles</h2>
            

        <ul id="listOrigen">

            <li id="li1" @click="selectItem('img', 'li1')" data-item="img" class="lix">
            <div class="hover:bg-blue-700 bg-blue-300 mr-2">
                <img src="/img/img.png" style="max-width: 30px;">
            <span>Imágen</span>
            </div>
        </li>

        <li  id="li2" @click="selectItem('header', 'li2')" data-item="header" class="lix">
            <div class="hover:bg-blue-700 bg-blue-300 mr-2">
                <img src="/img/header.png" style="max-width: 30px;">
            <span>Título</span>
            </div>
        </li>

        <li id="li3" @click="selectItem('sidebar', 'li3')" data-item="sidebar" class="lix">
            <div class="hover:bg-blue-700 bg-blue-300 mr-2">
                <img src="/img/sidebar.png" style="max-width: 30px;">
            <span>Sidebar</span>
            </div>
        </li>

        </ul>
            

            </div>
        </div>
        <div class="w-3 px-3">
                <button v-can="'cms_editor'" @click="addItem(selected_id)" type="button" class="mr-1 text-white bg-green-700 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                <font-awesome-icon :icon="faArrowRight" />
                </button>   
            </div>
        <div class="w-full px-4">
            <div class="bg-white p-4 shadow-md rounded-lg">
            <h2 class="text-lg font-medium">Items agregados</h2>
            <ul id="listDestino">

            </ul>
            </div>
        </div>
        </div>                       
</div>

                </div>
            </div>
        </div>
        
    </AppLayout>
</template>
