<script setup>
import ModalLarge from '@/Components/ModalLarge.vue';
import { Timeline, TimelineItem, TimelinePoint, TimelineContent,TimelineTime, TimelineTitle, TimelineBody } from 'flowbite-vue'
import { useForm } from '@inertiajs/vue3';
import { watch, ref, onMounted } from 'vue';
import InputError from '@/Components/InputError.vue';
import Swal2 from 'sweetalert2';

const props = defineProps({
    theme: {
        type: Object,
        default: () => ({})
    },
    faFile:{
        type: Object,
        default: () => ({})
    },
    faPlay:{
        type: Object,
        default: () => ({})
    },
    faDownload: {
        type: Object,
        default: () => ({})
    },
    faFilm: {
        type: Object,
        default: () => ({})
    },
    faTrashAlt: {
        type: Object,
        default: () => ({})
    },
    faCheck: {
        type: Object,
        default: () => ({})
    },
    faXmark: {
        type: Object,
        default: () => ({})
    }
});

const displayModalContent = ref(false);
const contentsLoading = ref([]);

const formContents = useForm({
    theme_id: null,
    theme_name: null,
    contents: []
});

watch(() => props.theme, (data) => {
    displayModalContent.value = true;
    formContents.id = data.theme_id,
    formContents.theme_name = data.theme_name,
    formContents.contents = data.contents
    contentsLoading.value = data.contents.map(() => ({ loading: false, editable: false }));

});

const closeModalContents = () => {
    displayModalContent.value = false;
}

const newHeight = ref(380);

const modifiedContent = (content) => {
  // Copia el contenido original
  let modifiedContent = content;

  // Realiza la sustitución de la altura con un valor dinámico
  modifiedContent = modifiedContent.replace(/height="\d+"/g, `height="${newHeight.value}"`);

  return modifiedContent;
};

const contentUpdate = (index) => {

}
</script>
<template>
    <ModalLarge
        :onClose = "closeModalContents"
        :show="displayModalContent"
        :icon="'/img/material.png'"
    >
        <template #title>
            Material 
        </template>
        <template #message>{{ formContents.theme_name }}</template>
        <template #content>
           <div style="max-height: 350px;overflow-y: auto;" class="p-4">
                <Timeline>
                    <TimelineItem v-for="(content, index) in formContents.contents" class="mb-2">
                        <TimelinePoint>
                            <font-awesome-icon v-if="content.is_file" class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" :icon="faFile" />
                            <font-awesome-icon v-else class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" :icon="faFilm" />
                        </TimelinePoint>
                        <TimelineContent>
                            <TimelineTitle class="mb-1">
                                <div v-if="contentsLoading[index].editable" class="flex items-center">   
                                    <label :for="'theme-description'+index" class="sr-only">title</label>
                                    <div class="relative w-full">
                                        <input v-model="content.description" type="text" :id="'theme-description'+index" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                                    </div>
                                    <button type="button" title="Actualizar"  class="ml-1 inline-flex items-center px-3 py-2.5 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        <svg v-if="contentsLoading[index].loading" aria-hidden="true" role="status" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                        </svg>
                                        <font-awesome-icon v-else :icon="faCheck" />
                                    </button>
                                    <button @click="contentsLoading[index].editable = false" type="button" title="Cancelar"  class="ml-1 inline-flex items-center px-3 py-2.5 bg-red-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        <font-awesome-icon :icon="faXmark" />
                                    </button>
                                </div>
                                <template v-else>
                                    {{ content.description }} 
                                    <span style="cursor: pointer;" @click="contentsLoading[index].editable = true"  class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">EDITAR</span>
                                    <span style="cursor: pointer;" @click="" class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300 ms-3">ELIMINAR</span>
                                </template>
                            </TimelineTitle>
                            <TimelineBody class="p-0">
                                <template v-if="contentsLoading[index].editable">
                                    <textarea v-model="content.content" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                    <div class="mt-1">
                                        <div class="flex items-center mb-1">
                                            <input v-model="content.is_file" id="default-radio-1" type="radio" value="1" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-radio-1" class="ms-2 ml-1 text-sm font-medium text-gray-900 dark:text-gray-300">Link de archivo</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input v-model="content.is_file" id="default-radio-2" type="radio" value="0" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-radio-2" class="ms-2 ml-1 text-sm font-medium text-gray-900 dark:text-gray-300">Iframe de video</label>
                                        </div>
                                    </div>
                                </template>
                                <template v-else>
                                    <template v-if="content.is_file">
                                        <a :href="content.content" target="_blank" class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-400 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                            <font-awesome-icon class="mr-1" :icon="faDownload" />
                                            Download
                                        </a>
                                    </template>
                                    <template v-else>
                                        <div id="div-video-content" v-html="modifiedContent(content.content)" class="m-0"></div>
                                    </template>
                                </template>
                            </TimelineBody>
                        </TimelineContent>
                    </TimelineItem>
                </Timeline>
           </div> 
        </template>
        <template #buttons>
            <!-- <progress v-if="formContents.progress" :value="formAgreement.progress.percentage" max="100" class="mr-2">
                {{ formContents.progress.percentage }}%
            </progress>
            <DangerButton
                :class="{ 'opacity-25': formContents.processing }" :disabled="formContents.processing"
                class="mr-3"
                @click="saveContent()"
            >
            Guardar
        </DangerButton> -->
        </template>
    </ModalLarge>

</template>
