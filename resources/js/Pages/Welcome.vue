<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Jumbotron from './Landing/Jumbotron.vue';
import Footer from './Landing/Footer.vue';
import About from './Landing/About.vue';
import ServicesTI from './Landing/ServicesTI.vue';
import ServicesAcademic from './Landing/ServicesAcademic.vue';
import Contact from './Landing/Contact.vue';
import Customers from './Landing/Customers.vue';
import Header from './Landing/Header.vue';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    jumbotron: {
        type: Object,
        default: () => ({})
    }
});

</script>

<template>
    <Head title="Bienvenido" />
    <Header 
        :authUser="$page.props.user" 
        :authCompany="$page.props.company" 
    />
    <Jumbotron :jumbotron="jumbotron" />
    <About />
    <!-- <ServicesAcademic /> -->
    <ServicesTI />
    <Contact />
    <Customers />
    <Footer :laravelVersion="laravelVersion" :phpVersion="phpVersion" />
</template>