<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import CreateUserForm from '@/Pages/Users/Partials/CreateUserForm.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';

    const props = defineProps({
        establishments: {
            type: Object,
            default: () => ({}),
        },
        roles: {
            type: Object,
            default: () => ({}),
        }
    });

</script>

<template>
    <AppLayout title="Crear Usuario">
        <Navigation >
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Configuraciones</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('users.index')" class="text-primary hover:underline">Usuario</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <CreateUserForm :establishments="props.establishments" :roles="roles" />
        </div>
    </AppLayout>
</template>
