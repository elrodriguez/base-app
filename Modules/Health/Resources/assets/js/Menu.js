import { 
    faWheelchair, 
    faKitMedical,
    faUserDoctor,
    faTooth
} from "@fortawesome/free-solid-svg-icons";

const menuHealth = {
    status:false,
    text: 'Salud',
    icom: faKitMedical,
    route: 'module',
    permissions: 'heal_dashboard',
    items: [
        {
            route: route('heal_doctors_list'),
            status: false,
            text: 'Doctores',
            icom: faUserDoctor,
            permissions: 'heal_doctores_listado',
        },
        {
            route: route('heal_patients_list'),
            status: false,
            text: 'Pacientes',
            icom: faWheelchair,
            permissions: 'heal_pacientes_listado',
        },
        { 
            route: null,
            status: false,
            text: 'Odontología',
            icom: faTooth,
            permissions: 'dental_dashboard',
            items: [
                {
                    route: route('odontology_appointments_list'),
                    status: false,
                    text: 'Citas',
                    permissions: 'dental_citas_listado',
                },
            ]
        }
    ]
    
};
export default menuHealth;
