<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import { ref, computed, onMounted } from 'vue';
    import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue';
    import { quillEditor } from 'vue3-quill';
    import 'vue3-quill/lib/vue3-quill.css';
    import Swal from 'sweetalert2';
    import { useAppStore } from '@/stores/index';
    import { router } from '@inertiajs/vue3'
    import IconMail from '@/Components/vristo/icon/icon-mail.vue';
    import IconStar from '@/Components/vristo/icon/icon-star.vue';
    import IconSend from '@/Components/vristo/icon/icon-send.vue';
    import IconInfoHexagon from '@/Components/vristo/icon/icon-info-hexagon.vue';
    import IconFile from '@/Components/vristo/icon/icon-file.vue';
    import IconTrashLines from '@/Components/vristo/icon/icon-trash-lines.vue';
    import IconCaretDown from '@/Components/vristo/icon/icon-caret-down.vue';
    import IconArchive from '@/Components/vristo/icon/icon-archive.vue';
    import IconBookmark from '@/Components/vristo/icon/icon-bookmark.vue';
    import IconVideo from '@/Components/vristo/icon/icon-video.vue';
    import IconChartSquare from '@/Components/vristo/icon/icon-chart-square.vue';
    import IconUserPlus from '@/Components/vristo/icon/icon-user-plus.vue';
    import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
    import IconRefresh from '@/Components/vristo/icon/icon-refresh.vue';
    import IconWheel from '@/Components/vristo/icon/icon-wheel.vue';
    import IconHorizontalDots from '@/Components/vristo/icon/icon-horizontal-dots.vue';
    import IconOpenBook from '@/Components/vristo/icon/icon-open-book.vue';
    import IconBook from '@/Components/vristo/icon/icon-book.vue';
    import IconTrash from '@/Components/vristo/icon/icon-trash.vue';
    import IconRestore from '@/Components/vristo/icon/icon-restore.vue';
    import IconMenu from '@/Components/vristo/icon/icon-menu.vue';
    import IconSearch from '@/Components/vristo/icon/icon-search.vue';
    import IconSettings from '@/Components/vristo/icon/icon-settings.vue';
    import IconHelpCircle from '@/Components/vristo/icon/icon-help-circle.vue';
    import IconUser from '@/Components/vristo/icon/icon-user.vue';
    import IconMessage2 from '@/Components/vristo/icon/icon-message-2.vue';
    import IconUsers from '@/Components/vristo/icon/icon-users.vue';
    import IconTag from '@/Components/vristo/icon/icon-tag.vue';
    import IconPaperclip from '@/Components/vristo/icon/icon-paperclip.vue';
    import IconArrowLeft from '@/Components/vristo/icon/icon-arrow-left.vue';
    import IconPrinter from '@/Components/vristo/icon/icon-printer.vue';
    import IconArrowBackward from '@/Components/vristo/icon/icon-arrow-backward.vue';
    import IconArrowForward from '@/Components/vristo/icon/icon-arrow-forward.vue';
    import IconGallery from '@/Components/vristo/icon/icon-gallery.vue';
    import IconFolder from '@/Components/vristo/icon/icon-folder.vue';
    import IconZipFile from '@/Components/vristo/icon/icon-zip-file.vue';
    import IconDownload from '@/Components/vristo/icon/icon-download.vue';
    import IconTxtFile from '@/Components/vristo/icon/icon-txt-file.vue';

    const props = defineProps({
        emailfor: {
            type: String,
            default: null
        },
        person:{
            type: Object,
            default: () => ({})
        },
        mailList: {
            type: Object,
            default: () => ({})
        }
    });

    const store = useAppStore();

    const validatePersonalData = () => {
        if(!props.person){
            Swal.fire({
                title: 'Información requerida',
                text: 'No puede ver los correos. dirijase a su perfil y registre su información en la pestaña "Datos personales".',
                icon: 'warning',
                confirmButtonText: 'Ir a mi perfil',
                allowOutsideClick: false, // No permite cerrar al hacer clic fuera
                allowEscapeKey: false,     // No permite cerrar con la tecla Esc
                padding: '2em',
                customClass: 'sweet-alerts',
            }).then((result) => {
                if (result.isConfirmed) {
                    router.visit(route('profile.edit'), {
                        method: 'get',
                        replace: true,
                        preserveState: false,
                        preserveScroll: false,
                    });
                }
            });
        }
    }

    const defaultData = ref({
        id: null,
        from: props.person ? props.person.email : null,
        to: props.emailfor,
        cc: '',
        title: '',
        file: null,
        description: '',
        displayDescription: '',
        type: null
    });

    const isShowMailMenu = ref(false);
    const isEdit = ref(false);
    const selectedTab = ref('inbox');
    const filteredMailList = ref([]);
    const ids = ref([]);
    const searchText = ref('');
    const selectedMail = ref(null);
    const params = ref(defaultData.value);
    const mailList = ref([]);

    const xasset = assetUrl;
    
    const getPath = (path) => {
        return xasset + 'storage/' + path;
    }

    const formatDate = (createdAt, returnType) => {
        const date = new Date(createdAt);
        
        // Verificar si la fecha es válida
        if (isNaN(date.getTime())) {
            throw new Error('Fecha inválida');
        }

        if (returnType === 'date') {
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            return `${day}/${month}/${year}`;
        } else if (returnType === 'time') {
            let hours = date.getHours();
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? String(hours).padStart(2, '0') : '12'; // Convertir 0 a 12

            return `${hours}:${minutes} ${ampm}`;
        }

        return null; // Devuelve null si returnType no es válido
    }

    const logProducts = () => {

        if(props.mailList.length > 0){
            props.mailList.forEach(mail => {
                
                let messages = '';

                mail.messages.forEach(message => {
                    messages += message.content;
                });

                mailList.value.push({
                    id: mail.id,
                    path: getPath(mail.user.avatar),
                    firstName: mail.user.person.names,
                    lastName: mail.user.person.father_lastname,
                    email: mail.user.email,
                    date: formatDate(mail.created_at, 'date'),
                    time: formatDate(mail.created_at, 'time'),
                    title: mail.title,
                    displayDescription: mail.description,
                    type: mail.type_action,
                    isImportant: false,
                    isStar: false,
                    group: mail.status,   
                    isUnread: false,
                    description: mail.messages.length > 0 ? messages : null,
                    email_from: mail.messages.length > 0 ? mail.messages[0].email_from : null,
                    email_for: mail.messages.length > 0 ? mail.messages[0].email_for : null
                });
            });
        }
    }

    onMounted(() => {
        validatePersonalData();
        logProducts();
    });

    const pager = ref({
        currentPage: 1,
        totalPages: 0,
        pageSize: 10,
        startIndex: 0,
        endIndex: 0,
    });
    const pagedMails = ref([]);
    const editorOptions = ref({
        modules: {
            toolbar: [[{ header: [1, 2, false] }], ['bold', 'italic', 'underline', 'link'], [{ list: 'ordered' }, { list: 'bullet' }], ['clean']],
        },
        placeholder: '',
    });
    const quillEditorObj = ref(null);

    const checkAllCheckbox = computed(() => {
        if (filteredMailList.value.length && ids.value.length === filteredMailList.value.length) {
            return true;
        } else {
            return false;
        }
    });
    const showTime = (item) => {
        // Dividir la fecha en día, mes y año
        const [day, month, year] = item.date.split('/').map(Number);
        const displayDt = new Date(year, month - 1, day); // Mes es 0-indexado

        const cDt = new Date();
        if (displayDt.toDateString() === cDt.toDateString()) {
            return item.time;
        } else {
            if (displayDt.getFullYear() === cDt.getFullYear()) {
                var monthNames = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                return monthNames[displayDt.getMonth()] + ' ' + String(displayDt.getDate()).padStart(2, '0');
            } else {
                return String(displayDt.getMonth() + 1).padStart(2, '0') + '/' + String(displayDt.getDate()).padStart(2, '0') + '/' + displayDt.getFullYear();
            }
        }
    };

    const checkAll = (isChecked = false) => {
        if (isChecked) {
            ids.value = filteredMailList.value.map((d) => {
                return d.id;
            });
        } else {
            clearSelection();
        }
    };

    onMounted(() => {
        searchMails();
    });

    const quillEditorReady = (quill) => {
        quillEditorObj.value = quill;
    };

    const searchMails = (isResetPage = true) => {
        if (isResetPage) {
            pager.value.currentPage = 1;
        }

        let res;
        if (selectedTab.value === 'important') {
            res = mailList.value.filter((d) => d.isImportant);
        } else if (selectedTab.value === 'star') {
            res = mailList.value.filter((d) => d.isStar);
        } else if (selectedTab.value === 'personal' || selectedTab.value === 'work' || selectedTab.value === 'social' || selectedTab.value === 'private') {
            res = mailList.value.filter((d) => d.group === selectedTab.value);
        } else {
            res = mailList.value.filter((d) => d.type === selectedTab.value);
        }
        filteredMailList.value = res.filter(
            (d) =>
                (d.title && d.title.toLowerCase().includes(searchText.value)) ||
                (d.firstName && d.firstName.toLowerCase().includes(searchText.value)) ||
                (d.lastName && d.lastName.toLowerCase().includes(searchText.value)) ||
                (d.displayDescription && d.displayDescription.toLowerCase().includes(searchText.value))
        );
        if (filteredMailList.value.length) {
            pager.value.totalPages = pager.value.pageSize < 1 ? 1 : Math.ceil(filteredMailList.value.length / pager.value.pageSize);
            if (pager.value.currentPage > pager.value.totalPages) {
                pager.value.currentPage = 1;
            }
            pager.value.startIndex = (pager.value.currentPage - 1) * pager.value.pageSize;
            pager.value.endIndex = Math.min(pager.value.startIndex + pager.value.pageSize - 1, filteredMailList.value.length - 1);
            pagedMails.value = filteredMailList.value.slice(pager.value.startIndex, pager.value.endIndex + 1);
        } else {
            pagedMails.value = [];
            pager.value.startIndex = -1;
            pager.value.endIndex = -1;
        }
        clearSelection();
    };

    const clearSelection = () => {
        ids.value = [];
    };

    const tabChanged = (tabType) => {
        isEdit.value = false;
        selectedTab.value = tabType;
        isShowMailMenu.value = false;
        selectedMail.value = null;
        searchMails();
    };

    const setImportant = (mailId) => {
        if (mailId) {
            let item = filteredMailList.value.find((d) => d.id === mailId);
            item.isImportant = !item.isImportant;
            setTimeout(() => {
                searchMails(false);
            });
        }
    };

    const setStar = (mailId) => {
        if (mailId) {
            let item = filteredMailList.value.find((d) => d.id === mailId);
            item.isStar = !item.isStar;
            setTimeout(() => {
                searchMails(false);
            });
        }
    };

    const refreshMails = () => {
        searchText.value = '';
        searchMails(false);
    };

    const setSpam = () => {
        if (ids.value.length) {
            let items = filteredMailList.value.filter((d) => ids.value.includes(d.id));
            for (let item of items) {
                item.type = item.type === 'spam' ? 'inbox' : 'spam';
            }
            if (selectedTab.value == 'spam') {
                showMessage(ids.value.length + ' El correo ha sido eliminado de Spam.');
            } else {
                showMessage(ids.value.length + ' El correo ha sido añadido a Spam.');
            }
            searchMails(false);
        }
    };

    const setArchive = () => {
        if (ids.value.length) {
            let items = filteredMailList.value.filter((d) => ids.value.includes(d.id));
            for (let item of items) {
                item.type = item.type === 'archive' ? 'inbox' : 'archive';
            }
            if (selectedTab.value == 'archive') {
                showMessage(ids.value.length + ' El correo ha sido eliminado del Archivo.');
            } else {
                showMessage(ids.value.length + ' Se ha añadido el correo al archivo.');
            }
            searchMails(false);
        }
    };

    const setGroup = (group) => {
        if (ids.value.length) {
            let items = filteredMailList.value.filter((d) => ids.value.includes(d.id));
            for (let item of items) {
                item.group = group;
            }

            showMessage(ids.value.length + ' El correo se ha agrupado como ' + group.toUpperCase());
            clearSelection();
            setTimeout(() => {
                searchMails(false);
            });
        }
    };

    const setAction = (type) => {
        if (ids.value.length) {
            const totalSelected = ids.value.length;
            let items = filteredMailList.value.filter((d) => ids.value.includes(d.id));
            for (let item of items) {
                if (type === 'trash') {
                    item.type = 'trash';
                    item.group = '';
                    item.isStar = false;
                    item.isImportant = false;
                    showMessage(totalSelected + ' El correo ha sido eliminado.');
                    searchMails(false);
                } else if (type === 'read') {
                    item.isUnread = false;
                    showMessage(totalSelected + ' El correo ha sido marcado como leído.');
                } else if (type === 'unread') {
                    item.isUnread = true;
                    showMessage(totalSelected + ' El correo ha sido marcado como no leído.');
                } else if (type === 'important') {
                    item.isImportant = true;
                    showMessage(totalSelected + ' El correo ha sido marcado como importante.');
                } else if (type === 'unimportant') {
                    item.isImportant = false;
                    showMessage(totalSelected + ' El correo ha sido marcado como no importante.');
                } else if (type === 'star') {
                    item.isStar = true;
                    showMessage(totalSelected + ' El correo ha sido marcado como Estrella.');
                }
                //restore & permanent delete
                else if (type === 'restore') {
                    item.type = 'inbox';
                    showMessage(totalSelected + ' Correo restaurado.');
                    searchMails(false);
                } else if (type === 'delete') {
                    mailList.value = mailList.value.filter((d) => d.id != item.id);
                    showMessage(totalSelected + ' Correo eliminado permanentemente.');
                    searchMails(false);
                }
            }
            clearSelection();
        }
    };

    const truncateText = (text) => {
        // Verificar si el texto es más largo que 50 caracteres
        if (text.length > 40) {
            // Recortar a 50 caracteres y agregar '...'
            return text.slice(0, 40) + '...';
        }

        // Si es 50 caracteres o menos, devolver el texto original
        return text;
    }

    const saveMail = (type, id) => {
        if (!params.value.to) {
            showMessage('Se requiere dirección de correo electrónico.', 'error');
            return false;
        }
        if (!params.value.title) {
            showMessage('El título del correo electrónico es obligatorio.', 'error');
            return false;
        }

        let maxId = 0;
        if (!params.value.id) {
            maxId = mailList.value.length ? mailList.value.reduce((max, character) => (character.id > max ? character.id : max), mailList.value[0].id) : 0;
        }
        let cDt = new Date();

        let obj = {
            id: null,
            path: '',
            firstName: '',
            lastName: '',
            email: params.value.to,
            date: cDt.getMonth() + 1 + '/' + cDt.getDate() + '/' + cDt.getFullYear(),
            time: cDt.toLocaleTimeString(),
            title: params.value.title,
            displayDescription: quillEditorObj.value.getText(),
            type: 'draft',
            isImportant: false,
            group: '',
            isUnread: false,
            description: params.value.description,
            attachments: null,
        };
        if (params.value.file && params.value.file.length) {
            obj.attachments = [];
            for (let file of params.value.file) {
                let flObj = {
                    name: file.name,
                    size: getFileSize(file.size),
                    type: getFileType(file.type),
                };
                obj.attachments.push(flObj);
            }
        }
        if (type === 'save' || type === 'save_reply' || type === 'save_forward') {
            //saved to draft

            obj.type = 'draft';
            mailList.value.splice(0, 0, obj);
            searchMails();

            showMessage('El correo se ha guardado correctamente en borrador..');
        } else if (type === 'send' || type === 'reply' || type === 'forward') {
            //saved to sent mail
            params.value.displayDescription = truncateText(obj.displayDescription);
            params.value.type = 'sent_mail';
            axios.post(route('crm_send_message_email'), params.value, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((response) => {
                return response.data;
            }).then((res) => {
                obj.type = 'sent_mail';
                mailList.value.splice(0, 0, obj);
                refreshPage();

                showMessage('El correo ha sido enviado exitosamente.');
            });
            
        }

        selectedMail.value = null;
        isEdit.value = false;
    };

    const getFileSize = (file_type) => {
        let type = 'file';
        if (file_type.includes('image/')) {
            type = 'image';
        } else if (file_type.includes('application/x-zip')) {
            type = 'zip';
        }
        return type;
    };

    const getFileType = (total_bytes) => {
        let size = '';
        if (total_bytes < 1000000) {
            size = Math.floor(total_bytes / 1000) + 'KB';
        } else {
            size = Math.floor(total_bytes / 1000000) + 'MB';
        }
        return size;
    };

    const selectMail = (item) => {
        if (item) {
            if (item.type != 'draft') {
                if (item && item.isUnread) {
                    item.isUnread = false;
                }
                selectedMail.value = item;
            } else {
                openMail('draft', item);
            }
        } else {
            selectedMail.value = '';
        }
    };

    const openMail = (type, item) => {
        if (type === 'add') {
            isShowMailMenu.value = false;
            params.value = JSON.parse(JSON.stringify(defaultData.value));
        } else if (type === 'draft') {
            let data = JSON.parse(JSON.stringify(item));
            params.value = data;
            params.value.from = defaultData.value.from;
            params.value.to = data.email;
            params.value.displayDescription = data.email;
        } else if (type === 'reply') {
            let data = JSON.parse(JSON.stringify(item));
            params.value.id = defaultData.value.id;
            params.value = data;
            params.value.from = defaultData.value.from;
            params.value.to = data.email;
            params.value.title = 'Re: ' + params.value.title;
            params.value.displayDescription = 'Re: ' + params.value.title;
            params.value.description = '';

        } else if (type === 'forward') {
            let data = JSON.parse(JSON.stringify(item));
            params.value = data;
            params.value.from = defaultData.value.from;
            params.value.to = data.email;
            params.value.title = 'Fwd: ' + params.value.title;
            params.value.displayDescription = 'Fwd: ' + params.value.title;
        }
        isEdit.value = true;
    };

    const closeMsgPopUp = () => {
        isEdit.value = false;
        selectedTab.value = 'inbox';
        searchMails();
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

    const handleFileChange = (event) => {
        let file = event.target.files[0]; // Obtener el primer archivo
        params.value.file = file;
    }

    const refreshPage = () => {
        router.visit(route('crm_mailbox_dashboard'), {
            method: 'get',
            replace: true,
            preserveState: true,
            preserveScroll: true
        })
    }
</script>
<template>
    <AppLayout title="MailBox">
        <Navigation :routeModule="route('crm_dashboard')" :titleModule="'CRM'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Buzón de correo</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div class="flex gap-5 relative sm:h-[calc(100vh_-_150px)] h-full">
                <div
                    class="overlay bg-black/60 z-[5] w-full h-full absolute rounded-md hidden"
                    :class="{ '!block xl:!hidden': isShowMailMenu }"
                    @click="isShowMailMenu = !isShowMailMenu"
                ></div>
                <div
                    class="panel xl:block p-4 dark:gray-50 max-w-xs w-full flex-none space-y-3 xl:relative absolute z-10 xl:h-auto h-full hidden ltr:xl:rounded-r-md ltr:rounded-r-none rtl:xl:rounded-l-md rtl:rounded-l-none overflow-hidden"
                    :class="{ '!block': isShowMailMenu }"
                >
                    <div class="flex flex-col h-full pb-16">
                        <div class="pb-5">
                            <button class="btn btn-primary w-full" type="button" @click="openMail('add', null)">Nuevo mensaje</button>
                        </div>
                        <perfect-scrollbar
                            :options="{
                                swipeEasing: true,
                                wheelPropagation: false,
                            }"
                            class="relative ltr:pr-3.5 rtl:pl-3.5 ltr:-mr-3.5 rtl:-ml-3.5 h-full grow"
                        >
                            <div class="space-y-1">
                                <template v-if="mailList && mailList.filter((d) => d.type == 'inbox').length > 0">
                                    <button
                                        type="button"
                                        class="w-full flex justify-between items-center p-2 hover:bg-white-dark/10 rounded-md dark:hover:text-primary hover:text-primary dark:hover:bg-[#181F32] font-medium h-10"
                                        :class="{
                                            'bg-gray-100 dark:text-primary text-primary dark:bg-[#181F32]': !isEdit && selectedTab === 'inbox',
                                        }"
                                        @click="tabChanged('inbox')"
                                    >
                                        <div class="flex items-center">
                                            <icon-mail class="w-5 h-5 shrink-0" />

                                            <div class="ltr:ml-3 rtl:mr-3">Recibidos</div>
                                        </div>
                                        <div class="bg-primary-light dark:bg-[#060818] rounded-md py-0.5 px-2 font-semibold whitespace-nowrap">
                                            {{ mailList && mailList.filter((d) => d.type == 'inbox').length }}
                                        </div>
                                    </button>
                                </template>
                                <template v-if="mailList && mailList.filter((d) => d.type == 'sent_mail').length > 0">
                                    <button
                                        type="button"
                                        class="w-full flex justify-between items-center p-2 hover:bg-white-dark/10 rounded-md dark:hover:text-primary hover:text-primary dark:hover:bg-[#181F32] font-medium h-10"
                                        :class="{
                                            'bg-gray-100 dark:text-primary text-primary dark:bg-[#181F32]': !isEdit && selectedTab === 'sent_mail',
                                        }"
                                        @click="tabChanged('sent_mail')"
                                    >
                                        <div class="flex items-center">
                                            <icon-send class="shrink-0" />

                                            <div class="ltr:ml-3 rtl:mr-3">Enviados</div>
                                        </div>
                                        <div class="bg-primary-light dark:bg-[#060818] rounded-md py-0.5 px-2 font-semibold whitespace-nowrap">
                                            {{ mailList && mailList.filter((d) => d.type == 'sent_mail').length }}
                                        </div>
                                    </button>
                                </template>
                                <!-- <button
                                    type="button"
                                    class="w-full flex justify-between items-center p-2 hover:bg-white-dark/10 rounded-md dark:hover:text-primary hover:text-primary dark:hover:bg-[#181F32] font-medium h-10"
                                    :class="{
                                        'bg-gray-100 dark:text-primary text-primary dark:bg-[#181F32]': !isEdit && selectedTab === 'trash',
                                    }"
                                    @click="tabChanged('trash')"
                                >
                                    <div class="flex items-center">
                                        <icon-trash-lines class="shrink-0" />

                                        <div class="ltr:ml-3 rtl:mr-3">Papelera</div>
                                    </div>
                                </button> -->
                            </div>
                        </perfect-scrollbar>
                    </div>
                </div>
                <div class="panel p-0 flex-1 overflow-x-hidden h-full">
                    <div v-show="!selectedMail && !isEdit" class="flex flex-col h-full">
                        <div class="flex justify-between items-center flex-wrap-reverse gap-4 p-4">
                            <div class="flex items-center w-full sm:w-auto">
                                <div class="ltr:mr-4 rtl:ml-4">
                                    <input
                                        type="checkbox"
                                        class="form-checkbox"
                                        :checked="checkAllCheckbox"
                                        :value="checkAllCheckbox"
                                        @change="checkAll($event.target.checked)"
                                    />
                                </div>
                                <div class="ltr:mr-4 rtl:ml-4">
                                    <button type="button" v-tippy:refresh class="hover:text-primary flex items-center" @click="refreshPage()">
                                        <icon-refresh />
                                    </button>
                                    <tippy target="refresh">Refrescar</tippy>
                                </div>
                                <template v-if="selectedTab != 'trash'">
                                    <ul class="flex grow items-center sm:flex-none gap-4 ltr:sm:mr-4 rtl:sm:ml-4">
                                        <li>
                                            <div class="dropdown">
                                                <Popper
                                                    :placement="store.rtlClass === 'rtl' ? 'bottom-start' : 'bottom-end'"
                                                    offsetDistance="0"
                                                    class="align-middle"
                                                >
                                                    <div>
                                                        <button type="button" v-tippy:group class="hover:text-primary flex items-center">
                                                            <icon-wheel />
                                                        </button>
                                                        <tippy target="group">Estado</tippy>
                                                    </div>
                                                    <template #content="{ close }">
                                                        <ul @click="close()">
                                                            <li>
                                                                <a href="javascript:;" @click="setGroup('Resuelto')">
                                                                    <div class="w-2 h-2 rounded-full bg-primary ltr:mr-3 rtl:ml-3 shrink-0"></div>
                                                                    Resuelto
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" @click="setGroup('Enviado')">
                                                                    <div class="w-2 h-2 rounded-full bg-warning ltr:mr-3 rtl:ml-3 shrink-0"></div>
                                                                    Enviado
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" @click="setGroup('En revisión')">
                                                                    <div class="w-2 h-2 rounded-full bg-success ltr:mr-3 rtl:ml-3 shrink-0"></div>
                                                                    Revisión
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" @click="setGroup('Cerrado')">
                                                                    <div class="w-2 h-2 rounded-full bg-danger ltr:mr-3 rtl:ml-3 shrink-0"></div>
                                                                    Cerrado
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </template>
                                                </Popper>
                                            </div>
                                        </li>
                                        <!-- <li>
                                            <div class="dropdown">
                                                <Popper
                                                    :placement="store.rtlClass === 'rtl' ? 'bottom-start' : 'bottom-end'"
                                                    offsetDistance="0"
                                                    class="align-middle"
                                                >
                                                    <button type="button" class="hover:text-primary flex items-center">
                                                        <icon-horizontal-dots class="rotate-90 opacity-70" />
                                                    </button>
                                                    <template #content="{ close }">
                                                        <ul @click="close()" class="whitespace-nowrap">
                                                            <li>
                                                                <a href="javascript:;" class="w-full" @click="setAction('trash')">
                                                                    <icon-trash-lines class="ltr:mr-2 rtl:ml-2 shrink-0" />
                                                                    Eliminar
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </template>
                                                </Popper>
                                            </div>
                                        </li> -->
                                    </ul>
                                </template>
                                <template v-if="selectedTab == 'trash'">
                                    <ul class="flex flex-1 items-center sm:flex-none gap-4 ltr:sm:mr-3 rtl:sm:ml-4">
                                        <li>
                                            <div>
                                                <button type="button" v-tippy:delete class="block hover:text-primary" @click="setAction('delete')">
                                                    <icon-trash />
                                                </button>
                                                <tippy target="delete">Permanently Delete</tippy>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <button type="button" v-tippy:restore class="block hover:text-primary" @click="setAction('restore')">
                                                    <icon-restore />
                                                </button>
                                                <tippy target="restore">Restore</tippy>
                                            </div>
                                        </li>
                                    </ul>
                                </template>
                            </div>
                            <div class="flex justify-between items-center sm:w-auto w-full">
                                <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                    <button type="button" class="xl:hidden hover:text-primary block ltr:mr-3 rtl:ml-3" @click="isShowMailMenu = !isShowMailMenu">
                                        <icon-menu />
                                    </button>
                                    <div class="relative group">
                                        <input
                                            type="text"
                                            placeholder="Buscar"
                                            class="form-input ltr:pr-8 rtl:pl-8 peer"
                                            v-model="searchText"
                                            @keyup="searchMails()"
                                        />
                                        <div class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">
                                            <icon-search />
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="ltr:mr-4 rtl:ml-4">
                                        <button type="button" v-tippy:settings class="hover:text-primary">
                                            <icon-settings />
                                        </button>
                                        <tippy target="settings">Ajustes</tippy>
                                    </div>
                                    <div>
                                        <button type="button" v-tippy:help class="hover:text-primary">
                                            <icon-help-circle class="w-6 h-6" />
                                        </button>
                                        <tippy target="help">Ayuda</tippy>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-px border-b border-[#e0e6ed] dark:border-[#1b2e4b]"></div>
                        <div class="flex flex-wrap flex-col md:flex-row xl:w-auto justify-between items-center px-4 pb-4">
                            <div class="w-full sm:w-auto grid grid-cols-2 sm:grid-cols-4 gap-3 mt-4">

                                <button
                                    type="button"
                                    class="btn btn-outline-warning flex"
                                    :class="{ 'text-white bg-warning': selectedTab === 'En revisión' }"
                                    @click="tabChanged('En revisión')"
                                >
                                    <icon-message-2 class="w-5 h-5 ltr:mr-1 rtl:ml-1" />
                                    Revisión
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-outline-success flex"
                                    :class="{ 'text-white bg-success': selectedTab === 'Resuelto' }"
                                    @click="tabChanged('Resuelto')"
                                >
                                    <icon-users class="ltr:mr-1 rtl:ml-1" />
                                    Resuelto
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-outline-danger flex"
                                    :class="{ 'text-white bg-danger': selectedTab === 'Cerrado' }"
                                    @click="tabChanged('Cerrado')"
                                >
                                    <icon-tag class="ltr:mr-1 rtl:ml-1" />
                                    Cerrado
                                </button>
                            </div>
                            <div class="mt-4 md:flex-auto flex-1">
                                <div class="flex items-center md:justify-end justify-center">
                                    <div class="ltr:mr-3 rtl:ml-3">
                                        {{ pager.startIndex + 1 + '-' + (pager.endIndex + 1) + ' of ' + filteredMailList.length }}
                                    </div>
                                    <button
                                        type="button"
                                        :disabled="pager.currentPage == 1"
                                        class="bg-[#f4f4f4] rounded-md p-1 enabled:hover:bg-primary-light dark:bg-white-dark/20 enabled:dark:hover:bg-white-dark/30 ltr:mr-3 rtl:ml-3 disabled:opacity-60 disabled:cursor-not-allowed"
                                        @click="pager.currentPage--, searchMails(false)"
                                    >
                                        <icon-caret-down class="w-5 h-5 rtl:-rotate-90 rotate-90" />
                                    </button>
                                    <button
                                        type="button"
                                        :disabled="pager.currentPage == pager.totalPages"
                                        class="bg-[#f4f4f4] rounded-md p-1 enabled:hover:bg-primary-light dark:bg-white-dark/20 enabled:dark:hover:bg-white-dark/30 disabled:opacity-60 disabled:cursor-not-allowed"
                                        @click="pager.currentPage++, searchMails(false)"
                                    >
                                        <icon-caret-down class="w-5 h-5 rtl:rotate-90 -rotate-90" />
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="h-px border-b border-[#e0e6ed] dark:border-[#1b2e4b]"></div>
                        <template v-if="pagedMails.length">
                            <div class="table-responsive grow overflow-y-auto min-h-[300px]">
                                <table>
                                    <tbody>
                                        <template v-for="mail in pagedMails" :key="mail.id">
                                            <tr class="cursor-pointer" @click="selectMail(mail)">
                                                <td>
                                                    <div class="flex items-center whitespace-nowrap">
                                                        <div class="ltr:mr-3 rtl:ml-3">
                                                            <input
                                                                type="checkbox"
                                                                :id="`chk-${mail.id}`"
                                                                v-model.number="ids"
                                                                :value="mail.id"
                                                                @click="$event.stopPropagation()"
                                                                class="form-checkbox"
                                                            />
                                                        </div>
                                                        
                                                        <div
                                                            class="dark:text-gray-300 whitespace-nowrap font-semibold"
                                                            :class="{
                                                                'text-gray-500 dark:!text-gray-500 font-normal': !mail.isUnread,
                                                            }"
                                                        >
                                                            {{ mail.firstName ? mail.firstName + ' ' + mail.lastName : mail.email }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-medium text-white-dark overflow-hidden min-w-[300px] line-clamp-1">
                                                        <span :class="{'text-gray-800 dark:text-gray-300 font-semibold': mail.isUnread, }" >
                                                            <span>{{ mail.title }}</span> &minus; <span>{{ truncateText(mail.displayDescription) }}</span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-2 h-2 rounded-full"
                                                            :class="{
                                                                'bg-primary': mail.group === 'Resuelto',
                                                                'bg-warning': mail.group === 'Enviado',
                                                                'bg-success': mail.group === 'En revisión',
                                                                'bg-danger': mail.group === 'Cerrado',
                                                            }"
                                                        ></div>
                                                        <template v-if="mail.attachments">
                                                            <div class="ltr:ml-4 rtl:mr-4">
                                                                <icon-paperclip />
                                                            </div>
                                                        </template>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap font-medium ltr:text-right rtl:text-left">
                                                    {{ showTime(mail) }}
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </template>
                        <template v-if="!pagedMails.length">
                            <div class="grid place-content-center min-h-[300px] font-semibold text-lg h-full">No hay datos disponibles</div>
                        </template>
                    </div>
                    <template v-if="selectedMail && !isEdit">
                        <div>
                            <div class="flex items-center justify-between flex-wrap p-4">
                                <div class="flex items-center">
                                    <button type="button" class="ltr:mr-2 rtl:ml-2 hover:text-primary" @click="selectedMail = null">
                                        <icon-arrow-left class="w-5 h-5 rotate-180" />
                                    </button>
                                    <h4 class="text-base md:text-lg font-medium ltr:mr-2 rtl:ml-2">
                                        {{ selectedMail.title }}
                                    </h4>
                                    <div class="badge bg-info hover:top-0">{{ selectedMail.type }}</div>
                                </div>
                                <div>
                                    <button type="button" v-tippy:print>
                                        <icon-printer />
                                    </button>
                                    <tippy target="print">Imprimir</tippy>
                                </div>
                            </div>
                            <div class="h-px border-b border-[#e0e6ed] dark:border-[#1b2e4b]"></div>
                            <div class="p-4 relative">
                                <div class="flex flex-wrap">
                                    <div class="flex-shrink-0 ltr:mr-2 rtl:ml-2">
                                        <img
                                            v-show="selectedMail.path"
                                            :src="selectedMail.path"
                                            class="h-12 w-12 rounded-full object-cover"
                                            alt="avatar"
                                        />
                                        <div v-show="!selectedMail.path" class="border border-gray-300 dark:border-gray-800 rounded-full p-3">
                                            <icon-user class="w-5 h-5" />
                                        </div>
                                    </div>
                                    <div class="ltr:mr-2 rtl:ml-2 flex-1">
                                        <div class="flex items-center">
                                            <div class="text-lg ltr:mr-4 rtl:ml-4 whitespace-nowrap">
                                                {{ selectedMail.firstName ? selectedMail.firstName + ' ' + selectedMail.lastName : selectedMail.email }}
                                            </div>
                                            <div>
                                                <div v-show="selectedMail.group" class="ltr:mr-4 rtl:ml-4">
                                                    <div
                                                        v-tippy:group
                                                        class="w-2 h-2 rounded-full"
                                                        :class="{
                                                            'bg-primary': selectedMail.group === 'Resuelto',
                                                            'bg-warning': selectedMail.group === 'Enviado',
                                                            'bg-success': selectedMail.group === 'En revisión',
                                                            'bg-danger': selectedMail.group === 'Cerrado',
                                                        }"
                                                    ></div>
                                                    <tippy target="group" class="capitalize">{{ selectedMail.group }}</tippy>
                                                </div>
                                            </div>
                                            <div class="text-white-dark whitespace-nowrap">{{ selectedMail.date }}</div>
                                        </div>
                                        <div class="text-white-dark flex items-center">
                                            <div class="ltr:mr-1 rtl:ml-1">
                                                {{ selectedMail.type === 'sent_mail' ? selectedMail.email : 'a mí' }}
                                            </div>
                                            <div class="dropdown">
                                                <Popper
                                                    :placement="store.rtlClass === 'rtl' ? 'bottom-start' : 'bottom-end'"
                                                    offsetDistance="0"
                                                    class="align-middle"
                                                >
                                                    <button type="button" class="mt-1.5">
                                                        <icon-caret-down class="w-5 h-5" />
                                                    </button>
                                                    <template #content>
                                                        <ul class="sm:w-56">
                                                            <li>
                                                                <div class="flex items-center px-4 py-2">
                                                                    <div class="text-white-dark ltr:mr-2 rtl:ml-2 w-1/4">De:</div>
                                                                    <div class="flex-1">
                                                                        {{ selectedMail.email_from }}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="flex items-center px-4 py-2">
                                                                    <div class="text-white-dark ltr:mr-2 rtl:ml-2 w-1/4">Para:</div>
                                                                    <div class="flex-1">
                                                                        {{ selectedMail.email_for }}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="flex items-center px-4 py-2">
                                                                    <div class="text-white-dark ltr:mr-2 rtl:ml-2 w-1/4">Fecha:</div>
                                                                    <div class="flex-1">
                                                                        {{ selectedMail.date + ', ' + selectedMail.time }}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="flex items-center px-4 py-2">
                                                                    <div class="text-white-dark ltr:mr-2 rtl:ml-2 w-1/4">Asunto:</div>
                                                                    <div class="flex-1">{{ selectedMail.title }}</div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </template>
                                                </Popper>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center justify-center space-x-3 rtl:space-x-reverse">
                                            <template v-if="$page.props.auth.user.roles[0].name == 'admin'" > 
                                                <button
                                                    type="button"
                                                    v-tippy:star
                                                    class="enabled:hover:text-warning disabled:opacity-60"
                                                    :class="{ 'text-warning': selectedMail.isStar }"
                                                    @click="setStar(selectedMail.id)"
                                                    :disabled="selectedTab === 'trash'"
                                                >
                                                    <icon-star :class="{ 'fill-warning': selectedMail.isStar }" />
                                                </button>
                                                <tippy target="star">Estrella</tippy>

                                                <button
                                                    type="button"
                                                    v-tippy:important
                                                    class="enabled:hover:text-primary disabled:opacity-60"
                                                    :class="{ 'text-primary': selectedMail.isImportant }"
                                                    @click="setImportant(selectedMail.id)"
                                                    :disabled="selectedTab === 'trash'"
                                                >
                                                    <icon-bookmark
                                                        :bookmark="false"
                                                        class="w-4.5 h-4.5 rotate-90"
                                                        :class="{ 'fill-primary': selectedMail.isImportant }"
                                                    />
                                                </button>
                                                <tippy target="important">Importante</tippy>
                                            
                                                <button type="button" v-tippy:reply class="hover:text-info" @click="openMail('reply', selectedMail)">
                                                    <icon-arrow-backward class="rtl:hidden" />
                                                    <icon-arrow-forward class="ltr:hidden" />
                                                </button>
                                                <tippy target="reply">Responder</tippy>
                                            </template>
                                            <!-- <button type="button" v-tippy:forward class="hover:text-info" @click="openMail('forward', selectedMail)">
                                                <icon-arrow-backward class="ltr:hidden" />
                                                <icon-arrow-forward class="rtl:hidden" />
                                            </button>
                                            <tippy target="forward">Forward</tippy> -->
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-8 prose dark:prose-p:text-white prose-p:text-sm md:prose-p:text-sm max-w-full prose-img:inline-block prose-img:m-0"
                                    v-html="selectedMail.description"
                                ></div>
                                <p class="mt-4">Atentamente,</p>
                                <p>{{ selectedMail.firstName + ' ' + selectedMail.lastName }}</p>

                                <div class="mt-8" v-show="selectedMail.attachments">
                                    <div class="text-base mb-4">Attachments</div>
                                    <div class="h-px border-b border-[#e0e6ed] dark:border-[#1b2e4b]"></div>
                                    <div class="flex items-center flex-wrap mt-6">
                                        <template v-for="(attachment, i) in selectedMail.attachments" :key="i">
                                            <button
                                                type="button"
                                                class="flex items-center ltr:mr-4 rtl:ml-4 mb-4 border border-[#e0e6ed] dark:border-[#1b2e4b] rounded-md hover:text-primary hover:border-primary transition-all duration-300 px-4 py-2.5 relative group"
                                            >
                                                <template v-if="attachment.type === 'image'">
                                                    <icon-gallery />
                                                </template>
                                                <template v-if="attachment.type === 'folder'">
                                                    <icon-folder />
                                                </template>
                                                <template v-if="attachment.type === 'zip'">
                                                    <icon-zip-file />
                                                </template>
                                                <template v-if="attachment.type !== 'zip' && attachment.type !== 'image' && attachment.type !== 'folder'">
                                                    <icon-txt-file class="w-5 h-5" />
                                                </template>
                                                <div class="ltr:ml-3 rtl:mr-3">
                                                    <p class="text-xs text-primary font-semibold">
                                                        {{ attachment.name }}
                                                    </p>
                                                    <p class="text-[11px] text-gray-400 dark:text-gray-600">
                                                        {{ attachment.size }}
                                                    </p>
                                                </div>
                                                <div
                                                    class="bg-dark-light/40 z-[5] w-full h-full absolute ltr:left-0 rtl:right-0 top-0 rounded-md hidden group-hover:block"
                                                ></div>
                                                <div
                                                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full p-1 btn btn-primary hidden group-hover:block z-10"
                                                >
                                                    <icon-download class="w-4.5 h-4.5" />
                                                </div>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template v-if="isEdit">
                        <div class="relative">
                            <div class="py-4 px-6 flex items-center">
                                <button type="button" class="xl:hidden hover:text-primary block ltr:mr-3 rtl:ml-3" @click="isShowMailMenu = !isShowMailMenu">
                                    <icon-menu />
                                </button>
                                <h4 class="text-lg text-gray-600 dark:text-gray-400 font-medium">Mensaje</h4>
                            </div>
                            <div class="h-px bg-gradient-to-l from-indigo-900/20 via-black dark:via-white to-indigo-900/20 opacity-[0.1]"></div>
                            <form class="p-6 grid gap-6">
                                <div>
                                    <input type="text" class="form-input" placeholder="tu correo electronico" v-model="params.from" />
                                </div>

                                <!-- <div>
                                    <input type="text" class="form-input" placeholder="Enter Cc" v-model="params.cc" />
                                </div> -->

                                <div>
                                    <input type="text" class="form-input" placeholder="Escribir Asunto" v-model="params.title" />
                                </div>
                                
                                <div>
                                    <quillEditor
                                        ref="editor"
                                        v-model:value="params.description"
                                        :options="editorOptions"
                                        style="min-height: 200px"
                                        @ready="quillEditorReady($event)"
                                    ></quillEditor>
                                </div>

                                <div class="mt-8">
                                    <input
                                        id="file"
                                        type="file"
                                        class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary"
                                        accept="image/*,.zip,.pdf,.xls,.xlsx,.txt.doc,.docx"
                                        @change="handleFileChange"
                                    />
                                </div>

                                <div class="flex items-center ltr:ml-auto rtl:mr-auto mt-8">
                                    <button type="button" class="btn btn-outline-danger ltr:mr-3 rtl:ml-3" @click="closeMsgPopUp">Cancelar</button>
                                    <!-- <button type="button" class="btn btn-success ltr:mr-3 rtl:ml-3" @click="saveMail('save', null)">Save</button> -->
                                    <button type="button" class="btn btn-primary" @click="saveMail('send', params.id)">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

