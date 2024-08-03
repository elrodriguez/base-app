import { 
    faBook, 
    faUserGraduate, 
    faLandmarkFlag, 
    faUserTie, 
    faBookOpen,
    faRocket
} from "@fortawesome/free-solid-svg-icons";

const menuAcademic = {
    status: false,
    text: "Académico",
    icom: faBook,
    route: 'module',
    permissions: "aca_dashboard",
    items: [
        {
            route: route("aca_subscriptions_list"),
            status: false,
            text: "Tipo de suscripcion",
            icom: faRocket,
            permissions: "aca_suscripciones",
        },
        {
            route: route("aca_institutions_list"),
            status: false,
            text: "Instituciones",
            icom: faLandmarkFlag,
            permissions: "aca_institucion_listado",
        },
        {
            route: route("aca_teachers_list"),
            status: false,
            text: "Docentes",
            icom: faUserTie,
            permissions: "aca_docente_listado",
        },
        {
            route: route("aca_students_list"),
            status: false,
            text: "Estudiantes",
            icom: faUserGraduate,
            permissions: "aca_estudiante_listado",
        },
        {
            route: route("aca_courses_list"),
            status: false,
            text: "Cursos",
            icom: faBook,
            permissions: "aca_cursos_listado",
        },
        {
            route: route("aca_mycourses"),
            status: false,
            text: "Mis Cursos",
            icom: faBookOpen,
            permissions: "aca_miscursos",
        }
    ],
};

export default menuAcademic;
