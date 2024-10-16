import { 
    faWheelchair, 
    faKitMedical,
    faUserDoctor,
    faTooth
} from "@fortawesome/free-solid-svg-icons";
import menuDental from 'Modules/Dental/Resources/assets/js/Menu.js';

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
        menuDental
    ]
    
};
export default menuHealth;
