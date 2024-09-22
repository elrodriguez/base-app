<script setup>
    import { ref, watch, onMounted, onUnmounted, computed } from 'vue';
    import { useSharedStore } from '../useSharedStore';
    import IconMaximizer from '@/Components/vristo/icon/icon-maximizer.vue';
    import IconMinimizer from '@/Components/vristo/icon/icon-minimizer.vue';
    import IconX from '@/Components/vristo/icon/icon-x.vue';
    import IconSend from '@/Components/vristo/icon/icon-send.vue';
    import AudioPlayer from '@/Components/AudioPlayer.vue';
    import { usePage } from '@inertiajs/vue3';
    import FileDownload from '../Pages/Chat/Partials/FileDownload.vue';
    import Swal from 'sweetalert2';

    // Instancia del store
    const storeChatBox = useSharedStore();

      const privateChat = ref({
        conversation: null,
        full_name: null,
        avatar: null,
        loading: false,
        messages: []
    });

    const privateChatText = ref(null);
    const authUser = usePage().props.auth.user;
    const xasset = assetUrl;
    const isShowLoadingSend = ref(false);

    const getImage = (path) => {
        return xasset + 'storage/'+ path;
    }

    const hideChatBox = () => {
        storeChatBox.toggleChatBoxVisibility();
        storeChatBox.updateChatBox(null);
        privateChat.value.loading = false;
        privateChat.value.conversation = null;
        privateChat.value.messages = [];
    }

    watch(() => storeChatBox.notification, (newValue) => {
        if(newValue && privateChat.value.conversation !== newValue.id){
            privateChat.value.conversation = newValue.id;
            privateChat.value.person_id = newValue.person_id;
            privateChat.value.full_name = newValue.full_name;
            privateChat.value.avatar = newValue.image;
            privateChat.value.email = newValue.email;
        }
    });

    watch(() => privateChat.value.conversation, () => {
        getMessagesChat();
    });


    const getMessagesChat = () => {
        privateChat.value.loading = true;
        let myDiv = document.getElementById('header-total-news'); 

        // Verifica si el div existe
        if (myDiv) {
            myDiv.style.display = 'none'; // Oculta el div
        }
        try {
            axios.post(route('crm_list_message'),{
                conversationId: privateChat.value.conversation,
                personId: privateChat.value.person_id
            }).then((response) => {
                return response.data;
            }).then((res) => {
                privateChat.value.messages = res;
                
                privateChat.value.loading = false;
                return true;
            }).then(() => {
                scrollToBottomChatBox();
            });
        } catch (error) {
            console.log(error);
            privateChat.value.loading = false;
        }
    }

    const scrollToBottomChatBox = () => {
        const chatbox = document.getElementById('crm-chatbox-list');
        if (!privateChat.value.loading && chatbox) {
            setTimeout(() => {
                chatbox.scrollTop = chatbox.scrollHeight;
            });
        }
    };

    const sendMessageChatBox = () => {
        if (privateChatText.value.trim()) {
            isShowLoadingSend.value = true;
            const msg = {
                fromUserId: privateChat.value.person_id,
                toUserId: 0,
                text: privateChatText.value,
                time: 'En este momento',
                type: 'text',
                person_id: authUser.person_id,
                id: null
            };
            axios.post(route('crm_send_message'),msg).then((response) => {
                return response.data;
            }).then((res) => {
                if(res.success){
                    privateChat.value.messages.push(msg);
                    privateChatText.value = '';
                    scrollToBottomChatBox();
                }else{
                    showMessage('No puede enviar mensajes en este momento. Por favor, complete su información personal en su perfil para habilitar esta función.','info');
                }
                isShowLoadingSend.value = false;
            });
        }
    };

    const showMessage = (msg = '', type = 'success') => {
        const toast = Swal.mixin({
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

    onMounted(() => {
        window.socketIo.on('message-notification', (result) => {
            let participants = result.data.participants;
            let conversationId = result.data.message.conversation_id;

            const newmsg = {
                fromUserId: result.data.ofUserId,
                toUserId: 0,
                text: result.data.message.content,
                time: 'En este momento',
                type: result.data.message.type,
                id: result.data.message.id
            };
            
            participants.forEach(item => {
                if(authUser.id == item){
                    if(privateChat.value){
                        if(conversationId == privateChat.value.conversation){
                            privateChat.value.messages.push(newmsg);
                            scrollToBottomChatBox();
                        }
                    }
                    
                }
            });
        });
    });

    onUnmounted(() => {
        window.socketIo.off('message-notification'); // Dejar el canal cuando se desmonte el componente
    });

    onMounted(() => {
        storeChatBox.loadPersistedData();
    });

    onMounted(() => {
        displayNoneDivs();
    });

    const displayNoneDivs = () => {
        let crmlist = document.getElementById('crm-chatbox-list');
        let crmform = document.getElementById('crm-chatbox-form');
        
        if (crmlist) {
            crmlist.classList.remove('chat-maximizer');
            crmlist.classList.add('chat-minimizer');
        }
        
        if (crmform) {
            crmform.classList.remove('chat-maximizer');
            crmform.classList.add('chat-minimizer');
        }
    }
    const displayBlockDivs = () => {
        let crmlist = document.getElementById('crm-chatbox-list');
        let crmform = document.getElementById('crm-chatbox-form');
        
        if (crmlist) {
            crmlist.classList.remove('chat-minimizer');
            crmlist.classList.add('chat-maximizer');
        }
        
        if (crmform) {
            crmform.classList.remove('chat-minimizer');
            crmform.classList.add('chat-maximizer');
        }
    }
</script>
<template>
    <div v-if="storeChatBox.showDiv" id="crm-chat-container" class="fixed bottom-0 right-4 w-96" style="z-index: 9999;">
        <form @submit.prevent="sendMessageChatBox" class="bg-white shadow-md rounded-t-lg max-w-lg w-full">
            <div class="p-2 border-b bg-blue-500 text-white rounded-t-lg">
                <div class="flex justify-between items-center w-full">
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                        <div class="relative flex-none">
                            <img v-if="privateChat.avatar" :src="getImage(privateChat.avatar)" class="rounded-full w-6 h-6 sm:h-8 sm:w-8 object-cover" />
                            <img v-else :src="`https://ui-avatars.com/api/?name=${privateChat.full_name}&size=150&rounded=true`" class="rounded-full w-6 h-6 sm:h-8 sm:w-8 object-cover" />
                            <!-- <div class="absolute bottom-0 ltr:right-0 rtl:left-0">
                                <div class="w-4 h-4 bg-success rounded-full"></div>
                            </div> -->
                        </div>
                        <div class="mx-3">
                            <p class="text-lg font-semibold">{{ privateChat.full_name }}</p>
                            <p class="text-white text-xs">
                                {{ privateChat.email }}
                            </p>
                        </div>
                    </div>
                    <div class="flex sm:gap-2 gap-2">
                        <button @click="displayNoneDivs"  v-tippy:top type="button">
                            <icon-minimizer class="w-6 h-6 hover:text-gray-300" />
                        </button>
                        <tippy target="top" placement="top">Minimizar</tippy>
                        <button @click="displayBlockDivs"  v-tippy:top type="button">
                            <icon-maximizer class="w-6 h-6 hover:text-gray-300" />
                        </button>
                        <tippy target="top" placement="top">Maximizar</tippy>
                        <button @click="hideChatBox"  v-tippy:top type="button">
                            <icon-x class="w-6 h-6 hover:text-gray-300" />
                        </button>
                        <tippy target="top" placement="top">Cerrar</tippy>
                    </div>
                </div>
            </div>
            <div id="crm-chatbox-list" class="p-4 h-80 overflow-y-auto">
                <!-- Chat messages will be displayed here -->
                 <template v-if="privateChat.messages.length > 0">
                    <template v-for="(message, index) in privateChat.messages">
                        <div v-if="authUser.person_id == message.person_id" class="mb-2 text-right">
                            <p v-if="message.type == 'text'" class="bg-blue-500 text-white rounded-lg rounded-br-none py-2 px-4 inline-block">
                                {{ message.text }}
                            </p>
                            <p v-if="message.type == 'audio'" class="bg-blue-500 text-white rounded-lg rounded-br-none py-2 px-4 inline-block">
                                <AudioPlayer :audioSrc="message.text" :position="'right'" /> 
                            </p>
                            <p v-if="message.type == 'file'" class="bg-blue-500 text-white rounded-lg rounded-br-none py-2 px-4 inline-block">
                                <FileDownload 
                                    :fileDate="message.text" 
                                    :position="'right'"
                                />
                            </p>
                        </div>
                        <div v-else class="mb-2">
                            <p v-if="message.type == 'text'" class="bg-gray-200 text-gray-700 rounded-lg rounded-tl-none py-2 px-4 inline-block">
                                {{ message.text }}
                            </p>
                            <p v-if="message.type == 'audio'" class="bg-gray-200 text-gray-700 rounded-lg rounded-tl-none py-2 px-4 inline-block">
                                <AudioPlayer :audioSrc="message.text" :position="'left'" /> 
                            </p>
                            <p v-if="message.type == 'file'" class="bg-gray-200 text-gray-700 rounded-lg rounded-tl-none py-2 px-4 inline-block">
                                <FileDownload 
                                    :fileDate="message.text" 
                                    :position="'left'"
                                />
                            </p>
                        </div>
                    </template>
                </template>
                <template v-else>
                    <div class="mb-2">
                        <div class="h-8 bg-gray-100 rounded-lg dark:bg-gray-700 w-full mb-2"></div>
                        <div class="h-8 bg-gray-100 rounded-lg dark:bg-gray-700 w-full mb-2"></div>
                    </div>
                    <div class="mb-2 flex justify-end">
                        <div class="h-8 bg-blue-300 rounded-lg dark:bg-gray-700 w-32 mb-2"></div>
                    </div>
                    <div class="mb-2">
                        <div class="h-8 bg-gray-100 rounded-lg dark:bg-gray-700 w-full mb-2"></div>
                    </div>
                    <div class="mb-2 flex justify-end">
                        <div class="h-8 bg-blue-300 rounded-lg dark:bg-gray-700 w-32 mb-2"></div>
                    </div>
                    <div class="mb-2">
                        <div class="h-8 bg-gray-100 rounded-lg dark:bg-gray-700 w-full mb-2"></div>
                    </div>
                </template>
            </div>
            <div id="crm-chatbox-form" >
                <div class="p-4 border-t flex">
                    <input v-model="privateChatText" id="user-input" type="text" placeholder="Escribe un mensaje" class="w-full px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button @click="sendMessageChatBox" type="button" id="send-button" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition duration-300">
                    <icon-send /> 
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
<style>
.chat-maximizer {
    display: block;
}
.chat-minimizer {
    display: none;
}
</style>