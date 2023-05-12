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


    const form = useForm({
        title: '',
        content_text: '',
        description:'',
        status: true
    });

    const createArticle = () => {
        form.post(route('blog-article.store'), {
            errorBag: 'createArticle',
            preserveScroll: true
        });
    };
    onMounted(() => {
         ClassicEditor.create(document.querySelector('#editor'),{
            minHeight: '300px'
         }).then(editor => {
            
            editor.model.document.on('change:data', () => {
                form.content_text = editor.getData();
            });
        }).catch(error => {
            console.error(error);
        });
    });
</script>


<template>
    <FormSection @submitted="createArticle">
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
                <InputLabel for="description" value="description *" />
                <textarea v-model="form.description" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                <InputError :message="form.errors.description" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="content" value="Contenido *" />
                <div id="editor"></div>
                <InputError :message="form.errors.content_text" class="mt-2" />
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
