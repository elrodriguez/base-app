<script setup>
import InputError from '@/Components/InputError.vue';
import { faCloudArrowUp } from "@fortawesome/free-solid-svg-icons";
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const fileInput = ref(null);

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;
const baseUrl = assetUrl;
const getImage = (path) => {
    return baseUrl + 'storage/'+ path;
}

const form = useForm({
    name: user.name,
    email: user.email,
    information: user.information,
    avatar: user.avatar,
    avatar_preview:  user.avatar ? getImage(user.avatar) : null,
});

function submit() {
  form.post(route('profile.update'))
}

const triggerFileInput = () => {
    fileInput.value.click();
}

watch(() => form.avatar, (newValue) => {
    if (newValue instanceof File) {
        const reader = new FileReader();
        reader.onload = (e) => {
            form.avatar_preview = e.target.result;
        };
        reader.readAsDataURL(newValue);
    } else {
        // Puedes manejar el caso en el que newValue no sea un objeto File válido
        console.error("El objeto no es un archivo válido.");
    }
});
</script>

<template>

    <form @submit.prevent="submit"  class="border border-[#ebedf2] dark:border-[#191e3a] rounded-md p-4 mb-5 bg-white dark:bg-[#0e1726]">
        <h6 class="text-lg font-bold mt-1">Información general</h6>
        <p class="mb-5 text-sm text-gray-600 dark:text-gray-400">
            Actualice la información del perfil y la dirección de correo electrónico de su cuenta.
        </p>
        <div class="flex flex-col sm:flex-row w-full">
            <div class="ltr:sm:mr-4 rtl:sm:ml-4 w-full sm:w-2/12 mb-5">
                <img v-if="form.avatar_preview" :src="form.avatar_preview" :alt="form.name" class="w-20 h-20 md:w-32 md:h-32 rounded-full object-cover mx-auto"/>
                <img v-else :src="`https://ui-avatars.com/api/?name=${form.name}&size=150&rounded=true`" :alt="form.name" class="w-20 h-20 md:w-32 md:h-32 rounded-full object-cover mx-auto" />
            
                <div class="w-full flex justify-center">
                    <button @click="triggerFileInput" type="button" class="mt-4 btn btn-danger btn-sm">
                        <font-awesome-icon :icon="faCloudArrowUp" class="mr-1" />
                        Foto
                    </button>
                    <input accept=".png, .jpg, .jpeg"                  
                        type="file" 
                        ref="fileInput"
                        @input="form.avatar = $event.target.files[0]"
                        class="hidden"
                    />
                </div>
            </div>
            <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="name">Nombre de Usuario</label>
                    <input v-model="form.name" id="name" type="text" class="form-input" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div>
                    <label for="email">Email</label>
                    <input v-model="form.email" id="email" type="email" class="form-input" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div>
                    <label for="information">Información</label>
                    <input v-model="form.information" id="information" type="text" class="form-input" />
                    <InputError class="mt-2" :message="form.errors.information" />
                </div>
                <div class="sm:col-span-2 mt-3 w-full flex justify-end">
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="mr-4" style="height: 10px;">
                        {{ form.progress.percentage }}%
                    </progress>
                    <button type="submit" :disabled="form.processing" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </form>

  <!-- <form class="mt-6 space-y-6">
            <div>
                <InputLabel for="avatar" value="Avatar" />
                <input accept=".png, .jpg, .jpeg"                  
                type="file" 
                @input="form.avatar = $event.target.files[0]" 
                class="mt-1 block w-full"
                />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
                </progress>
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Tu dirección de corre electrónico no ha sido VERIFICADA.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Click aquí para re-enviar la verificación de Correo Electrónica.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="mt-2 flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
    
  </form> -->

</template>


