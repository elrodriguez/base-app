<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <Link :href="route('dashboard')" class="text-primary hover:underline">Inicio</Link>
        </li>
        <slot />
    </ul>
</template>