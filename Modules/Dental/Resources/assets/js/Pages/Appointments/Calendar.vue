<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { computed, onMounted, ref } from 'vue';
    import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';
    import FullCalendar from '@fullcalendar/vue3';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import interactionPlugin from '@fullcalendar/interaction';
    import listPlugin from '@fullcalendar/list';
    import esLocale from '@fullcalendar/core/locales/es';
    import momentTimezonePlugin from '@fullcalendar/moment-timezone';
    import Swal from 'sweetalert2';
    import { useForm, Link, router } from "@inertiajs/vue3";
    import Multiselect from "@suadelabs/vue3-multiselect";
    import "@suadelabs/vue3-multiselect/dist/vue3-multiselect.css";
    import FlatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';
    import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
    import IconX from '@/Components/vristo/icon/icon-x.vue';
    import { Dropdown, Menu } from 'ant-design-vue';
    import InputError from "@/Components/InputError.vue";

    const props = defineProps({
        appointments: {
            type: Object,
            default: () => ({}),
        },
        patients: {
            type: Object,
            default: () => ({}),
        },
        doctors: {
            type: Object,
            default: () => ({}),
        },
    });

    const form = useForm({
        id: null,
        correlative: null,
        patient_id: null,
        patient_person_id: null,
        doctor_id: null,
        doctor_person_id: null,
        date_appointmen: null,
        time_appointmen: null,
        date_end_appointmen: null,
        time_end_appointmen: null,
        email: null,
        telephone: null,
        description: null,
        details: null,
        message: null,
        status: '1',
        important: false,
        sick_time: null
    });

    const configFlatPickr = {
        dateFormat: 'Y-m-d',
        minDate: 'today',  // No permite fechas anteriores a la actual
        disable: [
            function (date) {
                // Bloquear domingos (día 0 en JavaScript)
                return (date.getDay() === 0);
            }
        ],
        onChange: function(selectedDates, dateStr, instance) {
            getBusyHours()
        },
    };

    const isAddEventModal = ref(false);
    const minStartDate = ref('');
    const minEndDate = ref('');
    const calendar = ref(null);
    const now = new Date();
    const events = ref([]);

    const calendarOptions = computed(() => {
        return {
            plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin, listPlugin, momentTimezonePlugin ],
            timeZone: 'America/Lima',
            timeZoneParam: 'America/Lima',
            now: new Date().toISOString(),
            initialView: 'listWeek',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
            },
            locale: esLocale,
            editable: true,
            dayMaxEvents: true,
            selectable: true,
            droppable: true,
            buttonText:{
                today:    'Hoy',
                month:    'Mes',
                week:     'Semana',
                day:      'Día',
                list:     'lista'
            },
            businessHours: {
                // days of week. an array of zero-based day of week integers (0=Sunday)
                daysOfWeek: [ 1, 2, 3, 4, 5, 6 ],
                startTime: '08:00',
                endTime: '20:00',
            },
            validRange: {
                start: new Date(),  // No permite fechas anteriores
            },
            eventClick: (event) => {
                editEvent(event);
            },
            select: (event) => {
                editDate(event);
            },
            events: events.value,
        };
    });

    onMounted(() => {
        getEvents();
    });

    const getEvents = () => {

        const formattedEvents = props.appointments.map(appointment => ({
            id: appointment.id,
            title: appointment.description,
            start: appointment.date_appointmen + 'T' + appointment.time_appointmen,
            end: appointment.date_end_appointmen + 'T' + appointment.time_end_appointmen, // Ajusta la lógica según tu necesidad
            className: (appointment.status == '1' ? 'success':(appointment.status == '2' ? 'primary' : (appointment.status == '0' ? 'danger' : 'info' ))), // Ajusta según tu necesidad
            description: null,
            patient_id: {
                code: appointment.patient_id,
                name: appointment.patient.full_name,
                email: appointment.patient.email,
                telephone: appointment.patient.telephone,
            },
            doctor_id: {
                code: appointment.doctor_id,
                name: appointment.doctor.full_name,
                email: appointment.doctor.email,
                telephone: appointment.doctor.telephone,
            },
            date_appointmen: appointment.date_appointmen,
            time_appointmen: appointment.time_appointmen
        }));

        events.value = formattedEvents;

    };

    const editEvent = (data = null) => {

        if (data) {
            let obj = JSON.parse(JSON.stringify(data.event));

            form.id = obj.id ? obj.id : null,
            form.description = obj.title ? obj.title : null,
            form.date_appointmen = obj.extendedProps ? obj.extendedProps.date_appointmen : null,
            form.time_appointmen = obj.extendedProps ? obj.extendedProps.time_appointmen : null,
            form.status = (obj.classNames == 'success' ? '1':(obj.classNames == 'primary' ? '2' : (obj.classNames == 'danger' ? '0' : '3' ))),
            form.patient_id = obj.extendedProps ? obj.extendedProps.patient_id : null;
            form.doctor_id = obj.extendedProps ? obj.extendedProps.doctor_id : null;

            if(!form.date_appointmen){
                let date = new Date(obj.start); //fecha seleccionada en el calendario
                let formattedDate = date.getFullYear() + '-' +
                String(date.getMonth() + 1).padStart(2, '0') + '-' + 
                String(date.getDate()).padStart(2, '0');

                form.date_appointmen = formattedDate;
            }
            
        } else {
            let date = new Date(); //fecha seleccionada en el calendario
            let formattedDate = date.getFullYear() + '-' +
            String(date.getMonth() + 1).padStart(2, '0') + '-' + 
            String(date.getDate()).padStart(2, '0');

            form.date_appointmen = formattedDate;
        }

        isAddEventModal.value = true;
    };

    const editDate = (data) => {
        let obj = {
            event: {
                start: data.start,
                end: data.end,
            },
        };
        editEvent(obj);
    };

    const dateFormat = (dt) => {
        dt = new Date(dt);
        const month = dt.getMonth() + 1 < 10 ? '0' + (dt.getMonth() + 1) : dt.getMonth() + 1;
        const date = dt.getDate() < 10 ? '0' + dt.getDate() : dt.getDate();
        const hours = dt.getHours() < 10 ? '0' + dt.getHours() : dt.getHours();
        const mins = dt.getMinutes() < 10 ? '0' + dt.getMinutes() : dt.getMinutes();
        dt = dt.getFullYear() + '-' + month + '-' + date + 'T' + hours + ':' + mins;
        return dt;
    };

    const saveAppointment = () => {
        if (!form.description) {
            return true;
        }
        if (!form.date_appointmen) {
            return true;
        }
        if (!form.time_appointmen) {
            return true;
        }

        if (form.id) {
            //update event
            axios({
                method: 'put',
                url: route("odontology_appointments_update", form.id),
                data: form,
            }).then((result) => {
                let index = events.value.findIndex((d) => d.id == form.id);
                let event = {
                    id: result.data.appointment.id,
                    title: result.data.appointment.description,
                    start: result.data.appointment.date_appointmen + 'T' + result.data.appointment.time_appointmen,
                    end: result.data.appointment.date_end_appointmen + 'T' + result.data.appointment.time_end_appointmen,
                    description: null,
                    className: (result.data.appointment.status == '1' ? 'success':(result.data.appointment.status == '2' ? 'primary' : (result.data.appointment.status == '0' ? 'danger' : 'info' ))),
                };
                events.value[index] = event;
            });
            
        } else {
            axios({
                method: 'post',
                url: route("odontology_appointments_store"),
                data: form,
            }).then((result) => {
                let event = {
                    id: result.data.appointment.id,
                    title: result.data.appointment.description,
                    start: result.data.appointment.date_appointmen + 'T' + result.data.appointment.time_appointmen,
                    end: result.data.appointment.date_end_appointmen + 'T' + result.data.appointment.time_end_appointmen,
                    description: null,
                    className: (result.data.appointment.status == '1' ? 'success':(result.data.appointment.status == '2' ? 'primary' : (result.data.appointment.status == '0' ? 'danger' : 'info' ))),
                };
                events.value.push(event);
            });
        }
        form.reset();
        calendar.value.getApi(); //refresh Calendar
        showMessage('Event has been saved successfully.');
        isAddEventModal.value = false;
    };

    const timeVisible = ref(false);
    const startTimeChange = (time) => {
        form.time_appointmen = time;
        form.time_end_appointmen = sumarMinutos(time,30);
        timeVisible.value = false;
    };

    const showMessage = (msg = '', type = 'success') => {
        const toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            customClass: { container: 'toast' },
        });
        toast.fire({
            icon: type,
            title: msg,
            padding: '10px 20px',
        });
    };

    const arrayTimes = ref([]);

    // Función para generar el rango de horas
    const generateTimeRange = (start, end, interval, unavailableTimes = []) => {
        const times = [];
        let [startHour, startMinute] = start.split(':').map(Number);
        const [endHour, endMinute] = end.split(':').map(Number);

        while (startHour < endHour || (startHour === endHour && startMinute <= endMinute)) {
            const formattedTime = `${String(startHour).padStart(2, '0')}:${String(startMinute).padStart(2, '0')}`;
            
            // Convertir unavailableTimes a formato HH:mm para comparación
            const unavailableTimesFormatted = unavailableTimes.map(time => time.slice(0, 5));
            
            // Verificar si la hora está en el array de horas ocupadas
            const isUnavailable = unavailableTimesFormatted.includes(formattedTime);
            
            // Agregar el objeto con el formato {time, active}
            times.push({
                time: formattedTime,
                active: !isUnavailable // active será false si está en unavailableTimes
            });

            // Incrementar los minutos por el intervalo dado
            startMinute += interval;
            if (startMinute >= 60) {
                startMinute -= 60;
                startHour += 1;
            }
        }

        arrayTimes.value = times;
    };

    // Función para sumar minutos a una hora
    const sumarMinutos = (hora, minutosASumar) => {
        let [horas, minutos] = hora.split(':').map(Number);

        // Sumar los minutos
        minutos += minutosASumar;

        // Ajustar si los minutos exceden 60
        while (minutos >= 60) {
            minutos -= 60;
            horas += 1;
        }

        // Ajustar si las horas exceden 24 (opcional si no quieres que pase de las 24 horas)
        horas = horas % 24;

        // Formatear el resultado para que tenga dos dígitos
        const horasFormateadas = String(horas).padStart(2, '0');
        const minutosFormateados = String(minutos).padStart(2, '0');

        return `${horasFormateadas}:${minutosFormateados}`;
    };

    const updateSelected = (query) => {
        let pp = JSON.parse(JSON.stringify(query));
        form.email = pp.email;
        form.telephone = pp.telephone;
    };

    const getBusyHours = () => {
        axios({
            method: 'get',
            url: route("odontology_appointments_busy_hours",[form.date_appointmen,form.doctor_id.code])
        }).then((result) => {
            generateTimeRange('08:00','20:00',30,result.data.times);
        });
    }

</script>
<template>
    <AppLayout title="Citas">
        <div>
            <div class="panel">
                <div class="mb-5">
                    <div class="mb-4 flex items-center sm:flex-row flex-col sm:justify-between justify-center">
                        <div class="sm:mb-0 mb-4">
                            <div class="text-lg font-semibold ltr:sm:text-left rtl:sm:text-right text-center">Calendar</div>
                            <div class="flex items-center mt-2 flex-wrap sm:justify-start justify-center">
                                <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                    <div class="h-2.5 w-2.5 rounded-sm ltr:mr-2 rtl:ml-2 bg-primary"></div>
                                    <div>Atendido</div>
                                </div>
                                <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                    <div class="h-2.5 w-2.5 rounded-sm ltr:mr-2 rtl:ml-2 bg-success"></div>
                                    <div>Pendiente</div>
                                </div>
                                <div class="flex items-center">
                                    <div class="h-2.5 w-2.5 rounded-sm ltr:mr-2 rtl:ml-2 bg-danger"></div>
                                    <div>Cancelado</div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" @click="editEvent()">
                            <icon-plus class="ltr:mr-2 rtl:ml-2" />
                            Crear Cita
                        </button>
                    </div>
                    <div class="calendar-wrapper">
                        <FullCalendar ref="calendar" :options="calendarOptions">
                            <template v-slot:eventContent="arg">
                                <div class="fc-event-main-frame flex items-center px-1 py-0.5 text-white">
                                    <div class="fc-event-time font-semibold px-0.5">
                                        {{ arg.timeText }}
                                    </div>
                                    <div class="fc-event-title-container">
                                        <div class="fc-event-title fc-sticky !font-medium px-0.5">
                                            {{ arg.event.title }}
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </FullCalendar>
                    </div>
                </div>
            </div>
            <!-- add event modal -->
            <TransitionRoot appear :show="isAddEventModal" as="template">
                <Dialog as="div" @close="isAddEventModal = false" class="relative z-[51]">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                    >
                        <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                    </TransitionChild>

                    <div class="fixed inset-0 overflow-y-auto">
                        <div class="flex min-h-full items-center justify-center px-4 py-8">
                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0 scale-95"
                                enter-to="opacity-100 scale-100"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100 scale-100"
                                leave-to="opacity-0 scale-95"
                            >
                                <DialogPanel class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-4xl text-black dark:text-white-dark">
                                    <button
                                        type="button"
                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                        @click="isAddEventModal = false"
                                    >
                                        <icon-x />
                                    </button>
                                    <div class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                        {{ form.id ? 'Editar Cita' : 'Crear Cita' }}
                                    </div>
                                    <div class="p-5">
                                        <form @submit.prevent="saveAppointment">
                                            <div class="grid sm:grid-cols-2 gap-5 mb-5">
                                                <div :class="[form.doctor_id? form.errors.doctor_id ? 'has-success' : 'has-error' : '', ]" class="" >
                                                    <label for="doctor_id" >Doctores</label>
                                                    <multiselect
                                                        id="doctor_id" :model-value="form.doctor_id"
                                                        v-model="form.doctor_id"
                                                        :options="doctors"
                                                        class="custom-multiselect"
                                                        :searchable="true"
                                                        placeholder="Buscar doctor"
                                                        selected-label="seleccionado"
                                                        select-label="Elegir"
                                                        deselect-label="Quitar"
                                                        label="name"
                                                        track-by="code"
                                                        @update:modelValue="getBusyHours"
                                                    ></multiselect>
                                                    <InputError :message="form.errors.doctor_id" class="mt-1" />
                                                </div>
                                                <div :class="[form.patient_id ? form.errors.patient_id ? 'has-success' : 'has-error' : '', ]"
                                                    class=""
                                                >
                                                    <label for="patient_id" >Paciente</label>
                                                    <multiselect
                                                        id="patient_id"
                                                        v-model="form.patient_id"
                                                        :options="patients"
                                                        class="custom-multiselect"
                                                        :searchable="true"
                                                        placeholder="Buscar paciente"
                                                        selected-label="seleccionado"
                                                        select-label="Elegir"
                                                        deselect-label="Quitar"
                                                        label="name"
                                                        track-by="code"
                                                        @update:model-value="updateSelected"
                                                    ></multiselect>
                                                    <InputError :message="form.errors.patient_id" class="mt-1" />
                                                </div>
                                            </div>
                                            <div class="grid sm:grid-cols-2 gap-5">
                                                <div class="mb-5">
                                                    <label for="dateStart">Día :</label>
                                                    <flat-pickr
                                                        v-model="form.date_appointmen"
                                                        :config="configFlatPickr"
                                                        class="form-input"
                                                        placeholder="Selecciona fecha"
                                                    />
                                                    <div class="text-danger mt-2" id="startDateErr"></div>
                                                </div>
                                                <div class="mb-5">
                                                    <label for="dateEnd">Hora :</label>
                                                    <Dropdown placement="bottom" align-to-end :trigger="['click']" v-model:visible="timeVisible">
                                                        <input v-model="form.time_appointmen" class="form-input w-full" @click.prevent /> 
                                                        <template #overlay>
                                                            <Menu>
                                                                
                                                                <perfect-scrollbar
                                                                    :options="{
                                                                        swipeEasing: true,
                                                                        wheelPropagation: false,
                                                                    }"
                                                                    class="relative"
                                                                    style="max-height: 288px;"
                                                                >
                                                                    <div class="max-w-[85rem] px-4 py-2 mx-auto">
                                                                        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-2">
                                                                            <template v-for="(row, index) in arrayTimes" :key="index">
                                                                                <template v-if="row.active">
                                                                                    <button @click="startTimeChange(row.time)" type="button" class="btn btn-outline-primary">
                                                                                        {{ row.time }}
                                                                                    </button>
                                                                                </template>
                                                                                <template v-else>
                                                                                    <button disabled type="button" class="btn btn-danger">
                                                                                        {{ row.time }}
                                                                                    </button>
                                                                                </template>
                                                                            </template>
                                                                        </div>
                                                                    </div>
                                                                </perfect-scrollbar>
                                                                
                                                            </Menu>
                                                        </template>
                                                    </Dropdown>
                                                    
                                                    <div class="text-danger mt-2" id="endDateErr"></div>
                                                </div>
                                            </div>
                                            <div class="mb-5">
                                                <label for="title">Motivo :</label>
                                                <textarea
                                                    id="title"
                                                    type="text"
                                                    name="title"
                                                    class="form-input"
                                                    v-model="form.description"
                                                    rows="3"
                                                    required
                                                    
                                                ></textarea>
                                                <div class="text-danger mt-2" id="titleErr"></div>
                                            </div>
                                            <div class="mb-5">
                                                <label>Estado:</label>
                                                <div class="mt-3">
                                                    <label class="inline-flex cursor-pointer ltr:mr-3 rtl:ml-3">
                                                        <input type="radio" class="form-radio" name="badge" value="2" v-model="form.status" />
                                                        <span class="ltr:pl-2 rtl:pr-2">Atendido</span>
                                                    </label>
                                                    <label class="inline-flex cursor-pointer ltr:mr-3 rtl:ml-3">
                                                        <input type="radio" class="form-radio text-success" name="badge" value="1" v-model="form.status" />
                                                        <span class="ltr:pl-2 rtl:pr-2">Pendiente</span>
                                                    </label>
                                                    <label class="inline-flex cursor-pointer">
                                                        <input type="radio" class="form-radio text-danger" name="badge" value="0" v-model="form.status" />
                                                        <span class="ltr:pl-2 rtl:pr-2">Cancelado</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="flex justify-end items-center mt-8">
                                                <button type="button" class="btn btn-outline-danger" @click="isAddEventModal = false">Cerrar</button>
                                                <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                    {{ form.id ? 'Actualizar' : 'Guardar' }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
        </div>
    </AppLayout>
</template>
