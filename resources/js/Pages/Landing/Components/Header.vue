<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const props = defineProps({
    authUser: {
        type: Object,
        default: () => ({})
    },
    authCompany: {
        type: Object,
        default: () => ({})
    },
    pageActive: String
});

const darkMode = ref(false);

const darkModeActive = () => {
    const body = document.body;
    const clasesDark = ['dark', 'text-bodydark', 'bg-boxdark-2'];
    const clasesLight = ['font-sans', 'antialiased'];

    const modo = localStorage.getItem('modo');
    let xmodo = modo ?? 'light';
    darkMode.value = xmodo == 'light' ? false : true;

    darkMode.value = !darkMode.value;
    body.classList.remove(...clasesDark, ...clasesLight);

    if (darkMode.value) {
        body.classList.add(...clasesDark);
        localStorage.setItem('modo', 'dark');
    } else {
        body.classList.add(...clasesLight);
        localStorage.setItem('modo', 'light');
    }
}

const aplicarClasesSegunLocalStorage = () => {
    const body = document.body;
    const clasesDark = ['dark', 'text-bodydark', 'bg-boxdark-2'];
    const clasesLight = ['font-sans', 'antialiased'];

    const modoAlmacenado = localStorage.getItem('modo');

    body.classList.remove(...clasesDark, ...clasesLight);

    if (modoAlmacenado === 'dark') {
        body.classList.add(...clasesDark);
        darkMode.value = true;
    } else {
        body.classList.add(...clasesLight);
        darkMode.value = false;
    }
}

onMounted(() => {
    aplicarClasesSegunLocalStorage();
});
</script>
<template>
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <Link :href="route('dashboard')" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img v-if="darkMode" src="/img/isotipo_negativo.png" class="h-8" alt="Flowbite Logo">
                <img v-else src="/img/isotipo.png" class="h-8" alt="Flowbite Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ authCompany.name }}</span>
            </Link>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <template v-if="Object.entries(props.authUser).length !== 0">
                    <Link :href="route('dashboard')" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Dashboard</Link>
                </template>
                <template v-else>
                    <Link :href="route('login')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Get started</Link>
                </template>
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a :href="route('index_main')" :class="pageActive == 'home' ? 'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500' : 'block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700'" aria-current="page">Inicio</a>
                    </li>
                    <li>
                        <a href="#nosotros" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Nosotros</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Blog</a>
                    </li>
                    <li>
                        <a href="#contacto" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contacto</a>
                    </li>
                    <!-- <li>
                        <Link :href="route('index_computer_store')" :class="pageActive == 'store' ? 'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500' : 'block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700'">Tienda</Link>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
</template>