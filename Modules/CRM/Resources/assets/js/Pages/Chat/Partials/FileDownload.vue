<script setup>
    import IconPdf from '@/Components/vristo/icon/icon-pdf.vue'
const props = defineProps({
    fileDate: {
        type: String,
        default: null
    },
    position: {
        type: String,
        default: 'right'
    },
});
const xasset = assetUrl;


const getPath = (path) => {
    return xasset + 'storage/' + path;
}
</script>
<template>
    <div 
        class="flex items-start p-2"
        >
        <div class="me-2">
            <span 
                :class="position == 'right' ? 'text-white' : ' dark:text-white-dark '"
                class="flex items-center gap-2 text-sm font-medium pb-2 text-left">
                <!-- <div class="bg-gray-500 rounded-full w-8 h-8 flex justify-center items-center">
                    <icon-pdf class="w-6 h-6" />
                </div> -->
                {{ fileDate.split('@')[0] }}
            </span>
            <span   
                :class="position == 'right' ? 'text-white ' : ' dark:text-white-dark '"
                class="flex text-xs font-normal text-gray-500  gap-2">
                <!-- 12 Pages 
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="self-center" width="3" height="4" viewBox="0 0 3 4" fill="none">
                    <circle cx="1.5" cy="2" r="1.5" fill="#6B7280"/>
                </svg> -->
                {{ fileDate.split('@')[2] }} MB 
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="self-center" width="3" height="4" viewBox="0 0 3 4" fill="none">
                    <circle cx="1.5" cy="2" r="1.5" fill="#6B7280"/>
                </svg>
                PDF
            </span>
        </div>
        <div class="inline-flex self-center items-center">
            <a :href="getPath(fileDate.split('@')[1])" target="_blank" 
            :class="position == 'right' ? 'text-blue-600 bg-gray-200 ' : 'text-white bg-blue-500'"
            class="inline-flex self-center items-center p-2 text-sm font-medium text-center rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-600" type="button">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                    <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                </svg>
            </a>
        </div>
    </div>
</template>