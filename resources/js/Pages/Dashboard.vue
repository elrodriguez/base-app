<script setup>
import Welcome from '@/Components/Welcome.vue';
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import Shortcuts from '@/Components/Shortcuts.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import StudentDashboard from 'Modules/Academic/Resources/assets/js/Components/StudentDashboard.vue';

const userData = usePage().props.auth.user;

const props = defineProps({
    authPerson: {
        type: Object,
        default: () => ({})
    }
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template v-for="role in userData.roles">
            <!--modulo academico -->
            <StudentDashboard v-if="role.name == 'Alumno'" 
                :userData="userData" 
                :authPerson="authPerson"
             />
            <!-- fin modulo academico -->
        </template>
    </AppLayout>
</template>
