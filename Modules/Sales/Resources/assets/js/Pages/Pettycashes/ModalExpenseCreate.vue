<script setup>
    import DialogModal from '@/Components/DialogModal.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import InputError from '@/Components/InputError.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { faMoneyBill1Wave} from "@fortawesome/free-solid-svg-icons";
    import { ref } from 'vue';
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        petty_cash_id: props.petty_cash_id,
        description:'',
        amount: '',
        document:''

    });
    const displayModal = ref(false);
    const openModalExpenseCreate = () => {
        displayModal.value = true;
    };
    const closeModal = () => {
        form.reset();
        displayModal.value = false;
    };

    const props = defineProps({
        petty_cash_id: {
            type: Object,
            default: () => ({}),
        }
    });

    const createExpense = () => {
        form.post(route('store_expense'), {
            forceFormData: true,
            errorBag: 'createExpense',
            preserveScroll: true,
            onSuccess: () => closeModal(),
        });
    };
</script>

<template>
    <button @click="openModalExpenseCreate" type="button" class="inline-block w-10 py-2 bg-yellow-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-500 hover:shadow-lg focus:bg-yellow-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out"><font-awesome-icon :icon="faMoneyBill1Wave" /></button>
    <DialogModal :show="displayModal" @close="closeModal">
        <template #title>
            Registrar Gasto en CAJA
        </template>
        <template #content>

            <form>
                <div class="grid grid-cols-3 gap-4">
                    <div class="form-group mb-6">
                        <InputLabel value="Descripción o Motivo" class="mb-1" />
                        <TextInput
                            v-model="form.description"
                            type="text"
                            class="block w-full mt-1"
                            autofocus
                        />
                        <InputError  :message="form.errors.description" class="mt-2" />
                    </div>
                    <div class="form-group mb-6">
                        <InputLabel value="Monto" />
                        <TextInput
                            v-model="form.amount"
                            type="text"
                            class="block w-full mt-1"
                            autofocus
                        />
                        <InputError :message="form.errors.amount" class="mt-2" />
                    </div>
                    <div class="form-group mb-6">
                        <InputLabel value="N° Documento" />
                        <TextInput
                            v-model="form.document"
                            aria-placeholder="N° de Recibo / Empresa"
                            type="text"
                            class="block w-full mt-1"
                            autofocus
                        />
                        <InputError :message="form.errors.document" class="mt-2" />
                    </div>
                </div>
           </form>
        </template>

        <template #footer>
            <SecondaryButton @click="closeModal">
                Cancel
            </SecondaryButton>

            <DangerButton
                class="ml-3"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="createExpense"
            >
                Guardar
            </DangerButton>
        </template>
    </DialogModal>
</template>
