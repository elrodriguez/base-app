<script setup>
    import { ref, onMounted } from 'vue';

    import { useAppStore } from '@/stores/index';
    import IconCaretsDown from '@/Components/vristo/icon/icon-carets-down.vue';

    import IconMinus from '@/Components/vristo/icon/icon-minus.vue';

    import IconCaretDown from '@/Components/vristo/icon/icon-caret-down.vue';

    
    import { Link } from '@inertiajs/vue3';
    import menuData from './MenuData.js'

    const store = useAppStore();
    const activeDropdown = ref('');

    onMounted(() => {
        const selector = document.querySelector('.sidebar ul a[href="' + window.location.pathname + '"]');
        if (selector) {
            selector.classList.add('active');
            const ul = selector.closest('ul.sub-menu');
            if (ul) {
                let ele  = ul.closest('li.menu').querySelectorAll('.nav-link') || [];
                if (ele.length) {
                    ele = ele[0];
                    setTimeout(() => {
                        ele.click();
                    });
                }
            }
        }
    });

    const toggleMobileMenu = () => {
        if (window.innerWidth < 1024) {
            store.toggleSidebar();
        }
    };


    const xasset = assetUrl;
</script>
<template>
    <div :class="{ 'dark text-white-dark': store.semidark }">
        <nav class="sidebar fixed min-h-screen h-full top-0 bottom-0 w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] z-50 transition-all duration-300">
            <div class="bg-white dark:bg-[#0e1726] h-full">
                <div class="flex justify-between items-center px-4 py-3">
                    <Link href="/" class="main-logo flex items-center shrink-0">
                        <img v-if="$page.props.company.isotipo == '/img/isotipo.png'" class="w-8 ml-[5px] flex-none" :src="xasset+$page.props.company.isotipo" alt="" />
                        <img v-else class="w-8 ml-[5px] flex-none" :src="xasset+'storage/'+$page.props.company.isotipo" alt="" />
                        <span class="text-2xl ltr:ml-1.5 rtl:mr-1.5 font-semibold align-middle lg:inline dark:text-white-light">{{ $page.props.company.name }}</span>
                    </Link>
                    <a
                        href="javascript:;"
                        class="collapse-icon w-8 h-8 rounded-full flex items-center hover:bg-gray-500/10 dark:hover:bg-dark-light/10 dark:text-white-light transition duration-300 rtl:rotate-180 hover:text-primary"
                        @click="store.toggleSidebar()"
                    >
                        <icon-carets-down class="m-auto rotate-90" />
                    </a>
                </div>
                <perfect-scrollbar
                    :options="{
                        swipeEasing: true,
                        wheelPropagation: false,
                    }"
                    class="h-[calc(100vh-80px)] relative"
                >
                    <ul class="relative font-semibold space-y-0.5 p-4 py-0">

                        <template v-for="(item, index) in menuData" :key="index">
                            <template v-if="item.route == null">
                                <li v-can="item.permissions" class="menu nav-item">
                                    <button
                                        type="button"
                                        class="nav-link group w-full"
                                        :class="{ active: activeDropdown === item.text }"
                                        @click="activeDropdown === item.text ? (activeDropdown = null) : (activeDropdown = item.text)"
                                    >
                                        <div class="flex items-center">
                                            <font-awesome-icon :icon="item.icom" class="group-hover:!text-primary shrink-0" />
                                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">
                                                {{ item.text }} 
                                            </span>
                                        </div>
                                        <div :class="{ 'rtl:rotate-90 -rotate-90': activeDropdown !== item.text }">
                                            <icon-caret-down />
                                        </div>
                                    </button>
                                    <HeightTransition v-show="activeDropdown === item.text">
                                        <template v-if="item.items && item.items.length > 0" >
                                            <ul class="sub-menu text-gray-500">
                                                <li v-for="(subItem, subIndex) in item.items" :key="subIndex">
                                                    <Link :href="subItem.route" @click="toggleMobileMenu">{{ subItem.text }}</Link>
                                                </li>
                                            </ul>
                                        </template>
                                    </HeightTransition>
                                </li>
                                
                            </template>
                            <template v-else-if="item.route == 'module'">
                                <h2 v-can="item.permissions" class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">
                                    <icon-minus class="w-4 h-5 flex-none hidden" />
                                    <span>{{ item.text }}</span> 
                                </h2>
                                <template v-if="item.items && item.items.length > 0" >
                                    <template v-for="(subItem, subIndex) in item.items" :key="subIndex">
                                        <template v-if="subItem.route == null">
                                            <li v-can="subItem.permissions" class="menu nav-item">
                                                <button
                                                    type="button"
                                                    class="nav-link group w-full"
                                                    :class="{ active: activeDropdown === subItem.text }"
                                                    @click="activeDropdown === subItem.text ? (activeDropdown = null) : (activeDropdown = subItem.text)"
                                                >
                                                    <div class="flex items-center">
                                                        <font-awesome-icon :icon="subItem.icom" class="group-hover:!text-primary shrink-0" />
                                                        <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">
                                                            {{ subItem.text }}
                                                        </span>
                                                    </div>
                                                    <div :class="{ 'rtl:rotate-90 -rotate-90': activeDropdown !== subItem.text }">
                                                        <icon-caret-down />
                                                    </div>
                                                </button>
                                                <HeightTransition v-show="activeDropdown === subItem.text">
                                                    <ul v-if="subItem.items && subItem.items.length > 0" class="sub-menu text-gray-500">
                                                        <template v-for="(subSubItem, subSubIndex) in subItem.items" :key="subSubIndex">
                                                            <li v-can="subSubItem.permissions">
                                                                <Link :href="subSubItem.route" @click="toggleMobileMenu">{{ subSubItem.text }}</Link>
                                                            </li>
                                                        </template>
                                                    </ul>
                                                </HeightTransition>
                                            </li>
                                        </template>
                                        <template v-else>
                                            <li v-can="subItem.permissions" class="menu nav-item">
                                                <Link :href="subItem.route" class="nav-link group" @click="toggleMobileMenu">
                                                    <div class="flex items-center">
                                                        <font-awesome-icon :icon="subItem.icom" class="group-hover:!text-primary shrink-0" />

                                                        <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">
                                                            {{ subItem.text }}
                                                        </span>
                                                    </div>
                                                </Link>
                                            </li>
                                        </template>
                                    </template>
                                </template>
                            </template>
                            <template v-else>
                                <li v-can="item.permissions" class="menu nav-item">
                                    <Link :href="item.route" class="nav-link group" @click="toggleMobileMenu">
                                        <div class="flex items-center">
                                            <!-- <icon-menu-font-icons class="group-hover:!text-primary shrink-0" /> -->
                                            <font-awesome-icon :icon="item.icom" class="group-hover:!text-primary shrink-0" />
                                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">
                                                {{ item.text }}
                                            </span>
                                        </div>
                                    </Link>
                                </li>
                            </template>
                            
                        </template>
                    </ul>
                </perfect-scrollbar>
            </div>
        </nav>
    </div>
</template>


