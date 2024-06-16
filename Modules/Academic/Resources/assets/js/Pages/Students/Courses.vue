<script  setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import { useForm, router, Link  } from '@inertiajs/vue3';

import { ref, watch  } from 'vue';
import { faStar, faStarHalfStroke } from "@fortawesome/free-solid-svg-icons";
import IconStarRegular from '@/Components/vristo/icon/icon-star-regular.vue';

const props = defineProps({
    courses: {
        type: Object,
        default: () => ({}),
    }
});

const openModalContents = ref(false);

const modulesData = ref([]);
const courseName = ref([]);
const loadingContent = ref(false);

const readContent = async (data) => {
    
    modulesData.value = data.map((mol) => (
        {
            key: mol.id,
            title: mol.description,
            children: mol.themes.map((the) => ({
                    key: the.id,
                    title: the.description,
                    children: the.contents.map((con) => ({
                            isLeaf: true,
                            key: con.id,
                            title: con.description,
                            is_file: con.is_file,
                            content: con.content
                        }
                    ))
                }
            ))
        }
    ));
}

const showLine = ref(true);
const showIcon = ref(false);

const showModalContents = async (course) => {
    loadingContent.value = true;
    courseName.value = course.description
    try {
        await readContent(course.modules);
    } finally {
        loadingContent.value = false;
    }

    openModalContents.value = true;
};

const hideModalContents = () => {
    videoHtml.value = null;
    openModalContents.value = false;
};

const expandedKeys = ref([]);
const selectedKeys = ref([]);
const videoHtml = ref(null);
const newWidth = ref(100);
const newHeight = ref(200);

const modifiedContent = (content) => {
  // Copia el contenido original
  let modifiedContent = content;

  // Realiza la sustitución de la altura con un valor dinámico
  modifiedContent = modifiedContent.replace(/width="\d+"/g, `width="${newWidth.value}%"`);
  modifiedContent = modifiedContent.replace(/height="\d+"/g, `height="${newHeight.value}"`);
  return modifiedContent;
};

const onSelect = (selectedKeys, info) => {
    if (info.node && info.node.content !== undefined) {
        if(info.node.is_file){
            let url = info.node.content;
            window.open(url, "_blank");  
        }else{
            videoHtml.value = modifiedContent(info.node.content)
        }
    }
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
                <span>Mis cursos</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="grid xl:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
                <div v-for="(course, index) in courses" class="relative group rounded-md bg-white border-b-4 border-transparent hover:border-sky-500 overflow-hidden">
                    <div class="relative">
                        <div class="overflow-hidden h-full">
                            <img :src="getImage(course.image)" class="h-full w-full scale-100 group-hover:scale-105 transition-all duration-500" :alt="course.description">
                        </div>
                        <div class="absolute inset-0 m-2">
                            <span class="py-0.5 px-1.5 inline-flex items-center justify-center gap-1 text-sm font-semibold rounded text-white bg-yellow-400"><i class="ti ti-clock-hour-4 text-base"></i> {{ course.modality.description }}</span>
                        </div>
                    </div>

                    <div class="p-6 -mb-20 group-hover:-translate-y-20 bg-white transition-all duration-500">
                        <span class="py-0.5 px-2 text-sm rounded font-semibold text-sky-500 bg-sky-500/10">{{ course.type_description }}</span>
                        <h2 class="my-4">
                            <a href="#" class="text-xl font-bold hover:text-sky-500 transition-all duration-500">
                                {{ course.description }}
                            </a>
                        </h2>
                        <div class="flex flex-wrap items-center">
                            <font-awesome-icon :icon="faStar" />
                            <font-awesome-icon :icon="faStar" />
                            <font-awesome-icon :icon="faStar" />
                            <font-awesome-icon :icon="faStarHalfStroke" />
                            <icon-star-regular />
                            <span class="text-base font-medium ps-2">(4.0/2 Ratings )</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-4 mt-4 text-gray-500 mb-6">
                            <div class="flex items-center gap-1">
                                <i class="ti ti-table-row text-lg"></i>
                                <span class="text-base font-semibold">{{ course.modules.length }} Lecciones</span>
                            </div>
                            <!-- <div class="flex items-center gap-1">
                                <i class="ti ti-user text-lg"></i>
                                <span class="text-base font-semibold">123 Students</span>
                            </div> -->
                        </div>
                        <Link :href="route('aca_mycourses_lessons',course.id)" class="py-1.5 px-6 inline-flex items-center justify-center gap-2 rounded-md text-base font-bold text-white bg-sky-500 hover:bg-sky-600 transition-all duration-500">Ir al curso <i class="ti ti-arrow-narrow-right text-2xl"></i></Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>