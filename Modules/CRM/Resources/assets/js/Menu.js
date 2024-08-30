import { faGear, faUserGroup, faComments, faEnvelopesBulk } from "@fortawesome/free-solid-svg-icons";

const menuCRM = {
    status: false,
    text: "Gestión de Clientes y Comunicación",
    icom: faGear,
    route: 'module',
    permissions: "crm_dashboard",
    items: [
        {
            route: route("crm_contacts_list"),
            status: false,
            text: "Contactos",
            permissions: "crm_contactos_listado",
            icom: faUserGroup,
        },
        {
            route: route("crm_chat_dashboard"),
            status: false,
            text: "Chat en vivo",
            permissions: "crm_chat_dashboard",
            icom: faComments,
        },
        {
            route: route("crm_mailbox_dashboard"),
            status: false,
            text: "Buzón de correo",
            permissions: "crm_mailbox_dashboard",
            icom: faEnvelopesBulk,
        }
    ],
};
export default menuCRM;
