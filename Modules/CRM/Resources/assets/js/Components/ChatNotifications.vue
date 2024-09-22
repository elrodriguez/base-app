<script setup>
    import { useAppStore } from '@/stores/index';
    import { ref, onMounted, computed, reactive, watch, onUnmounted } from 'vue';
    import IconBellBing from '@/Components/vristo/icon/icon-bell-bing.vue';
    import IconInfoCircle from '@/Components/vristo/icon/icon-info-circle.vue';
    import IconSquareCheck from '@/Components/vristo/icon/icon-square-check.vue';
    import { useForm, Link, usePage } from '@inertiajs/vue3';
    import { useSharedStore } from '../useSharedStore';

    const store = useAppStore();
    const storeChatBox = useSharedStore();

    const notifications = ref([]);
    const totalNews = ref(0);

    const authUser = usePage().props.auth.user;

    const fetchNotifications = async () => {
        try {
            axios.get(route('crm_chat_notifications')).then( (response) => {
                notifications.value = response.data.conversations; 
                totalNews.value = response.data.totalNew;
            });
        } catch (error) {
            console.log(error);
        }
    }
    const xasset = assetUrl;

    const getImage = (path) => {
        return xasset + 'storage/'+ path;
    }
    onMounted(() => {
        window.socketIo.on('message-notification', (result) => {
            let participants = result.data.participants;
            participants.forEach(item => {
                if(authUser.id == item){
                    fetchNotifications();
                }
            });
        });
    });

    onMounted(() => fetchNotifications());

    onUnmounted(() => {
        window.socketIo.off('message-notification'); // Dejar el canal cuando se desmonte el componente
    });


    const showChatBox = (notification) => {
        storeChatBox.toggleChatBoxVisibility();
        storeChatBox.updateChatBox(notification);
    };

</script>
<template>
    <div v-can="'crm_chat_notifications'" class="dropdown shrink-0">
        <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="8">
            <button
                type="button"
                class="relative block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
            >
                <icon-bell-bing />

                <span v-show="totalNews > 0" id="header-total-news" class="flex absolute w-3 h-3 ltr:right-0 rtl:left-0 top-0">
                    <span class="animate-ping absolute ltr:-left-[3px] rtl:-right-[3px] -top-[3px] inline-flex h-full w-full rounded-full bg-success/50 opacity-75"></span>
                    <span class="relative inline-flex rounded-full w-[6px] h-[6px] bg-success"></span>
                </span>
            </button>
            <template #content="{ close }">
                <ul class="!py-0 text-dark dark:text-white-dark w-[300px] sm:w-[350px] divide-y dark:divide-white/10">
                    <li>
                        <div class="flex items-center px-4 py-2 justify-between font-semibold">
                            <h4 class="text-lg">Chats</h4>
                            <template v-if="notifications.length">
                                <span class="badge bg-primary/80" v-text="notifications.length + ' New'"></span>
                            </template>
                        </div>
                    </li>
                    <template v-for="notification in notifications" :key="notification.id">
                        <template v-if="notification.full_name">
                            <li @click="showChatBox(notification),close()" class="dark:text-white-light/90 cursor-pointer">
                                <div class="group flex items-center px-4 py-2">
                                    <div class="grid place-content-center rounded">
                                        <div class="w-12 h-12 relative">
                                            <img v-if="notification.image"
                                                class="w-12 h-12 rounded-full object-cover"
                                                :src="getImage(notification.image)"
                                                alt=""
                                            />
                                            <img v-else
                                                class="w-12 h-12 rounded-full object-cover"
                                                :src="`https://ui-avatars.com/api/?name=${notification.full_name}&size=150&rounded=true`"
                                                alt=""
                                            />
                                            <!-- avilidar cuando sepamos si el usuario esta en linea -->
                                            <!-- <span class="bg-success w-2 h-2 rounded-full block absolute right-[6px] bottom-0"></span> -->
                                        </div>
                                    </div>
                                    <div class="ltr:pl-3 rtl:pr-3 flex flex-auto">
                                        <div class="ltr:pr-3 rtl:pl-3">
                                            <h6 v-html="notification.preview"></h6>
                                            <span class="text-xs block font-normal dark:text-gray-500" v-text="notification.time"></span>
                                        </div>
                                        <button
                                            type="button"
                                            class="ltr:ml-auto rtl:mr-auto text-neutral-300 hover:text-danger opacity-0 group-hover:opacity-100"
                                            @click="showChatBox(notification)"
                                        >
                                            
                                            <icon-square-check />
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </template>
                    </template>
                    <template v-if="notifications.length">
                        <li>
                            <div class="p-4">
                                <Link :href="route('crm_chat_dashboard')" class="btn btn-primary block w-full btn-small text-center" @click="close()">Ver todo los chats</Link>
                            </div>
                        </li>
                    </template>
                    <template v-if="!notifications.length">
                        <li>
                            <div class="!grid place-content-center hover:!bg-transparent text-lg min-h-[200px]">
                                <div class="mx-auto ring-4 ring-primary/30 rounded-full mb-4 text-primary">
                                    <icon-info-circle :fill="true" class="w-10 h-10" />
                                </div>
                                No hay datos disponibles.
                            </div>
                        </li>
                    </template>
                </ul>
            </template>
        </Popper>
    </div>
</template>