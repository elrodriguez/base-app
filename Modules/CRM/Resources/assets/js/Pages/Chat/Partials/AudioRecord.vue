<script setup>
import {
    RecordsAudio,
    IconClose,
    IconStop,
    IconMic,
    IconPlay,
    IconPause,
    IconDeVol,
    IconInVol,
} from "vue-record-audio";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogOverlay,
} from "@headlessui/vue";
import IconX from "@/Components/vristo/icon/icon-x.vue";
import IconMicrophoneOff from "@/Components/vristo/icon/icon-microphone-off.vue";
import { ref, onMounted } from "vue";
import "@Public/AudioRecord/style.css";

const emit = defineEmits(['sendAudio']);

const saveRecord = (data) => {
    uploadAudio(data);
};
const listenEventsRecord = (data) => {
    console.log("listen record", data);
};
const listenEventsPlayer = (data) => {
    if(fileAudio.value){
        if(!data.play){
            deleteAudio();
        }
    }
};

const displayModalAudioRecord = ref(false);
const btnAudioStop = ref(null);
const btnRecordStop = ref(null);
const btnRecordCancel = ref(null);
const btnPlayCancel = ref(null);
const fileAudio = ref([]);

const openMocalAudioRecord = () => {
    displayModalAudioRecord.value = true;
};
const closeMocalAudioRecord = () => {
    if (btnAudioStop.value) {
        btnAudioStop.value.click();
    }
    if (btnRecordStop.value) {
        btnRecordStop.value.click();
    }
    if (btnRecordCancel.value) {
        btnRecordCancel.value.click();
    }
    if (btnPlayCancel.value) {
        btnPlayCancel.value.click();
    }
    fileAudio.value = [];
    displayModalAudioRecord.value = false;
};

const btnAudioSend = ref(false);


const uploadAudio = async (audioData) => {
    // Create FormData and append the audio Blob
    const formData = new FormData();
    formData.append('audio', audioData.base64);

    try {
        const response = await axios.post(route('crm_upload_message_audio'), formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        fileAudio.value = response.data;
        btnAudioSend.value.disabled = false;
    } catch (error) {
        console.error("Error uploading audio:", error);
    }
};

const deleteAudio = async () => {
    // Create FormData and append the audio Blob
    const formData = new FormData();
    formData.append('filename', fileAudio.value.file_name);

    try {
        const response = await axios.post(route('crm_delete_message_file'), formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    } catch (error) {
        console.error("Error uploading audio:", error);
    }
};

const sendAudio = () => {
    emit('sendAudio',fileAudio.value)
    displayModalAudioRecord.value = false;
    fileAudio.value = [];
}
</script>
<template>
    <button @click="openMocalAudioRecord" type="button" class="bg-[#f4f4f4] dark:bg-[#1b2e4b] hover:bg-primary-light rounded-md p-2 hover:text-primary">
        <icon-microphone-off />
    </button>

    <TransitionRoot appear :show="displayModalAudioRecord" as="template">
        <Dialog as="div" class="relative z-50">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <DialogOverlay class="fixed inset-0 bg-[black]/60" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center px-4 py-8" >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                            <button @click="closeMocalAudioRecord" type="button" class="absolute top-7 ltr:right-9 rtl:left-9 text-white-dark hover:text-dark outline-none">
                                <icon-x />
                            </button>

                            <div class="text-lg font-semibold ltr:pl-5 rtl:pr-5 py-5 ltr:pr-[50px] rtl:pl-[50px]">
                                Grabar mensaje de voz
                            </div>
                            <div class="p-5">
                                <div class="flex items-center justify-center mb-5" >
                                    <RecordsAudio
                                        :saveRecord="saveRecord"
                                        @listenEventsRecord="listenEventsRecord"
                                        @listenEventsPlayer="listenEventsPlayer"
                                    >
                                        <!-- control de grabador -->
                                        <template #btnCancelRecord="{ControllerRecord, }">
                                            <button ref="btnRecordCancel" class="au-btn au-btn-sm au-btn-transparent" @click="ControllerRecord.cancelRecord" >
                                                <IconClose />
                                            </button>
                                        </template>
                                        <template #btnRecord="{ ControllerRecord }" >
                                            <button class="au-btn au-btn-primary rounded-full" @click="ControllerRecord.playAudio">
                                                <IconMic v-if="!ControllerRecord.record" />
                                                <IconPause color="#ffffff" v-else-if="!ControllerRecord.pause" />
                                                <IconPlay color="#ffffff" v-else  />
                                            </button>
                                        </template>
                                        <template #btnStopRecord="{ControllerRecord, }" >
                                            <button ref="btnRecordStop" class="au-btn au-btn-sm au-btn-transparent" @click="ControllerRecord.stopRecord">
                                                <IconStop />
                                            </button>
                                        </template>
                                        <!-- control de player -->
                                        <template #btnPlayerCancel="{ControllerPlayer, }">
                                            <button ref="btnPlayCancel" class="au-btn au-btn-sm au-btn-transparent" @click="ControllerPlayer.cancelPlay" >
                                                <IconClose />
                                            </button>
                                        </template>
                                        <template #btnPlayer="{ ControllerPlayer }" >
                                            <button class="au-btn au-btn-primary" @click="ControllerPlayer.playRecord">
                                                <IconPause color="#ffffff" v-if="ControllerPlayer.play" />
                                                <IconPlay color="#ffffff"v-else-if="ControllerPlayer.pause" />
                                                <IconPlay color="#ffffff" v-else />
                                            </button>
                                        </template>
                                        <template #btnPlayerStop="{ControllerPlayer, }" >
                                            <button ref="btnAudioStop" class="au-btn au-btn-sm au-btn-transparent" @click="ControllerPlayer.stopPlay" >
                                                <IconStop />
                                            </button>
                                        </template>
                                    </RecordsAudio>
                                </div>

                                <div class="flex justify-end items-center mt-8">
                                    <button type="button" @click="closeMocalAudioRecord" class="btn btn-outline-danger">
                                        Desechar
                                    </button>
                                    <button :disabled="true" ref="btnAudioSend" @click="sendAudio" type="button" class="btn btn-primary ltr:ml-4 rtl:mr-4" >
                                        Enviar
                                    </button>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
