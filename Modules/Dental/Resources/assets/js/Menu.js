import { 
    faTooth
} from "@fortawesome/free-solid-svg-icons";

const menuDental = { 
    route: null,
    status: false,
    text: 'Odontología',
    icom: faTooth,
    permissions: 'dental_dashboard',
    items: [
        {
            route: route('odontology_appointments_calendar'),
            status: false,
            text: 'Citas',
            permissions: 'dental_citas_listado',
        },
        {
            route: route('odontology_attention_list'),
            status: false,
            text: 'Atencion',
            permissions: 'dental_citas_listado',
        },
    ]
};
export default menuDental;
