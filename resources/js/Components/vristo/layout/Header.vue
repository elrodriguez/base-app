
    <script setup>
    import { ref, onMounted, computed, reactive, watch } from 'vue';
    import { Link } from '@inertiajs/vue3';
    import { useI18n } from 'vue-i18n';

    import appSetting from '@/app-setting';

    
    import { useAppStore } from '@/stores/index';

    import IconMenu from '@/Components/vristo/icon/icon-menu.vue';
    import IconCalendar from '@/Components/vristo/icon/icon-calendar.vue';
    import IconEdit from '@/Components/vristo/icon/icon-edit.vue';
    import IconChatNotification from '@/Components/vristo/icon/icon-chat-notification.vue';
    import IconSearch from '@/Components/vristo/icon/icon-search.vue';
    import IconXCircle from '@/Components/vristo/icon/icon-x-circle.vue';
    import IconSun from '@/Components/vristo/icon/icon-sun.vue';
    import IconMoon from '@/Components/vristo/icon/icon-moon.vue';
    import IconLaptop from '@/Components/vristo/icon/icon-laptop.vue';
    import IconMailDot from '@/Components/vristo/icon/icon-mail-dot.vue';
    import IconArrowLeft from '@/Components/vristo/icon/icon-arrow-left.vue';
    import IconInfoCircle from '@/Components/vristo/icon/icon-info-circle.vue';
    import IconBellBing from '@/Components/vristo/icon/icon-bell-bing.vue';
    import IconUser from '@/Components/vristo/icon/icon-user.vue';
    import IconMail from '@/Components/vristo/icon/icon-mail.vue';
    import IconLockDots from '@/Components/vristo/icon/icon-lock-dots.vue';
    import IconLogout from '@/Components/vristo/icon/icon-logout.vue';
    import IconMenuDashboard from '@/Components/vristo/icon/menu/icon-menu-dashboard.vue';
    import IconCaretDown from '@/Components/vristo/icon/icon-caret-down.vue';
    import IconMenuApps from '@/Components/vristo/icon/menu/icon-menu-apps.vue';
    import IconMenuComponents from '@/Components/vristo/icon/menu/icon-menu-components.vue';
    import IconMenuElements from '@/Components/vristo/icon/menu/icon-menu-elements.vue';
    import IconMenuDatatables from '@/Components/vristo/icon/menu/icon-menu-datatables.vue';
    import IconMenuForms from '@/Components/vristo/icon/menu/icon-menu-forms.vue';
    import IconMenuPages from '@/Components/vristo/icon/menu/icon-menu-pages.vue';
    import IconMenuMore from '@/Components/vristo/icon/menu/icon-menu-more.vue';
    import { router } from '@inertiajs/vue3'

    const logout = () => {
        router.post(route('logout'));
    }

    const store = useAppStore();

    const search = ref(false);

    // multi language
    const i18n = reactive(useI18n());
    const changeLanguage = (item) => {
        i18n.locale = item.code;
        appSetting.toggleLanguage(item);
    };

    const baseUrl = assetUrl;

    const currentFlag = computed(() => {
        
        return baseUrl  + `/themes/vristo/images/flags/${i18n.locale.toUpperCase()}.svg`;
    });

    const notifications = ref([
        {
            id: 1,
            profile: 'user-profile.jpeg',
            message: '<strong class="text-sm mr-1">John Doe</strong>invite you to <strong>Prototyping</strong>',
            time: '45 min ago',
        },
        {
            id: 2,
            profile: 'profile-34.jpeg',
            message: '<strong class="text-sm mr-1">Adam Nolan</strong>mentioned you to <strong>UX Basics</strong>',
            time: '9h Ago',
        },
        {
            id: 3,
            profile: 'profile-16.jpeg',
            message: '<strong class="text-sm mr-1">Anna Morgan</strong>Upload a file',
            time: '9h Ago',
        },
    ]);

    const messages = ref([
        {
            id: 1,
            image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-success-light dark:bg-success text-success dark:text-success-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></span>',
            title: 'Congratulations!',
            message: 'Your OS has been updated.',
            time: '1hr',
        },
        {
            id: 2,
            image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-info-light dark:bg-info text-info dark:text-info-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></span>',
            title: 'Did you know?',
            message: 'You can switch between artboards.',
            time: '2hr',
        },
        {
            id: 3,
            image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-danger-light dark:bg-danger text-danger dark:text-danger-light"> <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>',
            title: 'Something went wrong!',
            message: 'Send Reposrt',
            time: '2days',
        },
        {
            id: 4,
            image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-warning-light dark:bg-warning text-warning dark:text-warning-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">    <circle cx="12" cy="12" r="10"></circle>    <line x1="12" y1="8" x2="12" y2="12"></line>    <line x1="12" y1="16" x2="12.01" y2="16"></line></svg></span>',
            title: 'Warning',
            message: 'Your password strength is low.',
            time: '5days',
        },
    ]);

    onMounted(() => {
        setActiveDropdown();
    });

    watch(route, (to, from) => {
        setActiveDropdown();
    });

    const setActiveDropdown = () => {
        const selector = document.querySelector('ul.horizontal-menu a[href="' + window.location.pathname + '"]');
        if (selector) {
            selector.classList.add('active');
            const all  = document.querySelectorAll('ul.horizontal-menu .nav-link.active');
            for (let i = 0; i < all.length; i++) {
                all[0]?.classList.remove('active');
            }
            const ul = selector.closest('ul.sub-menu');
            if (ul) {
                let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                if (ele) {
                    ele = ele[0];
                    setTimeout(() => {
                        ele?.classList.add('active');
                    });
                }
            }
        }
    };

    const removeNotification = (value) => {
        notifications.value = notifications.value.filter((d) => d.id !== value);
    };

    const removeMessage = (value) => {
        messages.value = messages.value.filter((d) => d.id !== value);
    };
    const xasset = assetUrl;
</script>
<template>
    
    <header class="z-40" :class="{ dark: store.semidark && store.menu === 'horizontal' }">
        <div class="shadow-sm">
            <div class="relative bg-white flex w-full items-center px-5 py-2.5 dark:bg-[#0e1726]">
                <div class="horizontal-logo flex lg:hidden justify-between items-center ltr:mr-2 rtl:ml-2">
                    <Link href="/" class="main-logo flex items-center shrink-0">
                        <img class="w-8 ltr:-ml-1 rtl:-mr-1 inline" :src="xasset+$page.props.company.isotipo" alt="" />
                        <span
                            class="text-2xl ltr:ml-1.5 rtl:mr-1.5 font-semibold align-middle hidden md:inline dark:text-white-light transition-all duration-300"
                            >{{ $page.props.company.name }}</span
                        >
                    </Link>

                    <a
                        href="javascript:;"
                        class="collapse-icon flex-none dark:text-[#d0d2d6] hover:text-primary dark:hover:text-primary flex lg:hidden ltr:ml-2 rtl:mr-2 p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:bg-white-light/90 dark:hover:bg-dark/60"
                        @click="store.toggleSidebar()"
                    >
                        <icon-menu class="w-5 h-5" />
                    </a>
                </div>
                <div class="ltr:mr-2 rtl:ml-2 hidden sm:block">
                    <ul class="flex items-center space-x-2 rtl:space-x-reverse dark:text-[#d0d2d6]">
                        <li>
                            <Link
                                :href="route('calendar')"
                                class="block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                            >
                                <icon-calendar />
                            </Link>
                        </li>
                        <li>
                            <Link v-can="'empresa'"
                                :href="route('company_show')"
                                class="block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                            >
                                <icon-edit />
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/apps/chat"
                                class="block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                            >
                                <icon-chat-notification />
                            </Link>
                        </li>
                    </ul>
                </div>
                <div
                    class="sm:flex-1 ltr:sm:ml-0 ltr:ml-auto sm:rtl:mr-0 rtl:mr-auto flex items-center space-x-1.5 lg:space-x-2 rtl:space-x-reverse dark:text-[#d0d2d6]"
                >
                    <div class="sm:ltr:mr-auto sm:rtl:ml-auto">
                        <form
                            class="sm:relative absolute inset-x-0 sm:top-0 top-1/2 sm:translate-y-0 -translate-y-1/2 sm:mx-0 mx-4 z-10 sm:block hidden"
                            :class="{ '!block': search }"
                            @submit.prevent="search = false"
                        >
                            <div class="relative">
                                <input
                                    type="text"
                                    class="form-input ltr:pl-9 rtl:pr-9 ltr:sm:pr-4 rtl:sm:pl-4 ltr:pr-9 rtl:pl-9 peer sm:bg-transparent bg-gray-100 placeholder:tracking-widest"
                                    placeholder="Search..."
                                />
                                <button type="button" class="absolute w-9 h-9 inset-0 ltr:right-auto rtl:left-auto appearance-none peer-focus:text-primary">
                                    <icon-search class="mx-auto" />
                                </button>
                                <button
                                    type="button"
                                    class="hover:opacity-80 sm:hidden block absolute top-1/2 -translate-y-1/2 ltr:right-2 rtl:left-2"
                                    @click="search = false"
                                >
                                    <icon-x-circle />
                                </button>
                            </div>
                        </form>

                        <button
                            type="button"
                            class="search_btn sm:hidden p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:bg-white-light/90 dark:hover:bg-dark/60"
                            @click="search = !search"
                        >
                            <icon-search class="w-4.5 h-4.5 mx-auto dark:text-[#d0d2d6]" />
                        </button>
                    </div>
                    <div>
                        <a
                            href="javascript:;"
                            v-show="store.theme === 'light'"
                            class="flex items-center p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                            @click="store.toggleTheme('dark')"
                        >
                            <icon-sun />
                        </a>
                        <a
                            href="javascript:;"
                            v-show="store.theme === 'dark'"
                            class="flex items-center p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                            @click="store.toggleTheme('system')"
                        >
                            <icon-moon />
                        </a>
                        <a
                            href="javascript:;"
                            v-show="store.theme === 'system'"
                            class="flex items-center p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                            @click="store.toggleTheme('light')"
                        >
                            <icon-laptop />
                        </a>
                    </div>

                    <div class="dropdown shrink-0">
                        <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="8">
                            <button
                                type="button"
                                class="block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                            >
                                <img :src="currentFlag" alt="flag" class="w-5 h-5 object-cover rounded-full" />
                            </button>
                            <template #content="{ close }">
                                <ul class="!px-2 text-dark dark:text-white-dark grid grid-cols-2 gap-2 font-semibold dark:text-white-light/90 w-[280px]">
                                    <template v-for="item in store.languageList" :key="item.code">
                                        <li>
                                            <button
                                                type="button"
                                                class="w-full hover:text-primary"
                                                :class="{ 'bg-primary/10 text-primary': i18n.locale === item.code }"
                                                @click="changeLanguage(item), close()"
                                            >
                                                <img
                                                    class="w-5 h-5 object-cover rounded-full"
                                                    :src="baseUrl+`/themes/vristo/images/flags/${item.code.toUpperCase()}.svg`"
                                                    alt=""
                                                />
                                                <span class="ltr:ml-3 rtl:mr-3">{{ item.name }}</span>
                                            </button>
                                        </li>
                                    </template>
                                </ul>
                            </template>
                        </Popper>
                    </div>

                    <div class="dropdown shrink-0">
                        <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-start' : 'bottom-end'" offsetDistance="8">
                            <button
                                type="button"
                                class="block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                            >
                                <icon-mail-dot />
                            </button>
                            <template #content="{ close }">
                                <ul class="top-11 !py-0 text-dark dark:text-white-dark w-[300px] sm:w-[375px] text-xs">
                                    <li class="mb-5">
                                        <div class="overflow-hidden relative rounded-t-md !p-5 text-white">
                                            <div
                                                class="absolute h-full w-full bg-no-repeat bg-center bg-cover inset-0"
                                                :class="`bg-[url('${baseUrl}/themes/vristo/images/menu-heade.jpg')]`"
                                            ></div>
                                            <h4 class="font-semibold relative z-10 text-lg">Messages</h4>
                                        </div>
                                    </li>
                                    <template v-for="msg in messages" :key="msg.id">
                                        <li>
                                            <div class="flex items-center py-3 px-5">
                                                <div v-html="msg.image"></div>
                                                <span class="px-3 dark:text-gray-500">
                                                    <div class="font-semibold text-sm dark:text-white-light/90" v-text="msg.title"></div>
                                                    <div v-text="msg.message"></div>
                                                </span>
                                                <span
                                                    class="font-semibold bg-white-dark/20 rounded text-dark/60 px-1 ltr:ml-auto rtl:mr-auto whitespace-pre dark:text-white-dark ltr:mr-2 rtl:ml-2"
                                                    v-text="msg.time"
                                                ></span>
                                                <button type="button" class="text-neutral-300 hover:text-danger" @click="removeMessage(msg.id)">
                                                    <icon-x-circle />
                                                </button>
                                            </div>
                                        </li>
                                    </template>
                                    <template v-if="messages.length">
                                        <li class="border-t border-white-light text-center dark:border-white/10 mt-5">
                                            <div
                                                class="flex items-center py-4 px-5 text-primary font-semibold group dark:text-gray-400 justify-center cursor-pointer"
                                                @click="close()"
                                            >
                                                <span class="group-hover:underline ltr:mr-1 rtl:ml-1">VIEW ALL ACTIVITIES</span>

                                                <icon-arrow-left class="group-hover:translate-x-1 transition duration-300 ltr:ml-1 rtl:mr-1" />
                                            </div>
                                        </li>
                                    </template>
                                    <template v-if="!messages.length">
                                        <li class="mb-5">
                                            <div class="!grid place-content-center hover:!bg-transparent text-lg min-h-[200px]">
                                                <div class="mx-auto ring-4 ring-primary/30 rounded-full mb-4 text-primary">
                                                    <icon-info-circle :fill="true" class="w-10 h-10" />
                                                </div>
                                                No data available.
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </template>
                        </Popper>
                    </div>

                    <div class="dropdown shrink-0">
                        <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="8">
                            <button
                                type="button"
                                class="relative block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                            >
                                <icon-bell-bing />

                                <span class="flex absolute w-3 h-3 ltr:right-0 rtl:left-0 top-0">
                                    <span
                                        class="animate-ping absolute ltr:-left-[3px] rtl:-right-[3px] -top-[3px] inline-flex h-full w-full rounded-full bg-success/50 opacity-75"
                                    ></span>
                                    <span class="relative inline-flex rounded-full w-[6px] h-[6px] bg-success"></span>
                                </span>
                            </button>
                            <template #content="{ close }">
                                <ul class="!py-0 text-dark dark:text-white-dark w-[300px] sm:w-[350px] divide-y dark:divide-white/10">
                                    <li>
                                        <div class="flex items-center px-4 py-2 justify-between font-semibold">
                                            <h4 class="text-lg">Notification</h4>
                                            <template v-if="notifications.length">
                                                <span class="badge bg-primary/80" v-text="notifications.length + 'New'"></span>
                                            </template>
                                        </div>
                                    </li>
                                    <template v-for="notification in notifications" :key="notification.id">
                                        <li class="dark:text-white-light/90">
                                            <div class="group flex items-center px-4 py-2">
                                                <div class="grid place-content-center rounded">
                                                    <div class="w-12 h-12 relative">
                                                        <img
                                                            class="w-12 h-12 rounded-full object-cover"
                                                            :src="`${baseUrl}themes/vristo/images/${notification.profile}`"
                                                            alt=""
                                                        />
                                                        <span class="bg-success w-2 h-2 rounded-full block absolute right-[6px] bottom-0"></span>
                                                    </div>
                                                </div>
                                                <div class="ltr:pl-3 rtl:pr-3 flex flex-auto">
                                                    <div class="ltr:pr-3 rtl:pl-3">
                                                        <h6 v-html="notification.message"></h6>
                                                        <span class="text-xs block font-normal dark:text-gray-500" v-text="notification.time"></span>
                                                    </div>
                                                    <button
                                                        type="button"
                                                        class="ltr:ml-auto rtl:mr-auto text-neutral-300 hover:text-danger opacity-0 group-hover:opacity-100"
                                                        @click="removeNotification(notification.id)"
                                                    >
                                                        <icon-x-circle />
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </template>
                                    <template v-if="notifications.length">
                                        <li>
                                            <div class="p-4">
                                                <button class="btn btn-primary block w-full btn-small" @click="close()">Read All Notifications</button>
                                            </div>
                                        </li>
                                    </template>
                                    <template v-if="!notifications.length">
                                        <li>
                                            <div class="!grid place-content-center hover:!bg-transparent text-lg min-h-[200px]">
                                                <div class="mx-auto ring-4 ring-primary/30 rounded-full mb-4 text-primary">
                                                    <icon-info-circle :fill="true" class="w-10 h-10" />
                                                </div>
                                                No data available.
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </template>
                        </Popper>
                    </div>

                    <div class="dropdown shrink-0">
                        <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="8" class="!block">
                            <button type="button" class="relative group block">
                                <img
                                    class="w-9 h-9 rounded-full object-cover saturate-50 group-hover:saturate-100"
                                    :src="`${baseUrl}/themes/vristo/images/user-profile.jpeg`"
                                    alt=""
                                />
                            </button>
                            <template #content="{ close }">
                                <ul class="text-dark dark:text-white-dark !py-0 w-[230px] font-semibold dark:text-white-light/90">
                                    <li>
                                        <div class="flex items-center px-4 py-4">
                                            <div class="flex-none">
                                                <img class="rounded-md w-10 h-10 object-cover" :src="`${baseUrl}/themes/vristo/images/user-profile.jpeg`" alt="" />
                                            </div>
                                            <div class="ltr:pl-4 rtl:pr-4 truncate">
                                                <h4 class="text-base">
                                                    John Doe<span class="text-xs bg-success-light rounded text-success px-1 ltr:ml-2 rtl:ml-2">Pro</span>
                                                </h4>
                                                <a class="text-black/60 hover:text-primary dark:text-dark-light/60 dark:hover:text-white" href="javascript:;"
                                                    >johndoe@gmail.com</a
                                                >
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <Link :href="route('profile.edit')" class="dark:hover:text-white" @click="close()">
                                            <icon-user class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0" />

                                            Profile
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="/apps/mailbox" class="dark:hover:text-white" @click="close()">
                                            <icon-mail class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0" />

                                            Inbox
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="/auth/boxed-lockscreen" class="dark:hover:text-white" @click="close()">
                                            <icon-lock-dots class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0" />

                                            Lock Screen
                                        </Link>
                                    </li>
                                    <li class="border-t border-white-light dark:border-white-light/10">
                                        <Link href="#" @click="logout" class="text-danger !py-3" >
                                            <icon-logout class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 rotate-90 shrink-0" />
                                            Sign Out
                                        </Link>
                                    </li>
                                </ul>
                            </template>
                        </Popper>
                    </div>
                </div>
            </div>

            <!-- horizontal menu -->
            <ul
                class="horizontal-menu hidden py-1.5 font-semibold px-6 lg:space-x-1.5 xl:space-x-8 rtl:space-x-reverse bg-white border-t border-[#ebedf2] dark:border-[#191e3a] dark:bg-[#0e1726] text-black dark:text-white-dark"
            >
                <li class="menu nav-item relative">
                    <a href="javascript:;" class="nav-link">
                        <div class="flex items-center">
                            <icon-menu-dashboard class="shrink-0" />

                            <span class="px-2">{{ $t('dashboard') }}</span>
                        </div>
                        <div class="right_arrow">
                            <icon-caret-down />
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <Link href="/">{{ $t('sales') }}</Link>
                        </li>
                        <li>
                            <Link href="/analytics">{{ $t('analytics') }}</Link>
                        </li>
                        <li>
                            <Link href="/finance">{{ $t('finance') }}</Link>
                        </li>
                        <li>
                            <Link href="/crypto">{{ $t('crypto') }}</Link>
                        </li>
                    </ul>
                </li>
                <li class="menu nav-item relative">
                    <a href="javascript:;" class="nav-link">
                        <div class="flex items-center">
                            <icon-menu-apps class="shrink-0" />

                            <span class="px-2">{{ $t('apps') }}</span>
                        </div>
                        <div class="right_arrow">
                            <icon-caret-down />
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <Link href="/apps/chat">{{ $t('chat') }}</Link>
                        </li>
                        <li>
                            <Link href="/apps/mailbox">{{ $t('mailbox') }}</Link>
                        </li>
                        <li>
                            <Link href="/apps/todolist">{{ $t('todo_list') }}</Link>
                        </li>
                        <li>
                            <Link href="/apps/notes">{{ $t('notes') }}</Link>
                        </li>
                        <li>
                            <Link href="/apps/scrumboard">{{ $t('scrumboard') }}</Link>
                        </li>
                        <li>
                            <Link href="/apps/contacts">{{ $t('contacts') }}</Link>
                        </li>
                        <li class="relative">
                            <a href="javascript:;"
                                >{{ $t('invoice') }}
                                <div class="ltr:ml-auto rtl:mr-auto rtl:rotate-90 -rotate-90">
                                    <icon-caret-down />
                                </div>
                            </a>
                            <ul
                                class="rounded absolute top-0 ltr:left-[95%] rtl:right-[95%] min-w-[180px] bg-white z-[10] text-dark dark:text-white-dark dark:bg-[#1b2e4b] shadow p-0 py-2 hidden"
                            >
                                <li>
                                    <Link href="/apps/invoice/list">{{ $t('list') }}</Link>
                                </li>
                                <li>
                                    <Link href="/apps/invoice/preview">{{ $t('preview') }}</Link>
                                </li>
                                <li>
                                    <Link href="/apps/invoice/add">{{ $t('add') }}</Link>
                                </li>
                                <li>
                                    <Link href="/apps/invoice/edit">{{ $t('edit') }}</Link>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <Link href="/apps/calendar">{{ $t('calendar') }}</Link>
                        </li>
                    </ul>
                </li>
                <li class="menu nav-item relative">
                    <a href="javascript:;" class="nav-link">
                        <div class="flex items-center">
                            <icon-menu-components class="shrink-0" />
                            <span class="px-2">{{ $t('components') }}</span>
                        </div>
                        <div class="right_arrow">
                            <icon-caret-down />
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <Link href="/components/tabs">{{ $t('tabs') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/accordions">{{ $t('accordions') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/modals">{{ $t('modals') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/cards">{{ $t('cards') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/carousel">{{ $t('carousel') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/countdown">{{ $t('countdown') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/counter">{{ $t('counter') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/sweetalert">{{ $t('sweet_alerts') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/timeline">{{ $t('timeline') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/notifications">{{ $t('notifications') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/media-object">{{ $t('media_object') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/list-group">{{ $t('list_group') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/pricing-table">{{ $t('pricing_tables') }}</Link>
                        </li>
                        <li>
                            <Link href="/components/lightbox">{{ $t('lightbox') }}</Link>
                        </li>
                    </ul>
                </li>
                <li class="menu nav-item relative">
                    <a href="javascript:;" class="nav-link">
                        <div class="flex items-center">
                            <icon-menu-elements class="shrink-0" />
                            <span class="px-2">{{ $t('elements') }}</span>
                        </div>
                        <div class="right_arrow">
                            <icon-caret-down />
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <Link href="/elements/alerts">{{ $t('alerts') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/avatar">{{ $t('avatar') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/badges">{{ $t('badges') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/breadcrumbs">{{ $t('breadcrumbs') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/buttons">{{ $t('buttons') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/buttons-group">{{ $t('button_groups') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/color-library">{{ $t('color_library') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/dropdown">{{ $t('dropdown') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/infobox">{{ $t('infobox') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/jumbotron">{{ $t('jumbotron') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/loader">{{ $t('loader') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/pagination">{{ $t('pagination') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/popovers">{{ $t('popovers') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/progress-bar">{{ $t('progress_bar') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/search">{{ $t('search') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/tooltips">{{ $t('tooltips') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/treeview">{{ $t('treeview') }}</Link>
                        </li>
                        <li>
                            <Link href="/elements/typography">{{ $t('typography') }}</Link>
                        </li>
                    </ul>
                </li>
                <li class="menu nav-item relative">
                    <a href="javascript:;" class="nav-link">
                        <div class="flex items-center">
                            <icon-menu-datatables class="shrink-0" />
                            <span class="px-2">{{ $t('tables') }}</span>
                        </div>
                        <div class="right_arrow">
                            <icon-caret-down />
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <Link href="/tables">{{ $t('tables') }}</Link>
                        </li>
                        <li class="relative">
                            <a href="javascript:;"
                                >{{ $t('datatables') }}
                                <div class="ltr:ml-auto rtl:mr-auto rtl:rotate-90 -rotate-90">
                                    <icon-caret-down />
                                </div>
                            </a>
                            <ul
                                class="rounded absolute top-0 ltr:left-[95%] rtl:right-[95%] min-w-[180px] bg-white z-[10] text-dark dark:text-white-dark dark:bg-[#1b2e4b] shadow p-0 py-2 hidden"
                            >
                                <li>
                                    <Link href="/datatables/basic">{{ $t('basic') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/advanced">{{ $t('advanced') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/skin">{{ $t('skin') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/order-sorting">{{ $t('order_sorting') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/columns-filter">{{ $t('columns_filter') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/multi-column">{{ $t('multi_column') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/multiple-tables">{{ $t('multiple_tables') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/alt-pagination">{{ $t('alt_pagination') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/checkbox">{{ $t('checkbox') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/range-search">{{ $t('range_search') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/export">{{ $t('export') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/sticky-header">{{ $t('sticky_header') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/clone-header">{{ $t('clone_header') }}</Link>
                                </li>
                                <li>
                                    <Link href="/datatables/column-chooser">{{ $t('column_chooser') }}</Link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu nav-item relative">
                    <a href="javascript:;" class="nav-link">
                        <div class="flex items-center">
                            <icon-menu-forms class="shrink-0" />
                            <span class="px-2">{{ $t('forms') }}</span>
                        </div>
                        <div class="right_arrow">
                            <icon-caret-down />
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <Link href="/forms/basic">{{ $t('basic') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/input-group">{{ $t('input_group') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/layouts">{{ $t('layouts') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/validation">{{ $t('validation') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/input-mask">{{ $t('input_mask') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/select2">{{ $t('select2') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/touchspin">{{ $t('touchspin') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/checkbox-radio">{{ $t('checkbox_and_radio') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/switches">{{ $t('switches') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/wizards">{{ $t('wizards') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/file-upload">{{ $t('file_upload') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/quill-editor">{{ $t('quill_editor') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/markdown-editor">{{ $t('markdown_editor') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/date-picker">{{ $t('date_and_range_picker') }}</Link>
                        </li>
                        <li>
                            <Link href="/forms/clipboard">{{ $t('clipboard') }}</Link>
                        </li>
                    </ul>
                </li>
                <li class="menu nav-item relative">
                    <a href="javascript:;" class="nav-link">
                        <div class="flex items-center">
                            <icon-menu-pages class="shrink-0" />
                            <span class="px-2">{{ $t('pages') }}</span>
                        </div>
                        <div class="right_arrow">
                            <icon-caret-down />
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li class="relative">
                            <a href="javascript:;"
                                >{{ $t('users') }}
                                <div class="ltr:ml-auto rtl:mr-auto rtl:rotate-90 -rotate-90">
                                    <icon-caret-down />
                                </div>
                            </a>
                            <ul
                                class="rounded absolute top-0 ltr:left-[95%] rtl:right-[95%] min-w-[180px] bg-white z-[10] text-dark dark:text-white-dark dark:bg-[#1b2e4b] shadow p-0 py-2 hidden"
                            >
                                <li>
                                    <Link href="/users/profile">{{ $t('profile') }}</Link>
                                </li>
                                <li>
                                    <Link href="/users/user-account-settings">{{ $t('account_settings') }}</Link>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <Link href="/pages/knowledge-base">{{ $t('knowledge_base') }}</Link>
                        </li>
                        <li>
                            <Link href="/pages/contact-us-boxed" target="_blank">{{ $t('contact_us_boxed') }}</Link>
                        </li>
                        <li>
                            <Link href="/pages/contact-us-cover" target="_blank">{{ $t('contact_us_cover') }}</Link>
                        </li>
                        <li>
                            <Link href="/pages/faq">FAQ</Link>
                        </li>
                        <li>
                            <Link href="/pages/coming-soon-boxed" target="_blank">{{ $t('coming_soon_boxed') }}</Link>
                        </li>
                        <li>
                            <Link href="/pages/coming-soon-cover" target="_blank">{{ $t('coming_soon_cover') }}</Link>
                        </li>
                        <li>
                            <Link href="/pages/maintenence" target="_blank">{{ $t('maintenence') }}</Link>
                        </li>
                        <li class="relative">
                            <a href="javascript:;"
                                >{{ $t('error') }}
                                <div class="ltr:ml-auto rtl:mr-auto rtl:rotate-90 -rotate-90">
                                    <icon-caret-down />
                                </div>
                            </a>
                            <ul
                                class="rounded absolute top-0 ltr:left-[95%] rtl:right-[95%] min-w-[180px] bg-white z-[10] text-dark dark:text-white-dark dark:bg-[#1b2e4b] shadow p-0 py-2 hidden"
                            >
                                <li>
                                    <Link href="/pages/error404" target="_blank">{{ $t('404') }}</Link>
                                </li>
                                <li>
                                    <Link href="/pages/error500" target="_blank">{{ $t('500') }}</Link>
                                </li>
                                <li>
                                    <Link href="/pages/error503" target="_blank">{{ $t('503') }}</Link>
                                </li>
                            </ul>
                        </li>
                        <li class="relative">
                            <a href="javascript:;"
                                >{{ $t('login') }}
                                <div class="ltr:ml-auto rtl:mr-auto rtl:rotate-90 -rotate-90">
                                    <icon-caret-down />
                                </div>
                            </a>
                            <ul
                                class="rounded absolute top-0 ltr:left-[95%] rtl:right-[95%] min-w-[180px] bg-white z-[10] text-dark dark:text-white-dark dark:bg-[#1b2e4b] shadow p-0 py-2 hidden"
                            >
                                <li>
                                    <Link href="/auth/cover-login" target="_blank">{{ $t('login_cover') }}</Link>
                                </li>
                                <li>
                                    <Link href="/auth/boxed-signin" target="_blank">{{ $t('login_boxed') }}</Link>
                                </li>
                            </ul>
                        </li>
                        <li class="relative">
                            <a href="javascript:;"
                                >{{ $t('register') }}
                                <div class="ltr:ml-auto rtl:mr-auto rtl:rotate-90 -rotate-90">
                                    <icon-caret-down />
                                </div>
                            </a>
                            <ul
                                class="rounded absolute top-0 ltr:left-[95%] rtl:right-[95%] min-w-[180px] bg-white z-[10] text-dark dark:text-white-dark dark:bg-[#1b2e4b] shadow p-0 py-2 hidden"
                            >
                                <li>
                                    <Link href="/auth/cover-register" target="_blank">{{ $t('register_cover') }}</Link>
                                </li>
                                <li>
                                    <Link href="/auth/boxed-signup" target="_blank">{{ $t('register_boxed') }}</Link>
                                </li>
                            </ul>
                        </li>
                        <li class="relative">
                            <a href="javascript:;"
                                >{{ $t('password_recovery') }}
                                <div class="ltr:ml-auto rtl:mr-auto rtl:rotate-90 -rotate-90">
                                    <icon-caret-down />
                                </div>
                            </a>
                            <ul
                                class="rounded absolute top-0 ltr:left-[95%] rtl:right-[95%] min-w-[180px] bg-white z-[10] text-dark dark:text-white-dark dark:bg-[#1b2e4b] shadow p-0 py-2 hidden"
                            >
                                <li>
                                    <Link href="/auth/cover-password-reset" target="_blank">{{ $t('recover_id_cover') }}</Link>
                                </li>
                                <li>
                                    <Link href="/auth/boxed-password-reset" target="_blank">{{ $t('recover_id_boxed') }}</Link>
                                </li>
                            </ul>
                        </li>
                        <li class="relative">
                            <a href="javascript:;"
                                >{{ $t('lockscreen') }}
                                <div class="ltr:ml-auto rtl:mr-auto rtl:rotate-90 -rotate-90">
                                    <icon-caret-down />
                                </div>
                            </a>
                            <ul
                                class="rounded absolute top-0 ltr:left-[95%] rtl:right-[95%] min-w-[180px] bg-white z-[10] text-dark dark:text-white-dark dark:bg-[#1b2e4b] shadow p-0 py-2 hidden"
                            >
                                <li>
                                    <Link href="/auth/cover-lockscreen" target="_blank">{{ $t('unlock_cover') }}</Link>
                                </li>
                                <li>
                                    <Link href="/auth/boxed-lockscreen" target="_blank">{{ $t('unlock_boxed') }}</Link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu nav-item relative">
                    <a href="javascript:;" class="nav-link">
                        <div class="flex items-center">
                            <icon-menu-more class="shrink-0" />

                            <span class="px-2">{{ $t('more') }}</span>
                        </div>
                        <div class="right_arrow">
                            <icon-caret-down />
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <Link href="/dragndrop">{{ $t('drag_and_drop') }}</Link>
                        </li>
                        <li>
                            <Link href="/charts">{{ $t('charts') }}</Link>
                        </li>
                        <li>
                            <Link href="/font-icons">{{ $t('font_icons') }}</Link>
                        </li>
                        <li>
                            <Link href="/widgets">{{ $t('widgets') }}</Link>
                        </li>
                        <li>
                            <a href="https://vristo.sbthemes.com" target="_blank">{{ $t('documentation') }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
</template>

