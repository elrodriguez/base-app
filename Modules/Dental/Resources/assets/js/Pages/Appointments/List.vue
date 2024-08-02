<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import { ref, onMounted } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogOverlay,
} from "@headlessui/vue";  
import Swal2 from "sweetalert2";
import { useAppStore } from "@/stores/index";
import Pagination from "@/Components/Pagination.vue";
import IconNotes from "@/Components/vristo/icon/icon-notes.vue";
import IconNotesEdit from "@/Components/vristo/icon/icon-notes-edit.vue";
import IconStar from "@/Components/vristo/icon/icon-star.vue";
import IconSquareRotated from "@/Components/vristo/icon/icon-square-rotated.vue";
import IconPlus from "@/Components/vristo/icon/icon-plus.vue";
import IconMenu from "@/Components/vristo/icon/icon-menu.vue";
import IconLoader from "@/Components/vristo/icon/icon-loader.vue";
import IconHorizontalDots from "@/Components/vristo/icon/icon-horizontal-dots.vue";
import IconPencil from "@/Components/vristo/icon/icon-pencil.vue";
import IconTrashLines from "@/Components/vristo/icon/icon-trash-lines.vue";
import IconEye from "@/Components/vristo/icon/icon-eye.vue";
import IconX from "@/Components/vristo/icon/icon-x.vue";
import IconChatDot from "@/Components/vristo/icon/icon-chat-dot.vue";
import InputError from "@/Components/InputError.vue";
import { useForm, Link, router } from "@inertiajs/vue3";
import Multiselect from "@suadelabs/vue3-multiselect";
import "@suadelabs/vue3-multiselect/dist/vue3-multiselect.css";
import IconCaretDown from '@/Components/vristo/icon/icon-caret-down.vue';

const store = useAppStore();

const props = defineProps({
    appointments: {
        type: Object,
        default: () => ({}),
    },
    patients: {
        type: Object,
        default: () => ({}),
    },
    doctors: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});
const baseUrl = assetUrl;
const form = useForm({
    id: null,
    correlative: null,
    patient_id: null,
    patient_person_id: null,
    doctor_id: null,
    doctor_person_id: null,
    date_appointmen: null,
    time_appointmen: null,
    email: null,
    telephone: null,
    description: null,
    details: null,
    message: null,
    status: true,
    important: false,
    sick_time: null
});

const isAddNoteModal = ref(false);
const isViewNoteModal = ref(false);
const isShowNoteMenu = ref(false);
const selectedTab = ref("all");
const selectedNote = ref({});

const saveAppointment = () => {
    if (form.id) {
        form.put(route("odontology_appointments_update", form.id), {
            errorBag: "saveAppointment",
            preserveScroll: true,
            onSuccess: () => {
                showMessage("La cita se actualizo correctamente.");
                isAddNoteModal.value = false;
                form.reset();
            },
        });
    } else {
        form.post(route("odontology_appointments_store"), {
            forceFormData: true,
            errorBag: "saveAppointment",
            preserveScroll: true,
            onSuccess: () => {
                showMessage("La cita se registró correctamente.");
                isAddNoteModal.value = false;
                form.reset();
            },
        });
    }
};

const formSearch = useForm({
    search: props.filters.search,
    tag: props.filters.tag,
});

const tabChanged = (type) => {
    formSearch.tag = type;
    selectedTab.value = type;
    //formSearch.get(route("odontology_appointments_list"));
    router.visit(route("odontology_appointments_list"), {
        method: 'get',
        data: formSearch,
        replace: false,
        preserveState: true,
        preserveScroll: true
    });
};

const setFav = (note) => {
    axios
        .put(route("odontology_appointments_update_important", note.id), {
            important: !note.important,
        })
        .then((res) => {
            showMessage("La cita se actulizo correctamente.");
            router.visit(route("odontology_appointments_list"), {
                replace: true,
                method: "get",
                preserveState: true,
                preserveScroll: true,
            });
        });
};

const setTag = (note, tag) => {
    axios
        .put(route("odontology_appointments_update_status", note.id), {
            status: tag,
        })
        .then((res) => {
            showMessage("La cita se actulizo correctamente.");
            router.visit(route("odontology_appointments_list"), {
                replace: true,
                method: "get",
                preserveState: true,
                preserveScroll: true,
            });
        });
};

const viewNote = (note) => {
    setTimeout(() => {
        selectedNote.value = note;
        isViewNoteModal.value = true;
    });
};

const editNote = (note = null) => {
    isShowNoteMenu.value = false;
    if (note) {
        let pp = JSON.parse(JSON.stringify(note));
        form.id = pp.id;
        form.correlative = pp.correlative;
        form.patient_id = {
            code: pp.patient_id,
            name: pp.patient.full_name,
            email: pp.patient.email,
            telephone: pp.patient.telephone,
        };
        form.patient_person_id = pp.patient_person_id;
        form.doctor_id = {
            code: pp.doctor_id,
            name: pp.doctor.full_name,
            email: pp.doctor.email,
            telephone: pp.doctor.telephone,
        };
        form.doctor_person_id = pp.doctor_person_id;
        form.date_appointmen = pp.date_appointmen;
        form.time_appointmen = pp.time_appointmen;
        form.email = pp.email;
        form.telephone = pp.telephone;
        form.description = pp.description;
        form.details = pp.details;
        form.message = pp.message;
        form.status = pp.status;
        form.sick_time = pp.sick_time;
    }
    isAddNoteModal.value = true;
};

const deleteNote = (note) => {
    const swalConfirm = Swal2.mixin({
        customClass: {
            popup: "sweet-alerts",
            confirmButton: "btn btn-secondary",
            cancelButton: "btn btn-dark ltr:mr-3 rtl:ml-3",
        },
        buttonsStyling: false,
    });
    swalConfirm
        .fire({
            title: "¿Estas seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, Eliminar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            reverseButtons: true,
            padding: "2em",
            preConfirm: () => {
                return axios
                    .delete(route("odontology_appointments_destroy", note.id))
                    .then((res) => {
                        if (!res.data.success) {
                            Swal2.showValidationMessage(res.data.message);
                        }
                        return res;
                    });
            },
            allowOutsideClick: () => !Swal2.isLoading(),
        })
        .then((result) => {
            if (result.isConfirmed) {
                showMessage("La cita se Eliminó correctamente.");
                router.visit(route("odontology_appointments_list"), {
                    replace: true,
                    method: "get",
                    preserveState: true,
                    preserveScroll: true,
                });
            }
        });
};

const showMessage = (msg = "", type = "success") => {
    const toast = Swal2.mixin({
        toast: true,
        position: "top",
        showConfirmButton: false,
        timer: 3000,
        customClass: { container: "toast" },
    });
    toast.fire({
        icon: type,
        title: msg,
        padding: "10px 20px",
    });
};

const updateSelected = (query) => {
    let pp = JSON.parse(JSON.stringify(query));
    form.email = pp.email;
    form.telephone = pp.telephone;
};

const getImage = (path) => {
    return baseUrl + "storage/" + path;
};

const modalSendMessage = ref(false);
const formWhatsapp = useForm({
    telephone: null,
    message: null,
});
const sendMessageModal = (note) => {
    formWhatsapp.telephone = note.telephone;

    modalSendMessage.value = true
}

const sendMessageWhatsapp = () => {
    formWhatsapp.post(route('meta_whatsapp_message_send'), {
        errorBag: 'sendMessageWhatsapp',
        preserveScroll: true,
        onSuccess: () => {
            formWhatsapp.reset()
        },
    });
    modalSendMessage.value = false
}
</script>
<template>
    <AppLayout title="Citas">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline"
                    >Salud</a
                >
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Odontología</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Citas</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="flex gap-5 relative sm:h-[calc(100vh_-_150px)] h-full">
                <div
                    class="bg-black/60 z-10 w-full h-full rounded-md absolute hidden"
                    :class="{ '!block xl:!hidden': isShowNoteMenu }"
                    @click="isShowNoteMenu = !isShowNoteMenu"
                ></div>
                <div
                    class="panel p-4 flex-none w-[240px] absolute xl:relative z-10 space-y-4 h-full xl:h-auto hidden xl:block ltr:lg:rounded-r-md ltr:rounded-r-none rtl:lg:rounded-l-md rtl:rounded-l-none overflow-hidden"
                    :class="{
                        'hidden shadow': !isShowNoteMenu,
                        '!block h-full ltr:left-0 rtl:right-0': isShowNoteMenu,
                    }"
                >
                    <div class="flex flex-col h-full pb-16">
                        <div class="flex text-center items-center">
                            <div class="shrink-0">
                                <icon-notes />
                            </div>
                            <h3 class="text-lg font-semibold ltr:ml-3 rtl:mr-3">
                                Lista de Citas
                            </h3>
                        </div>
                        <div
                            class="h-px w-full border-b border-[#e0e6ed] dark:border-[#1b2e4b] my-4"
                        ></div>
                        <perfect-scrollbar
                            :options="{
                                swipeEasing: true,
                                wheelPropagation: false,
                            }"
                            class="relative ltr:pr-3.5 rtl:pl-3.5 ltr:-mr-3.5 rtl:-ml-3.5 h-full grow"
                        >
                            <div class="space-y-1">
                                <button
                                    type="button"
                                    class="w-full flex justify-between items-center p-2 hover:bg-white-dark/10 rounded-md dark:hover:text-primary hover:text-primary dark:hover:bg-[#181F32] font-medium h-10"
                                    :class="{
                                        'bg-gray-100 dark:text-primary text-primary dark:bg-[#181F32]':
                                            selectedTab === 'all',
                                    }"
                                    @click="tabChanged('all')"
                                >
                                    <div class="flex items-center">
                                        <icon-notes-edit class="shrink-0" />

                                        <div class="ltr:ml-3 rtl:mr-3">
                                            Todas
                                        </div>
                                    </div>
                                </button>
                                <button
                                    type="button"
                                    class="w-full flex justify-between items-center p-2 hover:bg-white-dark/10 rounded-md dark:hover:text-primary hover:text-primary dark:hover:bg-[#181F32] font-medium h-10"
                                    :class="{
                                        'bg-gray-100 dark:text-primary text-primary dark:bg-[#181F32]':
                                            selectedTab === 'fav',
                                    }"
                                    @click="tabChanged('fav')"
                                >
                                    <div class="flex items-center">
                                        <icon-star class="shrink-0" />
                                        <div class="ltr:ml-3 rtl:mr-3">
                                            Importantes
                                        </div>
                                    </div>
                                </button>
                                <div
                                    class="h-px w-full border-b border-[#e0e6ed] dark:border-[#1b2e4b]"
                                ></div>
                                <div class="px-1 py-3 text-white-dark">
                                    Estados
                                </div>
                                <!-- <button
                                type="button"
                                class="w-full flex items-center h-10 p-1 hover:bg-white-dark/10 rounded-md dark:hover:bg-[#181F32] font-medium text-primary ltr:hover:pl-3 rtl:hover:pr-3 duration-300"
                                :class="{ 'ltr:pl-3 rtl:pr-3 bg-gray-100 dark:bg-[#181F32]': selectedTab === 'personal' }"
                                @click="tabChanged('1')"
                            >
                                <icon-square-rotated class="fill-primary shrink-0" />

                                <div class="ltr:ml-3 rtl:mr-3">Pendiente</div>
                            </button> -->

                                <button
                                    type="button"
                                    class="w-full flex items-center h-10 p-1 hover:bg-white-dark/10 rounded-md dark:hover:bg-[#181F32] font-medium text-warning ltr:hover:pl-3 rtl:hover:pr-3 duration-300"
                                    :class="{
                                        'ltr:pl-3 rtl:pr-3 bg-gray-100 dark:bg-[#181F32]':
                                            selectedTab === '1',
                                    }"
                                    @click="tabChanged('1')"
                                >
                                    <icon-square-rotated
                                        class="fill-warning shrink-0"
                                    />
                                    <div class="ltr:ml-3 rtl:mr-3">
                                        Pendiente
                                    </div>
                                </button>

                                <button
                                    type="button"
                                    class="w-full flex items-center h-10 p-1 hover:bg-white-dark/10 rounded-md dark:hover:bg-[#181F32] font-medium text-info ltr:hover:pl-3 rtl:hover:pr-3 duration-300"
                                    :class="{
                                        'ltr:pl-3 rtl:pr-3 bg-gray-100 dark:bg-[#181F32]':
                                            selectedTab === '2',
                                    }"
                                    @click="tabChanged('2')"
                                >
                                    <icon-square-rotated
                                        class="fill-info shrink-0"
                                    />
                                    <div class="ltr:ml-3 rtl:mr-3">
                                        Atendido
                                    </div>
                                </button>

                                <button
                                    type="button"
                                    class="w-full flex items-center h-10 p-1 hover:bg-white-dark/10 rounded-md dark:hover:bg-[#181F32] font-medium text-danger ltr:hover:pl-3 rtl:hover:pr-3 duration-300"
                                    :class="{
                                        'ltr:pl-3 rtl:pr-3 bg-gray-100 dark:bg-[#181F32]':
                                            selectedTab === '0',
                                    }"
                                    @click="tabChanged('0')"
                                >
                                    <icon-square-rotated
                                        class="fill-danger shrink-0"
                                    />
                                    <div class="ltr:ml-3 rtl:mr-3">
                                        Cancelado
                                    </div>
                                </button>
                            </div>
                        </perfect-scrollbar>
                    </div>
                    <div
                        class="ltr:left-0 rtl:right-0 absolute bottom-0 p-4 w-full"
                    >
                        <button
                            class="btn btn-primary w-full"
                            type="button"
                            @click="editNote()"
                        >
                            <icon-plus
                                class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0"
                            />
                            Nueva cita
                        </button>
                    </div>
                </div>

                <div class="panel p-0 flex-1 overflow-auto h-full">
                    <div class="flex flex-col h-full">
                    <div class="p-4 flex sm:flex-row flex-col w-full sm:items-center gap-4">
                        <div class="ltr:mr-3 rtl:ml-3 flex items-center">
                            <button type="button" class="xl:hidden hover:text-primary block ltr:mr-3 rtl:ml-3" @click="isShowTaskMenu = !isShowTaskMenu">
                                <icon-menu />
                            </button>
                        </div>
                        <div class="flex items-center justify-center sm:justify-end sm:flex-auto flex-1">
                            <p class="ltr:mr-3 rtl:ml-3">
                                {{ appointments.from }} - {{ appointments.to }} of {{ appointments.total }}
                            </p>
                            <button
                                disabled
                                type="button"
                                v-if="appointments.current_page <= 1" 
                                class="bg-[#f4f4f4] rounded-md p-1 enabled:hover:bg-primary-light dark:bg-white-dark/20 enabled:dark:hover:bg-white-dark/30 ltr:mr-3 rtl:ml-3 disabled:opacity-60 disabled:cursor-not-allowed"
                            >
                                <icon-caret-down class="w-5 h-5 rtl:-rotate-90 rotate-90" />
                            </button>
                            <Link v-else :href="appointments.prev_page_url"
                                type="button"
                                class="bg-[#f4f4f4] rounded-md p-1 enabled:hover:bg-primary-light dark:bg-white-dark/20 enabled:dark:hover:bg-white-dark/30 disabled:opacity-60 disabled:cursor-not-allowed"
                            >
                                <icon-caret-down class="w-5 h-5 rtl:rotate-90 -rotate-90" />
                            </Link>
                            <Link
                                v-if="appointments.current_page < appointments.last_page" :href="appointments.next_page_url"
                                type="button"
                                class="bg-[#f4f4f4] rounded-md p-1 enabled:hover:bg-primary-light dark:bg-white-dark/20 enabled:dark:hover:bg-white-dark/30 ltr:mr-3 rtl:ml-3 disabled:opacity-60 disabled:cursor-not-allowed"
                            >
                                <icon-caret-down class="w-5 h-5 rtl:-rotate-90 rotate-90" />
                            </Link>
                            <button
                                type="button"
                                disabled
                                class="bg-[#f4f4f4] rounded-md p-1 enabled:hover:bg-primary-light dark:bg-white-dark/20 enabled:dark:hover:bg-white-dark/30 disabled:opacity-60 disabled:cursor-not-allowed"
                            >
                                <icon-caret-down class="w-5 h-5 rtl:rotate-90 -rotate-90" />
                            </button>
                        </div>
                    </div>
                    <div class="h-px w-full border-b border-[#e0e6ed] dark:border-[#1b2e4b]"></div>
                    <template v-if="!appointments.data.length">
                        <div class="flex justify-center items-center sm:min-h-[300px] min-h-[400px] font-semibold text-lg h-full">
                            Datos no disponibles
                        </div>
                    </template>
                    <template v-if="appointments.data.length">
                        <div class="p-5 grow overflow-y-auto sm:min-h-[300px] min-h-[400px]">
                            <div class="grid 2xl:grid-cols-4 lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5">
                                <template v-for="note in appointments.data" :key="note.id" >
                                    <div class="panel pb-12"
                                        :class="{
                                            'bg-primary-light shadow-primary': note.status === '3',
                                            'bg-warning-light shadow-warning': note.status === '1',
                                            'bg-info-light shadow-info': note.status === '2',
                                            'bg-danger-light shadow-danger': note.status === '0',
                                            'dark:shadow-dark': !note.status,
                                        }"
                                    >
                                        <div class="min-h-[142px]">
                                            <div class="flex justify-between">
                                                <div class="flex items-center w-max" >
                                                    <div class="flex-none">
                                                        <div v-if="note.patient.image" class="p-0.5 bg-gray-300 dark:bg-gray-700 rounded-full">
                                                            <img class="h-8 w-8 rounded-full object-cover" :src="getImage(note.patient.image)" />
                                                        </div>
                                                        <div v-else>
                                                            <img :src="'https://ui-avatars.com/api/?name=' +note.patient.full_name +'&size=54&rounded=true'" class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2" :alt="note.patient.full_name" />
                                                        </div>
                                                    </div>
                                                    <div class="ltr:ml-2 rtl:mr-2" >
                                                        <div class="font-semibold" >
                                                            {{ note.patient.full_name }}
                                                        </div>
                                                        <div  class="text-sx text-white-dark" >
                                                            {{ note.date_appointmen }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown">
                                                    <Popper :placement=" store.rtlClass === 'rtl' ? 'bottom-start' : 'bottom-end'" offsetDistance="0" >
                                                        <button type="button" class="text-primary" >
                                                            <icon-horizontal-dots class="rotate-90 opacity-70 hover:opacity-100" />
                                                        </button>
                                                        <template #content="{ close }" >
                                                            <ul @click="close()" class="text-sm font-medium" >
                                                                <li>
                                                                    <a href="javascript:;" class="w-full" @click="editNote(note)" >
                                                                        <icon-pencil class="w-4 h-4 ltr:mr-3 rtl:ml-3 shrink-0" />

                                                                        Editar
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;" class="w-full" @click="deleteNote(note)" >
                                                                        <icon-trash-lines class="w-4.5 h-4.5 ltr:mr-3 rtl:ml-3 shrink-0" />
                                                                        Eliminar
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;"  class="w-full" @click="viewNote(note)" >
                                                                        <icon-eye class="w-4.5 h-4.5 ltr:mr-3 rtl:ml-3 shrink-0" />
                                                                        Ver
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </template>
                                                    </Popper>
                                                </div>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold mt-4">
                                                    {{ note.description }}
                                                </h4>
                                                <p class="text-white-dark mt-2">
                                                    {{ note.details }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="absolute bottom-5 left-0 w-full px-5" >
                                            <div  class="flex items-center justify-between mt-2" >
                                                <div class="dropdown">
                                                    <Popper :placement=" store.rtlClass === 'rtl' ? 'bottom-start' : 'bottom-end'" offsetDistance="0" >
                                                        <button type="button"
                                                            :class="{
                                                                // 'text-primary': note.status === '1',
                                                                'text-warning': note.status === '1',
                                                                'text-info': note.status === '2',
                                                                'text-danger': note.status === '0',
                                                            }"
                                                        >
                                                            <icon-square-rotated
                                                                :class="{
                                                                    // 'fill-primary': note.tag === 'personal',
                                                                    'fill-warning': note.status === '1',
                                                                    'fill-info':  note.status === '2',
                                                                    'fill-danger': note.status === '0',
                                                                }"
                                                            />
                                                        </button>
                                                        <template #content="{ close }" >
                                                            <ul  @click="close()" >
                                                                <!-- <li>
                                                                <a href="javascript:;" @click="setTag(note, 'personal')">
                                                                    <icon-square-rotated class="ltr:mr-2 rtl:ml-2 fill-primary text-primary" />
                                                                    Personal
                                                                </a>
                                                            </li> -->
                                                                <li>
                                                                    <a
                                                                        href="javascript:;"
                                                                        @click="
                                                                            setTag(
                                                                                note,
                                                                                '1'
                                                                            )
                                                                        "
                                                                    >
                                                                        <icon-square-rotated
                                                                            class="ltr:mr-2 rtl:ml-2 fill-warning text-warning"
                                                                        />
                                                                        Pendiente
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a
                                                                        href="javascript:;"
                                                                        @click="
                                                                            setTag(
                                                                                note,
                                                                                '2'
                                                                            )
                                                                        "
                                                                    >
                                                                        <icon-square-rotated
                                                                            class="ltr:mr-2 rtl:ml-2 fill-info text-info"
                                                                        />
                                                                        Atendido
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;" @click="setTag(note,'0')" >
                                                                        <icon-square-rotated  class="ltr:mr-2 rtl:ml-2 fill-danger text-danger" />
                                                                        Cancelado
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </template>
                                                    </Popper>
                                                </div>
                                                <div class="flex items-center">
                                                    <button type="button" class="text-danger" @click=" deleteNote(note)" >
                                                        <icon-trash-lines />
                                                    </button>
                                                    <button
                                                        type="button"
                                                        class="text-primary ltr:ml-2 rtl:mr-2"
                                                        @click="
                                                            sendMessageModal(note)
                                                        "
                                                    >
                                                        <icon-chat-dot />
                                                    </button>
                                                    <button
                                                        type="button"
                                                        class="text-warning group ltr:ml-2 rtl:mr-2"
                                                        @click="setFav(note)"
                                                    >
                                                        <icon-star
                                                            class="w-4.5 h-4.5 group-hover:fill-warning"
                                                            :class="{
                                                                'fill-warning':
                                                                    note.important,
                                                            }"
                                                        />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                    </div>
                    <TransitionRoot appear :show="isAddNoteModal" as="template">
                        <Dialog
                            as="div"
                            @close="isAddNoteModal = false"
                            class="relative z-[51]"
                        >
                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <DialogOverlay
                                    class="fixed inset-0 bg-[black]/60"
                                />
                            </TransitionChild>

                            <div class="fixed inset-0 overflow-y-auto">
                                <div
                                    class="flex min-h-full items-center justify-center px-4 py-8"
                                >
                                    <TransitionChild
                                        as="template"
                                        enter="duration-300 ease-out"
                                        enter-from="opacity-0 scale-95"
                                        enter-to="opacity-100 scale-100"
                                        leave="duration-200 ease-in"
                                        leave-from="opacity-100 scale-100"
                                        leave-to="opacity-0 scale-95"
                                    >
                                        <DialogPanel
                                            class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark"
                                        >
                                            <button
                                                type="button"
                                                class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                @click="isAddNoteModal = false"
                                            >
                                                <icon-x />
                                            </button>
                                            <div  class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]" >
                                                {{ form.id ? "Editar cita" : "Nueva cita" }}
                                            </div>
                                            <div class="p-5">
                                                <form @submit.prevent="saveAppointment" class="space-y-5" >
                                                    <div :class="[form.doctor_id? form.errors.doctor_id ? 'has-success' : 'has-error' : '', ]" class="" >
                                                        <label for="doctor_id" >Doctores</label>
                                                        <multiselect
                                                            id="doctor_id" :model-value="form.doctor_id"
                                                            v-model="form.doctor_id"
                                                            :options="doctors"
                                                            class="custom-multiselect"
                                                            :searchable="true"
                                                            placeholder="Buscar doctor"
                                                            selected-label="seleccionado"
                                                            select-label="Elegir"
                                                            deselect-label="Quitar"
                                                            label="name"
                                                            track-by="code"
                                                        ></multiselect>
                                                        <InputError
                                                            :message="
                                                                form.errors
                                                                    .doctor_id
                                                            "
                                                            class="mt-1"
                                                        />
                                                    </div>
                                                    <div
                                                        :class="[
                                                            form.patient_id
                                                                ? form.errors
                                                                      .patient_id
                                                                    ? 'has-success'
                                                                    : 'has-error'
                                                                : '',
                                                        ]"
                                                        class=""
                                                    >
                                                        <label for="patient_id" >Paciente</label>
                                                        <multiselect
                                                            id="patient_id"
                                                            v-model="form.patient_id"
                                                            :options="patients"
                                                            class="custom-multiselect"
                                                            :searchable="true"
                                                            placeholder="Buscar paciente"
                                                            selected-label="seleccionado"
                                                            select-label="Elegir"
                                                            deselect-label="Quitar"
                                                            label="name"
                                                            track-by="code"
                                                            @update:model-value="updateSelected"
                                                        ></multiselect>
                                                        <InputError :message="form.errors.patient_id" class="mt-1" />
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2" >
                                                        <div
                                                            :class="[
                                                                form.date_appointmen
                                                                    ? form
                                                                          .errors
                                                                          .date_appointmen
                                                                        ? 'has-success'
                                                                        : 'has-error'
                                                                    : '',
                                                            ]"
                                                            class=""
                                                        >
                                                            <label
                                                                for="date_appointmen"
                                                                >Día</label
                                                            >
                                                            <input
                                                                id="date_appointmen"
                                                                type="date"
                                                                class="form-input"
                                                                v-model="
                                                                    form.date_appointmen
                                                                "
                                                            />
                                                            <InputError
                                                                :message="
                                                                    form.errors
                                                                        .date_appointmen
                                                                "
                                                                class="mt-1"
                                                            />
                                                        </div>
                                                        <div :class="[form.time_appointmen ? form.errors.time_appointmen ? 'has-success' : 'has-error' : '', ]"
                                                            class=""
                                                        >
                                                            <label for="time_appointmen" >Hora</label >
                                                            <input
                                                                id="time_appointmen"
                                                                type="time"
                                                                class="form-input"
                                                                v-model="form.time_appointmen" 
                                                            />
                                                            <InputError :message="form.errors.time_appointmen" class="mt-1" />
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2" >
                                                        <div :class="[form.email ? form.errors.email ? 'has-success' : 'has-error' : '', ]" class="">
                                                            <label for="email" >Email</label>
                                                            <input id="email" type="text" class="form-input" v-model="form.email" />
                                                            <InputError :message="form.errors.email" class="mt-1" />
                                                        </div>
                                                        <div :class="[form.telephone ? form.errors.telephone ? 'has-success' : 'has-error' : '', ]" class="" >
                                                            <label for="email" >Teléfono</label>
                                                            <input id="email" type="text" class="form-input" v-model="form.telephone" />
                                                            <InputError :message="form.errors.telephone" class="mt-1" />
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="description" >Motivo de consulta</label>
                                                        <input v-model="form.description" id="description" class="form-input" />
                                                        <InputError :message="form.errors.description" class="mt-1" />
                                                    </div>
                                                    <div>
                                                        <label for="details">Signos y Sintomas</label>
                                                        <input v-model="form.details" id="details" class="form-input" />
                                                        <InputError :message="form.errors.details" class="mt-1" />
                                                    </div>
                                                    <div>
                                                        <label for="message">Tiempo de Enfermedad</label>
                                                        <input v-model="form.message" id="message" class="form-input" />
                                                        <InputError :message="form.errors.message" class="mt-1" />
                                                    </div>
                                                    <div>
                                                        <label for="sick_time">Relato Cronológico</label>
                                                        <input v-model="form.sick_time" id="sick_time" class="form-input" />
                                                        <InputError :message="form.errors.sick_time" class="mt-1" />
                                                    </div>
                                                    <div class="flex justify-end items-center mt-8" >
                                                        <button type="button" class="btn btn-outline-danger gap-2" @click="isAddNoteModal = false" >
                                                            Cancelar
                                                        </button>
                                                        <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" :class="{ 'opacity-25': form.processing, }" :disabled="form.processing" >
                                                            <icon-loader v-show="form.processing" class="animate-[spin_2s_linear_infinite] inline-block align-middle ltr:mr-2 rtl:ml-2 shrink-0" />
                                                            {{ form.id ? "Actualizar" : "Guardar"}}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </DialogPanel>
                                    </TransitionChild>
                                </div>
                            </div>
                        </Dialog>
                    </TransitionRoot>

                    <TransitionRoot appear :show="isViewNoteModal" as="template" >
                        <Dialog as="div"  @close="isViewNoteModal = false" class="relative z-[51]" >
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
                                            <button type="button" class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none" @click="isViewNoteModal = false" >
                                                <icon-x />
                                            </button>
                                            <div class="flex items-center flex-wrap gap-2 text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                <div class="ltr:mr-3 rtl:ml-3">
                                                    {{ selectedNote.description }}
                                                </div>
                                                <button
                                                    v-show="selectedNote.status"
                                                    type="button"
                                                    class="badge badge-outline-primary rounded-3xl capitalize ltr:mr-3 rtl:ml-3"
                                                    :class="{
                                                        'shadow-primary': selectedNote.status === '4',
                                                        'shadow-warning': selectedNote.status === '1',
                                                        'shadow-info': selectedNote.status === '2',
                                                        'shadow-danger': selectedNote.status === '0',
                                                    }"
                                                >
                                                    <span v-if="selectedNote.status === '1'">Pendiente</span>
                                                    <span v-else-if="selectedNote.status == '2'">Atendido</span>
                                                    <span v-else-if="selectedNote.status == '0'" >Cancelado</span>
                                                </button>
                                                <button v-show="selectedNote.important" type="button"  class="text-warning">
                                                    <icon-star class="fill-warning" />
                                                </button>
                                            </div>
                                            <div class="p-5">
                                                <div class="text-base">
                                                    {{ selectedNote.details }}
                                                </div>

                                                <div class="ltr:text-right rtl:text-left mt-8" >
                                                    <button type="button" class="btn btn-outline-danger" @click="isViewNoteModal = false" >
                                                        cerrar
                                                    </button>
                                                </div>
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
        <TransitionRoot appear :show="modalSendMessage" as="template">
            <Dialog as="div" @close="modalSendMessage = false" class="relative z-50">
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
                    <div class="flex min-h-full items-start justify-center px-4 py-8">
                        <DialogPanel class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark animate__animated animate__zoomInUp">
                            <button  type="button" class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none" @click="modalSendMessage = false">
                                <icon-x /> 
                            </button>
                            <div class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">Enviar al: {{ formWhatsapp.telephone }}</div>
                            <div class="p-5">
    
                                <div>
                                    <label for="ctnTextarea">Mensaje</label>
                                    <textarea v-model="formWhatsapp.message" id="ctnTextarea" rows="3" class="form-textarea mb-4" placeholder="Escribir mensaje" required></textarea>
                                    <span class="text-white bg-[#1abc9c] py-1 px-2 rounded">Se enviara por whatsapp al número de teléfono </span>
                                </div>


                                <div class="flex justify-end items-center mt-8">
                                    <button type="button" @click="modalSendMessage = false" class="btn btn-outline-danger">Cancelar</button>
                                    <button type="button" @click="sendMessageWhatsapp" class="btn btn-primary ltr:ml-4 rtl:mr-4" :class="{'opacity-25': formWhatsapp.processing}" :disabled="formWhatsapp.processing">
                                        <icon-loader v-show="formWhatsapp.processing" class="animate-[spin_2s_linear_infinite] inline-block align-middle ltr:mr-2 rtl:ml-2 shrink-0" />
                                        enviar
                                    </button>
                                </div>
                            </div>
                            
                        </DialogPanel>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </AppLayout>
</template>
