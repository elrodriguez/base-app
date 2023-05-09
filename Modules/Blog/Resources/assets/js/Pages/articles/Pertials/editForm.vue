<script setup>
    import { useForm } from '@inertiajs/vue3';
    import FormSection from '@/Components/FormSection.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import Keypad from '@/Components/Keypad.vue';
    import { ref, onMounted } from 'vue';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import TextInput from '@/Components/TextInput.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';

    const props = defineProps({
        article: {
            type: Object,
            default: () => ({})
        }
    });

    const form = useForm({
        id: props.article.id,
        title: props.article.title,
        content_text: props.article.content_text,
        status: props.article.status ? true : false,
        file: props.article.imagen
    });

    const photoPreview = ref(null);
    const photoInput = ref(null);

    const updateArticle = () => {

        if (photoInput.value) {
            form.file = photoInput.value.files[0];
        }

        form.post(route('blog-article-update'), {
            forceFormData: true,
            errorBag: 'updateArticle',
            preserveScroll: true,
            onSuccess: () => {
                swal('Articulo actualizado con éxito.');
            },
        });
    };

    const selectNewPhoto = () => {
        photoInput.value.click();
    };

    const updatePhotoPreview = () => {
        const photo = photoInput.value.files[0];

        if (! photo) return;

        const reader = new FileReader();

        reader.onload = (e) => {
            photoPreview.value = e.target.result;
        };

        reader.readAsDataURL(photo);
    };

    const deletePhoto = () => {
        router.delete(route('current-user-photo.destroy'), {
            preserveScroll: true,
            onSuccess: () => {
                photoPreview.value = null;
                clearPhotoFileInput();
            },
        });
    };

    onMounted(() => {
         ClassicEditor.create(document.querySelector('#editor'),{
            toolbar: [
                'heading', 
                '|', 
                'bold', 
                'italic', 
                'link',
                'alignment',
                '|',
                'imageUpload',
                'blockQuote',
                'code',
            ]
         }).then(editor => {
            editor.setData(props.article.content_text);
            editor.model.document.on('change:data', () => {
                form.content_text = editor.getData();
            });
        }).catch(error => {
            console.error(error);
        });
    });

</script>


<template>
    <FormSection @submitted="updateArticle">
        <template #title>
            Articulo Detalles
        </template>

        <template #description>
            Todos los campos con * son obligatorios
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="title" value="Titulo *" />
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    class="block w-full mt-1"
                    autofocus
                    autocomplete="off"
                />
                <InputError :message="form.errors.title" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="content" value="Contenido *" />
                <div id="editor"></div>
                <InputError :message="form.errors.content_text" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-6">
                <div>
                    <!-- Profile Photo File Input -->
                    <input
                        ref="photoInput"
                        type="file"
                        class="hidden"
                        @change="updatePhotoPreview"
                    >
                    <InputLabel for="photo" value="Photo" />
                    <!-- Current Profile Photo -->
                    <div v-show="!photoPreview" class="mt-2">
                        <img :src="form.file" :alt="form.title" class="object-cover" style="width: 200px;" />
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div v-show="photoPreview" class="mt-2">
                        <img :src="photoPreview" :alt="form.title" class="object-cover" style="width: 200px;" />
                    </div>

                    <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                        Seleccione una nueva foto
                    </SecondaryButton>

                    <!-- <SecondaryButton
                        v-if="form.file"
                        type="button"
                        class="mt-2"
                        @click.prevent="deletePhoto"
                    >
                        Eliminar imagen
                    </SecondaryButton> -->

                    <InputError :message="form.errors.file" class="mt-2" />
                </div>
            </div>
            <div class="col-span-6 sm:col-span-6">
                <div class="flex items-center mb-6">
                    <input v-model="form.status" id="checkboxStatus" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkboxStatus" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Activo
                    </label>
                </div>
            </div>
        </template>

        <template #actions>
            <Keypad>
                <template #botones>
                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Guardar
                    </PrimaryButton>
                    <a :href="route('blog-article.index')"  class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out ml-2">Ir al Listado</a>
                </template>
            </Keypad>
        </template>
    </FormSection>
</template>
