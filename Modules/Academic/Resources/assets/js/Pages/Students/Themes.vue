<script  setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import { ref } from 'vue';
    import { Link, useForm, router } from '@inertiajs/vue3';
    import IconSend from '@/Components/vristo/icon/icon-send.vue';
    import IconSquareRotated from '@/Components/vristo/icon/icon-square-rotated.vue';
    import IconTrash from '@/Components/vristo/icon/icon-trash.vue';
    import IconEdit from '@/Components/vristo/icon/icon-edit.vue';
    import IconFilePdf from '@/Components/vristo/icon/icon-file-pdf.vue';
    import IconVideo from '@/Components/vristo/icon/icon-video.vue';
    import IconFile from '@/Components/vristo/icon/icon-file.vue';
    import IconX from '@/Components/vristo/icon/icon-x.vue';
    import InputError from '@/Components/InputError.vue';
    import Swal2 from 'sweetalert2';
    import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';

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
        theme_id: props.module.themes[0].id,
        message: null
    });

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
        //modifiedContent = modifiedContent.replace(/height="\d+"/g, `height="${newHeight.value}"`);
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
            commentsData.value = data
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
        commentsData.value[index]['edit_status'] = true;
        setTimeout(() => {
            document.getElementById('ctnTextarea' + index).focus();
        }, 0);
    }

    const editComment = (comment, index) => {
        commentsData.value[index]['loading'] = true;
        axios.put(route('aca_lesson_comments_update',comment.id),comment).then((res) => {
            commentsData.value[index]['loading'] = false;
            commentsData.value[index]['edit_status'] = false;
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
                commentsData.value.splice(index,1);
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

    const contentsData = ref(props.module.themes[0].contents);
    const commentsData = ref(props.module.themes[0].comments);

    const selectTheme = (theme) => {
        contentsData.value = theme.contents;
        selectedTab.value = theme.id
        themeSelected.value = theme;
        formComment.theme_id = theme.id
        getComment(theme.id);
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
            <div class="prose bg-[#f1f2f3] px-4 py-4 sm:px-8 sm:py-4 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light">
                <h2 class="text-dark mb-5  mt-4 text-center text-4xl dark:text-white-light">
                    {{ course.description }}
                </h2>
                <p class="lead mt-3 mb-4 text-center dark:text-white-light">
                    {{ module.description }}
                </p>
                <blockquote class="text-black p-5 ltr:pl-3.5 rtl:pr-3.5 bg-white shadow-md rounded-tr-md rounded-br-md border border-white-light border-l-2 !border-l-primary dark:bg-[#060818] dark:border-[#060818]">
                    <div class="flex items-start">
                        <div class="w-14 h-14 ltr:mr-5 rtl:ml-5 flex-none">
                            <img :src="getImage(course.teacher.person.image)" alt="" class="w-14 h-14 rounded-full object-cover m-auto" />
                        </div>
                        <div >
                            <h4 class="not-italic text-[#515365] dark:text-white-light m-0">
                                {{ course.teacher.person.full_name }}
                            </h4>
                            <p class="not-italic text-[#515365] text-sm dark:text-white-light m-0">
                                {{ course.teacher.person.presentacion }}
                            </p>
                        </div>
                    </div>
                </blockquote>
            </div>
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
                            <div>
                                <h5 class="pb-3 text-gray-900 border-b border-gray-400/50 dark:text-gray-50 dark:border-zinc-700">
                                    COMENTARIOS
                                </h5>
                                <template v-if="commentsLoading">
                                    <div class="flex items-center mt-4">
                                        <svg class="w-10 h-10 me-3 text-gray-200 dark:text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                        </svg>
                                        <div>
                                            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32 mb-2"></div>
                                            <div class="w-48 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
                                        </div>
                                    </div>
                                </template>
                                <template v-else>
                                    <template v-if="commentsData.length > 0">
                                        <div v-for="(comment, ibex) in commentsData" class="mt-8">
                                            <div class="flex align-top">
                                                <div class="shrink-0">
                                                    <img v-if="comment.user.avatar" class="p-1 rounded-full w-14 h-14 ring-2 ring-gray-100/20" :src="getImage(comment.user.avatar)" alt="img">
                                                    <img v-else :src="'https://ui-avatars.com/api/?name='+comment.user.name+'&size=150&rounded=true'" class="p-1 rounded-full w-14 h-14 ring-2 ring-gray-100/20" :alt="comment.user.name"/>
                                                </div>
                                                <div class="ltr:ml-3 rtl:mr-3 grow">
                                                    <small class="text-xs text-gray-500 ltr:float-right rtl:float-left dark:text-gray-300"><i class="uil uil-clock"></i> {{ comment.time_elapsed }}</small>
                                                    <a href="javascript:(0)" class="text-gray-900 transition-all duration-500 ease-in-out hover:bg-violet-500 dark:text-gray-50"><h6 class="mb-0 text-16 mt-sm-0">{{ comment.user.name }}</h6></a>
                                                    <p class="mb-0 text-sm text-gray-500 dark:text-gray-300">{{ comment.created_atx }}</p>

                                                    <div v-show="comment.edit_status">
                                                        <form @submit.prevent="editComment(comment,ibex)" class="mt-2 contact-form">
                                                            <div>
                                                                <textarea v-model="comment.description" :id="'ctnTextarea'+ibex" :ref="'ctnTextarea' + ibex" rows="3" class="form-textarea" placeholder="Escribe aqui..." required></textarea>
                                                            </div>

                                                            <div class="flex justify-end mt-4">
                                                                <button name="submit" type="submit" class="btn btn-danger hover:-translate-y-1" :class="{ 'opacity-25': comment.loading }" :disabled="comment.loading">
                                                                    Editar mensaje 
                                                                    <svg v-if="comment.loading" aria-hidden="true" role="status" class="inline w-4 h-4 ml-2 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                                                    </svg>
                                                                    <icon-send v-else class="ml-2" />
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <p v-if="!comment.edit_status" class="mb-0 italic text-gray-500 dark:text-gray-300">{{ comment.description }}</p>
                                                    
                                                    <div class="mt-4">
                                                        <ul class="flex space-x-4 rtl:space-x-reverse font-bold">
                                                            <!-- <li>
                                                                <a href="javascript:;" class="flex items-center hover:text-primary">
                                                                <icon-message class="mr-1 w-4 h-4" />
                                                                Responder
                                                                </a>
                                                            </li> -->
                                                            <!-- megusta y no me gusta  -->
                                                            <!-- <li>
                                                                <a href="javascript:;" class="flex items-center hover:text-primary">
                                                                    <font-awesome-icon :icon="faThumbsUp" class="mr-1" />
                                                                    {{ comment.i_like == null ? 0 : comment.i_like }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" class="flex items-center hover:text-primary">
                                                                    <font-awesome-icon :icon="faThumbsDown" class="mr-1" />
                                                                    {{ comment.not_like == null ? 0 : comment.not_like }}
                                                                </a>
                                                            </li> -->
                                                            <li v-if="$page.props.auth.user.id == comment.user.id">
                                                                <a @click="activeEditComment(ibex)" href="javascript:;" class="flex items-center hover:text-primary">
                                                                    <icon-edit class="mr-1 w-4 h-4" />
                                                                    Editar
                                                                </a>
                                                            </li>
                                                            <li v-if="$page.props.auth.user.id == comment.user.id">
                                                                <a @click="destroyComment(comment,ibex)" href="javascript:;" class="flex items-center hover:text-primary">
                                                                    <icon-trash class="mr-1 w-4 h-4" />
                                                                    Eliminar
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </template>                  
                                <form @submit.prevent="createComment" class="mt-8 contact-form">
                                    <div>
                                        <label for="ctnTextarea">Dejar un comentario</label>
                                        <textarea v-model="formComment.message" id="ctnTextarea" rows="3" class="form-textarea" placeholder="Escribe aqui..." required></textarea>
                                        <InputError :message="formComment.errors.message" class="mt-2" />
                                    </div>

                                    <div class="flex justify-end mt-6">
                                        <button name="submit" type="submit" id="submit" :class="{ 'opacity-25': formComment.processing }" :disabled="formComment.processing" class="btn btn-primary hover:-translate-y-1">
                                            Enviar mensaje
                                            <svg v-if="formComment.processing" aria-hidden="true" role="status" class="inline w-4 h-4 ml-2 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                            </svg>
                                            <icon-send v-else class="ml-2" />
                                        </button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
         <!-- Modal -->
        <TransitionRoot appear :show="displayModalVideo" as="template">
            <Dialog as="div" @close="closeSelectedVideo" class="relative z-50">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <DialogOverlay class="fixed inset-0 bg-[black]/60" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-start justify-center px-4 py-8">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel class="relative overflow-hidden w-full max-w-3xl py-8">
                            <button @click="closeSelectedVideo" type="button" class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none">
                                <icon-x />
                            </button>
                            <div class="p-5" v-html="videoSelected"></div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
            </Dialog>
        </TransitionRoot>

    </AppLayout>
</template>