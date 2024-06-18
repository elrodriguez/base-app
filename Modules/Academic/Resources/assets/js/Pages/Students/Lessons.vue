<script  setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import { ref } from 'vue';
    import VueCollapsible from 'vue-height-collapsible/vue3';
    import { Link } from '@inertiajs/vue3';
    import { faFolderOpen, faNoteSticky, faFile, faVideo } from "@fortawesome/free-solid-svg-icons";
    import IconX from '@/Components/vristo/icon/icon-x.vue';
    import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';

    const props = defineProps({
        course: {
            type: Object,
            default: () => ({}),
        }
    });

    const treeview1 = ref([]);
    const themeSelected = ref([]);
    const contentsCount = ref(0);
    const displayModalVideo = ref(false);
    const videoSelected = ref(null);

    const toggleTreeview1 = (name) => {
      if (treeview1.value.includes(name)) {
        treeview1.value = treeview1.value.filter((d) => d !== name);
      } else {
        treeview1.value.push(name);
      }
    };

    const eventContentsSelected = (theme) => {
        contentsCount.value = theme.contents.length;
        themeSelected.value = theme;
    }

    const openModalVideo = (video) => {
        videoSelected.value = video;
        displayModalVideo.value = true
    }

    const closeModalVideo = () => {
        displayModalVideo.value = false
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
        <div class="pt-5 space-y-5">
            <div class="prose bg-[#f1f2f3] px-4 py-2 sm:px-8 sm:py-4 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light">
                <h4 class="text-dark text-center text-2xl dark:text-white-light">{{ course.description }}</h4>
            </div>
            <div class="pt-5 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="panel">
                    <ul class="font-semibold">
                        <li v-for="(module, index) in course.modules" class="py-[5px]">
                            <button type="button" @click="toggleTreeview1(module.id)">
                                <font-awesome-icon :icon="faFolderOpen" class="mr-2" />
                                {{ module.description }}
                            </button>
                            <vue-collapsible :isOpen="treeview1.includes(module.id)">
                                <ul class="ltr:pl-8 rtl:pr-8">
                                    <li v-for="(theme, indes) in module.themes" class="py-[5px] pointer">
                                        <font-awesome-icon :icon="faNoteSticky" class="mr-2" />
                                        <button :class="themeSelected.id == theme.id ? 'text-primary' : ''" @click="eventContentsSelected(theme)" type="button">{{ theme.description }}</button>
                                    </li>
                                </ul>
                            </vue-collapsible>
                        </li>
                    </ul>
                </div>
                <div class="panel">
                    <div class="max-w-[900px] mx-auto">
                        <template v-for="(content, indec) in themeSelected.contents" >
                            <div v-if="contentsCount == (indec + 1)" class="flex">
                                <div class="relative before:absolute before:left-1/2 before:-translate-x-1/2 before:top-[15px] before:w-2.5 before:h-2.5 before:border-2 before:border-info before:rounded-full"></div>
                                <div class="p-2.5 self-center ltr:ml-2.5 rtl:ltr:mr-2.5 rtl:ml-2.5 w-full">
                                    <p class="text-[#3b3f5c] dark:text-white-light font-semibold text-[16px]">
                                        {{ content.description }}
                                    </p>
                                    <p class="text-white-dark text-xs font-bold self-center min-w-[100px] max-w-[150px] ">
                                        <a :href="content.content" target="_blank" v-if="content.is_file == '1'" type="button" class="btn btn-danger btn-sm">
                                            VER ARCHIVO<font-awesome-icon :icon="faFile" class="ml-2" />
                                        </a>
                                        
                                        <button v-else @click="openModalVideo(content.content)" type="button" class="btn btn-success btn-sm">
                                            VER VIDEO<font-awesome-icon :icon="faVideo" class="ml-2" />
                                        </button>
                                    </p>
                                </div>
                            </div>
                            <div v-else class="flex">

                                <div class="relative
                                        before:absolute before:left-1/2 before:-translate-x-1/2 before:top-[15px] before:w-2.5 before:h-2.5 before:border-2 before:border-primary before:rounded-full
                                        after:absolute after:left-1/2 after:-translate-x-1/2 after:top-[25px] after:-bottom-[15px] after:w-0 after:h-auto after:border-l-2 after:border-primary after:rounded-full
                                    "></div>
                                <div class="p-2.5 self-center ltr:ml-2.5 rtl:ltr:mr-2.5 rtl:ml-2.5 w-full">
                                    <p class="text-[#3b3f5c] dark:text-white-light font-semibold text-[16px]">{{ content.description }}</p>
                                    <p class="text-white-dark text-xs font-bold self-center min-w-[100px] max-w-[150px] ">
                                        <a :href="content.content" target="_blank" v-if="content.is_file == '1'" type="button" class="btn btn-danger btn-sm">
                                            VER ARCHIVO<font-awesome-icon :icon="faFile" class="ml-2" />
                                        </a>
                                        
                                        <button v-else @click="openModalVideo(content.content)" type="button" class="btn btn-success btn-sm">
                                            VER VIDEO <font-awesome-icon :icon="faVideo" class="ml-2" />
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div> 
        </div>
        <!-- Modal -->
        <TransitionRoot appear :show="displayModalVideo" as="template">
            <Dialog as="div" @close="closeModalVideo" class="relative z-50">
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
                        <button type="button" class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none" @click="closeModalVideo">
                            <icon-x />
                        </button>
                        <div class="p-5">
                            <iframe :src="videoSelected" class="w-full h-[250px] md:h-[550px]"></iframe>
                        </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
            </Dialog>
        </TransitionRoot>
    </AppLayout>
</template>