<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { ref, onMounted } from 'vue';
    
    import Swal from 'sweetalert2';
    import { faPerson, faPersonDress } from "@fortawesome/free-solid-svg-icons";
    import IconUserPlus from '@/Components/vristo/icon/icon-user-plus.vue';
    import IconListCheck from '@/Components/vristo/icon/icon-list-check.vue';
    import IconLayoutGrid from '@/Components/vristo/icon/icon-layout-grid.vue';
    import IconSearch from '@/Components/vristo/icon/icon-search.vue';
    import IconFacebook from '@/Components/vristo/icon/icon-facebook.vue';
    import IconInstagram from '@/Components/vristo/icon/icon-instagram.vue';
    import IconLinkedin from '@/Components/vristo/icon/icon-linkedin.vue';
    import IconTwitter from '@/Components/vristo/icon/icon-twitter.vue';
    import IconBox from '@/Components/vristo/icon/icon-box.vue';
    import { useForm, Link } from '@inertiajs/vue3';


    const props = defineProps({
        doctors: {
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

    const displayType = ref('list');
    const addContactModal = ref(false);
    const baseUrl = assetUrl;

    const getImage = (path) => {
        return baseUrl + 'storage/'+ path;
    }

    const searchContacts = () => {
        form.get(route('heal_doctors_list'));
    };

    const saveUser = () => {


    };

    const deleteUser = (user = null) => {

    };

    const showMessage = (msg = '', type = 'success') => {
        const toast = Swal.mixin({
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
</script>
<template>
    <AppLayout title="Pacientes">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Salud</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Doctores</span>
            </li>
        </ul>
        <div class="pt-5">
            
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h2 class="text-xl">Doctores</h2>
            <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                <div class="flex gap-3">
                    <div>
                        <Link :href="route('heal_doctors_create')" type="button" class="btn btn-primary">
                            <icon-user-plus class="ltr:mr-2 rtl:ml-2" />
                            Nuevo
                        </Link>
                    </div>
                    <div>
                        <button
                            type="button"
                            class="btn btn-outline-primary p-2"
                            :class="{ 'bg-primary text-white': displayType === 'list' }"
                            @click="displayType = 'list'"
                        >
                            <icon-list-check />
                        </button>
                    </div>
                    <div>
                        <button
                            type="button"
                            class="btn btn-outline-primary p-2"
                            :class="{ 'bg-primary text-white': displayType === 'grid' }"
                            @click="displayType = 'grid'"
                        >
                            <icon-layout-grid />
                        </button>
                    </div>
                </div>

                <div class="relative">
                    <input
                        type="text"
                        placeholder="Buscar doctor"
                        class="form-input py-2 ltr:pr-11 rtl:pl-11 peer"
                        v-model="form.search"
                        @keyup="searchContacts"
                    />
                    <div class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">
                        <icon-search class="mx-auto" />
                    </div>
                </div>
            </div>
        </div>
        <template v-if="doctors.data.length">

            <div class="mt-5 panel p-0 border-0 overflow-hidden">
                <template v-if="displayType === 'list'">
                    <div class="table-responsive">
                        <table class="table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="!text-center">Acciones</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Género</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="contact in doctors.data" :key="contact.id">
                                    <tr>
                                        <td>
                                            <div class="flex gap-4 items-center justify-center">
                                                <Link :href="route('heal_doctors_edit',contact.person_id)" type="button" class="btn btn-sm btn-outline-primary">Editar</Link>
                                                <button type="button" class="btn btn-sm btn-outline-danger" @click="deleteUser(contact.person_id)">Eliminar</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex items-center w-max">
                                                <div class="w-max">
                                                    <img v-if="contact.image"
                                                        :src="getImage(contact.image)"
                                                        class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"
                                                        alt="avatar"
                                                    />
                                                    <img v-else :src="'https://ui-avatars.com/api/?name='+contact.full_name+'&size=54&rounded=true'" class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2" :alt="contact.full_name"/>
                                                </div>
                                                <div>{{ contact.full_name }}</div>
                                            </div>
                                        </td>
                                        <td>{{ contact.email }}</td>
                                        <td class="whitespace-nowrap">{{ contact.address }}</td>
                                        <td class="whitespace-nowrap">{{ contact.telephone }}</td>
                                        <td class="whitespace-nowrap text-center">
                                            <div class="" >
                                                <template v-if="contact.gender == 'M'">
                                                    <font-awesome-icon :icon="faPerson" class="w-6 h-6 text-success" /> 
                                                </template> 
                                                <template v-else>
                                                    <font-awesome-icon :icon="faPersonDress" class="w-6 h-6 text-primary" /> 
                                                </template> 
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </template>
            </div>
            <template v-if="displayType === 'grid'">
                <div class="grid 2xl:grid-cols-4 xl:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6 w-full">
                    <template v-for="contact in doctors.data" :key="contact.id">
                        <div class="bg-white dark:bg-[#1c232f] rounded-md overflow-hidden text-center shadow relative">
                            <div class="bg-white/40 rounded-t-md  bg-center bg-cover p-6 pb-0"
                            :style="`background-image:url('${baseUrl}/themes/vristo/images/notification-bg.png');`"
                            >
                                <template v-if="contact.image">
                                    <img class="object-contain w-4/5 max-h-40 mx-auto" :src="`${baseUrl}/storage/${contact.image}`" />
                                </template>
                                <template v-else>
                                    <img :src="'https://ui-avatars.com/api/?name='+contact.full_name+'&size=800&rounded=false'" class="object-contain w-4/5 max-h-40 mx-auto" :alt="contact.full_name"/>
                                </template>
                            </div>
                            <div class="px-6 pb-24 -mt-10 relative">
                                <div class="shadow-md bg-white dark:bg-gray-900 rounded-md px-2 py-4">
                                    <div class="text-xl">{{ contact.full_name }}</div>
                                    <div class="text-white-dark">{{ contact.email }}</div>
                                    <!-- <div class="flex items-center justify-between flex-wrap mt-6 gap-3">
                                        <div class="flex-auto">
                                            <div class="text-info">{{ contact.posts }}</div>
                                            <div>Posts</div>
                                        </div>
                                        <div class="flex-auto">
                                            <div class="text-info">{{ contact.following }}</div>
                                            <div>Following</div>
                                        </div>
                                        <div class="flex-auto">
                                            <div class="text-info">{{ contact.followers }}</div>
                                            <div>Followers</div>
                                        </div>
                                    </div> -->
                                    <div class="mt-4">
                                        <ul class="flex space-x-4 rtl:space-x-reverse items-center justify-center">
                                            <li>
                                                <a href="javascript:;" class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">
                                                    <icon-facebook />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">
                                                    <icon-instagram />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">
                                                    <icon-linkedin />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">

                                                <icon-twitter />
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mt-6 grid grid-cols-1 gap-4 ltr:text-left rtl:text-right">
                                    <div class="flex items-center">
                                        <div class="flex-none ltr:mr-2 rtl:ml-2">Email :</div>
                                        <div class="truncate text-white-dark">{{ contact.email }}</div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex-none ltr:mr-2 rtl:ml-2">Phone :</div>
                                        <div class="text-white-dark">{{ contact.telephone }}</div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex-none ltr:mr-2 rtl:ml-2">Address :</div>
                                        <div class="text-white-dark">{{ contact.address }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex gap-4 absolute bottom-0 w-full ltr:left-0 rtl:right-0 p-6">
                                <Link :href="route('heal_doctors_edit',contact.person_id)" type="button" class="btn btn-outline-primary w-1/2">Editar</Link>
                                <button type="button" class="btn btn-outline-danger w-1/2" @click="deleteUser(contact.id)">Eliminar</button>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
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