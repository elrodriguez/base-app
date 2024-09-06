<script  setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import { ref } from 'vue';
    import VueCollapsible from 'vue-height-collapsible/vue3';
    import { Link, useForm, router } from '@inertiajs/vue3';
    import { faFolderOpen, faNoteSticky, faLink, faVideo, faThumbsUp, faThumbsDown } from "@fortawesome/free-solid-svg-icons";
    import IconSend from '@/Components/vristo/icon/icon-send.vue';
    import IconSquareRotated from '@/Components/vristo/icon/icon-square-rotated.vue';
    import IconFilePdf from '@/Components/vristo/icon/icon-file-pdf.vue';
    import IconVideo from '@/Components/vristo/icon/icon-video.vue';
    import IconFile from '@/Components/vristo/icon/icon-file.vue';
    import IconMessage from '@/Components/vristo/icon/icon-message.vue';
    import InputError from '@/Components/InputError.vue';
    import Swal2 from 'sweetalert2';
    import DraggableDiv from '@/Components/DraggableDiv.vue';

    const props = defineProps({
        course: {
            type: Object,
            default: () => ({}),
        },
        module: {
            type: Object,
            default: () => ({}),
        }
    });

    const treeview1 = ref([]);
    const themeSelected = ref([]);
    const displayModalVideo = ref(false);
    const videoSelected = ref(null);

    const formComment = useForm({
        theme_id: null,
        message: null
    });

    const toggleTreeview1 = (name, pre, theme = null) => {
        if (pre) {
            themeSelected.value = theme;
            formComment.theme_id = theme.id
            getComment(theme.id);
        }else{
            formComment.theme_id = null
            themeSelected.value = [];
        }

        if (treeview1.value.includes(name)) {
            treeview1.value = treeview1.value.filter((d) => d !== name);
        } else {
            treeview1.value.push(name);
        }
    };

    const openSelectedVideo = (video) => {
        displayModalVideo.value = true;
        videoSelected.value = modifiedContent(video);
    }

    const closeSelectedVideo = () => {
        displayModalVideo.value = false;
        videoSelected.value = null;
    }

    const newHeight = ref(280);

    const modifiedContent = (content) => {
        // Copia el contenido original
        let modifiedContent = content;

        // Realiza la sustitución de la altura con un valor dinámico
        modifiedContent = modifiedContent.replace(/height="\d+"/g, `height="${newHeight.value}"`);
        modifiedContent = modifiedContent.replace(/width="\d+"/g, `width="100%"`);
        return modifiedContent;
    };

    const comments = ref([]);
    const commentsLoading = ref(false);

    const getComment = (id) => {
        commentsLoading.value = true;
        axios.get(route('aca_lesson_comments',id)).then((res) => {
            return res.data.comments;
        }).then((data) =>{
            comments.value = data
            commentsLoading.value = false
        });
    }

    const createComment = () => {
        formComment.post(route('aca_lesson_comments_store'), {
            errorBag: 'createComment',
            preserveScroll: true,
            onSuccess: () => {
                showMessage('El comentario se registró correctamente.');
                getComment(formComment.theme_id)
                formComment.message = null;
            },
        });
    }

    const activeEditComment = (index) => {
        comments.value[index]['edit_status'] = true;
        setTimeout(() => {
            document.getElementById('ctnTextarea' + index).focus();
        }, 0);
    }

    const editComment = (comment, index) => {
        comments.value[index]['loading'] = true;
        axios.put(route('aca_lesson_comments_update',comment.id),comment).then((res) => {
            comments.value[index]['loading'] = false;
            comments.value[index]['edit_status'] = false;
        }).then(() =>{
            showMessage('El comentario se actualizó correctamente.');
        });
    }

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

    const destroyComment = (comment,index) => {
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
                return axios.delete(route('aca_lesson_comments_destroy', comment.id)).then((res) => {
                    if (!res.data.success) {
                        Swal2.showValidationMessage(res.data.message)
                    }
                    return res
                });
            },
            allowOutsideClick: () => !Swal2.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                comments.value.splice(index,1);
                Swal2.fire({
                    title: 'Enhorabuena',
                    text: 'Se Eliminó correctamente',
                    icon: 'success',
                    padding: '2em',
                    customClass: 'sweet-alerts',
                });
                getComment(formComment.theme_id);
            }
        });
    }

    const baseUrl = assetUrl;

    const getImage = (path) => {
        return baseUrl + 'storage/'+ path;
    }

    const selectedTab = ref('');
    const contentsData = ref([]);
    const commentsData = ref([]);

    const selectTheme = (theme) => {
        contentsData.value = theme.contents;
        selectedTab.value = theme.id
    }

    const getPath = (path) => {
        return baseUrl + 'storage/'+ path;
    }

</script>
<template>
    <AppLayout title="Mis Cursos">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <Link :href="route('aca_mycourses')" class="text-primary hover:underline">Cursos</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <Link :href="route('aca_mycourses_lessons',course.id)" class="text-primary hover:underline">{{ course.description }}</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>{{ module.description }}</span>
            </li>
        </ul>
        <div class="pt-5 space-y-5 relative">
            <div class="grid grid-cols-6 gap-4">
                <div class="panel col-span-6 sm:col-span-2">
                    <div class="flex justify-between items-center">
                        <h1 class="font-extrabold tracking-wider">Temas</h1>
                    </div>
                    <div class="flex flex-col mt-5 gap-4 text-sm">
                        <template v-for="(theme, index) in module.themes">
                            <div @click="selectTheme(theme)" class="cursor-pointer flex justify-between items-center p-3 rounded-sm shadow-sm hover:bg-white-dark/10 dark:hover:bg-[#181F32] font-medium ltr:hover:pl-3 rtl:hover:pr-3 duration-300 dark:bg-gray-700 dark:text-white"
                                :class="selectedTab === theme.id ? 'ltr:pl-3 rtl:pr-3 bg-gray-100 dark:bg-[#181F32] text-primary' : 'bg-yellow-50 text-success'">
                                <div class="flex items-center">
                                    <icon-square-rotated class=" fill-success shrink-0" />
                                    <div class="text-left ltr:ml-3 rtl:mr-3">
                                        {{ theme.description }}
                                    </div>
                                </div>
                                <span class="font-bold text-yellow-500">{{ theme.contents.length }}</span>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="panel col-span-6 sm:col-span-4">
                    <div class="p-10 flow-root">
                        <div class="space-y-6">
                            <template v-for="(content, key) in contentsData">
                                <template v-if="content.is_file == 1">
                                    <div class="flex items-center p-3.5 rounded text-primary bg-primary-light dark:bg-primary-dark-light">
                                        <span class="w-6 h-6 ltr:mr-4 rtl:ml-4">
                                            <icon-file />
                                        </span>
                                        <span>
                                            <strong class="ltr:mr-1 rtl:ml-1">Link de archivo: </strong>
                                            {{ content.description }}
                                        </span>
                                        <a :href="content.content" target="_blank"  type="button" class="btn btn-sm bg-white text-black ltr:ml-auto rtl:mr-auto">
                                            Ir al sitio
                                        </a>
                                    </div>
                                </template>
                                <template v-else-if="content.is_file == 0">
                                    <div class="flex items-center p-3.5 rounded text-primary bg-primary-light dark:bg-primary-dark-light">
                                        <span class="w-6 h-6 ltr:mr-4 rtl:ml-4">
                                            <icon-video />
                                        </span>
                                        <span>
                                            <strong class="ltr:mr-1 rtl:ml-1">Video: </strong>
                                            {{ content.description }}
                                        </span>
                                        <button @click="openSelectedVideo(content.content)" type="button" class="btn btn-sm bg-white text-black ltr:ml-auto rtl:mr-auto">
                                            Reproducir
                                        </button>
                                    </div>
                                </template>
                                <template v-else-if="content.is_file == 2">
                                    <div class="flex items-center p-3.5 rounded text-primary bg-primary-light dark:bg-primary-dark-light">
                                        <span class="w-6 h-6 ltr:mr-4 rtl:ml-4">
                                            <icon-file-pdf />
                                        </span>
                                        <span>
                                            <strong class="ltr:mr-1 rtl:ml-1">Archivo: </strong>
                                            {{ content.description }}
                                        </span>
                                        <a :href="getPath(content.content)" target="_blank" type="button" class="btn btn-sm bg-white text-black ltr:ml-auto rtl:mr-auto">
                                            Descargar
                                        </a>
                                    </div>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <DraggableDiv :isVisible="displayModalVideo" :onClose="closeSelectedVideo">
            <template #title>VIDEO</template>
            <template #content>
                <div id="div-video-content" v-html="videoSelected" class="m-0"></div>
            </template>
        </DraggableDiv>
    </AppLayout>
</template>