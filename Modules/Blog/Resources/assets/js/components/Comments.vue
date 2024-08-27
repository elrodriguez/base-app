
<script setup>
    import { Link, useForm, router } from "@inertiajs/vue3";
    import IconSend from '@/Components/vristo/icon/icon-send.vue';
    import { quillEditor } from 'vue3-quill';
    import 'vue3-quill/lib/vue3-quill.css';
    import { ref, watch } from 'vue';
    import Swal from 'sweetalert2';
    import InputError from '@/Components/InputError.vue';
    import IconHeart from '@/Components/vristo/icon/icon-heart.vue';
    import IconX from '@/Components/vristo/icon/icon-x.vue';
    import iconArrowBackward from '@/Components/vristo/icon/icon-arrow-backward.vue';

    const props = defineProps({
        comments: {
            type: Object,
            default: () => ({})
        },
        article: {
            type: Object,
            default: null
        }
    });

    const commentsData = ref([]);

    watch(() => {
        commentsData.value = props.comments;
    });

    const formatDateComment = (dateString) => {
        const dateObj = new Date(dateString);
        const options = { month: 'short', day: 'numeric', year: 'numeric', locale: 'es-ES' };
        return dateObj.toLocaleDateString('es-ES', options);
    }

    const formComment = useForm({
        article_id: props.article.id,
        message: null,
        comment_id: null
    });

    const saveComment = () => {
        formComment.post(route('blog_comment_store'), {
            errorBag: 'saveComment',
            preserveScroll: true,
            preserveScroll: true,
            onSuccess: () => {
                formComment.reset('message');
                router.visit(route('blog_article_show_studante',props.article.url), {
                    method: 'get',
                    replace: false,
                    preserveState: true,
                    preserveScroll: true,
                });
                showMessage('Tu mensaje fue publicado correctamente');
            },
        });
    }

    const options = ref({
        modules: {
            toolbar: [[{ header: [1, 2, false] }], ['bold', 'italic', 'underline', 'link'], [{ list: 'ordered' }, { list: 'bullet' }], ['clean']],
        },
        placeholder: 'Escribe aqui tu mensaje',
    });

    const showMessage = (msg = '', type = 'success') => {
        const toast  = Swal.mixin({
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

    const xasset = assetUrl;

    const getImage = (path) => {
        return xasset + 'storage/'+ path;
    }

    const saveAppreciate = (index) => {
        let comm = commentsData.value[index];
        axios({
            method: 'post',
            url: route('blog_comment_appreciate_store'),
            data: {
                id: comm['id']
            }
        }).then((res)=>{
            commentsData.value[index].appreciate = res.data.appreciate
        });
    }

    const saveReply = (comment,index) => {
        axios({
            method: 'post',
            url: route('blog_comment_reply_store'),
            data: comment
        }).then((res)=>{
            commentsData.value[index].comments.push(res.data.reply);
            commentsData.value[index].reply = null;
        }).then(() => {
            showMessage('Tu mensaje fue publicado correctamente');
        });
    }

    const destroyComment = (id) => {
        Swal.fire({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Eliminar!',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            padding: '2em',
            customClass: 'sweet-alerts',
            preConfirm: () => {
                return axios.delete(route('blog_comment_destroy', id)).then((res) => {
                    if (!res.data.success) {
                        Swal.showValidationMessage(res.data.message)
                    }
                    return res
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                showMessage('Se Eliminó correctamente');
                router.visit(route('blog_article_show_studante',props.article.url), {
                    method: 'get',
                    replace: false,
                    preserveState: true,
                    preserveScroll: true,
                });
            }
        });
    }
    
</script>

<template>
    <div>
        <h5 class="pb-3 mt-8 text-xl text-gray-900 border-b border-gray-100/50 dark:text-gray-50 dark:border-zinc-700">Comentarios</h5>
        <template v-for="(comment, ixd) in commentsData">
            <div class="mt-8">
                <div class="flex align-top">
                    <div class="shrink-0">
                        <img v-if="comment.person.image"
                            class="p-1 rounded-full w-14 h-14 ring-2 ring-gray-100/20"
                            :src="getImage(comment.person.image)"
                            :alt="comment.person.full_name"
                        />
                        <img v-else :src="`https://ui-avatars.com/api/?name=${comment.person.full_name}&size=250&rounded=true`" class="p-1 rounded-full w-14 h-14 ring-2 ring-gray-100/20"/>
                    </div>
                    <div class="ltr:ml-3 rtl:mr-3 grow">
                        <small class="flex items-center text-xs text-gray-500 ltr:float-right rtl:float-left dark:text-gray-300">
                            <icon-heart @click="saveAppreciate(ixd)" style="cursor: pointer;" /> {{ comment.appreciate > 0 ? comment.appreciate : null }}
                        </small>
                        <a href="javascript:(0)" class="text-gray-900 transition-all duration-500 ease-in-out hover:bg-violet-500 dark:text-gray-50">
                            <h6 class="mb-0 text-16 mt-sm-0">{{ comment.person.full_name }}</h6>
                        </a>
                        <p class="mb-0 text-sm text-gray-500 dark:text-gray-300">{{ formatDateComment(comment.created_at) }}</p>
                        <div class="my-3 flex">
                            <div class="dropdown shrink-0">
                                <Popper :placement="'right-start'" offsetDistance="0" class="align-middle">
                                    <button type="button" class="flex items-center bg-gray-50 px-1.5 py-1 text-xs rounded text-primary dark:text-white font-medium dark:bg-gray-500">
                                        <icon-arrow-backward /> Responder
                                    </button>
                                    <template #content="{ close }">
                                        <ul class="!py-0 text-dark border dark:text-white-dark w-[300px] sm:w-[350px] divide-y dark:divide-white/10">
                                            <li>
                                                <div class="flex items-center px-4 py-2 justify-between font-semibold">
                                                   <div class="w-full">
                                                        <label :for="`ctnTextarea${ixd}`">Responder</label>
                                                        <textarea v-model="comment.reply" :id="`ctnTextarea${ixd}`" rows="3" class="form-textarea" placeholder="Escribe aqui tu mensaje" required></textarea>
                                                   </div> 
                                                </div>
                                            </li>
                                            <li>
                                                <div class="flex justify-end p-1">
                                                    <button class="btn btn-primary block btn-small" @click="saveReply(comment,ixd),close()">Enviar mensaje</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </template>
                                </Popper>
                            </div>
                            <template v-if="comment.user_id == $page.props.auth.user.id">
                                <a @click="destroyComment(comment.id)" href="javascript: void(0);" class="flex items-center bg-danger-400 px-1.5 py-1 text-xs rounded font-medium dark:bg-danger-500/20"><icon-x class="w-5 h-5"/> Eliminar</a>
                            </template>
                        </div>
                        <p v-html="comment.message" class="mb-0 italic text-gray-500 dark:text-gray-300"></p>
                        <template v-if="comment.comments.length > 0" >
                            <template v-for="(replyComment, subIxd ) in comment.comments" >
                                <div class="flex mt-8 align-top">
                                    <div class="shrink-0">
                                        <img v-if="replyComment.person.image"
                                            class="p-1 rounded-full w-14 h-14 ring-2 ring-gray-100/20"
                                            :src="getImage(replyComment.person.image)"
                                            :alt="replyComment.person.full_name"
                                        />
                                        <img v-else :src="`https://ui-avatars.com/api/?name=${comment.person.full_name}&size=250&rounded=true`" class="p-1 rounded-full h-14 w-14 ring-2 ring-gray-100/20"/>
                                    </div>
                                    <div class="ltr:ml-3 rtl:mr-3 flex-grow-1">
                                        <small class="text-xs text-gray-500 ltr:float-right rtl:float-left dark:text-gray-300">
                                            <!-- <i class="uil uil-clock"></i> 2 hrs Ago -->
                                        </small>
                                        <a href="javascript:(0)" class="text-gray-900 transition-all duration-500 ease-in-out hover:bg-violet-500 dark:text-gray-50">
                                            <h6 class="mb-0 text-16">{{ replyComment.person.full_name }}</h6>
                                        </a>
                                        <p class="mb-0 text-sm text-gray-500 dark:text-gray-300">{{ formatDateComment(replyComment.created_at) }}</p>
                                        <div v-if="replyComment.user_id == $page.props.auth.user.id" class="my-3">
                                            <a @click="destroyComment(replyComment.id)" href="javascript: void(0);" class="flex items-center bg-danger-50 px-1.5 py-1 text-xs rounded font-medium dark:bg-danger-500/20"><icon-x class="w-5 h-5"/> Eliminar</a>
                                        </div>
                                        <p v-html="replyComment.message" class="mb-0 text-gray-500 fst-italic dark:text-gray-300"></p>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </template>
        <form @submit.prevent="saveComment" class="mt-8 contact-form">
            <h5 class="pb-3 text-gray-900 border-b border-gray-100/50 dark:text-gray-50 dark:border-zinc-700">Dejar un mensaje</h5>
            <div class="grid grid-cols-12 gap-5 mt-6">
                <div class="col-span-12">
                    <div class="relative mb-3">
                        <label for="comments" class="text-gray-900 dark:text-gray-50">Mensaje</label>
                        <quillEditor v-model:value="formComment.message" :options="options" style="min-height: 200px"></quillEditor>
                        <InputError :message="formComment.errors.message" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-6">
                <div class="col-span-6 flex justify-end">
                    <button :class="{ 'opacity-25': formComment.processing }" :disabled="formComment.processing" name="submit" type="submit" id="submit" class="text-white py-3 border-transparent btn bg-blue-700 hover:-translate-y-1">
                        Enviar mensaje
                        <svg v-if="formComment.processing" aria-hidden="true" role="status" class="inline w-4 h-4 ml-2 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                        </svg>
                        <icon-send v-else class="ms-1" />
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>