
<script setup>
    import { Link, useForm } from "@inertiajs/vue3";
    import IconSend from '@/Components/vristo/icon/icon-send.vue';

    const props = defineProps({
        comments: {
            type: Object,
            default: () => ({})
        },
        article: {
            type: Object,
            default: () => ({})
        }
    });
    const formatDateComment = (dateString) => {
        const dateObj = new Date(dateString);
        const options = { month: 'short', day: 'numeric', year: 'numeric', locale: 'es-ES' };
        return dateObj.toLocaleDateString('es-ES', options);
    }

    const formComment = useForm({
        article_id: props.article.id,
        message: null
    });
</script>

<template>
    <div>
        <h5 class="pb-3 mt-8 text-xl text-gray-900 border-b border-gray-100/50 dark:text-gray-50 dark:border-zinc-700">Comentarios</h5>
        <div class="mt-8">
            <div class="flex align-top">
                <div class="shrink-0">
                    <img class="p-1 rounded-full w-14 h-14 ring-2 ring-gray-100/20" src="assets/images/user/img-01.jpg" alt="img">
                </div>
                <div class="ltr:ml-3 rtl:mr-3 grow">
                    <small class="text-xs text-gray-500 ltr:float-right rtl:float-left dark:text-gray-300"><i class="uil uil-clock"></i> 30 min Ago</small>
                    <a href="javascript:(0)" class="text-gray-900 transition-all duration-500 ease-in-out hover:bg-violet-500 dark:text-gray-50"><h6 class="mb-0 text-16 mt-sm-0">Rebecca Swartz</h6></a>
                    <p class="mb-0 text-sm text-gray-500 dark:text-gray-300">Aug 10, 2021</p>
                    <div class="my-3">
                        <a href="javascript: void(0);" class="bg-gray-50 px-1.5 py-1 text-xs rounded group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 font-medium dark:bg-violet-500/20"><i class="mdi mdi-reply"></i> Reply</a>
                    </div>
                    <p class="mb-0 italic text-gray-500 dark:text-gray-300">" There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour "</p>
                </div>
            </div>
        </div>
        <div class="mt-8">
            <div class="flex align-top">
                <div class="shrink-0">
                    <img class="p-1 rounded-full h-14 w-14 ring-2 ring-gray-100/20" src="assets/images/user/img-02.jpg" alt="img">
                </div>
                <div class="ltr:ml-3 rtl:mr-3 flex-grow-1">
                    <small class="text-xs text-gray-500 ltr:float-right rtl:float-left dark:text-gray-300"><i class="uil uil-clock"></i> 2 hrs Ago</small>
                    <a href="javascript:(0)" class="text-gray-900 transition-all duration-500 ease-in-out hover:bg-violet-500 dark:text-gray-50">
                        <h6 class="mb-0 text-16">Adam Gibson</h6></a>
                    <p class="mb-0 text-sm text-gray-500 dark:text-gray-300">Aug 10, 2021</p>
                    <div class="my-3">
                        <a href="javascript: void(0);" class="bg-gray-50 px-1.5 py-1 text-xs rounded group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 font-medium dark:bg-violet-500/20"><i class="mdi mdi-reply"></i> Reply</a>
                    </div>
                    <p class="mb-0 text-gray-500 fst-italic dark:text-gray-300">" The most important aspect of beauty was, therefore, an inherent part of an object, rather than something applied superficially, and was based on universal, recognisable truths. "</p>

                    <div class="flex mt-8 align-top">
                        <div class="shrink-0">
                            <img class="p-1 rounded-full h-14 w-14 ring-2 ring-gray-100/20" src="assets/images/user/img-04.jpg" alt="img">
                        </div>
                        <div class="ltr:ml-3 rtl:mr-3 flex-grow-1">
                            <small class="text-xs text-gray-500 ltr:float-right rtl:float-left dark:text-gray-300"><i class="uil uil-clock"></i> 2 hrs Ago</small>
                            <a href="javascript:(0)" class="text-gray-900 transition-all duration-500 ease-in-out hover:bg-violet-500 dark:text-gray-50"><h6 class="mb-0 text-16">Kiera Finch</h6></a>
                            <p class="mb-0 text-sm text-gray-500 dark:text-gray-300">Aug 10, 2021</p>
                            <div class="my-3">
                                <a href="javascript: void(0);" class="bg-gray-50 px-1.5 py-1 text-xs rounded group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 font-medium dark:bg-violet-500/20"><i class="mdi mdi-reply"></i> Reply</a>
                            </div>
                            <p class="mb-0 text-gray-500 fst-italic dark:text-gray-300">" This response is important for our ability to learn from mistakes, but it alsogives rise to self-criticism, because it is part of the threat-protection system.  "</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="#" class="mt-8 contact-form">
            <h5 class="pb-3 text-gray-900 border-b border-gray-100/50 dark:text-gray-50 dark:border-zinc-700">Dejar un mensaje</h5>
            <div class="grid grid-cols-12 gap-5 mt-6">
                <div class="col-span-12">
                    <div class="relative mb-3">
                        <label for="comments" class="text-gray-900 dark:text-gray-50">Mensaje</label>
                        <textarea v-model="formComment.message"name="comments" id="comments" rows="4" class="form-textarea" placeholder="Escribe aqui tu mensaje"></textarea>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-6">
                <div class="col-span-6 flex justify-end">
                    <button name="submit" type="submit" id="submit" class="text-white py-3 border-transparent btn bg-blue-700 hover:-translate-y-1">
                        Enviar mensaje
                        <icon-send class="ms-1" />
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>