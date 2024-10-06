<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { ref, onMounted } from 'vue';
    import Swal from 'sweetalert2';
    import ModalLarge from '@/Components/ModalLarge.vue';
    import IconUserPlus from '@/Components/vristo/icon/icon-user-plus.vue';
    import IconListCheck from '@/Components/vristo/icon/icon-list-check.vue';
    import IconLayoutGrid from '@/Components/vristo/icon/icon-layout-grid.vue';
    import IconSearch from '@/Components/vristo/icon/icon-search.vue';
    import { faPerson, faPersonDress, faFile, faClock, faPencil, faTrash } from "@fortawesome/free-solid-svg-icons";
    import IconChecks from '@/Components/vristo/icon/icon-checks.vue';
    import IconX from '@/Components/vristo/icon/icon-x.vue';
    import IconTooth from '@/Components/vristo/icon/icon-tooth.vue';
    import IconClock from '@/Components/vristo/icon/icon-clock.vue';
    import IconCalendar from '@/Components/vristo/icon/icon-calendar.vue';
    import IconCaretDown from '@/Components/vristo/icon/icon-caret-down.vue';
    import IconDollarSignCircle from '@/Components/vristo/icon/icon-dollar-sign-circle.vue';
    import { useForm, Link } from '@inertiajs/vue3';
    import VueCollapsible from 'vue-height-collapsible/vue3';

    const accordians3 = ref(0);

    const props = defineProps({
        patients: {
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
    const baseUrl = assetUrl;

    const getImage = (path) => {
        return baseUrl + 'storage/'+ path;
    }

    const searchContacts = () => {
        form.get(route('heal_patients_list'));
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

    const displayModalAppointments = ref(false);
    const loadingAppointments = ref(false);
    const listAppointments = ref([]);

    const showModalAppointments = (item) => {
        getAppointments(item.id);
        displayModalAppointments.value = true;
    }
    const hideModalAppointments = () => {
        displayModalAppointments.value = false;
    }
    const getAppointments = (id) => {
        loadingAppointments.value = true;
        axios({
            method: 'get',
            url: route('heal_patients_appointments',id),
        }).then((response) => {
            listAppointments.value = response.data
        }).finally(() => {
            loadingAppointments.value = false;
        });
    }
</script>
<template>
    <AppLayout title="Pacientes">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Salud</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Pacientes</span>
            </li>
        </ul>
        <div class="pt-5">
            
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h2 class="text-xl">Pacientes</h2>
            <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                <div class="flex gap-3">
                    <div>
                        <Link :href="route('heal_patients_create')" type="button" class="btn btn-primary">
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
                        placeholder="Buscar Paciente"
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
                            <template v-for="contact in patients.data" :key="contact.id">
                                <tr>
                                    <td>
                                        <div class="flex gap-1 items-center justify-center">
                                            <Link v-tippy:editar :href="route('heal_patients_edit',contact.person_id)" type="button" class="btn btn-sm btn-outline-primary">
                                                <font-awesome-icon  :icon="faPencil" class="m-0" />
                                            </Link>
                                            <tippy target="editar" placement="bottom">Editar</tippy>
                                            <Link v-tippy:historia :href="route('heal_patients_story',contact.id)" type="button" class="btn btn-sm btn-outline-success">
                                                <font-awesome-icon :icon="faFile" class="m-0" />
                                            </Link>
                                            <tippy target="historia" placement="bottom">Historia</tippy>
                                            <button v-tippy:citass type="button" class="btn btn-sm btn-outline-warning" @click="showModalAppointments(contact)">
                                                <font-awesome-icon :icon="faClock" />
                                            </button>
                                            <tippy target="citass" placement="bottom">Citas</tippy>
                                            <button v-tippy:eliminar type="button" class="btn btn-sm btn-outline-danger" @click="deleteUser(contact.person_id)">
                                                <font-awesome-icon :icon="faTrash" />
                                            </button>
                                            <tippy target="eliminar" placement="bottom">Eliminar</tippy>
                                        </div>
                                    </td>
                                    <td>
                                        <Link :href="route('heal_patients_panel',contact.id)" class="flex items-center w-max hover:text-primary">
                                            <div class="w-max">
                                                <img v-if="contact.image"
                                                    :src="getImage(contact.image)"
                                                    class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"
                                                    alt="avatar"
                                                />
                                                <img v-else :src="'https://ui-avatars.com/api/?name='+contact.full_name+'&size=54&rounded=true'" class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2" :alt="contact.full_name"/>
                                            </div>
                                            <div>{{ contact.full_name }}</div>
                                        </Link>
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
                <template v-for="contact in patients.data" :key="contact.id">
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
                                            <Link :href="route('heal_patients_story',contact.id)" v-tippy:history href="javascript:;" class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">
                                                <font-awesome-icon :icon="faFile" />
                                            </Link>
                                            <tippy target="history" placement="bottom">Historia</tippy>
                                        </li>
                                        <li>
                                            <button @click="showModalAppointments(contact)" v-tippy:citas href="javascript:;" class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">
                                                <font-awesome-icon :icon="faClock" />
                                            </button>
                                            <tippy target="citas" placement="bottom">Citas</tippy>
                                        </li>
                                        <!-- <li>
                                            <a href="javascript:;" class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">
                                                <icon-linkedin />
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">
                                                <icon-twitter />
                                            </a>
                                        </li> -->
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
                            <Link :href="route('heal_patients_edit',contact.person_id)" type="button" class="btn btn-outline-primary w-1/2">Editar</Link>
                            <button type="button" class="btn btn-outline-danger w-1/2" @click="deleteUser(contact.id)">Eliminar</button>
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
    <ModalLarge 
        :show="displayModalAppointments"
        :onClose="hideModalAppointments"
    >
        <template #title>Citas</template>
        <template #message>Listado de citas del Paciente</template>
        <template #content>
            <div class="space-y-2 font-semibold">
                <template v-for="(item, ix) in listAppointments">
                    <div class="border border-[#d3d3d3] dark:border-[#1b2e4b] rounded">
                        <button
                            type="button"
                            class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]"
                            :class="{ '!text-primary': accordians3 === ix }"
                            @click="accordians3 === ix ? (accordians3 = null) : (accordians3 = ix)"
                        >
                            <icon-tooth class="w-5 h-6" />
                            {{ item.title }}
                            <div class="ltr:ml-auto rtl:mr-auto" :class="{ 'rotate-180': accordians3 === ix }">
                                <icon-caret-down />
                            </div>
                        </button>
                        <vue-collapsible :isOpen="accordians3 === ix">
                            <div class="space-y-2 p-4 text-white-dark text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                               <template v-for="(appointment, co) in item.appointments">
                                    <div class="max-w-2xl mx-auto divide-y divide-gray-200 dark:divide-neutral-700">
                                        <div class="py-8 first:pt-0 last:pb-0">
                                            <div class="flex gap-x-5">
                                                <div class="relative inline-flex align-middle flex-col items-start justify-center">
                                                    <button v-if="appointment.status == 1" v-tippy:atender type="button" class="btn btn-danger btn-sm rounded-b-none w-full">
                                                        <icon-x class="w-5 h-5" />
                                                    </button>
                                                    <tippy target="atender" :placement="'right'">Atender</tippy>
                                                    <button v-if="appointment.status == 1" v-tippy:rechazar type="button" class="btn btn-success btn-sm rounded-t-none w-full">
                                                        <icon-checks class="w-5 h-5" />
                                                    </button>
                                                    <tippy target="rechazar" :placement="'right'">Rechazar</tippy>
                                                    <button v-if="appointment.status == 2" v-tippy:cobrar type="button" class="btn btn-primary btn-sm w-full">
                                                        <icon-dollar-sign-circle class="w-5 h-5" />
                                                    </button>
                                                    <tippy target="cobrar" :placement="'right'">Cobrar</tippy>
                                                </div>
                                                <div class="grow">
                                                    <h3 class="md:text-lg font-semibold text-gray-800 dark:text-neutral-200">
                                                        {{ appointment.description }}
                                                    </h3>
                                                    <div class="flex items-center space-x-2">
                                                        <icon-calendar class="w-4 h-4" />
                                                        <span>{{ appointment.date_appointmen }} </span>
                                                        <icon-clock class="w-4 h-4" />  
                                                        <span>{{ appointment.time_appointmen }} hasta {{ appointment.time_end_appointmen }}</span>
                                                    </div>
                                                    <p class="mt-1 text-gray-500 dark:text-neutral-500">
                                                        {{ appointment.details }}
                                                        <span v-if="appointment.status == 1" class="badge bg-info my-auto ltr:ml-3 rtl:mr-3 hover:top-0">Pendiente</span>
                                                        <span v-if="appointment.status == 2" class="badge bg-success my-auto ltr:ml-3 rtl:mr-3 hover:top-0">Atendido</span>
                                                        <span v-if="appointment.status == 0" class="badge bg-danger my-auto ltr:ml-3 rtl:mr-3 hover:top-0">Rechazado</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr v-if="co > 0" />
                               </template>                                 
                            </div>
                        </vue-collapsible>
                    </div>
                </template>
            </div>
        </template>
    </ModalLarge>
    </AppLayout>
</template>