<script setup>
import IconPaperclip from '@/Components/vristo/icon/icon-paperclip.vue';
import Swal2 from "sweetalert2";
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/vue3'

const fileInput = ref(null);
const fileName = ref(null);
const fileData = useForm({
    file: null
});
const xasset = assetUrl;
const emit = defineEmits(['sendFile']);

const getImage = (path) => {
    return xasset + path;
}

const triggerFileInput = () => {
  fileInput.value.click();
};

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        console.log(file.name)
        fileName.value = file.name;
        fileData.file = file;
    }
    showAlert(fileName);
};

const showAlert = async (fileName = null) => {
    Swal2.fire({
        title: 'ARCHIVO SECCIONADO',
        text: fileName.value,
        imageUrl: (getImage('img/pdf.png')),
        imageWidth: 224,
        imageHeight: 200,
        imageAlt: 'Custom image',
        animation: false,
        showCancelButton: true,
        confirmButtonText: 'Enviar',
        cancelButtonText: 'Cancelar',
        padding: '2em',
        customClass: 'sweet-alerts',
    }).then((result) => {
        if (result.isConfirmed) {
            sendFile();
        }
    });
}

const sendFile = () => {
    if(fileData.file){
        axios.post(route('crm_upload_message_file'), fileData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then((response) => {
            emit('sendFile', {
                path: response.data.filePath,
                size: response.data.size,
                name: fileName.value
            });
            fileData.reset();
        });
        
    }
    
}
</script>
<template>
    <button @click="triggerFileInput" type="button" class="bg-[#f4f4f4] dark:bg-[#1b2e4b] hover:bg-primary-light rounded-md p-2 hover:text-primary">
        <icon-paperclip />
    </button>
    <input
      ref="fileInput"
      type="file"
      class="hidden"
      @change="handleFileChange"
      accept=".pdf"
    />
</template>