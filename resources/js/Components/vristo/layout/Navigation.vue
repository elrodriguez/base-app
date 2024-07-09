<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    routeModule: {
        type: String,
        default: route('dashboard')
    },
    titleModule:{
        type: String,
        default: 'Inicio'
    }
});
</script>
<template>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <Link :href="route('dashboard')" class="text-primary hover:underline">Inicio</Link>
        </li>
        <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2 ">
            <Link :href="routeModule" class="text-primary hover:underline">{{ titleModule }}</Link>
        </li>
        <slot />
    </ul>
</template>