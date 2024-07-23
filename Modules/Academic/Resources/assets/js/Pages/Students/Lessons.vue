<script  setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import { ref } from 'vue';
    import VueCollapsible from 'vue-height-collapsible/vue3';
    import { Link, useForm, router } from '@inertiajs/vue3';
    import { faFolderOpen, faNoteSticky, faLink, faVideo, faThumbsUp, faThumbsDown } from "@fortawesome/free-solid-svg-icons";
    import IconSend from '@/Components/vristo/icon/icon-send.vue';

    import IconEdit from '@/Components/vristo/icon/icon-edit.vue';
    import IconTrash from '@/Components/vristo/icon/icon-trash.vue';
    import IconMessage from '@/Components/vristo/icon/icon-message.vue';
    import InputError from '@/Components/InputError.vue';
    import Swal2 from 'sweetalert2';
    import DraggableDiv from '@/Components/DraggableDiv.vue';

    const props = defineProps({
        course: {
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

    const commentSelected = ref([]);

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
                <span>{{ course.description }}</span>
            </li>
        </ul>
        <div class="pt-5 space-y-5 relative">
            <div class="pt-5 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="panel">
                    <ul class="font-semibold">
                        <li v-for="(module, index) in course.modules" class="py-[5px]">
                            <button type="button" @click="toggleTreeview1('mo'+module.id, false)" class="text-primary">
                                <font-awesome-icon :icon="faFolderOpen" class="mr-2" />
                                {{ module.description }}
                            </button>
                            <vue-collapsible :isOpen="treeview1.includes('mo'+module.id)">
                                <ul class="ltr:pl-8 rtl:pr-8">
                                    <li v-for="(theme, indes) in module.themes" class="py-[5px] pointer">
                                        <button @click="toggleTreeview1('th'+theme.id, true, theme)" type="button" class="text-primary">
                                            <font-awesome-icon :icon="faNoteSticky" class="mr-2" />
                                            {{ theme.description }}
                                        </button>
                                        <vue-collapsible :isOpen="treeview1.includes('th'+theme.id)">
                                            <ul class="ltr:pl-8 rtl:pr-8">
                                                <li v-for="(content, indec) in theme.contents" class="py-[5px] pointer">
                                                    <a href="#" target="_blank" v-if="content.is_file"  type="button" class="text-info">
                                                        <font-awesome-icon :icon="faLink" class="mr-2" />
                                                        {{ content.description }}
                                                    </a>
                                                    <button @click="openSelectedVideo(content.content)" v-else  type="button" class="text-success">
                                                        <font-awesome-icon :icon="faVideo" class="mr-2" />
                                                        {{ content.description }}
                                                    </button>
                                                </li>
                                            </ul>
                                        </vue-collapsible>
                                    </li>
                                </ul>
                            </vue-collapsible>
                        </li>
                    </ul>
                </div>
                <div class="panel">
                    <template v-if="themeSelected.description">
                        <h5 class="pb-3 text-gray-900 border-b border-gray-400/50 dark:text-gray-50 dark:border-zinc-700">
                            COMENTARIOS
                        </h5>
                        <template v-if="comments.length > 0">
                            <div v-for="(comment, ibex) in comments" class="mt-8">
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
                        
                    </template>
                    <template v-else>

                    </template>
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